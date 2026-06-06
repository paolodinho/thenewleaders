<section class="newsletter" id="newsletter">
  <div class="container">
    <div class="newsletter__inner">
      <p class="newsletter__title"><?php echo tnl_t('nl_title'); ?></p>
      <form class="newsletter__form" action="#" method="post">
        <?php wp_nonce_field('tnl_newsletter', 'tnl_newsletter_nonce'); ?>
        <div class="newsletter__row">
          <label class="newsletter__label" for="nl-name"><?php echo tnl_t('nl_name'); ?></label>
          <input type="text" id="nl-name" name="name" required class="newsletter__input">
        </div>
        <div class="newsletter__row">
          <label class="newsletter__label" for="nl-email"><?php echo tnl_t('nl_email'); ?></label>
          <input type="email" id="nl-email" name="email" required class="newsletter__input">
        </div>
        <button type="submit" class="newsletter__submit"><?php echo tnl_t('nl_submit'); ?></button>
      </form>
    </div>
  </div>
</section>
