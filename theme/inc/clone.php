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
    $clone_uri  = get_template_directory_uri() . '/clone';
    $clone_path = get_template_directory() . '/clone';
    $file = tnl_clone_has($slug);
    if (!$file) return false;

    $markup = file_get_contents($file);
    $s3host = 'bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com';
    $markup = str_replace(
        ['="images/',                    '../' . $s3host . '/'],
        ['="' . $clone_uri . '/images/', 'https://' . $s3host . '/'],
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
