<?php
/**
 * WP ADMIN BRANDING - The New Leaders
 * Cá nhân hoá trang đăng nhập + quản trị theo nhận diện thương hiệu.
 * Màu brand: cam #FF4F21 / cam đậm #E03A10 / nền tối #1D1D1D / xanh nhấn #AFE56B.
 */

if (!defined('ABSPATH')) exit;

if (!function_exists('tnl_brand')) {
    function tnl_brand() {
        return array(
            'primary'    => '#FF4F21',
            'primary_dk' => '#E03A10',
            'dark'       => '#1D1D1D',
            'dark2'      => '#151515',
            'green'      => '#AFE56B',
            'logo'       => get_template_directory_uri() . '/assets/images/tnl-logo.svg',
            'logo_white' => get_template_directory_uri() . '/assets/images/tnl-logo-white.svg',
        );
    }
}

/* ============================================================
 * 1. TRANG ĐĂNG NHẬP - tối sang, logo trắng, nút cam
 * ============================================================ */
add_filter('login_headerurl',  function () { return home_url('/'); });
add_filter('login_headertext', function () { return get_bloginfo('name'); });

add_action('login_enqueue_scripts', function () {
    $b = tnl_brand(); ?>
<style>
  body.login {
    background: radial-gradient(1100px 600px at 50% -10%, rgba(255,79,33,.22), transparent 60%), <?php echo $b['dark']; ?>;
    color: #eaeaea;
  }
  #login { width: 340px; padding: 4% 0 0; }
  /* Logo trắng phía trên form */
  #login h1 { margin-bottom: 6px; }
  #login h1 a {
    background-image: url('<?php echo $b['logo_white']; ?>');
    background-size: contain; background-repeat: no-repeat; background-position: center;
    width: 240px; height: 84px; margin: 0 auto;
  }
  /* Tagline dưới logo */
  #login h1:after {
    content: "Content Management Center";
    display: block; text-align: center;
    color: rgba(255,255,255,.55);
    font-size: 13px; letter-spacing: .04em; margin-top: 2px;
  }
  /* Card đăng nhập */
  #loginform, #registerform, #lostpasswordform {
    background: #ffffff;
    border: 0; border-radius: 16px;
    box-shadow: 0 18px 50px rgba(0,0,0,.45);
    padding: 26px 24px;
  }
  .login form .input, .login input[type=text], .login input[type=password] {
    border-radius: 10px; border: 1px solid #E2E2E2; padding: 10px 12px;
    background: #FAFAFA; font-size: 15px;
  }
  .login form label { color: #3A3A3A; font-weight: 500; }
  .login input[type=text]:focus, .login input[type=password]:focus {
    border-color: <?php echo $b['primary']; ?> !important;
    box-shadow: 0 0 0 3px rgba(255,79,33,.18) !important;
    background: #fff !important; outline: 0;
  }
  /* Nút Đăng nhập */
  .wp-core-ui .button-primary {
    background: <?php echo $b['primary']; ?> !important;
    border: 0 !important;
    border-radius: 10px !important;
    box-shadow: 0 6px 16px rgba(255,79,33,.32) !important;
    font-weight: 600 !important; letter-spacing: .02em;
    padding: 6px 22px !important; height: auto !important;
    transition: background .15s ease, transform .05s ease;
  }
  .wp-core-ui .button-primary:hover { background: <?php echo $b['primary_dk']; ?> !important; }
  .wp-core-ui .button-primary:active { transform: translateY(1px); }
  /* Link phụ */
  .login #nav a, .login #backtoblog a {
    color: rgba(255,255,255,.7) !important; transition: color .15s;
  }
  .login #nav a:hover, .login #backtoblog a:hover { color: <?php echo $b['primary']; ?> !important; }
  .login .privacy-policy-page-link a { color: rgba(255,255,255,.5) !important; }
  /* Checkbox ghi nhớ */
  .login .forgetmenot label { color: #5E5E5E; }
  input:checked::before { color: <?php echo $b['primary']; ?>; }
  /* Thông báo lỗi bám tông brand */
  .login .message, .login #login_error {
    border-left-color: <?php echo $b['primary']; ?> !important; border-radius: 10px;
    color: #1D1D1D !important; font-weight: 500;   /* chữ tối rõ trên nền trắng (mặc định kế thừa #eaeaea xám nhạt) */
  }
  .login .message a, .login #login_error a { color: <?php echo $b['primary_dk']; ?> !important; font-weight: 600; }
</style>
<?php });

