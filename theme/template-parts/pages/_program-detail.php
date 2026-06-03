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

  <!-- Hero: nền gradient cam + chữ trắng (giống live) -->
  <section class="pg-hero pg-hero--brand section">
    <div class="container">
      <h1 class="pg-hero__title"><?php echo esc_html($P['hero_tagline']); ?></h1>
      <?php if (!empty($P['pills'])) : ?>
        <div class="pg-pills">
          <?php foreach ($P['pills'] as $p) : ?>
            <span class="pg-pill pg-pill--ghost"><?php echo esc_html($p); ?></span>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
      <?php if (!empty($P['hero_cta'])) : ?><a href="<?php echo esc_url(tnl_url('contact')); ?>" class="btn pg-hero__cta-btn"><?php echo esc_html($P['hero_cta']); ?></a><?php endif; ?>
    </div>
  </section>

  <?php if (!empty($P['hero_img'])) : ?>
  <!-- Banner ảnh full-width -->
  <div class="pg-banner">
    <div class="container">
      <figure class="pg-banner__fig"><img src="<?php echo esc_url($P['hero_img']); ?>" alt="<?php echo esc_attr($P['hero_tagline']); ?>" loading="eager"></figure>
    </div>
  </div>
  <?php endif; ?>

  <!-- Why -->
  <?php if (!empty($P['why_paras'])) : ?>
  <section class="pg-why section<?php echo !empty($P['why_img']) ? ' pg-why--media' : ''; ?>">
    <div class="container pg-why__inner">
      <div class="pg-why__text">
        <h2 class="pg-why__title"><?php echo esc_html($P['why_h']); ?></h2>
        <?php foreach ($P['why_paras'] as $p) : ?><p class="pg-why__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
      </div>
      <?php if (!empty($P['why_img'])) : ?>
        <figure class="pg-why__fig"><img src="<?php echo esc_url($P['why_img']); ?>" alt="<?php echo esc_attr($P['why_h']); ?>" loading="lazy"></figure>
      <?php endif; ?>
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

  <!-- Dải ảnh nghỉ mắt giữa nội dung dài -->
  <?php if (!empty($P['break_img'])) : ?>
  <section class="pg-photobreak" aria-hidden="true">
    <figure class="pg-photobreak__fig"><img src="<?php echo esc_url($P['break_img']); ?>" alt="" loading="lazy"></figure>
  </section>
  <?php endif; ?>

  <!-- Testimonials -->
  <?php if (!empty($P['people'])) : ?>
  <section class="pg-tm section">
    <div class="container">
      <h2 class="pg-tm__title"><?php echo esc_html($P['tm_title']); ?></h2>
      <div class="pg-tm__grid">
        <?php foreach ($P['people'] as $pi => $p) :
          $av = function_exists('tnl_avatar') ? tnl_avatar($p['n']) : ''; ?>
          <figure class="pg-quote">
            <blockquote class="pg-quote__text"><?php echo esc_html($p['q']); ?></blockquote>
            <figcaption class="pg-quote__by">
              <?php if ($av) : ?>
                <span class="pg-quote__avatar"><img src="<?php echo esc_url($av); ?>" alt="<?php echo esc_attr($p['n']); ?>" loading="lazy"></span>
              <?php else : ?>
                <span class="pg-quote__avatar pg-quote__avatar--initials pg-quote__avatar--<?php echo $accent[$pi % count($accent)]; ?>"><?php echo esc_html(tnl_initials($p['n'])); ?></span>
              <?php endif; ?>
              <span class="pg-quote__meta">
                <span class="pg-quote__name"><?php echo esc_html($p['n']); ?></span>
                <span class="pg-quote__role"><?php echo esc_html($p['r']); ?></span>
              </span>
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
