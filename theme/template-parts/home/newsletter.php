<section class="newsletter" id="newsletter">
  <div class="container">
    <div class="newsletter__inner">
      <div class="newsletter__header">
        <p class="newsletter__title"><?php echo tnl_t('nl_title'); ?></p>
        <!-- Decorative hand-drawn lasso arrow (matches live site: oval loop + knot on left + tail going down-right) -->
        <svg class="newsletter__curly-arrow" width="100" height="140" viewBox="0 0 90 130" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M 12 34 C 10 14, 28 4, 48 4 C 68 4, 80 20, 78 36 C 76 52, 60 62, 42 58 C 24 54, 12 40, 14 34 C 14 44, 22 52, 32 48 C 50 42, 82 52, 86 72 C 88 88, 78 108, 68 122" stroke="white" stroke-width="2.2" stroke-linecap="round" fill="none"/>
          <path d="M 59 115 L 68 125 L 77 115" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </svg>
      </div>
      <form class="newsletter__form tnl-ajax-form" action="#" method="post" data-form-type="Newsletter (Home)">

        <div class="newsletter__row">
          <label class="newsletter__label" for="nl-name"><?php echo tnl_t('nl_name'); ?></label>
          <input type="text" id="nl-name" name="name" required class="newsletter__input">
        </div>
        <div class="newsletter__row">
          <label class="newsletter__label" for="nl-email"><?php echo tnl_t('nl_email'); ?></label>
          <input type="email" id="nl-email" name="email" required class="newsletter__input">
        </div>
        <button type="submit" class="newsletter__submit">
          <span><?php echo tnl_t('nl_submit'); ?></span>
          <svg class="newsletter__arrow" width="22" height="22" viewBox="0 0 24 24" fill="none" aria-hidden="true">
            <path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
        </button>
      </form>
    </div>
  </div>
</section>