/* ============================================================
 * 2. THANH QUẢN TRỊ + MENU BÊN - nền tối, nhấn cam
 * ============================================================ */
add_action('admin_head', function () {
    $b = tnl_brand(); ?>
<style>
  /* Admin bar */
  #wpadminbar { background: <?php echo $b['dark']; ?> !important; }
  #wpadminbar .ab-item, #wpadminbar a.ab-item, #wpadminbar .ab-icon:before, #wpadminbar .ab-item:before { color: #f2f2f2 !important; }
  #wpadminbar .ab-top-menu > li:hover > .ab-item,
  #wpadminbar .ab-top-menu > li.hover > .ab-item { background: <?php echo $b['primary']; ?> !important; color: #fff !important; }
  #wpadminbar .menupop .ab-sub-wrapper { background: <?php echo $b['dark2']; ?> !important; }
  #wpadminbar .quicklinks .menupop ul li a:hover { background: <?php echo $b['primary']; ?> !important; color: #fff !important; }
  #wp-admin-bar-site-name > .ab-item:before { color: <?php echo $b['primary']; ?> !important; }

  /* Sidebar */
  #adminmenu, #adminmenuback, #adminmenuwrap { background: <?php echo $b['dark']; ?> !important; }
  #adminmenu a { color: #cfcfcf !important; }
  #adminmenu .wp-menu-image:before { color: #9a9a9a !important; }
  #adminmenu .wp-submenu { background: <?php echo $b['dark2']; ?> !important; }
  #adminmenu .wp-submenu a { color: #b7b7b7 !important; }
  #adminmenu li.menu-top:hover, #adminmenu li.opensub > a.menu-top, #adminmenu li > a.menu-top:focus { background: rgba(255,79,33,.14) !important; color: #fff !important; }
  #adminmenu li.menu-top:hover .wp-menu-image:before,
  #adminmenu li a:hover .wp-menu-image:before { color: <?php echo $b['primary']; ?> !important; }
  #adminmenu li.current a.menu-top,
  #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu,
  #adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head {
    background: <?php echo $b['primary']; ?> !important; color: #fff !important;
  }
  #adminmenu li.current .wp-menu-image:before,
  #adminmenu li.wp-has-current-submenu .wp-menu-image:before { color: #fff !important; }
  #adminmenu li.wp-has-current-submenu .wp-submenu a.current,
  #adminmenu .wp-submenu a:hover { color: <?php echo $b['primary']; ?> !important; }
  #adminmenu div.wp-menu-name { font-weight: 500; }
  #collapse-button { color: #9a9a9a !important; }

  /* Nút chính + tiêu điểm bám brand */
  .wp-core-ui .button-primary {
    background: <?php echo $b['primary']; ?> !important; border-color: <?php echo $b['primary_dk']; ?> !important;
    border-radius: 8px !important; box-shadow: none !important;
  }
  .wp-core-ui .button-primary:hover { background: <?php echo $b['primary_dk']; ?> !important; }
  a { color: <?php echo $b['primary_dk']; ?>; }

  /* Footer admin */
  #wpfooter { border-top: 3px solid <?php echo $b['primary']; ?>; }
</style>
<?php });

/* ============================================================
 * 3. MÀN HÌNH CHÀO (Dashboard) - logo + lối tắt
 * ============================================================ */
remove_action('welcome_panel', 'wp_welcome_panel');
add_action('welcome_panel', function () {
    $b = tnl_brand();
    $host = parse_url(home_url(), PHP_URL_HOST); ?>
<div style="display:flex;gap:28px;align-items:stretch;flex-wrap:wrap;padding:6px 2px;">
  <div style="flex:1;min-width:280px;">
    <img src="<?php echo esc_url($b['logo']); ?>" alt="The New Leaders" style="height:46px;margin-bottom:14px;">
    <h2 style="margin:0 0 6px;font-size:22px;">Welcome to your content hub</h2>
    <p style="color:#5E5E5E;margin:0 0 18px;max-width:560px;">
      Manage all content for <strong><?php echo esc_html($host); ?></strong> here:
      posts, events, media and pages. Every change goes live on the website.
    </p>
    <div style="display:flex;gap:10px;flex-wrap:wrap;">
      <a href="<?php echo admin_url('post-new.php'); ?>" class="button button-primary">+ New post</a>
      <a href="<?php echo admin_url('upload.php'); ?>" class="button">Media library</a>
      <a href="<?php echo admin_url('edit.php?post_type=page'); ?>" class="button">Manage pages</a>
    </div>
  </div>
  <div style="min-width:230px;background:#FFF4F0;border-radius:14px;padding:18px 20px;border-left:5px solid <?php echo $b['primary']; ?>;">
    <strong style="display:block;margin-bottom:12px;color:#1D1D1D;">Quick links</strong>
    <ul style="margin:0;padding:0;list-style:none;display:flex;flex-direction:column;gap:9px;">
      <li><a href="<?php echo admin_url('edit.php'); ?>">Posts</a></li>
      <li><a href="<?php echo admin_url('edit.php?post_type=page'); ?>">Pages</a></li>
      <li><a href="<?php echo admin_url('upload.php'); ?>">Media library</a></li>
      <li><a href="<?php echo admin_url('options-general.php'); ?>">General settings</a></li>
    </ul>
  </div>
</div>
<?php });

