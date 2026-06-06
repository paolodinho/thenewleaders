<?php
/** Trang Tuyển dụng — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

$title   = 'Shape the Future With Us';
$sub     = "Join our pioneering team, where you don't just work, but train and develop yourself every day, creating meaningful value for the community.";
$cta     = $vi ? 'Khám phá ngay!' : 'Explore now!';
$openings_h = 'Current Openings';
$openings_lead = 'Find the role that lets you grow and make an impact.';
$date_label = $vi ? 'Ngày:' : 'Date:';

$jobs = [
    ['t' => 'Telesales Representatives', 'd' => '5/18/2026'],
    ['t' => 'Learning & Development Executive', 'd' => '4/1/2026'],
    ['t' => 'Senior Business Development Executive', 'd' => '3/16/2026'],
    ['t' => 'Social & Brand Manager', 'd' => '1/27/2026'],
    ['t' => 'Leadership Trainer/Coach/Speaker (C-Level or Senior Executive)', 'd' => '11/29/2025'],
    ['t' => 'Product Owner', 'd' => '11/9/2025'],
    ['t' => 'Business Development Manager', 'd' => '10/30/2025'],
];
?>
<main class="site-main page-careers">

  <!-- Hero -->
  <section class="careers-hero section">
    <div class="container">
      <h1 class="careers-hero__title"><?php echo esc_html($title); ?></h1>
      <p class="careers-hero__sub"><?php echo esc_html($sub); ?></p>
      <span class="careers-hero__cta"><?php echo esc_html($cta); ?></span>
    </div>
  </section>

  <!-- Openings -->
  <section class="careers-list section">
    <div class="container">
      <h2 class="careers-list__title"><?php echo esc_html($openings_h); ?></h2>
      <p class="careers-list__lead"><?php echo esc_html($openings_lead); ?></p>

      <ul class="careers-jobs">
        <?php foreach ($jobs as $job) : ?>
          <li class="job-card">
            <a href="#" class="job-card__link">
              <span class="job-card__title"><?php echo esc_html($job['t']); ?></span>
              <span class="job-card__date"><?php echo esc_html($date_label . ' ' . $job['d']); ?></span>
              <span class="job-card__arrow" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"><path d="M5 12h14M13 6l6 6-6 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
              </span>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

</main>
