<?php
/** products/lgad — Landing bộ bài "Một ly nữa nhé?". Song ngữ EN/VI. Verbatim từ live. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$s3 = 'https://bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com/';

$hero = [
  'title'    => $vi ? 'Bộ bài giao tiếp EQ cho những người đang yêu: "Một ly nữa nhé?"' : 'The Emotional Intelligence (EQ) Deck: "Let\'s get another drink?"',
  'subtitle' => $vi ? 'Những câu hỏi thông minh cảm xúc để ta yêu thêm, hoặc yêu... lại.' : 'Emotional Intelligence questions to fall more madly in love or fall in love… again.',
  'desc'     => '',
  'video'    => $s3 . 'vi_video_1_a3ae8f54d0.mp4',
  'buy'      => $vi ? 'Sở hữu ngay' : 'Get it now',
  'buy_url'  => 'https://516814-d2.myshopify.com/cart/48250939736248:1?channel=buy_button',
];

$blocks = [
  ['type' => 'feature', 'img' => $s3 . 'lgad_1_1_6a9f884496.png',
   'h' => $vi ? 'Yêu thêm hoặc yêu "lại" với "Một ly nữa, nhé?"' : 'Madly falling in love or falling in love again with "Let\'s get another drink!"',
   'paras' => $vi ? [
     'Đã lâu rồi chúng ta chưa có dịp nào để thật sự ngồi lại và tâm sự cùng nhau. Dưới ánh đèn này, trong không gian này, và rượu trong tay — sao không gọi một ly nữa và trò chuyện thêm chút.',
     '"Một ly nữa, nhé?" cùng 100 lá bài được thiết kế dựa trên cấu trúc giao tiếp bằng trí tuệ cảm xúc (EQ) từ Đại học Harvard và các nghiên cứu khoa học về cách gia tăng độ thân mật trong mối quan hệ. "Bữa tối" này sẽ giúp chúng mình học cách bình tĩnh lắng nghe nhau, cùng nhớ lại những lúc mới yêu và mong chờ những điều phía trước.',
     'Thôi thì, chắc mình gọi thêm... Một ly nữa, nhé?',
   ] : [
     'It\'s been a while since we had some time to sit down and really talk, hasn\'t it? In this cozy and intimate setting, why don\'t we take this chance to have one more drink and enjoy a bit more time together?',
     '"Let\'s get another drink!" along with 100 cards designed based on the emotional intelligence (EQ) communication structure from Harvard University and scientific studies on enhancing intimacy in relationships. This "dinner" will help us learn to calmly listen to each other, reminiscing about our early days together and looking forward to what\'s to come.',
     'Well then, I guess let\'s order another drink!',
   ]],
  ['type' => 'feature', 'img' => $s3 . 'Frame_580_1_5b78b4d2fd.png',
   'h' => $vi ? 'Câu hỏi giúp đào sâu vào những điều khó nói' : 'Questions that help delve into difficult topics',
   'paras' => $vi ? [
     'Khi yêu, ta có thể sống với phiên bản thật khác của bản thân, và chọn nhìn phiên bản thật khác của người thương. Những câu hỏi này sẽ giúp bạn khám phá khía cạnh chưa từng thấy, học cách chấp nhận và chia sẻ để đi tiếp cùng nhau.',
     'Với 80 câu hỏi xoay quanh nghiên cứu về thông minh cảm xúc (EQ), đi sâu vào các cuộc hội thoại khó nói như tình dục, tài chính, quan điểm sống... đi kèm những lá Love Action để chúng ta bình tĩnh giải quyết từng khúc mắc, cùng nhau!',
   ] : [
     'When we\'re in love, we might show different versions of ourselves and choose to see only certain versions of our beloved. These questions will help you learn to see things from your beloved\'s perspective, accept and move forward together.',
     'With 80 questions categorized into 3 levels — Sparkling, Red Wine, and On the Rocks — you\'ll address difficult topics like sex, finances, and life perspectives, paired with Action cards to calmly address each challenge together!',
   ]],
  ['type' => 'audience',
   'h' => $vi ? '"Một ly nữa, nhé?" sẽ dành cho' : '"Let\'s get another drink?" is for',
   'items' => $vi ? [
     'Cặp đôi đang có nhiều điều muốn trải lòng với nhau nhưng chưa biết bắt đầu từ đâu.',
     'Cặp đôi muốn hiểu nhau thật rõ để cùng nhìn về những dự định tương lai.',
     'Cặp đôi đã yêu lâu muốn khơi lại ngọn lửa tình yêu.',
     'Cặp đôi mới yêu, muốn tìm hiểu thêm về nhau.',
   ] : [
     'Couples with a lot on their minds, unsure where to begin sharing with each other.',
     'Couples who want to understand each other deeply to align on future plans together.',
     'Couples who want to rekindle the flames of their love.',
     'New couples who want to get to know each other better.',
   ]],
  ['type' => 'gallery', 'h' => $vi ? 'Hình ảnh sản phẩm' : 'Product gallery',
   'items' => [$s3 . 'vi_gallery_1_f93a153a22.webp', $s3 . 'vi_gallery_2_e10aa1d6dc.webp', $s3 . 'vi_gallery_3_cf1354ef07.webp', $s3 . 'vi_gallery_4_77c2b84e7c.webp', $s3 . 'vi_gallery_5_e3f037d91d.webp', $s3 . 'vi_gallery_6_d35ec4d0ed.webp']],
  ['type' => 'list',
   'h' => $vi ? '"Một ly nữa, nhé?" được xây dựng trên nền tảng:' : 'What makes this deck special?',
   'items' => $vi ? [
     'Cấu trúc về kỹ năng giao tiếp lãnh đạo của Harvard Kennedy School.',
     'Giao tiếp bằng trí tuệ cảm xúc (EQ) của Harvard Business Review.',
     'Nghiên cứu của Jakubiak & Feeney (2019) về những lần chạm yêu thương giúp gia tăng hạnh phúc và giảm căng thẳng (Personality and Social Psychology Bulletin).',
     'Nghiên cứu của Dew & Wilcox (2013) về sự bao dung và khả năng duy trì chất lượng hôn nhân (Journal of Marriage and Family).',
   ] : [
     'The EQ leadership & communication framework from Harvard Kennedy School.',
     'Emotional Intelligence (EQ) principles from Harvard Business Review.',
     'Jakubiak, B. K. & Feeney, B. C. (2019). Hand-in-hand combat: Affectionate touch promotes relational well-being and buffers stress during conflict. Personality and Social Psychology Bulletin.',
     'Dew, J. & Bradford Wilcox, W. (2013). Generosity and the Maintenance of Marital Quality. Journal of Marriage and Family.',
   ]],
  ['type' => 'steps',
   'h' => $vi ? 'Uống trọn đêm nay như thế nào nhỉ?' : 'How should we sip and savor?',
   'items' => $vi ? [
     'Rút một lá bài và đọc câu hỏi lên — câu hỏi đó có thể dành cho chính mình hoặc người đối diện.',
     'Bắt đầu với Sparkling như món khai vị, rồi chuyển sang Red Wine, và kết thúc với On the Rocks. "Bữa tối" này sẽ giúp ta khám phá bản thân và chia sẻ những cảm xúc khó nói.',
     'Qua những lời thổ lộ này, anh và em sẽ thật sự kết nối, hiểu nhau, và từ đó trân trọng mối quan hệ này hơn nữa.',
     'Với những câu hỏi đã được ghi chú sẵn, hãy rút một lá Love Action và thực hiện theo hướng dẫn trước khi trả lời.',
     'Đừng quên điền vào Love Coupons những ý tưởng hẹn hò mới — để mỗi lần gặp nhau là một lần yêu mới.',
   ] : [
     'Follow the levels: gently go through your love journey with the flow from Sparkling - Red Wine - On the Rocks.',
     'Draw a question and read it out loud. The question will be for yourself or the person you\'re with.',
     'Enjoy the deep conversations! Be open and honest to share your thoughts with your significant other.',
     'Draw a Love Action card when needed — in some questions, draw an Action card and follow its guidance before you answer.',
     'Don\'t forget to plan your next dates with the Love Coupons, so every time we meet, it\'s like falling in love all over again.',
   ]],
  ['type' => 'tips',
   'h' => $vi ? 'Trở thành người bạn tâm lý trong "bữa tối" này bằng cách' : 'Learn more about EQ in the way you communicate!',
   'items' => $vi ? [
     'Lắng nghe với sự thấu hiểu: khi bạn là người hỏi, hãy lắng nghe bằng cả sự cởi mở, đừng vội phán xét hay áp đặt định kiến lên người kia.',
     'Thể hiện sự quan tâm: hãy hỏi thêm để hiểu sâu hơn — ví dụ kể chi tiết về một tình huống, suy nghĩ hay cảm xúc của họ lúc đó, và đặt câu hỏi "tại sao?". Những câu hỏi này cũng giúp chính họ hiểu hơn về mình.',
     'Hãy cởi mở và chân thành: khi bạn là người trả lời, hãy trả lời với sự cởi mở và chân thành. Đây là cách giúp đối phương hiểu hơn về cảm xúc và suy nghĩ của bạn — và cũng giúp bạn hiểu hơn về chính mình.',
   ] : [
     'Listen with intention: when you are the one asking, practice deep listening. Listen to empathize, to understand, without any judgment or prejudice.',
     'Show that you care: ask follow-up questions to gain deeper understanding — describe a specific situation, their thoughts or feelings at the time, and ask why. These questions also help them understand themselves better.',
     'Be genuine, be open: then it\'s your turn — share authentically. Let your emotions flow and thoughts unfold. This transparency deepens our mutual understanding and brings us closer.',
   ]],
  ['type' => 'testimonial', 'n' => 'Duyen Nguyen',
   'q' => $vi ? 'Bộ bài này thực sự mang lại nhiều cảm xúc đối với mình cũng như mọi người tham gia trò chơi. Chúng mình đã kết nối cảm xúc sâu sắc hơn, hiểu nhau hơn và có những giây phút khó quên.'
             : 'This deck of cards truly evokes a lot of emotions for me and everyone participating in the game. We\'ve connected on a deeper emotional level, understood each other better, and had unforgettable moments.'],
  ['type' => 'faq', 'h' => $vi ? 'Câu hỏi thường gặp' : 'Frequently asked questions',
   'items' => [[
     'q' => $vi ? 'The New Leaders là ai?' : 'Who is The New Leaders?',
     'a' => $vi ? 'The New Leaders là tổ chức giáo dục tiên phong đưa chương trình đào tạo lãnh đạo trí tuệ cảm xúc của Đại học Harvard, Cornell và Oxford đến Việt Nam.'
                : 'The New Leaders is a pioneering organization that brings leadership training programs on emotional intelligence (EQ) leadership from Harvard University, Cornell University, and Oxford University to Vietnam.',
   ]]],
];

include locate_template('template-parts/pages/_product-landing.php');
