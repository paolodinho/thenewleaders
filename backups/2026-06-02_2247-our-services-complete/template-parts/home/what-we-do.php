<?php
$media = get_template_directory_uri() . '/assets/media/cards/';

$cards = [
    [ 'color' => '#5AD3ED', 'btn_dark' => false, 'title' => tnl_t('card1_title'), 'desc' => tnl_t('card1_desc'), 'link' => '#', 'img' => $media . 'business.jpg',    'img_alt' => 'Business Programs' ],
    [ 'color' => '#AFE56B', 'btn_dark' => false, 'title' => tnl_t('card2_title'), 'desc' => tnl_t('card2_desc'), 'link' => '#', 'img' => $media . 'individuals.jpg', 'img_alt' => 'Individuals Programs' ],
    [ 'color' => '#FFC75A', 'btn_dark' => false, 'title' => tnl_t('card3_title'), 'desc' => tnl_t('card3_desc'), 'link' => '#', 'img' => $media . 'creative.png',    'img_alt' => 'Creative Innovative Products' ],
    [ 'color' => '#FF4B1F', 'btn_dark' => true,  'title' => tnl_t('card4_title'), 'desc' => tnl_t('card4_desc'), 'link' => '#', 'img' => $media . 'supportive.jpg',  'img_alt' => 'Supportive Community' ],
];
?>

<section class="what-we-do" id="what-we-do">

  <!-- Header: watermark title + description + pills -->
  <div class="what-we-do__header">
    <div class="what-we-do__bg-title" aria-hidden="true"><?php echo tnl_t('wwd_title'); ?></div>
    <div class="what-we-do__header-content">
      <p class="what-we-do__desc"><?php echo tnl_t('wwd_desc'); ?></p>
      <div class="what-we-do__pills">
        <span class="wwd-pill" style="background:#5AD3ED"><?php echo tnl_t('wwd_pill1'); ?></span>
        <span class="wwd-pill" style="background:#AFE56B"><?php echo tnl_t('wwd_pill2'); ?></span>
        <span class="wwd-pill" style="background:#FFC75A"><?php echo tnl_t('wwd_pill3'); ?></span>
        <span class="wwd-pill" style="background:#FF9B52"><?php echo tnl_t('wwd_pill4'); ?></span>
      </div>
    </div>
  </div>

  <!-- Offer block: dải nền riêng để tách khỏi phần intro phía trên -->
  <div class="what-we-do__offer">

  <!-- Cards section heading -->
  <div class="what-we-do__cards-head">
    <div class="what-we-do__cards-headline">
      <span class="what-we-do__eyebrow"><?php echo tnl_t('wwd_offer_eyebrow'); ?></span>
      <h3 class="what-we-do__cards-title"><?php echo tnl_t('wwd_offer_title'); ?></h3>
    </div>
    <p class="what-we-do__cards-note"><?php echo tnl_t('wwd_offer_note'); ?></p>
  </div>

  <!-- Cards: alternating text+image layout -->
  <div class="what-we-do__cards">
    <?php foreach ($cards as $i => $card) :
      $reversed = ($i % 2 === 1); // even = text left, odd = text right
    ?>
      <div class="wwd-row <?php echo $reversed ? 'wwd-row--reversed' : ''; ?>">

        <div class="wwd-row__text" style="background:<?php echo esc_attr($card['color']); ?>">
          <h3 class="wwd-row__title"><?php echo esc_html($card['title']); ?></h3>
          <p class="wwd-row__desc"><?php echo esc_html($card['desc']); ?></p>
          <a href="<?php echo esc_url($card['link']); ?>" class="wwd-row__btn <?php echo $card['btn_dark'] ? 'wwd-row__btn--dark' : ''; ?>"><?php echo tnl_t('wwd_learn_more'); ?></a>
        </div>

        <div class="wwd-row__img">
          <img src="<?php echo esc_url($card['img']); ?>" alt="<?php echo esc_attr($card['img_alt']); ?>" loading="lazy">
        </div>

      </div>
    <?php endforeach; ?>
  </div>

  </div><!-- /.what-we-do__offer -->

</section>
