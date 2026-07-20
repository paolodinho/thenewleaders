<?php
/**
 * LANDING TEMPLATES - The New Leaders
 * Bộ "trang mẫu dựng sẵn" theo bố cục các trang live (Sản phẩm / Chương trình /
 * Đánh giá / Sự kiện). Đội no-code chỉ Duplicate trang mẫu rồi sửa chữ + ảnh.
 *
 * - Section builder (editable Gutenberg blocks) mang brand TNL.
 * - Đăng ký patterns (danh mục "Trang mẫu") + composed full-page.
 * - Sinh sẵn các trang "MẪU - ..." (template landing) để Duplicate.
 */

if (!defined('ABSPATH')) exit;

/* Ảnh placeholder - khách thay bằng ảnh thật */
function tnl_tpl_ph() { return get_template_directory_uri() . '/assets/images/tnl-placeholder.svg'; }

/* Khoá cấu trúc từng section: khách KHÔNG kéo/thêm/xoá khối con (không vỡ layout),
 * nhưng vẫn bấm sửa được chữ + đổi ảnh. Cả section vẫn kéo đổi thứ tự được trong List View.
 * templateLock chỉ là metadata trình soạn - không đổi HTML front-end. */
function tnl_lock_sections($html) {
    if (!is_string($html) || $html === '') return $html;
    $html = str_replace('<!-- wp:group {"tagName":"section",', '<!-- wp:group {"tagName":"section","templateLock":"all",', $html);
    $html = str_replace('<!-- wp:cover {', '<!-- wp:cover {"templateLock":"all",', $html);
    return $html;
}

/* ============================================================
 * SECTION BUILDERS - trả về markup block Gutenberg (editable)
 * ============================================================ */

