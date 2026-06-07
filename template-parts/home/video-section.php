<?php
/**
 * Video testimonial section — full-height video bg + overlay + play button + 2 CTAs
 * Matches live: https://thenewleaders.asia/vi — section i=9 (h=798, calc(100vh-100px))
 */
$video_url  = 'https://bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com/workshop_0710_efa5faf9ea.mp4';
$poster_url = 'https://bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com/workshop_4e15cbd0b3.jpg';
?>
<section class="video-section" id="video-section">

  <!-- Background video -->
  <video class="video-section__video"
         muted loop playsinline
         poster="<?php echo esc_url($poster_url); ?>">
    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
  </video>

  <!-- Dark overlay + content -->
  <div class="video-section__overlay">
    <div class="video-section__content">

      <!-- Play/pause button -->
      <button class="video-section__play" aria-label="Play video">
        <svg width="44" height="50" viewBox="0 0 44 50" fill="white" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M42.5774 22.9379C43.9107 23.7077 43.9107 25.6322 42.5774 26.402L3.60955 48.9003C2.27622 49.6702 0.609556 48.7079 0.609556 47.1683L0.609558 2.17173C0.609558 0.632107 2.27623 -0.330193 3.60956 0.439707L42.5774 22.9379Z"/>
        </svg>
      </button>

      <!-- Title -->
      <p class="video-section__title"><?php echo tnl_t('tm_title'); ?></p>

      <!-- CTA buttons -->
      <div class="video-section__btns">
        <a href="/our-services#business-programs" class="video-section__btn"><?php echo tnl_t('hero_btn1'); ?></a>
        <a href="/our-services#individual-programs" class="video-section__btn video-section__btn--outline"><?php echo tnl_t('hero_btn2'); ?></a>
      </div>

    </div>
  </div>

</section>
