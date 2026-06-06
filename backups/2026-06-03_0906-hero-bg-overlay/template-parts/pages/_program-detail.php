<?php
/**
 * Renderer dùng chung cho trang chi tiết chương trình (our-services/*).
 * Nhận biến $P (mảng dữ liệu) — xem for-manager.php để biết cấu trúc.
 */
if (empty($P)) return;
$pill_mods = ['orange', 'teal', 'green', 'pink'];
$accent = ['teal', 'green', 'orange', 'pink'];
?>
<main class="site-main page-program">

  <!-- Hero: ảnh nền tràn + text đè lên -->
  <section class="pg-hero section<?php echo !empty($P['hero_img']) ? ' pg-hero--bg' : ''; ?>"<?php echo !empty($P['hero_img']) ? ' style="background-image:url(' . esc_url($P['hero_img']) . ')"' : ''; ?>>
    <div class="container">
      <div class="pg-hero__text">
        <h1 class="pg-hero__title"><?php echo esc_html($P['hero_tagline']); ?></h1>
        <?php if (!empty($P['pills'])) : ?>
          <div class="pg-pills">
            <?php foreach ($P['pills'] as $i => $p) : ?>
              <span class="pg-pill pg-pill--<?php echo $pill_mods[$i % count($pill_mods)]; ?>"><?php echo esc_html($p); ?></span>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
        <?php if (!empty($P['hero_cta'])) : ?><a href="<?php echo esc_url(tnl_url('contact')); ?>" class="btn btn--primary pg-hero__cta-btn"><?php echo esc_html($P['hero_cta']); ?></a><?php endif; ?>
      </div>
    </div>
  </section>

  <!-- Why -->
  <?php if (!empty($P['why_paras'])) : ?>
  <section class="pg-why section">
    <div class="container">
      <h2 class="pg-why__title"><?php echo esc_html($P['why_h']); ?></h2>
      <?php foreach ($P['why_paras'] as $p) : ?><p class="pg-why__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- Impact stats -->
  <?php if (!empty($P['stats'])) : ?>
  <section class="pg-impact section">
    <div class="container">
      <h2 class="pg-impact__title"><?php echo esc_html($P['stats_h'] ?? ($P['impact_h'] ?? '')); ?></h2>
      <div class="pg-stats">
        <?php foreach ($P['stats'] as $i => $s) : ?>
          <div class="pg-stat pg-stat--<?php echo $accent[$i % count($accent)]; ?>">
            <?php if (!empty($s['sub'])) : ?><p class="pg-stat__sub"><?php echo esc_html($s['sub']); ?></p><?php endif; ?>
            <span class="pg-stat__num"><?php echo esc_html($s['pct']); ?></span>
            <p class="pg-stat__text"><?php echo esc_html($s['text']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- Impact text blocks -->
  <?php if (!empty($P['impact_blocks'])) : ?>
  <section class="pg-impact2 section">
    <div class="container">
      <?php if (!empty($P['impact_blocks_h'])) : ?><h2 class="pg-impact2__title"><?php echo esc_html($P['impact_blocks_h']); ?></h2><?php endif; ?>
      <?php if (!empty($P['impact_intro'])) : ?><p class="pg-impact2__intro"><?php echo esc_html($P['impact_intro']); ?></p><?php endif; ?>
      <div class="pg-impact2__grid">
        <?php foreach ($P['impact_blocks'] as $i => $b) : ?>
          <div class="pg-impact2__card pg-impact2__card--<?php echo $accent[$i % count($accent)]; ?>">
            <h3 class="pg-impact2__card-title"><?php echo esc_html($b['title']); ?></h3>
            <p class="pg-impact2__card-desc"><?php echo esc_html($b['para']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- Curriculum -->
  <?php if (!empty($P['modules'])) : ?>
  <section class="pg-curri section">
    <div class="container">
      <h2 class="pg-curri__title"><?php echo esc_html($P['prog_h']); ?></h2>
      <?php if (!empty($P['prog_intro'])) : ?><p class="pg-curri__intro"><?php echo esc_html($P['prog_intro']); ?></p><?php endif; ?>
      <ol class="pg-modules">
        <?php foreach ($P['modules'] as $i => $m) : ?>
          <li class="pg-module">
            <span class="pg-module__num pg-module__num--<?php echo $accent[$i % count($accent)]; ?>"><?php printf('%02d', $i + 1); ?></span>
            <div class="pg-module__body">
              <h3 class="pg-module__title"><?php echo esc_html($m['title']); ?></h3>
              <?php if (!empty($m['paras'])) foreach ($m['paras'] as $p) : ?><p><?php echo esc_html($p); ?></p><?php endforeach; ?>
              <?php if (!empty($m['bullets'])) : ?>
                <ul class="pg-module__list">
                  <?php foreach ($m['bullets'] as $b) : ?><li><?php echo esc_html($b); ?></li><?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>
          </li>
        <?php endforeach; ?>
      </ol>
      <?php if (!empty($P['curri_cta'])) : ?>
        <a href="<?php echo esc_url(tnl_url('contact')); ?>" class="btn btn--primary pg-curri__cta"><?php echo esc_html($P['curri_cta']); ?></a>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>

  <!-- Testimonials -->
  <?php if (!empty($P['people'])) : ?>
  <section class="pg-tm section">
    <div class="container">
      <h2 class="pg-tm__title"><?php echo esc_html($P['tm_title']); ?></h2>
      <div class="pg-tm__grid">
        <?php foreach ($P['people'] as $p) : ?>
          <figure class="pg-quote">
            <blockquote class="pg-quote__text"><?php echo esc_html($p['q']); ?></blockquote>
            <figcaption class="pg-quote__by">
              <span class="pg-quote__name"><?php echo esc_html($p['n']); ?></span>
              <span class="pg-quote__role"><?php echo esc_html($p['r']); ?></span>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  <!-- Why us -->
  <?php if (!empty($P['whyus'])) : ?>
  <section class="pg-whyus section">
    <div class="container">
      <h2 class="pg-whyus__title"><?php echo esc_html($P['whyus_h']); ?></h2>
      <?php if (!empty($P['whyus_lead'])) : ?><p class="pg-whyus__lead"><?php echo esc_html($P['whyus_lead']); ?></p><?php endif; ?>
      <div class="pg-whyus__grid">
        <?php foreach ($P['whyus'] as $i => $w) : ?>
          <div class="pg-whyus__card pg-whyus__card--<?php echo $accent[$i % count($accent)]; ?>">
            <h3 class="pg-whyus__card-title"><?php echo esc_html($w['title']); ?></h3>
            <p class="pg-whyus__card-desc"><?php echo esc_html($w['desc']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
      <?php if (!empty($P['cta1'])) : ?>
        <div class="pg-whyus__ctas">
          <a href="<?php echo esc_url(tnl_url('our-services')); ?>" class="btn btn--primary"><?php echo esc_html($P['cta1']); ?></a>
          <a href="<?php echo esc_url(tnl_url('our-services')); ?>" class="btn btn--outline-dark"><?php echo esc_html($P['cta2']); ?></a>
        </div>
      <?php endif; ?>
    </div>
  </section>
  <?php endif; ?>

</main>
