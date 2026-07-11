<?php
/**
 * CLONE MODE renderer dùng chung.
 * Đọc markup tĩnh clone/parts/{slug}-{lang}.html (lấy nguyên từ live), rewrite asset,
 * xuất tài liệu HTML standalone + live.css + clone.js. Dùng cho front-page và page con.
 */

if (!defined('ABSPATH')) exit;

function tnl_clone_lang() {
    return (function_exists('tnl_lang') && tnl_lang() === 'en') ? 'en' : 'vi';
}

/** Có file clone cho slug này không (ưu tiên đúng lang, fallback vi). */
function tnl_clone_has($slug) {
    $base = get_template_directory() . '/clone/parts/';
    $lang = tnl_clone_lang();
    foreach (["$slug-$lang.html", "$slug-vi.html"] as $f) {
        if (is_readable($base . $f) && filesize($base . $f) > 0) return $base . $f;
    }
    return false;
}

/** Xuất toàn bộ trang clone-mode rồi exit. */
function tnl_clone_render($slug) {
    $file = tnl_clone_has($slug);
    if (!$file) return false;
    return tnl_clone_output($file, $slug);
}

/**
 * Render trang CHI TIẾT clone: clone/parts/detail/{type}/{slug}-{lang}.html (fallback vi).
 * $lang truyền tường minh từ URL để không phụ thuộc cache tnl_lang().
 */
function tnl_clone_render_detail($type, $rawslug, $lang) {
    $lang = ($lang === 'en') ? 'en' : 'vi';
    $base = get_template_directory() . '/clone/parts/detail/' . $type . '/';
    foreach (["$rawslug-$lang.html", "$rawslug-vi.html"] as $f) {
        if (is_readable($base . $f) && filesize($base . $f) > 0) {
            return tnl_clone_output($base . $f, $type);
        }
    }
    return false;
}

/** Xuất tài liệu clone-mode standalone từ 1 file markup cụ thể rồi trả true. */
function tnl_clone_output($file, $slug = '') {
    if (!headers_sent()) { status_header(200); nocache_headers(); }
    global $wp_query; if ($wp_query) { $wp_query->is_404 = false; }
    $clone_uri  = get_template_directory_uri() . '/clone';
    $clone_path = get_template_directory() . '/clone';
    $markup = file_get_contents($file);
    $s3host = 'bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com';
    $markup = str_replace('="images/', '="' . $clone_uri . '/images/', $markup);
    // Ảnh S3: ưu tiên bản đã cache local (clone/s3/<file>) cho nhanh; thiếu thì fallback S3.
    $s3dir = $clone_path . '/s3/';
    $markup = preg_replace_callback(
        '#\.\./' . preg_quote($s3host, '#') . '/([^\s"\'\\\\]+)#',
        function ($m) use ($clone_uri, $s3host, $s3dir) {
            $f = $m[1];
            if ($f !== '' && is_readable($s3dir . rawurldecode($f))) {
                return $clone_uri . '/s3/' . $f;
            }
            return 'https://' . $s3host . '/' . $f;
        },
        $markup
    );

    // Bỏ theme styles để live.css render thuần.
    add_action('wp_head', function () {
        wp_dequeue_style('tnl-sections');
        wp_dequeue_style('tnl-pages');
        wp_dequeue_style('tnl-style');
    }, 0);

    // Dọn cruft wp_head (RSD/wlwmanifest/REST/shortlink/oembed/generator) cho gọn.
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'rest_output_link_wp_head');
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'feed_links', 2);

    $css_v = filemtime($clone_path . '/css/live.css');
    $js_v  = filemtime($clone_path . '/js/clone.js');
    $opt_path = $clone_path . '/css/optimize.css';
    $opt_v = is_readable($opt_path) ? filemtime($opt_path) : 0;
    ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo esc_url($clone_uri . '/css/live.css?v=' . $css_v); ?>">
  <?php if ($opt_v) : ?><link rel="stylesheet" href="<?php echo esc_url($clone_uri . '/css/optimize.css?v=' . $opt_v); ?>"><?php endif; ?>
  <?php wp_head(); ?>
</head>
<body class="tnl-opt<?php echo ($slug === 'events') ? ' tnl-opt-events' : ''; ?> <?php echo esc_attr(implode(' ', get_body_class())); ?>">
<?php wp_body_open(); ?>
<?php echo $markup; ?>
<script src="<?php echo esc_url($clone_uri . '/js/clone.js?v=' . $js_v); ?>"></script>
<?php wp_footer(); ?>
</body>
</html>
    <?php
    return true;
}

/**
 * Route trang chi tiết clone (blog / courses / events / careers).
 * WP không có page tương ứng nên các URL này vốn 404 -> tự bắt tại template_redirect,
 * render markup clone/parts/detail/{type}/{slug}-{lang}.html rồi exit. Khớp cấu trúc URL live.
 */
add_action('template_redirect', function () {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $path = urldecode((string) $path);
    if (!preg_match('#^/(en|vi)/(blog|courses|events|careers)/(.+?)/?$#', $path, $m)) return;
    $slug = $m[3];
    if (strpos($slug, '/') !== false || strpos($slug, '..') !== false) return; // chống path traversal
    $_GET['lang'] = $m[1]; // ép <html lang> + tnl_lang() theo prefix URL
    if (function_exists('tnl_clone_render_detail') && tnl_clone_render_detail($m[2], $slug, $m[1])) {
        exit;
    }
}, 1);
