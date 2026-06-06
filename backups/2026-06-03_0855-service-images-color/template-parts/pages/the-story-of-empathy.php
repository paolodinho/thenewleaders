<?php
/** products/the-story-of-empathy — E-book "Chuyện về Thấu cảm". Nội dung tiếng Việt (live giống nhau cả EN/VI). */
$cta_url = tnl_url('contact');
$buy = 'Mua ngay';
$reclaim = [
  ['tag' => "That's right!", 't' => 'Vì EQ lúc nào cũng chịu nhiều hiểu lầm…', 'p' => 'Vì mọi người chỉ nghĩ tới “cảm xúc” mà quên mất chữ “thông minh” trước đó.'],
  ['tag' => "That's right!", 't' => 'Vì EQ lúc nào cũng hiếm', 'p' => 'Vì cảm xúc cần nhường chỗ cho sự hiệu quả và năng suất làm việc.'],
  ['tag' => "That's right!", 't' => 'Vì EQ là về kết nối, cả “trong” lẫn “ngoài”', 'p' => 'Thông minh cảm xúc không chỉ để kết nối với người khác mà với chính mình nữa.'],
];
$special = [
  'Khác với sách giấy, bạn sẽ đắm mình trong tiếng nhạc du dương, những nét minh họa ngộ nghĩnh, những video đầy tính tương tác và cả những câu hỏi để chiêm nghiệm, suy ngẫm. Tất cả khi đang… đọc!',
  'Lối “kể chuyện” dí dỏm tạo cảm giác gần gũi, giúp bạn dễ tiếp thu kiến thức khó nhằn về thông minh cảm xúc và giữ sự hứng thú xuyên suốt cuốn e-book.',
  'Gói ghém xong kiến thức, bạn còn được tặng 2 công cụ EQ và những cách xử lý tình huống trong đời thường, hoặc trong công việc theo phong cách “thông minh cảm xúc”!',
];
$forwho = [
  'Gửi những ai đang gặp khó khăn trong việc điều khiển cảm xúc của bản thân, muốn hiểu cảm cảm xúc và hành động của người đối diện.',
  'Gửi những ai đang muốn cải thiện, phát triển tinh thần và không khí làm việc của đội nhóm thông qua kết nối và sự thấu hiểu về cảm xúc.',
  'Gửi những ai đang muốn nâng cao kỹ năng giao tiếp của mình với những người xung quanh, để xây dựng những mối quan hệ tích cực và có ý nghĩa.',
];
$notes = [
  'Lưu ý: Sau khi thanh toán thành công sản phẩm Ebook "Chuyện về thấu cảm", vui lòng để lại thông tin về email của bạn, chúng tôi sẽ gửi link truy cập vào nền tảng lưu trư E-book của chúng tôi đến email của bạn.',
  'Thời gian kích hoạt email truy cập Ebook trong vòng 2 - 4 giờ sau khi chúng tôi xác nhận đơn hàng',
  'Vui lòng liên hệ đến chúng tôi nếu bạn chưa nhận được E-book qua email sau 24 giờ đơn hàng đã được xác nhận.',
];
?>
<main class="site-main page-se">

  <section class="se-hero section">
    <div class="container">
      <p class="se-hero__eyebrow">Chọn nói điều LỚN qua câu chuyện “nhỏ”</p>
      <h1 class="se-hero__title">Chuyện về Thấu cảm</h1>
      <p class="se-hero__desc">Khi lật tới trang cuối cùng, bọn mình không hứa bạn sẽ thành chuyên gia thấu cảm, nhưng như mọi sự tài giỏi đều bắt đầu từ sự hiểu, bọn mình hi vọng bạn đã thấu hơn một chút, và cảm hơn nhiều chút với những người xung quanh.</p>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="se-reclaim section">
    <div class="container">
      <h2 class="se-reclaim__h">Đã đến lúc “đòi lại” công bằng cho Thông minh cảm xúc (EQ)!</h2>
      <div class="se-reclaim__grid">
        <?php foreach ($reclaim as $r) : ?>
          <div class="se-rc"><span class="se-rc__tag"><?php echo esc_html($r['tag']); ?></span><h3><?php echo esc_html($r['t']); ?></h3><p><?php echo esc_html($r['p']); ?></p></div>
        <?php endforeach; ?>
      </div>
      <div class="se-reclaim__outro">
        <p>...Vậy nên, The New Leaders muốn chia sẻ thật nhiều câu chuyện hay về EQ để “đòi lại” công bằng cho bạn ấy. Bắt đầu bằng một câu chuyện nhỏ về Thấu cảm.</p>
        <p>Thấu cảm không còn là khái niệm xa lạ, nhưng thật lạ khi chưa ai viết đủ về kỹ năng con người này. Vậy nên bọn mình muốn viết, à không, kể về nó. Cuốn e-book này, như một câu chuyện, sẽ gồm những lời tâm sự, chêm thêm nhiều kiến thức mới mẻ về thấu cảm khi nhìn từ một lăng kính xen kẽ giữa hàn lâm và đời thường. Bạn cũng sẽ nhặt nhạnh nhiều bài tập và phương pháp đã được chứng minh bởi khoa học để nuôi dưỡng năng lực thấu cảm của bản thân. Khi lật tới trang cuối cùng, bọn mình không hứa bạn sẽ thành chuyên gia thấu cảm, nhưng như mọi sự tài giỏi đều bắt đầu từ sự hiểu, bọn mình hi vọng bạn đã thấu hơn một chút, và cảm hơn nhiều chút với những người xung quanh.</p>
        <p class="se-reclaim__cta-line">Mời bạn đọc… Chuyện về Thấu cảm.</p>
      </div>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="se-special section">
    <div class="container">
      <h2 class="se-special__h">Cuốn e-book này đặc biệt vì…</h2>
      <div class="se-special__grid">
        <?php foreach ($special as $s) : ?><p class="se-special__p"><?php echo esc_html($s); ?></p><?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="se-forwho section">
    <div class="container">
      <h2 class="se-forwho__h">Quyển sách này dành cho…</h2>
      <ul class="ec-list">
        <?php foreach ($forwho as $f) : ?><li><?php echo esc_html($f); ?></li><?php endforeach; ?>
      </ul>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary se-forwho__cta"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

  <section class="se-about section">
    <div class="container">
      <h2 class="se-about__h">Bọn mình là ai?</h2>
      <p class="se-about__p">The New Leaders là tổ chức giáo dục tiên phong tại Việt Nam mang đến chương trình đào tạo và huấn luyện Kỹ năng lãnh đạo bằng trí tuệ cảm xúc từ các trường đại học hàng đầu như Đại học Harvard Kennedy, Đại học Cornell và Đại học Oxford giúp thế hệ lãnh đạo mới ở Việt Nam có thể truyền cảm hứng, dẫn dắt đội ngũ hiệu quả hơn, và tạo ảnh hưởng tích cực tới doanh nghiệp và cộng đồng.</p>
      <p class="se-about__p">Theo dõi The New Leaders Network để nhận được những thông tin lý thú về EQ hàng ngày để phát triển khả năng lãnh đạo dựa trên EQ nhé!</p>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

  <section class="se-close section">
    <div class="container">
      <h2 class="se-close__h">Đăng ký ngay ebook Chuyện về Thấu cảm để cùng The New Leaders rèn luyện kỹ năng thấu hiểu và cảm thông với những người xung quanh!</h2>
      <div class="se-close__notes">
        <?php foreach ($notes as $n) : ?><p><?php echo esc_html($n); ?></p><?php endforeach; ?>
      </div>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary"><?php echo esc_html($buy); ?></a>
    </div>
  </section>

</main>
