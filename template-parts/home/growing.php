<?php
$s3 = get_template_directory_uri() . '/assets/media/growing/';
$posts_fallback = [
    ['img' => $s3 . 'banner1_cbb5d66449.jpg',           'title' => 'The Strategic Interview: Seeing the Real Potential Behind the Professional Veneer'],
    ['img' => $s3 . 'Artboard_2_copy_2a_abe44dc06d.png', 'title' => 'Communication Excellence for High-Performing Teams'],
    ['img' => $s3 . 'banner_landinpage_ae5d94680e.png',  'title' => 'EmpowerHER - Enriching Communication with Grace'],
    ['img' => $s3 . 'Banner_FB_2400x1256_f7107b051b.png','title' => 'TopCV Insights #36: Bond & Beyond'],
    ['img' => $s3 . 'Brochure_WS_Women_1_5865264f4c.png','title' => 'EQ for Finance: Từ Lý Trí Đến Sức Ảnh Hưởng'],
    ['img' => $s3 . 'Brochure_WS_Women_23aed5f1dd.png',  'title' => 'The True Well-being'],
    ['img' => $s3 . 'The_EQ_KV_128d813ebd.jpg',         'title' => 'Leading with EQ: How HR can future-proof Finance Teams?'],
    ['img' => $s3 . 'workshop_4e15cbd0b3.jpg',           'title' => 'Who takes care of the people who lead people?'],
];

// Ưu tiên Events CPT (khách tự quản lý ở admin → Sự kiện): sắp theo Thứ tự (menu_order)
$posts_query = new WP_Query([
    'post_type'      => 'event',
    'posts_per_page' => -1,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
$use_wp = $posts_query->have_posts();
?>

<section class="growing" id="growing">
  <div class="growing__inner">

    <div class="growing__header">
      <h2 class="growing__title"><?php echo tnl_t('growing_title'); ?></h2>
      <p class="growing__desc"><?php echo tnl_t('growing_desc'); ?></p>
    </div>

    <div class="growing__track-wrap">
      <button class="growing__arrow growing__arrow--prev" id="growingPrev" aria-label="Previous">&#8592;</button>
      <button class="growing__arrow growing__arrow--next" id="growingNext" aria-label="Next">&#8594;</button>
      <div class="growing__track" id="growingTrack">

        <?php if ($use_wp) :
          while ($posts_query->have_posts()) : $posts_query->the_post();
            $ev_link = get_post_meta(get_the_ID(), '_tnl_event_link', true);
            if (!$ev_link) $ev_link = get_permalink(); ?>
            <a class="growing__item" href="<?php echo esc_url($ev_link); ?>">
              <?php if (has_post_thumbnail()) : ?>
                <div class="growing__item-img"><?php the_post_thumbnail('medium_large'); ?></div>
              <?php endif; ?>
              <p class="growing__item-title"><?php echo esc_html(function_exists('tnl_event_title') ? tnl_event_title() : get_the_title()); ?></p>
            </a>
          <?php endwhile;
          wp_reset_postdata();

        else :
          foreach ($posts_fallback as $p) : ?>
            <a class="growing__item" href="<?php echo esc_url(tnl_url('resources')); ?>">
              <div class="growing__item-img">
                <img src="<?php echo esc_url($p['img']); ?>" alt="<?php echo esc_attr($p['title']); ?>" loading="lazy">
              </div>
              <p class="growing__item-title"><?php echo esc_html($p['title']); ?></p>
            </a>
          <?php endforeach;
        endif; ?>

      </div><!-- .growing__track -->
    </div><!-- .growing__track-wrap -->

    <!-- Nav buttons are now inside .growing__track-wrap as .growing__arrow elements -->

  </div>
</section>
