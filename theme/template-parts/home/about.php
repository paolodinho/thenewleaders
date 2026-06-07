<section class="about section" id="about">

  <!-- Header: title + mission -->
  <div class="about__header">
    <h2 class="about__title"><?php echo tnl_t('about_title'); ?></h2>
    <p class="about__mission"><?php echo tnl_t('about_mission'); ?></p>
    <div class="about__ctas">
      <a href="#what-we-do" class="btn btn--primary"><?php echo tnl_t('hero_btn1'); ?></a>
      <a href="#what-we-do" class="btn btn--outline-dark"><?php echo tnl_t('hero_btn2'); ?></a>
    </div>
  </div>

  <!-- Numbered points: watermark number + full-width colored card, alternating -->
  <div class="about__items">

    <div class="about__item about__item--teal">
      <div class="about__num-wrap about__num-wrap--right"><span class="about__num">01</span></div>
      <p class="about__point"><?php echo tnl_t('about_p1'); ?></p>
    </div>

    <div class="about__item about__item--green about__item--alt">
      <div class="about__num-wrap about__num-wrap--left"><span class="about__num">02</span></div>
      <p class="about__point"><?php echo tnl_t('about_p2'); ?></p>
    </div>

    <div class="about__item about__item--yellow">
      <div class="about__num-wrap about__num-wrap--right"><span class="about__num">03</span></div>
      <p class="about__point"><?php echo tnl_t('about_p3'); ?></p>
    </div>

    <div class="about__item about__item--orange about__item--alt">
      <div class="about__num-wrap about__num-wrap--left"><span class="about__num">04</span></div>
      <p class="about__point"><?php echo tnl_t('about_p4'); ?></p>
    </div>

  </div>

</section>
