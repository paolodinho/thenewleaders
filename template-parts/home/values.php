<?php
$values = [
    ['title' => tnl_t('val1_title'), 'desc' => tnl_t('val1_desc')],
    ['title' => tnl_t('val2_title'), 'desc' => tnl_t('val2_desc')],
    ['title' => tnl_t('val3_title'), 'desc' => tnl_t('val3_desc')],
    ['title' => tnl_t('val4_title'), 'desc' => tnl_t('val4_desc')],
    ['title' => tnl_t('val5_title'), 'desc' => tnl_t('val5_desc')],
];

// 1 value per slide, 2 visible at once via CSS flex 50%
?>

<section class="values" id="values">
  <div class="values__inner">

    <h2 class="values__title"><?php echo tnl_t('values_title'); ?></h2>

    <div class="values__slider">
      <button class="values__arrow values__arrow--prev" id="valuesPrev" aria-label="Previous">&#8592;</button>

      <div class="values__viewport">
        <div class="values__track" id="valuesTrack">
          <?php foreach ($values as $v) : ?>
            <div class="values__slide">
              <strong class="value-item__title"><?php echo esc_html($v['title']); ?></strong>
              <p class="value-item__desc"><?php echo esc_html($v['desc']); ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <button class="values__arrow values__arrow--next" id="valuesNext" aria-label="Next">&#8594;</button>
    </div>

  </div>
</section>
