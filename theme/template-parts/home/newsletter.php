<section class="newsletter" id="newsletter">
  <div class="container">
    <div class="newsletter__inner">
      <p class="newsletter__title"><?php echo tnl_t('nl_title'); ?></p>
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
