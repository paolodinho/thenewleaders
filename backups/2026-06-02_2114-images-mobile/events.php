<?php
/** Trang Sự kiện (Events) — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$T = [
  'title'   => 'Sự kiện',
  'sub'     => 'Khám phá và lan tỏa sức mạnh của EQ để tạo ra những thay đổi tích cực!',
  'cta'     => 'Khám phá ngay!',
  'prev_h'  => 'Sự kiện đã diễn ra',
  'prev_lead' => 'Khám phá các hoạt động của chúng tôi',
  'events'  => [
    'Tư duy phỏng vấn dành cho lãnh đạo hiện đại',
    'Giao tiếp hiệu quả để phát triển đội ngũ',
    'EmpowerHER - Enriching Communication with Grace',
    'TopCV Insights #36: Bond & Beyond: Lãnh đạo đội ngũ HR trong mùa dịch chuyển',
    'Who takes care of the people who lead people?',
    'EQ for Finance: Từ Lý Trí Đến Sức Ảnh Hưởng',
    'The True Well-being',
    'Leading with EQ: How HR can future-proof Finance Teams?',
    "How to 'Manipulate' Behavior for Good Using Emotional Intelligence (EQ)",
    'Wine & Why',
    'Emotional Intelligence Skills for Leading the New Generations',
    'Leading After Layoffs',
    'Event | Thriving in Vietnamese Leadership Culture',
    'The True Well-being',
    '[The New Leaders x Persolkelly] #COFFEE&CONNECT Series - Leading Effectively with Emotional Intelligence',
    '[Guest Speaker] Adapting and Thriving: A Leadership Journey in a Dynamic World',
    '[AmCham] Communicating with Impact: Telling your own Story',
    '[Workshop Training] - Bán hàng khách biệt nhờ Thông minh cảm xúc',
    '[Workshop Training] - Học làm "sếp": Trở nên tâm lý và hiệu quả nhờ EQ!',
    '[Workshop Training] - Lãnh đạo hiệu quả nhờ Thông minh cảm xúc',
    '[Online - The New Leaders x Medisetter] Enhancing Medical Services through Emotionally Intelligent Communication',
    '[Leaders Talk Series] - Leadership Storytelling for Startup Founders',
    '[Leaders Talk Series] - Inspiring Women: Câu chuyện của những người phụ nữ Việt Nam toàn cầu',
  ],
  'comm_h'    => 'Tham gia cộng đồng các nhà Lãnh Đạo "mới" của chúng tôi để cập nhật thông tin những sự kiện sắp tới!',
  'comm_desc' => 'Đây là cộng đồng trực tuyến của những người cùng chí hướng, giúp bạn xác định bước tiến tiếp theo và cung cấp sự hỗ trợ cần thiết để thực hiện điều đó.',
  'comm_cta'  => 'Tham gia ngay',
];
} else {
$T = [
  'title'   => 'EQ Leadership Events',
  'sub'     => 'Embrace and spread the power of EQ to create positive change!',
  'cta'     => 'Explore now!',
  'prev_h'  => 'Previous Events',
  'prev_lead' => 'Explore what we have been doing so far...',
  'events'  => [
    'The Strategic Interview: Seeing the Real Potential Behind the Professional Veneer',
    'Communication Excellence for High-Performing Teams',
    'EmpowerHER - Enriching Communication with Grace',
    'TopCV Insights #36: Bond & Beyond: Lãnh đạo đội ngũ HR trong mùa dịch chuyển',
    'Who takes care of the people who lead people?',
    'EQ for Finance: Từ Lý Trí Đến Sức Ảnh Hưởng',
    'The True Well-being',
    'Leading with EQ: How HR can future-proof Finance Teams?',
    "How to 'Manipulate' Behavior for Good Using Emotional Intelligence (EQ)",
    'Wine & Why',
    'Emotional Intelligence Skills for Leading the New Generations',
    'Leading After Layoffs',
    'Event | Thriving in Vietnamese Leadership Culture',
    'The True Well-being',
    '[The New Leaders x Persolkelly] #COFFEE&CONNECT Series - Leading Effectively with Emotional Intelligence',
    '[Guest Speaker] Adapting and Thriving: A Leadership Journey in a Dynamic World',
    '[AmCham] Communicating with Impact: Telling your own Story',
    '[Workshop Training] - Transform Your Sales Approach with Emotional Intelligence',
    '[Workshop Training] - Elevate your Leadership Skills through Emotional Intelligence',
    '[Workshop Training] - Master the Art of Leadership: Enhance Skills with Emotional Intelligence!',
    '[Online - The New Leaders x Medisetter] Enhancing Medical Services through Emotionally Intelligent Communication',
    '[Leaders Talk Series] - Leadership Storytelling for Startup Founders',
    '[Leaders Talk Series] - Inspiring Women: The Global [Stories of Vietnamese Women]',
  ],
  'comm_h'    => "Join our Leaders' Community to get the latest update of the upcoming events!",
  'comm_desc' => "This is thriving online community of likeminded peers who'll help you get clear on your next move and provide the support you need to make it happen.",
  'comm_cta'  => 'Join us now!',
];
}
?>
<main class="site-main page-events">

  <!-- Hero -->
  <section class="ev-hero section">
    <div class="container">
      <h1 class="ev-hero__title"><?php echo esc_html($T['title']); ?></h1>
      <p class="ev-hero__sub"><?php echo esc_html($T['sub']); ?></p>
      <span class="ev-hero__cta"><?php echo esc_html($T['cta']); ?></span>
    </div>
  </section>

  <!-- Previous events -->
  <section class="ev-list section" id="previous-events">
    <div class="container">
      <h2 class="ev-list__title"><?php echo esc_html($T['prev_h']); ?></h2>
      <p class="ev-list__lead"><?php echo esc_html($T['prev_lead']); ?></p>

      <div class="ev-grid">
        <?php foreach ($T['events'] as $ev) : ?>
          <a href="#" class="ev-card">
            <span class="ev-card__thumb" aria-hidden="true"></span>
            <span class="ev-card__title"><?php echo esc_html($ev); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Community CTA -->
  <section class="ev-community section">
    <div class="container ev-community__inner">
      <h2 class="ev-community__title"><?php echo esc_html($T['comm_h']); ?></h2>
      <p class="ev-community__desc"><?php echo esc_html($T['comm_desc']); ?></p>
      <a href="#" class="btn btn--outline ev-community__cta"><?php echo esc_html($T['comm_cta']); ?></a>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

</main>
