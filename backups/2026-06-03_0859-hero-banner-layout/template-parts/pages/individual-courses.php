<?php
/** our-services/individual-courses — verbatim từ live (EN/VI). Nhiều phần live để nguyên tiếng Anh. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

$tagline = 'Enhance your leadership with EQ Communicate with impact, inspire action, and lead real change Start mastering your EQ today!';
$hero_cta = $vi ? 'Khám phá ngay!' : 'Explore now!';
$pills = $vi ? ['Thiết thực.', 'Lấy con người làm trung tâm.', 'Đổi mới.', 'Tác động lâu dài.'] : ['Practical.', 'People-centered.', 'Innovative.', 'Enduring impact.'];

$prog_h = 'Individual Program';
$exec = ['t' => 'Executive 1-1 Coach', 'd' => 'Personalized coaching program to elevate your leadership exellence.', 'cta' => 'Learn more'];
$courses_intro_h = 'EQ Leadership Communication Courses for Managers, Leaders';
$courses_intro_d = 'Master EQ leadership communication to speak with impact, influence behaviors, and drive meaningful action. Build engagement, boost productivity, and unlock your team’s full potential.';
$courses_intro_cta = 'Explore our courses!';
$courses_label1 = 'Individual course 2025 schedule';
$courses_label2 = 'Individual courses overview';
$course_sub = 'Foundational EQ Leadership Course for Leaders, Managers';

$c1_date = $vi ? 'Date: 15-16/3 & 14-15/6/2025' : 'Date: 19-20/4 & 14-15/6/2025';
$courses = [
  ['t' => 'Build a Positive Environment, Optimize for High-Performance Teams', 'date' => $c1_date, 'loc' => 'Location: Ho Chi Minh city', 'd' => 'Learn the art of Emotional Intelligence to lead with impact—control emotions under pressure, communicate with influence, and build a high-performing team through proven strategies from Harvard.', 'cta' => 'Learn more'],
  ['t' => 'Leading the New Generation, Unlock Potential with EQ', 'date' => 'Date: Date & Time: 12-13/7/2025', 'loc' => 'Location: Ho Chi Minh city', 'd' => 'Understand and lead the new generation with science-backed insights on behavior, hormones, neuroscience, and Emotional Intelligence. Advance motivation and feedback strategies to inspire growth and lasting impact.', 'cta' => 'Coming soon'],
  ['t' => 'Ignite Team Motivation – Lead with a New Approach', 'date' => 'Date: 13-14/9/2025', 'loc' => 'Location: Ho Chi Minh city', 'd' => 'Unlock high-performance leadership by maximizing impact with minimal resources. Master science-backed motivation strategies, EQ-driven communication, and effective challenge-based approaches to foster a focused, creative, and goal-oriented team.', 'cta' => 'Learn more'],
];

if ($vi) {
  $whyus_h = 'Điều khiến chúng tôi khác biệt?'; $whyus_lead = '';
  $whyus = [
    ['t' => 'Dựa trên các chương trình đào tạo lãnh đạo hàng đầu trên thế giới', 'd' => 'Tổ chức giáo dục tiên phong tại Việt Nam cung cấp các chương trình Đào tạo Lãnh đạo với Trí tuệ Cảm xúc (EQ) dựa trên cấu trúc đào tạo lãnh đạo của trường Đại học Harvard và Đại học Oxford.'],
    ['t' => 'Tầm nhìn nhân lực vươn tầm quốc tế', 'd' => 'Chúng tôi mang trong mình sứ mệnh nâng tầm kỹ năng giao tiếp bằng Trí tuệ cảm xúc (EQ) cho các nhà lãnh đạo và toàn bộ đội ngũ nhân sự theo chuẩn quốc tế.'],
    ['t' => 'Thiết kế chương trình đào tạo mang tính thực tế', 'd' => 'Luyện tập thường xuyên là chìa khoá để hình thành và thuần thục kỹ năng. Chính vì vậy, chương trình của chúng tôi được thiết kế với 80% thời lượng đào tạo là thực hành và thảo luận dựa trên các tình huống thực tế trong doanh nghiệp và nhận đánh giá trực tiếp từ chuyên gia để bạn có thể áp dụng trực tiếp những kiến thức đã học vào công việc của mình và cuộc sống hàng ngày.'],
    ['t' => 'Chương trình đào tạo dài hạn mang lại hiệu quả lâu dài', 'd' => 'Chương trình dài hạn với các hoạt động thực hành liên tục và tham vấn cùng chuyên gia sau workshop đào tạo (tùy theo chương trình) nhằm xây dựng và phát triển kỹ năng giao tiếp bằng trí tuệ cảm xúc (EQ) trong cuộc sống và công việc.'],
  ];
  $tm_h = 'What people are saying';
  $people = [
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'Khoá học của The New Leaders đã giúp tôi cải thiện kỹ năng của mình ở vị trí lãnh đạo của một startup tỉ đô để có thể tạo động lực & truyền cảm hứng cho team tiến về phía trước. Những điều học được từ khoá học này còn cực kì hữu ích khi tôi thường xuyên là diễn giả trong các sự kiện cộng đồng và là nhà sáng lập của một tổ chức phi chính phủ.'],
    ['n' => 'Barry Weisblatt', 'r' => 'Giám đốc Nghiên cứu tại VNDIRECT Securities Corporation, Nguyên giám đốc tại Equity Markets & Securitization VinFast Global', 'q' => 'Ngân đã thực sự giúp tôi trở thành một nhà lãnh đạo tốt hơn. Cô ấy biết lắng nghe và dựa trên kiến thức cũng như kinh nghiệm phong phú của bản thân để đưa ra những lời khuyên sâu sắc và thiết thực. Điều này giúp tôi đối mặt với các vấn đề và truyền cảm hứng cho nhóm hoạt động và phát triển một cách hiệu quả. Sau một thời gian ở vị trí dẫn đầu, chúng ta rất dễ để trở nên tự mãn trong cách làm việc. Chính vì vậy, Ngân đã giúp tôi có được góc nhìn mới và tiếp tục thăng tiến trong sự nghiệp.'],
    ['n' => 'Sarah Smith', 'r' => 'CEO tại MNC', 'q' => 'Đảm nhận vai trò mới là CEO của công ty thật sự là một thách thức đối với tôi. Tôi chuyển đến một môi trường mới, nơi mọi thứ diễn ra trì trệ hơn so với kỳ vọng của tôi. Đôi lúc tôi cảm thấy cô đơn và kiệt sức nhưng Ngân đã giúp tôi củng cố kỹ năng lãnh đạo của mình, chỉ cho tôi cách để kết nối và dần dần thúc đẩy, truyền cảm hứng cho đội ngũ. Thực hành những kỹ năng lãnh đạo bằng EQ quả thật không phải điều dễ dàng, nhưng thật sự nó rất hiệu quả. Cảm ơn Ngân vì đã là một phần của hành trình trở thành một nhà lãnh đạo xuất sắc của tôi.'],
    ['n' => 'Peter Mayer', 'r' => 'Cựu CEO tại Tập đoàn khách sạn Lodgis, Cựu CEO Fusion Resorts & Hotels, Cựu CEO Sofitel Legend Metropole Hanoi, Cựu Phó Chủ tịch Bất động sản J.P Morgan Châu Á, MBA Harvard', 'q' => 'Điều tạo nên sự khác biệt giữa Quản lý và Nhà lãnh đạo thành công không phải là năng lực chuyên môn của họ mà là khả năng kết nối với mọi người. Hiển nhiên là các CEO thường có tư duy chiến lược và kỹ năng tài chính rất tốt. Nhưng chính kỹ năng EQ sắc bén của họ mới là yếu tố thúc đẩy đội ngũ của họ. Chương trình coaching cho lãnh đạo điều hành từ The New Leaders giúp phát triển và trau dồi khả năng thiết yếu này.'],
  ];
} else {
  $whyus_h = 'Why us?'; $whyus_lead = 'We are distinguished from others because we provide:';
  $whyus = [
    ['t' => 'Worldwide recognized-quality Leadership Programs', 'd' => "The leading educational organization in Vietnam provides Emotional Intelligence (EQ) Leadership Training programs based on Harvard Business School and Oxford University's Leadership Frameworks."],
    ['t' => 'World-class Working Standard Vision', 'd' => 'Our mission is to advance EQ Communication skills to a world-class standard for leaders and their team members.'],
    ['t' => 'Practical Training Program Design', 'd' => 'As skills need to be practiced to master them, the program will be designed with 80% of the training is to practice, discuss and get coaching directly based on real & practical case scenarios in business so that you can apply directly the gained knowledge to your daily work.'],
    ['t' => 'Long-term program to make real impacts', 'd' => 'Long term follow-up & coaching (varied per program) by our coach/trainers and technology/AI after the training workshop to support them to build and develop their EQ Communication skills in life and at work.'],
  ];
  $tm_h = 'What people are saying';
  $people = [
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'The sessions from Ngan have helped me sharpen my skills as a leader of a multi-bill USD start-up to be able to motivate & inspire team members to take actions. This is also extremely helpful for me as a frequent public speaker and founder of an NGO.'],
    ['n' => 'Barry Weisblatt', 'r' => 'Head of Research Department at VNDIRECT Securities Corporation/ Former Head of Equity Markets & Securitization VinFast Global', 'q' => 'Ngan has really helped me to be a better leader. She is a great listener and draws upon a wealth of knowledge and experience to offer insightful, practical advice to guide me in facing problems and inspiring my team to perform and develop. After you have been in leading position for a while, it is easy to get complacent in the way you do things. Ngan has really helped me to gain new perspectives and continue improving in my career.'],
    ['n' => 'Sarah Smith', 'r' => 'CEO of MNC', 'q' => "Taking on a new role as CEO has been quite challenging. I moved to a new environment where it seems like people are moving slowly and lack motivation. Sometimes, I feel a clear sense of loneliness as a leader and experience burnout. Ngan has helped me strengthen my leadership skills, allowing me to connect with, gradually motivate, and inspire the team. It hasn't been easy, but I have experienced the power of effective leadership. I'm grateful to have her as part of my journey toward becoming a great leader."],
    ['n' => 'Peter Mayer', 'r' => 'Former CEO Lodgis Hospitality Holdings, Former CEO Fusion Resorts & Hotels, Former CEO Sofitel Legend Metropole Hanoi, Former VP Asian Head of Real estate J.P Morgan, MBA Harvard', 'q' => "What separates successful Leaders and Managers are not THEIR technical COMPETENCE, but the ability to connect to their people. Of course, CEO's often have great strategic thinking and financial skills, but it is their sharp EQ that drives their organizations. The executive coaching from The New Leaders develop and hone this essential capability."],
  ];
}
$pill_mods = ['orange', 'teal', 'green', 'pink'];
$exec_url = tnl_url('our-services/executive-coach');
$contact = tnl_url('contact');
?>
<main class="site-main page-service">

  <section class="svc-hero section">
    <div class="container">
      <h1 class="svc-hero__title"><?php echo esc_html($tagline); ?></h1>
      <span class="svc-hero__label"><?php echo esc_html($hero_cta); ?></span>
      <div class="svc-pills">
        <?php foreach ($pills as $i => $p) : ?><span class="svc-pill svc-pill--<?php echo $pill_mods[$i % 4]; ?>"><?php echo esc_html($p); ?></span><?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="svc-block section">
    <div class="container">
      <h2 class="svc-block__title"><?php echo esc_html($prog_h); ?></h2>
      <div class="svc-cards svc-cards--single">
        <article class="svc-card">
          <h3 class="svc-card__title"><?php echo esc_html($exec['t']); ?></h3>
          <p class="svc-card__desc"><?php echo esc_html($exec['d']); ?></p>
          <a href="<?php echo esc_url($exec_url); ?>" class="svc-card__more"><?php echo esc_html($exec['cta']); ?></a>
        </article>
      </div>
    </div>
  </section>

  <section class="ic-courses section">
    <div class="container">
      <h2 class="ic-courses__h"><?php echo esc_html($courses_intro_h); ?></h2>
      <p class="ic-courses__intro"><?php echo esc_html($courses_intro_d); ?></p>
      <a href="#ic-list" class="btn btn--primary ic-courses__cta"><?php echo esc_html($courses_intro_cta); ?></a>

      <div class="ic-schedule" id="ic-list">
        <p class="ic-schedule__label"><?php echo esc_html($courses_label1); ?></p>
        <h3 class="ic-schedule__title"><?php echo esc_html($courses_label2); ?></h3>
      </div>

      <div class="ic-grid">
        <?php foreach ($courses as $c) :
          $soon = stripos($c['cta'], 'coming') !== false; ?>
          <article class="ic-card">
            <h3 class="ic-card__title"><?php echo esc_html($c['t']); ?></h3>
            <p class="ic-card__sub"><?php echo esc_html($course_sub); ?></p>
            <p class="ic-card__meta"><?php echo esc_html($c['date']); ?></p>
            <p class="ic-card__meta"><?php echo esc_html($c['loc']); ?></p>
            <p class="ic-card__desc"><?php echo esc_html($c['d']); ?></p>
            <?php if ($soon) : ?>
              <span class="ic-card__soon"><?php echo esc_html($c['cta']); ?></span>
            <?php else : ?>
              <a href="<?php echo esc_url($contact); ?>" class="svc-card__more"><?php echo esc_html($c['cta']); ?></a>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pg-whyus section">
    <div class="container">
      <h2 class="pg-whyus__title"><?php echo esc_html($whyus_h); ?></h2>
      <?php if ($whyus_lead) : ?><p class="pg-whyus__lead"><?php echo esc_html($whyus_lead); ?></p><?php endif; ?>
      <div class="pg-whyus__grid">
        <?php foreach ($whyus as $w) : ?>
          <div class="pg-whyus__card"><h3 class="pg-whyus__card-title"><?php echo esc_html($w['t']); ?></h3><p class="pg-whyus__card-desc"><?php echo esc_html($w['d']); ?></p></div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pg-tm section">
    <div class="container">
      <h2 class="pg-tm__title"><?php echo esc_html($tm_h); ?></h2>
      <div class="pg-tm__grid">
        <?php foreach ($people as $p) : ?>
          <figure class="pg-quote"><blockquote class="pg-quote__text"><?php echo esc_html($p['q']); ?></blockquote><figcaption class="pg-quote__by"><span class="pg-quote__name"><?php echo esc_html($p['n']); ?></span><span class="pg-quote__role"><?php echo esc_html($p['r']); ?></span></figcaption></figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>
