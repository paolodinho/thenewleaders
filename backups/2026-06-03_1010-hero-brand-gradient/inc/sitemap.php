<?php
/**
 * Sitemap XML tùy chỉnh tại /sitemap.xml — liệt kê mọi trang theo /en/ và /vi/
 * kèm hreflang alternates. Tắt sitemap core (nó liệt kê URL không có prefix ngôn ngữ).
 * + robots.txt trỏ tới sitemap.
 */
if (!defined('ABSPATH')) exit;

// Tắt wp-sitemap core
add_filter('wp_sitemaps_enabled', '__return_false');

// Query var + rewrite cho /sitemap.xml
add_filter('query_vars', function ($v) { $v[] = 'tnl_sitemap'; return $v; });
add_action('init', function () {
    add_rewrite_rule('^sitemap\.xml$', 'index.php?tnl_sitemap=1', 'top');
});

add_action('template_redirect', function () {
    if (!get_query_var('tnl_sitemap')) return;

    $langs = ['en', 'vi'];
    $home  = trailingslashit(home_url());
    $urls  = [];

    // Trang chủ
    $front_mod = get_post_field('post_modified_gmt', (int) get_option('page_on_front')) ?: gmdate('Y-m-d');
    $urls[] = ['path' => '', 'mod' => substr($front_mod, 0, 10), 'pri' => '1.0'];

    // Mọi trang publish (trừ front + Privacy Policy)
    $front_id = (int) get_option('page_on_front');
    $pages = get_posts(['post_type' => 'page', 'post_status' => 'publish', 'numberposts' => -1]);
    foreach ($pages as $p) {
        if ($p->ID === $front_id) continue;
        if ($p->post_name === 'privacy-policy') continue;
        $urls[] = ['path' => get_page_uri($p->ID), 'mod' => substr($p->post_modified_gmt, 0, 10), 'pri' => '0.8'];
    }

    header('Content-Type: application/xml; charset=UTF-8');
    echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
    echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">' . "\n";
    foreach ($urls as $u) {
        $suffix = $u['path'] ? trailingslashit($u['path']) : '';
        foreach ($langs as $lang) {
            $loc = $home . $lang . '/' . $suffix;
            echo "  <url>\n";
            echo "    <loc>" . esc_url($loc) . "</loc>\n";
            foreach ($langs as $alt) {
                $altloc = $home . $alt . '/' . $suffix;
                echo '    <xhtml:link rel="alternate" hreflang="' . $alt . '" href="' . esc_url($altloc) . '"/>' . "\n";
            }
            echo '    <xhtml:link rel="alternate" hreflang="x-default" href="' . esc_url($home . 'en/' . $suffix) . '"/>' . "\n";
            echo "    <lastmod>" . esc_html($u['mod']) . "</lastmod>\n";
            echo "    <priority>" . esc_html($u['pri']) . "</priority>\n";
            echo "  </url>\n";
        }
    }
    echo '</urlset>';
    exit;
});

// robots.txt -> trỏ sitemap
add_filter('robots_txt', function ($output) {
    $output .= "\nSitemap: " . home_url('/sitemap.xml') . "\n";
    return $output;
}, 10, 1);
