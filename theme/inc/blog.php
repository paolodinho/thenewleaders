<?php
/**
 * Blog động bằng bài đăng WordPress (post_type=post) - render qua "shell" clone
 * để KHỚP giao diện + URL /{lang}/blog/{slug}/. Bài mới khách tự đăng hiện ngay.
 * 8 bài cũ vẫn do clone.php phục vụ (giữ URL/SEO); router này ưu tiên chạy TRƯỚC
 * và chỉ nhận khi có bài WP tương ứng, còn lại nhường cho clone.
 */
if (!defined('ABSPATH')) exit;

/** Permalink bài viết -> /{lang}/blog/{slug}/ (để nút Xem + link danh sách đúng). */
add_filter('post_link', function ($url, $post) {
    if ($post && $post->post_type === 'post') {
        $lang = (function_exists('tnl_lang') && tnl_lang() === 'en') ? 'en' : 'vi';
        return home_url('/' . $lang . '/blog/' . $post->post_name . '/');
    }
    return $url;
}, 10, 2);

/** Tìm bài WP theo slug (kèm bản nháp nếu người dùng có quyền sửa - để xem trước). */
function tnl_blog_find_post($slug) {
    $post = get_page_by_path($slug, OBJECT, 'post');
    if ($post && $post->post_status === 'publish') return $post;
    if ($post && current_user_can('edit_posts') &&
        in_array($post->post_status, array('draft', 'pending', 'future', 'private'), true)) return $post;
    return null;
}

