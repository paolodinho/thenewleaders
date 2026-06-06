<?php
$email = get_option('tnl_contact_email', '') ?: 'info@thenewleaders.asia';
$phone = get_option('tnl_contact_phone', '') ?: '(84) 91 666 3670';
$socials = [
    'facebook'  => get_option('tnl_social_facebook', '#'),
    'linkedin'  => get_option('tnl_social_linkedin', '#'),
    'youtube'   => get_option('tnl_social_youtube', '#'),
    'instagram' => get_option('tnl_social_instagram', '#'),
    'tiktok'    => get_option('tnl_social_tiktok', '#'),
];
$social_icons = [
    'facebook'  => '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M14 13.5h2.5l1-4H14v-2c0-1.03 0-2 2-2h1.5V2.14c-.326-.043-1.557-.14-2.857-.14C11.928 2 10 3.657 10 6.7v2.8H7v4h3V22h4v-8.5z"/></svg>',
    'linkedin'  => '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M6.94 5a2 2 0 11-4-.002 2 2 0 014 .002zM7 8.48H3V21h4V8.48zm6.32 0H9.34V21h3.94v-6.57c0-3.66 4.77-4 4.77 0V21H22v-7.93c0-6.17-7.06-5.94-8.72-2.91l.04-1.68z"/></svg>',
    'youtube'   => '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M23 12s0-3.5-.46-5.17a2.6 2.6 0 00-1.83-1.85C19.05 4.5 12 4.5 12 4.5s-7.05 0-8.71.48A2.6 2.6 0 001.46 6.83C1 8.5 1 12 1 12s0 3.5.46 5.17a2.6 2.6 0 001.83 1.85c1.66.48 8.71.48 8.71.48s7.05 0 8.71-.48a2.6 2.6 0 001.83-1.85C23 15.5 23 12 23 12zM9.75 15.5v-7l6 3.5-6 3.5z"/></svg>',
    'instagram' => '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M12 2c2.72 0 3.06.01 4.12.06 1.07.05 1.8.22 2.43.47.66.25 1.21.6 1.77 1.15.55.56.9 1.11 1.15 1.77.25.63.42 1.36.47 2.43C21.99 8.94 22 9.28 22 12s-.01 3.06-.06 4.12c-.05 1.07-.22 1.8-.47 2.43-.25.66-.6 1.21-1.15 1.77-.56.55-1.11.9-1.77 1.15-.63.25-1.36.42-2.43.47-1.06.05-1.4.06-4.12.06s-3.06-.01-4.12-.06c-1.07-.05-1.8-.22-2.43-.47a4.9 4.9 0 01-1.77-1.15 4.9 4.9 0 01-1.15-1.77c-.25-.63-.42-1.36-.47-2.43C2.01 15.06 2 14.72 2 12s.01-3.06.06-4.12c.05-1.07.22-1.8.47-2.43.25-.66.6-1.21 1.15-1.77A4.9 4.9 0 015.45 2.53c.63-.25 1.36-.42 2.43-.47C8.94 2.01 9.28 2 12 2zm0 1.8c-2.67 0-2.99.01-4.04.06-.98.04-1.5.21-1.86.35-.47.18-.8.4-1.15.75-.35.35-.57.68-.75 1.15-.14.36-.31.88-.35 1.86-.05 1.05-.06 1.37-.06 4.04s.01 2.99.06 4.04c.04.98.21 1.5.35 1.86.18.47.4.8.75 1.15.35.35.68.57 1.15.75.36.14.88.31 1.86.35 1.05.05 1.37.06 4.04.06s2.99-.01 4.04-.06c.98-.04 1.5-.21 1.86-.35.47-.18.8-.4 1.15-.75.35-.35.57-.68.75-1.15.14-.36.31-.88.35-1.86.05-1.05.06-1.37.06-4.04s-.01-2.99-.06-4.04c-.04-.98-.21-1.5-.35-1.86a3.1 3.1 0 00-.75-1.15 3.1 3.1 0 00-1.15-.75c-.36-.14-.88-.31-1.86-.35-1.05-.05-1.37-.06-4.04-.06zm0 3.07a5.13 5.13 0 110 10.26 5.13 5.13 0 010-10.26zm0 8.46a3.33 3.33 0 100-6.66 3.33 3.33 0 000 6.66zm6.54-8.66a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0z"/></svg>',
    'tiktok'    => '<svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor"><path d="M16.6 5.82A4.28 4.28 0 0115.54 3h-3.09v12.4a2.59 2.59 0 01-2.59 2.5 2.59 2.59 0 01-2.59-2.59 2.59 2.59 0 012.59-2.59c.27 0 .53.04.77.12v-3.16a5.7 5.7 0 00-.77-.05A5.75 5.75 0 004.1 15.38a5.75 5.75 0 005.76 5.75 5.75 5.75 0 005.75-5.75V9.01a7.35 7.35 0 004.29 1.37V7.3a4.28 4.28 0 01-3.3-1.48z"/></svg>',
];
?>
<section class="cta-section" id="contact">
  <div class="container">
    <div class="cta-section__layout">

      <!-- Left: colored word boxes -->
      <div class="cta-section__words">
        <span class="cta-word cta-word--teal"><?php echo tnl_t('cta_w1'); ?></span>
        <span class="cta-word cta-word--green"><?php echo tnl_t('cta_w2'); ?></span>
        <span class="cta-word cta-word--yellow"><?php echo tnl_t('cta_w3'); ?></span>
        <span class="cta-word cta-word--orange"><?php echo tnl_t('cta_w4'); ?></span>
      </div>

      <!-- Right: get in touch -->
      <div class="cta-section__right">
        <h2 class="cta-section__heading"><?php echo tnl_t('cta_heading'); ?></h2>

        <div class="cta-section__info">
          <p class="cta-section__brand">The New Leaders</p>
          <a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a>
          <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $phone)); ?>"><?php echo esc_html($phone); ?></a>
        </div>

        <div class="cta-section__social">
          <?php foreach ($socials as $name => $url) : ?>
            <a href="<?php echo esc_url($url); ?>" target="_blank" rel="noopener" aria-label="<?php echo esc_attr($name); ?>" class="cta-section__social-link">
              <?php echo $social_icons[$name]; // phpcs:ignore — trusted inline SVG ?>
            </a>
          <?php endforeach; ?>
        </div>

        <div class="cta-section__lang">
          <span class="cta-section__lang-label"><?php echo tnl_t('cta_lang'); ?></span>
          <a href="<?php echo tnl_lang_url('en'); ?>" class="cta-section__lang-link <?php echo tnl_lang()==='en'?'is-active':''; ?>">En</a>
          <span class="cta-section__lang-sep">|</span>
          <a href="<?php echo tnl_lang_url('vi'); ?>" class="cta-section__lang-link <?php echo tnl_lang()==='vi'?'is-active':''; ?>">Vi</a>
        </div>
      </div>

    </div>
  </div>
</section>
