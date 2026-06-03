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
        'public'       => false,
        'show_ui'      => true,
        'show_in_rest' => true,
        'menu_icon'    => 'dashicons-calendar-alt',
        'menu_position'=> 6,
        'supports'     => ['title', 'thumbnail', 'page-attributes'],
    ]);
}
add_action('init', 'tnl_register_event_cpt');

// ---- Meta box: Link sự kiện --------------------------------------------------
function tnl_event_metabox() {
    add_meta_box('tnl_event_link', 'Link sự kiện', function ($post) {
        wp_nonce_field('tnl_event_save', 'tnl_event_nonce');
        $url = get_post_meta($post->ID, '_tnl_event_link', true);
        echo '<p>URL khi khách bấm vào (để trống = trỏ về trang Resources).</p>';
        echo '<input type="url" name="tnl_event_link" value="' . esc_attr($url) . '" placeholder="https://..." style="width:100%">';
    }, 'event', 'side');
}
add_action('add_meta_boxes', 'tnl_event_metabox');

function tnl_event_save($post_id) {
    if (!isset($_POST['tnl_event_nonce']) || !wp_verify_nonce($_POST['tnl_event_nonce'], 'tnl_event_save')) return;
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;
    if (isset($_POST['tnl_event_link'])) {
        update_post_meta($post_id, '_tnl_event_link', esc_url_raw(wp_unslash($_POST['tnl_event_link'])));
    }
}
add_action('save_post_event', 'tnl_event_save');

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
