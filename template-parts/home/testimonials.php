<?php
$s3 = get_template_directory_uri() . '/assets/media/testimonials/';
$testimonials_data = [
    [ 'name' => 'Nguyễn Đức Dũng', 'role' => tnl_t('t1_role'), 'img' => $s3 . 'Dung_Nguyen_b9f57f0504.jpg',      'quote' => tnl_t('t1_quote') ],
    [ 'name' => 'Hoàng Việt Dũng', 'role' => tnl_t('t4_role'), 'img' => $s3 . 'Hoang_Viet_Dung_e24a4efcb1.png','quote' => tnl_t('t4_quote') ],
    [ 'name' => 'Kris van Daele',  'role' => tnl_t('t2_role'), 'img' => $s3 . 'Kris_van_Daele_fceb0b5f8f.png',  'quote' => tnl_t('t2_quote') ],
    [ 'name' => 'Barry Weisblatt', 'role' => tnl_t('t6_role'), 'img' => $s3 . 'barry_2ae1594a47.png',           'quote' => tnl_t('t6_quote') ],
    [ 'name' => 'Peter Mayer',     'role' => tnl_t('t5_role'), 'img' => $s3 . 'Peter_Mayer_a0d8b8ecd5.png',     'quote' => tnl_t('t5_quote') ],
];
?>

<section class="testimonials" id="testimonials">
  <div class="testimonials__inner">

    <h2 class="testimonials__title"><?php echo tnl_t('tm_title'); ?></h2>

    <div class="testimonials__list">
      <?php foreach ($testimonials_data as $i => $t) :
        $img_right = ($i % 2 === 0); // 1st, 3rd, 5th: img right; 2nd, 4th, 6th: img left
        $card_cls  = $img_right ? 'tcard tcard--img-right' : 'tcard tcard--img-left';
      ?>
        <article class="<?php echo $card_cls; ?>">
          <div class="tcard__body">
            <strong class="tcard__name"><?php echo esc_html($t['name']); ?></strong>
            <p class="tcard__role"><?php echo esc_html($t['role']); ?></p>
            <p class="tcard__quote"><?php echo esc_html($t['quote']); ?></p>
          </div>
          <div class="tcard__img-wrap">
            <img class="tcard__img" src="<?php echo esc_url($t['img']); ?>" alt="<?php echo esc_attr($t['name']); ?>" loading="lazy">
          </div>
        </article>
      <?php endforeach; ?>
    </div>

  </div>
</section>
