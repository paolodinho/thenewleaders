<section class="newsletter" id="newsletter">
  <div class="container">
    <div class="newsletter__inner">
      <div class="newsletter__header">
        <p class="newsletter__title"><?php echo tnl_t('nl_title'); ?></p>
        <!-- Decorative hand-drawn looping arrow (matches live site) -->
        <svg class="newsletter__curly-arrow" width="90" height="115" viewBox="0 0 90 115" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
          <path d="M52 18 C72 5, 82 35, 68 52 C54 68, 28 62, 22 44 C16 26, 32 10, 52 22 C54 24, 55 30, 52 45 C48 65, 40 85, 34 98" stroke="white" stroke-width="2.2" stroke-linecap="round" fill="none"/>
          <path d="M26 93 L 34 100 L 43 93" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
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
