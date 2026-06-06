<?php
/** Trang Chương trình đào tạo (Our Services) — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$T = [
  'hero_tagline' => 'Nâng tầm kỹ năng lãnh đạo và giao tiếp bằng trí tuệ cảm xúc (EQ) theo tiêu chuẩn quốc tế!',
  'hero_label'   => 'Tham gia ngay với chúng tôi!',
  'pills'        => ['Thiết thực.', 'Lấy con người làm trung tâm.', 'Đổi mới.', 'Tác động lâu dài.'],
  'business_h'   => 'Chương trình đào tạo dành cho doanh nghiệp',
  'business'     => [
    ['t' => 'Chương trình đào tạo lãnh đạo cho đội ngũ quản lý, lãnh đạo', 'd' => 'Nâng cao kỹ năng lãnh đạo của bạn với các chương trình Giao tiếp Lãnh đạo bằng EQ được thiết kế chuyên biệt của chúng tôi. Chương trình dành cho các nhà lãnh đạo doanh nghiệp để truyền cảm hứng, xây dựng niềm tin, tạo động lực và phát huy hết tiềm năng cho đội ngũ.'],
    ['t' => 'Chương trình đào tạo kỹ năng giao tiếp EQ cho đội ngũ', 'd' => 'Nâng cao kỹ năng giao tiếp cho các thành viên trong đội ngũ của bạn bằng các chương trình Giao tiếp EQ được thiết kế chuyên biệt của chúng tôi, giúp đội ngũ của bạn nắm vững các kỹ năng giao tiếp, nâng cao sự gắn kết và tối ưu hóa hiệu suất.'],
  ],
  'individual_h' => 'Chương trình cho cá nhân',
  'individual'   => ['t' => 'Coaching 1-1 cho lãnh đạo, quản lý cấp cao', 'd' => 'Chương trình coaching 1-1 được cá nhân hóa để nâng cao khả năng lãnh đạo của bạn.'],
  'learn_more'   => 'Tìm hiểu ngay!',
  'courses_h'    => 'Khoá học cá nhân',
  'courses'      => [
    'Khai phá sức mạnh EQ - chìa khóa thăng tiến cho nhà lãnh đạo Hướng Nội',
    'Vượt qua khuôn mẫu: Nghệ thuật phỏng vấn bằng thông minh cảm xúc',
    'Thúc đẩy động lực đội ngũ - Đừng dùng cách cũ!',
    'Xây dựng môi trường tích cực - Tối ưu cho đội ngũ hiệu suất cao',
  ],
  'tm_title'     => 'Đánh giá của các nhà lãnh đạo về khoá học của chúng tôi',
  'people'       => [
    ['n' => 'Ho Minh Quang', 'r' => 'Vice President Pudong Prime International', 'q' => 'Khoá học của The New Leaders giúp tôi tìm ra giá trị cốt lõi của mình và có thêm nhiều mối quan hệ ý nghĩa. Chính phương pháp huấn luyện đi vào bản chất cá nhân đã giúp tôi rất nhiều trong việc xây dựng thương hiệu cá nhân và trở nên hiệu quả hơn trong vai trò một người lãnh đạo.'],
    ['n' => 'Hoàng Việt Dũng', 'r' => 'Giám đốc - Grant Thornton Việt Nam', 'q' => 'Khóa học của The New Leaders mang lại giá trị to lớn vì các nhà lãnh đạo ở vị trí cao hơn phải đối mặt với những yêu cầu ngày càng tăng về kỹ năng trí tuệ cảm xúc. Nhận thức rõ điều này là yếu tố thiết yếu để đạt được hiệu suất tối ưu.'],
    ['n' => 'Pham Thi Hoai', 'r' => 'HR Director - T.A Viet Nam', 'q' => 'Trí tuệ cảm xúc (EQ) đóng vai trò then chốt đối với thành công của doanh nghiệp ngày nay, bất kể quy mô. Workshop của The New Leaders đã thúc đẩy EQ và kỹ năng lãnh đạo trong số các nhà quản lý và lãnh đạo, thúc đẩy khả năng lãnh đạo mạnh mẽ và cạnh tranh trong tổ chức của chúng tôi.'],
    ['n' => 'Nguyễn Đức Dũng', 'r' => 'Giám đốc Kinh doanh - Boehringer Ingelheim Việt Nam', 'q' => 'Các nhà lãnh đạo được hưởng lợi rất nhiều từ việc hiểu biết về quản lý cảm xúc, vì việc làm chủ cảm xúc của chính mình và lắng nghe hiệu quả có thể giúp hành trình cuộc sống trở nên dễ dàng hơn đáng kể.'],
    ['n' => 'Ha Thi Thuy An', 'r' => 'Export Sales Manager tại Khumsub', 'q' => 'Mình nhận được rất nhiều kiến thức bổ ích từ buổi workshop của The New Leaders, đặc biệt là việc áp dụng thông minh cảm xúc trong kỹ năng lãnh đạo đối với thời buổi hiện nay. Mình cũng rất ấn tượng với năng lượng và những kiến thức mà diễn giả Ngân Trần chia sẻ trong buổi workshop.'],
    ['n' => 'Dung Le', 'r' => 'Training & Development Manager - GameLoft Southeast Asia', 'q' => 'Khoá đào tạo của The New Leaders rất hữu hiệu và thiết thực ở nhiều mặt. Điều đặc biệt nhất chính là 80% thời lượng học được sử dụng để thực hành và coaching trong nhóm. Chính vì vậy, chúng tôi có thể rèn luyện và áp dụng ngay những kỹ năng vừa học.'],
    ['n' => 'Barry Weisblatt', 'r' => 'Giám đốc Nghiên cứu tại VNDIRECT Securities Corporation, Nguyên giám đốc tại Equity Markets & Securitization VinFast Global', 'q' => 'Ngân đã thực sự giúp tôi trở thành một nhà lãnh đạo tốt hơn. Cô ấy biết lắng nghe và dựa trên kiến thức cũng như kinh nghiệm phong phú của bản thân để đưa ra những lời khuyên sâu sắc và thiết thực. Điều này giúp tôi đối mặt với các vấn đề và truyền cảm hứng cho nhóm hoạt động và phát triển một cách hiệu quả. Sau một thời gian ở vị trí dẫn đầu, chúng ta rất dễ để trở nên tự mãn trong cách làm việc. Chính vì vậy, Ngân đã giúp tôi có được góc nhìn mới và tiếp tục thăng tiến trong sự nghiệp.'],
  ],
];
} else {
$T = [
  'hero_tagline' => 'Leverage your EQ Leadership and Communication skills to a world-class standard.',
  'hero_label'   => 'Leadership programs for managers, leaders',
  'pills'        => ['Practical.', 'People-centered.', 'Innovative.', 'Enduring impact.'],
  'business_h'   => 'Business Programs',
  'business'     => [
    ['t' => 'Leadership programs for managers, leaders', 'd' => "Transform your leadership with our customized EQ Leadership Communication programs, designed for business leaders to inspire trust, boost team enthusiasm, and unlock your team's full potential."],
    ['t' => 'EQ Communication programs for team members', 'd' => "Empower your team members' potential with our customized EQ Communication programs, designed to master communication skills, enhance team cohesion, and optimize performance."],
  ],
  'individual_h' => 'Individual Programs',
  'individual'   => ['t' => 'Executive 1-1 Coach', 'd' => 'Personalized coaching program to elevate your leadership excellence.'],
  'learn_more'   => 'Learn more',
  'courses_h'    => 'Individual courses',
  'courses'      => [
    'Building a Positive Environment for High Performance',
    'Motivation Reimagined - Boost Year-End Performance with Emotionally Intelligent Leadership',
  ],
  'tm_title'     => 'Our leaders say about the experience',
  'people'       => [
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'The sessions from Ngan have helped me sharpen my skills as a leader of a multi-bill USD start-up to be able to motivate & inspire team members to take actions. This is also extremely helpful for me as a frequent public speaker and founder of an NGO.'],
    ['n' => 'Hoang Viet Dung', 'r' => 'Director - Grant Thornton Vietnam', 'q' => 'The New Leaders course holds immense value because leaders in higher positions face increased demands for emotional intelligence skills. Being conscious of this fact is essential for optimal performance.'],
    ['n' => 'Ha Thi Thuy An', 'r' => 'Export Sales Manager at Khumsub', 'q' => "I received a lot of useful knowledge from The New Leaders' workshop, especially the application of emotional intelligence in leadership skills in today's world. I was also greatly impressed by the energy and expertise that Ngan Tran brought to the workshop."],
    ['n' => 'Kathy Le', 'r' => 'HR Consultant at Long Binh Company', 'q' => "Today's human resources are different from the past; they engage with us through understanding. At The New Leaders' workshop, I learned how to communicate in a way that makes those around me feel confident, safe, and understood, allowing them to be more open with me."],
    ['n' => 'Ho Minh Quang', 'r' => 'Vice President Pudong Prime International', 'q' => "Building trust and emotional intelligence (EQ) communication skills we've learned from The New Leaders' customized program have really helped our leadership team connect better. Developing EQ in our team has fostered a culture of trust, friendliness, and a safe space for sharing and creativity within the team."],
    ['n' => 'Hai Tran', 'r' => 'National Service Manager - MediGroup Vietnam', 'q' => "The Advance Customer Services Communication by Emotional Intelligence training program by The New Leaders has significantly transformed our team. Our ability to identify and manage emotions has greatly enhanced our customer relationships. We are highly impressed with the program's professionalism and effectiveness."],
    ['n' => 'Hang Nguyen', 'r' => 'Marketing & Communication Manager, VinaCaptial Foundation', 'q' => 'Anyone, especially people working in the humanitarian field, should acquire these skills to improve the quality of their communication, leading to further accomplishments in their career.'],
  ],
];
}
$pill_mods = ['orange', 'teal', 'green', 'pink'];
?>
<main class="site-main page-service">

  <!-- Hero -->
  <section class="svc-hero section">
    <div class="container">
      <h1 class="svc-hero__title"><?php echo esc_html($T['hero_tagline']); ?></h1>
      <span class="svc-hero__label"><?php echo esc_html($T['hero_label']); ?></span>
      <div class="svc-pills">
        <?php foreach ($T['pills'] as $i => $p) : ?>
          <span class="svc-pill svc-pill--<?php echo $pill_mods[$i % count($pill_mods)]; ?>"><?php echo esc_html($p); ?></span>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Business Programs -->
  <section class="svc-block section">
    <div class="container">
      <h2 class="svc-block__title"><?php echo esc_html($T['business_h']); ?></h2>
      <div class="svc-cards">
        <?php foreach ($T['business'] as $c) : ?>
          <article class="svc-card">
            <h3 class="svc-card__title"><?php echo esc_html($c['t']); ?></h3>
            <p class="svc-card__desc"><?php echo esc_html($c['d']); ?></p>
            <a href="#" class="svc-card__more"><?php echo esc_html($T['learn_more']); ?></a>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Individual Programs -->
  <section class="svc-block svc-block--alt section">
    <div class="container">
      <h2 class="svc-block__title"><?php echo esc_html($T['individual_h']); ?></h2>
      <div class="svc-cards svc-cards--single">
        <article class="svc-card">
          <h3 class="svc-card__title"><?php echo esc_html($T['individual']['t']); ?></h3>
          <p class="svc-card__desc"><?php echo esc_html($T['individual']['d']); ?></p>
          <a href="#" class="svc-card__more"><?php echo esc_html($T['learn_more']); ?></a>
        </article>
      </div>

      <h3 class="svc-courses__title"><?php echo esc_html($T['courses_h']); ?></h3>
      <ul class="svc-courses">
        <?php foreach ($T['courses'] as $course) : ?>
          <li class="svc-course"><a href="#"><span><?php echo esc_html($course); ?></span><span class="svc-course__arrow" aria-hidden="true">→</span></a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <!-- Testimonials -->
  <section class="svc-tm section">
    <div class="container">
      <h2 class="svc-tm__title"><?php echo esc_html($T['tm_title']); ?></h2>
      <div class="svc-tm__grid">
        <?php foreach ($T['people'] as $p) : ?>
          <figure class="svc-quote">
            <blockquote class="svc-quote__text"><?php echo esc_html($p['q']); ?></blockquote>
            <figcaption class="svc-quote__by">
              <span class="svc-quote__name"><?php echo esc_html($p['n']); ?></span>
              <span class="svc-quote__role"><?php echo esc_html($p['r']); ?></span>
            </figcaption>
          </figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>
