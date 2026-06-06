<?php
$s3 = get_template_directory_uri() . '/assets/media/testimonials/';
$testimonials_data = [
    [ 'name' => 'Nguyễn Đức Dũng', 'role' => tnl_t('t1_role'), 'img' => $s3 . 'Dung_Nguyen_b9f57f0504.jpg',  'quote' => tnl_t('t1_quote'), 'align' => 'left' ],
    [ 'name' => 'Kris van Daele',  'role' => tnl_t('t2_role'), 'img' => $s3 . 'Kris_van_Daele_fceb0b5f8f.png','quote' => tnl_t('t2_quote'), 'align' => 'right' ],
    [ 'name' => 'Phạm Thị Hoài',   'role' => tnl_t('t3_role'), 'img' => $s3 . 'Mask_group_1_f1230bcabc.png', 'quote' => tnl_t('t3_quote'), 'align' => 'left' ],
    [ 'name' => 'Hoàng Việt Dũng', 'role' => tnl_t('t4_role'), 'img' => $s3 . 'Hoang_Viet_Dung_e24a4efcb1.png','quote' => tnl_t('t4_quote'), 'align' => 'right' ],
    [ 'name' => 'Peter Mayer',     'role' => tnl_t('t5_role'), 'img' => $s3 . 'Peter_Mayer_a0d8b8ecd5.png',   'quote' => tnl_t('t5_quote'), 'align' => 'left' ],
    [ 'name' => 'Barry Weisblatt', 'role' => tnl_t('t6_role'), 'img' => $s3 . 'barry_2ae1594a47.png',        'quote' => tnl_t('t6_quote'), 'align' => 'right' ],
];

$use_wp = false; // WP testimonial posts have placeholder data; use hardcoded fallback
?>

<section class="testimonials" id="testimonials">

  <h2 class="testimonials__title"><?php echo tnl_t('tm_title'); ?></h2>

  <div class="testimonials__list">
    <?php if ($use_wp) :
      $i = 0;
      while ($wp_query->have_posts()) : $wp_query->the_post();
        $align = ($i % 2 === 0) ? 'left' : 'right';
      ?>
        <div class="trow trow--<?php echo $align; ?>">
          <?php if ($align === 'left') : ?>
            <div class="trow__content">
              <strong class="trow__name"><?php the_title(); ?></strong>
              <span class="trow__role"><?php echo esc_html(get_post_meta(get_the_ID(), '_role', true)); ?></span>
              <p class="trow__quote"><?php the_excerpt(); ?></p>
            </div>
            <div class="trow__photo">
              <?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail', ['class' => 'trow__img']); ?>
            </div>
          <?php else : ?>
            <div class="trow__photo">
              <?php if (has_post_thumbnail()) the_post_thumbnail('thumbnail', ['class' => 'trow__img']); ?>
            </div>
            <div class="trow__content trow__content--right">
              <strong class="trow__name"><?php the_title(); ?></strong>
              <span class="trow__role"><?php echo esc_html(get_post_meta(get_the_ID(), '_role', true)); ?></span>
              <p class="trow__quote"><?php the_excerpt(); ?></p>
            </div>
          <?php endif; ?>
        </div>
      <?php $i++; endwhile;
      wp_reset_postdata();

    else :
      foreach ($testimonials_data as $t) :
        $align = $t['align'];
      ?>
        <div class="trow trow--<?php echo esc_attr($align); ?>">
          <?php if ($align === 'left') : ?>
            <div class="trow__content">
              <strong class="trow__name"><?php echo esc_html($t['name']); ?></strong>
              <span class="trow__role"><?php echo esc_html($t['role']); ?></span>
              <p class="trow__quote"><?php echo esc_html($t['quote']); ?></p>
            </div>
            <div class="trow__photo">
              <img class="trow__img" src="<?php echo esc_url($t['img']); ?>" alt="<?php echo esc_attr($t['name']); ?>" loading="lazy">
            </div>
          <?php else : ?>
            <div class="trow__photo">
              <img class="trow__img" src="<?php echo esc_url($t['img']); ?>" alt="<?php echo esc_attr($t['name']); ?>" loading="lazy">
            </div>
            <div class="trow__content trow__content--right">
              <strong class="trow__name"><?php echo esc_html($t['name']); ?></strong>
              <span class="trow__role"><?php echo esc_html($t['role']); ?></span>
              <p class="trow__quote"><?php echo esc_html($t['quote']); ?></p>
            </div>
          <?php endif; ?>
        </div>
      <?php endforeach;
    endif; ?>
  </div>

</section>