/* Product hero: chữ trái + ảnh phải */
function tnl_sec_phero($kicker, $title, $sub, $btn, $img) {
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-phero","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-phero">
<!-- wp:columns {"verticalAlignment":"center","className":"tnl-phero__grid"} --><div class="wp-block-columns are-vertically-aligned-center tnl-phero__grid">
<!-- wp:column {"verticalAlignment":"center","width":"52%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:52%">
<!-- wp:paragraph {"className":"tnl-kicker"} --><p class="tnl-kicker">' . $kicker . '</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"tnl-phero__title"} --><h1 class="tnl-phero__title">' . $title . '</h1><!-- /wp:heading -->
<!-- wp:paragraph {"className":"tnl-phero__sub"} --><p class="tnl-phero__sub">' . $sub . '</p><!-- /wp:paragraph -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-btn"} --><div class="wp-block-button tnl-btn"><a class="wp-block-button__link wp-element-button" href="#lien-he">' . $btn . '</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</div><!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"48%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:48%">
<!-- wp:image {"className":"tnl-phero__img"} --><figure class="wp-block-image tnl-phero__img"><img src="' . esc_url($img) . '" alt="' . esc_attr($title) . '"/></figure><!-- /wp:image -->
</div><!-- /wp:column -->
</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* Feature ảnh + chữ (xen kẽ, $rev = đảo bên) */
function tnl_sec_feat($kicker, $title, $body, $img, $rev = false) {
    $cls = 'tnl-sec tnl-feat' . ($rev ? ' tnl-feat--rev' : '');
    return '
<!-- wp:group {"tagName":"section","className":"' . $cls . '","layout":{"type":"constrained"}} -->
<section class="wp-block-group ' . $cls . '">
<!-- wp:columns {"verticalAlignment":"center","className":"tnl-feat__grid"} --><div class="wp-block-columns are-vertically-aligned-center tnl-feat__grid">
<!-- wp:column {"verticalAlignment":"center","width":"50%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
<!-- wp:image {"className":"tnl-feat__img"} --><figure class="wp-block-image tnl-feat__img"><img src="' . esc_url($img) . '" alt="' . esc_attr($title) . '"/></figure><!-- /wp:image -->
</div><!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"50%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
<!-- wp:paragraph {"className":"tnl-kicker"} --><p class="tnl-kicker">' . $kicker . '</p><!-- /wp:paragraph -->
<!-- wp:heading {"className":"tnl-h2"} --><h2 class="tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>' . $body . '</p><!-- /wp:paragraph -->
</div><!-- /wp:column -->
</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* 3 thẻ (audience / lý do). $cards = [[ico,title,desc],...] */
function tnl_sec_cards3($title, $cards, $extra_cls = 'tnl-aud') {
    $cols = '';
    foreach ($cards as $c) {
        $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card">'
            . '<!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">' . $c[0] . '</p><!-- /wp:paragraph -->'
            . '<!-- wp:heading {"level":3} --><h3>' . $c[1] . '</h3><!-- /wp:heading -->'
            . '<!-- wp:paragraph --><p>' . $c[2] . '</p><!-- /wp:paragraph -->'
            . '</div><!-- /wp:group --></div><!-- /wp:column -->';
    }
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec ' . $extra_cls . '","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec ' . $extra_cls . '">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-cards3"} --><div class="wp-block-columns tnl-cards3">' . $cols . '</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* Program grid: thẻ tiêu đề + mô tả, viền cam trái */
function tnl_sec_prog($kicker, $title, $items) {
    $cols = '';
    foreach ($items as $c) {
        $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card">'
            . '<!-- wp:heading {"level":3} --><h3>' . $c[0] . '</h3><!-- /wp:heading -->'
            . '<!-- wp:paragraph --><p>' . $c[1] . '</p><!-- /wp:paragraph -->'
            . '</div><!-- /wp:group --></div><!-- /wp:column -->';
    }
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-prog","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-prog">
<!-- wp:paragraph {"align":"center","className":"tnl-kicker"} --><p class="has-text-align-center tnl-kicker">' . $kicker . '</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-prog__grid"} --><div class="wp-block-columns tnl-prog__grid">' . $cols . '</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* Credibility (nền tối, 3 con số/điểm) */
function tnl_sec_cred($title, $stats) {
    $cols = '';
    foreach ($stats as $s) {
        $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card">'
            . '<!-- wp:heading {"level":3} --><h3>' . $s[0] . '</h3><!-- /wp:heading -->'
            . '<!-- wp:paragraph --><p>' . $s[1] . '</p><!-- /wp:paragraph -->'
            . '</div><!-- /wp:group --></div><!-- /wp:column -->';
    }
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-cred","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-cred">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-cred__row"} --><div class="wp-block-columns tnl-cred__row">' . $cols . '</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* Reports (loại báo cáo assessment): thẻ tag + tiêu đề + mô tả */
function tnl_sec_reports($kicker, $title, $items) {
    $cols = '';
    foreach ($items as $c) {
        $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card">'
            . '<!-- wp:paragraph {"className":"tnl-tag"} --><p class="tnl-tag">' . $c[0] . '</p><!-- /wp:paragraph -->'
            . '<!-- wp:heading {"level":3} --><h3>' . $c[1] . '</h3><!-- /wp:heading -->'
            . '<!-- wp:paragraph --><p>' . $c[2] . '</p><!-- /wp:paragraph -->'
            . '</div><!-- /wp:group --></div><!-- /wp:column -->';
    }
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-reports","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-reports">
<!-- wp:paragraph {"align":"center","className":"tnl-kicker"} --><p class="has-text-align-center tnl-kicker">' . $kicker . '</p><!-- /wp:paragraph -->
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-reports__grid"} --><div class="wp-block-columns tnl-reports__grid">' . $cols . '</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* Testimonial "Lắng nghe từ đối tác" - 3 quote card (HTML block để giữ layout avatar) */
function tnl_sec_testi($title = 'Lắng nghe từ đối tác của chúng tôi') {
    $ph = tnl_tpl_ph();
    $card = function ($quote, $name, $role) use ($ph) {
        return '<!-- wp:column --><div class="wp-block-column"><!-- wp:html --><div class="tnl-testi__card">'
            . '<p class="tnl-testi__quote">"' . $quote . '"</p>'
            . '<div class="tnl-testi__who"><img src="' . esc_url($ph) . '" alt="' . esc_attr($name) . '"><div>'
            . '<p class="tnl-testi__name">' . $name . '</p><p class="tnl-testi__role">' . $role . '</p></div></div>'
            . '</div><!-- /wp:html --></div><!-- /wp:column -->';
    };
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-testi","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-testi">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-testi__grid"} --><div class="wp-block-columns tnl-testi__grid">'
    . $card('Chương trình thực sự thay đổi cách đội ngũ của chúng tôi làm việc cùng nhau. Rất đáng giá.', 'Tên khách hàng', 'Chức danh - Công ty')
    . $card('Nội dung sâu sắc, giảng viên tận tâm. Tôi áp dụng được ngay vào công việc lãnh đạo hằng ngày.', 'Tên khách hàng', 'Chức danh - Công ty')
    . $card('Một trải nghiệm học tập khác biệt, tập trung vào trí tuệ cảm xúc chứ không chỉ lý thuyết.', 'Tên khách hàng', 'Chức danh - Công ty')
    . '</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->';
}

/* Contact band "Liên hệ" - dải cam cuối trang */
function tnl_sec_contact($title = 'Liên hệ với chúng tôi', $sub = 'Để lại thông tin hoặc liên hệ trực tiếp - The New Leaders sẽ đồng hành cùng bạn.') {
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-contact","anchor":"lien-he","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-contact" id="lien-he">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"tnl-contact__sub"} --><p class="has-text-align-center tnl-contact__sub">' . $sub . '</p><!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-btn tnl-btn--light"} --><div class="wp-block-button tnl-btn tnl-btn--light"><a class="wp-block-button__link wp-element-button" href="mailto:info@thenewleaders.asia">Gửi email cho chúng tôi</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
<!-- wp:html --><div class="tnl-contact__info"><span>📞 <a href="tel:+84916663670">(84) 91 666 3670</a></span><span>✉️ <a href="mailto:info@thenewleaders.asia">info@thenewleaders.asia</a></span></div><!-- /wp:html -->
</section>
<!-- /wp:group -->';
}

/* Offer hero: nền tối, badge ưu đãi, tiêu đề, đếm ngược tạo cấp bách, CTA */
function tnl_sec_offer_hero($badge, $title, $sub, $btn, $countdown_date = '') {
    $cd = $countdown_date ? '<!-- wp:shortcode -->[tnl_countdown date="' . esc_attr($countdown_date) . '" label="Ưu đãi kết thúc sau"]<!-- /wp:shortcode -->' : '';
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-offer","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-offer">
<!-- wp:paragraph {"align":"center","className":"tnl-offer__badge"} --><p class="has-text-align-center tnl-offer__badge">' . $badge . '</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"textAlign":"center","className":"tnl-offer__title"} --><h1 class="has-text-align-center tnl-offer__title">' . $title . '</h1><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"tnl-offer__sub"} --><p class="has-text-align-center tnl-offer__sub">' . $sub . '</p><!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-btn"} --><div class="wp-block-button tnl-btn"><a class="wp-block-button__link wp-element-button" href="#uu-dai">Nhận ưu đãi ngay</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
' . $cd . '
</section>
<!-- /wp:group -->';
}

/* Thẻ giá ưu đãi: giá gốc gạch, giá ưu đãi, tiết kiệm, danh sách gồm, CTA, ghi chú */
function tnl_sec_pricing($title, $old, $now, $save, $items, $note, $btn) {
    $li = '';
    foreach ($items as $it) $li .= '<li>' . $it . '</li>';
    return '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-pricing","anchor":"uu-dai","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-pricing" id="uu-dai">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:html --><div class="tnl-price">
<span class="tnl-price__badge">' . $save . '</span>
<p class="tnl-price__old">' . $old . '</p>
<p class="tnl-price__now">' . $now . '</p>
<ul class="tnl-price__list">' . $li . '</ul>
<div class="wp-block-buttons" style="justify-content:center;display:flex"><div class="wp-block-button tnl-btn"><a class="wp-block-button__link wp-element-button" href="#lien-he">' . $btn . '</a></div></div>
<p class="tnl-price__note">' . $note . '</p>
</div><!-- /wp:html -->
</section>
<!-- /wp:group -->';
}

/* ============================================================
 * SECTION BUILDERS V2 - khớp gu trang live
 * ============================================================ */

/* Hero overlay bằng Cover block (khách đổi ảnh nền dễ) + nút pill trắng */
function tnl_secx_hero($title, $sub, $btn) {
    $img = tnl_tpl_ph();
    $grad = 'linear-gradient(51.56deg,rgb(255,79,33) 21.87%,rgba(255,113,33,0.92) 76.79%)';
    return '
<!-- wp:cover {"url":"' . esc_url($img) . '","dimRatio":90,"customGradient":"' . $grad . '","contentPosition":"center center","align":"full","className":"tnl-xhero"} -->
<div class="wp-block-cover alignfull tnl-xhero"><span aria-hidden="true" class="wp-block-cover__background has-background-dim-90 has-background-dim wp-block-cover__gradient-background has-background-gradient" style="background:' . $grad . '"></span><img class="wp-block-cover__image-background" alt="" src="' . esc_url($img) . '" data-object-fit="cover"/><div class="wp-block-cover__inner-container">
<!-- wp:heading {"level":1,"textAlign":"center"} --><h1 class="wp-block-heading has-text-align-center">' . $title . '</h1><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">' . $sub . '</p><!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-pill tnl-pill--white"} --><div class="wp-block-button tnl-pill tnl-pill--white"><a class="wp-block-button__link wp-element-button" href="#lien-he">' . $btn . '</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</div></div>
<!-- /wp:cover -->';
}

