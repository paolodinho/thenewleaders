<?php
/**
 * Renderer landing sản phẩm dùng chung (block-based).
 * Mỗi trang slug khai báo: $hero (title/subtitle/desc/img/video/buy/buy_url) + $blocks[] (ordered).
 * Block types: feature, textblock, audience, list, steps, tips, gallery, partners, testimonial, faq.
 */
if (!isset($hero) || !isset($blocks)) { return; }
$buy      = $hero['buy'] ?? '';
$buy_url  = $hero['buy_url'] ?? '';
$btn = function () use ($buy, $buy_url) {
    if (!$buy || !$buy_url) return '';
    return '<a href="' . esc_url($buy_url) . '" target="_blank" rel="noopener" class="btn btn--primary pl-buy">' . esc_html($buy) . '</a>';
};
$col_mods = ['teal', 'green', 'orange'];
?>
<main class="site-main page-pl">

  <section class="pl-hero section">
    <div class="container pl-hero__inner">
      <div class="pl-hero__text">
        <h1 class="pl-hero__title"><?php echo esc_html($hero['title']); ?></h1>
        <?php if (!empty($hero['subtitle'])) : ?><p class="pl-hero__sub"><?php echo esc_html($hero['subtitle']); ?></p><?php endif; ?>
        <?php if (!empty($hero['desc'])) : ?><p class="pl-hero__desc"><?php echo esc_html($hero['desc']); ?></p><?php endif; ?>
        <?php echo $btn(); // phpcs:ignore ?>
      </div>
      <div class="pl-hero__media">
        <?php if (!empty($hero['video'])) : ?>
          <video src="<?php echo esc_url($hero['video']); ?>" autoplay muted loop playsinline></video>
        <?php elseif (!empty($hero['img'])) : ?>
          <img src="<?php echo esc_url($hero['img']); ?>" alt="<?php echo esc_attr($hero['title']); ?>" loading="eager">
        <?php endif; ?>
      </div>
    </div>
  </section>

  <?php $fi = 0; foreach ($blocks as $b) : $type = $b['type']; ?>

    <?php if ($type === 'feature') : $fi++; $rev = ($fi % 2 === 0); ?>
      <section class="pl-feature section <?php echo $rev ? 'pl-feature--rev' : ''; ?> <?php echo empty($b['paras']) ? 'pl-feature--showcase' : ''; ?>">
        <div class="container pl-feature__inner">
          <div class="pl-feature__text">
            <h2 class="pl-feature__h"><?php echo esc_html($b['h']); ?></h2>
            <?php if (!empty($b['paras'])) foreach ($b['paras'] as $p) : ?><p class="pl-feature__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
            <?php if (!empty($b['cta'])) echo $btn(); // phpcs:ignore ?>
          </div>
          <?php if (!empty($b['img'])) : ?>
            <div class="pl-feature__media"><img src="<?php echo esc_url($b['img']); ?>" alt="<?php echo esc_attr($b['h']); ?>" loading="lazy"></div>
          <?php endif; ?>
        </div>
      </section>

    <?php elseif ($type === 'textblock') : ?>
      <section class="pl-block section <?php echo !empty($b['alt']) ? 'pl-block--alt' : ''; ?>">
        <div class="container">
          <?php if (!empty($b['h'])) : ?><h2 class="pl-block__h"><?php echo esc_html($b['h']); ?></h2><?php endif; ?>
          <?php foreach ($b['paras'] as $p) : ?><p class="pl-block__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
          <?php if (!empty($b['cta'])) echo $btn(); // phpcs:ignore ?>
        </div>
      </section>

    <?php elseif ($type === 'audience') : ?>
      <section class="pl-block pl-block--alt section">
        <div class="container">
          <h2 class="pl-block__h"><?php echo esc_html($b['h']); ?></h2>
          <div class="pl-aud">
            <?php foreach ($b['items'] as $i => $it) : ?>
              <div class="pl-aud__card"><span class="pl-aud__dot pl-aud__dot--<?php echo $col_mods[$i % 3]; ?>"></span><p><?php echo esc_html($it); ?></p></div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

    <?php elseif ($type === 'list') : ?>
      <section class="pl-block section">
        <div class="container">
          <h2 class="pl-block__h"><?php echo esc_html($b['h']); ?></h2>
          <?php if (!empty($b['lead'])) : ?><p class="pl-block__p"><?php echo esc_html($b['lead']); ?></p><?php endif; ?>
          <ul class="pl-reflist"><?php foreach ($b['items'] as $it) : ?><li><?php echo esc_html($it); ?></li><?php endforeach; ?></ul>
        </div>
      </section>

    <?php elseif ($type === 'steps') : ?>
      <section class="pl-block pl-block--alt section">
        <div class="container">
          <h2 class="pl-block__h"><?php echo esc_html($b['h']); ?></h2>
          <ol class="pl-steps">
            <?php foreach ($b['items'] as $i => $it) : ?>
              <li class="pl-step"><span class="pl-step__n"><?php echo $i + 1; ?></span><p><?php echo esc_html($it); ?></p></li>
            <?php endforeach; ?>
          </ol>
        </div>
      </section>

    <?php elseif ($type === 'tips') : ?>
      <section class="pl-block section">
        <div class="container">
          <h2 class="pl-block__h"><?php echo esc_html($b['h']); ?></h2>
          <div class="pl-tips">
            <?php foreach ($b['items'] as $i => $it) : ?>
              <div class="pl-tip"><span class="pl-tip__n pl-tip__n--<?php echo $col_mods[$i % 3]; ?>"><?php echo $i + 1; ?></span><p><?php echo esc_html($it); ?></p></div>
            <?php endforeach; ?>
          </div>
        </div>
      </section>

    <?php elseif ($type === 'gallery') : ?>
      <section class="pl-gallery section">
        <div class="container">
          <?php if (!empty($b['h'])) : ?><h2 class="pl-block__h pl-gallery__h"><?php echo esc_html($b['h']); ?></h2><?php endif; ?>
          <div class="pl-gallery__grid">
            <?php foreach ($b['items'] as $src) : ?><figure class="pl-gallery__item"><img src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($hero['title']); ?>" loading="lazy"></figure><?php endforeach; ?>
          </div>
          <?php if ($buy && $buy_url) : ?><div class="pl-gallery__cta"><?php echo $btn(); // phpcs:ignore ?></div><?php endif; ?>
        </div>
      </section>

    <?php elseif ($type === 'partners') : ?>
      <?php get_template_part('template-parts/home/partners'); ?>

    <?php elseif ($type === 'testimonial') : ?>
      <section class="pl-tm section">
        <div class="container">
          <figure class="pl-quote">
            <blockquote><?php echo esc_html($b['q']); ?></blockquote>
            <figcaption><?php echo esc_html($b['n']); ?></figcaption>
          </figure>
        </div>
      </section>

    <?php elseif ($type === 'faq') : ?>
      <section class="pl-faq section">
        <div class="container">
          <h2 class="pl-faq__h"><?php echo esc_html($b['h']); ?></h2>
          <div class="pl-faq__list">
            <?php foreach ($b['items'] as $f) : if (empty($f['q']) || empty($f['a'])) continue; ?>
              <details class="pl-faq__item"><summary><?php echo esc_html($f['q']); ?></summary><div class="pl-faq__a"><p><?php echo esc_html($f['a']); ?></p></div></details>
            <?php endforeach; ?>
          </div>
        </div>
      </section>
    <?php endif; ?>

  <?php endforeach; ?>

</main>
