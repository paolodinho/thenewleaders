<?php
/** Blog post detail — /blog/{slug} (tái dùng style .ev-single) */
get_header();
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
while (have_posts()) : the_post();
?>
<main class="site-main page-event-single">
  <article class="ev-single">
    <div class="container ev-single__inner">
      <a href="<?php echo esc_url(tnl_url('resources')); ?>" class="ev-single__back"><?php echo esc_html($vi ? '← Tất cả bài viết' : '← All articles'); ?></a>
      <h1 class="ev-single__title"><?php the_title(); ?></h1>
      <p class="ev-single__meta"><span class="ev-single__metaitem"><?php echo esc_html(get_the_date('d/m/Y')); ?></span></p>
      <?php if (has_post_thumbnail()) : ?>
        <figure class="ev-single__fig"><?php the_post_thumbnail('large'); ?></figure>
      <?php endif; ?>
      <div class="ev-single__body"><?php the_content(); ?></div>
    </div>
  </article>
</main>
<?php
endwhile;
get_template_part('template-parts/home/cta');
get_footer();
