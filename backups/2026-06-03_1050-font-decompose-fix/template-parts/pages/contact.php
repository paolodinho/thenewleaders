<?php
/** Trang Liên hệ — nội dung verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

$T = $vi ? [
    'heading'  => 'Kết nối với<br>The New Leaders',
    'name'     => 'Tên của bạn:',
    'phone'    => 'Số điện thoại của bạn:',
    'email'    => 'Email của bạn:',
    'position' => 'Chức vụ của bạn:',
    'org'      => 'Tổ chức/Công ty của bạn:',
    'product'  => 'Bạn đang tìm kiếm sản phẩm nào?',
    'select'   => 'Chọn',
    'opts'     => ['Chương trình cá nhân', 'Chương trình cho doanh nghiệp', 'Coaching cho lãnh đạo', 'Các sản phẩm EQ'],
    'details'  => 'Hãy cho chúng tôi biết rõ hơn về mong muốn của bạn nhé:',
    'submit'   => 'Gửi',
] : [
    'heading'  => 'Send us<br>your message...',
    'name'     => 'Your name:',
    'phone'    => 'Your phone number:',
    'email'    => 'Your email:',
    'position' => 'Your position:',
    'org'      => 'Your organization:',
    'product'  => 'Which product are you looking for?',
    'select'   => 'Select',
    'opts'     => ['Individual Training', 'Customized training program for business', 'Executive coach', 'EQ products'],
    'details'  => 'Provide us with some details...',
    'submit'   => 'Submit',
];
?>
<main class="site-main page-contact">
  <section class="contact-form-sec section">
    <div class="container">
      <h1 class="contact-form-sec__title"><?php echo $T['heading']; ?></h1>

      <form class="contact-form tnl-ajax-form" method="post" action="#" data-form-type="Contact" novalidate>
        <div class="contact-form__grid">
          <div class="contact-field">
            <label for="cf-name"><?php echo esc_html($T['name']); ?></label>
            <input type="text" id="cf-name" name="name">
          </div>
          <div class="contact-field">
            <label for="cf-phone"><?php echo esc_html($T['phone']); ?></label>
            <input type="text" id="cf-phone" name="phone">
          </div>
          <div class="contact-field">
            <label for="cf-email"><?php echo esc_html($T['email']); ?></label>
            <input type="email" id="cf-email" name="email">
          </div>
          <div class="contact-field">
            <label for="cf-position"><?php echo esc_html($T['position']); ?></label>
            <input type="text" id="cf-position" name="position">
          </div>
          <div class="contact-field">
            <label for="cf-org"><?php echo esc_html($T['org']); ?></label>
            <input type="text" id="cf-org" name="organization">
          </div>
          <div class="contact-field">
            <label for="cf-product"><?php echo esc_html($T['product']); ?></label>
            <select id="cf-product" name="product">
              <option value=""><?php echo esc_html($T['select']); ?></option>
              <?php foreach ($T['opts'] as $o) : ?>
                <option value="<?php echo esc_attr($o); ?>"><?php echo esc_html($o); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>

        <div class="contact-field contact-field--full">
          <label for="cf-details"><?php echo esc_html($T['details']); ?></label>
          <textarea id="cf-details" name="details" rows="4"></textarea>
        </div>

        <button type="submit" class="btn btn--primary contact-form__submit"><?php echo esc_html($T['submit']); ?></button>
      </form>
    </div>
  </section>
</main>
