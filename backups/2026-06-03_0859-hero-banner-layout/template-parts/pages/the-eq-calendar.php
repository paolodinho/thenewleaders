<?php
/** products/the-eq-calendar — The EQ Calendar 2026. Nội dung tiếng Việt (live giống nhau EN/VI). */
$cta_url = tnl_url('contact');
$img = get_template_directory_uri() . '/assets/media/products/calendar_be6d19839f.png';
$buy = 'Buy now';

$desc = [
  'Trong một năm mà tốc độ khiến ai cũng dễ kiệt sức, điều đội ngũ cần không chỉ là một người quản lý giỏi công việc — mà là một người lãnh đạo biết lắng nghe, thấu cảm và truyền cảm hứng mỗi ngày. Bởi chỉ một phong cách lãnh đạo thiếu tinh tế thôi, cũng đủ khiến gần một nửa nhân viên mất động lực và giảm hiệu suất.',
  'Thay đổi tư duy lãnh đạo không phải chuyện một khóa học hay một bài nói chuyện. Nó bắt đầu từ những lời nhắc nhỏ, những khoảnh khắc tỉnh táo giữa dòng công việc cuốn đi. Vì vậy, The New Leaders tạo ra bộ lịch EQ 2026 — cuốn lịch để bàn nhưng đồng thời là "cẩm nang lãnh đạo mỗi ngày", giúp bạn vừa xem ngày vừa xem lại chính mình: mình đã kết nối đủ chưa, đã lắng nghe đúng chỗ, đã dẫn dắt bằng cảm xúc tích cực chưa?',
  'Chỉ một trang lịch mỗi ngày — nhưng đủ để hành trình lãnh đạo của bạn thay đổi cả năm dài. EQ Calendar 2026: món quà giúp lãnh đạo trưởng thành, đội ngũ gắn kết và công việc khởi sắc từ những điều nhỏ nhất.',
];
$special = [
  ['t' => 'Chủ đề hấp dẫn', 'p' => 'Mỗi tháng sẽ là một chủ đề của lãnh đạo bằng thông minh cảm xúc dựa trên khung chương trình đào tạo về lãnh đạo và thông minh cảm xúc từ các trường quản trị hàng đầu thế giới như Đại học Harvard Kennedy, Đại học Cornell, Đại học Oxford...'],
  ['t' => 'Truyền tải thông minh', 'p' => 'Thông điệp và các bài học được truyền tải một cách thông minh qua các hình ảnh sáng tạo và gần gũi. Các gợi ý thực hành tạo thói quen để xây dựng những năng lực lãnh đạo quan trọng.'],
  ['t' => 'Gợi ý thực hành', 'p' => 'Cung cấp các gợi ý thực hành chi tiết để hình thành thói quen hàng ngày, giúp phát triển và củng cố các năng lực lãnh đạo quan trọng, từ quản lý cảm xúc đến xây dựng mối quan hệ và ra quyết định hiệu quả.'],
];
$forwho = [
  'Những nhà quản lý, lãnh đạo.',
  'Những cá nhân đang muốn làm tốt hơn công việc của mình ở vị trí quản lý, lãnh đạo.',
  'Những cá nhân đang muốn phát triển tư duy lãnh đạo hiện đại dựa trên thông minh cảm xúc.',
  'Những cá nhân đang muốn có những cảm xúc tích cực và động lực trong công việc.',
  'Những cá nhân đang cần 1 người bạn đồng hành nhắc nhở mình về mục tiêu mỗi ngày.',
];
$order_p = [
  'Thay đổi cách lãnh đạo không đến từ một khoảnh khắc lớn, mà từ những lời nhắc nhỏ mỗi ngày. Khi công việc cuốn đi quá nhanh, người lãnh đạo cũng cần được "kéo lại" để lắng nghe, kết nối và dẫn dắt tỉnh táo hơn.',
  'EQ Calendar 2026 không chỉ là một cuốn lịch để bàn, mà là cẩm nang EQ mỗi ngày – giúp bạn vừa xem ngày, vừa tự soi lại cách mình đang hiện diện với đội ngũ.',
  'Chỉ một trang mỗi ngày, nhưng đủ tạo khác biệt cho cả năm.',
  '👉 EQ Calendar 2026 – món quà giúp lãnh đạo trưởng thành, đội ngũ gắn kết và công việc đi xa hơn.',
  '👉 Đặt lịch ngay hôm nay.',
];
$founder = [
  'Ngân Trần là nhà đào tạo quốc tế và executive coach chuyên sâu trong lĩnh vực Lãnh đạo bằng Trí tuệ Cảm xúc (EQ Leadership).',
  'Chị tốt nghiệp các chương trình Lãnh đạo cấp cao tại Harvard Kennedy School, Cornell University, và chương trình Mastery Training for Executive Leadership Coaching.',
  'Là Top 4% Global Leadership Influencer và Top Voice về Leadership & EQ Communication trên LinkedIn, Ngân Trần đã đào tạo lãnh đạo tại hơn 20 quốc gia, hợp tác cùng nhiều tổ chức hàng đầu như Harvard University, The Obama Foundation, USAID, RMIT, Fulbright, JW Marriott, Heineken, VietinBank, Vietcombank, VNG, Gamuda Land...',
  'Với hơn 15 năm kinh nghiệm lãnh đạo quốc tế, chị mang đến không chỉ kiến thức toàn cầu mà còn niềm tin, cảm hứng và phương pháp phát triển bền vững cho đội ngũ lãnh đạo Việt Nam.',
];
?>
<main class="site-main page-cal">

  <section class="cal-hero section">
    <div class="container cal-hero__inner">
      <div class="cal-hero__text">
        <p class="cal-hero__eyebrow">Cẩm nang EQ để bàn dành cho quản lý, lãnh đạo</p>
        <h1 class="cal-hero__title">Bứt phá giới hạn <span>2026</span></h1>
        <?php foreach ($desc as $d) : ?><p class="cal-hero__desc"><?php echo esc_html($d); ?></p><?php endforeach; ?>
        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
      </div>
      <div class="cal-hero__media"><img src="<?php echo esc_url($img); ?>" alt="The EQ Calendar 2026" loading="eager"></div>
    </div>
  </section>

  <section class="cal-special section">
    <div class="container">
      <h2 class="cal-special__h">"Bộ lịch EQ này đặc biệt vì:"</h2>
      <div class="cal-special__grid">
        <?php foreach ($special as $s) : ?><div class="cal-sp"><h3><?php echo esc_html($s['t']); ?></h3><p><?php echo esc_html($s['p']); ?></p></div><?php endforeach; ?>
      </div>
      <p class="cal-special__foot">12 tháng – 12 chủ đề về EQ Leadership</p>
    </div>
  </section>

  <section class="cal-forwho section">
    <div class="container">
      <h2 class="cal-forwho__h">Bộ lịch này dành cho ai</h2>
      <ol class="cal-forwho__list">
        <?php foreach ($forwho as $i => $f) : ?><li><span class="cal-forwho__num"><?php printf('%02d', $i + 1); ?></span><p><?php echo esc_html($f); ?></p></li><?php endforeach; ?>
      </ol>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary cal-forwho__cta"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="cal-order section">
    <div class="container cal-order__inner">
      <div class="cal-order__text">
        <h2 class="cal-order__h">Để đặt mua lịch "Cẩm nang EQ để bàn"</h2>
        <?php foreach ($order_p as $p) : ?><p class="cal-order__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
        <p class="cal-order__contact">Liên hệ với: <strong>Nguyễn Minh Tinh</strong> – Business Development Manager để được hỗ trợ nhanh nhất</p>
        <p class="cal-order__contact"><strong>Facebook Messenger</strong> · <a href="tel:0962123440">0962 123 440</a></p>
        <p class="cal-order__note">hoặc thông qua form liên hệ bên dưới, chúng tôi sẽ liên lạc với Anh/Chị ngay khi nhận được thông tin.</p>
      </div>
      <form class="cal-form tnl-ajax-form" method="post" action="#" data-form-type="EQ Calendar Order" novalidate>
        <div class="cal-field"><label>Your name: *</label><input type="text" name="name"></div>
        <div class="cal-field"><label>Your phone number: *</label><input type="text" name="phone"></div>
        <div class="cal-field"><label>Your email: *</label><input type="email" name="email"></div>
        <div class="cal-field"><label>Your organization:</label><input type="text" name="org"></div>
        <div class="cal-field"><label>Notes</label><textarea name="notes" rows="3"></textarea></div>
        <button type="submit" class="btn btn--primary cal-form__submit">Submit</button>
      </form>
    </div>
  </section>

  <section class="cal-about section">
    <div class="container">
      <h2 class="cal-about__h">Về The New Leaders</h2>
      <p class="cal-about__p">The New Leaders là tổ chức giáo dục tiên phong tại Việt Nam mang đến chương trình đào tạo và huấn luyện Kỹ năng lãnh đạo bằng trí tuệ cảm xúc từ các trường đại học hàng đầu như Đại học Harvard Kennedy, Đại học Cornell và Đại học Oxford giúp thế hệ lãnh đạo mới ở Việt Nam có thể truyền cảm hứng, dẫn dắt đội ngũ hiệu quả hơn, và tạo ảnh hưởng tích cực tới doanh nghiệp và cộng đồng.</p>
      <p class="cal-about__p">Theo dõi The New Leaders Network để nhận được những thông tin lý thú về EQ hàng ngày để phát triển khả năng lãnh đạo dựa trên EQ nhé!</p>
      <h3 class="cal-founder__h">Người sáng lập</h3>
      <?php foreach ($founder as $f) : ?><p class="cal-about__p"><?php echo esc_html($f); ?></p><?php endforeach; ?>
    </div>
  </section>

</main>
