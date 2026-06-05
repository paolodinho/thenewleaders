<?php
/** Trang chi tiết sự kiện (CPT event) — /su-kien/{slug} */
get_header();
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
while (have_posts()) : the_post();
    $id   = get_the_ID();
    $date = get_post_meta($id, '_tnl_event_date', true);
    $loc  = get_post_meta($id, '_tnl_event_location', true);
    $reg  = get_post_meta($id, '_tnl_event_register', true);
    $title = function_exists('tnl_event_title') ? tnl_event_title($id) : get_the_title();
    if ($vi) {
        $date_vi = get_post_meta($id, '_tnl_event_date_vi', true);
        $loc_vi  = get_post_meta($id, '_tnl_event_location_vi', true);
        if ($date_vi) { $date = $date_vi; }
        if ($loc_vi)  { $loc  = $loc_vi; }
    }
    $body_vi = $vi ? get_post_meta($id, '_tnl_event_body_vi', true) : '';
?>
<main class="site-main page-event-single">
  <article class="ev-single">
    <div class="container ev-single__inner">

      <a href="<?php echo esc_url(tnl_url('events')); ?>" class="ev-single__back"><?php echo esc_html($vi ? '← Tất cả sự kiện' : '← All events'); ?></a>

      <h1 class="ev-single__title"><?php echo esc_html($title); ?></h1>

      <?php if ($date || $loc) : ?>
        <p class="ev-single__meta">
          <?php if ($date) : ?><span class="ev-single__metaitem"><strong><?php echo esc_html($vi ? 'Thời gian:' : 'When:'); ?></strong> <?php echo esc_html($date); ?></span><?php endif; ?>
          <?php if ($loc) : ?><span class="ev-single__metaitem"><strong><?php echo esc_html($vi ? 'Địa điểm:' : 'Where:'); ?></strong> <?php echo esc_html($loc); ?></span><?php endif; ?>
        </p>
      <?php endif; ?>

      <?php if (has_post_thumbnail()) : ?>
        <figure class="ev-single__fig"><?php the_post_thumbnail('large'); ?></figure>
      <?php endif; ?>

      <div class="ev-single__body"><?php
        if ($body_vi) { echo wp_kses_post($body_vi); }
        else { the_content(); }
      ?></div>

      <?php if ($reg) : ?>
        <a href="<?php echo esc_url($reg); ?>" target="_blank" rel="noopener noreferrer" class="btn btn--primary ev-single__reg"><?php echo esc_html($vi ? 'Đăng ký tham gia' : 'Register now'); ?></a>
      <?php endif; ?>

    </div>
  </article>
</main>
<?php
endwhile;
get_template_part('template-parts/home/cta');
get_footer();
