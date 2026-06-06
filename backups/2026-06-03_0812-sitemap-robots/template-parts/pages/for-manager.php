<?php
/** our-services/for-manager — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$P = [
  'hero_tagline' => 'Nâng tầm kỹ năng năng lãnh đạo bằng thông minh cảm xúc (EQ) cho quản lý lãnh đạo, giúp tạo động lực, xây dựng niềm tin và phát huy tối đa tiềm năng đội ngũ',
  'hero_cta' => 'Tham gia chương trình EQ lãnh đạo',
  'pills' => ['Thiết thực.', 'Lấy con người làm trung tâm.', 'Đổi mới.', 'Tác động lâu dài.'],
  'why_h' => 'Tại sao lãnh đạo với Trí tuệ cảm xúc là kỹ năng phải có?',
  'why_paras' => [
    'Các nghiên cứu gần đây của Globe Newswire nêu bật sự thay đổi đáng kể so với các phong cách quản lý thông thường, với hiệu suất làm việc tổng thể tăng đáng kể lên 49%.',
    '75% nhân viên đang phải chịu áp lực lớn nhất trong công việc từ sếp (McKinsey & Company, 2020), dẫn đến 71% nhân viên không có động lực làm việc và đình công để có kết quả tốt hơn (Globe Newswire, 2022).',
  ],
  'impact_h' => 'Chúng tôi giúp thúc đẩy sự phát triển cho doanh nghiệp của bạn',
  'stats' => [
    ['pct' => '37.2%', 'text' => 'Lãnh đạo với Trí tuệ cảm xúc giúp doanh nghiệp tăng trưởng 37,2% trong một năm (Forbes, 2024)'],
    ['pct' => '57%', 'text' => 'Chúng tôi giúp bạn xây dựng một doanh nghiệp bền vững bằng cách tập trung vào phát triển con người một cách bền vững: tăng mức độ gắn kết lên 57% và hiệu suất tăng 20% (Forbes, 2024)'],
    ['pct' => '50%', 'text' => 'Chúng tôi giúp bạn tăng hiệu suất nhóm của mình và giảm đáng kể sự lãng phí nguồn lực lao động đến 50%'],
  ],
  'prog_h' => 'Chương trình lãnh đạo bằng EQ được thiết kế riêng cho đội ngũ quản lý lãnh đạo của từng doanh nghiệp',
  'prog_intro' => 'Chương trình đào tạo của chúng tôi được thiết kế theo phương pháp tiếp cận dựa trên tình huống thực tế (scenario-based approach), kết hợp cùng các hoạt động thảo luận tương tác và coaching, dựa trên mô hình đào tạo lãnh đạo của Trường Harvard Kennedy và Đại học Oxford.',
  'modules' => [
    ['title' => 'Nhận thức bản thân và Phong cách lãnh đạo', 'paras' => ['Khám phá sức ảnh hưởng của các giá trị cốt lõi cá nhân và "lý do" để lãnh đạo thông qua:'], 'bullets' => ['Tự nhận thức bên trong: các giá trị cốt lõi cá nhân có thể dẫn dắt các quyết định, hành động và cách truyền cảm hứng cho người khác như thế nào.', 'Tự nhận thức bên ngoài: thúc đẩy sự phát triển cá nhân và mong muốn thay đổi với sự nhận thức tổng thể từ bản thân và từ môi trường xung quanh.', 'Phong cách lãnh đạo: sử dụng phong cách lãnh đạo phù hợp với môi trường và tình huống sẽ giúp tối ưu năng suất và hiệu suất lãnh đạo.']],
    ['title' => 'Quản lý cảm xúc dành cho lãnh đạo', 'paras' => ['Hiểu được sức mạnh của cảm xúc trong việc lãnh đạo nhóm; học các kỹ năng để quản lý cảm xúc tốt hơn trong các tình huống khó khăn để đưa ra quyết định hiệu quả nhất.']],
    ['title' => 'Hiểu cảm xúc và hành vi của người khác', 'paras' => ['Học các kỹ năng cốt lõi của thông minh cảm xúc để kết nối bằng cảm xúc trong giao tiếp, hiểu được hành vi bên ngoài và mong muốn bên trong của người đối diện, để giao tiếp hiệu quả và đưa ra các quyết định lãnh đạo sáng suốt.']],
    ['title' => 'Xây dựng niềm tin', 'paras' => ['Tìm hiểu các yếu tố xây dựng niềm tin và sự an toàn về mặt tâm lý trong đội nhóm, để tạo nên một môi trường làm việc cởi mở, tích cực và cùng phát triển.']],
    ['title' => 'Quản lý xung đột trong việc lãnh đạo nhóm', 'paras' => ['Khuyến khích sự trái chiều, khác biệt một cách lành mạnh và loại bỏ những xung đột không lành mạnh để đưa sự phát triển đội ngũ lên một tầm cao mới.']],
    ['title' => 'Đưa ra những phản hồi mang tính xây dựng', 'paras' => ['Đưa ra những phản hồi mà mọi người muốn lắng nghe và sẵn sàng muốn thay đổi.']],
    ['title' => 'Kỹ năng khai vấn (coaching) để phát triển nhóm của bạn', 'paras' => ['Phát triển nhóm của bạn một cách bền vững và thúc đẩy họ tích cực làm việc hướng tới các mục tiêu chung.']],
    ['title' => 'Kỹ năng truyền cảm hứng qua câu chuyện', 'paras' => ['Nghệ thuật kể chuyện để truyền cảm hứng và thúc đẩy hành động cho nhà lãnh đạo, sử dụng cấu trúc Public Narrative từ Harvard Kennedy School.']],
    ['title' => 'Gây ảnh hưởng & Thuyết phục', 'paras' => ['Cấu trúc truyền tải thông điệp của bạn một cách hiệu quả và chiến lược tâm lý học để gây ảnh hưởng và tác động tới sự thay đổi hành động của người nghe.']],
    ['title' => 'Kết nối và tạo động lực cho đội nhóm', 'bullets' => ['Động lực cá nhân: hiểu động cơ của cá nhân để thúc đẩy bản thân và đội nhóm của bạn', 'Tạo động lực cho đội nhóm: các kỹ năng động viên và truyền cảm hứng cho nhân viên thông qua các giá trị cá nhân và giá trị tổ chức.', 'Chiến thuật tâm lý để tạo động lực: hiểu khoa học về động lực để nâng cao tinh thần đồng đội.', 'Bài phát biểu truyền động lực của lãnh đạo: động viên và trao quyền cho nhân viên thông qua câu chuyện cá nhân truyền cảm hứng của lãnh đạo.']],
    ['title' => 'Kỹ năng lãnh đạo thế hệ mới bằng EQ', 'paras' => ['Ứng dụng tư duy phù hợp và phong cách giao tiếp lãnh đạo bằng trí tuệ cảm xúc để kết nối và dẫn dắt đội ngũ nhân lực thế hệ mới một cách hiệu quả.']],
    ['title' => 'Kỹ năng lãnh đạo bằng EQ để gia tăng hiệu suất cho team', 'paras' => ['Học kỹ thuật lãnh đạo và giao tiếp bằng trí tuệ cảm xúc để thắt chặt sự gắn kết và thúc đẩy năng suất trong đội ngũ của bạn.']],
  ],
  'curri_cta' => 'Liên hệ ngay với chúng tôi!',
  'tm_title' => 'Đánh giá của các nhà lãnh đạo về khoá học của chúng tôi',
  'people' => [
    ['n' => 'Hung Tran', 'r' => 'Founder GOT IT USA & STEAM for Vietnam', 'q' => 'Khoá học của The New Leaders đã giúp tôi cải thiện kỹ năng của mình ở vị trí lãnh đạo của một startup tỉ đô để có thể tạo động lực & truyền cảm hứng cho team tiến về phía trước. Những điều học được từ khoá học này còn cực kì hữu ích khi tôi thường xuyên là diễn giả trong các sự kiện cộng đồng và là nhà sáng lập của một tổ chức phi chính phủ.'],
    ['n' => 'Kris van Daele', 'r' => 'Giám đốc vận hành - De Heus Vietnam', 'q' => 'Chúng tôi đã liên hệ với The New Leaders để thiết kế chương trình chuyên biệt về kỹ năng lãnh đạo dựa trên EQ để phát triển đội ngũ quản lý của chúng tôi. Được hỗ trợ bởi kinh nghiệm của họ, 3 nhóm quản lý của chúng tôi đã học cách hiểu hơn về giá trị bên trong họ, hiểu hơn về đồng nghiệp và xây dựng niềm tin trong nhóm. Đây là một cuộc hành trình dài và vẫn đang tiếp diễn, nhưng chắc chắn đáng giá từng phút!'],
    ['n' => 'Sarah Smith', 'r' => 'CEO tại MNC', 'q' => 'Đảm nhận vai trò mới là CEO của công ty thật sự là một thách thức đối với tôi. Tôi chuyển đến một môi trường mới, nơi mọi thứ diễn ra trì trệ hơn so với kỳ vọng của tôi. Đôi lúc tôi cảm thấy cô đơn và kiệt sức nhưng Ngân đã giúp tôi củng cố kỹ năng lãnh đạo của mình, chỉ cho tôi cách để kết nối và dần dần thúc đẩy, truyền cảm hứng cho đội ngũ. Thực hành những kỹ năng lãnh đạo bằng EQ quả thật không phải điều dễ dàng, nhưng thật sự nó rất hiệu quả. Cảm ơn Ngân vì đã là một phần của hành trình trở thành một nhà lãnh đạo xuất sắc của tôi.'],
    ['n' => 'Peter Mayer', 'r' => 'Cựu CEO tại Tập đoàn khách sạn Lodgis, Cựu CEO Fusion Resorts & Hotels, Cựu CEO Sofitel Legend Metropole Hanoi, Cựu Phó Chủ tịch Bất động sản J.P Morgan Châu Á, MBA Harvard', 'q' => 'Điều tạo nên sự khác biệt giữa Quản lý và Nhà lãnh đạo thành công không phải là năng lực chuyên môn của họ mà là khả năng kết nối với mọi người. Hiển nhiên là các CEO thường có tư duy chiến lược và kỹ năng tài chính rất tốt. Nhưng chính kỹ năng EQ sắc bén của họ mới là yếu tố thúc đẩy đội ngũ của họ. Chương trình coaching cho lãnh đạo điều hành từ The New Leaders giúp phát triển và trau dồi khả năng thiết yếu này.'],
  ],
  'whyus_h' => 'Điều khiến chúng tôi khác biệt?',
  'whyus_lead' => 'Chúng tôi cung cấp các chương trình đào tạo:',
  'whyus' => [
    ['title' => 'Dựa trên các chương trình đào tạo lãnh đạo hàng đầu trên thế giới', 'desc' => 'Tổ chức giáo dục tiên phong tại Việt Nam cung cấp các chương trình Đào tạo Lãnh đạo với Trí tuệ Cảm xúc (EQ) dựa trên cấu trúc đào tạo lãnh đạo của trường Đại học Harvard và Đại học Oxford.'],
    ['title' => 'Tầm nhìn nhân lực vươn tầm quốc tế', 'desc' => 'Chúng tôi mang trong mình sứ mệnh nâng tầm kỹ năng giao tiếp bằng Trí tuệ cảm xúc (EQ) cho các nhà lãnh đạo và toàn bộ đội ngũ nhân sự theo chuẩn quốc tế.'],
    ['title' => 'Thiết kế chương trình đào tạo mang tính thực tế', 'desc' => 'Luyện tập thường xuyên là chìa khoá để hình thành và thuần thục kỹ năng. Chính vì vậy, chương trình của chúng tôi được thiết kế với 80% thời lượng đào tạo là thực hành và thảo luận dựa trên các tình huống thực tế trong doanh nghiệp và nhận đánh giá trực tiếp từ chuyên gia để bạn có thể áp dụng trực tiếp những kiến thức đã học vào công việc của mình và cuộc sống hàng ngày.'],
    ['title' => 'Chương trình đào tạo dài hạn mang lại hiệu quả lâu dài', 'desc' => 'Chương trình dài hạn với các hoạt động thực hành liên tục và tham vấn cùng chuyên gia sau workshop đào tạo (tùy theo chương trình) nhằm xây dựng và phát triển kỹ năng giao tiếp bằng trí tuệ cảm xúc (EQ) trong cuộc sống và công việc.'],
  ],
  'cta1' => 'Tham gia chương trình EQ cho lãnh đạo',
  'cta2' => 'Tham gia chương trình EQ cho đội ngũ',
];
} else {
$P = [
  'hero_tagline' => "Advance EQ Leadership skills to inspire trust, foster team motivation and harness the team's potential for leaders & managers.",
  'hero_cta' => 'Join our leadership program',
  'pills' => ['Practical.', 'People-centered.', 'Innovative.', 'Enduring impact.'],
  'why_h' => 'Why EQ leadership training?',
  'why_paras' => [
    'Recent studies by Globe Newswire highlight a significant shift away from the conventional management styles, with a notable 49% decrease in overall work performance.',
    '75% employees are suffering their most stress at work from their bosses (McKinsey & Company, 2020), resulting in 71% employees are not motivated to work and strike for better outcomes (Globe Newswire, 2022).',
  ],
  'impact_h' => 'What impact we could help your business?',
  'stats' => [
    ['pct' => '37.2%', 'text' => 'Emotional Intelligence Leadership unlock 37.2% business growth in one year (Forbes, 2024)'],
    ['pct' => '57%', 'text' => 'We help you build a sustainable business by focusing on sustainable human development: boosting engagement by 57% and performance by 20% (Forbes, 2024)'],
    ['pct' => '50%', 'text' => 'We help you boost your team performance and save significant labor wastes by 50%'],
  ],
  'prog_h' => 'Emotional Intelligence for Leading the New Generations',
  'prog_intro' => 'Our customized training program is designed with scenario-based approach, interactive activities and discussions. The training is designed based on the leadership framework from Harvard Kennedy School and Oxford University.',
  'modules' => [
    ['title' => 'Self-awareness and Leadership Style', 'paras' => ['Explore the influential power of personal core values and the "why" to lead through:'], 'bullets' => ['Internal self-awareness: how personal core values can lead their decisions, actions and inspire others.', 'External self-awareness: foster personal growth as a person and a leader.', 'Leadership style: using suitable leadership styles in the right situations encourage productivity and fruitful results.']],
    ['title' => 'Emotional Management for leaders', 'paras' => ['Understand the power of emotions in leading team; learn the skills to better manage emotions in challenging situations for high quality decision making.']],
    ['title' => "Understanding Others' Emotions and Behaviors", 'paras' => ['A connected team can generate results that goes above and beyond your expectations.', "Learn the core EQ skills to understand others' emotions and behaviors for better communication, build genuine connections and make wise leadership decisions."]],
    ['title' => 'Build trust', 'paras' => ['Learn trust drivers to gauge your trustworthiness and psychological safety in your team.']],
    ['title' => 'Conflict management in leading a team', 'paras' => ['Stimulate healthy and eliminate unhealthy conflicts to develop your team significantly.']],
    ['title' => 'Giving constructive feedbacks', 'paras' => ['Giving feedbacks that people want to listen to & willing to take responsibilities.']],
    ['title' => 'Coaching skills to develop your team', 'paras' => ['Grow your team sustainably and motivate them to actively work toward mutual goals.']],
    ['title' => 'Leadership Storytelling/Public Narrative', 'paras' => ['Learn the leadership storytelling structure from Harvard to connect people via shared values and inspire actions for changes.']],
    ['title' => 'Influence & Persuasion', 'paras' => ['Deliver your message effectively to engage and inspire your team to make impacts.']],
    ['title' => 'Team Connection & Motivation', 'bullets' => ["Self-motivation: understand individual's motivators to motivate yourself and your team", 'Team Motivation and Connection: motivating and inspiring your employees through shared values.', "Psychological tactics for motivation: understand the science of motivation to improve the team's spirit.", "Leadership motivational speech: motivate and empower employees through leaders' personal stories."]],
    ['title' => 'Emotional Intelligence for Leading the New Generations', 'paras' => ['Adopt the new mindset, and learn Emotional Intelligence Leadership styles and communication techniques to connect and lead the new generations effectively.']],
  ],
  'curri_cta' => 'Contact us',
  'tm_title' => 'Our leaders say about the experience',
  'people' => [
    ['n' => 'Nguyen Van Cong', 'r' => 'CEO - Wellbeing Vietnam', 'q' => 'The workshop from The New Leaders opened my eyes to a wealth of knowledge and communication techniques that were completely new to me.'],
    ['n' => 'Kris van Daele', 'r' => 'Operations Director - De Heus Vietnam', 'q' => "Developing from junior managers to senior managers is a long growing path. We reached out to The New Leaders who provide customized training in EQ management to grow our team. Supported by their experience, 3 of our teams have learned to know their inner person, the inner person of their coworkers and build trust within the team. Understanding each other's emotions better helped the teams to grow and elaborate more. A journey that took months and is still ongoing, but certainly worth every minute!"],
    ['n' => 'Pham Thi Hoai', 'r' => 'HR Director - T.A Viet Nam', 'q' => "Emotional Intelligence (EQ) is pivotal for business success today, regardless of size. The New Leaders' workshop has boosted EQ and leadership skills among managers and leaders, fostering strong, competitive leadership within our organization."],
    ['n' => 'Hoang Viet Dung', 'r' => 'Director - Grant Thornton Vietnam', 'q' => 'The New Leaders course holds immense value because leaders in higher positions face increased demands for emotional intelligence skills. Being conscious of this fact is essential for optimal performance.'],
    ['n' => 'Hang Nguyen', 'r' => 'Marketing & Communication Manager, VinaCaptial Foundation', 'q' => 'Anyone, especially people working in the humanitarian field, should acquire these skills to improve the quality of their communication, leading to further accomplishments in their career.'],
  ],
  'whyus_h' => 'Why us?',
  'whyus_lead' => 'We are distinguished from others because we provide:',
  'whyus' => [
    ['title' => 'Worldwide recognized-quality Leadership Programs', 'desc' => "The leading educational organization in Vietnam provides Emotional Intelligence (EQ) Leadership Training programs based on Harvard Oxford University's Leadership Frameworks."],
    ['title' => 'World-class Working Standard Vision', 'desc' => 'Our mission is to advance EQ Communication skills to a world-class standard for leaders and their team members.'],
    ['title' => 'Practical Training Program Design', 'desc' => 'As skills need to be practiced to master them, the program will be designed with 80% of the training is to practice, discuss and get coaching directly based on real & practical case scenarios in business so that you can apply directly the gained knowledge to your daily work.'],
    ['title' => 'Long-term program to make real impacts', 'desc' => 'Long term follow-up & coaching (varied per program) by our coach/trainers and technology/AI after the training workshop to support them to build and develop their EQ Communication skills in life and at work.'],
  ],
  'cta1' => 'Join Customized Leadership Program',
  'cta2' => 'Join Programs for Team members',
];
}
include locate_template('template-parts/pages/_program-detail.php');
