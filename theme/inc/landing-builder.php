<?php
/**
 * LANDING BUILDER - The New Leaders
 * Trình tạo landing page sự kiện cho đội no-code:
 *  - Bộ "khối sự kiện" (block patterns Gutenberg) mang brand.
 *  - Template trang "Landing sự kiện" (full-width).
 *  - Form đăng ký -> lưu lead vào WP (CPT tnl_lead) -> xuất CSV.
 * Không cần plugin, free 100%.
 */

if (!defined('ABSPATH')) exit;

/* ============================================================
 * 0. ASSET - chỉ nạp trên trang dùng template landing
 * ============================================================ */
add_action('wp_enqueue_scripts', function () {
    if (!is_page_template('page-templates/landing.php')) return;
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_style('tnl-landing', $uri . '/assets/landing.css', array(), @filemtime($dir . '/assets/landing.css') ?: '1');
    wp_enqueue_script('tnl-landing', $uri . '/assets/landing.js', array(), @filemtime($dir . '/assets/landing.js') ?: '1', true);
    wp_localize_script('tnl-landing', 'tnlLanding', array(
        'ajax'  => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('tnl_lead'),
    ));
});

/* ============================================================
 * 1. CPT tnl_lead - kho đăng ký (chỉ trong admin)
 * ============================================================ */
add_action('init', function () {
    register_post_type('tnl_lead', array(
        'labels' => array(
            'name'          => 'Đăng ký sự kiện',
            'singular_name' => 'Lượt đăng ký',
            'menu_name'     => 'Đăng ký sự kiện',
            'all_items'     => 'Tất cả đăng ký',
        ),
        'public'             => false,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-groups',
        'capability_type'    => 'post',
        'capabilities'       => array('create_posts' => 'do_not_allow'), // không tạo tay, chỉ từ form
        'map_meta_cap'       => true,
        'supports'           => array('title'),
        'show_in_rest'       => false,
    ));
});

/* ============================================================
 * 2. FORM ĐĂNG KÝ - shortcode [tnl_reg_form]
 * ============================================================ */
add_shortcode('tnl_reg_form', function ($atts) {
    $a = shortcode_atts(array(
        'title'  => 'Đăng ký tham dự',
        'button' => 'Đăng ký ngay',
        'fields' => 'name,email,phone', // name,email,phone,company,note
    ), $atts, 'tnl_reg_form');

    $fields = array_map('trim', explode(',', $a['fields']));
    $eid = get_the_ID();
    ob_start(); ?>
    <form class="tnl-regform" novalidate>
      <?php if ($a['title']) : ?><h3 class="tnl-regform__title"><?php echo esc_html($a['title']); ?></h3><?php endif; ?>
      <input type="hidden" name="event_id" value="<?php echo esc_attr($eid); ?>">
      <input type="hidden" name="nonce" value="<?php echo esc_attr(wp_create_nonce('tnl_lead')); ?>">
      <!-- honeypot chống spam -->
      <input type="text" name="website" class="tnl-hp" tabindex="-1" autocomplete="off" aria-hidden="true">

      <?php if (in_array('name', $fields)) : ?>
      <label class="tnl-field"><span>Họ và tên <b>*</b></span>
        <input type="text" name="full_name" required placeholder="Nguyễn Văn A"></label>
      <?php endif; ?>
      <?php if (in_array('email', $fields)) : ?>
      <label class="tnl-field"><span>Email <b>*</b></span>
        <input type="email" name="email" required placeholder="ban@congty.com"></label>
      <?php endif; ?>
      <?php if (in_array('phone', $fields)) : ?>
      <label class="tnl-field"><span>Số điện thoại <b>*</b></span>
        <input type="tel" name="phone" required placeholder="09xx xxx xxx"></label>
      <?php endif; ?>
      <?php if (in_array('company', $fields)) : ?>
      <label class="tnl-field"><span>Công ty / Chức vụ</span>
        <input type="text" name="company" placeholder="Tên công ty - vị trí"></label>
      <?php endif; ?>
      <?php if (in_array('note', $fields)) : ?>
      <label class="tnl-field"><span>Ghi chú</span>
        <textarea name="note" rows="3" placeholder="Câu hỏi hoặc yêu cầu đặc biệt"></textarea></label>
      <?php endif; ?>

      <button type="submit" class="tnl-regform__submit"><?php echo esc_html($a['button']); ?></button>
      <p class="tnl-regform__msg" role="status" aria-live="polite"></p>
    </form>
    <?php
    return ob_get_clean();
});

