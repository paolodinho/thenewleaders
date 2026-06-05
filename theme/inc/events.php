<?php
/**
 * Events / Sự kiện — CPT cho section "Cùng nhau phát triển" trang chủ.
 * Khách tự thêm/sửa/sắp xếp/ẩn-hiện sự kiện qua admin (no-code).
 *  - Tiêu đề   : tên sự kiện
 *  - Ảnh đại diện: poster/banner
 *  - Order (Page Attributes): thứ tự hiển thị (số nhỏ lên trước)
 *  - Link sự kiện (meta): URL khi bấm vào; trống = trỏ về trang Resources
 *  - Trạng thái: Published = hiện, Draft = ẩn
 */
defined('ABSPATH') || exit;

// ---- Đăng ký CPT -------------------------------------------------------------
function tnl_register_event_cpt() {
    register_post_type('event', [
        'labels' => [
            'name'          => 'Sự kiện',
            'singular_name' => 'Sự kiện',
            'add_new'       => 'Thêm sự kiện',
            'add_new_item'  => 'Thêm sự kiện mới',
            'edit_item'     => 'Sửa sự kiện',
            'all_items'     => 'Tất cả sự kiện',
            'menu_name'     => 'Sự kiện',
        ],
        'public'       => true,
        'show_ui'      => true,
        'show_in_rest' => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-calendar-alt',
        'menu_position'=> 6,
        'supports'     => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'rewrite'      => ['slug' => 'su-kien', 'with_front' => false],
    ]);
    // Flush 1 lần khi đổi cấu trúc rewrite
    if (get_option('tnl_event_rw') !== '2') {
        flush_rewrite_rules(false);
        update_option('tnl_event_rw', '2');
    }
}
add_action('init', 'tnl_register_event_cpt');

// ---- Meta box: Link sự kiện --------------------------------------------------
function tnl_event_metabox() {
    add_meta_box('tnl_event_meta', 'Thông tin sự kiện', function ($post) {
        wp_nonce_field('tnl_event_save', 'tnl_event_nonce');
        $f = function ($k) use ($post) { return get_post_meta($post->ID, $k, true); };
        echo '<p><label><b>Ngày/giờ</b><br><input type="text" name="tnl_event_date" value="' . esc_attr($f('_tnl_event_date')) . '" placeholder="15/04/2026, 13:30-17:00" style="width:100%"></label></p>';
        echo '<p><label><b>Địa điểm</b><br><input type="text" name="tnl_event_location" value="' . esc_attr($f('_tnl_event_location')) . '" placeholder="TP. Hồ Chí Minh" style="width:100%"></label></p>';
        echo '<p><label><b>Link đăng ký</b><br><input type="url" name="tnl_event_register" value="' . esc_attr($f('_tnl_event_register')) . '" placeholder="https://..." style="width:100%"></label></p>';
        echo '<p><label><b>Tiêu đề tiếng Việt</b><br><input type="text" name="tnl_event_title_vi" value="' . esc_attr($f('_tnl_event_title_vi')) . '" placeholder="(để hiển thị tên VI)" style="width:100%"></label></p>';
        echo '<hr><p><label><b>Link ngoài (tuỳ chọn)</b><br><input type="url" name="tnl_event_link" value="' . esc_attr($f('_tnl_event_link')) . '" placeholder="để trống = mở trang chi tiết" style="width:100%"></label></p>';
    }, 'event', 'side');
}
add_action('add_meta_boxes', 'tnl_event_metabox');

function tnl_event_save($post_id) {
    if (!isset($_POST['tnl_event_nonce']) || !wp_verify_nonce($_POST['tnl_event_nonce'], 'tnl_event_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    $text = ['_tnl_event_date' => 'tnl_event_date', '_tnl_event_location' => 'tnl_event_location', '_tnl_event_title_vi' => 'tnl_event_title_vi'];
    foreach ($text as $meta => $field) {
        if (isset($_POST[$field])) update_post_meta($post_id, $meta, sanitize_text_field(wp_unslash($_POST[$field])));
    }
    foreach (['_tnl_event_register' => 'tnl_event_register', '_tnl_event_link' => 'tnl_event_link'] as $meta => $field) {
        if (isset($_POST[$field])) update_post_meta($post_id, $meta, esc_url_raw(wp_unslash($_POST[$field])));
    }
}
add_action('save_post_event', 'tnl_event_save');

/* Tên hiển thị theo ngôn ngữ (dùng meta title_vi nếu có khi đang ở bản VI) */
function tnl_event_title($id = null) {
    $id = $id ?: get_the_ID();
    $vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
    if ($vi) {
        $t = get_post_meta($id, '_tnl_event_title_vi', true);
        if ($t) return $t;
    }
    return get_the_title($id);
}

// ---- Cột admin: ảnh + thứ tự -------------------------------------------------
add_filter('manage_event_posts_columns', function ($cols) {
    $new = ['cb' => $cols['cb'], 'thumb' => 'Ảnh', 'title' => 'Tên sự kiện', 'menu_order' => 'Thứ tự', 'date' => $cols['date']];
    return $new;
});
add_action('manage_event_posts_custom_column', function ($col, $post_id) {
    if ($col === 'thumb') {
        echo has_post_thumbnail($post_id) ? get_the_post_thumbnail($post_id, [60, 40]) : '—';
    } elseif ($col === 'menu_order') {
        echo (int) get_post_field('menu_order', $post_id);
    }
}, 10, 2);
add_filter('manage_edit-event_sortable_columns', function ($cols) {
    $cols['menu_order'] = 'menu_order';
    return $cols;
});

// Mặc định sắp theo thứ tự (menu_order) trong admin
add_action('pre_get_posts', function ($q) {
    if (is_admin() && $q->is_main_query() && $q->get('post_type') === 'event' && !$q->get('orderby')) {
        $q->set('orderby', 'menu_order');
        $q->set('order', 'ASC');
    }
});