/* Section: heading nền màu highlight + đoạn intro */
function tnl_secx_intro($hl_color, $title, $body, $gray = false) {
    $seccls = 'tnl-secx' . ($gray ? ' tnl-bg-gray' : '');
    return '
<!-- wp:group {"tagName":"section","className":"' . $seccls . '","layout":{"type":"constrained"}} -->
<section class="wp-block-group ' . $seccls . '">
<!-- wp:heading {"className":"tnl-hl tnl-hl--' . $hl_color . '"} --><h2 class="wp-block-heading tnl-hl tnl-hl--' . $hl_color . '">' . $title . '</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p style="font-size:clamp(17px,1.5vw,20px);line-height:1.7;max-width:760px">' . $body . '</p><!-- /wp:paragraph -->
</section>
<!-- /wp:group -->';
}

/* Khối feature nền màu (panel màu + ảnh). $side: false=panel trái, true=panel phải */
function tnl_secx_panel($color, $title, $body, $btn, $rev = false) {
    $img = tnl_tpl_ph();
    $cls = 'tnl-panel tnl-panel--' . $color . ($rev ? ' tnl-panel--rev' : '');
    return '
<!-- wp:html --><div class="' . $cls . '">
<div class="tnl-panel__c"><h3>' . $title . '</h3><p>' . $body . '</p>
<div class="wp-block-buttons"><div class="wp-block-button tnl-pill"><a class="wp-block-button__link wp-element-button" href="#lien-he">' . $btn . '</a></div></div></div>
<div class="tnl-panel__img" style="background-image:url(' . esc_url($img) . ')"></div>
</div><!-- /wp:html -->';
}

