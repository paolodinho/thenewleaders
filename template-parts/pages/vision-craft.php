<?php
/** products/vision-craft — Landing "Vision Craft". Song ngữ EN/VI. Verbatim từ live. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$s3 = 'https://bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com/';

$hero = [
  'title'    => $vi ? 'Học lãnh đạo qua hình vẽ sáng tạo: Vision Craft' : 'Visual Designs for Leaders, Managers: Vision Craft',
  'subtitle' => $vi ? 'Bạn đồng hành không thể thiếu trên bàn làm việc của bạn!' : 'Aspiring visuals to elevate your Emotional Intelligence (EQ) Leadership',
  'desc'     => '',
  'img'      => $s3 . 'mockup_hop_dung_f7c097d057.png',
  'buy'      => $vi ? 'Đặt mua ngay' : 'Buy now',
  'buy_url'  => 'https://516814-d2.myshopify.com/products/vision-craft',
];

$blocks = [
  ['type' => 'feature', 'img' => $s3 . 'm2_3a151d8f09.png',
   'h' => $vi ? 'Vì sao sử dụng hình ảnh thay vì chỉ văn bản?' : 'Why visuals not text?',
   'paras' => $vi ? [
     'Tăng năng suất — Một nghiên cứu mới đây trên Tạp chí Tâm lý học Thực nghiệm (2022) đã chứng minh rằng sử dụng phương tiện hình ảnh có thể cải thiện quá trình học tới 400%. Điều này giúp các nhà lãnh đạo nắm bắt nhanh chóng các khái niệm phức tạp và đưa ra những quyết định đúng đắn.',
     'Truyền cảm hứng cho hành động — Các tín hiệu hình ảnh mạnh mẽ giúp lưu giữ và ghi nhớ thông tin tốt hơn đến 65% đối với những lãnh đạo và quản lý. Điều này làm cho hiểu biết về động lực và chiến lược trở nên sâu sắc hơn.',
     'Cải thiện tương tác — Sử dụng hình ảnh trực quan như video, đồ họa thông tin và sơ đồ có thể tăng cường mức độ tương tác lên đáng kể. Theo TechSmith (2018), 67% học viên thích hợp hơn khi tiếp cận với nội dung video và hình ảnh thay vì văn bản đơn điệu.',
   ] : [
     'To enhance productivity — A study in the Journal of Experimental Psychology (2022) stated that using visual aids can improve learning by up to 400% which thereby empower leaders to quickly grasp complex concepts and make informed decisions.',
     "To inspire actions — Visual cues enhance leaders' and managers' ability to retain and recall information, making motivational insights and strategies more memorable by 65%.",
     "To improve engagement levels — Incorporating visuals such as videos, infographics, and diagrams can boost engagement in leaders' and managers' learning materials as 67% of employees learn better through video and visual content compared to text-based content (TechSmith, 2018).",
   ]],
  ['type' => 'feature', 'img' => $s3 . 'why_ally_1_357d0694a1.png',
   'h' => $vi ? 'Tại sao nên chọn Vision Craft làm đồng minh không thể thiếu của bạn?' : 'Why make Vision Craft your go-to ally?',
   'paras' => $vi ? [
     'Học không nhàm chán — Làm phong phú thêm kiến thức của bạn với 12 chủ đề Lãnh đạo EQ được minh họa bằng hình ảnh sáng tạo.',
     'Nguồn động lực hàng ngày — Không chỉ là lời nhắc nhở, bộ bài này còn tổng hợp những câu nói của các nhà lãnh đạo nổi tiếng, truyền cảm hứng cho bạn trong hành trình lãnh đạo hàng ngày.',
   ] : [
     'Learn without boredom — Dive into 12 engaging EQ Leadership topics, brought to life with creative visuals.',
     'Daily motivation — More than just reminders, this deck features inspiring quotes from renowned leaders to fuel your leadership journey every day.',
   ]],
  ['type' => 'feature', 'img' => $s3 . 'mockup_hop_dung_3f9ed84ecf.png', 'paras' => [],
   'h' => $vi ? 'Hãy để hình ảnh kể lại câu chuyện và giúp bạn phát triển khả năng lãnh đạo EQ qua 12 chủ đề' : 'Let our visuals tell you the stories of EQ Leadership through 12 core topics'],
  ['type' => 'feature', 'img' => $s3 . 'maximize_1_5b37a8c32c.png', 'cta' => true,
   'h' => $vi ? 'Tối ưu hóa trải nghiệm Vision Craft của bạn' : 'Maximize Your Vision Craft Experience',
   'paras' => $vi ? [
     'Cho bản thân bạn — Hãy để bộ sưu tập này truyền cảm hứng cho bạn với những hình ảnh sáng tạo và những câu trích dẫn đầy cảm hứng. Đặt chúng ngay trước mắt bạn trên bàn làm việc để bạn có thể chú ý mọi lúc — một nguồn cảm hứng đáng tin cậy mà không chiếm quá nhiều diện tích.',
     'Cho người khác — Tăng tính truyền cảm và khả năng ghi nhớ của thông điệp bằng cách tích hợp những hình ảnh sinh động vào bài thuyết trình hoặc giao tiếp hàng ngày, dù là nói hay viết.',
   ] : [
     'For Yourself — Place this deck on your desk where it catches your eye, and let the creative visuals and inspiring quotes keep you motivated daily. It\'s perfectly sized to be your "best buddy" without taking up much space!',
     'For Others — Amplify the impact of your messages by incorporating these captivating visuals into your presentations or daily communications, whether spoken or written. Make every message memorable!',
   ]],
  ['type' => 'audience',
   'h' => $vi ? 'Vision Craft dành cho ai?' : 'Vision Craft is for...',
   'items' => $vi ? [
     'Các nhà lãnh đạo và quản lý trong các doanh nghiệp, tổ chức xã hội và giáo dục.',
     'Những người luôn cố gắng truyền động lực và tìm nguồn cảm hứng mỗi ngày.',
     'Những ai mong muốn phát triển kỹ năng lãnh đạo và áp dụng những tư duy mới thông qua Trí tuệ Cảm xúc.',
   ] : [
     'Managers and Leaders: Perfect for corporate settings, social enterprises, educational institutes, and more.',
     'Motivators: Ideal for individuals who seek daily inspiration and want to motivate others.',
     'Aspiring Leaders: Great for those aiming to enhance their leadership skills and embrace new mindsets through Emotional Intelligence.',
   ]],
  ['type' => 'gallery', 'h' => $vi ? 'Hình ảnh sản phẩm' : 'Product gallery',
   'items' => [$s3 . 'm1_a36d30fbde.png', $s3 . 'm3_af2ce50ab5.png', $s3 . 'm4_4be40a8237.png', $s3 . 'm5_c138ecc15e.png', $s3 . 'm6_9cf99a4f98.png', $s3 . 'maximize_2_19a66bca27.png']],
  ['type' => 'textblock', 'alt' => true,
   'h' => $vi ? 'Lắng nghe từ đối tác của chúng tôi' : 'Hear it from our partners',
   'paras' => $vi ? ['Chúng tôi được các viện giáo dục, tổ chức phi chính phủ, công ty khởi nghiệp và tập đoàn hàng đầu tin tưởng để tăng cường khả năng lãnh đạo và tạo ra những thay đổi tích cực trong doanh nghiệp và xã hội của họ.']
                  : ["We're trusted by leading educational institutes, NGOs, startups and corporates to strengthen leadership and create changes in their businesses and society."]],
  ['type' => 'partners'],
  ['type' => 'testimonial', 'n' => 'Duyen Nguyen',
   'q' => $vi ? 'Là một nhà lãnh đạo, việc giữ động lực và truyền cảm hứng cho đội ngũ là rất quan trọng với tôi. Sản phẩm này đã hoàn toàn thay đổi thói quen hàng ngày của tôi. Những hình ảnh đầy cảm hứng không chỉ nâng cao tinh thần của tôi mà còn kích thích sự sáng tạo và đổi mới trong đội ngũ.'
             : 'As a leader, it\'s important for me to stay motivated and inspire my team. This product has completely changed my daily routine. The inspiring visuals not only boost my mood but also spark creativity and innovation within my team. It\'s a must-have for any manager wanting to lead with vision and passion.'],
  ['type' => 'faq', 'h' => $vi ? 'Câu hỏi thường gặp' : 'Frequently asked questions',
   'items' => [[
     'q' => $vi ? 'The New Leaders là ai?' : 'Who is The New Leaders?',
     'a' => $vi ? 'The New Leaders là tổ chức giáo dục tiên phong đưa chương trình đào tạo lãnh đạo trí tuệ cảm xúc của Đại học Harvard, Cornell và Oxford đến Việt Nam.'
                : 'The New Leaders is a pioneering organization that brings leadership training programs on emotional intelligence (EQ) leadership from Harvard University, Cornell University, and Oxford University to Vietnam.',
   ]]],
];

include locate_template('template-parts/pages/_product-landing.php');
