<?php
/**
 * CLONE MODE renderer dùng chung.
 * Đọc markup tĩnh clone/parts/{slug}-{lang}.html (lấy nguyên từ live), rewrite asset,
 * xuất tài liệu HTML standalone + live.css + clone.js. Dùng cho front-page và page con.
 */

if (!defined('ABSPATH')) exit;

/* Xoá cache tầng server (LiteSpeed - Hostinger bật edge cache, giữ HTML cũ tới 7 ngày
 * MẶC KỆ WordPress đã báo no-cache) ngay khi nội dung được lưu qua bất kỳ công cụ sửa
 * nào (Inline Editor, Content Editor, Landing Studio) - nếu không, người sửa và khách
 * xem đều thấy bản cũ cho tới khi cache tự hết hạn. Purge toàn site (an toàn, chỉ khiến
 * lượt xem kế tiếp build lại cache) vì các trang dùng chung asset/CSS theo nhiều slug,
 * khó tính đúng 1 tag riêng lẻ. Đặt ở clone.php vì file này luôn load trước các file lưu
 * nội dung khác (functions.php require clone.php đầu tiên).
 */
function tnl_purge_litespeed() {
    if (!headers_sent()) header('X-LiteSpeed-Purge: *');
}

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
            // Đặt context trang chi tiết -> seo.php dùng để xuất title + Article/BreadcrumbList schema.
            $html = file_get_contents($base . $f);
            $title = '';
            // Ưu tiên titles.json (map slug -> tiêu đề chuẩn); fallback H1 trong markup.
            static $titles_map = null;
            if ($titles_map === null) {
                $tj = get_template_directory() . '/clone/parts/detail/titles.json';
                $titles_map = is_readable($tj) ? (json_decode(file_get_contents($tj), true) ?: []) : [];
            }
            $tkey = $lang . '/' . $type . '/' . $rawslug;
            if (!empty($titles_map[$tkey])) {
                $title = trim(html_entity_decode($titles_map[$tkey], ENT_QUOTES, 'UTF-8'));
            } elseif (preg_match('#<h1[^>]*>(.*?)</h1>#is', $html, $mh)) {
                $title = trim(html_entity_decode(strip_tags($mh[1]), ENT_QUOTES, 'UTF-8'));
            }
            $desc = '';
            if (preg_match_all('#<p[^>]*>(.*?)</p>#is', $html, $mp)) {
                foreach ($mp[1] as $ptxt) {
                    $t = trim(html_entity_decode(strip_tags($ptxt), ENT_QUOTES, 'UTF-8'));
                    if (mb_strlen($t) >= 60) { $desc = mb_substr($t, 0, 160); break; }
                }
            }
            $date = '';
            if (preg_match('#\b(\d{1,2})/(\d{1,2})/(\d{4})\b#', $html, $md)) {
                $date = sprintf('%04d-%02d-%02d', $md[3], $md[1], $md[2]); // live dùng MM/DD/YYYY
            }
            $GLOBALS['tnl_detail_ctx'] = array(
                'type'  => $type,
                'slug'  => $rawslug,
                'lang'  => $lang,
                'title' => $title,
                'desc'  => $desc,
                'date'  => $date,
                'url'   => home_url('/' . $lang . '/' . $type . '/' . $rawslug . '/'),
            );
            return tnl_clone_output($base . $f, $type);
        }
    }
    return false;
}

/** Xuất tài liệu clone-mode standalone từ 1 file markup cụ thể rồi trả true. */
function tnl_clone_output($file, $slug = '') {
    return tnl_clone_emit(file_get_contents($file), $slug);
}

