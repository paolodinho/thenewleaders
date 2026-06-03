<?php
/**
 * The New Leaders — Theme Functions
 */

defined('ABSPATH') || exit;

// i18n nhẹ (EN/VI)
require get_template_directory() . '/inc/i18n.php';

// SEO meta / OG / hreflang / JSON-LD
require get_template_directory() . '/inc/seo.php';

// Sitemap XML tùy chỉnh + robots
require get_template_directory() . '/inc/sitemap.php';

// ============================================================
// THEME SETUP
// ============================================================
function tnl_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');
    add_theme_support('wp-block-styles');

    register_nav_menus([
        'primary' => __('Primary Menu', 'thenewleaders'),
        'footer'  => __('Footer Menu',   'thenewleaders'),
    ]);
}
add_action('after_setup_theme', 'tnl_setup');

// ============================================================
// ENQUEUE SCRIPTS & STYLES
// ============================================================
function tnl_enqueue() {
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();

    // Versions = file modified time → auto cache-bust on every edit (all devices)
    $style_path    = get_stylesheet_directory() . '/style.css';
    $sections_path = $theme_dir . '/assets/css/sections.css';
    $pages_path    = $theme_dir . '/assets/css/pages.css';
    $main_js_path  = $theme_dir . '/assets/js/main.js';

    $style_ver    = file_exists($style_path)    ? filemtime($style_path)    : '1.1.0';
    $sections_ver = file_exists($sections_path) ? filemtime($sections_path) : '1.1.0';
    $pages_ver    = file_exists($pages_path)    ? filemtime($pages_path)    : '1.1.0';
    $main_js_ver  = file_exists($main_js_path)  ? filemtime($main_js_path)  : '1.1.0';

    // Be Vietnam Pro — fallback đầy đủ tiếng Việt cho các glyph Euclid không có (giống cơ chế live)
    wp_enqueue_style('tnl-bevn', 'https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@300;400;500;600;700&display=swap', [], null);

    // Main stylesheet (includes @font-face for Euclid Circular A)
    wp_enqueue_style('tnl-style', get_stylesheet_uri(), [], $style_ver);

    // Sections CSS
    wp_enqueue_style('tnl-sections',
        $theme_uri . '/assets/css/sections.css',
        ['tnl-style'], $sections_ver
    );

    // Pages CSS (trang con)
    wp_enqueue_style('tnl-pages',
        $theme_uri . '/assets/css/pages.css',
        ['tnl-sections'], $pages_ver
    );

    // Main JS
    wp_enqueue_script('tnl-main',
        $theme_uri . '/assets/js/main.js',
        [], $main_js_ver, true
    );

    // Localize
    wp_localize_script('tnl-main', 'tnlData', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('tnl_nonce'),
    ]);

    // EQ Quiz JS (chỉ trang eq-quiz)
    if (is_page('eq-quiz')) {
        $eq_path = $theme_dir . '/assets/js/eq-quiz.js';
        $eq_ver  = file_exists($eq_path) ? filemtime($eq_path) : '1.0.0';
        wp_enqueue_script('tnl-eq-quiz', $theme_uri . '/assets/js/eq-quiz.js', [], $eq_ver, true);
    }
}
add_action('wp_enqueue_scripts', 'tnl_enqueue');

// ============================================================
// CONTENT WIDTH
// ============================================================
if (! isset($content_width)) {
    $content_width = 1200;
}

// ============================================================
// CUSTOM POST TYPES
// ============================================================
function tnl_register_cpts() {
    // Programs
    register_post_type('program', [
        'labels'      => ['name' => 'Programs', 'singular_name' => 'Program'],
        'public'      => true,
        'has_archive' => true,
        'supports'    => ['title','editor','thumbnail','excerpt'],
        'menu_icon'   => 'dashicons-welcome-learn-more',
        'rewrite'     => ['slug' => 'programs'],
        'show_in_rest'=> true,
    ]);

    // Testimonials
    register_post_type('testimonial', [
        'labels'      => ['name' => 'Testimonials', 'singular_name' => 'Testimonial'],
        'public'      => false,
        'show_ui'     => true,
        'supports'    => ['title','editor','thumbnail'],
        'menu_icon'   => 'dashicons-format-quote',
        'show_in_rest'=> true,
    ]);

    // Partners
    register_post_type('partner', [
        'labels'      => ['name' => 'Partners', 'singular_name' => 'Partner'],
        'public'      => false,
        'show_ui'     => true,
        'supports'    => ['title','thumbnail'],
        'menu_icon'   => 'dashicons-groups',
        'show_in_rest'=> true,
    ]);

    // Team
    register_post_type('team', [
        'labels'      => ['name' => 'Team Members', 'singular_name' => 'Team Member'],
        'public'      => false,
        'show_ui'     => true,
        'supports'    => ['title','editor','thumbnail'],
        'menu_icon'   => 'dashicons-admin-users',
        'show_in_rest'=> true,
    ]);
}
add_action('init', 'tnl_register_cpts');

// ============================================================
// THEME OPTIONS (ACF or custom)
// ============================================================
function tnl_get_option($key, $default = '') {
    return get_option('tnl_' . $key, $default);
}

// ============================================================
// HELPER: Get image URL by attachment ID
// ============================================================
function tnl_img($id, $size = 'large') {
    if (! $id) return '';
    return wp_get_attachment_image_url($id, $size) ?: '';
}

// ============================================================
// EXCERPT LENGTH
// ============================================================
add_filter('excerpt_length', fn() => 25);
add_filter('excerpt_more',   fn() => '…');

// ============================================================
// REMOVE EMOJI (performance)
// ============================================================
remove_action('wp_head',             'print_emoji_detection_script', 7);
remove_action('wp_print_styles',     'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles',  'print_emoji_styles');

// ============================================================
// AJAX FORM HANDLER (contact / newsletter / order) — không cần plugin
// ============================================================
function tnl_handle_form() {
    check_ajax_referer('tnl_nonce', 'nonce');
    $type   = sanitize_text_field(wp_unslash($_POST['form_type'] ?? 'Form'));
    $fields = isset($_POST['fields']) && is_array($_POST['fields']) ? wp_unslash($_POST['fields']) : [];
    $lines  = [];
    foreach ($fields as $k => $v) {
        $lines[] = sanitize_text_field($k) . ': ' . sanitize_textarea_field($v);
    }
    $to      = get_option('tnl_contact_email', '') ?: 'info@thenewleaders.asia';
    $subject = '[The New Leaders] ' . $type;
    $body    = "Form: {$type}\nNgày: " . current_time('Y-m-d H:i') . "\n\n" . implode("\n", $lines);
    wp_mail($to, $subject, $body);
    // Luôn trả thành công để UX mượt (trên Local có thể không gửi được mail; production sẽ gửi)
    wp_send_json_success();
}
add_action('wp_ajax_tnl_form', 'tnl_handle_form');
add_action('wp_ajax_nopriv_tnl_form', 'tnl_handle_form');
