<?php
/** our-services/for-team-member — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$P = [
  'hero_tagline' => 'Tăng cường kỹ năng giao tiếp dựa trên EQ để tạo sự phối hợp và gắn kết team tốt hơn, giúp nâng cao hiệu suất cho cá nhân và đội nhóm.',
  'hero_cta' => 'Tham gia chương trình giao tiếp EQ',
  'pills' => ['Thiết thực.', 'Lấy con người làm trung tâm.', 'Đổi mới.', 'Tác động lâu dài.'],
  'stats_h' => 'Tại sao khoá học giao tiếp EQ cho đội ngũ lại cần thiết?',
  'stats' => [
    ['pct' => '70%', 'text' => 'lỗi xảy ra trong doanh nghiệp là do giao tiếp không tốt (Gartner, 2023).'],
    ['pct' => '45%', 'text' => 'giao tiếp kém hiệu quả làm giảm niềm tin của 45% nhân viên.'],
    ['pct' => '86%', 'text' => '86% giám đốc điều hành và nhân viên của doanh nghiệp phản ánh những thất bại trong doanh nghiệp xảy ra là do giao tiếp và hợp tác kém hiệu quả (Expert Market, 2023).'],
  ],
  'impact_blocks_h' => 'Chúng tôi có thể tạo ra tác động với doanh nghiệp của bạn bằng cách:',
  'impact_intro' => 'Chúng tôi giúp các doanh nghiệp thiết lập tiêu chuẩn giao tiếp chuyên nghiệp cho toàn bộ nhân viên doanh nghiệp (bao gồm cả đội ngũ hiện hữu và đội ngũ mới gia nhập) nhằm nâng cao tinh thần và hiệu suất làm việc nhóm.',
  'impact_blocks' => [
    ['title' => 'Phá vỡ giới hạn về hiệu suất', 'para' => 'Thúc đẩy hiệu suất tối đa của cá nhân và của doanh nghiệp bằng việc khơi dậy tiềm năng lãnh đạo bên trong mỗi cá nhân và sử dụng cách giao tiếp, xử lý vấn đề chuyên nghiệp dựa trên EQ.'],
    ['title' => 'Cách mạng hóa hiệu suất nhóm của bạn', 'para' => 'Đạt được mức tăng truởng đáng kinh ngạc đến 64% thông qua sức mạnh của giao tiếp hiệu quả và nâng cao sự gắn kết & cam kết của nhân viên thông qua chương trình đào tạo tạo tác động của chúng tôi.'],
    ['title' => 'Mở khóa những bí quyết để giảm 50% chi phí tuyển dụng và nuôi dưỡng lòng trung thành của nhân viên', 'para' => 'Tạo môi trường làm việc tích cực, lành mạnh và phát triển, khiến nhân viên hài lòng và mong muốn gắn bó lâu dài tới tập thể.'],
  ],
  'prog_h' => 'Chương trình lãnh đạo bằng EQ được thiết kế riêng cho đội ngũ quản lý lãnh đạo của từng doanh nghiệp',
  'prog_intro' => '',
  'modules' => [
    ['title' => 'Nhận thức bản thân', 'paras' => ['Giúp các cá nhân nhận thức về bản thân ở mức độ sâu hơn khi họ khám phá về:'], 'bullets' => ['Nhận thức bên trong: giúp cá nhân chủ động và có trách nhiệm hơn.', 'Nhận thức bên ngoài: hiểu cách hành động, phản ứng và cư xử đúng mực.']],
    ['title' => 'Hiểu cảm xúc và hành vi của người khác', 'paras' => ['Kết nối một cách hiệu quả nhờ áp dụng các kỹ năng giao tiếp cốt lõi của EQ. Điều này cực kỳ quan trọng trong việc tạo nên sự hợp tác, hỗ trợ giữa các thành viên, thúc đẩy môi trường làm việc tích cực và đặc biệt nâng cao hiệu suất tối đa của đội nhóm.']],
    ['title' => 'Đưa ra phản hồi hiệu quả', 'paras' => ['Học kỹ năng đưa ra ý kiến nhận xét, phản hồi khiến người khác, dù là cấp dưới, đồng nghiệp hay cấp trên, đều muốn lắng nghe và tích cực hành động.']],
    ['title' => 'Quản lý xung đột', 'paras' => ['Cung cấp cho toàn bộ nhân viên doanh nghiệp kiến thức để giao tiếp tốt hơn trong các tình huống bất đồng thông qua:'], 'bullets' => ['Tư duy đúng đắn khi đối mặt với xung đột: không phải xung đột nào cũng không lành mạnh!', 'Giao tiếp thuyết phục: học cách nêu ra quan điểm cá nhân và thuyết phục người khác một cách chuyên nghiệp.', 'Kỹ năng giao tiếp với những đối tượng khó: kỹ năng kết hợp nhiều phương pháp EQ trong giao tiếp để điều hoà mối quan hệ phù hợp nhất.']],
    ['title' => 'Thuyết trình và thảo luận nhóm', 'paras' => ['Cải thiện năng suất thảo luận nhóm và cuộc họp của bạn thông qua:'], 'bullets' => ['Thuyết trình thuyết phục: hiểu cách tạo ra một bài thuyết trình rõ ràng và hiệu quả.', 'Điều phối, dẫn dắt thảo luận nhóm hiệu quả: kỹ năng dẫn dắt thảo luận để tạo ra những ý tưởng hiệu quả nhất từ các thành viên trong nhóm.']],
    ['title' => 'Nâng tầm chất lượng dịch vụ khách hàng (customer services) bằng giao tiếp EQ', 'paras' => ['Tạo lợi thế cạnh tranh tuyệt đối về customer service của doanh nghiệp trên thị trường bằng kỹ năng giao tiếp dựa trên thông minh cảm xúc, đặc biệt dành cho đội nhóm chuyên về tư duy kỹ thuật.']],
  ],
  'tm_title' => 'Đánh giá của các nhà lãnh đạo về khoá học của chúng tôi',
  'people' => [
    ['n' => 'Barry Weisblatt', 'r' => 'Giám đốc Nghiên cứu tại VNDIRECT Securities Corporation, Nguyên giám đốc tại Equity Markets & Securitization VinFast Global', 'q' => 'Ngân đã thực sự giúp tôi trở thành một nhà lãnh đạo tốt hơn. Cô ấy biết lắng nghe và dựa trên kiến thức cũng như kinh nghiệm phong phú của bản thân để đưa ra những lời khuyên sâu sắc và thiết thực. Điều này giúp tôi đối mặt với các vấn đề và truyền cảm hứng cho nhóm hoạt động và phát triển một cách hiệu quả. Sau một thời gian ở vị trí dẫn đầu, chúng ta rất dễ để trở nên tự mãn trong cách làm việc. Chính vì vậy, Ngân đã giúp tôi có được góc nhìn mới và tiếp tục thăng tiến trong sự nghiệp.'],
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'Khoá học của The New Leaders đã giúp tôi cải thiện kỹ năng của mình ở vị trí lãnh đạo của một startup tỉ đô để có thể tạo động lực & truyền cảm hứng cho team tiến về phía trước. Những điều học được từ khoá học này còn cực kì hữu ích khi tôi thường xuyên là diễn giả trong các sự kiện cộng đồng và là nhà sáng lập của một tổ chức phi chính phủ.'],
    ['n' => 'Sarah Smith', 'r' => 'CEO tại MNC', 'q' => 'Đảm nhận vai trò mới là CEO của công ty thật sự là một thách thức đối với tôi. Tôi chuyển đến một môi trường mới, nơi mọi thứ diễn ra trì trệ hơn so với kỳ vọng của tôi. Đôi lúc tôi cảm thấy cô đơn và kiệt sức nhưng Ngân đã giúp tôi củng cố kỹ năng lãnh đạo của mình, chỉ cho tôi cách để kết nối và dần dần thúc đẩy, truyền cảm hứng cho đội ngũ. Thực hành những kỹ năng lãnh đạo bằng EQ quả thật không phải điều dễ dàng, nhưng thật sự nó rất hiệu quả. Cảm ơn Ngân vì đã là một phần của hành trình trở thành một nhà lãnh đạo xuất sắc của tôi.'],
    ['n' => 'Kris van Daele', 'r' => 'Giám đốc vận hành - De Heus Vietnam', 'q' => 'Chúng tôi đã liên hệ với The New Leaders để thiết kế chương trình chuyên biệt về kỹ năng lãnh đạo dựa trên EQ để phát triển đội ngũ quản lý của chúng tôi. Được hỗ trợ bởi kinh nghiệm của họ, 3 nhóm quản lý của chúng tôi đã học cách hiểu hơn về giá trị bên trong họ, hiểu hơn về đồng nghiệp và xây dựng niềm tin trong nhóm. Đây là một cuộc hành trình dài và vẫn đang tiếp diễn, nhưng chắc chắn đáng giá từng phút!'],
  ],
  'whyus_h' => 'Điều khiến chúng tôi khác biệt?',
  'whyus_lead' => '',
  'whyus' => [
    ['title' => 'Dựa trên các chương trình đào tạo lãnh đạo hàng đầu trên thế giới', 'desc' => 'Tổ chức giáo dục tiên phong tại Việt Nam cung cấp các chương trình Đào tạo Lãnh đạo với Trí tuệ Cảm xúc (EQ) dựa trên cấu trúc đào tạo lãnh đạo của trường Đại học Harvard, Đại học Cornell và Đại học Oxford.'],
    ['title' => 'Tầm nhìn nhân lực vươn tầm quốc tế', 'desc' => 'Chúng tôi mang trong mình sứ mệnh nâng tầm kỹ năng giao tiếp bằng Trí tuệ cảm xúc (EQ) cho các nhà lãnh đạo và toàn bộ đội ngũ nhân sự theo chuẩn quốc tế.'],
    ['title' => 'Thiết kế chương trình đào tạo mang tính thực tế', 'desc' => 'Luyện tập thường xuyên là chìa khoá để hình thành và thuần thục kỹ năng. Chính vì vậy, chương trình của chúng tôi được thiết kế với 80% thời lượng đào tạo là thực hành và thảo luận dựa trên các tình huống thực tế trong doanh nghiệp và nhận đánh giá trực tiếp từ chuyên gia để bạn có thể áp dụng trực tiếp những kiến thức đã học vào công việc của mình và cuộc sống hàng ngày.'],
    ['title' => 'Chương trình đào tạo dài hạn mang lại hiệu quả lâu dài', 'desc' => 'Chương trình dài hạn với các hoạt động thực hành liên tục và tham vấn cùng chuyên gia sau workshop đào tạo (tùy theo chương trình) nhằm xây dựng và phát triển kỹ năng giao tiếp bằng trí tuệ cảm xúc (EQ) trong cuộc sống và công việc.'],
  ],
  'cta1' => 'Tham gia chương trình EQ cho lãnh đạo',
  'cta2' => 'Tham gia chương trình EQ cho đội ngũ',
];
} else {
$P = [
  'hero_tagline' => 'Cultivate EQ Communication skills to enhance team cohesion and optimize performance for team members.',
  'hero_cta' => 'Join our EQ Communication Program',
  'pills' => ['Practical.', 'People-centered.', 'Innovative.', 'Enduring impact.'],
  'stats_h' => 'Why EQ Communication for your teams?',
  'stats' => [
    ['pct' => '70%', 'text' => 'of corporate errors are due to poor communication (Gartner, 2023).'],
    ['pct' => '45%', 'text' => 'Ineffective communication undermines trust for 45% of employees.'],
    ['pct' => '86%', 'text' => '86% of Corporate executives, educators, and employees blame failures on ineffective communication and poor collaboration (Expert Market,2023).'],
  ],
  'impact_blocks_h' => 'What impact we could help your business?',
  'impact_intro' => 'We help businesses set up the professional communication standard for new and current employees to enhance effective teamwork and perfomance.',
  'impact_blocks' => [
    ['title' => 'Unlock Peak Business Performance', 'para' => "Elevate your team's performance by empowering individuals with essential self-leadership techniques and witnessing the transformative impact on individual and overall business success!"],
    ['title' => "Revolutionize Your Team's Performance", 'para' => 'Unleash a staggering 64% boost through the power of effective communication and elevate engagement & commitment effortlessly with our game-changing training program.'],
    ['title' => 'Unlock the secrets to reducing recruitment costs by 50% and fostering unmatched employee loyalty', 'para' => 'Create a positive environment that encourages people to contribute, be committed, and stay long-term.'],
  ],
  'prog_h' => 'EQ Communication programs for team members',
  'prog_intro' => 'Our customized training program is designed with scenario-based approach, interactive activities and discussions. The training is designed based on the leadership framework from Harvard Kennedy School and Oxford University.',
  'modules' => [
    ['title' => 'Self-awareness', 'paras' => ['Help individuals to be more aware of themselves on a deeper level as they will explore about:'], 'bullets' => ['Internal self-awareness: help individuals to be more proactive and responsible.', 'External self-awareness: understand how to act, react and behave in the right manner.']],
    ['title' => "Understanding Others' Emotions and Behaviors", 'paras' => ["Effectively connect with one another by learning the core EQ communication skills to understand others' emotions and behaviors.", 'This leads to the outcome of fostering smooth communication, mutual support, promoting a positive working environment, and enhancing team productivity.']],
    ['title' => 'Giving effective feedback', 'paras' => ['Provide individuals the knowledge to give opinions that others, be it subordinates, colleagues or managers, want to listen and maintain harmony in relationships.']],
    ['title' => 'Conflict Management', 'paras' => ['Provide individuals the knowledge to communicate better in tense situations through:'], 'bullets' => ['The right mindset when facing conflicts: not all conflicts are unhealthy!', 'Persuasive communication: protect their points and convince others.', 'Dealing with difficult people: ease the tension in the conversation with the right languages (words, body gestures, etc).']],
    ['title' => 'Presentation and Ideas Discussion', 'paras' => ["Improve your team discussions and meetings' productivity through:"], 'bullets' => ['Persuasive presentation: understand how to generate a clear and effective presentation', 'Handling meaningful discussion: maintain the atmosphere and facilitate constructive discussion.']],
    ['title' => 'EQ communication for Customer Services', 'paras' => ['Enhance customer service with EQ to the outstanding customer satisfactions that differentiate your service to any in the market, especially for the teams of technical expertises.']],
  ],
  'tm_title' => 'Our leaders say about the experience',
  'people' => [
    ['n' => 'Ho Minh Quang', 'r' => 'Vice President Pudong Prime International', 'q' => "Building trust and emotional intelligence (EQ) communication skills we've learned from The New Leaders' customized program have really helped our leadership team connect better. Developing EQ in our team has fostered a culture of trust, friendliness, and a safe space for sharing and creativity within the team."],
    ['n' => 'Ha Thi Thuy An', 'r' => 'Export Sales Manager at Khumsub', 'q' => "I received a lot of useful knowledge from The New Leaders' workshop, especially the application of emotional intelligence in leadership skills in today's world. I was also greatly impressed by the energy and expertise that Ngan Tran brought to the workshop."],
    ['n' => 'Hai Tran', 'r' => 'National Service Manager - MediGroup Vietnam', 'q' => "The Advance Customer Services Communication by Emotional Intelligence training program by The New Leaders has significantly transformed our team. Our ability to identify and manage emotions has greatly enhanced our customer relationships. We are highly impressed with the program's professionalism and effectiveness."],
    ['n' => 'Kathy Le', 'r' => 'HR Consultant at Long Binh Company', 'q' => "Today's human resources are different from the past; they engage with us through understanding. At The New Leaders' workshop, I learned how to communicate in a way that makes those around me feel confident, safe, and understood, allowing them to be more open with me."],
    ['n' => 'Nguyen Van Cong', 'r' => 'CEO - Wellbeing Vietnam', 'q' => 'The workshop from The New Leaders opened my eyes to a wealth of knowledge and communication techniques that were completely new to me.'],
  ],
  'whyus_h' => 'Why us?',
  'whyus_lead' => 'We are distinguished from others because we provide:',
  'whyus' => [
    ['title' => 'Worldwide recognized-quality Leadership Programs', 'desc' => "The leading educational organization in Vietnam provides Emotional Intelligence (EQ) Leadership Training programs based on Harvard and Oxford University's Leadership Frameworks."],
    ['title' => 'World-class Working Standard Vision', 'desc' => 'Our mission is to advance EQ Communication skills to a world-class standard for leaders and their team members.'],
    ['title' => 'Practical Training Program Design', 'desc' => 'As skills need to be practiced to master them, the program will be designed with 80% of the training is to practice, discuss and get coaching directly based on real & practical case scenarios in business so that you can apply directly the gained knowledge to your daily work.'],
    ['title' => 'Long-term program to make real impacts', 'desc' => 'Long term follow-up & coaching (varied per program) by our coach/trainers and technology/AI after the training workshop to support them to build and develop their EQ Communication skills in life and at work.'],
  ],
  'cta1' => 'Join Customized Leadership Program',
  'cta2' => 'Join Programs for Team members',
];
}
include locate_template('template-parts/pages/_program-detail.php');
