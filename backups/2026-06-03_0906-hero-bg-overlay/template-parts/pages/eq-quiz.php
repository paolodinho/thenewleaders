<?php
/** Trang EQ Quiz tương tác — 25 câu/5 phương diện, chấm điểm client-side. Verbatim từ live (EN/VI). */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$intro = [
  'title'   => 'Bài trắc nghiệm Trí tuệ cảm xúc (EQ) miễn phí từ Harvard Business Review',
  'lead'    => 'Đối với nhiều người, văn phòng không phải là nơi để chia sẻ những câu chuyện cá nhân và kết nối tình cảm. Tuy nhiên, công việc thường chiếm nhiều năng lượng cảm xúc của bạn và có thể khiến bạn cảm thấy kiệt sức. Vì vậy, Trí tuệ Cảm xúc (EQ) sẽ giúp bạn tăng cường những cảm xúc tích cực. Đặc biệt đối với các nhà quản lý và lãnh đạo, EQ - khả năng kết nối, động viên và gây ảnh hưởng đến người khác đóng vai trò vô cùng quan trọng để thành công.',
  'aspects_lead' => 'Để tìm hiểu thêm về mức độ EQ của bạn, hãy làm bài trắc nghiệm 25 câu hỏi miễn phí của Harvard dưới đây để đánh giá Trí tuệ Cảm xúc của bạn ở 5 phương diện:',
  'pills'   => ['Sự tự nhận thức cảm xúc bản thân', 'Quan điểm tích cực', 'Quản trị cảm xúc bản thân', 'Khả năng thích ứng với sự thay đổi', 'Sự thấu cảm'],
  'disclaimer' => 'Lưu ý: Để hiểu sâu hơn về EQ của bạn, hãy đưa ra câu trả lời trung thực nhất có thể. Câu trả lời sát với suy nghĩ, hành vi của bạn ở hiện tại chứ không phải kỳ vọng của bạn về tương lai. Kết quả sẽ được gửi đến email của bạn.',
  'foot_lead' => 'Để hiểu thêm về kết quả EQ của bạn và bắt đầu có kế hoạch xây dựng và phát triển các kỹ năng về EQ và giao tiếp hiệu quả, tham khảo thêm tại đây.',
  'foot_p' => 'The New Leaders là tổ chức giáo dục tiên phong cung cấp chương trình đào tạo kỹ năng lãnh đạo bằng trí tuệ cảm xúc (EQ) thiết kế dựa trên cấu trúc các chương trình đào tạo lãnh đạo danh tiếng thế giới từ trường Harvard Kennedy, Đại học Cornell và Đại học Oxford tới Việt Nam.',
];
$quiz = [
  'info_title' => 'Thông tin của bạn',
  'fields' => ['Tên của bạn:', 'Số điện thoại của bạn:', 'Email của bạn:', 'Tổ chức/Công ty của bạn:', 'Chức vụ của bạn:'],
  'options' => [['Luôn luôn',5],['Hầu hết thời gian',4],['Thường xuyên',3],['Thỉnh thoảng',2],['Hiếm khi',1],['Không bao giờ',0]],
  'next' => 'TIẾP THEO', 'back' => 'Quay lại', 'submit' => 'Xem kết quả', 'required' => 'Vui lòng chọn một câu trả lời',
  'restart' => 'Làm lại bài trắc nghiệm',
  'res_title' => 'Kết quả Trí tuệ cảm xúc của bạn',
  'you_scored' => 'Điểm của bạn:', 'out_of' => '/', 'your_score' => 'Điểm của bạn', 'avg' => 'Mức trung bình người tham gia khảo sát',
  'opp' => 'Cơ hội cải thiện', 'strength' => 'Điểm mạnh',
  'steps' => [
    ['title' => 'Khả năng tự nhận thức cảm xúc bản thân', 'bg' => '#5AD3ED', 'q' => ['Tôi có thể mô tả cảm xúc của mình trong mọi khoảnh khắc.', 'Tôi có thể mô tả chi tiết cảm xúc của mình, không chỉ đơn thuần là “vui”, “buồn”, “tức giận”, v.v.', 'Tôi hiểu lý do của những cảm xúc mà mình có.', 'Tôi hiểu căng thẳng ảnh hưởng đến tâm trạng và hành vi của tôi như thế nào.', 'Tôi biết điểm mạnh và điểm yếu của bản thân trong cách tôi dẫn dắt người khác.']],
    ['title' => 'Góc nhìn tích cực', 'bg' => '#FF9B52', 'q' => ['Tôi có thái độ tích cực khi đối mặt với thách thức.', 'Tôi tập trung nhìn nhận các cơ hội hơn là những trở ngại.', 'Tôi thấy mọi người đều có ý tốt và thiện chí.', 'Tôi mong chờ vào tương lai.', 'Tôi cảm thấy hy vọng, háo hức.']],
    ['title' => 'Khả năng tự kiểm soát cảm xúc', 'bg' => '#AFE56B', 'q' => ['Tôi quản lý căng thẳng hiệu quả.', 'Tôi bình tĩnh khi đối mặt với áp lực hoặc rối loạn cảm xúc.', 'Tôi kiểm soát được sự bốc đồng của mình.', 'Tôi biết sử dụng những cảm xúc mang sắc thái mạnh (tức giận, sợ hãi và phấn khích) một cách thích hợp và vì lợi ích chung.', 'Tôi kiên nhẫn.']],
    ['title' => 'Khả năng thích nghi', 'bg' => '#FFC75A', 'q' => ['Tôi ứng biến linh hoạt khi tình huống thay đổi bất ngờ.', 'Tôi thành thạo trong việc quản lý nhiều nhu cầu mâu thuẫn với nhau.', 'Tôi có thể dễ dàng điều chỉnh mục tiêu khi hoàn cảnh thay đổi.', 'Tôi có thể thay đổi các ưu tiên của mình một cách nhanh chóng.', 'Tôi thích nghi dễ dàng khi trước những tình huống bấp bênh hoặc luôn thay đổi.']],
    ['title' => 'Thấu cảm', 'bg' => '#5AD3ED', 'q' => ['Tôi cố gắng hiểu cảm xúc tiềm ẩn sâu bên trong của mọi người.', 'Sự tò mò của tôi về người khác thôi thúc tôi chăm chú lắng nghe họ.', 'Tôi cố gắng hiểu tại sao mọi người lại có cách cư xử như họ thể hiện.', 'Tôi dễ dàng hiểu quan điểm của người khác ngay cả khi họ có quan điểm khác với tôi.', 'Tôi hiểu những trải nghiệm có thể gây ảnh hưởng như thế nào đến cảm xúc, suy nghĩ và hành vi của họ.']],
  ],
];
} else {
$intro = [
  'title'   => 'Free Emotional Intelligence Quiz from Harvard Business Review',
  'lead'    => 'For many, office is not the place to share personal stories and connect emotionally. However, frequently your work takes much of your emotion energy and can make you feel exhausted. Therefore, Emotional Intelligence (EQ) will help you to increase positive emotions, manage relationships effectively and improve your productivity efficiently. Particularly for managers and leaders, EQ - the ability to connect, motivate and influence others - plays crucial roles for success.',
  'aspects_lead' => 'To learn more about your EQ level, take the free 25-question quiz from Harvard below to evaluate your Emotional Intelligence in 5 aspects:',
  'pills'   => ['Emotional Self-awareness', 'Positive Outlook', 'Emotional Self-Control', 'Adaptability', 'Empathy'],
  'disclaimer' => 'Disclaimer: To gain a deeper understanding of your EQ, give the responses as honestly as possible. The answer should show you in reality not your expectation in the future. The result will be sent to your email.',
  'foot_lead' => "To learn more about your EQ test's result and start developing & improving your EQ level, and communicate more effectively, start here.",
  'foot_p' => 'The New Leaders is the leading organization to provide emotional intelligence (EQ) leadership training with the frameworks from worldwide accredited leadership programs of Harvard Kennedy School, Cornell University, and Oxford University. Our mission is to advance EQ Leadership & Communication skills to a world-class standard for leaders and their team members.',
];
$quiz = [
  'info_title' => 'Your information',
  'fields' => ['Your name:', 'Your phone number:', 'Your email:', 'Your organization:', 'Your position:'],
  'options' => [['Always',5],['Most of the time',4],['Frequently',3],['Sometimes',2],['Rarely',1],['Never',0]],
  'next' => 'NEXT PAGE', 'back' => 'Back', 'submit' => 'See results', 'required' => 'Please select an answer',
  'restart' => 'Retake the quiz',
  'res_title' => 'Your Emotional Intelligence results',
  'you_scored' => 'You scored', 'out_of' => 'out of', 'your_score' => 'Your score', 'avg' => 'Average',
  'opp' => 'Opportunity for development', 'strength' => 'Strength',
  'steps' => [
    ['title' => 'Emotional Self-Awareness', 'bg' => '#5AD3ED', 'q' => ['I can describe my emotions in the moment I experience them.', 'I can describe my feelings in detail, beyond just “happy,” “sad,” “angry,” and so on.', 'I understand the reasons for my feelings.', 'I understand how stress affects my mood and behavior.', 'I understand my leadership strengths and weaknesses.']],
    ['title' => 'Positive Outlook', 'bg' => '#FF9B52', 'q' => ['I’m optimistic in the face of challenging circumstances.', 'I focus on opportunities rather than obstacles.', 'I see people as good and well-intentioned.', 'I look forward to the future.', 'I feel hopeful.']],
    ['title' => 'Emotional Self-Control', 'bg' => '#AFE56B', 'q' => ['I manage stress well.', 'I’m calm in the face of pressure or emotional turmoil.', 'I control my impulses.', 'I use strong emotions, such as anger, fear, and joy, appropriately and for the good of others.', 'I’m patient.']],
    ['title' => 'Adaptability', 'bg' => '#FFC75A', 'q' => ['I’m flexible when situations change unexpectedly.', 'I’m adept at managing multiple, conflicting demands.', 'I can easily adjust goals when circumstances change.', 'I can shift my priorities quickly.', 'I adapt easily when a situation is uncertain or ever-changing.']],
    ['title' => 'Empathy', 'bg' => '#5AD3ED', 'q' => ['I strive to understand people’s underlying feelings.', 'My curiosity about others drives me to listen attentively to them.', 'I try to understand why people behave the way they do', 'I readily understand others’ viewpoints, even when they are different from my own.', 'I understand how other people’s experiences affect their feelings, thoughts, and behavior.']],
  ],
];
}
$pill_mods = ['teal', 'green', 'orange', 'pink', 'teal'];
?>
<main class="site-main page-quiz">
  <section class="quiz-sec section">
    <div class="container quiz-sec__inner">

      <h1 class="quiz-sec__title"><?php echo esc_html($intro['title']); ?></h1>
      <p class="quiz-sec__intro"><?php echo esc_html($intro['lead']); ?></p>
      <p class="quiz-sec__aspects-lead"><?php echo esc_html($intro['aspects_lead']); ?></p>
      <div class="quiz-aspects">
        <?php foreach ($intro['pills'] as $i => $a) : ?>
          <span class="quiz-aspect quiz-aspect--<?php echo $pill_mods[$i % count($pill_mods)]; ?>"><?php echo esc_html($a); ?></span>
        <?php endforeach; ?>
      </div>
      <p class="quiz-sec__disclaimer"><?php echo esc_html($intro['disclaimer']); ?></p>

      <!-- Quiz tương tác (render bằng JS) -->
      <div id="eq-quiz" class="eq-quiz" data-quiz="<?php echo esc_attr(wp_json_encode($quiz)); ?>"></div>

      <div class="quiz-foot">
        <p class="quiz-foot__lead"><?php echo esc_html($intro['foot_lead']); ?></p>
        <p class="quiz-foot__p"><?php echo esc_html($intro['foot_p']); ?></p>
      </div>

    </div>
  </section>
</main>
