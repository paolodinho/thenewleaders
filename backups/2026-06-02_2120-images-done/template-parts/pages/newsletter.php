<?php
/** Trang Newsletter — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

$T = $vi ? [
    'title'    => 'Nâng cao kỹ năng Lãnh đạo &amp; Giao tiếp của bạn chỉ với 5 phút mỗi tuần!',
    'sub'      => 'Mở khóa bí quyết giao tiếp hiệu quả với các mẹo và chiến lược được hơn 250.000 CEO, nhà sáng lập và lãnh đạo sử dụng hàng ngày để vượt qua các rào cản và giải phóng tiềm năng bên trong mỗi cá nhân!',
    'cta'      => 'Đăng ký ngay!',
    'tags_eyebrow' => 'Lãnh đạo EQ',
    'tags_intro'   => 'Bộ sưu tập các bí kíp về giao tiếp hữu ích:',
    'tags'     => ['Giao tiếp với các bên liên quan "khó tính"', 'Xây dựng lòng tin', 'Sự thấu cảm', 'Lắng nghe tích cực', 'Giải quyết xung đột', 'Trao quyền, uỷ thác', 'Các loại tư duy', 'Xây dựng tâm lý an toàn trong đội ngũ', 'Nhận xét khiến người khác muốn lắng nghe'],
    'about_eyebrow' => 'Về',
    'about_brand'   => 'The New Leaders',
    'about_p'  => [
        'The New Leaders là tổ chức giáo dục tiên phong cung cấp chương trình đào tạo kỹ năng lãnh đạo bằng trí tuệ cảm xúc (EQ) thiết kế dựa trên cấu trúc các chương trình đào tạo lãnh đạo danh tiếng thế giới từ trường Harvard Kennedy và Đại học Oxford tới Việt Nam.',
        'Các chương trình của The New Leaders được xây dựng theo phương pháp tiếp cận dựa trên tình huống thực tế của doanh nghiệp, mang tính thực hành và ứng dụng cao cùng với các chương trình sau đào tạo để tạo ra các tác động dài hạn có thể đo lường được cho doanh nghiệp.',
        'Mang trong mình sứ mệnh hỗ trợ các nhà lãnh đạo và các thành viên trong đội ngũ của họ nâng cao kỹ năng lãnh đạo & giao tiếp bằng Trí tuệ cảm xúc (EQ) để vươn tầm quốc tế, The New Leaders luôn tiên phong trong các cách tiếp cận và giải pháp đào tạo mới giúp doanh nghiệp tiết kiệm chi phí và tăng hiệu suất tối đa về con người, tạo môi trường làm việc tích cực và sẵn sàng cho sự đổi mới và bứt phá.',
    ],
    'form_lead' => 'Tham gia cùng hơn 250.000 CEO, nhà sáng lập và lãnh đạo để vượt qua các rào cản và giải phóng tiềm năng bên trong cá nhân!',
    'name'     => 'Tên của bạn:',
    'email'    => 'Email của bạn:',
    'submit'   => 'Gửi',
] : [
    'title'    => 'Elevate your Leadership &amp; Communication skills with just 5 minutes weekly!',
    'sub'      => 'Unlock the secrets to effective communication with tips and strategies used daily by over 250,000 CEOs, founders, and leaders to break through barriers and unleash your inner potential!',
    'cta'      => 'Subscribe now!',
    'tags_eyebrow' => 'Emotional Intelligence Leadership',
    'tags_intro'   => 'A collection of actionable skills tips & tricks:',
    'tags'     => ['Giving Feedback', 'Build psychological safety in team', 'Mindsets', 'Conflict resolution', 'Active listening', 'Build trust', 'Empathy', 'Delegation', 'Dealing with difficult people'],
    'about_eyebrow' => 'About',
    'about_brand'   => 'The New Leaders',
    'about_p'  => [
        'The New Leaders is a pioneering organization that brings leadership training programs on emotional intelligence (EQ) leadership from top leadership institutes of Harvard University and Oxford University to Vietnam. Our programs are built on a scenario-based approach, combined with interactive discussion activities with two main programs: customized training for businesses and personalized 1-1 coaching.',
        'With the mission to advance EQ Leadership & Communication skills to a world-class standard for leaders and their team members, The New Leaders constantly strives for improvement and become a driver of changes.',
    ],
    'form_lead' => 'Join over 250,000 CEOs, founders, and leaders to break through barriers and unleash your inner potential!',
    'name'     => 'Your name:',
    'email'    => 'Your email:',
    'submit'   => 'Submit',
];

$tag_mods = ['teal', 'green', 'orange', 'pink'];
?>
<main class="site-main page-newsletter">

  <!-- Hero -->
  <section class="nl-hero section">
    <div class="container">
      <h1 class="nl-hero__title"><?php echo $T['title']; ?></h1>
      <p class="nl-hero__sub"><?php echo esc_html($T['sub']); ?></p>
      <span class="nl-hero__cta"><?php echo esc_html($T['cta']); ?></span>
    </div>
  </section>

  <!-- Body: skills + about | form -->
  <section class="nl-body section">
    <div class="container nl-body__grid">

      <div class="nl-body__main">
        <p class="nl-eyebrow"><?php echo esc_html($T['tags_eyebrow']); ?></p>
        <p class="nl-body__intro"><?php echo esc_html($T['tags_intro']); ?></p>
        <div class="nl-tags">
          <?php foreach ($T['tags'] as $i => $tag) : ?>
            <span class="nl-tag nl-tag--<?php echo $tag_mods[$i % count($tag_mods)]; ?>"><?php echo esc_html($tag); ?></span>
          <?php endforeach; ?>
        </div>
      </div>

      <aside class="nl-form-card">
        <p class="nl-form-card__lead"><?php echo esc_html($T['form_lead']); ?></p>
        <form class="nl-form" method="post" action="#" novalidate>
          <div class="nl-field">
            <label for="nl-name"><?php echo esc_html($T['name']); ?></label>
            <input type="text" id="nl-name" name="name">
          </div>
          <div class="nl-field">
            <label for="nl-email"><?php echo esc_html($T['email']); ?></label>
            <input type="email" id="nl-email" name="email">
          </div>
          <button type="submit" class="btn btn--primary nl-form__submit"><?php echo esc_html($T['submit']); ?></button>
        </form>
      </aside>

    </div>
  </section>

  <!-- About The New Leaders -->
  <section class="nl-about-sec section">
    <div class="container">
      <p class="nl-eyebrow"><?php echo esc_html($T['about_eyebrow']); ?></p>
      <h2 class="nl-about__brand"><?php echo esc_html($T['about_brand']); ?></h2>
      <div class="nl-about__cols">
        <?php foreach ($T['about_p'] as $p) : ?>
          <p class="nl-about__p"><?php echo esc_html($p); ?></p>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

</main>
