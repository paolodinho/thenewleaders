<?php
/**
 * LANDING ELEMENTOR - The New Leaders
 * Bộ template landing dựng bằng widget Elementor GỐC (kéo-thả, sửa inline) +
 * gắn class landing.css để khớp gu live. Sinh:
 *  - Trang "MẪU (Elementor) - ..." (Page, mở bằng Elementor) để khách Duplicate.
 *  - Section rời lưu vào Thư viện Elementor (Templates > Saved Templates) để kéo chèn.
 *
 * templateLock/Gutenberg cũ vẫn giữ nguyên; đây là hệ song song cho landing.
 */

if (!defined('ABSPATH')) exit;

/* ============================================================
 * 0. ASSET - nạp landing.css/js cho trang Elementor + editor canvas
 * ============================================================ */
add_action('wp_enqueue_scripts', function () {
    // Nạp trên trang có nội dung Elementor hoặc dùng template landing cũ
    $need = false;
    if (is_singular()) {
        $pid = get_queried_object_id();
        if ($pid && get_post_meta($pid, '_elementor_edit_mode', true) === 'builder') $need = true;
    }
    if (!$need) return;
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_style('tnl-landing', $uri . '/assets/landing.css', array(), @filemtime($dir . '/assets/landing.css') ?: '1');
    wp_enqueue_script('tnl-landing', $uri . '/assets/landing.js', array(), @filemtime($dir . '/assets/landing.js') ?: '1', true);
    wp_localize_script('tnl-landing', 'tnlLanding', array(
        'ajax'  => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('tnl_lead'),
    ));
}, 20);

/* Nạp landing.css trong khung soạn thảo Elementor để thấy đúng gu khi kéo-thả */
add_action('elementor/editor/after_enqueue_styles', function () {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_style('tnl-landing', $uri . '/assets/landing.css', array(), @filemtime($dir . '/assets/landing.css') ?: '1');
});
add_action('elementor/preview/enqueue_styles', function () {
    $dir = get_template_directory();
    $uri = get_template_directory_uri();
    wp_enqueue_style('tnl-landing', $uri . '/assets/landing.css', array(), @filemtime($dir . '/assets/landing.css') ?: '1');
});

/* ============================================================
 * 1. HELPER dựng cây phần tử Elementor (trả PHP array)
 * ============================================================ */
function tnl_el_id() { return substr(md5(uniqid((string) mt_rand(), true)), 0, 7); }

function tnl_el_section($children, $settings = array()) {
    return array('id' => tnl_el_id(), 'elType' => 'section', 'settings' => $settings, 'elements' => $children, 'isInner' => false);
}
function tnl_el_inner($children, $settings = array()) {
    $s = tnl_el_section($children, $settings); $s['isInner'] = true; return $s;
}
function tnl_el_col($children, $size = 100, $settings = array()) {
    $settings = array_merge(array('_column_size' => $size, '_inline_size' => null), $settings);
    return array('id' => tnl_el_id(), 'elType' => 'column', 'settings' => $settings, 'elements' => $children, 'isInner' => false);
}
function tnl_el_widget($type, $settings = array()) {
    return array('id' => tnl_el_id(), 'elType' => 'widget', 'widgetType' => $type, 'settings' => $settings, 'elements' => array());
}

/* Widget tiện dụng */
function tnl_elw_heading($text, $cls = '', $tag = 'h2', $extra = array()) {
    return tnl_el_widget('heading', array_merge(array('title' => $text, 'header_size' => $tag, '_css_classes' => $cls), $extra));
}
function tnl_elw_text($html, $extra = array()) {
    return tnl_el_widget('text-editor', array_merge(array('editor' => $html), $extra));
}
function tnl_elw_img($url, $cls = '', $extra = array()) {
    return tnl_el_widget('image', array_merge(array('image' => array('url' => $url, 'id' => ''), '_css_classes' => $cls), $extra));
}
function tnl_elw_btn($text, $href = '#lien-he', $cls = 'tnl-pill', $align = 'left') {
    return tnl_el_widget('button', array('text' => $text, 'link' => array('url' => $href), 'align' => $align, '_css_classes' => $cls));
}
function tnl_elw_shortcode($sc) {
    return tnl_el_widget('shortcode', array('shortcode' => $sc));
}

/* ============================================================
 * 2. SECTION COMPOSERS (khớp gu live qua class landing.css)
 * ============================================================ */

