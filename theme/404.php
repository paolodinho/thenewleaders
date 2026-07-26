<?php
/**
 * 404.php — trang không tồn tại.
 * Trước đây theme không có template 404 -> WP rơi về index.php và in nội dung bài viết,
 * khiến người dùng click link sai lại thấy "content khác" thay vì thông báo trang không có.
 */
if (!defined('ABSPATH')) exit;

$lang = (function_exists('tnl_lang') && tnl_lang() === 'vi') ? 'vi' : 'en';
$home = home_url('/' . $lang . '/');
$vi   = ($lang === 'vi');
$logo = get_template_directory_uri() . '/clone/images/logo.svg';

status_header(404);
nocache_headers();
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="robots" content="noindex, follow">
  <?php add_filter('pre_get_document_title', function () use ($vi) {
      return $vi ? 'Không tìm thấy trang - The New Leaders' : 'Page not found - The New Leaders';
  }); ?>
  <style>
    body{margin:0;font-family:"Euclid Circular A","EuclidCircularAVN",system-ui,sans-serif;color:#27343A;background:#fff}
    .tnl-404{min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;
      text-align:center;padding:clamp(48px,8vw,96px) 20px;gap:14px}
    .tnl-404__logo img{height:44px;width:auto;margin-bottom:8px}
    .tnl-404__code{font-size:clamp(56px,12vw,104px);line-height:1;font-weight:700;color:#E7E7E7;margin:0}
    .tnl-404__title{font-size:clamp(24px,4vw,40px);line-height:1.2;margin:0}
    .tnl-404__desc{font-size:18px;line-height:1.6;max-width:46ch;margin:0;color:#5B6871}
    .tnl-404__links{display:flex;flex-wrap:wrap;align-items:center;justify-content:center;gap:12px 20px;margin-top:12px}
    .tnl-404__btn{display:inline-flex;align-items:center;justify-content:center;white-space:nowrap;
      padding:14px 28px;border-radius:6px;background:#27343A;color:#fff;text-decoration:none;font-weight:600}
    .tnl-404__btn:hover{background:#3E5057}
    .tnl-404__link{color:#27343A;text-decoration:underline;white-space:nowrap}
  </style>
  <?php wp_head(); ?>
</head>
<body>
<div class="tnl-404">
  <a class="tnl-404__logo" href="<?php echo esc_url($home); ?>">
    <img src="<?php echo esc_url($logo); ?>" alt="The New Leaders" onerror="this.style.display='none'">
  </a>
  <p class="tnl-404__code">404</p>
  <h1 class="tnl-404__title"><?php echo $vi ? 'Không tìm thấy trang này' : 'This page cannot be found'; ?></h1>
  <p class="tnl-404__desc"><?php echo $vi
    ? 'Đường dẫn có thể đã thay đổi hoặc bị gõ sai. Bạn thử lại từ các mục dưới đây nhé.'
    : 'The link may have changed or been mistyped. Please try one of the sections below.'; ?></p>
  <div class="tnl-404__links">
    <a class="tnl-404__btn" href="<?php echo esc_url($home); ?>"><?php echo $vi ? 'Về trang chủ' : 'Back to home'; ?></a>
    <a class="tnl-404__link" href="<?php echo esc_url($home . 'careers/'); ?>"><?php echo $vi ? 'Tuyển dụng' : 'Careers'; ?></a>
    <a class="tnl-404__link" href="<?php echo esc_url($home . 'events/'); ?>"><?php echo $vi ? 'Sự kiện' : 'Events'; ?></a>
    <a class="tnl-404__link" href="<?php echo esc_url($home . 'resources/'); ?>"><?php echo $vi ? 'Bài viết' : 'Resources'; ?></a>
    <a class="tnl-404__link" href="<?php echo esc_url($home . 'contact/'); ?>"><?php echo $vi ? 'Liên hệ' : 'Contact'; ?></a>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>
