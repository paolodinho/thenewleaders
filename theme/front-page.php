<?php
/**
 * front-page.php — CLONE MODE (trang chủ).
 * Render markup + CSS lấy nguyên từ live để parity ~100%. Logic dùng chung ở inc/clone.php.
 */
if (function_exists('tnl_clone_render') && tnl_clone_render('home')) {
    return;
}
// Fallback (không có file clone) — template cũ.
get_header();
get_template_part('template-parts/home/hero');
get_template_part('template-parts/home/what-we-help');
get_template_part('template-parts/home/what-we-do');
get_template_part('template-parts/home/testimonials');
get_template_part('template-parts/home/about');
get_template_part('template-parts/home/why-us');
get_template_part('template-parts/home/video-section');
get_template_part('template-parts/home/values');
get_template_part('template-parts/home/growing');
get_template_part('template-parts/home/partners');
get_template_part('template-parts/home/newsletter');
get_template_part('template-parts/home/cta');
get_footer();