/* Hero: nền ảnh + overlay gradient cam (native Elementor - khách đổi ảnh nền dễ) */
function tnl_els_hero($title, $sub, $btn) {
    $ph = tnl_tpl_ph();
    $col = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h1', array('align' => 'center', 'title_color' => '#FFFFFF')),
        tnl_elw_text('<p style="text-align:center;color:#fff;font-size:clamp(17px,1.6vw,21px);max-width:720px;margin:12px auto 0">' . $sub . '</p>'),
        tnl_el_widget('button', array('text' => $btn, 'link' => array('url' => '#lien-he'), 'align' => 'center', '_css_classes' => 'tnl-pill tnl-pill--white')),
    ), 100);
    return tnl_el_section(array($col), array(
        'layout' => 'full_width',
        'background_background' => 'classic',
        'background_image' => array('url' => $ph, 'id' => ''),
        'background_position' => 'center center',
        'background_size' => 'cover',
        'background_overlay_background' => 'gradient',
        'background_overlay_color' => '#FF4F21',
        'background_overlay_color_b' => '#FF7121',
        'background_overlay_color_b_stop' => array('unit' => '%', 'size' => 100),
        'background_overlay_gradient_angle' => array('unit' => 'deg', 'size' => 52),
        'background_overlay_opacity' => array('unit' => 'px', 'size' => 0.92),
        'min_height' => array('unit' => 'vh', 'size' => 68),
        'content_position' => 'middle',
        'padding' => array('unit' => 'px', 'top' => '80', 'bottom' => '80', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Heading nền màu highlight + đoạn intro */
function tnl_els_intro($hl, $title, $body, $gray = false) {
    $col = tnl_el_col(array(
        tnl_elw_heading($title, 'tnl-hl tnl-hl--' . $hl, 'h2'),
        tnl_elw_text('<p style="font-size:clamp(17px,1.5vw,20px);line-height:1.7;max-width:760px">' . $body . '</p>'),
    ), 100);
    return tnl_el_section(array($col), tnl_el_secbase($gray));
}

/* Base settings cho section thường (padding + nền) */
function tnl_el_secbase($gray = false) {
    $s = array(
        'content_width' => 'boxed',
        'padding' => array('unit' => 'px', 'top' => '64', 'bottom' => '64', 'left' => '20', 'right' => '20', 'isLinked' => false),
    );
    if ($gray) { $s['background_background'] = 'classic'; $s['background_color'] = '#F7F5F2'; }
    return $s;
}

/* Bảng màu panel (khớp gu live) */
function tnl_el_panel_color($color) {
    $map = array('cyan' => '#5AD3ED', 'green' => '#AFE56B', 'yellow' => '#FFC75A', 'orange' => '#FF9B52');
    return isset($map[$color]) ? $map[$color] : '#5AD3ED';
}
function tnl_el_radius_all() {
    return array('unit' => 'px', 'top' => 18, 'right' => 18, 'bottom' => 18, 'left' => 18, 'isLinked' => true);
}

/* Khối màu (panel): thẻ màu (chữ) + thẻ ảnh cạnh nhau, đều bo góc, có khe nhỏ.
 * $rev = đảo bên. Native (không _css_classes) - stack sạch trên mobile, không tràn. */
function tnl_els_panel($color, $title, $body, $btn, $rev = false) {
    $ph  = tnl_tpl_ph();
    $hex = tnl_el_panel_color($color);
    $textcol = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h3', array('title_color' => '#14212B')),
        tnl_elw_text('<p style="font-size:clamp(16px,1.3vw,19px);color:#1c1c1c;line-height:1.6;margin:0 0 20px">' . $body . '</p>'),
        tnl_elw_btn($btn, '#lien-he', 'tnl-pill', 'left'),
    ), 50, array(
        'background_background' => 'classic', 'background_color' => $hex,
        'padding' => array('unit' => 'px', 'top' => '40', 'bottom' => '40', 'left' => '40', 'right' => '40', 'isLinked' => true),
        'border_radius' => tnl_el_radius_all(),
    ));
    $imgcol = tnl_el_col(array(
        tnl_el_widget('spacer', array('space' => array('unit' => 'px', 'size' => 280), 'space_tablet' => array('unit' => 'px', 'size' => 240), 'space_mobile' => array('unit' => 'px', 'size' => 200))),
    ), 50, array(
        'background_background' => 'classic', 'background_image' => array('url' => $ph, 'id' => ''),
        'background_position' => 'center center', 'background_size' => 'cover', 'background_color' => '#F1EDEA',
        'border_radius' => tnl_el_radius_all(),
        'padding' => array('unit' => 'px', 'top' => '0', 'bottom' => '0', 'left' => '0', 'right' => '0', 'isLinked' => true),
    ));
    $cols = $rev ? array($imgcol, $textcol) : array($textcol, $imgcol);
    return tnl_el_section($cols, array(
        'gap' => 'narrow', 'content_width' => 'boxed',
        'padding' => array('unit' => 'px', 'top' => '14', 'bottom' => '14', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Dải liên hệ cam cuối trang */
function tnl_els_contact($title = 'Liên hệ với chúng tôi', $sub = 'Để lại thông tin hoặc liên hệ trực tiếp - The New Leaders sẽ đồng hành cùng bạn.') {
    $col = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h2', array('align' => 'center', 'title_color' => '#FFFFFF')),
        tnl_elw_text('<p style="text-align:center;color:#fff;max-width:640px;margin:8px auto 0">' . $sub . '</p>'),
        tnl_el_widget('button', array('text' => 'Gửi email cho chúng tôi', 'link' => array('url' => 'mailto:info@thenewleaders.asia'), 'align' => 'center', '_css_classes' => 'tnl-pill tnl-pill--white')),
    ), 100);
    return tnl_el_section(array($col), array(
        '_element_id' => 'lien-he',
        'background_background' => 'classic',
        'background_color' => '#FF4F21',
        'content_width' => 'boxed',
        'padding' => array('unit' => 'px', 'top' => '72', 'bottom' => '72', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Bọc 1 heading nền màu vào 1 section riêng (dùng làm tiêu đề nhóm) */
function tnl_els_grouphead($hl, $title, $gray = false) {
    $col = tnl_el_col(array(tnl_elw_heading($title, 'tnl-hl tnl-hl--' . $hl, 'h2')), 100);
    return tnl_el_section(array($col), array_merge(tnl_el_secbase($gray), array(
        'padding' => array('unit' => 'px', 'top' => '56', 'bottom' => '8', 'left' => '20', 'right' => '20', 'isLinked' => false),
    )));
}

/* Icon FontAwesome nhanh */
function tnl_el_icon($fa) { return array('value' => $fa, 'library' => 'fa-solid'); }

/* Section có tiêu đề nền màu + 1 hàng cột con (inner) bên dưới */
function tnl_els_titled($hl, $title, $inner_cols, $gray = false, $inner_settings = array()) {
    $col = tnl_el_col(array(
        tnl_elw_heading($title, 'tnl-hl tnl-hl--' . $hl, 'h2'),
        tnl_el_inner($inner_cols, array_merge(array('content_width' => 'boxed', 'gap' => 'wide'), $inner_settings)),
    ), 100);
    return tnl_el_section(array($col), tnl_el_secbase($gray));
}

/* Thẻ icon-box (2-4 thẻ). $cards = [[fa, title, desc], ...] */
function tnl_els_cards($hl, $title, $cards, $gray = false) {
    $n = max(1, count($cards)); $size = intval(100 / $n);
    $cols = array();
    foreach ($cards as $c) {
        $cols[] = tnl_el_col(array(tnl_el_widget('icon-box', array(
            'selected_icon' => tnl_el_icon($c[0]),
            'title_text' => $c[1], 'description_text' => $c[2],
            'position' => 'top', 'title_size' => 'h3',
            'primary_color' => '#FF4F21', '_css_classes' => 'tnl-card',
        ))), $size);
    }
    return tnl_els_titled($hl, $title, $cols, $gray);
}

/* Con số uy tín (counter) trên nền sáng ấm */
function tnl_els_stats($title, $stats) {
    $cols = array(); $size = intval(100 / max(1, count($stats)));
    foreach ($stats as $s) {
        $cols[] = tnl_el_col(array(tnl_el_widget('counter', array(
            'starting_number' => 0, 'ending_number' => $s[0], 'suffix' => $s[1], 'title' => $s[2],
            'number_color' => '#FF4F21', 'title_color' => '#14212B',
        ))), $size);
    }
    $col = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h2', array('align' => 'center', 'title_color' => '#14212B')),
        tnl_el_inner($cols),
    ), 100);
    return tnl_el_section(array($col), array(
        'background_background' => 'classic', 'background_color' => '#FFF3EE',
        'padding' => array('unit' => 'px', 'top' => '64', 'bottom' => '64', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Các bước / quy trình (số lớn cam + tiêu đề + mô tả) */
function tnl_els_steps($hl, $title, $steps, $gray = false) {
    $cols = array(); $i = 1; $size = intval(100 / max(1, count($steps)));
    foreach ($steps as $s) {
        $cols[] = tnl_el_col(array(
            tnl_elw_heading((string) $i, 'tnl-stepnum', 'div'),
            tnl_elw_heading($s[0], '', 'h3'),
            tnl_elw_text('<p>' . $s[1] . '</p>'),
        ), $size);
        $i++;
    }
    return tnl_els_titled($hl, $title, $cols, $gray);
}

/* Ảnh + chữ (feature) xen kẽ */
function tnl_els_feat($kicker, $title, $body, $btn, $rev = false, $gray = false) {
    $img = tnl_el_col(array(tnl_elw_img(tnl_tpl_ph(), 'tnl-featimg')), 50);
    $txt = tnl_el_col(array(
        tnl_elw_text('<p style="color:#FF4F21;font-weight:700;letter-spacing:.05em;text-transform:uppercase;margin:0 0 8px;font-size:14px">' . $kicker . '</p>'),
        tnl_elw_heading($title, '', 'h2'),
        tnl_elw_text('<p style="font-size:clamp(16px,1.4vw,19px);line-height:1.7">' . $body . '</p>'),
        tnl_elw_btn($btn, '#lien-he', 'tnl-pill', 'left'),
    ), 50);
    $cols = $rev ? array($txt, $img) : array($img, $txt);
    return tnl_el_section(array(tnl_el_col(array(tnl_el_inner($cols, array('gap' => 'wide'))), 100)), tnl_el_secbase($gray));
}

/* 2 cột nội dung */
function tnl_els_2col($hl, $title, $left, $right, $gray = false) {
    $inner = tnl_el_inner(array(
        tnl_el_col(array(tnl_elw_text('<p>' . $left . '</p>')), 50),
        tnl_el_col(array(tnl_elw_text('<p>' . $right . '</p>')), 50),
    ), array('gap' => 'wide'));
    return tnl_el_section(array(tnl_el_col(array(tnl_elw_heading($title, 'tnl-hl tnl-hl--' . $hl, 'h2'), $inner), 100)), tnl_el_secbase($gray));
}

/* Trích dẫn testimonial 1 khối lớn */
function tnl_elw_testi($q, $name, $job) {
    return tnl_el_widget('testimonial', array(
        'testimonial_content' => $q, 'testimonial_image' => array('url' => tnl_tpl_ph(), 'id' => ''),
        'testimonial_name' => $name, 'testimonial_job' => $job, 'testimonial_image_position' => 'aside',
    ));
}
function tnl_els_quote($q, $by, $job = 'Chức danh - Công ty') {
    return tnl_el_section(array(tnl_el_col(array(tnl_elw_testi($q, $by, $job)), 100)), tnl_el_secbase(true));
}

/* 3 đánh giá cạnh nhau */
function tnl_els_testis($title, $items, $gray = true) {
    $cols = array(); $size = intval(100 / max(1, count($items)));
    foreach ($items as $it) $cols[] = tnl_el_col(array(tnl_elw_testi($it[0], $it[1], $it[2])), $size);
    $col = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h2', array('align' => 'center')),
        tnl_el_inner($cols, array('gap' => 'wide')),
    ), 100);
    return tnl_el_section(array($col), tnl_el_secbase($gray));
}

/* FAQ accordion (native, editable) */
function tnl_els_faq($hl, $title, $qas, $gray = false) {
    $tabs = array();
    foreach ($qas as $qa) $tabs[] = array('tab_title' => $qa[0], 'tab_content' => '<p>' . $qa[1] . '</p>', '_id' => tnl_el_id());
    $acc = tnl_el_widget('accordion', array('tabs' => $tabs, 'title_html_tag' => 'h3'));
    return tnl_el_section(array(tnl_el_col(array(tnl_elw_heading($title, 'tnl-hl tnl-hl--' . $hl, 'h2'), $acc), 100)), tnl_el_secbase($gray));
}

/* Dải kêu gọi (band) tối/sáng */
function tnl_els_band($dark, $title, $sub, $btn) {
    $bg = $dark ? '#14212B' : '#FFF3EE'; $tc = $dark ? '#ffffff' : '#14212B';
    $pill = $dark ? 'tnl-pill tnl-pill--white' : 'tnl-pill';
    $col = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h2', array('align' => 'center', 'title_color' => $tc)),
        tnl_elw_text('<p style="text-align:center;color:' . $tc . ';max-width:640px;margin:8px auto 0">' . $sub . '</p>'),
        tnl_el_widget('button', array('text' => $btn, 'link' => array('url' => '#lien-he'), 'align' => 'center', '_css_classes' => $pill)),
    ), 100);
    return tnl_el_section(array($col), array(
        'background_background' => 'classic', 'background_color' => $bg,
        'padding' => array('unit' => 'px', 'top' => '72', 'bottom' => '72', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Video nhúng YouTube */
function tnl_els_video($hl, $title, $gray = false) {
    $col = tnl_el_col(array(
        tnl_elw_heading($title, 'tnl-hl tnl-hl--' . $hl, 'h2'),
        tnl_el_widget('video', array('video_type' => 'youtube', 'youtube_url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ')),
    ), 100);
    return tnl_el_section(array($col), tnl_el_secbase($gray));
}

/* Form đăng ký (shortcode thu lead) */
function tnl_els_regform($title = 'Đăng ký tham dự', $sub = 'Điền thông tin để giữ chỗ. Ban tổ chức sẽ liên hệ xác nhận.') {
    $col = tnl_el_col(array(
        tnl_elw_heading($title, '', 'h2', array('align' => 'center')),
        tnl_elw_text('<p style="text-align:center;max-width:560px;margin:0 auto 10px">' . $sub . '</p>'),
        tnl_elw_shortcode('[tnl_reg_form title="" button="Đăng ký ngay" fields="name,email,phone,company"]'),
    ), 100);
    return tnl_el_section(array($col), array_merge(tnl_el_secbase(true), array('_element_id' => 'dang-ky')));
}

/* Đồng hồ đếm ngược */
function tnl_els_countdown($date = '2026-12-31 20:00', $label = 'Bắt đầu sau') {
    $col = tnl_el_col(array(tnl_elw_shortcode('[tnl_countdown date="' . $date . '" label="' . $label . '"]')), 100);
    return tnl_el_section(array($col), array(
        'background_background' => 'classic', 'background_color' => '#14212B',
        'padding' => array('unit' => 'px', 'top' => '44', 'bottom' => '44', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Hero ưu đãi nền tối + badge + đếm ngược */
function tnl_els_offerhero($badge, $title, $sub, $btn, $date) {
    $col = tnl_el_col(array(
        tnl_elw_text('<p style="text-align:center;color:#FFC75A;font-weight:700;letter-spacing:.08em;text-transform:uppercase;margin:0 0 10px">' . $badge . '</p>'),
        tnl_elw_heading($title, '', 'h1', array('align' => 'center', 'title_color' => '#ffffff')),
        tnl_elw_text('<p style="text-align:center;color:#fff;max-width:680px;margin:12px auto 0;font-size:clamp(16px,1.5vw,20px)">' . $sub . '</p>'),
        tnl_el_widget('button', array('text' => $btn, 'link' => array('url' => '#uu-dai'), 'align' => 'center', '_css_classes' => 'tnl-pill')),
        tnl_elw_shortcode('[tnl_countdown date="' . $date . '" label="Ưu đãi kết thúc sau"]'),
    ), 100);
    return tnl_el_section(array($col), array(
        'background_background' => 'classic', 'background_color' => '#14212B',
        'padding' => array('unit' => 'px', 'top' => '80', 'bottom' => '80', 'left' => '20', 'right' => '20', 'isLinked' => false),
    ));
}

/* Thẻ giá ưu đãi (card trắng giữa trang) */
function tnl_els_pricing($plan, $old, $now, $save, $items, $note, $btn) {
    $li = array();
    foreach ($items as $it) $li[] = array('text' => $it, 'selected_icon' => tnl_el_icon('fas fa-check'), '_id' => tnl_el_id());
    $card = tnl_el_col(array(
        tnl_elw_text('<p style="text-align:center;margin:0 0 12px"><span style="background:#FF4F21;color:#fff;padding:5px 16px;border-radius:100px;font-weight:700;font-size:14px">' . $save . '</span></p>'),
        tnl_elw_heading($plan, '', 'h3', array('align' => 'center')),
        tnl_elw_text('<p style="text-align:center;color:#9aa0a6;text-decoration:line-through;margin:0">' . $old . '</p>'),
        tnl_elw_heading($now, '', 'h2', array('align' => 'center', 'title_color' => '#FF4F21')),
        tnl_el_widget('icon-list', array('icon_list' => $li, 'icon_color' => '#FF4F21', 'space_between' => array('unit' => 'px', 'size' => 10))),
        tnl_el_widget('button', array('text' => $btn, 'link' => array('url' => '#lien-he'), 'align' => 'center', '_css_classes' => 'tnl-pill')),
        tnl_elw_text('<p style="text-align:center;color:#888;font-size:13px;margin:14px 0 0">' . $note . '</p>'),
    ), 56, array(
        'background_background' => 'classic', 'background_color' => '#ffffff',
        'border_border' => 'solid', 'border_width' => array('unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true), 'border_color' => '#ececec',
        'border_radius' => array('unit' => 'px', 'top' => 20, 'right' => 20, 'bottom' => 20, 'left' => 20, 'isLinked' => true),
        'padding' => array('unit' => 'px', 'top' => '44', 'bottom' => '44', 'left' => '44', 'right' => '44', 'isLinked' => true),
    ));
    $inner = tnl_el_inner(array(tnl_el_col(array(), 22), $card, tnl_el_col(array(), 22)), array('gap' => 'no'));
    $col = tnl_el_col(array(
        tnl_elw_heading('Ưu đãi của bạn', 'tnl-hl tnl-hl--orange tnl-hl--center', 'h2'),
        $inner,
    ), 100);
    return tnl_el_section(array($col), array_merge(tnl_el_secbase(true), array('_element_id' => 'uu-dai')));
}

/* Thẻ báo cáo (tag + tiêu đề + mô tả) - dùng icon-box biến thể */
function tnl_els_reports($hl, $title, $items, $gray = false) {
    $n = max(1, count($items)); $size = intval(100 / $n);
    $cols = array();
    foreach ($items as $c) {
        $cols[] = tnl_el_col(array(
            tnl_elw_text('<p style="color:#FF4F21;font-weight:700;font-size:13px;text-transform:uppercase;letter-spacing:.04em;margin:0 0 6px">' . $c[0] . '</p>'),
            tnl_elw_heading($c[1], '', 'h3'),
            tnl_elw_text('<p>' . $c[2] . '</p>'),
        ), $size, array(
            'background_background' => 'classic', 'background_color' => '#ffffff',
            'border_border' => 'solid', 'border_width' => array('unit' => 'px', 'top' => '1', 'right' => '1', 'bottom' => '1', 'left' => '1', 'isLinked' => true), 'border_color' => '#ececec',
            'border_radius' => array('unit' => 'px', 'top' => 16, 'right' => 16, 'bottom' => 16, 'left' => 16, 'isLinked' => true),
            'padding' => array('unit' => 'px', 'top' => '28', 'bottom' => '28', 'left' => '28', 'right' => '28', 'isLinked' => true),
        ));
    }
    return tnl_els_titled($hl, $title, $cols, $gray);
}

/* Info cards sự kiện (ngày/giờ/địa điểm/hình thức) */
function tnl_els_infocards($hl, $title, $cards) {
    return tnl_els_cards($hl, $title, $cards, false);
}

/* ============================================================
 * 3. COMPOSE CÁC TRANG DÀI, ĐẦY ĐỦ (thừa hơn thiếu)
 * ============================================================ */
/* Mỗi panel giờ là 1 section top-level -> trả nguyên mảng để splat vào trang */
function tnl_els_panels($panels) {
    return $panels;
}

/* ---- TRANG 1: CHƯƠNG TRÌNH / KHOÁ HỌC (dài) ---- */
function tnl_el_page_course() {
    return array(
        tnl_els_hero('Nâng tầm kỹ năng lãnh đạo và giao tiếp bằng trí tuệ cảm xúc (EQ)',
            'Mô tả ngắn gọn giá trị cốt lõi của chương trình dành cho cá nhân hoặc doanh nghiệp.',
            'Tham gia ngay với chúng tôi'),
        tnl_els_stats('Nền tảng đáng tin cậy', array(
            array(20, '+', 'Năm kinh nghiệm'), array(1000, '+', 'Học viên'), array(50, '+', 'Doanh nghiệp đối tác'), array(98, '%', 'Hài lòng'),
        )),
        tnl_els_intro('cyan', 'Chương trình dành cho bạn',
            'Mô tả tổng quan chương trình: dành cho ai, mang lại điều gì, vì sao khác biệt. Viết 2-3 câu tự nhiên, tập trung vào lợi ích người học nhận được.', false),
        tnl_els_feat('Phương pháp', 'Học đi đôi với thực hành',
            'Mô tả phương pháp đào tạo: kết hợp lý thuyết nền tảng với bài tập tình huống thực tế, phản hồi cá nhân hoá và đồng hành sau khoá học.', 'Tìm hiểu phương pháp', false),
        tnl_els_grouphead('yellow', 'Nội dung chương trình', false),
        ...tnl_els_panels(array(
            tnl_els_panel('cyan', 'Học phần 1: Nền tảng EQ', 'Mô tả ngắn nội dung học phần: học viên sẽ nắm được gì sau phần này.', 'Tìm hiểu thêm', false),
            tnl_els_panel('orange', 'Học phần 2: Lãnh đạo bằng cảm xúc', 'Mô tả ngắn nội dung học phần: kỹ năng và giá trị thực tiễn.', 'Tìm hiểu thêm', true),
            tnl_els_panel('green', 'Học phần 3: Giao tiếp hiệu quả', 'Mô tả ngắn nội dung học phần: áp dụng vào công việc hằng ngày.', 'Tìm hiểu thêm', false),
        )),
        tnl_els_steps('green', 'Lộ trình học tập', array(
            array('Đăng ký & khảo sát', 'Xác định nhu cầu và mục tiêu của bạn.'),
            array('Học nền tảng', 'Nắm vững khung năng lực EQ cốt lõi.'),
            array('Thực hành tình huống', 'Áp dụng vào case thực tế, nhận phản hồi.'),
            array('Đồng hành sau khoá', 'Hỗ trợ duy trì và phát triển dài hạn.'),
        ), true),
        tnl_els_cards('cyan', 'Vì sao chọn chúng tôi', array(
            array('fas fa-graduation-cap', 'Giảng viên chuyên môn', 'Đội ngũ giàu kinh nghiệm thực chiến.'),
            array('fas fa-users', 'Lớp học nhỏ', 'Tương tác sâu, cá nhân hoá lộ trình.'),
            array('fas fa-heart', 'Đồng hành lâu dài', 'Hỗ trợ cả sau khi kết thúc khoá học.'),
        )),
        tnl_els_video('orange', 'Xem giới thiệu chương trình'),
        tnl_els_testis('Cảm nhận của học viên', array(
            array('Chương trình thực sự thay đổi cách đội ngũ chúng tôi làm việc cùng nhau.', 'Tên học viên', 'Chức danh - Công ty'),
            array('Nội dung sâu sắc, giảng viên tận tâm. Áp dụng được ngay.', 'Tên học viên', 'Chức danh - Công ty'),
            array('Một trải nghiệm học tập khác biệt, tập trung vào EQ.', 'Tên học viên', 'Chức danh - Công ty'),
        )),
        tnl_els_faq('yellow', 'Câu hỏi thường gặp', array(
            array('Chương trình phù hợp với ai?', 'Mô tả đối tượng phù hợp: quản lý, trưởng nhóm, cá nhân muốn phát triển EQ.'),
            array('Thời lượng bao lâu?', 'Mô tả thời lượng và hình thức học.'),
            array('Có hỗ trợ sau khoá không?', 'Mô tả chính sách đồng hành sau khoá học.'),
        )),
        tnl_els_band(true, 'Sẵn sàng nâng tầm đội ngũ?', 'Đăng ký nhận tư vấn lộ trình phù hợp với bạn hoặc doanh nghiệp.', 'Nhận tư vấn miễn phí'),
        tnl_els_contact('Sẵn sàng bắt đầu?', 'Liên hệ để nhận tư vấn lộ trình phù hợp với bạn hoặc doanh nghiệp.'),
    );
}

/* ---- TRANG 2: SẢN PHẨM (dài) ---- */
function tnl_el_page_product() {
    return array(
        tnl_els_hero('Tên sản phẩm của bạn',
            'Một câu mô tả ngắn gọn, hấp dẫn về giá trị sản phẩm mang lại cho người dùng.', 'Đặt hàng ngay'),
        tnl_els_intro('cyan', 'Về sản phẩm này',
            'Mô tả 2-3 câu về sản phẩm: nó là gì, giải quyết vấn đề gì, vì sao đáng sở hữu. Viết tự nhiên, tập trung vào người dùng.', false),
        tnl_els_feat('Điểm khác biệt', 'Vì sao sản phẩm này đáng chú ý',
            'Mô tả giá trị cốt lõi và điểm khác biệt của sản phẩm so với lựa chọn khác trên thị trường.', 'Khám phá ngay', false),
        tnl_els_grouphead('green', 'Điểm nổi bật', false),
        ...tnl_els_panels(array(
            tnl_els_panel('cyan', 'Lợi ích 1', 'Mô tả ngắn lợi ích nổi bật thứ nhất của sản phẩm.', 'Tìm hiểu thêm', false),
            tnl_els_panel('orange', 'Lợi ích 2', 'Mô tả ngắn lợi ích nổi bật thứ hai của sản phẩm.', 'Tìm hiểu thêm', true),
            tnl_els_panel('yellow', 'Lợi ích 3', 'Mô tả ngắn lợi ích nổi bật thứ ba của sản phẩm.', 'Tìm hiểu thêm', false),
        )),
        tnl_els_cards('orange', 'Ai sẽ yêu thích sản phẩm này', array(
            array('fas fa-user', 'Cá nhân', 'Phù hợp cho nhu cầu cá nhân.'),
            array('fas fa-users', 'Đội nhóm', 'Tối ưu cho làm việc nhóm.'),
            array('fas fa-building', 'Doanh nghiệp', 'Giải pháp cho tổ chức.'),
        )),
        tnl_els_stats('Con số biết nói', array(
            array(500, '+', 'Khách hàng'), array(4, '.9', 'Điểm đánh giá'), array(24, '/7', 'Hỗ trợ'),
        )),
        tnl_els_quote('Sản phẩm giúp chúng tôi tiết kiệm thời gian và làm việc hiệu quả hơn hẳn.', 'Tên khách hàng'),
        tnl_els_faq('yellow', 'Câu hỏi thường gặp', array(
            array('Sản phẩm có bảo hành không?', 'Mô tả chính sách bảo hành / hỗ trợ.'),
            array('Giao hàng thế nào?', 'Mô tả hình thức và thời gian giao hàng.'),
        )),
        tnl_els_band(false, 'Trải nghiệm ngay hôm nay', 'Đặt hàng hoặc liên hệ để được tư vấn chi tiết.', 'Đặt hàng ngay'),
        tnl_els_contact(),
    );
}

/* ---- TRANG 3: ĐÁNH GIÁ / BÁO CÁO (dài) ---- */
function tnl_el_page_assessment() {
    return array(
        tnl_els_hero('Tên bài đánh giá / chỉ số',
            'Đo lường và thấu hiểu năng lực qua bộ báo cáo chuyên sâu. Mô tả ngắn gọn công cụ đánh giá này giúp gì.', 'Làm bài đánh giá'),
        tnl_els_intro('cyan', 'Giá trị bạn nhận được',
            'Mô tả kết quả người dùng nhận được: hiểu bản thân/đội ngũ rõ hơn, có cơ sở ra quyết định, lộ trình phát triển cụ thể.', false),
        tnl_els_cards('green', 'Bạn sẽ đo được gì', array(
            array('fas fa-brain', 'Năng lực cảm xúc', 'Đo mức độ nhận biết và quản lý cảm xúc.'),
            array('fas fa-comments', 'Kỹ năng giao tiếp', 'Đánh giá hiệu quả giao tiếp và lắng nghe.'),
            array('fas fa-chart-line', 'Tiềm năng lãnh đạo', 'Xác định điểm mạnh lãnh đạo.'),
        )),
        tnl_els_grouphead('yellow', 'Các loại báo cáo', false),
        tnl_els_reports('yellow', 'Bộ báo cáo linh hoạt', array(
            array('Cá nhân', 'Báo cáo cá nhân', 'Đo lường và gợi ý phát triển cho từng người.'),
            array('Đội nhóm', 'Báo cáo đội nhóm', 'Bức tranh tổng thể cho quản lý.'),
            array('Tổ chức', 'Báo cáo tổ chức', 'Dữ liệu cấp doanh nghiệp để ra quyết định.'),
        ), true),
        tnl_els_steps('cyan', 'Quy trình đánh giá', array(
            array('Làm bài', 'Trả lời bộ câu hỏi chuẩn hoá.'),
            array('Phân tích', 'Hệ thống xử lý và chấm điểm.'),
            array('Nhận báo cáo', 'Kết quả chi tiết kèm gợi ý.'),
        )),
        tnl_els_stats('Được tin dùng', array(
            array(10000, '+', 'Lượt đánh giá'), array(200, '+', 'Tổ chức'), array(95, '%', 'Độ tin cậy'),
        )),
        tnl_els_testis('Đối tác nói gì', array(
            array('Báo cáo giúp chúng tôi hiểu đội ngũ sâu sắc hơn bao giờ hết.', 'Tên khách hàng', 'Chức danh - Công ty'),
            array('Công cụ đánh giá trực quan, dễ áp dụng vào quản trị nhân sự.', 'Tên khách hàng', 'Chức danh - Công ty'),
            array('Dữ liệu đáng tin cậy, hỗ trợ ra quyết định tốt hơn.', 'Tên khách hàng', 'Chức danh - Công ty'),
        )),
        tnl_els_faq('green', 'Câu hỏi thường gặp', array(
            array('Bài đánh giá mất bao lâu?', 'Mô tả thời lượng trung bình.'),
            array('Kết quả có bảo mật không?', 'Mô tả chính sách bảo mật dữ liệu.'),
        )),
        tnl_els_band(true, 'Bắt đầu đánh giá ngay', 'Liên hệ để triển khai cho cá nhân hoặc tổ chức.', 'Đăng ký đánh giá'),
        tnl_els_contact('Bắt đầu đánh giá ngay', 'Liên hệ để được hướng dẫn triển khai đánh giá cho cá nhân hoặc tổ chức.'),
    );
}

/* ---- TRANG 4: ƯU ĐÃI (dài) ---- */
function tnl_el_page_offer() {
    return array(
        tnl_els_offerhero('ƯU ĐÃI CÓ HẠN', 'Ưu đãi đặc biệt dành cho bạn',
            'Mô tả ngắn gọn ưu đãi: giảm giá bao nhiêu, áp dụng cho gì, trong thời gian nào. Tạo cảm giác cấp bách.',
            'Nhận ưu đãi ngay', '2026-08-31 23:59'),
        tnl_els_intro('orange', 'Vì sao nên nhận ngay',
            'Mô tả 2-3 câu giá trị người nhận có được: tiết kiệm chi phí, quyền lợi đi kèm, vì sao đây là thời điểm tốt nhất để tham gia.', false),
        tnl_els_cards('cyan', 'Quyền lợi nổi bật', array(
            array('fas fa-gift', 'Quyền lợi 1', 'Mô tả ngắn quyền lợi đi kèm.'),
            array('fas fa-bolt', 'Quyền lợi 2', 'Mô tả ngắn quyền lợi đi kèm.'),
            array('fas fa-handshake', 'Quyền lợi 3', 'Mô tả ngắn quyền lợi đi kèm.'),
        )),
        tnl_els_grouphead('green', 'Ưu đãi gồm những gì', false),
        ...tnl_els_panels(array(
            tnl_els_panel('green', 'Gói quyền lợi A', 'Mô tả chi tiết nhóm quyền lợi thứ nhất trong ưu đãi.', 'Xem chi tiết', false),
            tnl_els_panel('yellow', 'Gói quyền lợi B', 'Mô tả chi tiết nhóm quyền lợi thứ hai trong ưu đãi.', 'Xem chi tiết', true),
        )),
        tnl_els_pricing('Gói ưu đãi', '2.000.000đ', '1.200.000đ', 'Tiết kiệm 40%',
            array('Quyền lợi 1 đi kèm ưu đãi', 'Quyền lợi 2 đi kèm ưu đãi', 'Quyền lợi 3 đi kèm ưu đãi', 'Hỗ trợ &amp; đồng hành sau chương trình'),
            'Số lượng có hạn - áp dụng đến hết 31/08/2026.', 'Đăng ký nhận ưu đãi'),
        tnl_els_testis('Khách hàng đã nhận ưu đãi', array(
            array('Nhận ưu đãi đúng lúc, quá hời so với giá trị nhận lại.', 'Tên khách hàng', 'Chức danh - Công ty'),
            array('Quy trình đăng ký nhanh gọn, hỗ trợ nhiệt tình.', 'Tên khách hàng', 'Chức danh - Công ty'),
            array('Rất đáng để tham gia, sẽ giới thiệu cho bạn bè.', 'Tên khách hàng', 'Chức danh - Công ty'),
        )),
        tnl_els_faq('cyan', 'Câu hỏi thường gặp', array(
            array('Ưu đãi áp dụng đến khi nào?', 'Mô tả thời hạn áp dụng.'),
            array('Làm sao để nhận ưu đãi?', 'Mô tả các bước nhận ưu đãi.'),
        )),
        tnl_els_contact('Đăng ký nhận ưu đãi', 'Để lại thông tin - The New Leaders sẽ liên hệ xác nhận và hướng dẫn nhận ưu đãi.'),
    );
}

/* ---- TRANG 5: SỰ KIỆN (dài) ---- */
function tnl_el_page_event() {
    return array(
        tnl_els_hero('Tên sự kiện của bạn tại đây',
            'Một câu mô tả ngắn gọn, hấp dẫn về giá trị người tham dự nhận được.', 'Đăng ký tham dự'),
        tnl_els_countdown('2026-08-20 19:00', 'Sự kiện bắt đầu sau'),
        tnl_els_infocards('yellow', 'Thông tin sự kiện', array(
            array('fas fa-calendar', 'Ngày', '20/08/2026'),
            array('fas fa-clock', 'Thời gian', '19:00 - 21:00'),
            array('fas fa-map-marker-alt', 'Địa điểm', 'TP. Hồ Chí Minh'),
            array('fas fa-ticket-alt', 'Hình thức', 'Trực tiếp / Miễn phí'),
        )),
        tnl_els_intro('cyan', 'Về sự kiện',
            'Mô tả chi tiết: nội dung chính, người tham dự sẽ học được gì, vì sao quan trọng. Viết 2-3 đoạn tự nhiên, tập trung vào lợi ích.', false),
        tnl_els_feat('Điểm nhấn', 'Bạn sẽ nhận được gì khi tham dự',
            'Mô tả các giá trị nổi bật: kiến thức, kết nối, trải nghiệm. Vì sao không nên bỏ lỡ sự kiện này.', 'Đăng ký ngay', true),
        tnl_els_grouphead('green', 'Diễn giả', false),
        ...tnl_els_panels(array(
            tnl_els_panel('cyan', 'Tên diễn giả', 'Chức danh - Công ty. Mô tả ngắn về diễn giả và kinh nghiệm.', 'Xem thêm', false),
            tnl_els_panel('orange', 'Tên diễn giả', 'Chức danh - Công ty. Mô tả ngắn về diễn giả và kinh nghiệm.', 'Xem thêm', true),
        )),
        tnl_els_steps('yellow', 'Chương trình sự kiện', array(
            array('Đón khách', 'Check-in và kết nối.'),
            array('Phần chính', 'Nội dung trọng tâm của sự kiện.'),
            array('Hỏi & đáp', 'Giao lưu cùng diễn giả.'),
            array('Networking', 'Mở rộng mối quan hệ.'),
        ), true),
        tnl_els_regform('Đăng ký tham dự', 'Điền thông tin để giữ chỗ. Ban tổ chức sẽ liên hệ xác nhận.'),
        tnl_els_testis('Cảm nhận người tham dự trước', array(
            array('Sự kiện chất lượng, nội dung thiết thực và truyền cảm hứng.', 'Tên người tham dự', 'Chức danh - Công ty'),
            array('Cơ hội kết nối tuyệt vời với những người cùng chí hướng.', 'Tên người tham dự', 'Chức danh - Công ty'),
            array('Tổ chức chuyên nghiệp, sẽ tiếp tục tham gia lần sau.', 'Tên người tham dự', 'Chức danh - Công ty'),
        )),
        tnl_els_faq('cyan', 'Câu hỏi thường gặp', array(
            array('Sự kiện có thu phí không?', 'Mô tả chính sách phí tham dự.'),
            array('Tôi cần chuẩn bị gì?', 'Mô tả những điều người tham dự nên chuẩn bị.'),
        )),
        tnl_els_contact('Liên hệ ban tổ chức', 'Cần thêm thông tin về sự kiện? Liên hệ với chúng tôi.'),
    );
}

/* ============================================================
 * 4. TẠO POST elementor (Page + Saved Template)
 * ============================================================ */
function tnl_el_save_page($title, $slug, $elements) {
    $data = wp_slash(wp_json_encode($elements));
    $existing = get_page_by_path($slug, OBJECT, 'page');
    $arr = array('post_title' => $title, 'post_name' => $slug, 'post_type' => 'page', 'post_status' => 'publish', 'post_content' => '');
    if ($existing) { $arr['ID'] = $existing->ID; $id = wp_update_post($arr); }
    else { $id = wp_insert_post($arr); }
    if (!$id || is_wp_error($id)) return 0;
    update_post_meta($id, '_elementor_edit_mode', 'builder');
    update_post_meta($id, '_elementor_data', $data);
    update_post_meta($id, '_elementor_template_type', 'wp-page');
    update_post_meta($id, '_wp_page_template', 'elementor_header_footer');
    if (defined('ELEMENTOR_VERSION')) update_post_meta($id, '_elementor_version', ELEMENTOR_VERSION);
    return $id;
}

function tnl_el_save_section($title, $slug, $elements) {
    $data = wp_slash(wp_json_encode($elements));
    $q = get_posts(array('post_type' => 'elementor_library', 'name' => $slug, 'post_status' => 'publish', 'numberposts' => 1));
    $arr = array('post_title' => $title, 'post_name' => $slug, 'post_type' => 'elementor_library', 'post_status' => 'publish', 'post_content' => '');
    if ($q) { $arr['ID'] = $q[0]->ID; $id = wp_update_post($arr); }
    else { $id = wp_insert_post($arr); }
    if (!$id || is_wp_error($id)) return 0;
    update_post_meta($id, '_elementor_edit_mode', 'builder');
    update_post_meta($id, '_elementor_data', $data);
    update_post_meta($id, '_elementor_template_type', 'section');
    if (defined('ELEMENTOR_VERSION')) update_post_meta($id, '_elementor_version', ELEMENTOR_VERSION);
    wp_set_object_terms($id, 'section', 'elementor_library_type');
    return $id;
}

/* Danh sách 5 trang mẫu */
function tnl_el_pages() {
    return array(
        array('MẪU (Elementor) - Chương trình / Khoá học', 'mau-el-chuong-trinh', tnl_el_page_course()),
        array('MẪU (Elementor) - Sản phẩm',                'mau-el-san-pham',     tnl_el_page_product()),
        array('MẪU (Elementor) - Đánh giá / Báo cáo',      'mau-el-danh-gia',     tnl_el_page_assessment()),
        array('MẪU (Elementor) - Ưu đãi',                  'mau-el-uu-dai',       tnl_el_page_offer()),
        array('MẪU (Elementor) - Sự kiện',                 'mau-el-su-kien',      tnl_el_page_event()),
    );
}

/* Thư viện section rời -> Elementor Saved Templates. [title, slug, [elements]] */
function tnl_el_sections() {
    $S = array();
    $S[] = array('TNL - Hero ảnh nền overlay cam', 'tnl-el-hero', array(tnl_els_hero('Tiêu đề chính của bạn', 'Một câu mô tả ngắn gọn, hấp dẫn.', 'Nút hành động')));
    $S[] = array('TNL - Hero ưu đãi (nền tối + đếm ngược)', 'tnl-el-offerhero', array(tnl_els_offerhero('NHÃN NỔI BẬT', 'Tiêu đề ưu đãi / sự kiện', 'Mô tả ngắn tạo cấp bách.', 'Nút hành động', '2026-12-31 20:00')));
    foreach (array('cyan' => 'xanh dương', 'green' => 'xanh lá', 'yellow' => 'vàng', 'orange' => 'cam') as $c => $vn) {
        $S[] = array('TNL - Tiêu đề nền ' . $vn . ' + đoạn văn', 'tnl-el-intro-' . $c, array(tnl_els_intro($c, 'Tiêu đề mục (nền ' . $vn . ')', 'Đoạn giới thiệu nội dung mục này. Viết 2-3 câu tự nhiên.', false)));
    }
    $S[] = array('TNL - Khối màu xanh dương + ảnh', 'tnl-el-panel-cyan', array(tnl_els_panel('cyan', 'Tiêu đề khối', 'Mô tả ngắn nội dung khối này.', 'Tìm hiểu thêm', false)));
    $S[] = array('TNL - Khối màu cam + ảnh (đảo)', 'tnl-el-panel-orange', array(tnl_els_panel('orange', 'Tiêu đề khối', 'Mô tả ngắn nội dung khối này.', 'Tìm hiểu thêm', true)));
    $S[] = array('TNL - Khối màu xanh lá + ảnh', 'tnl-el-panel-green', array(tnl_els_panel('green', 'Tiêu đề khối', 'Mô tả ngắn nội dung khối này.', 'Tìm hiểu thêm', false)));
    $S[] = array('TNL - Khối màu vàng + ảnh (đảo)', 'tnl-el-panel-yellow', array(tnl_els_panel('yellow', 'Tiêu đề khối', 'Mô tả ngắn nội dung khối này.', 'Tìm hiểu thêm', true)));
    $S[] = array('TNL - 2 khối màu xen kẽ', 'tnl-el-panels2', array(tnl_els_panel('cyan', 'Khối 1', 'Mô tả ngắn.', 'Tìm hiểu thêm', false), tnl_els_panel('orange', 'Khối 2', 'Mô tả ngắn.', 'Tìm hiểu thêm', true)));
    $S[] = array('TNL - Ảnh + chữ (feature)', 'tnl-el-feat', array(tnl_els_feat('Nhãn nhỏ', 'Tiêu đề mục', 'Mô tả nội dung mục này, 2-3 câu tự nhiên.', 'Tìm hiểu thêm', false)));
    $S[] = array('TNL - Ảnh + chữ (đảo bên)', 'tnl-el-feat-rev', array(tnl_els_feat('Nhãn nhỏ', 'Tiêu đề mục', 'Mô tả nội dung mục này, 2-3 câu tự nhiên.', 'Tìm hiểu thêm', true)));
    $S[] = array('TNL - 3 thẻ icon', 'tnl-el-cards', array(tnl_els_cards('cyan', 'Tiêu đề 3 thẻ', array(array('fas fa-star', 'Thẻ 1', 'Mô tả ngắn.'), array('fas fa-lightbulb', 'Thẻ 2', 'Mô tả ngắn.'), array('fas fa-bullseye', 'Thẻ 3', 'Mô tả ngắn.')))));
    $S[] = array('TNL - Con số uy tín (counter)', 'tnl-el-stats', array(tnl_els_stats('Con số biết nói', array(array(20, '+', 'Năm kinh nghiệm'), array(1000, '+', 'Khách hàng'), array(50, '+', 'Đối tác'), array(98, '%', 'Hài lòng')))));
    $S[] = array('TNL - Các bước / quy trình', 'tnl-el-steps', array(tnl_els_steps('green', 'Quy trình 4 bước', array(array('Bước 1', 'Mô tả ngắn.'), array('Bước 2', 'Mô tả ngắn.'), array('Bước 3', 'Mô tả ngắn.'), array('Bước 4', 'Mô tả ngắn.')))));
    $S[] = array('TNL - Thẻ báo cáo (tag + tiêu đề)', 'tnl-el-reports', array(tnl_els_reports('yellow', 'Các loại báo cáo', array(array('Cá nhân', 'Báo cáo cá nhân', 'Mô tả ngắn.'), array('Đội nhóm', 'Báo cáo đội nhóm', 'Mô tả ngắn.'), array('Tổ chức', 'Báo cáo tổ chức', 'Mô tả ngắn.')))));
    $S[] = array('TNL - Thẻ giá / ưu đãi', 'tnl-el-pricing', array(tnl_els_pricing('Gói ưu đãi', '2.000.000đ', '1.200.000đ', 'Tiết kiệm 40%', array('Quyền lợi 1', 'Quyền lợi 2', 'Quyền lợi 3'), 'Ghi chú điều kiện áp dụng.', 'Đăng ký ngay')));
    $S[] = array('TNL - 2 cột nội dung', 'tnl-el-2col', array(tnl_els_2col('green', 'Tiêu đề mục', 'Nội dung cột trái.', 'Nội dung cột phải.')));
    $S[] = array('TNL - Video nhúng (YouTube)', 'tnl-el-video', array(tnl_els_video('orange', 'Xem video giới thiệu')));
    $S[] = array('TNL - Trích dẫn (testimonial lớn)', 'tnl-el-quote', array(tnl_els_quote('Một câu trích dẫn ấn tượng đặt tại đây để tạo điểm nhấn.', 'Tên người')));
    $S[] = array('TNL - 3 đánh giá', 'tnl-el-testis', array(tnl_els_testis('Cảm nhận khách hàng', array(array('Đánh giá ngắn của khách hàng thứ nhất.', 'Tên khách hàng', 'Chức danh'), array('Đánh giá ngắn của khách hàng thứ hai.', 'Tên khách hàng', 'Chức danh'), array('Đánh giá ngắn của khách hàng thứ ba.', 'Tên khách hàng', 'Chức danh')))));
    $S[] = array('TNL - Câu hỏi thường gặp (FAQ)', 'tnl-el-faq', array(tnl_els_faq('yellow', 'Câu hỏi thường gặp', array(array('Câu hỏi 1?', 'Câu trả lời cho câu hỏi 1.'), array('Câu hỏi 2?', 'Câu trả lời cho câu hỏi 2.'), array('Câu hỏi 3?', 'Câu trả lời cho câu hỏi 3.')))));
    $S[] = array('TNL - Dải kêu gọi (nền tối)', 'tnl-el-band-dark', array(tnl_els_band(true, 'Tiêu đề kêu gọi hành động', 'Một câu thuyết phục ngắn.', 'Nút hành động')));
    $S[] = array('TNL - Dải kêu gọi (nền sáng)', 'tnl-el-band-light', array(tnl_els_band(false, 'Tiêu đề kêu gọi hành động', 'Một câu thuyết phục ngắn.', 'Nút hành động')));
    $S[] = array('TNL - Dải liên hệ (nền cam)', 'tnl-el-contact', array(tnl_els_contact()));
    $S[] = array('TNL - Form đăng ký (thu lead)', 'tnl-el-regform', array(tnl_els_regform()));
    $S[] = array('TNL - Đồng hồ đếm ngược', 'tnl-el-countdown', array(tnl_els_countdown('2026-12-31 20:00', 'Bắt đầu sau')));
    return $S;
}

/* Sinh toàn bộ (WP-CLI hoặc bootstrap theo version) */
function tnl_el_generate() {
    $out = array('pages' => array(), 'sections' => 0);
    foreach (tnl_el_pages() as $p)    { $out['pages'][$p[1]] = tnl_el_save_page($p[0], $p[1], $p[2]); }
    foreach (tnl_el_sections() as $s) { if (tnl_el_save_section($s[0], $s[1], $s[2])) $out['sections']++; }
    return $out;
}

/* Tự sinh theo phiên bản trên live (không cần WP-CLI). Bump khi đổi thiết kế. */
define('TNL_EL_VER', '1');
add_action('admin_init', function () {
    if (!defined('ELEMENTOR_VERSION')) return;
    if (get_option('tnl_el_pages_ver') === TNL_EL_VER) return;
    if (!current_user_can('edit_pages')) return;
    tnl_el_generate();
    update_option('tnl_el_pages_ver', TNL_EL_VER);
});