/* Testimonial lớn kiểu live: heading khổng lồ + hàng quote xen kẽ */
function tnl_secx_bigtesti($title = 'Cảm nhận của học viên') {
    $ph = tnl_tpl_ph();
    $row = function ($q, $n, $r, $rev) use ($ph) {
        return '<div class="tnl-bigtesti__row' . ($rev ? ' tnl-bigtesti__row--rev' : '') . '">'
            . '<img src="' . esc_url($ph) . '" alt="' . esc_attr($n) . '">'
            . '<div><p class="tnl-bigtesti__q">"' . $q . '"</p><p class="tnl-bigtesti__n">' . $n . '</p><p class="tnl-bigtesti__r">' . $r . '</p></div></div>';
    };
    return '
<!-- wp:group {"tagName":"section","className":"tnl-secx","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-secx">
<!-- wp:html --><h2 class="tnl-bigtesti__h">' . $title . '</h2>'
    . $row('Chương trình thực sự thay đổi cách đội ngũ của chúng tôi làm việc cùng nhau. Rất đáng giá.', 'Tên khách hàng', 'Chức danh - Công ty', false)
    . $row('Nội dung sâu sắc, giảng viên tận tâm. Tôi áp dụng được ngay vào công việc lãnh đạo hằng ngày.', 'Tên khách hàng', 'Chức danh - Công ty', true)
    . $row('Một trải nghiệm học tập khác biệt, tập trung vào trí tuệ cảm xúc chứ không chỉ lý thuyết.', 'Tên khách hàng', 'Chức danh - Công ty', false)
    . '<!-- /wp:html -->
</section>
<!-- /wp:group -->';
}

/* ============================================================
 * COMPOSE - các trang mẫu đầy đủ
 * ============================================================ */
function tnl_landing_templates() {
    $ph = tnl_tpl_ph();
    $T = array();

    /* ---- MẪU 1: Sản phẩm / Bộ sản phẩm (design khớp gu live) ---- */
    $T['product'] = array(
        'title'   => 'MẪU - Trang Sản phẩm',
        'slug'    => 'mau-san-pham',
        'content' =>
            tnl_secx_hero('Tên sản phẩm của bạn',
                'Một câu mô tả ngắn gọn, hấp dẫn về giá trị sản phẩm mang lại cho người dùng.',
                'Đặt hàng ngay')
          . tnl_secx_intro('cyan', 'Về sản phẩm này',
                'Mô tả 2-3 câu về sản phẩm: nó là gì, giải quyết vấn đề gì, vì sao đáng sở hữu. Viết tự nhiên, tập trung vào người dùng.', false)
          . '<!-- wp:group {"tagName":"section","className":"tnl-secx tnl-bg-gray","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx tnl-bg-gray">'
          . '<!-- wp:heading {"className":"tnl-hl tnl-hl--green"} --><h2 class="wp-block-heading tnl-hl tnl-hl--green">Điểm nổi bật</h2><!-- /wp:heading -->'
          . tnl_secx_panel('cyan',   'Lợi ích 1', 'Mô tả ngắn lợi ích nổi bật thứ nhất của sản phẩm.', 'Tìm hiểu thêm', false)
          . tnl_secx_panel('orange', 'Lợi ích 2', 'Mô tả ngắn lợi ích nổi bật thứ hai của sản phẩm.', 'Tìm hiểu thêm', true)
          . tnl_secx_panel('yellow', 'Lợi ích 3', 'Mô tả ngắn lợi ích nổi bật thứ ba của sản phẩm.', 'Tìm hiểu thêm', false)
          . '</section><!-- /wp:group -->'
          . tnl_secx_intro('orange', 'Ai sẽ yêu thích sản phẩm này?',
                'Mô tả nhóm khách hàng phù hợp: cá nhân, đội ngũ, doanh nghiệp. Vì sao sản phẩm dành cho họ.', true)
          . tnl_secx_bigtesti('Lắng nghe từ đối tác của chúng tôi')
          . tnl_sec_contact(),
    );

    /* ---- MẪU 2: Chương trình / Khoá học (design khớp gu live) ---- */
    $T['course'] = array(
        'title'   => 'MẪU - Trang Chương trình / Khoá học',
        'slug'    => 'mau-chuong-trinh',
        'content' =>
            tnl_secx_hero('Nâng tầm kỹ năng lãnh đạo và giao tiếp bằng trí tuệ cảm xúc (EQ) theo tiêu chuẩn quốc tế',
                'Mô tả ngắn gọn giá trị cốt lõi của chương trình dành cho cá nhân hoặc doanh nghiệp.',
                'Tham gia ngay với chúng tôi')
          . tnl_secx_intro('cyan', 'Chương trình dành cho bạn',
                'Mô tả tổng quan chương trình: dành cho ai, mang lại điều gì, vì sao khác biệt. Viết 2-3 câu tự nhiên, tập trung vào lợi ích người học nhận được.', false)
          . tnl_secx_intro('green', 'Điều khiến chúng tôi khác biệt',
                'Phương pháp đào tạo thực tiễn, đội ngũ giàu kinh nghiệm, lộ trình cá nhân hoá. Mô tả điểm mạnh nổi bật của chương trình.', true)
          . '<!-- wp:group {"tagName":"section","className":"tnl-secx","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx">'
          . '<!-- wp:heading {"className":"tnl-hl tnl-hl--yellow"} --><h2 class="wp-block-heading tnl-hl tnl-hl--yellow">Nội dung chương trình</h2><!-- /wp:heading -->'
          . tnl_secx_panel('cyan',   'Học phần 1: Nền tảng EQ', 'Mô tả ngắn nội dung học phần: học viên sẽ nắm được gì sau phần này.', 'Tìm hiểu thêm', false)
          . tnl_secx_panel('orange', 'Học phần 2: Lãnh đạo bằng cảm xúc', 'Mô tả ngắn nội dung học phần: kỹ năng và giá trị thực tiễn.', 'Tìm hiểu thêm', true)
          . tnl_secx_panel('green',  'Học phần 3: Giao tiếp hiệu quả', 'Mô tả ngắn nội dung học phần: áp dụng vào công việc hằng ngày.', 'Tìm hiểu thêm', false)
          . '</section><!-- /wp:group -->'
          . tnl_secx_bigtesti('Cảm nhận của học viên')
          . tnl_sec_contact('Sẵn sàng bắt đầu?', 'Liên hệ để nhận tư vấn lộ trình phù hợp với bạn hoặc doanh nghiệp.'),
    );

    /* ---- MẪU 3: Đánh giá / Báo cáo (design khớp gu live) ---- */
    $T['assessment'] = array(
        'title'   => 'MẪU - Trang Đánh giá / Báo cáo',
        'slug'    => 'mau-danh-gia',
        'content' =>
            tnl_secx_hero('Tên bài đánh giá / chỉ số',
                'Đo lường và thấu hiểu năng lực qua bộ báo cáo chuyên sâu. Mô tả ngắn gọn công cụ đánh giá này giúp gì.',
                'Làm bài đánh giá')
          . tnl_secx_intro('cyan', 'Giá trị bạn nhận được',
                'Mô tả kết quả người dùng nhận được: hiểu bản thân/đội ngũ rõ hơn, có cơ sở ra quyết định, lộ trình phát triển cụ thể.', false)
          . '<!-- wp:group {"tagName":"section","className":"tnl-secx tnl-bg-gray","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx tnl-bg-gray">'
          . '<!-- wp:heading {"className":"tnl-hl tnl-hl--yellow"} --><h2 class="wp-block-heading tnl-hl tnl-hl--yellow">Các loại báo cáo</h2><!-- /wp:heading -->'
          . tnl_secx_panel('cyan',   'Báo cáo cá nhân', 'Mô tả ngắn báo cáo dành cho từng cá nhân: đo gì, dùng thế nào.', 'Xem chi tiết', false)
          . tnl_secx_panel('green',  'Báo cáo đội nhóm', 'Mô tả ngắn báo cáo tổng hợp cho đội nhóm: giá trị cho quản lý.', 'Xem chi tiết', true)
          . tnl_secx_panel('orange', 'Báo cáo tổ chức', 'Mô tả ngắn báo cáo cấp tổ chức / doanh nghiệp.', 'Xem chi tiết', false)
          . '</section><!-- /wp:group -->'
          . tnl_secx_bigtesti('Lắng nghe từ đối tác của chúng tôi')
          . tnl_sec_contact('Bắt đầu đánh giá ngay', 'Liên hệ để được hướng dẫn triển khai đánh giá cho cá nhân hoặc tổ chức.'),
    );

    /* ---- MẪU 4: Ưu đãi / Khuyến mãi ---- */
    $T['offer'] = array(
        'title'   => 'MẪU - Trang Ưu đãi',
        'slug'    => 'mau-uu-dai',
        'content' =>
            tnl_sec_offer_hero('ƯU ĐÃI CÓ HẠN', 'Ưu đãi đặc biệt dành cho bạn',
                'Mô tả ngắn gọn ưu đãi: giảm giá bao nhiêu, áp dụng cho gì, trong thời gian nào. Tạo cảm giác cấp bách.',
                'Nhận ưu đãi ngay', '2026-08-31 23:59')
          . tnl_secx_intro('orange', 'Vì sao nên nhận ngay',
                'Mô tả 2-3 câu giá trị người nhận có được: tiết kiệm chi phí, quyền lợi đi kèm, vì sao đây là thời điểm tốt nhất để tham gia.', false)
          . '<!-- wp:group {"tagName":"section","className":"tnl-secx tnl-bg-gray","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx tnl-bg-gray">'
          . '<!-- wp:heading {"className":"tnl-hl tnl-hl--cyan"} --><h2 class="wp-block-heading tnl-hl tnl-hl--cyan">Quyền lợi nổi bật</h2><!-- /wp:heading -->'
          . tnl_secx_panel('green',  'Quyền lợi 1', 'Mô tả ngắn quyền lợi đi kèm ưu đãi thứ nhất.', 'Tìm hiểu thêm', false)
          . tnl_secx_panel('yellow', 'Quyền lợi 2', 'Mô tả ngắn quyền lợi đi kèm ưu đãi thứ hai.', 'Tìm hiểu thêm', true)
          . '</section><!-- /wp:group -->'
          . tnl_sec_pricing('Ưu đãi của bạn',
                '2.000.000đ', '1.200.000đ', 'Tiết kiệm 40%',
                array('Quyền lợi 1 đi kèm ưu đãi', 'Quyền lợi 2 đi kèm ưu đãi', 'Quyền lợi 3 đi kèm ưu đãi', 'Hỗ trợ &amp; đồng hành sau chương trình'),
                'Số lượng có hạn - áp dụng đến hết 31/08/2026.', 'Đăng ký nhận ưu đãi')
          . tnl_secx_bigtesti('Lắng nghe từ đối tác của chúng tôi')
          . tnl_sec_contact('Đăng ký nhận ưu đãi', 'Để lại thông tin - The New Leaders sẽ liên hệ xác nhận và hướng dẫn nhận ưu đãi.'),
    );

    /* ---- MẪU 5: Sự kiện (design khớp gu live + đếm ngược + form thu lead) ---- */
    $info_cards = '<!-- wp:columns {"className":"tnl-info__grid"} --><div class="wp-block-columns tnl-info__grid">'
        . '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">📅</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Ngày</h3><!-- /wp:heading --><!-- wp:paragraph --><p>20/08/2026</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->'
        . '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">🕐</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Thời gian</h3><!-- /wp:heading --><!-- wp:paragraph --><p>19:00 - 21:00</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->'
        . '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">📍</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Địa điểm</h3><!-- /wp:heading --><!-- wp:paragraph --><p>TP. Hồ Chí Minh</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->'
        . '<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">🎟️</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Hình thức</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Trực tiếp / Miễn phí</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->'
        . '</div><!-- /wp:columns -->';

    $T['event'] = array(
        'title'   => 'MẪU - Trang Sự kiện',
        'slug'    => 'mau-su-kien',
        'content' =>
            tnl_secx_hero('Tên sự kiện của bạn tại đây',
                'Một câu mô tả ngắn gọn, hấp dẫn về giá trị người tham dự nhận được.',
                'Đăng ký tham dự')
          . '<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-hero","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-sec tnl-hero" style="padding-top:48px;padding-bottom:48px"><!-- wp:shortcode -->[tnl_countdown date="2026-08-20 19:00" label="Sự kiện bắt đầu sau"]<!-- /wp:shortcode --></section><!-- /wp:group -->'
          . '<!-- wp:group {"tagName":"section","className":"tnl-secx","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx">'
          . '<!-- wp:heading {"className":"tnl-hl tnl-hl--yellow"} --><h2 class="wp-block-heading tnl-hl tnl-hl--yellow">Thông tin sự kiện</h2><!-- /wp:heading -->' . $info_cards
          . '</section><!-- /wp:group -->'
          . tnl_secx_intro('cyan', 'Về sự kiện',
                'Mô tả chi tiết: nội dung chính, người tham dự sẽ học được gì, vì sao quan trọng. Viết 2-3 đoạn tự nhiên, tập trung vào lợi ích.', true)
          . '<!-- wp:group {"tagName":"section","className":"tnl-secx","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-secx">'
          . '<!-- wp:heading {"className":"tnl-hl tnl-hl--green"} --><h2 class="wp-block-heading tnl-hl tnl-hl--green">Diễn giả</h2><!-- /wp:heading -->'
          . tnl_secx_panel('cyan',   'Tên diễn giả', 'Chức danh - Công ty. Mô tả ngắn về diễn giả và kinh nghiệm.', 'Xem thêm', false)
          . tnl_secx_panel('orange', 'Tên diễn giả', 'Chức danh - Công ty. Mô tả ngắn về diễn giả và kinh nghiệm.', 'Xem thêm', true)
          . '</section><!-- /wp:group -->'
          . '<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-register","anchor":"dang-ky","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-sec tnl-register" id="dang-ky">'
          . '<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">Đăng ký tham dự</h2><!-- /wp:heading -->'
          . '<!-- wp:paragraph {"align":"center","className":"tnl-register__sub"} --><p class="has-text-align-center tnl-register__sub">Điền thông tin để giữ chỗ. Ban tổ chức sẽ liên hệ xác nhận.</p><!-- /wp:paragraph -->'
          . '<!-- wp:shortcode -->[tnl_reg_form title="" button="Đăng ký ngay" fields="name,email,phone,company"]<!-- /wp:shortcode -->'
          . '</section><!-- /wp:group -->'
          . tnl_sec_contact('Liên hệ ban tổ chức', 'Cần thêm thông tin về sự kiện? Liên hệ với chúng tôi.'),
    );

    return $T;
}

/* ============================================================
 * ĐĂNG KÝ PATTERNS (danh mục Trang mẫu) - để chèn lại từng phần nếu cần
 * ============================================================ */
add_action('init', function () {
    if (!function_exists('register_block_pattern_category')) return;
    register_block_pattern_category('tnl-page', array('label' => 'The New Leaders - Trang mẫu'));
    foreach (tnl_landing_templates() as $key => $t) {
        register_block_pattern('tnl-page/' . $key, array(
            'title'       => $t['title'],
            'description' => 'Bố cục trang ' . $t['title'] . ' - chèn rồi sửa chữ/ảnh.',
            'categories'  => array('tnl-page'),
            'content'     => tnl_lock_sections($t['content']),
        ));
    }
});

/* ============================================================
 * SINH SẴN CÁC TRANG "MẪU" (để Duplicate). Chạy 1 lần qua WP-CLI:
 *   wp eval 'tnl_generate_template_pages();'
 * Idempotent: có rồi thì cập nhật nội dung, chưa có thì tạo.
 * ============================================================ */
/* ============================================================
 * NÚT "NHÂN BẢN" cho trang (không cần plugin) - để Duplicate trang MẪU
 * ============================================================ */
add_filter('page_row_actions', function ($actions, $post) {
    if ($post->post_type === 'page' && current_user_can('edit_pages')) {
        $url = wp_nonce_url(admin_url('admin-post.php?action=tnl_duplicate_page&post=' . $post->ID), 'tnl_dup_' . $post->ID);
        $actions['tnl_duplicate'] = '<a href="' . esc_url($url) . '">Nhân bản</a>';
    }
    return $actions;
}, 10, 2);

add_action('admin_post_tnl_duplicate_page', function () {
    $pid = isset($_GET['post']) ? absint($_GET['post']) : 0;
    if (!$pid || !current_user_can('edit_pages')) wp_die('Không đủ quyền.');
    check_admin_referer('tnl_dup_' . $pid);
    $src = get_post($pid);
    if (!$src || $src->post_type !== 'page') wp_die('Không tìm thấy trang.');

    $title = $src->post_title;
    // Bỏ tiền tố "MẪU - " khi nhân bản để đặt tên mới cho sạch
    $title = preg_replace('/^MẪU\s*-\s*/u', '', $title);
    $new_id = wp_insert_post(array(
        'post_type'    => 'page',
        'post_status'  => 'draft',
        'post_title'   => $title . ' (bản sao)',
        'post_content' => $src->post_content,
        'post_excerpt' => $src->post_excerpt,
        'post_parent'  => $src->post_parent,
    ));
    if ($new_id && !is_wp_error($new_id)) {
        $tpl = get_post_meta($pid, '_wp_page_template', true);
        if ($tpl) update_post_meta($new_id, '_wp_page_template', $tpl);
        // Copy meta Elementor (trang builder lưu nội dung trong _elementor_data, không phải post_content)
        foreach (array('_elementor_edit_mode', '_elementor_data', '_elementor_template_type', '_elementor_version', '_elementor_page_settings', '_elementor_controls_usage') as $mk) {
            $mv = get_post_meta($pid, $mk, true);
            if ($mv !== '' && $mv !== false) update_post_meta($new_id, $mk, wp_slash($mv));
        }
        wp_safe_redirect(admin_url('post.php?action=edit&post=' . $new_id));
        exit;
    }
    wp_die('Nhân bản thất bại.');
});

function tnl_generate_template_pages() {
    $created = array();
    foreach (tnl_landing_templates() as $key => $t) {
        $existing = get_page_by_path($t['slug'], OBJECT, 'page');
        $data = array(
            'post_title'   => $t['title'],
            'post_name'    => $t['slug'],
            'post_content' => $t['content'],
            'post_type'    => 'page',
            'post_status'  => 'publish',
        );
        $data['post_content'] = tnl_lock_sections($data['post_content']);
        if ($existing) { $data['ID'] = $existing->ID; $id = wp_update_post($data); }
        else { $id = wp_insert_post($data); }
        if ($id && !is_wp_error($id)) {
            update_post_meta($id, '_wp_page_template', 'page-templates/landing.php');
            $created[$t['slug']] = $id;
        }
    }
    return $created;
}

/* Tự tạo/cập nhật các trang MẪU theo PHIÊN BẢN (dùng cho live - không cần WP-CLI).
 * Bump TNL_TPL_VER mỗi khi đổi thiết kế template -> vào wp-admin là tự làm mới 5 trang MẪU.
 * Chỉ đụng các trang MẪU gốc (khách DUPLICATE để dùng, không sửa bản gốc). */
define('TNL_TPL_VER', '3');
add_action('admin_init', function () {
    if (get_option('tnl_tpl_pages_ver') === TNL_TPL_VER) return;
    if (!current_user_can('edit_pages')) return;
    tnl_generate_template_pages();
    update_option('tnl_tpl_pages_ver', TNL_TPL_VER);
});

/* ============================================================
 * THƯ VIỆN SECTION RỜI - để khách chèn thêm khi cần (+ > Patterns)
 * ============================================================ */

/* Bọc nội dung trong 1 section chuẩn */
function tnl_wrap_secx($inner, $gray = false) {
    $c = 'tnl-secx' . ($gray ? ' tnl-bg-gray' : '');
    return '<!-- wp:group {"tagName":"section","className":"' . $c . '","layout":{"type":"constrained"}} --><section class="wp-block-group ' . $c . '">' . $inner . '</section><!-- /wp:group -->';
}
function tnl_hl_h($color, $text) {
    return '<!-- wp:heading {"className":"tnl-hl tnl-hl--' . $color . '"} --><h2 class="wp-block-heading tnl-hl tnl-hl--' . $color . '">' . $text . '</h2><!-- /wp:heading -->';
}

/* Trích dẫn nổi bật */
function tnl_secx_quote($q, $by) {
    return tnl_wrap_secx('<!-- wp:html --><div class="tnl-quote"><p class="tnl-quote__mark">"</p><p class="tnl-quote__t">' . $q . '</p><p class="tnl-quote__by">' . $by . '</p></div><!-- /wp:html -->');
}
/* Các bước / quy trình (3 bước) */
function tnl_secx_steps($hl, $title, $steps) {
    $cols = '';
    $i = 1;
    foreach ($steps as $s) {
        $cols .= '<!-- wp:column --><div class="wp-block-column"><!-- wp:html --><div class="tnl-step"><div class="tnl-step__n">' . $i . '</div><h3>' . $s[0] . '</h3><p>' . $s[1] . '</p></div><!-- /wp:html --></div><!-- /wp:column -->';
        $i++;
    }
    return tnl_wrap_secx(tnl_hl_h($hl, $title) . '<!-- wp:columns {"className":"tnl-steps__grid"} --><div class="wp-block-columns tnl-steps__grid">' . $cols . '</div><!-- /wp:columns -->');
}
/* Dải band 1 màu + CTA */
function tnl_secx_band($dark, $title, $sub, $btn) {
    $cls = 'tnl-secx tnl-band ' . ($dark ? 'tnl-band--dark' : 'tnl-band--light');
    return '<!-- wp:group {"tagName":"section","className":"' . $cls . '","layout":{"type":"constrained"}} --><section class="wp-block-group ' . $cls . '">'
        . '<!-- wp:heading {"textAlign":"center"} --><h2 class="wp-block-heading has-text-align-center">' . $title . '</h2><!-- /wp:heading -->'
        . '<!-- wp:paragraph {"align":"center"} --><p class="has-text-align-center">' . $sub . '</p><!-- /wp:paragraph -->'
        . '<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-pill' . ($dark ? ' tnl-pill--white' : '') . '"} --><div class="wp-block-button tnl-pill' . ($dark ? ' tnl-pill--white' : '') . '"><a class="wp-block-button__link wp-element-button" href="#lien-he">' . $btn . '</a></div><!-- /wp:button --></div><!-- /wp:buttons -->'
        . '</section><!-- /wp:group -->';
}
/* Video nhúng */
function tnl_secx_video($hl, $title) {
    return tnl_wrap_secx(tnl_hl_h($hl, $title) . '<!-- wp:embed {"type":"video","providerNameSlug":"youtube","className":"tnl-video wp-block-embed-youtube"} --><figure class="wp-block-embed is-type-video is-provider-youtube wp-block-embed-youtube tnl-video"><div class="wp-block-embed__wrapper">https://www.youtube.com/watch?v=dQw4w9WgXcQ</div></figure><!-- /wp:embed -->');
}
/* 2 cột chữ */
function tnl_secx_2col($hl, $title, $left, $right) {
    return tnl_wrap_secx(tnl_hl_h($hl, $title) . '<!-- wp:columns {"className":"tnl-2col"} --><div class="wp-block-columns tnl-2col"><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p>' . $left . '</p><!-- /wp:paragraph --></div><!-- /wp:column --><!-- wp:column --><div class="wp-block-column"><!-- wp:paragraph --><p>' . $right . '</p><!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->');
}

/* Danh sách section rời cho thư viện */
function tnl_section_library() {
    $S = array();
    // Hero
    $S['hero-overlay'] = array('Hero - Ảnh nền + overlay cam', tnl_secx_hero('Tiêu đề chính của bạn', 'Một câu mô tả ngắn gọn, hấp dẫn.', 'Nút hành động'));
    $S['hero-dark-cd'] = array('Hero - Nền tối + đếm ngược', tnl_sec_offer_hero('NHÃN NỔI BẬT', 'Tiêu đề sự kiện / ưu đãi', 'Mô tả ngắn tạo cấp bách.', 'Nút hành động', '2026-12-31 20:00'));
    // Heading highlight + intro (4 màu)
    foreach (array('cyan'=>'xanh dương','green'=>'xanh lá','yellow'=>'vàng','orange'=>'cam') as $c=>$vn) {
        $S['intro-'.$c] = array('Tiêu đề nền ' . $vn . ' + đoạn văn', tnl_secx_intro($c, 'Tiêu đề mục (nền ' . $vn . ')', 'Đoạn giới thiệu nội dung mục này. Viết 2-3 câu tự nhiên.', false));
    }
    // Khối màu (4 màu, trái/phải)
    $S['panel-cyan']   = array('Khối màu xanh dương + ảnh', tnl_wrap_secx(tnl_secx_panel('cyan','Tiêu đề khối','Mô tả ngắn nội dung khối này.','Tìm hiểu thêm', false)));
    $S['panel-orange'] = array('Khối màu cam + ảnh (đảo)', tnl_wrap_secx(tnl_secx_panel('orange','Tiêu đề khối','Mô tả ngắn nội dung khối này.','Tìm hiểu thêm', true)));
    $S['panel-green']  = array('Khối màu xanh lá + ảnh', tnl_wrap_secx(tnl_secx_panel('green','Tiêu đề khối','Mô tả ngắn nội dung khối này.','Tìm hiểu thêm', false)));
    $S['panel-yellow'] = array('Khối màu vàng + ảnh (đảo)', tnl_wrap_secx(tnl_secx_panel('yellow','Tiêu đề khối','Mô tả ngắn nội dung khối này.','Tìm hiểu thêm', true)));
    // Ảnh + chữ sạch
    $S['feat'] = array('Ảnh + chữ (đơn giản)', tnl_sec_feat('NHÃN NHỎ','Tiêu đề mục','Mô tả nội dung mục này, 2-3 câu.', tnl_tpl_ph()));
    // 3 thẻ
    $S['cards3'] = array('3 thẻ icon + mô tả', tnl_sec_cards3('Tiêu đề 3 thẻ', array(array('⭐','Thẻ 1','Mô tả ngắn.'),array('💡','Thẻ 2','Mô tả ngắn.'),array('🎯','Thẻ 3','Mô tả ngắn.'))));
    // Lưới chương trình
    $S['prog'] = array('Lưới thẻ (chương trình/tính năng)', tnl_sec_prog('NHÃN','Tiêu đề lưới', array(array('Mục 1','Mô tả ngắn.'),array('Mục 2','Mô tả ngắn.'),array('Mục 3','Mô tả ngắn.'),array('Mục 4','Mô tả ngắn.'))));
    // Con số uy tín
    $S['cred'] = array('Con số uy tín (nền tối)', tnl_sec_cred('Dựa trên nền tảng vững chắc', array(array('20+','Năm kinh nghiệm'),array('1000+','Khách hàng'),array('50+','Đối tác'))));
    // Các bước
    $S['steps'] = array('Các bước / quy trình', tnl_secx_steps('cyan','Quy trình 3 bước', array(array('Bước 1','Mô tả ngắn bước này.'),array('Bước 2','Mô tả ngắn bước này.'),array('Bước 3','Mô tả ngắn bước này.'))));
    // Thẻ giá
    $S['pricing'] = array('Thẻ giá / ưu đãi', tnl_sec_pricing('Bảng giá','2.000.000đ','1.200.000đ','Tiết kiệm 40%', array('Quyền lợi 1','Quyền lợi 2','Quyền lợi 3'),'Ghi chú điều kiện áp dụng.','Đăng ký ngay'));
    // Loại báo cáo
    $S['reports'] = array('Thẻ báo cáo (tag + tiêu đề)', tnl_sec_reports('NHÃN','Các loại báo cáo', array(array('Cá nhân','Báo cáo cá nhân','Mô tả ngắn.'),array('Đội nhóm','Báo cáo đội nhóm','Mô tả ngắn.'),array('Tổ chức','Báo cáo tổ chức','Mô tả ngắn.'))));
    // Testimonial
    $S['bigtesti'] = array('Đánh giá - kiểu lớn', tnl_secx_bigtesti('Lắng nghe từ đối tác của chúng tôi'));
    $S['testi'] = array('Đánh giá - 3 thẻ nhỏ', tnl_sec_testi('Cảm nhận khách hàng'));
    // Trích dẫn
    $S['quote'] = array('Trích dẫn nổi bật', tnl_secx_quote('Một câu trích dẫn ấn tượng đặt tại đây để tạo điểm nhấn.', 'Tên người - Chức danh'));
    // Video
    $S['video'] = array('Video nhúng (YouTube)', tnl_secx_video('orange','Xem video giới thiệu'));
    // 2 cột chữ
    $S['2col'] = array('2 cột nội dung', tnl_secx_2col('green','Tiêu đề mục', 'Nội dung cột trái.', 'Nội dung cột phải.'));
    // FAQ
    $S['faq'] = array('Câu hỏi thường gặp (FAQ)', tnl_wrap_secx(tnl_hl_h('yellow','Câu hỏi thường gặp') . '<!-- wp:html --><details class="tnl-faq__item"><summary>Câu hỏi 1?</summary><p>Câu trả lời.</p></details><details class="tnl-faq__item"><summary>Câu hỏi 2?</summary><p>Câu trả lời.</p></details><!-- /wp:html -->'));
    // Band CTA
    $S['band-dark']  = array('Dải kêu gọi (nền tối)', tnl_secx_band(true, 'Tiêu đề kêu gọi hành động', 'Một câu thuyết phục ngắn.', 'Nút hành động'));
    $S['band-light'] = array('Dải kêu gọi (nền sáng)', tnl_secx_band(false, 'Tiêu đề kêu gọi hành động', 'Một câu thuyết phục ngắn.', 'Nút hành động'));
    // Liên hệ
    $S['contact'] = array('Dải liên hệ (nền cam)', tnl_sec_contact());
    // Form đăng ký
    $S['regform'] = array('Form đăng ký (thu lead)', '<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-register","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-sec tnl-register"><!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">Đăng ký</h2><!-- /wp:heading --><!-- wp:shortcode -->[tnl_reg_form title="" button="Đăng ký ngay" fields="name,email,phone"]<!-- /wp:shortcode --></section><!-- /wp:group -->');
    // Đếm ngược
    $S['countdown'] = array('Đồng hồ đếm ngược', '<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-hero","layout":{"type":"constrained"}} --><section class="wp-block-group tnl-sec tnl-hero"><!-- wp:shortcode -->[tnl_countdown date="2026-12-31 20:00" label="Bắt đầu sau"]<!-- /wp:shortcode --></section><!-- /wp:group -->');
    return $S;
}

add_action('init', function () {
    if (!function_exists('register_block_pattern_category')) return;
    register_block_pattern_category('tnl-section', array('label' => 'The New Leaders - Section rời (chèn thêm)'));
    foreach (tnl_section_library() as $key => $s) {
        register_block_pattern('tnl-sec/' . $key, array(
            'title'       => $s[0],
            'description' => 'Chèn section: ' . $s[0],
            'categories'  => array('tnl-section'),
            'content'     => tnl_lock_sections($s[1]),
        ));
    }
});
