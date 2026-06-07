<?php
$values = [
    ['title' => tnl_t('val1_title'), 'desc' => tnl_t('val1_desc')],
    ['title' => tnl_t('val2_title'), 'desc' => tnl_t('val2_desc')],
    ['title' => tnl_t('val3_title'), 'desc' => tnl_t('val3_desc')],
    ['title' => tnl_t('val4_title'), 'desc' => tnl_t('val4_desc')],
    ['title' => tnl_t('val5_title'), 'desc' => tnl_t('val5_desc')],
];
?>

<section class="values section" id="values">
  <div class="container">
    <h2 class="values__title"><?php echo tnl_t('values_title'); ?></h2>
  </div>

  <!-- (2026-06-06 feedback khách) Carousel tự chạy như web cũ -->
  <div class="values__marquee" aria-label="Values">
    <div class="values__track">
      <?php
      // Render 2 lượt để loop liền mạch
      for ($pass = 0; $pass < 2; $pass++) :
        foreach ($values as $v) : ?>
          <div class="value-card" <?php echo $pass === 1 ? 'aria-hidden="true"' : ''; ?>>
            <h3 class="value-card__title"><?php echo esc_html($v['title']); ?></h3>
            <p class="value-card__desc"><?php echo esc_html($v['desc']); ?></p>
          </div>
        <?php endforeach;
      endfor; ?>
    </div>
  </div>
</section>
