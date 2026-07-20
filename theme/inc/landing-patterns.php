<?php
/**
 * LANDING PATTERNS - "khối sự kiện" brand The New Leaders.
 * Đăng ký block pattern để đội no-code chèn nhanh trong trình soạn Gutenberg.
 */

if (!defined('ABSPATH')) exit;

add_action('init', function () {

    if (!function_exists('register_block_pattern_category')) return;

    register_block_pattern_category('tnl-event', array(
        'label' => 'The New Leaders - Sự kiện',
    ));

    $uri = get_template_directory_uri();
    $ph  = $uri . '/assets/images/tnl-placeholder.svg'; // ảnh tạm (thay bằng ảnh thật)

    $P = array();

    /* ---------- HERO ---------- */
    $P['hero'] = array(
        'title'       => '1. Hero (banner + đếm ngược)',
        'description' => 'Đầu trang: tên sự kiện, ngày/địa điểm, nút đăng ký, đồng hồ đếm ngược.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-hero","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-hero">
<!-- wp:paragraph {"className":"tnl-kicker"} --><p class="tnl-kicker">SỰ KIỆN THE NEW LEADERS</p><!-- /wp:paragraph -->
<!-- wp:heading {"level":1,"className":"tnl-hero__title"} --><h1 class="tnl-hero__title">Tên sự kiện của bạn tại đây</h1><!-- /wp:heading -->
<!-- wp:paragraph {"className":"tnl-hero__sub"} --><p class="tnl-hero__sub">Một câu mô tả ngắn gọn, hấp dẫn về giá trị người tham dự nhận được.</p><!-- /wp:paragraph -->
<!-- wp:paragraph {"className":"tnl-hero__meta"} --><p class="tnl-hero__meta">📅 20/08/2026 &nbsp;•&nbsp; 🕐 19:00 - 21:00 &nbsp;•&nbsp; 📍 TP. Hồ Chí Minh</p><!-- /wp:paragraph -->
<!-- wp:buttons --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-btn"} --><div class="wp-block-button tnl-btn"><a class="wp-block-button__link wp-element-button" href="#dang-ky">Đăng ký ngay</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
<!-- wp:shortcode -->[tnl_countdown date="2026-08-20 19:00" label="Sự kiện bắt đầu sau"]<!-- /wp:shortcode -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- INFO CARDS ---------- */
    $P['info'] = array(
        'title'       => '2. Thông tin sự kiện (4 thẻ)',
        'description' => 'Ngày - Giờ - Địa điểm - Hình thức.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-info","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-info">
<!-- wp:columns {"className":"tnl-info__grid"} --><div class="wp-block-columns tnl-info__grid">
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">📅</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Ngày</h3><!-- /wp:heading --><!-- wp:paragraph --><p>20/08/2026</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">🕐</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Thời gian</h3><!-- /wp:heading --><!-- wp:paragraph --><p>19:00 - 21:00</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">📍</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Địa điểm</h3><!-- /wp:heading --><!-- wp:paragraph --><p>TP. Hồ Chí Minh</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-card"} --><div class="wp-block-group tnl-card"><!-- wp:paragraph {"className":"tnl-card__ico"} --><p class="tnl-card__ico">🎟️</p><!-- /wp:paragraph --><!-- wp:heading {"level":3} --><h3>Hình thức</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Trực tiếp / Miễn phí</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- ABOUT (2 cột) ---------- */
    $P['about'] = array(
        'title'       => '3. Giới thiệu (chữ + ảnh)',
        'description' => 'Khối giới thiệu nội dung sự kiện, kèm 1 ảnh.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-about","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-about">
<!-- wp:columns {"verticalAlignment":"center","className":"tnl-about__grid"} --><div class="wp-block-columns are-vertically-aligned-center tnl-about__grid">
<!-- wp:column {"verticalAlignment":"center","width":"55%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:55%">
<!-- wp:paragraph {"className":"tnl-kicker"} --><p class="tnl-kicker">VỀ SỰ KIỆN</p><!-- /wp:paragraph -->
<!-- wp:heading {"className":"tnl-h2"} --><h2 class="tnl-h2">Vì sao bạn không nên bỏ lỡ</h2><!-- /wp:heading -->
<!-- wp:paragraph --><p>Mô tả chi tiết về sự kiện: nội dung chính, người tham dự sẽ học được gì, vì sao nó quan trọng với họ. Viết 2-3 đoạn tự nhiên, tập trung vào lợi ích.</p><!-- /wp:paragraph -->
<!-- wp:list {"className":"tnl-checklist"} --><ul class="tnl-checklist"><!-- wp:list-item --><li>Điểm giá trị 1</li><!-- /wp:list-item --><!-- wp:list-item --><li>Điểm giá trị 2</li><!-- /wp:list-item --><!-- wp:list-item --><li>Điểm giá trị 3</li><!-- /wp:list-item --></ul><!-- /wp:list -->
</div><!-- /wp:column -->
<!-- wp:column {"verticalAlignment":"center","width":"45%"} --><div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
<!-- wp:image {"className":"tnl-about__img"} --><figure class="wp-block-image tnl-about__img"><img src="' . esc_url($ph) . '" alt="Ảnh sự kiện"/></figure><!-- /wp:image -->
</div><!-- /wp:column -->
</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- AGENDA ---------- */
    $P['agenda'] = array(
        'title'       => '4. Chương trình (agenda)',
        'description' => 'Dòng thời gian các phần của sự kiện.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-agenda","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-agenda">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">Chương trình</h2><!-- /wp:heading -->
<!-- wp:group {"className":"tnl-timeline"} --><div class="wp-block-group tnl-timeline">
<!-- wp:group {"className":"tnl-tl__item"} --><div class="wp-block-group tnl-tl__item"><!-- wp:paragraph {"className":"tnl-tl__time"} --><p class="tnl-tl__time">18:45</p><!-- /wp:paragraph --><!-- wp:group {"className":"tnl-tl__body"} --><div class="wp-block-group tnl-tl__body"><!-- wp:heading {"level":3} --><h3>Đón khách &amp; check-in</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Mô tả ngắn.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:group -->
<!-- wp:group {"className":"tnl-tl__item"} --><div class="wp-block-group tnl-tl__item"><!-- wp:paragraph {"className":"tnl-tl__time"} --><p class="tnl-tl__time">19:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"tnl-tl__body"} --><div class="wp-block-group tnl-tl__body"><!-- wp:heading {"level":3} --><h3>Phần 1: Chủ đề chính</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Mô tả ngắn.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:group -->
<!-- wp:group {"className":"tnl-tl__item"} --><div class="wp-block-group tnl-tl__item"><!-- wp:paragraph {"className":"tnl-tl__time"} --><p class="tnl-tl__time">20:00</p><!-- /wp:paragraph --><!-- wp:group {"className":"tnl-tl__body"} --><div class="wp-block-group tnl-tl__body"><!-- wp:heading {"level":3} --><h3>Phần 2: Hỏi &amp; đáp</h3><!-- /wp:heading --><!-- wp:paragraph --><p>Mô tả ngắn.</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:group -->
</div><!-- /wp:group -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- SPEAKERS ---------- */
    $P['speakers'] = array(
        'title'       => '5. Diễn giả',
        'description' => 'Lưới thẻ diễn giả: ảnh, tên, chức danh.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-speakers","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-speakers">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">Diễn giả</h2><!-- /wp:heading -->
<!-- wp:columns {"className":"tnl-speakers__grid"} --><div class="wp-block-columns tnl-speakers__grid">
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-spk"} --><div class="wp-block-group tnl-spk"><!-- wp:image {"className":"tnl-spk__img"} --><figure class="wp-block-image tnl-spk__img"><img src="' . esc_url($ph) . '" alt="Diễn giả"/></figure><!-- /wp:image --><!-- wp:heading {"level":3} --><h3>Tên diễn giả</h3><!-- /wp:heading --><!-- wp:paragraph {"className":"tnl-spk__role"} --><p class="tnl-spk__role">Chức danh - Công ty</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-spk"} --><div class="wp-block-group tnl-spk"><!-- wp:image {"className":"tnl-spk__img"} --><figure class="wp-block-image tnl-spk__img"><img src="' . esc_url($ph) . '" alt="Diễn giả"/></figure><!-- /wp:image --><!-- wp:heading {"level":3} --><h3>Tên diễn giả</h3><!-- /wp:heading --><!-- wp:paragraph {"className":"tnl-spk__role"} --><p class="tnl-spk__role">Chức danh - Công ty</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
<!-- wp:column --><div class="wp-block-column"><!-- wp:group {"className":"tnl-spk"} --><div class="wp-block-group tnl-spk"><!-- wp:image {"className":"tnl-spk__img"} --><figure class="wp-block-image tnl-spk__img"><img src="' . esc_url($ph) . '" alt="Diễn giả"/></figure><!-- /wp:image --><!-- wp:heading {"level":3} --><h3>Tên diễn giả</h3><!-- /wp:heading --><!-- wp:paragraph {"className":"tnl-spk__role"} --><p class="tnl-spk__role">Chức danh - Công ty</p><!-- /wp:paragraph --></div><!-- /wp:group --></div><!-- /wp:column -->
</div><!-- /wp:columns -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- REGISTER (form) ---------- */
    $P['register'] = array(
        'title'       => '6. Đăng ký (form thu lead)',
        'description' => 'Khối form đăng ký - dữ liệu lưu vào WordPress, xuất CSV được.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-register","anchor":"dang-ky","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-register" id="dang-ky">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">Đăng ký tham dự</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"tnl-register__sub"} --><p class="has-text-align-center tnl-register__sub">Điền thông tin để giữ chỗ. Ban tổ chức sẽ liên hệ xác nhận.</p><!-- /wp:paragraph -->
<!-- wp:shortcode -->[tnl_reg_form title="" button="Đăng ký ngay" fields="name,email,phone,company"]<!-- /wp:shortcode -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- SPONSORS ---------- */
    $P['sponsors'] = array(
        'title'       => '7. Nhà tài trợ / Đối tác',
        'description' => 'Hàng logo đơn vị đồng hành.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-sponsors","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-sponsors">
<!-- wp:heading {"textAlign":"center","level":3,"className":"tnl-sponsors__ttl"} --><h3 class="has-text-align-center tnl-sponsors__ttl">Đơn vị đồng hành</h3><!-- /wp:heading -->
<!-- wp:gallery {"columns":4,"linkTo":"none","className":"tnl-sponsors__row"} --><figure class="wp-block-gallery has-nested-images columns-4 tnl-sponsors__row"><!-- wp:image {"linkDestination":"none"} --><figure class="wp-block-image"><img src="' . esc_url($ph) . '" alt="Logo"/></figure><!-- /wp:image --><!-- wp:image {"linkDestination":"none"} --><figure class="wp-block-image"><img src="' . esc_url($ph) . '" alt="Logo"/></figure><!-- /wp:image --><!-- wp:image {"linkDestination":"none"} --><figure class="wp-block-image"><img src="' . esc_url($ph) . '" alt="Logo"/></figure><!-- /wp:image --><!-- wp:image {"linkDestination":"none"} --><figure class="wp-block-image"><img src="' . esc_url($ph) . '" alt="Logo"/></figure><!-- /wp:image --></figure><!-- /wp:gallery -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- FAQ ---------- */
    $P['faq'] = array(
        'title'       => '8. Câu hỏi thường gặp (FAQ)',
        'description' => 'Danh sách câu hỏi - đáp mở/gập.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-faq","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-faq">
<!-- wp:heading {"textAlign":"center","className":"tnl-h2"} --><h2 class="has-text-align-center tnl-h2">Câu hỏi thường gặp</h2><!-- /wp:heading -->
<!-- wp:html --><details class="tnl-faq__item"><summary>Sự kiện có thu phí không?</summary><p>Nhập câu trả lời tại đây.</p></details><!-- /wp:html -->
<!-- wp:html --><details class="tnl-faq__item"><summary>Tôi có nhận được tài liệu sau sự kiện không?</summary><p>Nhập câu trả lời tại đây.</p></details><!-- /wp:html -->
<!-- wp:html --><details class="tnl-faq__item"><summary>Làm sao để liên hệ ban tổ chức?</summary><p>Nhập câu trả lời tại đây.</p></details><!-- /wp:html -->
</section>
<!-- /wp:group -->',
    );

    /* ---------- CTA ---------- */
    $P['cta'] = array(
        'title'       => '9. Kêu gọi hành động (CTA cuối)',
        'description' => 'Dải cam kêu gọi đăng ký cuối trang.',
        'content' => '
<!-- wp:group {"tagName":"section","className":"tnl-sec tnl-cta","layout":{"type":"constrained"}} -->
<section class="wp-block-group tnl-sec tnl-cta">
<!-- wp:heading {"textAlign":"center","className":"tnl-cta__ttl"} --><h2 class="has-text-align-center tnl-cta__ttl">Sẵn sàng tham gia cùng chúng tôi?</h2><!-- /wp:heading -->
<!-- wp:paragraph {"align":"center","className":"tnl-cta__sub"} --><p class="has-text-align-center tnl-cta__sub">Số lượng chỗ có hạn - đăng ký ngay hôm nay.</p><!-- /wp:paragraph -->
<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} --><div class="wp-block-buttons"><!-- wp:button {"className":"tnl-btn tnl-btn--light"} --><div class="wp-block-button tnl-btn tnl-btn--light"><a class="wp-block-button__link wp-element-button" href="#dang-ky">Đăng ký ngay</a></div><!-- /wp:button --></div><!-- /wp:buttons -->
</section>
<!-- /wp:group -->',
    );

    foreach ($P as $key => $p) {
        register_block_pattern('tnl/' . $key, array(
            'title'       => $p['title'],
            'description' => $p['description'],
            'categories'  => array('tnl-event'),
            'content'     => $p['content'],
        ));
    }

    /* ---------- MẪU TRỌN GÓI: cả trang landing ---------- */
    register_block_pattern('tnl/event-landing', array(
        'title'       => '★ Landing sự kiện (mẫu đầy đủ)',
        'description' => 'Chèn nguyên trang landing hoàn chỉnh rồi chỉnh chữ/ảnh.',
        'categories'  => array('tnl-event'),
        'content'     => $P['hero']['content'] . $P['info']['content'] . $P['about']['content'] . $P['agenda']['content'] . $P['speakers']['content'] . $P['register']['content'] . $P['sponsors']['content'] . $P['faq']['content'] . $P['cta']['content'],
    ));
});