/** Xuất tài liệu clone-mode standalone từ một CHUỖI markup (dùng cho trang render động: blog WP...). */
function tnl_clone_emit($markup, $slug = '') {
    if (!headers_sent()) { status_header(200); nocache_headers(); }
    global $wp_query; if ($wp_query) { $wp_query->is_404 = false; }
    $clone_uri  = get_template_directory_uri() . '/clone';
    $clone_path = get_template_directory() . '/clone';
    $s3host = 'bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com';
    // Trỏ MỌI asset "images/..." về thư mục clone: bắt src, TỪNG candidate trong srcSet
    // (dạng ", images/..."), cả url() nền (kể cả leading-slash "/images/" và entity &#x27;).
    // Delimiter đứng trước path: = " ' ( , khoảng trắng hoặc entity quote; theo sau có thể có "/".
    $markup = preg_replace(
        '~([=,("\x27\s;])/?images/~',
        '${1}' . $clone_uri . '/images/',
        $markup
    );
    // Ảnh S3: ưu tiên bản đã cache local (clone/s3/<file>) cho nhanh; thiếu thì fallback S3.
    $s3dir = $clone_path . '/s3/';
    $markup = preg_replace_callback(
        '#(?:\.\./|https://)' . preg_quote($s3host, '#') . '/([^\s"\'\\\\)]+)#',
        function ($m) use ($clone_uri, $s3host, $s3dir) {
            $token = $m[1];                          // có thể là key hoặc key?query(signed)
            $key   = preg_replace('/\?.*$/', '', $token);
            if ($key !== '' && is_readable($s3dir . rawurldecode($key))) {
                return $clone_uri . '/s3/' . $key;   // phục vụ bản local theo tên object
            }
            return 'https://' . $s3host . '/' . str_replace('&amp;', '&', $token); // fallback S3
        },
        $markup
    );

    // Ảnh CDN ngoài (vietqr, builder.io) -> bản local đã cache (clone/ext/ + map.json).
    $extmap = $clone_path . '/ext/map.json';
    if (is_readable($extmap)) {
        $map = json_decode(file_get_contents($extmap), true);
        if (is_array($map) && $map) {
            $pairs = [];
            foreach ($map as $url => $name) {
                if (is_readable($clone_path . '/ext/' . $name)) {
                    $pairs[$url] = $clone_uri . '/ext/' . $name;
                }
            }
            if ($pairs) $markup = strtr($markup, $pairs);
        }
    }

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
    $fi_path = $clone_path . '/css/fonts-inline.css';
    $fi_v = is_readable($fi_path) ? filemtime($fi_path) : 0;
    // landing.css: mang class .tnl-* dung boi cac khoi "Them khoi" (inc/inline-editor.php)
    // chen vao trang CLONE MODE - tai luon de moi trang deu san sang, du chua chen khoi nao.
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $landing_v = @filemtime($theme_dir . '/assets/landing.css') ?: '1';
    ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo esc_url($clone_uri . '/css/live.css?v=' . $css_v); ?>">
  <?php if ($opt_v) : ?><link rel="stylesheet" href="<?php echo esc_url($clone_uri . '/css/optimize.css?v=' . $opt_v); ?>"><?php endif; ?>
  <?php if ($fi_v) : ?><link rel="stylesheet" href="<?php echo esc_url($clone_uri . '/css/fonts-inline.css?v=' . $fi_v); ?>"><?php endif; ?>
  <link rel="stylesheet" href="<?php echo esc_url($theme_uri . '/assets/landing.css?v=' . $landing_v); ?>">
  <?php wp_head(); ?>
</head>
<body class="tnl-opt tnl-page-<?php echo esc_attr($slug); ?><?php echo ($slug === 'events') ? ' tnl-opt-events' : ''; ?> <?php echo esc_attr(implode(' ', get_body_class())); ?>">
<?php wp_body_open(); ?>
<?php echo apply_filters('tnl_clone_markup', $markup, $slug, tnl_clone_lang()); ?>
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
/** Alias slug cũ/sai -> slug chuẩn (URL đã lan ra ngoài, phải 301 chứ không 404). */
function tnl_detail_aliases() {
    return array(
        'careers/business-development'          => 'business-development-manager',
    );
}

/** Danh sách slug chuẩn có file markup, theo type. */
function tnl_detail_slugs($type) {
    static $cache = array();
    if (isset($cache[$type])) return $cache[$type];
    $dir = get_template_directory() . '/clone/parts/detail/' . $type . '/';
    $out = array();
    foreach (glob($dir . '*.html') ?: array() as $f) {
        $out[preg_replace('/-(vi|en)$/', '', basename($f, '.html'))] = true;
    }
    return $cache[$type] = array_keys($out);
}

/**
 * Tìm slug chuẩn cho một slug người dùng gõ/click: khớp tuyệt đối -> alias -> không phân biệt
 * hoa thường/dấu gạch. Trả [type, slug] (type có thể khác type gõ vào: link cũ trỏ sai nhóm).
 */
function tnl_detail_resolve($type, $slug) {
    $types = array($type, 'careers', 'events', 'courses', 'blog');
    $norm  = function ($s) { return trim(strtolower(preg_replace('/[^a-z0-9]+/i', '-', trim($s))), '-'); };
    $alias = tnl_detail_aliases();
    foreach (array_unique($types) as $t) {
        $slugs = tnl_detail_slugs($t);
        if (in_array($slug, $slugs, true)) return array($t, $slug);
        $key = $t . '/' . strtolower($slug);
        if (isset($alias[$key]) && in_array($alias[$key], $slugs, true)) return array($t, $alias[$key]);
        foreach ($slugs as $cand) {
            if ($norm($cand) === $norm($slug)) return array($t, $cand);
        }
    }
    return array(null, null);
}

/**
 * Route trang chi tiết clone (blog / courses / events / careers).
 * WP không có page tương ứng nên các URL này vốn 404 -> tự bắt tại template_redirect,
 * render markup clone/parts/detail/{type}/{slug}-{lang}.html rồi exit. Khớp cấu trúc URL live.
 * URL lệch hoa/thường, sai nhóm hoặc dùng slug cũ -> 301 về URL chuẩn (không để 404).
 */
add_action('template_redirect', function () {
    $path = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $path = urldecode((string) $path);
    if (!preg_match('#^/(en|vi)/(blog|courses|events|careers)/(.+?)/?$#', $path, $m)) return;
    $slug = trim($m[3]); // live có URL 'Head-Growth ' (dính space cuối)
    if (strpos($slug, '/') !== false || strpos($slug, '..') !== false) return; // chống path traversal
    $_GET['lang'] = $m[1]; // ép <html lang> + tnl_lang() theo prefix URL

    list($type, $canon) = tnl_detail_resolve($m[2], $slug);
    if (!$type) return; // không có trang thật -> để WP trả 404 (404.php)

    if ($type !== $m[2] || $canon !== $m[3]) {
        wp_redirect(home_url('/' . $m[1] . '/' . $type . '/' . rawurlencode($canon) . '/'), 301);
        exit;
    }
    if (tnl_clone_render_detail($type, $canon, $m[1])) exit;
}, 1);

/**
 * URL chi tiết thiếu prefix ngôn ngữ (/careers/x, /events/x...) -> 301 về /{lang}/... theo
 * ngôn ngữ đang chọn. Trước đây các URL này luôn rơi về bản tiếng Việt.
 */
add_action('template_redirect', function () {
    $path = urldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
    if (!preg_match('#^/(courses|events|careers)/(.+?)/?$#', $path, $m)) return;
    $slug = trim($m[2]);
    if ($slug === '' || strpos($slug, '/') !== false || strpos($slug, '..') !== false) return;
    $lang = (isset($_COOKIE['tnl_lang']) && $_COOKIE['tnl_lang'] === 'en') ? 'en' : 'vi';
    list($type, $canon) = tnl_detail_resolve($m[1], $slug);
    if (!$type) return;
    wp_redirect(home_url('/' . $lang . '/' . $type . '/' . rawurlencode($canon) . '/'), 301);
    exit;
}, 1);

/**
 * Link nội bộ trong markup clone thiếu prefix ngôn ngữ (/careers/..., /events/...) -> thêm
 * /{lang}/ theo trang đang xem. Trước đây bản EN click sang lại rơi về trang tiếng Việt.
 */
add_filter('tnl_clone_markup', function ($markup, $slug, $lang) {
    $path = urldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
    if (preg_match('#^/(en|vi)(/|$)#', $path, $mm)) $lang = $mm[1];
    $roots = 'blog|courses|events|careers|our-services|products|resources|contact|newsletter|eq-quiz';
    return preg_replace('#href="/(?!en/|vi/)(' . $roots . ')(/|"|\?)#', 'href="/' . $lang . '/$1$2', $markup);
}, 9, 3);

/**
 * Credit đơn vị thiết kế: chèn 1 dòng ngay DƯỚI dòng © trong footer clone.
 * Làm bằng filter (1 chỗ) thay vì sửa ~150 file clone/parts.
 * Trang eq-assessment là page trần nhúng iframe (không có footer) -> tự bỏ qua.
 */
add_filter('tnl_clone_markup', function ($markup, $slug, $lang) {
    $needle = '<div class="text-[#979797] text-base lg:text-xl mt-20 text-center">© <!-- -->2026<!-- --> The New Leaders. All rights reserved.</div>';
    if (strpos($markup, $needle) === false) return $markup;

    // Lấy lang thẳng từ URL: tnl_lang() dùng static cache, có thể stale trên route chi tiết.
    $path = urldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
    if (preg_match('#^/(en|vi)(/|$)#', $path, $mm)) $lang = $mm[1];

    $link = '<a href="https://digicomvn.com" target="_blank" rel="noopener" class="underline hover:text-white">digicomvn</a>';
    // Digicom làm phần lập trình (design do bên khác cung cấp) -> "phát triển", KHÔNG dùng "thiết kế".
    $text = ($lang === 'en')
        ? 'Website developed by ' . $link . ' (Digito Combat Communication Services Company Limited).'
        : 'Website được phát triển bởi ' . $link . ' (Công ty TNHH Dịch vụ Truyền thông Digito Combat).';

    $credit = '<div class="text-[#979797] text-sm lg:text-base mt-3 text-center">' . $text . '</div>';
    return str_replace($needle, $needle . $credit, $markup);
}, 10, 3);
