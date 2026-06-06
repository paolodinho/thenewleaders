<?php
$features = [
    [ 'color' => 'teal',   'title' => tnl_t('whyus1_title'), 'desc' => tnl_t('whyus1_desc') ],
    [ 'color' => 'green',  'title' => tnl_t('whyus2_title'), 'desc' => tnl_t('whyus2_desc') ],
    [ 'color' => 'yellow', 'title' => tnl_t('whyus3_title'), 'desc' => tnl_t('whyus3_desc') ],
    [ 'color' => 'orange', 'title' => tnl_t('whyus4_title'), 'desc' => tnl_t('whyus4_desc') ],
];
?>

<section class="why-us section" id="why-us">
  <div class="container">
    <h2 class="why-us__title"><?php echo tnl_t('whyus_title'); ?></h2>
    <p class="why-us__lead"><?php echo tnl_t('whyus_lead'); ?></p>
  </div>

  <div class="why-us__items">
    <?php foreach ($features as $f) : ?>
      <div class="why-us-item">
        <div class="why-us-item__title-box why-us-item__title-box--<?php echo esc_attr($f['color']); ?>">
          <?php echo esc_html($f['title']); ?>
        </div>
        <p class="why-us-item__desc"><?php echo esc_html($f['desc']); ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>
