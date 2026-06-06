<?php
/** our-services/executive-coach — Coaching 1-1 cùng Ngân Trần. Verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$P = [
  'hero_title' => 'Coaching 1:1 cho Lãnh đạo điều hành cùng Ngân Trần',
  'creds' => ['CEO/ Nhà sáng lập The New Leaders', 'Huấn luyện viên được chứng nhận quốc tế.', 'Tốt nghiệp chương trình đào tạo lãnh đạo tại Đại học Harvard, Đại học Cornell và Đại học Oxford.', 'Tốt nghiệp chương trình Huấn luyện lãnh đạo điều hành cao cấp tại trường Đại học Harvard.'],
  'hero_cta' => 'Đặt lịch hẹn ngay hôm nay!',
  'intro_h' => 'Nâng cao khả năng lãnh đạo của bạn với sự huấn luyện từ chuyên gia!',
  'intro_p' => ['Bạn đã sẵn sàng để nâng tầm kỹ năng lãnh đạo với trí tuệ cảm xúc?', 'Là một nhà điều hành dày dạn kinh nghiệm, được đào tạo tại Trường Harvard Kennedy, Đại học Oxford và Đại học Cornell, bà Ngân Trần sẽ hỗ trợ các nhà lãnh đạo cấp cao như bạn đạt được thành công vượt bậc.', 'Tham gia vào mạng lưới toàn cầu gồm các giám đốc điều hành hàng đầu, những người đã nâng cao tác động lãnh đạo và truyền cảm hứng cho tổ chức của họ thông qua các chương trình huấn luyện điều hành được cá nhân hóa.'],
  'incl_h' => 'Hãy cùng nhau trở thành nhà lãnh đạo xuất sắc hơn!',
  'incl_lead' => 'Khi bạn tham gia cùng với bà Ngân Trần trong chương trình coaching 1-1 về:',
  'incl' => ['Lãnh đạo bằng trí tuệ cảm xúc (EQ) cho các cấp quản lý.', 'Lãnh đạo điều hành cao cấp dành cho giám đốc điều hành.', 'Chương trình coaching được thiết kế cá nhân hoá (kéo dài 3 hoặc 6 tháng) với:', 'Bài đánh giá về kỹ năng lãnh đạo và khả năng EQ, và bài đánh giá 360 độ.', 'Tài liệu học tập.', 'Email hỗ trợ không giới hạn trong suốt quá trình.', 'Chương trình 3 tháng (12 buổi tặng thêm 1 buổi).', 'Chương trình 6 tháng (24 buổi tặng thêm 2 buổi).', 'Kết hợp giữa coaching và tư vấn lãnh đạo EQ.'],
  'blind_h' => 'Nâng cao kỹ năng lãnh đạo bằng EQ với chương trình coaching cho lãnh đạo điều hành:',
  'blind_lead' => 'Bạn sẽ nhận được:',
  'blind' => [
    ['t' => 'Đánh giá trình độ lãnh đạo và khả năng trí tuệ cảm xúc (EQ) hiện tại:', 'd' => 'Hiểu rõ điểm mạnh và xác định các lĩnh vực cần phát triển của bạn.'],
    ['t' => 'Thiết lập các mục tiêu lãnh đạo rõ ràng:', 'd' => 'Xác định những mục tiêu cụ thể, có thể đạt được và phù hợp với mong muốn của bạn.'],
    ['t' => 'Hoạch định chiến lược phát triển cá nhân:', 'd' => 'Phát triển lộ trình chi tiết để đạt được các mục tiêu lãnh đạo.'],
    ['t' => 'Nhận sự hướng dẫn, theo sát sát sao từ chuyên gia:', 'd' => 'Được hỗ trợ liên tục để xây dựng và củng cố các thói quen mới về kỹ năng giao tiếp và lãnh đạo.'],
    ['t' => 'Hỗ trợ tìm giải pháp lãnh đạo cho các tình huống khẩn cấp:', 'd' => 'Nhận lời khuyên và huấn luyện để tự tin xử lý các tình huống quan trọng.'],
    ['t' => 'Thúc đẩy thăng tiến trong sự nghiệp và phát triển doanh nghiệp:', 'd' => 'Nâng cao hiệu quả lãnh đạo, truyền cảm hứng cho đội ngũ của bạn và giúp bạn tận hưởng công việc và cuộc sống trọn vẹn hơn.'],
  ],
  'blind_foot' => 'Hãy để chúng tôi giúp bạn biến mục tiêu thành hiện thực!',
  'howto_h' => 'Chia sẻ với chúng tôi những vấn đề của bạn bằng cách:',
  'howto' => ['“Book” lịch hẹn với cố vấn Ngân Trần.', 'Chia sẻ với chúng tôi những mong muốn và thời gian trao đổi thích hợp với bạn.', 'Đội ngũ của chúng tôi sẽ liên hệ lại với bạn trong thời gian sớm nhất.'],
  'reserve' => 'Đặt lịch hẹn ngay hôm nay!',
  'who_h' => 'Chương trình coaching 1-1 phù hợp với ai?',
  'who' => [
    ['t' => 'Quản lý cấp trung đang muốn thăng tiến lên các vị trí cao hơn', 'd' => 'Nâng tầm kỹ năng lãnh đạo của bạn cùng trí tuệ cảm xúc (EQ).'],
    ['t' => 'Quản lý và lãnh đạo cấp cao', 'd' => 'Nâng cao hiệu quả lãnh đạo bằng cách áp dụng trí tuệ cảm xúc vào phong cách lãnh đạo của bạn.'],
    ['t' => 'CEO và Nhà sáng lập công ty khởi nghiệp', 'd' => 'Tự tin xử lý các tình huống kinh doanh quan trọng, cấp bách và dẫn dắt tổ chức của bạn đến thành công.'],
    ['t' => 'Các nhà điều hành và Lãnh đạo C-level', 'd' => 'Nâng cao kỹ năng lãnh đạo của bạn để dẫn dắt đội ngũ và thúc đẩy doanh nghiệp của bạn theo những hướng đi mới, sáng tạo.'],
  ],
  'tm_h' => 'Các nhà quản lý, lãnh đạo nói gì?',
  'people' => [
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'Khoá học của The New Leaders đã giúp tôi cải thiện kỹ năng của mình ở vị trí lãnh đạo của một startup tỉ đô để có thể tạo động lực & truyền cảm hứng cho team tiến về phía trước. Những điều học được từ khoá học này còn cực kì hữu ích khi tôi thường xuyên là diễn giả trong các sự kiện cộng đồng và là nhà sáng lập của một tổ chức phi chính phủ.'],
    ['n' => 'Barry Weisblatt', 'r' => 'Giám đốc Nghiên cứu tại VNDIRECT Securities Corporation, Nguyên giám đốc tại Equity Markets & Securitization VinFast Global', 'q' => 'Ngân đã thực sự giúp tôi trở thành một nhà lãnh đạo tốt hơn. Cô ấy biết lắng nghe và dựa trên kiến thức cũng như kinh nghiệm phong phú của bản thân để đưa ra những lời khuyên sâu sắc và thiết thực. Điều này giúp tôi đối mặt với các vấn đề và truyền cảm hứng cho nhóm hoạt động và phát triển một cách hiệu quả. Sau một thời gian ở vị trí dẫn đầu, chúng ta rất dễ để trở nên tự mãn trong cách làm việc. Chính vì vậy, Ngân đã giúp tôi có được góc nhìn mới và tiếp tục thăng tiến trong sự nghiệp.'],
    ['n' => 'Sarah Smith', 'r' => 'CEO tại MNC', 'q' => 'Đảm nhận vai trò mới là CEO của công ty thật sự là một thách thức đối với tôi. Tôi chuyển đến một môi trường mới, nơi mọi thứ diễn ra trì trệ hơn so với kỳ vọng của tôi. Đôi lúc tôi cảm thấy cô đơn và kiệt sức nhưng Ngân đã giúp tôi củng cố kỹ năng lãnh đạo của mình, chỉ cho tôi cách để kết nối và dần dần thúc đẩy, truyền cảm hứng cho đội ngũ. Thực hành những kỹ năng lãnh đạo bằng EQ quả thật không phải điều dễ dàng, nhưng thật sự nó rất hiệu quả. Cảm ơn Ngân vì đã là một phần của hành trình trở thành một nhà lãnh đạo xuất sắc của tôi.'],
    ['n' => 'Peter Mayer', 'r' => 'Cựu CEO tại Tập đoàn khách sạn Lodgis, Cựu CEO Fusion Resorts & Hotels, Cựu CEO Sofitel Legend Metropole Hanoi, Cựu Phó Chủ tịch Bất động sản J.P Morgan Châu Á, MBA Harvard', 'q' => 'Điều tạo nên sự khác biệt giữa Quản lý và Nhà lãnh đạo thành công không phải là năng lực chuyên môn của họ mà là khả năng kết nối với mọi người. Hiển nhiên là các CEO thường có tư duy chiến lược và kỹ năng tài chính rất tốt. Nhưng chính kỹ năng EQ sắc bén của họ mới là yếu tố thúc đẩy đội ngũ của họ. Chương trình coaching cho lãnh đạo điều hành từ The New Leaders giúp phát triển và trau dồi khả năng thiết yếu này.'],
  ],
  'creds_h' => 'Về Ngân Trần',
  'creds_list' => ['Được đào tạo kỹ năng lãnh đạo tại trường Harvard Kennedy, Đại học Cornell và Đại học Oxford.', 'Huấn luyện viên được chứng nhận quốc tế, đào tạo và huấn luyện cho lãnh đạo trên 20 quốc gia.', 'Tốt nghiệp Huấn luyện đào tạo lãnh đạo cao cấp tại Đại học Harvard.', 'Có hơn 10 năm kinh nghiệm ở vị trí quản lý, lãnh đạo và nhà điều hành cao cấp trong các doanh nghiệp và tổ chức đa quốc gia, và công ty khởi nghiệp.', 'Nhà sáng lập và nhà điều hành The New Leaders, tổ chức giáo dục cung cấp các chương trình đào tạo kỹ năng lãnh đạo và trí tuệ cảm xúc dựa trên cấu trúc lãnh đạo từ các trường đại học nổi tiếng.'],
  'exp_h' => 'Một số các chủ đề phổ biến',
  'exp' => [
    ['t' => 'Kỹ năng giao tiếp bằng trí tuệ cảm xúc (EQ) cho lãnh đạo', 'b' => ['Giá trị cốt lõi của lãnh đạo', 'Làm chủ cảm xúc', 'Hiểu cảm xúc và hành vi của người khác', 'Kỹ năng khai vấn (coaching)', 'Quản lý xung đột', 'Đưa ra phản hồi mang tính xây dựng', 'Ứng xử hài hoà với những “bên liên quan” khó tính', 'Tạo mội trường an toàn trong team', 'Thuyết phục và truyền cảm hứng']],
    ['t' => 'Xây dựng niềm tin, củng cố sự kết nối và các mối quan hệ thông qua Trí tuệ Cảm xúc', 'b' => ['Xây dựng niềm tin với/trong đội ngũ của bạn', 'Tạo động lực cho bản thân và động lực cho đội ngũ', 'Kết nối đội ngũ', 'Tường thuật trước công chúng theo cấu trúc từ Harvard Kennedy School']],
    ['t' => 'Xây dựng thương hiệu cá nhân truyền cảm hứng dựa trên giá trị cốt lõi', 'b' => ['Khám phá phương pháp tiếp cận mới để xây dựng thương hiệu cá nhân truyền cảm hứng', 'Định hình các giá trị cốt lõi của bạn và xây dựng câu chuyện thương hiệu cá nhân chân thực', 'Lan tỏa thương hiệu cá nhân của bạn trong tổ chức', 'Tăng cường hiệu quả truyền tải thương hiệu cá nhân qua các nền tảng truyền thông xã hội']],
  ],
];
} else {
$P = [
  'hero_title' => '1:1 Leadership Executive Coaching with Ngan Tran',
  'creds' => ['CEO/Founder The New Leaders', 'Harvard, Oxford & Cornell Leadership Training, Certified Trainer', 'Executive Leadership Coaching - Mastery Training at Harvard'],
  'hero_cta' => "Let's go beyond the ordinary together",
  'intro_h' => 'Elevate Your Leadership Excellence with Expert Coaching',
  'intro_p' => ['Are you ready to refine your leadership skills and master the art of emotional intelligence?', 'As a seasoned executive with training from Harvard Kennedy School, Oxford University, and Cornell University, Ngan Tran specializes in empowering senior leaders like you to achieve unparalleled success.', 'Join a global network of top executives who have enhanced their leadership impact and inspired their organizations through personalized executive coaching.'],
  'intro_cta' => 'Click here to get started!',
  'incl_h' => "Let's work together!",
  'incl_lead' => "With Ngan Tran's 1-1 coaching session on",
  'incl' => ['EQ Leadership coaching for management levels', 'Executive coaching for executives', 'Personalized coaching program (3-month or 6-month program)', 'Leadership, EQ assessments & 360 assessments', 'Learning materials', 'Unlimited email support during the program', '3-month program (12 sessions get 1 session for free)', '6-month program (24 sessions get 2 sessions for free)', 'Can be combination of EQ leadership coaching & consultation.'],
  'blind_h' => 'Identify your blind spots in your current leadership',
  'blind_lead' => 'Ngan Tran will help you with:',
  'blind' => [
    ['t' => 'Assessing Your Current Leadership & Emotional Intelligence Levels:', 'd' => 'Understand where you stand and identify areas for growth.'],
    ['t' => 'Setting Up Your Leadership Goals:', 'd' => 'Define clear, achievable objectives tailored to your aspirations.'],
    ['t' => 'Creating a Strategic Plan:', 'd' => 'Develop a step-by-step roadmap to reach your leadership goals.'],
    ['t' => 'Navigating Urgent Leadership Challenges:', 'd' => 'Get expert advice and coaching to handle critical situations with confidence.'],
    ['t' => 'Ongoing Expert Guidance:', 'd' => 'Receive consistent support to build and reinforce new leadership and communication habits.'],
    ['t' => 'Accelerating Your Career & Business Growth:', 'd' => 'Enhance your leadership effectiveness, inspire your team, and make your professional and personal life more rewarding and enjoyable.'],
  ],
  'blind_foot' => 'Let Ms. Ngan support you in making it all happen!',
  'howto_h' => "Let's work together!",
  'howto' => ['Click “Reserve a spot” below', 'Fill out your needs and preferred time', 'Our team will contact you shortly after that'],
  'reserve' => 'Reserve a spot',
  'who_h' => 'Who should join my leadership coaching?',
  'who' => [
    ['t' => 'Experienced middle manager on the way to seniors', 'd' => 'Advanced your leadership skills to the next levels with emotional intelligence.'],
    ['t' => 'Senior Managers and Leaders', 'd' => 'Enhance your leadership effectiveness to get ready to move up to top levels by integrating emotional intelligence into your leadership style'],
    ['t' => 'CEOs and Start-up Founders', 'd' => 'Navigate critical business situations with confidence and lead your organization to success.'],
    ['t' => 'Executives and C-level Leaders', 'd' => 'Advance your leadership skills to drive your team and business in new, innovative directions.'],
  ],
  'tm_h' => 'What people are saying',
  'people' => [
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'The sessions from Ngan have helped me sharpen my skills as a leader of a multi-bill USD start-up to be able to motivate & inspire team members to take actions. This is also extremely helpful for me as a frequent public speaker and founder of an NGO.'],
    ['n' => 'Barry Weisblatt', 'r' => 'Head of Research Department at VNDIRECT Securities Corporation/ Former Head of Equity Markets & Securitization VinFast Global', 'q' => 'Ngan has really helped me to be a better leader. She is a great listener and draws upon a wealth of knowledge and experience to offer insightful, practical advice to guide me in facing problems and inspiring my team to perform and develop. After you have been in leading position for a while, it is easy to get complacent in the way you do things. Ngan has really helped me to gain new perspectives and continue improving in my career.'],
    ['n' => 'Sarah Smith', 'r' => 'CEO of MNC', 'q' => "Taking on a new role as CEO has been quite challenging. I moved to a new environment where it seems like people are moving slowly and lack motivation. Sometimes, I feel a clear sense of loneliness as a leader and experience burnout. Ngan has helped me strengthen my leadership skills, allowing me to connect with, gradually motivate, and inspire the team. It hasn't been easy, but I have experienced the power of effective leadership. I'm grateful to have her as part of my journey toward becoming a great leader."],
    ['n' => 'Peter Mayer', 'r' => 'Former CEO Lodgis Hospitality Holdings, Former CEO Fusion Resorts & Hotels, Former CEO Sofitel Legend Metropole Hanoi, Former VP Asian Head of Real estate J.P Morgan, MBA Harvard', 'q' => "What separates successful Leaders and Managers are not THEIR technical COMPETENCE, but the ability to connect to their people. Of course, CEO's often have great strategic thinking and financial skills, but it is their sharp EQ that drives their organizations. The executive coaching from The New Leaders develop and hone this essential capability."],
  ],
  'creds_h' => "Ngan Tran's credentials",
  'creds_list' => ['Harvard, Oxford & Cornell Leadership Training', 'Certified Trainer, training and coaching leaders in more than 20 countries', 'Executive Leadership Coaching Mastery Training at Harvard', 'Over 10 Years of Experience in management, leadership, and C-level positions in leading global organizations, businesses, and start-ups', 'Founder & CEO of The New Leaders, an educational organization providing leadership and EQ training for leaders from accredited universities'],
  'exp_h' => 'Let Ngan support you in her areas of expertise',
  'exp' => [
    ['t' => 'EQ Leadership Communication', 'b' => ['Leadership core values', 'Emotional management', "Understand others' emotions and behaviors", 'Coaching skills', 'Conflict management', 'Giving effective feedback', 'Dealing with difficult people', 'Psychological safety', 'Persuasion and Influence']],
    ['t' => 'Building trust and solidify team connection & relationships with Emotional Intelligence', 'b' => ['Building trust with/ within your team', 'Self-motivation and team motivation', 'Team connection', 'Public Narrative/ Leadership storytelling framework from Harvard']],
    ['t' => 'Building impactful personal brand based on personal core values', 'b' => ['Learn a new approach to inspirational personal brand', 'Identify your core values and build your authentic brand story', 'Communicate your personal brand inside your organization', 'Communicate your personal brand online on social media channels']],
  ],
];
}
$contact = tnl_url('contact');
?>
<main class="site-main page-coach">

  <section class="ec-hero section">
    <div class="container">
      <h1 class="ec-hero__title"><?php echo esc_html($P['hero_title']); ?></h1>
      <ul class="ec-hero__creds">
        <?php foreach ($P['creds'] as $c) : ?><li><?php echo esc_html($c); ?></li><?php endforeach; ?>
      </ul>
      <a href="<?php echo esc_url($contact); ?>" class="btn btn--primary ec-hero__cta"><?php echo esc_html($P['hero_cta']); ?></a>
    </div>
  </section>

  <div class="ec-banner">
    <div class="container">
      <figure class="ec-banner__fig"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/media/cards/business.jpg'); ?>" alt="<?php echo esc_attr($P['hero_title']); ?>" loading="eager"></figure>
    </div>
  </div>

  <section class="ec-intro section">
    <div class="container">
      <h2 class="ec-intro__h"><?php echo esc_html($P['intro_h']); ?></h2>
      <?php foreach ($P['intro_p'] as $p) : ?><p class="ec-intro__p"><?php echo esc_html($p); ?></p><?php endforeach; ?>
      <?php if (!empty($P['intro_cta'])) : ?><a href="<?php echo esc_url($contact); ?>" class="btn btn--primary"><?php echo esc_html($P['intro_cta']); ?></a><?php endif; ?>
    </div>
  </section>

  <section class="ec-incl section">
    <div class="container">
      <h2 class="ec-incl__h"><?php echo esc_html($P['incl_h']); ?></h2>
      <p class="ec-incl__lead"><?php echo esc_html($P['incl_lead']); ?></p>
      <ul class="ec-list">
        <?php foreach ($P['incl'] as $i) : ?><li><?php echo esc_html($i); ?></li><?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="ec-blind section">
    <div class="container">
      <h2 class="ec-blind__h"><?php echo esc_html($P['blind_h']); ?></h2>
      <p class="ec-blind__lead"><?php echo esc_html($P['blind_lead']); ?></p>
      <ol class="ec-steps">
        <?php foreach ($P['blind'] as $i => $s) : ?>
          <li class="ec-step"><span class="ec-step__num"><?php echo $i + 1; ?></span><div><h3><?php echo esc_html($s['t']); ?></h3><p><?php echo esc_html($s['d']); ?></p></div></li>
        <?php endforeach; ?>
      </ol>
      <p class="ec-blind__foot"><?php echo esc_html($P['blind_foot']); ?></p>
    </div>
  </section>

  <section class="pg-photobreak" aria-hidden="true">
    <figure class="pg-photobreak__fig"><img src="<?php echo esc_url(get_template_directory_uri() . '/assets/media/blog/workshop-ngan.jpg'); ?>" alt="" loading="lazy"></figure>
  </section>

  <section class="ec-howto section">
    <div class="container">
      <h2 class="ec-howto__h"><?php echo esc_html($P['howto_h']); ?></h2>
      <ol class="ec-howto__list">
        <?php foreach ($P['howto'] as $h) : ?><li><?php echo esc_html($h); ?></li><?php endforeach; ?>
      </ol>
      <a href="<?php echo esc_url($contact); ?>" class="btn btn--primary"><?php echo esc_html($P['reserve']); ?></a>
    </div>
  </section>

  <section class="ec-who section">
    <div class="container">
      <h2 class="ec-who__h"><?php echo esc_html($P['who_h']); ?></h2>
      <div class="ec-who__grid">
        <?php foreach ($P['who'] as $w) : ?>
          <div class="ec-who__card"><h3><?php echo esc_html($w['t']); ?></h3><p><?php echo esc_html($w['d']); ?></p></div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ec-tm section">
    <div class="container">
      <h2 class="ec-tm__h"><?php echo esc_html($P['tm_h']); ?></h2>
      <div class="ec-tm__grid">
        <?php $accent=['teal','green','orange','pink']; foreach ($P['people'] as $pi => $p) : $av = function_exists('tnl_avatar') ? tnl_avatar($p['n']) : ''; ?>
          <figure class="ec-quote"><blockquote><?php echo esc_html($p['q']); ?></blockquote><figcaption>
            <?php if ($av) : ?><span class="pg-quote__avatar"><img src="<?php echo esc_url($av); ?>" alt="<?php echo esc_attr($p['n']); ?>" loading="lazy"></span>
            <?php else : ?><span class="pg-quote__avatar pg-quote__avatar--initials pg-quote__avatar--<?php echo $accent[$pi%4]; ?>"><?php echo esc_html(tnl_initials($p['n'])); ?></span><?php endif; ?>
            <span class="ec-quote__meta"><span class="ec-quote__name"><?php echo esc_html($p['n']); ?></span><span class="ec-quote__role"><?php echo esc_html($p['r']); ?></span></span>
          </figcaption></figure>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="ec-creds section">
    <div class="container">
      <h2 class="ec-creds__h"><?php echo esc_html($P['creds_h']); ?></h2>
      <ul class="ec-list">
        <?php foreach ($P['creds_list'] as $c) : ?><li><?php echo esc_html($c); ?></li><?php endforeach; ?>
      </ul>
    </div>
  </section>

  <section class="ec-exp section">
    <div class="container">
      <h2 class="ec-exp__h"><?php echo esc_html($P['exp_h']); ?></h2>
      <div class="ec-exp__grid">
        <?php foreach ($P['exp'] as $i => $e) : ?>
          <div class="ec-exp__card">
            <span class="ec-exp__num"><?php printf('%02d', $i + 1); ?></span>
            <h3 class="ec-exp__title"><?php echo esc_html($e['t']); ?></h3>
            <ul><?php foreach ($e['b'] as $b) : ?><li><?php echo esc_html($b); ?></li><?php endforeach; ?></ul>
          </div>
        <?php endforeach; ?>
      </div>
      <a href="<?php echo esc_url($contact); ?>" class="btn btn--primary ec-exp__cta"><?php echo esc_html($P['reserve']); ?></a>
    </div>
  </section>

</main>
