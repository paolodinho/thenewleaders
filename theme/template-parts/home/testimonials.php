<?php
$s3 = get_template_directory_uri() . '/assets/media/testimonials/';
$testimonials_data = [
    [ 'name' => 'Nguyễn Đức Dũng', 'role' => tnl_t('t1_role'), 'img' => $s3 . 'Dung_Nguyen_b9f57f0504.jpg',  'quote' => tnl_t('t1_quote') ],
    [ 'name' => 'Kris van Daele',  'role' => tnl_t('t2_role'), 'img' => $s3 . 'Kris_van_Daele_fceb0b5f8f.png','quote' => tnl_t('t2_quote') ],
    [ 'name' => 'Phạm Thị Hoài',   'role' => tnl_t('t3_role'), 'img' => $s3 . 'Mask_group_1_f1230bcabc.png', 'quote' => tnl_t('t3_quote') ],
    [ 'name' => 'Hoàng Việt Dũng', 'role' => tnl_t('t4_role'), 'img' => $s3 . 'Hoang_Viet_Dung_e24a4efcb1.png','quote' => tnl_t('t4_quote') ],
    [ 'name' => 'Peter Mayer',     'role' => tnl_t('t5_role'), 'img' => $s3 . 'Peter_Mayer_a0d8b8ecd5.png',   'quote' => tnl_t('t5_quote') ],
    [ 'name' => 'Barry Weisblatt', 'role' => tnl_t('t6_role'), 'img' => $s3 . 'barry_2ae1594a47.png',        'quote' => tnl_t('t6_quote') ],
];
?>

<section class="testimonials" id="testimonials">

  <h2 class="testimonials__title"><?php echo tnl_t('tm_title'); ?></h2>

  <div class="testimonials__grid">
    <?php foreach ($testimonials_data as $t) : ?>
      <article class="tcard">
        <p class="tcard__quote"><?php echo esc_html($t['quote']); ?></p>
        <div class="tcard__head">
          <img class="tcard__img" src="<?php echo esc_url($t['img']); ?>" alt="<?php echo esc_attr($t['name']); ?>" loading="lazy">
          <div class="tcard__meta">
            <strong class="tcard__name"><?php echo esc_html($t['name']); ?></strong>
            <span class="tcard__role"><?php echo esc_html($t['role']); ?></span>
          </div>
        </div>
      </article>
    <?php endforeach; ?>
  </div>

</section>
