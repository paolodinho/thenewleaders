<?php
/** products/hlmays — Landing bộ bài "Hey, tớ hỏi nè!". Song ngữ EN/VI. Verbatim từ live. */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$s3 = 'https://bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com/';

$hero = [
  'title'    => $vi ? 'Những câu hỏi về thông minh cảm xúc mang cậu đến gần tớ hơn.' : 'Emotional Intelligence questions bring you closer to me!',
  'subtitle' => $vi ? '"Hey, tớ hỏi nè!" giúp tớ và cậu hiểu và thắt chặt mối quan hệ với nhau như thế nào?' : 'How "Hey, let me ask you something!" help you and me getting closer to each other?',
  'desc'     => $vi ? 'Bộ câu hỏi được xây dựng dựa trên nghiên cứu EQ' : 'All questions are designed based on EQ research',
  'img'      => $s3 . 'Frame_580_1_5b78b4d2fd.png',
  'buy'      => $vi ? 'Sở hữu ngay' : 'Get it now',
  'buy_url'  => 'https://516814-d2.myshopify.com/cart/48210331041976:1?channel=buy_button',
];

$blocks = [
  ['type' => 'feature', 'img' => $s3 . 'young_asian_woman_sitting_bench_relax_beach_beautiful_female_happy_relax_near_sea_d1e1004861.webp',
   'h' => $vi ? 'Hiểu mình để thương mình, hiểu người để thương ta...' : 'Understand yourself to embrace yourself, understand others to deepen our relationship...',
   'paras' => $vi ? [
     '"Hey, tớ hỏi nè!" không dừng lại ở những câu hỏi đơn thuần — bộ câu hỏi của chúng tớ được sáng tạo dựa trên cấu trúc giao tiếp bằng trí tuệ cảm xúc (EQ) của trường Đại học Harvard, kết hợp cùng nhiều nghiên cứu về cách gia tăng mức độ thân thiết trong các mối quan hệ.',
     'Mỗi câu hỏi là lời gợi mở, để cậu và tớ ngồi luyên thuyên về những trải nghiệm, cảm xúc, suy nghĩ của nhau. Từ đó thêm hiểu, thêm gắn kết, thêm trân trọng, thêm thương phiên bản của chúng ta.',
   ] : [
     '"Hey, let me ask you something!" is not just a set of simple questions. The question set is designed based on Harvard University\'s emotional intelligence (EQ) communication framework, combined with studies on enhancing intimacy in relationships.',
     'Each question serves as a prompt, encouraging us to sit down and share our experiences, feelings, and thoughts. Through these conversations, we gain a deeper understanding of each other, strengthen our connection, and foster greater self-love and respect for our relationship.',
   ]],
  ['type' => 'feature', 'img' => $s3 . 'vi_card_1_029b824266.webp',
   'h' => $vi ? 'Những câu hỏi giúp chúng mình từ Gần, sang Thân, rồi tới Thương' : 'Questions help us move from understanding to true connection',
   'paras' => $vi ? [
     'Không hỏi để biết, hỏi để hiểu, từ hiểu đến thân, rồi tới thương. Bộ bài của chúng tớ được xây dựng theo 3 cấp độ của mối quan hệ. Từ những bước đầu, "Hey, tớ hỏi nè!" sẽ đồng hành cùng cậu và tớ trên hành trình đi sâu vào bên trong mỗi người, thông qua những lời gợi ý để hiểu sâu và những giải thích về ý nghĩa câu hỏi trên các lá bài.',
   ] : [
     'Not just ask to know, but ask to understand. From understanding comes closeness, and from closeness comes true connection. Our card deck is designed with three levels of relationship: Close - Closer - Closest. Right from the start, "Hey, let me ask you something!" will accompany us on a journey deep into our individual selves and our relationship, offering prompts for deeper understanding and explanations of the questions\' meanings.',
   ]],
  ['type' => 'audience',
   'h' => $vi ? '"Hey, tớ hỏi nè!" sẽ phù hợp với...' : '"Hey, let me ask you something!" is for...',
   'items' => $vi ? [
     'Nhóm bạn đang tìm kiếm một trò chơi vừa vui nhưng đủ "deep".',
     'Những người bạn mới quen muốn hiểu thêm về nhau.',
     'Đồng nghiệp trong cùng team muốn thấu hiểu, gắn kết và ăn ý hơn.',
     'Crush hoặc những cặp đôi mới yêu — bạn sẽ bất ngờ với những gì mình khám phá ra!',
   ] : [
     'Groups of friends or colleagues looking for a game that\'s both fun and meaningful.',
     'New friends wanting to get to know each other better.',
     'Colleagues on the same team looking to understand, connect, and become more in sync.',
     'Crushes or new couples — you\'ll be surprised by what you discover!',
   ]],
  ['type' => 'gallery', 'h' => $vi ? 'Hình ảnh sản phẩm' : 'Product gallery',
   'items' => [$s3 . 'vi_gallery_1_51dfa52dc7.webp', $s3 . 'vi_gallery_2_8143c75873.webp', $s3 . 'vi_gallert_3_37bf75aa7a.webp', $s3 . 'vi_gallery_4_bacbe36f66.webp', $s3 . 'vi_gallery_5_df59e3dbcb.webp', $s3 . 'card_1_67c0c214a0.png']],
  ['type' => 'list',
   'h' => $vi ? '"Hey, tớ hỏi nè!" được thiết kế dựa trên:' : '"Hey, let me ask you something!" is designed based on:',
   'items' => $vi ? [
     'Cấu trúc về kỹ năng giao tiếp lãnh đạo của Harvard Kennedy School.',
     'Giao tiếp bằng trí tuệ cảm xúc (EQ) của Harvard Business Review.',
     'Nghiên cứu về mức độ thân thiết của các mối quan hệ (Aron, A. et al., 1997 — Personality and Social Psychology Bulletin).',
     'Nghiên cứu về tác động của việc chia sẻ câu chuyện lên độ thân thiết (Enhui Xie, et al., 2021 — eNeuro).',
   ] : [
     'The EQ communication skills framework from Harvard Kennedy School.',
     'Emotional Intelligence (EQ) principles from Harvard Business Review.',
     'Aron, A., Melinat, E., Aron, E. N., et al. (1997). The experimental generation of interpersonal closeness. Personality and Social Psychology Bulletin.',
     'Xie, E., Yin, Q., Li, K., et al. (2021). Sharing Happy Stories Increases Interpersonal Closeness. eNeuro.',
   ]],
  ['type' => 'textblock', 'alt' => true,
   'h' => $vi ? 'Bắt đầu chơi như thế nào nhỉ?' : 'How shall we start?',
   'paras' => $vi ? [
     'Một không gian phù hợp sẽ là yếu tố đầu tiên — chọn một nơi thoải mái, đi kèm chút đồ ăn nhẹ và nước uống là đủ để mở lời. Sau đó, hãy tuân thủ theo các cấp độ để tận dụng tối đa bộ bài: bắt đầu từ Gần, rồi đến Thân, và cuối cùng là Thương. Khám phá xem bạn thực sự hiểu nhau đến đâu — bạn có thể sẽ bất ngờ ngay từ giai đoạn đầu tiên!',
   ] : [
     'Begin your journey by creating a comfortable space that encourages openness and connection with your friends and colleagues. Explore the levels of the deck — from Close to Closer to Closest — and uncover how deeply you understand each other. You may be surprised by what you learn, even in the initial stages!',
   ]],
  ['type' => 'textblock',
   'h' => $vi ? 'Lắng nghe sao cho hiệu quả?' : 'What should we focus on?',
   'paras' => $vi ? [
     'Hãy lắng nghe với sự cởi mở và chú tâm đến cảm xúc cũng như suy nghĩ mà người kể đang truyền tải. Có câu trả lời nào khiến bạn WOW lên không? Vì bạn chưa từng nghĩ tới, hay do chúng ta chưa từng có cơ hội thổ lộ? Cùng thảo luận và đi sâu hơn vào những góc khuất này thôi.',
   ] : [
     'Don\'t just listen to the story itself, let\'s also pay attention to the feelings and emotions the person experienced during the event. Are you intrigued by their response? Have you uncovered new insights? Let\'s discuss these newly discovered aspects with each other in more detail.',
   ]],
  ['type' => 'tips',
   'h' => $vi ? 'Đào sâu thêm vào câu chuyện như thế nào?' : 'Learn more about EQ in the way you communicate!',
   'items' => $vi ? [
     'Hãy lắng nghe, lắng nghe và lắng nghe! Khi cậu là người hỏi, hãy lắng nghe để thấu cảm, để hiểu, mà không có bất kỳ sự phán xét hay định kiến nào với người đối diện.',
     'Hãy trở nên hiếu kì hơn! Đừng hài lòng quá sớm. Sao không thử hỏi thêm: Sau đó thì sao? Chuyện gì đã diễn ra? Mọi người thấy thế nào? Tại sao họ lại làm/lựa chọn như thế? Những câu hỏi này cũng giúp chính họ hiểu hơn về mình.',
     'Hãy mở lòng và trả lời chân thành! Khi cậu là người trả lời, sự chân thành là chìa khóa để đào sâu hiểu biết về bản thân và tạo ra kết nối chân thành với người khác.',
   ] : [
     'Listen, listen deeply! When you are the one asking, practice listening skills. Listen to empathize, to understand, without any judgment or prejudice.',
     'Stay curious! Don\'t settle too soon. Ask probing questions to understand their feelings, motivations, and what shaped their actions: What happened? How did they feel in that moment? Why did they feel that way?',
     'Be open, be honest! When providing an answer, remember to be sincere and open-hearted. Sincerity is key to deepening understanding of your inner self and fostering genuine connections.',
   ]],
  ['type' => 'testimonial', 'n' => 'Ngoc Pham',
   'q' => $vi ? 'Bộ bài này thực sự mang lại nhiều cảm xúc đối với mình cũng như mọi người tham gia trò chơi. Chúng mình đã kết nối cảm xúc sâu sắc hơn, hiểu nhau hơn và có những giây phút khó quên.'
             : 'These cards truly brings out a lot of emotions for me and everyone who plays. We connected on a deeper level, understood each other better, and shared unforgettable moments.'],
  ['type' => 'faq', 'h' => $vi ? 'Câu hỏi thường gặp' : 'Frequently asked questions',
   'items' => [[
     'q' => $vi ? 'The New Leaders là ai?' : 'Who is The New Leaders?',
     'a' => $vi ? 'The New Leaders là tổ chức giáo dục tiên phong đưa chương trình đào tạo lãnh đạo trí tuệ cảm xúc của Đại học Harvard, Cornell và Oxford đến Việt Nam.'
                : 'The New Leaders is a pioneering organization that brings leadership training programs on emotional intelligence (EQ) leadership from Harvard University, Cornell University, and Oxford University to Vietnam.',
   ]]],
];

include locate_template('template-parts/pages/_product-landing.php');