/** Router: /{lang}/blog/{slug}/ -> nếu có bài WP thì render, chạy TRƯỚC clone (priority 0). */
add_action('template_redirect', function () {
    $path = urldecode((string) parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
    if (!preg_match('#^/(en|vi)/blog/(.+?)/?$#', $path, $m)) return;
    $slug = trim($m[2]);
    if ($slug === '' || strpos($slug, '/') !== false || strpos($slug, '..') !== false) return;
    $post = tnl_blog_find_post($slug);
    if (!$post) return; // nhường clone.php phục vụ 8 bài cũ
    tnl_blog_render_post($post, $m[1]);
    exit;
}, 0);

/** Render 1 bài WP qua shell blog-shell-{lang}.html. */
function tnl_blog_render_post($post, $lang) {
    $lang = ($lang === 'en') ? 'en' : 'vi';
    $shell = get_template_directory() . '/clone/parts/blog-shell/blog-shell-' . $lang . '.html';
    if (!is_readable($shell)) return false;
    $_GET['lang'] = $lang; // ép <html lang> + tnl_lang()
    $tpl = file_get_contents($shell);

    $title = get_the_title($post);
    $ts    = (int) get_post_time('U', true, $post);
    $mdy   = date_i18n('n/j/Y', $ts);
    $time  = '<time datetime="' . esc_attr(date_i18n('c', $ts)) . '" title="' . esc_attr($mdy) . '">' . esc_html($mdy) . '</time>';

    // Ảnh bìa: ưu tiên Featured Image -> meta _tnl_cover -> figure từ file clone cùng slug
    // (giữ ảnh bìa cho 8 bài cũ chưa set featured image sau khi chuyển sang render WP).
    $figure = '';
    $cover  = '';
    if (has_post_thumbnail($post)) {
        $cover = get_the_post_thumbnail_url($post, 'large');
    } else {
        $mc = get_post_meta($post->ID, '_tnl_cover', true);
        if ($mc) $cover = $mc;
    }
    if ($cover) {
        $figure = '<figure class="mb-4"><img decoding="async" fetchpriority="high" alt="' . esc_attr($title) .
                  '" src="' . esc_url($cover) . '" class="w-full h-auto object-contain"/></figure>';
    } else {
        // Fallback: lấy nguyên <figure> từ file clone khớp slug (không phân biệt hoa/thường).
        $bdir = get_template_directory() . '/clone/parts/detail/blog/';
        $found = '';
        foreach (glob($bdir . '*-' . $lang . '.html') ?: glob($bdir . '*-vi.html') ?: array() as $cf) {
            $bn = preg_replace('/-(vi|en)\.html$/', '', basename($cf));
            if (strcasecmp($bn, $post->post_name) === 0) { $found = $cf; break; }
        }
        if ($found && is_readable($found)) {
            $chtml = file_get_contents($found);
            if (preg_match('#<figure class="mb-4">.*?</figure>#is', $chtml, $mf)) {
                $figure = $mf[0]; // tnl_clone_emit sẽ rewrite ảnh S3 -> local/fallback
            }
        }
    }

    $content = apply_filters('the_content', $post->post_content);

    $html = strtr($tpl, array(
        '{{TITLE}}'   => esc_html($title),
        '{{TIME}}'    => $time,
        '{{FIGURE}}'  => $figure,
        '{{CONTENT}}' => $content,
    ));

    // Related articles ĐỘNG: 4 bài khác mới nhất + ảnh bìa thật (thay 4 card tĩnh hardcode
    // trong shell - vốn giống hệt mọi bài & thiếu ảnh). 2026-07-21.
    $rel_posts = get_posts(array('post_type' => 'post', 'post_status' => 'publish',
        'numberposts' => 4, 'exclude' => array($post->ID), 'orderby' => 'date', 'order' => 'DESC'));
    if ($rel_posts) {
        $rel_cols = array('#5AD3ED', '#FB5015', '#F5C242', '#8BC34A');
        $related  = '';
        foreach ($rel_posts as $ri => $rp) {
            $rurl = '/' . $lang . '/blog/' . $rp->post_name . '/';
            $rtit = esc_html(get_the_title($rp));
            $rcov = has_post_thumbnail($rp) ? get_the_post_thumbnail_url($rp, 'medium')
                                            : get_post_meta($rp->ID, '_tnl_cover', true);
            $media = $rcov
                ? '<img loading="lazy" decoding="async" alt="' . $rtit . '" src="' . esc_url($rcov) . '" class="mb-5 rounded-lg"/>'
                : '<div class="mb-5 rounded-lg" style="width:100%;aspect-ratio:16/10;background:' . $rel_cols[$ri % 4] . '"></div>';
            $related .= '<article class="max-w-xs"><a href="' . $rurl . '">' . $media . '</a>'
                      . '<h2 class="mb-2 text-xl font-bold leading-tight text-nero-900"><a href="' . $rurl . '">' . $rtit . '</a></h2></article>';
        }
        $html = preg_replace(
            '#(<div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-4">).*?(</div>)#s',
            '$1' . $related . '$2', $html, 1);
    }

    // Context cho seo.php -> Article + BreadcrumbList schema.
    $desc = trim(preg_replace('/\s+/', ' ', wp_strip_all_tags($post->post_content)));
    $GLOBALS['tnl_detail_ctx'] = array(
        'type'  => 'blog',
        'slug'  => $post->post_name,
        'lang'  => $lang,
        'title' => $title,
        'desc'  => mb_substr($desc, 0, 160),
        'date'  => date_i18n('Y-m-d', $ts),
        'url'   => home_url('/' . $lang . '/blog/' . $post->post_name . '/'),
    );

    if (function_exists('tnl_clone_emit')) return tnl_clone_emit($html, 'blog');
    echo $html; return true;
}

/** Chèn các bài WP mới vào ĐẦU lưới Blog của trang Resources (mới nhất trước). */
add_filter('tnl_clone_markup', function ($markup, $slug, $lang) {
    if ($slug !== 'resources') return $markup;
    $grid_open = '<div class="grid grid-cols-2 gap-x-2 gap-y-2 lg:gap-x-16 lg:gap-y-16 mt-16">';
    if (strpos($markup, $grid_open) === false) return $markup;

    $lang = ($lang === 'en') ? 'en' : 'vi';
    $posts = get_posts(array('post_type' => 'post', 'post_status' => 'publish', 'numberposts' => 30, 'orderby' => 'date', 'order' => 'DESC'));
    if (!$posts) return $markup;

    $colors = array('#5AD3ED', '#FB5015', '#F5C242', '#8BC34A', '#9C6ADE', '#EF5DA8');
    $cards = '';
    foreach ($posts as $i => $p) {
        $url   = '/' . $lang . '/blog/' . $p->post_name . '/';
        $title = esc_html(get_the_title($p));
        $cover = has_post_thumbnail($p) ? get_the_post_thumbnail_url($p, 'medium') : get_post_meta($p->ID, '_tnl_cover', true);
        $col   = $colors[$i % count($colors)];
        $img   = $cover
            ? '<img loading="lazy" decoding="async" alt="' . $title . '" src="' . esc_url($cover) . '" class="object-contain w-full h-auto border-8" style="border-color:' . $col . '"/>'
            : '<div class="w-full border-8" style="border-color:' . $col . ';aspect-ratio:16/10;background:#F5F5F5"></div>';
        $cards .= '<div class="flex flex-col transition duration-300 ease-in-out hover:translate-x-2 hover:translate-y-2">'
                . '<a class="w-full" href="' . $url . '">' . $img . '</a>'
                . '<a href="' . $url . '"><p class="text-base md:text-lg lg:text-xl !leading-tight mt-4">' . $title . '</p></a></div>';
    }
    return str_replace($grid_open, $grid_open . $cards, $markup);
}, 10, 3);

/** Bài viết mới vào sitemap: /{lang}/blog/{slug}/. */
add_filter('tnl_sitemap_extra_urls', function ($urls) {
    foreach (get_posts(array('post_type' => 'post', 'post_status' => 'publish', 'numberposts' => -1)) as $p) {
        $urls[] = array('path' => 'blog/' . $p->post_name, 'mod' => substr($p->post_modified_gmt, 0, 10), 'pri' => '0.6');
    }
    return $urls;
}, 10, 1);
