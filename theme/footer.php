<?php
/** Footer — nav nội bộ (SEO internal link) + liên hệ + mạng xã hội (outbound). Song ngữ. */
$f_vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$ft = function ($vi, $en) use ($f_vi) { return $f_vi ? $vi : $en; };

$social = [
    ['Facebook',  'https://www.facebook.com/share/5AUg8xvJDnxr13ub',          '<path d="M14 9h2V6h-2c-1.7 0-3 1.3-3 3v1.5H9V13h2v6h2.5v-6H16l.5-2.5h-3V9c0-.6.4-1 1-1z"/>'],
    ['LinkedIn',  'https://www.linkedin.com/company/thenewleaders-asia',       '<path d="M7.5 9.5H5V19h2.5V9.5zM6.25 5.5A1.4 1.4 0 1 0 6.25 8.3 1.4 1.4 0 0 0 6.25 5.5zM19 19h-2.5v-4.8c0-1.3-.5-1.9-1.4-1.9-.8 0-1.3.5-1.5 1.1-.1.2-.1.5-.1.8V19H11s.03-8.6 0-9.5h2.5v1.3c.3-.5 1-1.3 2.4-1.3 1.7 0 3.1 1.1 3.1 3.6V19z"/>'],
    ['YouTube',   'https://youtube.com/@thenewleaders5553',                    '<path d="M21 8.5c-.2-1-.9-1.6-1.8-1.8C17.5 6.3 12 6.3 12 6.3s-5.5 0-7.2.4C3.9 6.9 3.2 7.5 3 8.5 2.7 10.2 2.7 12 2.7 12s0 1.8.3 3.5c.2 1 .9 1.6 1.8 1.8 1.7.4 7.2.4 7.2.4s5.5 0 7.2-.4c.9-.2 1.6-.8 1.8-1.8.3-1.7.3-3.5.3-3.5s0-1.8-.3-3.5zM10.3 14.4V9.6l4.2 2.4-4.2 2.4z"/>'],
    ['Instagram', 'https://www.instagram.com/thenewleaders.asia',              '<path d="M12 7.8A4.2 4.2 0 1 0 12 16.2 4.2 4.2 0 0 0 12 7.8zm0 6.9A2.7 2.7 0 1 1 12 9.3a2.7 2.7 0 0 1 0 5.4zM16.5 7a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM19.4 9.3c-.1-1.3-.4-2.4-1.3-3.4S16 4.7 14.7 4.6C13.4 4.5 9.6 4.5 8.3 4.6 7 4.7 5.9 5 5 5.9S3.7 8 3.6 9.3c-.1 1.3-.1 5.1 0 6.4.1 1.3.4 2.4 1.4 3.4s2 1.2 3.3 1.3c1.3.1 5.1.1 6.4 0 1.3-.1 2.4-.4 3.4-1.3s1.2-2.1 1.3-3.4c.1-1.3.1-5.1 0-6.4zm-1.8 7.8c-.3.7-.8 1.3-1.6 1.6-1.1.4-3.7.3-4.9.3s-3.8.1-4.9-.3c-.7-.3-1.3-.9-1.6-1.6-.4-1.1-.3-3.7-.3-4.9s-.1-3.8.3-4.9c.3-.7.9-1.3 1.6-1.6 1.1-.4 3.7-.3 4.9-.3s3.8-.1 4.9.3c.7.3 1.3.9 1.6 1.6.4 1.1.3 3.7.3 4.9s.1 3.8-.3 4.9z"/>'],
    ['TikTok',    'https://www.tiktok.com/@thenewleaders.asia',                '<path d="M16.5 5.5c.5 1 1.4 1.8 2.5 2v2.2c-1 0-2-.3-2.9-.8v4.7a4.7 4.7 0 1 1-4.7-4.7c.2 0 .4 0 .6.05v2.3a2.4 2.4 0 1 0 1.7 2.3V4.5h2.3c0 .35.05.68.15 1z"/>'],
];

