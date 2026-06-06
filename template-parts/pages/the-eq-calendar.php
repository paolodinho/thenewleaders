<?php
/** products/the-eq-calendar — The EQ Calendar 2026. Song ngữ EN/VI. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$cta_url = tnl_url('contact');
$img = get_template_directory_uri() . '/assets/media/products/calendar_be6d19839f.png';

if ($vi) {
  $buy = 'Mua ngay';
  $hero_eyebrow = 'Cẩm nang EQ để bàn dành cho quản lý, lãnh đạo';
  $hero_title_pre = 'Bứt phá giới hạn ';
  $desc = [
    'Trong một năm mà tốc độ khiến ai cũng dễ kiệt sức, điều đội ngũ cần không chỉ là một người quản lý giỏi công việc — mà là một người lãnh đạo biết lắng nghe, thấu cảm và truyền cảm hứng mỗi ngày. Bởi chỉ một phong cách lãnh đạo thiếu tinh tế thôi, cũng đủ khiến gần một nửa nhân viên mất động lực và giảm hiệu suất.',
    'Thay đổi tư duy lãnh đạo không phải chuyện một khóa học hay một bài nói chuyện. Nó bắt đầu từ những lời nhắc nhỏ, những khoảnh khắc tỉnh táo giữa dòng công việc cuốn đi. Vì vậy, The New Leaders tạo ra bộ lịch EQ 2026 — cuốn lịch để bàn nhưng đồng thời là "cẩm nang lãnh đạo mỗi ngày", giúp bạn vừa xem ngày vừa xem lại chính mình: mình đã kết nối đủ chưa, đã lắng nghe đúng chỗ, đã dẫn dắt bằng cảm xúc tích cực chưa?',
    'Chỉ một trang lịch mỗi ngày — nhưng đủ để hành trình lãnh đạo của bạn thay đổi cả năm dài. EQ Calendar 2026: món quà giúp lãnh đạo trưởng thành, đội ngũ gắn kết và công việc khởi sắc từ những điều nhỏ nhất.',
  ];
  $special_h = '"Bộ lịch EQ này đặc biệt vì:"';
  $special = [
    ['t' => 'Chủ đề hấp dẫn', 'p' => 'Mỗi tháng sẽ là một chủ đề của lãnh đạo bằng thông minh cảm xúc dựa trên khung chương trình đào tạo về lãnh đạo và thông minh cảm xúc từ các trường quản trị hàng đầu thế giới như Đại học Harvard Kennedy, Đại học Cornell, Đại học Oxford...'],
    ['t' => 'Truyền tải thông minh', 'p' => 'Thông điệp và các bài học được truyền tải một cách thông minh qua các hình ảnh sáng tạo và gần gũi. Các gợi ý thực hành tạo thói quen để xây dựng những năng lực lãnh đạo quan trọng.'],
    ['t' => 'Gợi ý thực hành', 'p' => 'Cung cấp các gợi ý thực hành chi tiết để hình thành thói quen hàng ngày, giúp phát triển và củng cố các năng lực lãnh đạo quan trọng, từ quản lý cảm xúc đến xây dựng mối quan hệ và ra quyết định hiệu quả.'],
  ];
  $special_foot = '12 tháng – 12 chủ đề về EQ Leadership';
  $forwho_h = 'Bộ lịch này dành cho ai';
  $forwho = [
    'Những nhà quản lý, lãnh đạo.',
    'Những cá nhân đang muốn làm tốt hơn công việc của mình ở vị trí quản lý, lãnh đạo.',
    'Những cá nhân đang muốn phát triển tư duy lãnh đạo hiện đại dựa trên thông minh cảm xúc.',
    'Những cá nhân đang muốn có những cảm xúc tích cực và động lực trong công việc.',
    'Những cá nhân đang cần 1 người bạn đồng hành nhắc nhở mình về mục tiêu mỗi ngày.',
  ];
  $order_h = 'Để đặt mua lịch "Cẩm nang EQ để bàn"';
  $order_p = [
    'Thay đổi cách lãnh đạo không đến từ một khoảnh khắc lớn, mà từ những lời nhắc nhỏ mỗi ngày. Khi công việc cuốn đi quá nhanh, người lãnh đạo cũng cần được "kéo lại" để lắng nghe, kết nối và dẫn dắt tỉnh táo hơn.',
    'EQ Calendar 2026 không chỉ là một cuốn lịch để bàn, mà là cẩm nang EQ mỗi ngày – giúp bạn vừa xem ngày, vừa tự soi lại cách mình đang hiện diện với đội ngũ.',
    'Chỉ một trang mỗi ngày, nhưng đủ tạo khác biệt cho cả năm.',
    '👉 EQ Calendar 2026 – món quà giúp lãnh đạo trưởng thành, đội ngũ gắn kết và công việc đi xa hơn.',
    '👉 Đặt lịch ngay hôm nay.',
  ];
  $order_contact_lead = 'Liên hệ với: ';
  $order_contact_name = 'Nguyễn Minh Tinh';
  $order_contact_role = ' – Business Development Manager để được hỗ trợ nhanh nhất';
  $order_messenger = 'Facebook Messenger';
  $order_note = 'hoặc thông qua form liên hệ bên dưới, chúng tôi sẽ liên lạc với Anh/Chị ngay khi nhận được thông tin.';
  $f_name = 'Họ và tên của bạn: *';
  $f_phone = 'Số điện thoại của bạn: *';
  $f_email = 'Email của bạn: *';
  $f_org = 'Tổ chức của bạn:';
  $f_notes = 'Ghi chú';
  $f_submit = 'Gửi';
  $about_h = 'Về The New Leaders';
  $about = [
    'The New Leaders là tổ chức giáo dục tiên phong tại Việt Nam mang đến chương trình đào tạo và huấn luyện Kỹ năng lãnh đạo bằng trí tuệ cảm xúc từ các trường đại học hàng đầu như Đại học Harvard Kennedy, Đại học Cornell và Đại học Oxford giúp thế hệ lãnh đạo mới ở Việt Nam có thể truyền cảm hứng, dẫn dắt đội ngũ hiệu quả hơn, và tạo ảnh hưởng tích cực tới doanh nghiệp và cộng đồng.',
    'Theo dõi The New Leaders Network để nhận được những thông tin lý thú về EQ hàng ngày để phát triển khả năng lãnh đạo dựa trên EQ nhé!',
  ];
  $founder_h = 'Người sáng lập';
  $founder = [
    'Ngân Trần là nhà đào tạo quốc tế và executive coach chuyên sâu trong lĩnh vực Lãnh đạo bằng Trí tuệ Cảm xúc (EQ Leadership).',
    'Chị tốt nghiệp các chương trình Lãnh đạo cấp cao tại Harvard Kennedy School, Cornell University, và chương trình Mastery Training for Executive Leadership Coaching.',
    'Là Top 4% Global Leadership Influencer và Top Voice về Leadership & EQ Communication trên LinkedIn, Ngân Trần đã đào tạo lãnh đạo tại hơn 20 quốc gia, hợp tác cùng nhiều tổ chức hàng đầu như Harvard University, The Obama Foundation, USAID, RMIT, Fulbright, JW Marriott, Heineken, VietinBank, Vietcombank, VNG, Gamuda Land...',
    'Với hơn 15 năm kinh nghiệm lãnh đạo quốc tế, chị mang đến không chỉ kiến thức toàn cầu mà còn niềm tin, cảm hứng và phương pháp phát triển bền vững cho đội ngũ lãnh đạo Việt Nam.',
  ];
} else {
  $buy = 'Buy now';
  $hero_eyebrow = 'A desktop EQ playbook for managers and leaders';
  $hero_title_pre = 'Breaking the limits ';
  $desc = [
    'In a year where the pace leaves everyone on the edge of burnout, what a team needs is not just a manager who is good at the work — but a leader who knows how to listen, empathize and inspire every single day. Because just one tone-deaf leadership style is enough to make nearly half of employees lose motivation and drop in performance.',
    'Changing the way you lead is not the work of a single course or one keynote talk. It begins with small reminders, with lucid moments in the middle of work that keeps sweeping you along. That is why The New Leaders created the EQ Calendar 2026 — a desk calendar that is also a "daily leadership handbook," helping you check the date and check in with yourself: Have I connected enough? Have I listened in the right place? Have I led with positive emotion?',
    'Just one calendar page a day — but enough to change your leadership journey across a whole year. EQ Calendar 2026: a gift that helps leaders grow, teams stay connected, and work flourish from the smallest things.',
  ];
  $special_h = '"This EQ calendar is special because:"';
  $special = [
    ['t' => 'Compelling themes', 'p' => 'Each month carries a theme of leadership through emotional intelligence, grounded in leadership and emotional-intelligence training frameworks from the world\'s leading management schools such as Harvard Kennedy School, Cornell University, and the University of Oxford...'],
    ['t' => 'Thoughtful delivery', 'p' => 'The messages and lessons are conveyed thoughtfully through creative, relatable visuals. Practice prompts help you build the habits that develop the leadership capabilities that matter most.'],
    ['t' => 'Practice prompts', 'p' => 'Detailed practice prompts help form daily habits, developing and reinforcing essential leadership capabilities — from managing emotions to building relationships and making effective decisions.'],
  ];
  $special_foot = '12 months – 12 themes on EQ Leadership';
  $forwho_h = 'Who this calendar is for';
  $forwho = [
    'Managers and leaders.',
    'Individuals who want to do their job better in a management or leadership role.',
    'Individuals who want to develop a modern leadership mindset built on emotional intelligence.',
    'Individuals who want to bring positive emotions and motivation into their work.',
    'Individuals who need a companion to remind them of their goals every day.',
  ];
  $order_h = 'To order the "Desktop EQ Handbook" calendar';
  $order_p = [
    'Changing the way you lead does not come from one grand moment, but from small reminders every day. When work sweeps by too fast, leaders also need to be "pulled back" so they can listen, connect and lead with a clearer mind.',
    'EQ Calendar 2026 is not just a desk calendar, but a daily EQ handbook – helping you check the date while reflecting on how you are showing up for your team.',
    'Just one page a day, yet enough to make a difference across the whole year.',
    '👉 EQ Calendar 2026 – a gift that helps leaders grow, teams stay connected, and work go further.',
    '👉 Order your calendar today.',
  ];
  $order_contact_lead = 'Contact: ';
  $order_contact_name = 'Nguyen Minh Tinh';
  $order_contact_role = ' – Business Development Manager for the fastest support';
  $order_messenger = 'Facebook Messenger';
  $order_note = 'or use the contact form below, and we will get in touch with you as soon as we receive your information.';
  $f_name = 'Your name: *';
  $f_phone = 'Your phone number: *';
  $f_email = 'Your email: *';
  $f_org = 'Your organization:';
  $f_notes = 'Notes';
  $f_submit = 'Submit';
  $about_h = 'About The New Leaders';
  $about = [
    'The New Leaders is a pioneering education organization in Vietnam, delivering training and coaching programs on Emotional Intelligence Leadership drawn from leading universities such as Harvard Kennedy School, Cornell University and the University of Oxford — helping Vietnam\'s new generation of leaders inspire others, lead their teams more effectively, and create positive impact on businesses and communities.',
    'Follow The New Leaders Network to receive fascinating EQ insights every day and grow your EQ-based leadership!',
  ];
  $founder_h = 'Founder';
  $founder = [
    'Ngan Tran is an international trainer and executive coach specializing in Emotional Intelligence Leadership (EQ Leadership).',
    'She graduated from senior leadership programs at Harvard Kennedy School, Cornell University, and the Mastery Training for Executive Leadership Coaching program.',
    'A Top 4% Global Leadership Influencer and a Top Voice on Leadership & EQ Communication on LinkedIn, Ngan Tran has trained leaders in more than 20 countries, partnering with many leading organizations such as Harvard University, The Obama Foundation, USAID, RMIT, Fulbright, JW Marriott, Heineken, VietinBank, Vietcombank, VNG, Gamuda Land...',
    'With over 15 years of international leadership experience, she brings not only global knowledge but also trust, inspiration, and a sustainable development approach for Vietnam\'s leadership teams.',
  ];
}
?>
<main class="site-main page-cal">

  <section class="cal-hero section">
    <div class="container cal-hero__inner">
      <div class="cal-hero__text">
        <p class="cal-hero__eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
        <h1 class="cal-hero__title"><?php echo esc_html($hero_title_pre); ?><span>2026</span></h1>
        <?php foreach ($desc as $d) : ?><p class="cal-hero__desc"><?php echo esc_html($d); ?></p><?php endforeach; ?>
        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
      </div>
      <div class="cal-hero__media"><img src="<?php echo esc_url($img); ?>" alt="The EQ Calendar 2026" loading="eager"></div>
    </div>
  </section>

  <section class="cal-special section">
    <div class="container">
      <h2 class="cal-special__h"><?php echo esc_html($special_h); ?></h2>
      <div class="cal-special__grid">
        <?php foreach ($special as $s) : ?><div class="cal-sp"><h3><?php echo esc_html($s['t']); ?></h3><p><?php echo esc_html($s['p']); ?></p></div><?php endforeach; ?>
      </div>
      <p class="cal-special__foot"><?php echo esc_html($special_foot); ?></p>
    </div>
  </section>

  <section class="cal-forwho section">
    <div class="container">
      <h2 class="cal-forwho__h"><?php echo esc_html($forwho_h); ?></h2>
      <ol class="cal-forwho__list">
        <?php foreach ($forwho as $i => $f) : ?><li><span class="cal-forwho__num"><?php printf('%02d', $i + 1); ?></span><p><?php echo esc_html($f); ?></p></li><?php endforeach; ?>
      </ol>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary cal-forwho__cta"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="cal-order section">
    <div class="container cal-order__inner">
      <div class="cal-order__text">
        <h2 class="cal-order__h"><?php echo esc_html($order_h); ?></h2>
        <?php foreach ($order_p as $p) : ?><p class="cal-order__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
        <p class="cal-order__contact"><?php echo esc_html($order_contact_lead); ?><strong><?php echo esc_html($order_contact_name); ?></strong><?php echo esc_html($order_contact_role); ?></p>
        <p class="cal-order__contact"><strong><?php echo esc_html($order_messenger); ?></strong> · <a href="tel:0962123440">0962 123 440</a></p>
        <p class="cal-order__note"><?php echo esc_html($order_note); ?></p>
      </div>
      <form class="cal-form tnl-ajax-form" method="post" action="#" data-form-type="EQ Calendar Order" novalidate>
        <div class="cal-field"><label><?php echo esc_html($f_name); ?></label><input type="text" name="name"></div>
        <div class="cal-field"><label><?php echo esc_html($f_phone); ?></label><input type="text" name="phone"></div>
        <div class="cal-field"><label><?php echo esc_html($f_email); ?></label><input type="email" name="email"></div>
        <div class="cal-field"><label><?php echo esc_html($f_org); ?></label><input type="text" name="org"></div>
        <div class="cal-field"><label><?php echo esc_html($f_notes); ?></label><textarea name="notes" rows="3"></textarea></div>
        <button type="submit" class="btn btn--primary cal-form__submit"><?php echo esc_html($f_submit); ?></button>
      </form>
    </div>
  </section>

  <section class="cal-about section">
    <div class="container">
      <h2 class="cal-about__h"><?php echo esc_html($about_h); ?></h2>
      <?php foreach ($about as $a) : ?><p class="cal-about__p"><?php echo esc_html($a); ?></p><?php endforeach; ?>
      <h3 class="cal-founder__h"><?php echo esc_html($founder_h); ?></h3>
      <?php foreach ($founder as $f) : ?><p class="cal-about__p"><?php echo esc_html($f); ?></p><?php endforeach; ?>
    </div>
  </section>

</main>
