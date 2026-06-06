<?php
/** Trang EQ Quiz — verbatim từ live (EN/VI). Bước 1/6 (form thông tin); logic quiz đầy đủ = phase 2. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$T = [
  'title'  => 'Bài trắc nghiệm Trí tuệ cảm xúc (EQ) miễn phí từ Harvard Business Review',
  'intro'  => 'Đối với nhiều người, văn phòng không phải là nơi để chia sẻ những câu chuyện cá nhân và kết nối tình cảm. Tuy nhiên, công việc thường chiếm nhiều năng lượng cảm xúc của bạn và có thể khiến bạn cảm thấy kiệt sức. Vì vậy, Trí tuệ Cảm xúc (EQ) sẽ giúp bạn tăng cường những cảm xúc tích cực. Đặc biệt đối với các nhà quản lý và lãnh đạo, EQ - khả năng kết nối, động viên và gây ảnh hưởng đến người khác đóng vai trò vô cùng quan trọng để thành công.',
  'aspects_lead' => 'Để tìm hiểu thêm về mức độ EQ của bạn, hãy làm bài trắc nghiệm 25 câu hỏi miễn phí của Harvard dưới đây để đánh giá Trí tuệ Cảm xúc của bạn ở 5 phương diện:',
  'aspects' => ['Sự tự nhận thức cảm xúc bản thân', 'Quan điểm tích cực', 'Quản trị cảm xúc bản thân', 'Khả năng thích ứng với sự thay đổi', 'Sự thấu cảm'],
  'disclaimer' => 'Lưu ý: Để hiểu sâu hơn về EQ của bạn, hãy đưa ra câu trả lời trung thực nhất có thể. Câu trả lời sát với suy nghĩ, hành vi của bạn ở hiện tại chứ không phải kỳ vọng của bạn về tương lai.',
  'fields' => ['Tên của bạn:', 'Số điện thoại của bạn:', 'Email của bạn:', 'Tổ chức/Công ty của bạn:', 'Chức vụ của bạn:'],
  'next'   => 'TIẾP THEO 1/6',
  'foot_lead' => 'Để hiểu thêm về kết quả EQ của bạn và bắt đầu có kế hoạch xây dựng và phát triển các kỹ năng về EQ và giao tiếp hiệu quả, tham khảo thêm tại đây.',
  'foot_p' => 'The New Leaders là tổ chức giáo dục tiên phong cung cấp chương trình đào tạo kỹ năng lãnh đạo bằng trí tuệ cảm xúc (EQ) thiết kế dựa trên cấu trúc các chương trình đào tạo lãnh đạo danh tiếng thế giới từ trường Harvard Kennedy, Đại học Cornell và Đại học Oxford tới Việt Nam.',
];
} else {
$T = [
  'title'  => 'Free Emotional Intelligence Quiz from Harvard Business Review',
  'intro'  => 'For many, office is not the place to share personal stories and connect emotionally. However, frequently your work takes much of your emotion energy and can make you feel exhausted. Therefore, Emotional Intelligence (EQ) will help you to increase positive emotions, manage relationships effectively and improve your productivity efficiently. Particularly for managers and leaders, EQ - the ability to connect, motivate and influence others - plays crucial roles for success.',
  'aspects_lead' => 'To learn more about your EQ level, take the free 25-question quiz from Harvard below to evaluate your Emotional Intelligence in 5 aspects:',
  'aspects' => ['Emotional Self-awareness', 'Positive Outlook', 'Emotional Self-Control', 'Adaptability', 'Empathy'],
  'disclaimer' => 'Disclaimer: To gain a deeper understanding of your EQ, give the responses as honestly as possible. The answer should show you in reality not your expectation in the future.',
  'fields' => ['Your name:', 'Your phone number:', 'Your email:', 'Your organization:', 'Your position:'],
  'next'   => 'NEXT PAGE 1/6',
  'foot_lead' => "To learn more about your EQ test's result and start developing & improving your EQ level, and communicate more effectively, start here.",
  'foot_p' => 'The New Leaders is the leading organization to provide emotional intelligence (EQ) leadership training with the frameworks from worldwide accredited leadership programs of Harvard Kennedy School, Cornell University, and Oxford University. Our mission is to advance EQ Leadership & Communication skills to a world-class standard for leaders and their team members.',
];
}
$aspect_mods = ['teal', 'green', 'orange', 'pink', 'teal'];
?>
<main class="site-main page-quiz">
  <section class="quiz-sec section">
    <div class="container quiz-sec__inner">

      <h1 class="quiz-sec__title"><?php echo esc_html($T['title']); ?></h1>
      <p class="quiz-sec__intro"><?php echo esc_html($T['intro']); ?></p>

      <p class="quiz-sec__aspects-lead"><?php echo esc_html($T['aspects_lead']); ?></p>
      <div class="quiz-aspects">
        <?php foreach ($T['aspects'] as $i => $a) : ?>
          <span class="quiz-aspect quiz-aspect--<?php echo $aspect_mods[$i % count($aspect_mods)]; ?>"><?php echo esc_html($a); ?></span>
        <?php endforeach; ?>
      </div>

      <p class="quiz-sec__disclaimer"><?php echo esc_html($T['disclaimer']); ?></p>

      <form class="quiz-form" method="post" action="#" novalidate>
        <?php foreach ($T['fields'] as $i => $label) :
          $type = (stripos($label, 'email') !== false) ? 'email' : 'text'; ?>
          <div class="quiz-field">
            <label for="q-f<?php echo $i; ?>"><?php echo esc_html($label); ?></label>
            <input type="<?php echo $type; ?>" id="q-f<?php echo $i; ?>" name="f<?php echo $i; ?>">
          </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn--primary quiz-form__next"><?php echo esc_html($T['next']); ?></button>
      </form>

      <div class="quiz-foot">
        <p class="quiz-foot__lead"><?php echo esc_html($T['foot_lead']); ?></p>
        <p class="quiz-foot__p"><?php echo esc_html($T['foot_p']); ?></p>
      </div>

    </div>
  </section>
</main>