$svc = [
    ['our-services',                    $ft('Tổng quan dịch vụ', 'All services')],
    ['our-services/for-manager',        $ft('EQ cho Quản lý, Lãnh đạo', 'EQ for Managers & Leaders')],
    ['our-services/for-team-member',    $ft('EQ cho Đội ngũ', 'EQ for Team Members')],
    ['our-services/executive-coach',    $ft('Coaching 1:1', '1:1 Executive Coaching')],
    ['our-services/individual-courses', $ft('Khoá học cá nhân', 'Individual Courses')],
];
$prod = [
    ['products',                      $ft('Tổng quan sản phẩm', 'All products')],
    ['products/heart-heart-hand',     $ft('Cẩm nang EQ', 'EQ Guidebook')],
    ['products/the-story-of-empathy', $ft('Sách điện tử', 'E-book')],
    ['products/the-eq-calendar',      'The EQ Calendar'],
];
$explore = [
    ['resources',  $ft('Tài nguyên', 'Resources')],
    ['events',     $ft('Sự kiện', 'Events')],
    ['eq-quiz',    $ft('Trắc nghiệm EQ', 'EQ Quiz')],
    ['careers',    $ft('Tuyển dụng', 'Careers')],
    ['newsletter', $ft('Bản tin', 'Newsletter')],
];
?>
<footer class="site-footer">
  <div class="container site-footer__top">

    <div class="site-footer__brand">
      <a href="<?php echo esc_url(tnl_url('')); ?>" class="site-footer__logo" aria-label="The New Leaders">
        <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/tnl-logo.svg'); ?>" alt="The New Leaders" width="150" height="42" loading="lazy">
      </a>
      <p class="site-footer__tagline"><?php echo esc_html($ft('Đào tạo Lãnh đạo & Giao tiếp bằng Trí tuệ Cảm xúc (EQ) theo cấu trúc từ Harvard & Oxford.', 'Emotional Intelligence (EQ) Leadership & Communication training based on Harvard & Oxford frameworks.')); ?></p>
      <div class="site-footer__social">
        <?php foreach ($social as $s) : ?>
          <a href="<?php echo esc_url($s[1]); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php echo esc_attr($s[0]); ?>">
            <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor" aria-hidden="true"><?php echo $s[2]; ?></svg>
          </a>
        <?php endforeach; ?>
      </div>
    </div>

    <nav class="site-footer__nav" aria-label="<?php echo esc_attr($ft('Liên kết chân trang', 'Footer')); ?>">
      <div class="site-footer__col">
        <h3 class="site-footer__h"><?php echo esc_html($ft('Dịch vụ', 'Services')); ?></h3>
        <?php foreach ($svc as $l) : ?><a href="<?php echo esc_url(tnl_url($l[0])); ?>"><?php echo esc_html($l[1]); ?></a><?php endforeach; ?>
      </div>
      <div class="site-footer__col">
        <h3 class="site-footer__h"><?php echo esc_html($ft('Sản phẩm', 'Products')); ?></h3>
        <?php foreach ($prod as $l) : ?><a href="<?php echo esc_url(tnl_url($l[0])); ?>"><?php echo esc_html($l[1]); ?></a><?php endforeach; ?>
      </div>
      <div class="site-footer__col">
        <h3 class="site-footer__h"><?php echo esc_html($ft('Khám phá', 'Explore')); ?></h3>
        <?php foreach ($explore as $l) : ?><a href="<?php echo esc_url(tnl_url($l[0])); ?>"><?php echo esc_html($l[1]); ?></a><?php endforeach; ?>
      </div>
      <div class="site-footer__col">
        <h3 class="site-footer__h"><?php echo esc_html($ft('Liên hệ', 'Contact')); ?></h3>
        <a href="mailto:info@thenewleaders.asia">info@thenewleaders.asia</a>
        <a href="tel:+84916663670">(84) 91 666 3670</a>
        <a href="<?php echo esc_url(tnl_url('contact')); ?>"><?php echo esc_html($ft('Gửi liên hệ', 'Get in touch')); ?></a>
      </div>
    </nav>

  </div>

  <div class="site-footer__bottom">
    <div class="container">
      <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php echo tnl_t('copyright'); ?></p>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
