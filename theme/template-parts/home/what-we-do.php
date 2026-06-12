<?php
$media = get_template_directory_uri() . '/assets/media/cards/';

// Left col (text-top): teal [0] + yellow [2]
// Right col (img-top, staggered): green [1] + orange [3]
$cards = [
    [ 'color' => '#5AD3ED', 'title' => tnl_t('card1_title'), 'desc' => tnl_t('card1_desc'), 'link' => tnl_url('our-services/for-manager'),       'img' => $media . 'business.jpg',    'img_alt' => 'Business Programs',            'pb' => 64,  'pt' => 0   ],
    [ 'color' => '#AFE56B', 'title' => tnl_t('card2_title'), 'desc' => tnl_t('card2_desc'), 'link' => tnl_url('our-services/individual-courses'), 'img' => $media . 'individuals.jpg', 'img_alt' => 'Individuals Programs',         'pb' => 0,   'pt' => 224 ],
    [ 'color' => '#FFC75A', 'title' => tnl_t('card3_title'), 'desc' => tnl_t('card3_desc'), 'link' => tnl_url('products'),                       'img' => $media . 'creative.png',    'img_alt' => 'Creative Innovative Products', 'pb' => 128, 'pt' => 0   ],
    [ 'color' => '#FF7C33', 'title' => tnl_t('card4_title'), 'desc' => tnl_t('card4_desc'), 'link' => tnl_url('events'),                         'img' => $media . 'supportive.jpg',  'img_alt' => 'Supportive Community',         'pb' => 0,   'pt' => 128 ],
];
$left_cards  = [ $cards[0], $cards[2] ];
$right_cards = [ $cards[1], $cards[3] ];
?>

<section class="what-we-do" id="what-we-do">

  <!-- Watermark heading: overlapping layout (khớp live) -->
  <h2 class="what-we-do__bg-title" aria-hidden="true"><?php echo tnl_t('wwd_title'); ?></h2>

  <!-- Description + pills: positioned above/overlapping H2 -->
  <div class="what-we-do__content">
    <div class="what-we-do__content-inner">
      <p class="what-we-do__desc"><?php echo tnl_t('wwd_desc'); ?></p>
      <div class="what-we-do__pills">
        <span class="wwd-pill" style="background:#5AD3ED"><?php echo tnl_t('wwd_pill1'); ?></span>
        <span class="wwd-pill" style="background:#AFE56B"><?php echo tnl_t('wwd_pill2'); ?></span>
        <span class="wwd-pill" style="background:#FFC75A"><?php echo tnl_t('wwd_pill3'); ?></span>
        <span class="wwd-pill" style="background:#FF9B52"><?php echo tnl_t('wwd_pill4'); ?></span>
      </div>
    </div>
  </div>

  <!-- 2-col grid: khớp live site layout -->
  <div class="wwd-grid">

    <!-- Left column: colored block TOP, image BOTTOM -->
    <div class="wwd-col">
      <?php foreach ( $left_cards as $card ) : ?>
        <div class="wwd-group">
          <div class="wwd-group__card" style="background:<?php echo esc_attr( $card['color'] ); ?><?php echo $card['pb'] ? ';padding-bottom:' . $card['pb'] . 'px' : ''; ?>">
            <p class="wwd-group__title"><?php echo esc_html( $card['title'] ); ?></p>
            <p class="wwd-group__body"><?php echo esc_html( $card['desc'] ); ?></p>
            <a href="<?php echo esc_url( $card['link'] ); ?>" class="wwd-group__btn"><?php echo tnl_t('wwd_learn_more'); ?></a>
          </div>
          <div class="wwd-group__img">
            <img src="<?php echo esc_url( $card['img'] ); ?>" alt="<?php echo esc_attr( $card['img_alt'] ); ?>" loading="lazy">
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- Right column: image TOP, colored block BOTTOM (staggered offset) -->
    <div class="wwd-col">
      <?php foreach ( $right_cards as $card ) : ?>
        <div class="wwd-group wwd-group--img-top">
          <div class="wwd-group__img">
            <img src="<?php echo esc_url( $card['img'] ); ?>" alt="<?php echo esc_attr( $card['img_alt'] ); ?>" loading="lazy">
          </div>
          <div class="wwd-group__card" style="background:<?php echo esc_attr( $card['color'] ); ?><?php echo $card['pt'] ? ';padding-top:' . $card['pt'] . 'px;margin-top:-' . $card['pt'] . 'px' : ''; ?>">
            <p class="wwd-group__title"><?php echo esc_html( $card['title'] ); ?></p>
            <p class="wwd-group__body"><?php echo esc_html( $card['desc'] ); ?></p>
            <a href="<?php echo esc_url( $card['link'] ); ?>" class="wwd-group__btn"><?php echo tnl_t('wwd_learn_more'); ?></a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </div><!-- /.wwd-grid -->

</section>
