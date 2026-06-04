<?php
/** products/the-story-of-empathy — E-book "Chuyện về Thấu cảm" / "The Story of Empathy". Song ngữ EN/VI. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$cta_url = tnl_url('contact');

if ($vi) {
  $buy = 'Mua ngay';

  $hero_eyebrow = 'Chọn nói điều LỚN qua câu chuyện “nhỏ”';
  $hero_title   = 'Chuyện về Thấu cảm';
  $hero_desc    = 'Khi lật tới trang cuối cùng, bọn mình không hứa bạn sẽ thành chuyên gia thấu cảm, nhưng như mọi sự tài giỏi đều bắt đầu từ sự hiểu, bọn mình hi vọng bạn đã thấu hơn một chút, và cảm hơn nhiều chút với những người xung quanh.';

  $reclaim_h = 'Đã đến lúc “đòi lại” công bằng cho Thông minh cảm xúc (EQ)!';
  $reclaim = [
    ['tag' => "That's right!", 't' => 'Vì EQ lúc nào cũng chịu nhiều hiểu lầm…', 'p' => 'Vì mọi người chỉ nghĩ tới “cảm xúc” mà quên mất chữ “thông minh” trước đó.'],
    ['tag' => "That's right!", 't' => 'Vì EQ lúc nào cũng hiếm', 'p' => 'Vì cảm xúc cần nhường chỗ cho sự hiệu quả và năng suất làm việc.'],
    ['tag' => "That's right!", 't' => 'Vì EQ là về kết nối, cả “trong” lẫn “ngoài”', 'p' => 'Thông minh cảm xúc không chỉ để kết nối với người khác mà với chính mình nữa.'],
  ];
  $reclaim_outro = [
    '...Vậy nên, The New Leaders muốn chia sẻ thật nhiều câu chuyện hay về EQ để “đòi lại” công bằng cho bạn ấy. Bắt đầu bằng một câu chuyện nhỏ về Thấu cảm.',
    'Thấu cảm không còn là khái niệm xa lạ, nhưng thật lạ khi chưa ai viết đủ về kỹ năng con người này. Vậy nên bọn mình muốn viết, à không, kể về nó. Cuốn e-book này, như một câu chuyện, sẽ gồm những lời tâm sự, chêm thêm nhiều kiến thức mới mẻ về thấu cảm khi nhìn từ một lăng kính xen kẽ giữa hàn lâm và đời thường. Bạn cũng sẽ nhặt nhạnh nhiều bài tập và phương pháp đã được chứng minh bởi khoa học để nuôi dưỡng năng lực thấu cảm của bản thân. Khi lật tới trang cuối cùng, bọn mình không hứa bạn sẽ thành chuyên gia thấu cảm, nhưng như mọi sự tài giỏi đều bắt đầu từ sự hiểu, bọn mình hi vọng bạn đã thấu hơn một chút, và cảm hơn nhiều chút với những người xung quanh.',
  ];
  $reclaim_cta_line = 'Mời bạn đọc… Chuyện về Thấu cảm.';

  $special_h = 'Cuốn e-book này đặc biệt vì…';
  $special = [
    'Khác với sách giấy, bạn sẽ đắm mình trong tiếng nhạc du dương, những nét minh họa ngộ nghĩnh, những video đầy tính tương tác và cả những câu hỏi để chiêm nghiệm, suy ngẫm. Tất cả khi đang… đọc!',
    'Lối “kể chuyện” dí dỏm tạo cảm giác gần gũi, giúp bạn dễ tiếp thu kiến thức khó nhằn về thông minh cảm xúc và giữ sự hứng thú xuyên suốt cuốn e-book.',
    'Gói ghém xong kiến thức, bạn còn được tặng 2 công cụ EQ và những cách xử lý tình huống trong đời thường, hoặc trong công việc theo phong cách “thông minh cảm xúc”!',
  ];

  $forwho_h = 'Quyển sách này dành cho…';
  $forwho = [
    'Gửi những ai đang gặp khó khăn trong việc điều khiển cảm xúc của bản thân, muốn hiểu cảm cảm xúc và hành động của người đối diện.',
    'Gửi những ai đang muốn cải thiện, phát triển tinh thần và không khí làm việc của đội nhóm thông qua kết nối và sự thấu hiểu về cảm xúc.',
    'Gửi những ai đang muốn nâng cao kỹ năng giao tiếp của mình với những người xung quanh, để xây dựng những mối quan hệ tích cực và có ý nghĩa.',
  ];

  $about_h = 'Bọn mình là ai?';
  $about_p = [
    'The New Leaders là tổ chức giáo dục tiên phong tại Việt Nam mang đến chương trình đào tạo và huấn luyện Kỹ năng lãnh đạo bằng trí tuệ cảm xúc từ các trường đại học hàng đầu như Đại học Harvard Kennedy, Đại học Cornell và Đại học Oxford giúp thế hệ lãnh đạo mới ở Việt Nam có thể truyền cảm hứng, dẫn dắt đội ngũ hiệu quả hơn, và tạo ảnh hưởng tích cực tới doanh nghiệp và cộng đồng.',
    'Theo dõi The New Leaders Network để nhận được những thông tin lý thú về EQ hàng ngày để phát triển khả năng lãnh đạo dựa trên EQ nhé!',
  ];

  $close_h = 'Đăng ký ngay ebook Chuyện về Thấu cảm để cùng The New Leaders rèn luyện kỹ năng thấu hiểu và cảm thông với những người xung quanh!';
  $notes = [
    'Lưu ý: Sau khi thanh toán thành công sản phẩm Ebook "Chuyện về thấu cảm", vui lòng để lại thông tin về email của bạn, chúng tôi sẽ gửi link truy cập vào nền tảng lưu trư E-book của chúng tôi đến email của bạn.',
    'Thời gian kích hoạt email truy cập Ebook trong vòng 2 - 4 giờ sau khi chúng tôi xác nhận đơn hàng',
    'Vui lòng liên hệ đến chúng tôi nếu bạn chưa nhận được E-book qua email sau 24 giờ đơn hàng đã được xác nhận.',
  ];
} else {
  $buy = 'Buy now';

  $hero_eyebrow = 'Choosing to say something BIG through a “small” story';
  $hero_title   = 'The Story of Empathy';
  $hero_desc    = 'By the time you turn the final page, we won’t promise you’ll become an empathy expert — but just as every kind of greatness begins with understanding, we hope you’ll feel a little more understanding, and a lot more compassion, toward the people around you.';

  $reclaim_h = 'It’s time to “reclaim” fairness for Emotional Intelligence (EQ)!';
  $reclaim = [
    ['tag' => "That's right!", 't' => 'Because EQ is always misunderstood…', 'p' => 'Because people only think of the “emotional” part and forget the “intelligence” that comes before it.'],
    ['tag' => "That's right!", 't' => 'Because EQ is always in short supply', 'p' => 'Because emotions are made to step aside for efficiency and productivity at work.'],
    ['tag' => "That's right!", 't' => 'Because EQ is about connection — both “within” and “without”', 'p' => 'Emotional intelligence isn’t only about connecting with others, but with yourself too.'],
  ];
  $reclaim_outro = [
    '...That’s why The New Leaders wants to share plenty of wonderful stories about EQ to “reclaim” fairness for it — starting with a little story about Empathy.',
    'Empathy is no longer an unfamiliar concept, yet strangely enough no one has written enough about this very human skill. So we wanted to write — no, to tell a story about it. This e-book, like a story, brings together heartfelt reflections woven with fresh insights on empathy, seen through a lens that moves between the academic and the everyday. Along the way you’ll gather plenty of exercises and scientifically proven methods to nurture your own capacity for empathy. By the time you turn the final page, we won’t promise you’ll become an empathy expert — but just as every kind of greatness begins with understanding, we hope you’ll feel a little more understanding, and a lot more compassion, toward the people around you.',
  ];
  $reclaim_cta_line = 'We invite you to read… The Story of Empathy.';

  $special_h = 'This e-book is special because…';
  $special = [
    'Unlike a printed book, you’ll be immersed in soothing music, playful illustrations, interactive videos, and questions that invite you to pause, reflect, and ponder — all while you’re… reading!',
    'Its witty “storytelling” style feels warm and close, making the tough concepts of emotional intelligence easy to absorb and keeping you engaged throughout the e-book.',
    'Once you’ve wrapped up the knowledge, you’ll also receive 2 EQ tools and ways to handle everyday and workplace situations in true “emotionally intelligent” style!',
  ];

  $forwho_h = 'This book is for…';
  $forwho = [
    'For those who struggle to manage their own emotions and want to understand the feelings and actions of the people in front of them.',
    'For those who want to improve and nurture the spirit and atmosphere of their team through connection and emotional understanding.',
    'For those who want to elevate the way they communicate with the people around them, in order to build positive and meaningful relationships.',
  ];

  $about_h = 'Who are we?';
  $about_p = [
    'The New Leaders is a pioneering educational organization in Vietnam, delivering training and coaching programs in Emotionally Intelligent Leadership drawn from leading universities such as Harvard Kennedy, Cornell, and Oxford — helping Vietnam’s new generation of leaders inspire others, lead their teams more effectively, and create a positive impact on businesses and communities.',
    'Follow The New Leaders Network to receive fascinating daily insights about EQ and grow your EQ-based leadership!',
  ];

  $close_h = 'Sign up for The Story of Empathy e-book today and train your ability to understand and empathize with the people around you, together with The New Leaders!';
  $notes = [
    'Note: After successfully purchasing the “The Story of Empathy” e-book, please leave your email address so we can send the access link to our e-book platform to your inbox.',
    'The e-book access email is activated within 2–4 hours after we confirm your order.',
    'Please contact us if you have not received the e-book by email within 24 hours after your order has been confirmed.',
  ];
}
?>
<main class="site-main page-se">

  <section class="se-hero section">
    <div class="container">
      <p class="se-hero__eyebrow"><?php echo esc_html($hero_eyebrow); ?></p>
      <h1 class="se-hero__title"><?php echo esc_html($hero_title); ?></h1>
      <p class="se-hero__desc"><?php echo esc_html($hero_desc); ?></p>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="se-reclaim section">
    <div class="container">
      <h2 class="se-reclaim__h"><?php echo esc_html($reclaim_h); ?></h2>
      <div class="se-reclaim__grid">
        <?php foreach ($reclaim as $r) : ?>
          <div class="se-rc"><span class="se-rc__tag"><?php echo esc_html($r['tag']); ?></span><h3><?php echo esc_html($r['t']); ?></h3><p><?php echo esc_html($r['p']); ?></p></div>
        <?php endforeach; ?>
      </div>
      <div class="se-reclaim__outro">
        <?php foreach ($reclaim_outro as $ro) : ?><p><?php echo esc_html($ro); ?></p><?php endforeach; ?>
        <p class="se-reclaim__cta-line"><?php echo esc_html($reclaim_cta_line); ?></p>
      </div>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="se-special section">
    <div class="container">
      <h2 class="se-special__h"><?php echo esc_html($special_h); ?></h2>
      <div class="se-special__grid">
        <?php foreach ($special as $s) : ?><p class="se-special__p"><?php echo esc_html($s); ?></p><?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="se-forwho section">
    <div class="container">
      <h2 class="se-forwho__h"><?php echo esc_html($forwho_h); ?></h2>
      <ul class="ec-list">
        <?php foreach ($forwho as $f) : ?><li><?php echo esc_html($f); ?></li><?php endforeach; ?>
      </ul>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary se-forwho__cta"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="se-about section">
    <div class="container">
      <h2 class="se-about__h"><?php echo esc_html($about_h); ?></h2>
      <?php foreach ($about_p as $ap) : ?><p class="se-about__p"><?php echo esc_html($ap); ?></p><?php endforeach; ?>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

  <section class="se-close section">
    <div class="container">
      <h2 class="se-close__h"><?php echo esc_html($close_h); ?></h2>
      <div class="se-close__notes">
        <?php foreach ($notes as $n) : ?><p><?php echo esc_html($n); ?></p><?php endforeach; ?>
      </div>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

</main>
