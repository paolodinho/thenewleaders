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
    'EmpowerHER – Nâng tầm giao tiếp bằng sự tinh tế',
    'TopCV Insights #36: Bond & Beyond: Lãnh đạo đội ngũ HR trong mùa dịch chuyển',
    'Ai chăm sóc cho những người đang dẫn dắt người khác?',
    'EQ for Finance: Từ Lý Trí Đến Sức Ảnh Hưởng',
    'Hạnh phúc đích thực',
    'Lãnh đạo bằng EQ: HR giúp đội ngũ Tài chính sẵn sàng cho tương lai như thế nào?',
    '"Dẫn dắt" hành vi theo hướng tích cực bằng Trí tuệ Cảm xúc (EQ)',
    'Wine & Why',
    'Kỹ năng Trí tuệ Cảm xúc để dẫn dắt thế hệ mới',
    'Lãnh đạo sau làn sóng cắt giảm nhân sự',
    'Sự kiện | Phát triển trong văn hóa lãnh đạo Việt Nam',
    'Hạnh phúc đích thực',
    '[The New Leaders x Persolkelly] Chuỗi #COFFEE&CONNECT – Lãnh đạo hiệu quả bằng Trí tuệ Cảm xúc',
    '[Khách mời] Thích nghi và Phát triển: Hành trình lãnh đạo trong một thế giới biến động',
    '[AmCham] Giao tiếp tạo ảnh hưởng: Kể câu chuyện của chính bạn',
    '[Workshop Training] - Bán hàng khách biệt nhờ Thông minh cảm xúc',
    '[Workshop Training] - Học làm "sếp": Trở nên tâm lý và hiệu quả nhờ EQ!',
    '[Workshop Training] - Lãnh đạo hiệu quả nhờ Thông minh cảm xúc',
    '[Online – The New Leaders x Medisetter] Nâng cao dịch vụ y tế qua giao tiếp bằng Trí tuệ Cảm xúc',
    '[Leaders Talk Series] – Nghệ thuật kể chuyện lãnh đạo cho nhà sáng lập startup',
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
$media = get_template_directory_uri() . '/assets/media/events/';
/* Ảnh sự kiện — thứ tự khớp danh sách events (index 4 "Who takes care" không có ảnh trên live) */
$event_imgs = [
    'banner1_cbb5d66449.jpg',
    'Artboard_2_copy_2a_abe44dc06d.png',
    'banner_landinpage_ae5d94680e.png',
    'Banner_FB_2400x1256_f7107b051b.png',
    '', // Who takes care of the people who lead people?
    'Brochure_WS_Women_1_5865264f4c.png',
    'Brochure_WS_Women_23aed5f1dd.png',
    'The_EQ_KV_128d813ebd.jpg',
    'Asset_33_bb28fa2e13.png',
    'WINE_and_WHY_4d5ae6c679.png',
    'Asset_2_2x_7bbc9ee6bc.png',
    'Asset_11_4x_100_a08694c229.jpg',
    'Scaling_beyond_border_2048_x_1152_px_d96d6082c5.jpg',
    'The_True_well_being8_b8aa14061e.jpg',
    '1_0e10e7b99f.png',
    'Adapting_and_Thriving_A_Leadership_Journey_in_a_Dynamic_World_9b3e90917f.jpg',
    '3_dc949a0399.png',
    '8_4da40ea32b.png',
    '10_d8995b9049.png',
    '4_6f686d8002.png',
    '9_a5efb9fc99.png',
    '7_8424e51c08.png',
    '6_3d5bd538dc.png',
];
/* Slug trang chi tiết (CPT event) — khớp thứ tự danh sách events */
$event_slugs = [
    'the-strategic-interview','giao-tiep-hieu-qua','empower-her-08-03-2026','bond-beyond-lanh-dao-doi-ngu-hr-trong-mua-dich-chuyen','who-takes-care-of-the-people-who-lead-people','eq-for-finance-tu-ly-tri-den-suc-anh-huong','the-true-well-being-2','leading-with-eq-how-hr-can-future-proof-finance-teams','manipulate-behavior-for-good-using-emotional-intelligence','wine-and-why','emotional-intelligence-for-leading-the-new-generations','leading-after-layoffs','thriving-in-vietnamese-leadership-culture','the-true-well-being-1','persolkelly-coffee-and-connect-series-leading-effectively-with-emotional-intelligence','guest-speaker-adapting-and-thriving-a-leadership-journey-in-a-dynamic-world-2','am-cham-communicating-with-impact-telling-your-own-story-1','transform-your-sales-approach-with-emotional-intelligence','elevate-your-leadership-skills-through-emotional-intelligence','master-the-art-of-leadership-enhance-skills-with-emotional-intelligence','medisetter-enhancing-medical-services-through-emotionally-intelligent-communication-2','leaders-talk-series-leadership-storytelling-startup-founders','leaders-talk-series-inspiring-women-the-global-stories-vietnamese-women',
];
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
        <?php foreach ($T['events'] as $i => $ev) :
          $img = !empty($event_imgs[$i]) ? $media . $event_imgs[$i] : '';
          $ev_href = !empty($event_slugs[$i]) ? home_url('/su-kien/' . $event_slugs[$i] . '/') : tnl_url('contact'); ?>
          <a href="<?php echo esc_url($ev_href); ?>" class="ev-card">
            <span class="ev-card__thumb<?php echo $img ? '' : ' ev-card__thumb--empty'; ?>">
              <?php if ($img) : ?>
                <img src="<?php echo esc_url($img); ?>" alt="<?php echo esc_attr($ev); ?>" loading="lazy">
              <?php endif; ?>
            </span>
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
      <a href="https://www.facebook.com/groups/eqleadershipvietnam" target="_blank" rel="noopener noreferrer" class="btn btn--outline ev-community__cta"><?php echo esc_html($T['comm_cta']); ?></a>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

</main>