/* ============================================================
 * 4. FOOTER ADMIN
 * ============================================================ */
add_filter('admin_footer_text', function () {
    return '<strong>' . esc_html(get_bloginfo('name')) . '</strong> - Content Management Center';
});
add_filter('update_footer', function () {
    return esc_html(parse_url(home_url(), PHP_URL_HOST));
}, 99);

/* ============================================================
 * 5. FAVICON quản trị = logo brand
 * ============================================================ */
add_action('admin_head', function () {
    echo '<link rel="shortcut icon" href="' . esc_url(get_template_directory_uri() . '/assets/images/tnl-logo.svg') . '" type="image/svg+xml">';
});
add_action('login_head', function () {
    echo '<link rel="shortcut icon" href="' . esc_url(get_template_directory_uri() . '/assets/images/tnl-logo.svg') . '" type="image/svg+xml">';
});

/* ============================================================
 * 6. ẨN MENU KỸ THUẬT cho vai trò không phải Admin (đội content)
 * ============================================================ */
add_action('admin_menu', function () {
    if (current_user_can('administrator')) return;
    remove_menu_page('tools.php');
    remove_menu_page('themes.php');
    remove_menu_page('plugins.php');
    remove_menu_page('options-general.php');
}, 999);

/* ============================================================
 * 7. DỌN THỨ THỪA - dashboard gọn, bỏ widget/nag không cần
 * ============================================================ */

// 7a. Bỏ các widget mặc định rối mắt ở Dashboard (giữ "At a Glance").
add_action('wp_dashboard_setup', function () {
    remove_meta_box('dashboard_primary',     'dashboard', 'side');   // WordPress News
    remove_meta_box('dashboard_quick_press',  'dashboard', 'side');   // Quick Draft
    remove_meta_box('dashboard_activity',     'dashboard', 'normal'); // Activity
    remove_meta_box('dashboard_site_health',  'dashboard', 'normal'); // Site Health
    remove_meta_box('dashboard_php_nag',      'dashboard', 'normal');
}, 20);

// 7b. Bỏ mục thừa trên thanh quản trị: logo WordPress, bình luận, "New" gọn.
add_action('admin_bar_menu', function ($bar) {
    $bar->remove_node('wp-logo');       // menu logo WordPress
    $bar->remove_node('wp-logo-external');
    $bar->remove_node('comments');      // chuông bình luận (site không dùng)
    $bar->remove_node('customize');     // link Customize (theme clone không cần)
}, 999);

// 7c. Ẩn Bình luận hoàn toàn (site clone tĩnh, không dùng comment).
add_action('admin_menu', function () {
    remove_menu_page('edit-comments.php');
    remove_submenu_page('options-general.php', 'options-discussion.php');
}, 999);
add_action('admin_init', function () {
    // Chặn truy cập thẳng trang comment
    global $pagenow;
    if ($pagenow === 'edit-comments.php') { wp_safe_redirect(admin_url()); exit; }
    // Gỡ hỗ trợ comment/trackback khỏi mọi post type
    foreach (get_post_types() as $pt) {
        if (post_type_supports($pt, 'comments'))  remove_post_type_support($pt, 'comments');
        if (post_type_supports($pt, 'trackbacks')) remove_post_type_support($pt, 'trackbacks');
    }
});

// 7d. Bỏ các thông báo cập nhật/quảng cáo cho vai trò không phải Admin (đội content).
add_action('admin_head', function () {
    if (!current_user_can('administrator')) {
        remove_action('admin_notices', 'update_nag', 3);
        echo '<style>.update-nag,.notice-warning.is-dismissible,.woocommerce-message,#wp-admin-bar-updates{display:none!important;}</style>';
    }
}, 1);

// 7e. Gọn phần "Screen Options"/emoji không cần trên frontend site tĩnh.
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
