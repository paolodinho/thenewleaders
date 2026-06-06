<?php
$media = get_template_directory_uri() . '/assets/media/cards/';

$cards = [
    [
        'color'  => '#5AD3ED',
        'btn_dark' => false,
        'title'  => 'Business Programs:',
        'desc'   => 'We customize EQ leadership & communication training programs for business leaders and their team members.',
        'link'   => '#',
        'img'    => $media . 'business.jpg',
        'img_alt'=> 'Business Programs',
    ],
    [
        'color'  => '#AFE56B',
        'btn_dark' => false,
        'title'  => 'Individuals programs:',
        'desc'   => 'We support leaders to advance their communication skills to world-class standard.',
        'link'   => '#',
        'img'    => $media . 'individuals.jpg',
        'img_alt'=> 'Individuals Programs',
    ],
    [
        'color'  => '#FFC75A',
        'btn_dark' => false,
        'title'  => 'Creative innovative products:',
        'desc'   => 'We create creative educational & technology / AI products to support business and individual transformation.',
        'link'   => '#',
        'img'    => $media . 'creative.png',
        'img_alt'=> 'Creative Innovative Products',
    ],
    [
        'color'  => '#FF4B1F',
        'btn_dark' => true,
        'title'  => 'Supportive community:',
        'desc'   => 'We encourage leaders to share their expertise and inspire others to create supportive environment.',
        'link'   => '#',
        'img'    => $media . 'supportive.jpg',
        'img_alt'=> 'Supportive Community',
    ],
];
?>

<section class="what-we-do" id="what-we-do">

  <!-- Header: watermark title + description + pills -->
  <div class="what-we-do__header">
    <div class="what-we-do__bg-title" aria-hidden="true">What<br>we do</div>
    <div class="what-we-do__header-content">
      <p class="what-we-do__desc">Emotional Intelligence Leadership Training with frameworks from worldwide accredited leadership programs of <strong>Harvard Kennedy School and Oxford University.</strong></p>
      <div class="what-we-do__pills">
        <span class="wwd-pill" style="background:#5AD3ED">Practical.</span>
        <span class="wwd-pill" style="background:#AFE56B">People-centered.</span>
        <span class="wwd-pill" style="background:#FFC75A">Innovative.</span>
        <span class="wwd-pill" style="background:#FF9B52">Enduring impact</span>
      </div>
    </div>
  </div>

  <!-- Cards section heading -->
  <div class="what-we-do__cards-head">
    <div class="what-we-do__cards-headline">
      <span class="what-we-do__eyebrow">What we offer</span>
      <h3 class="what-we-do__cards-title">Our Services &amp; Products</h3>
    </div>
    <p class="what-we-do__cards-note">Four ways we partner with leaders and teams to create lasting impact.</p>
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
          <a href="<?php echo esc_url($card['link']); ?>" class="wwd-row__btn <?php echo $card['btn_dark'] ? 'wwd-row__btn--dark' : ''; ?>">Learn more</a>
        </div>

        <div class="wwd-row__img">
          <img src="<?php echo esc_url($card['img']); ?>" alt="<?php echo esc_attr($card['img_alt']); ?>" loading="lazy">
        </div>

      </div>
    <?php endforeach; ?>
  </div>

</section>
