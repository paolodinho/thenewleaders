<?php
$s3 = get_template_directory_uri() . '/assets/media/testimonials/';
$testimonials_data = [
    [
        'name'  => 'Nguyễn Đức Dũng',
        'role'  => 'Head of Business - Boehringer Ingelheim Vietnam',
        'img'   => $s3 . 'Dung_Nguyen_b9f57f0504.jpg',
        'quote' => 'Leaders greatly benefit from understanding emotional management, as mastering one\'s own emotions and listening effectively can significantly ease the journey of life.',
        'align' => 'left',
    ],
    [
        'name'  => 'Kris van Daele',
        'role'  => 'Operations Director - De Heus Vietnam',
        'img'   => $s3 . 'Kris_van_Daele_fceb0b5f8f.png',
        'quote' => 'Developing from junior managers to senior managers is a long growing path. We reached out to The New Leaders who provide customized training in EQ management to grow our team. Supported by their experience, 3 of our teams have learned to know their inner person, the inner person of their coworkers and build trust within the team. Understanding each other\'s emotions better helped the teams to grow and elaborate more. A journey that took months and is still ongoing, but certainly worth every minute!',
        'align' => 'right',
    ],
    [
        'name'  => 'Pham Thi Hoai',
        'role'  => 'HR Director - T.A Viet Nam',
        'img'   => $s3 . 'Mask_group_1_f1230bcabc.png',
        'quote' => 'Emotional Intelligence (EQ) is pivotal for business success today, regardless of size. The New Leaders\' workshop has boosted EQ and leadership skills among managers and leaders, fostering strong, competitive leadership within our organization.',
        'align' => 'left',
    ],
    [
        'name'  => 'Hoang Viet Dung',
        'role'  => 'Director - Grant Thornton Vietnam',
        'img'   => $s3 . 'Hoang_Viet_Dung_e24a4efcb1.png',
        'quote' => 'The New Leaders course holds immense value because leaders in higher positions face increased demands for emotional intelligence skills. Being conscious of this fact is essential for optimal performance.',
        'align' => 'right',
    ],
    [
        'name'  => 'Peter Mayer',
        'role'  => 'Former CEO Lodgis Hospitality Holdings, Former CEO Fusion Resorts & Hotels, Former CEO Sofitel Legend Metropole Hanoi, MBA Harvard',
        'img'   => $s3 . 'Peter_Mayer_a0d8b8ecd5.png',
        'quote' => 'What separates successful Leaders and Managers are not THEIR technical COMPETENCE, but the ability to connect to their people. Of course, CEO\'s often have great strategic thinking and financial skills, but it is their sharp EQ that drives their organizations. The executive coaching from The New Leaders develop and hone this essential capability.',
        'align' => 'left',
    ],
    [
        'name'  => 'Barry Weisblatt',
        'role'  => 'Head of Research Department at VNDIRECT Securities Corporation',
        'img'   => $s3 . 'barry_2ae1594a47.png',
        'quote' => 'Ngan has really helped me to be a better leader. She is a great listener and draws upon a wealth of knowledge and experience to offer insightful, practical advice to guide me in facing problems and inspiring my team to perform and develop.',
        'align' => 'right',
    ],
];

$use_wp = false; // WP testimonial posts have placeholder data; use hardcoded fallback
?>

<section class="testimonials" id="testimonials">

  <h2 class="testimonials__title">Our leaders say about<br>the experience</h2>

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
