<?php
/**
 * Template trang con — route theo slug tới template-parts/pages/{slug}.php
 * Nếu không có part riêng → render tiêu đề + nội dung WP mặc định.
 */
get_header();

if (have_posts()) :
    while (have_posts()) : the_post();
        $slug = get_post_field('post_name', get_the_ID());
        $part = locate_template("template-parts/pages/{$slug}.php", false, false);

        if ($part) {
            include $part;
        } else { ?>
            <main class="site-main page-generic">
              <section class="section">
                <div class="container">
                  <h1 class="page-generic__title"><?php the_title(); ?></h1>
                  <div class="page-generic__content"><?php the_content(); ?></div>
                </div>
              </section>
            </main>
        <?php }
    endwhile;
endif;

// Khối liên hệ chung (Get in touch) — giống live, dùng lại cho mọi trang con
get_template_part('template-parts/home/cta');

get_footer();
