<?php
$video_url = get_template_directory_uri() . '/assets/media/video/tnl_motion_cd69f63c5f.mp4';
?>

<section class="hero" id="hero">
  <video class="hero__video" autoplay muted loop playsinline>
    <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
  </video>

  <div class="hero__controls">
    <button class="hero__mute-btn" aria-label="Unmute video">
      <svg class="icon-muted" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
        <line x1="23" y1="9" x2="17" y2="15"/><line x1="17" y1="9" x2="23" y2="15"/>
      </svg>
      <svg class="icon-unmuted" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="display:none">
        <polygon points="11 5 6 9 2 9 2 15 6 15 11 19 11 5"/>
        <path d="M19.07 4.93a10 10 0 0 1 0 14.14M15.54 8.46a5 5 0 0 1 0 7.07"/>
      </svg>
      <span><?php echo tnl_t('hero_unmute'); ?></span>
    </button>
    <a href="#what-we-help" class="hero__skip-btn">
      <?php echo tnl_t('hero_skip'); ?>
      <svg width="16" height="16" viewBox="0 0 16 16" fill="none" aria-hidden="true"><path d="M3 8h10M9 4l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
    </a>
  </div>
</section>

<!-- Hero CTA — orange gradient section immediately after video -->
<section class="hero-cta" id="hero-cta">
  <div class="hero-cta__inner">
    <p class="hero-cta__tagline"><?php echo tnl_t('hero_tagline'); ?></p>
    <div class="hero-cta__btns">
      <a href="#what-we-do" class="hero-cta__btn"><?php echo tnl_t('hero_btn1'); ?></a>
      <a href="#what-we-do" class="hero-cta__btn hero-cta__btn--outline"><?php echo tnl_t('hero_btn2'); ?></a>
    </div>
  </div>
</section>