/* Xử lý gửi form (AJAX) - lưu lead */
function tnl_handle_lead() {
    $nonce = isset($_POST['nonce']) ? sanitize_text_field(wp_unslash($_POST['nonce'])) : '';
    if (!wp_verify_nonce($nonce, 'tnl_lead')) {
        wp_send_json_error(array('msg' => 'Phiên đã hết hạn, vui lòng tải lại trang.'), 403);
    }
    // honeypot: bot điền -> bỏ qua âm thầm
    if (!empty($_POST['website'])) { wp_send_json_success(array('msg' => 'Cảm ơn bạn đã đăng ký!')); }

    $name  = isset($_POST['full_name']) ? sanitize_text_field(wp_unslash($_POST['full_name'])) : '';
    $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field(wp_unslash($_POST['phone'])) : '';
    $company = isset($_POST['company']) ? sanitize_text_field(wp_unslash($_POST['company'])) : '';
    $note  = isset($_POST['note']) ? sanitize_textarea_field(wp_unslash($_POST['note'])) : '';
    $eid   = isset($_POST['event_id']) ? absint($_POST['event_id']) : 0;

    if ($name === '' || ($email === '' && $phone === '')) {
        wp_send_json_error(array('msg' => 'Vui lòng nhập họ tên và email/số điện thoại.'), 400);
    }
    if ($email !== '' && !is_email($email)) {
        wp_send_json_error(array('msg' => 'Email chưa hợp lệ.'), 400);
    }

    $event_title = $eid ? get_the_title($eid) : '';
    $lead_id = wp_insert_post(array(
        'post_type'   => 'tnl_lead',
        'post_status' => 'publish',
        'post_title'  => $name !== '' ? $name : ($email ?: $phone),
    ), true);
    if (is_wp_error($lead_id)) {
        wp_send_json_error(array('msg' => 'Có lỗi xảy ra, vui lòng thử lại.'), 500);
    }
    update_post_meta($lead_id, '_tnl_name', $name);
    update_post_meta($lead_id, '_tnl_email', $email);
    update_post_meta($lead_id, '_tnl_phone', $phone);
    update_post_meta($lead_id, '_tnl_company', $company);
    update_post_meta($lead_id, '_tnl_note', $note);
    update_post_meta($lead_id, '_tnl_event_id', $eid);
    update_post_meta($lead_id, '_tnl_event', $event_title);

    wp_send_json_success(array('msg' => 'Đăng ký thành công! Chúng tôi sẽ liên hệ sớm.'));
}
add_action('wp_ajax_tnl_submit_lead', 'tnl_handle_lead');
add_action('wp_ajax_nopriv_tnl_submit_lead', 'tnl_handle_lead');

/* ============================================================
 * 3. ĐẾM NGƯỢC - shortcode [tnl_countdown date="2026-12-31 19:00" label="..."]
 * ============================================================ */
add_shortcode('tnl_countdown', function ($atts) {
    $a = shortcode_atts(array(
        'date'  => '',
        'label' => 'Sự kiện bắt đầu sau',
    ), $atts, 'tnl_countdown');
    $ts = $a['date'] ? strtotime($a['date']) : 0;
    ob_start(); ?>
    <div class="tnl-countdown" data-deadline="<?php echo esc_attr($ts); ?>">
      <?php if ($a['label']) : ?><span class="tnl-countdown__label"><?php echo esc_html($a['label']); ?></span><?php endif; ?>
      <div class="tnl-countdown__grid">
        <div class="tnl-cd"><b data-d>00</b><span>Ngày</span></div>
        <div class="tnl-cd"><b data-h>00</b><span>Giờ</span></div>
        <div class="tnl-cd"><b data-m>00</b><span>Phút</span></div>
        <div class="tnl-cd"><b data-s>00</b><span>Giây</span></div>
      </div>
    </div>
    <?php
    return ob_get_clean();
});

/* ============================================================
 * 4. ADMIN - cột danh sách lead + xuất CSV
 * ============================================================ */
add_filter('manage_tnl_lead_posts_columns', function ($cols) {
    return array(
        'cb'        => $cols['cb'] ?? '<input type="checkbox">',
        'title'     => 'Họ tên',
        'tnl_email' => 'Email',
        'tnl_phone' => 'Số điện thoại',
        'tnl_event' => 'Sự kiện',
        'date'      => 'Ngày đăng ký',
    );
});
add_action('manage_tnl_lead_posts_custom_column', function ($col, $post_id) {
    if ($col === 'tnl_email') echo esc_html(get_post_meta($post_id, '_tnl_email', true));
    if ($col === 'tnl_phone') echo esc_html(get_post_meta($post_id, '_tnl_phone', true));
    if ($col === 'tnl_event') echo esc_html(get_post_meta($post_id, '_tnl_event', true) ?: '-');
}, 10, 2);

/* Nút "Xuất CSV" trên đầu danh sách */
add_action('restrict_manage_posts', function ($post_type) {
    if ($post_type !== 'tnl_lead') return;
    $url = wp_nonce_url(admin_url('admin-post.php?action=tnl_export_leads'), 'tnl_export');
    echo '<a href="' . esc_url($url) . '" class="button" style="margin-left:8px;">Xuất CSV</a>';
});

/* Handler xuất CSV */
add_action('admin_post_tnl_export_leads', function () {
    if (!current_user_can('edit_posts')) wp_die('Không đủ quyền.');
    check_admin_referer('tnl_export');

    $rows = get_posts(array('post_type' => 'tnl_lead', 'post_status' => 'publish', 'numberposts' => -1, 'orderby' => 'date', 'order' => 'DESC'));
    nocache_headers();
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="dang-ky-su-kien-' . date('Y-m-d') . '.csv"');
    $out = fopen('php://output', 'w');
    fprintf($out, "\xEF\xBB\xBF"); // BOM để Excel đọc tiếng Việt
    fputcsv($out, array('Họ tên', 'Email', 'Số điện thoại', 'Công ty/Chức vụ', 'Ghi chú', 'Sự kiện', 'Ngày đăng ký'));
    foreach ($rows as $r) {
        fputcsv($out, array(
            get_post_meta($r->ID, '_tnl_name', true),
            get_post_meta($r->ID, '_tnl_email', true),
            get_post_meta($r->ID, '_tnl_phone', true),
            get_post_meta($r->ID, '_tnl_company', true),
            get_post_meta($r->ID, '_tnl_note', true),
            get_post_meta($r->ID, '_tnl_event', true),
            get_the_date('Y-m-d H:i', $r),
        ));
    }
    fclose($out);
    exit;
});

/* ============================================================
 * 5. BLOCK PATTERNS - "khối sự kiện" mang brand
 * ============================================================ */
require get_template_directory() . '/inc/landing-patterns.php';
