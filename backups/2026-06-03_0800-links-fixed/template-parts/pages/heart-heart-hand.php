<?php
/** products/heart-heart-hand — EQ guidebook "Head, Heart, Hand". Verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$img = get_template_directory_uri() . '/assets/media/products/book_1_be02c24501.png';
$cta_url = tnl_url('contact');

if ($vi) {
$P = [
  'tagline' => 'Mô hình lãnh đạo thành công với Trí tuệ Cảm xúc (EQ) từ các trường đại học hàng đầu thế giới!',
  'buy' => 'Đặt mua',
  'why_h' => 'Tại sao kỹ năng lãnh đạo Trí tuệ Cảm xúc lại quan trọng đến vậy đối với các nhà lãnh đạo?',
  'stats' => [
    ['sub' => 'Tăng cường nỗ lực làm việc của nhân viên lên', 'pct' => '57%', 'p' => 'Theo Forbes (2024), khả năng lãnh đạo bằng trí tuệ cảm xúc đóng vai trò quan trọng trong thành công của doanh nghiệp, giúp nâng cao tỷ lệ thành công lên đáng kể trong năm đầu tiên. Ngoài ra, việc tập trung vào sự tương tác và gắn kết với đội ngũ có thể giúp tăng cường nỗ lực làm việc của nhân viên lên 57% và hiệu suất cá nhân lên 20%.'],
    ['sub' => 'Mức độ gắn kết với công ty tăng lên', 'pct' => '76%', 'p' => 'Theo Catalyst (2021), nhân viên được lãnh đạo đồng cảm có mức độ gắn kết với công ty tăng lên đáng kể đến 76% và khả năng sáng tạo cũng tăng lên 61%, tạo ra hiệu suất cao hơn trong công việc.'],
    ['sub' => 'Dẫn dắt team vượt trội hơn', 'pct' => '40%', 'p' => 'Trường Kinh doanh Harvard (2019) đã chứng minh rằng các nhà lãnh đạo có kỹ năng EQ dẫn dắt team vượt trội hơn 40% so với các đồng nghiệp trong việc huấn luyện, ra quyết định và giao tiếp.'],
  ],
  'unlock_h' => 'Phát huy tiềm năng lãnh đạo của bạn với "Head, Heart, Hand"!',
  'unlock_lead' => 'Đây là lý do tại sao "Head, Heart, Hand" cần thiết đối với những người quản lý cấp cao như bạn:',
  'unlock' => ['Tiếp cận thông tin chi tiết với các mô hình, cấu trúc được lựa chọn từ các chương trình hàng đầu trên thế giới, như Harvard Kennedy School và Đại học Oxford.', 'Được truyền cảm hứng từ những hình ảnh trực quan hấp dẫn và các ví dụ thực tế, giúp đơn giản hóa các khái niệm phức tạp để dễ tiếp thu.', 'Các bài tập thực hành giúp bạn áp dụng những kỹ năng mới vào thực tế, cả trong công việc và cuộc sống hàng ngày.'],
  'topics_h' => 'Khám phá 9 chủ đề quan trọng về Lãnh đạo Trí tuệ Cảm xúc, được lựa chọn kỹ lưỡng và chia thành 3 bộ sưu tập chính.',
  'topics_lead' => 'Mỗi bộ thẻ bao gồm các mô hình, cấu trúc, ví dụ thực tế và hình ảnh trực quan hấp dẫn để đơn giản hóa các khái niệm phức tạp, đảm bảo dễ hiểu và dễ nhớ:',
  'collections' => [
    ['label' => 'Bộ sưu tập 01', 'items' => ['Quản lý cảm xúc: Đón nhận cảm xúc, đặc biệt là những cảm xúc tiêu cực.', 'Giải quyết xung đột: Mâu thuẫn không phải lúc nào cũng là xấu!', 'Tư duy phát triển: Thay đổi tư duy, góc nghĩ để phát triển bản thân.']],
    ['label' => 'Bộ sưu tập 02', 'items' => ['Giao tiếp nhóm hiệu quả: Đưa ra ý kiến khiến người khác muốn lắng nghe.', 'Đàm phán: Tạo điều kiện thuận lợi cho thỏa thuận cùng thắng và lợi ích đôi bên.', 'Nguyên tắc cơ bản về EQ: Trí tuệ cảm xúc không chỉ là việc tỏ ra tử tế!']],
    ['label' => 'Bộ sưu tập 03', 'items' => ['Trao quyền: Chọn thời điểm và người phù hợp để trao quyền.', 'Kiên tâm: Vững vàng đối mặt với thử thách', 'Thấu cảm và lắng nghe có chủ đích: Xây dựng kết nối ý nghĩa bằng cách thấu cảm với người khác.']],
  ],
  'empower_h' => 'Cuốn cẩm nang này có thể tiếp thêm sức mạnh cho các nhà lãnh đạo như thế nào?',
  'empower' => ['Các mô hình, ví dụ và hình ảnh sáng tạo sẽ giúp bạn nâng cao hiểu biết và kỹ năng thực tiễn cho cả công việc và cuộc sống.', 'Thực hành với những bài tập sáng tạo sẽ giúp củng cố việc học và biến nó thành một phần thói quen hàng ngày của bạn.', 'Duy trì nguồn động lực bằng những câu trích dẫn và hình ảnh đầy cảm hứng, giúp bạn tập trung vào hành trình phát triển của mình.'],
  'tm' => ['n' => 'Duyen Nguyen', 'q' => 'Bộ notebook này thực sự là một công cụ tuyệt vời cho việc phát triển EQ trong công việc. Các framework và model được trình bày rõ ràng, dễ hiểu, giúp tôi và đội ngũ của mình cải thiện kỹ năng giao tiếp và quản lý xung đột hiệu quả hơn.'],
  'faq_h' => 'Câu hỏi thường gặp',
  'faq_lead' => 'Bạn còn lăn tăn về các sản phẩm của The New Leaders? Hãy để chúng mình giải đáp cho nhé!',
  'faq' => [
    ['q' => 'The New Leaders là ai?', 'paras' => ['The New Leaders là tổ chức giáo dục tiên phong mang các chương trình đào tạo lãnh đạo bằng Trí tuệ Cảm xúc (EQ) từ Đại học Harvard và Đại học Oxford tới Việt Nam.']],
    ['q' => 'Các sản phẩm của The New Leaders được thiết kế dựa trên nghiên cứu khoa học nào?', 'bullets' => ['Cấu trúc về kỹ năng giao tiếp lãnh đạo của Harvard Kennedy School.', 'Giao tiếp bằng thông minh cảm xúc (EQ) của Harvard Business Review.', 'Các nghiên cứu về gia tăng sự gắn kết và mức độ thân thiết của các mối quan hệ trên các tạp chí khoa học: eNeuro, Personality and Social Psychology Bulletin, Journal of Marriage and Family, etc.']],
  ],
];
} else {
$P = [
  'tagline' => "Elevate your leadership with the EQ model from the world’s top universities!",
  'buy' => 'Purchase now!',
  'why_h' => 'Why is Emotional Intelligence leadership so important for leaders?',
  'stats' => [
    ['sub' => 'Boost employee work effort', 'pct' => '57%', 'p' => 'According to Forbes (2024), Emotional Intelligence (EQ) leadership plays a pivotal role in driving business success, significantly boosting the chances of thriving in the first year. Additionally, by focusing on team engagement and interaction, EQ leadership can increase employee effort by 57% and enhance individual performance by 20% – empowering leaders to deliver tangible results that matter.'],
    ['sub' => 'Enhance employee connection and commitment to the company', 'pct' => '76%', 'p' => 'According to Catalyst (2021), employees led with empathy experience a significant increase in company engagement, rising to 76%, along with a 61% boost in creativity, resulting in higher workplace performance.'],
    ['sub' => 'Lead your team to excellence', 'pct' => '40%', 'p' => 'Harvard Business School (2019) demonstrated that leaders with EQ skills lead teams that outperform their peers by 40% in coaching, decision-making, and communication.'],
  ],
  'unlock_h' => 'Unlock your leadership potential with "Head, Heart, Hand"!',
  'unlock_lead' => 'Here’s why "Head, Heart, Hand" is essential for senior managers like you:',
  'unlock' => ['Access insights with models and frameworks selected from top global programs, such as Harvard Kennedy School and Oxford University.', 'Be inspired by engaging visuals and real-life examples that simplify complex concepts for easier understanding.', 'Participate in practical exercises that help you apply new skills in both your work and everyday life.'],
  'topics_h' => 'Explore 9 key topics on Emotional Intelligence Leadership, carefully selected and divided into 3 main collections.',
  'topics_lead' => 'Each card set includes models, frameworks, real-life examples, and engaging visuals to simplify complex concepts, ensuring they are easy to understand and remember:',
  'collections' => [
    ['label' => 'Collection 01', 'items' => ['Emotional Management: Embrace emotions, especially negative ones.', "Conflict Resolution: Conflict isn't always a bad thing!", 'Growth Mindset: Change your thinking and perspective to foster personal development.']],
    ['label' => 'Collection 02', 'items' => ['Effective Team Communication: Share ideas that make others want to listen.', 'Negotiation: Facilitate win-win agreements that benefit both parties.', 'Fundamentals of EQ: Emotional Intelligence is more than just being nice!']],
    ['label' => 'Collection 03', 'items' => ['Empowerment: Choose the right time and person to empower.', 'Resilience: Stand firm in the face of challenges.', 'Empathy and Active Listening: Build meaningful connections by empathizing with others.']],
  ],
  'empower_h' => 'How can this guidebook empower leaders?',
  'empower' => ['The models, examples, and creative visuals will help you enhance your understanding and practical skills for both work and life.', 'Practicing with creative exercises will reinforce your learning and make it a part of your daily routine.', 'Maintain your motivation with inspiring quotes and visuals that keep you focused on your growth journey.'],
  'tm' => ['n' => 'Duyen Nguyen', 'q' => 'This notebook set is truly an excellent tool for developing EQ at work. The frameworks and models are clearly presented and easy to understand, helping my team and me improve our communication skills and manage conflicts more effectively.'],
  'faq_h' => 'Frequently asked questions:',
  'faq_lead' => "Do you have any questions about The New Leaders' products? Let us help you out!",
  'faq' => [
    ['q' => 'Who is The New Leaders?', 'paras' => ['The New Leaders is a pioneering educational organization bringing Emotional Intelligence leadership training programs from Harvard University and Oxford University to Vietnam.']],
    ['q' => "What scientific research are The New Leaders' products based on?", 'bullets' => ['The structure of leadership communication skills from Harvard Kennedy School.', 'Emotional Intelligence (EQ) communication from Harvard Business Review.', 'Research on increasing engagement and intimacy in relationships published in scientific journals such as eNeuro, Personality and Social Psychology Bulletin, Journal of Marriage and Family, etc.']],
  ],
];
}
$col_mods = ['teal', 'green', 'orange'];
?>
<main class="site-main page-pd">

  <section class="pd-hero section">
    <div class="container pd-hero__inner">
      <div class="pd-hero__text">
        <h1 class="pd-hero__title"><?php echo esc_html($P['tagline']); ?></h1>
        <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary pd-hero__cta"><?php echo esc_html($P['buy']); ?></a>
      </div>
      <div class="pd-hero__media"><img src="<?php echo esc_url($img); ?>" alt="Head, Heart, Hand" loading="eager"></div>
    </div>
  </section>

  <section class="pd-why section">
    <div class="container">
      <h2 class="pd-why__title"><?php echo esc_html($P['why_h']); ?></h2>
      <div class="pd-stats">
        <?php foreach ($P['stats'] as $s) : ?>
          <div class="pd-stat">
            <p class="pd-stat__sub"><?php echo esc_html($s['sub']); ?></p>
            <span class="pd-stat__num"><?php echo esc_html($s['pct']); ?></span>
            <p class="pd-stat__p"><?php echo esc_html($s['p']); ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="pd-block section">
    <div class="container">
      <h2 class="pd-block__title"><?php echo esc_html($P['unlock_h']); ?></h2>
      <p class="pd-block__lead"><?php echo esc_html($P['unlock_lead']); ?></p>
      <ul class="ec-list"><?php foreach ($P['unlock'] as $u) : ?><li><?php echo esc_html($u); ?></li><?php endforeach; ?></ul>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary pd-block__cta"><?php echo esc_html($P['buy']); ?></a>
    </div>
  </section>

  <section class="pd-block pd-block--alt section">
    <div class="container">
      <h2 class="pd-block__title"><?php echo esc_html($P['topics_h']); ?></h2>
      <p class="pd-block__lead"><?php echo esc_html($P['topics_lead']); ?></p>
      <div class="pd-cols">
        <?php foreach ($P['collections'] as $i => $c) : ?>
          <div class="pd-col">
            <span class="pd-col__label pd-col__label--<?php echo $col_mods[$i % 3]; ?>"><?php echo esc_html($c['label']); ?></span>
            <ul><?php foreach ($c['items'] as $it) : ?><li><?php echo esc_html($it); ?></li><?php endforeach; ?></ul>
          </div>
        <?php endforeach; ?>
      </div>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary pd-block__cta"><?php echo esc_html($P['buy']); ?></a>
    </div>
  </section>

  <section class="pd-block section">
    <div class="container">
      <h2 class="pd-block__title"><?php echo esc_html($P['empower_h']); ?></h2>
      <div class="pd-empower"><?php foreach ($P['empower'] as $e) : ?><p><?php echo esc_html($e); ?></p><?php endforeach; ?></div>
      <a href="<?php echo esc_url($cta_url); ?>" class="btn btn--primary pd-block__cta"><?php echo esc_html($P['buy']); ?></a>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>

  <section class="pd-tm section">
    <div class="container">
      <figure class="pd-quote">
        <blockquote><?php echo esc_html($P['tm']['q']); ?></blockquote>
        <figcaption><?php echo esc_html($P['tm']['n']); ?></figcaption>
      </figure>
    </div>
  </section>

  <section class="pd-faq section">
    <div class="container">
      <h2 class="pd-faq__title"><?php echo esc_html($P['faq_h']); ?></h2>
      <p class="pd-faq__lead"><?php echo esc_html($P['faq_lead']); ?></p>
      <div class="pd-faq__list">
        <?php foreach ($P['faq'] as $f) : ?>
          <details class="pd-faq__item">
            <summary><?php echo esc_html($f['q']); ?></summary>
            <div class="pd-faq__a">
              <?php if (!empty($f['paras'])) foreach ($f['paras'] as $p) : ?><p><?php echo esc_html($p); ?></p><?php endforeach; ?>
              <?php if (!empty($f['bullets'])) : ?><ul><?php foreach ($f['bullets'] as $b) : ?><li><?php echo esc_html($b); ?></li><?php endforeach; ?></ul><?php endif; ?>
            </div>
          </details>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

</main>
