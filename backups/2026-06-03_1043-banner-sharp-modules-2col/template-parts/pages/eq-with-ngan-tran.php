<?php
/** eq-with-ngan-tran — EQ Video gallery. Verbatim từ live (EN/VI). Video link tới kênh YouTube TNL. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$yt = 'https://youtube.com/@thenewleaders5553';

$journey_h = 'Hành trình lãnh đạo';
$insights_h = 'Watch our collection of one-minute EQ insights';
$tm_h = $vi ? 'Đánh giá của các nhà lãnh đạo về khoá học của chúng tôi' : 'Our leaders say about the experience';
$watch = $vi ? 'Xem trên YouTube' : 'Watch on YouTube';

$people = $vi ? [] : [
  ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'The sessions from Ngan have helped me sharpen my skills as a leader of a multi-bill USD start-up to be able to motivate & inspire team members to take actions. This is also extremely helpful for me as a frequent public speaker and founder of an NGO.'],
  ['n' => 'Hang Nguyen', 'r' => 'Marketing & Communication Manager, VinaCaptial Foundation', 'q' => 'Anyone, especially people working in the humanitarian field, should acquire these skills to improve the quality of their communication, leading to further accomplishments in their career.'],
  ['n' => 'Barry Weisblatt', 'r' => 'Head of Research Department at VNDIRECT Securities Corporation/ Former Head of Equity Markets & Securitization VinFast Global', 'q' => 'Ngan has really helped me to be a better leader. She is a great listener and draws upon a wealth of knowledge and experience to offer insightful, practical advice to guide me in facing problems and inspiring my team to perform and develop. After you have been in leading position for a while, it is easy to get complacent in the way you do things. Ngan has really helped me to gain new perspectives and continue improving in my career.'],
  ['n' => 'Kathy Le', 'r' => 'HR Consultant at Long Binh Company', 'q' => "Today's human resources are different from the past; they engage with us through understanding. At The New Leaders' workshop, I learned how to communicate in a way that makes those around me feel confident, safe, and understood, allowing them to be more open with me."],
];
$play = '<span class="vg-card__play" aria-hidden="true"><svg width="26" height="26" viewBox="0 0 24 24" fill="none"><path d="M8 5v14l11-7z" fill="currentColor"/></svg></span>';
?>
<main class="site-main page-vg">

  <section class="vg-sec section">
    <div class="container">
      <h1 class="vg-sec__title"><?php echo esc_html($journey_h); ?></h1>
      <div class="vg-grid">
        <?php for ($i = 0; $i < 3; $i++) : ?>
          <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener" class="vg-card vg-card--journey">
            <?php echo $play; // phpcs:ignore ?>
            <span class="vg-card__label"><?php echo $watch; ?></span>
          </a>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <section class="vg-sec vg-sec--alt section">
    <div class="container">
      <h2 class="vg-sec__title"><?php echo esc_html($insights_h); ?></h2>
      <div class="vg-grid vg-grid--small">
        <?php for ($i = 0; $i < 4; $i++) : ?>
          <a href="<?php echo esc_url($yt); ?>" target="_blank" rel="noopener" class="vg-card vg-card--short">
            <?php echo $play; // phpcs:ignore ?>
            <span class="vg-card__label"><?php echo $watch; ?></span>
          </a>
        <?php endfor; ?>
      </div>
    </div>
  </section>

  <?php if (!empty($people)) : ?>
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
  <?php endif; ?>

  <?php get_template_part('template-parts/home/partners'); ?>

</main>
