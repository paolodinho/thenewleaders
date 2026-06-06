<?php
/**
 * Lightweight i18n cho theme (EN/VI) — không cần plugin.
 * Ngôn ngữ theo URL path: /en/ và /vi/ (giống cấu trúc site live), lưu cookie, mặc định 'en'.
 * Trang gốc "/" tự chuyển hướng sang /en/ (hoặc /vi/ theo cookie).
 * Dùng: tnl_t('key') trong template. Chuỗi có HTML → echo trực tiếp (nội dung tin cậy).
 */

if (!defined('ABSPATH')) exit;

/* Đăng ký query var để rewrite truyền ngôn ngữ */
add_filter('query_vars', function ($v) { $v[] = 'tnl_lang'; return $v; });

/* Rewrite: /en/ và /vi/ -> trang chủ tĩnh + tnl_lang. Flush 1 lần khi version đổi. */
add_action('init', function () {
    $front = (int) get_option('page_on_front');
    if ($front) {
        add_rewrite_rule('^(en|vi)/?$', 'index.php?page_id=' . $front . '&tnl_lang=$matches[1]', 'top');
    }
    // Mọi trang con: /en/{slug} hoặc /vi/{slug}/{child} -> pagename + tnl_lang
    add_rewrite_rule('^(en|vi)/(.+?)/?$', 'index.php?pagename=$matches[2]&tnl_lang=$matches[1]', 'top');

    if (get_option('tnl_rewrite_v') !== '5') {
        flush_rewrite_rules(false);
        update_option('tnl_rewrite_v', '5');
    }
});

/* Không để WP canonical strip mất prefix /en /vi */
add_filter('redirect_canonical', function ($redirect) {
    return get_query_var('tnl_lang') ? false : $redirect;
});

/* Lưu cookie theo path + chuyển hướng "/" sang /{lang}/ */
add_action('template_redirect', function () {
    $qv = get_query_var('tnl_lang');
    if ($qv && in_array($qv, ['en', 'vi'], true)) {
        if (($_COOKIE['tnl_lang'] ?? '') !== $qv && !headers_sent()) {
            setcookie('tnl_lang', $qv, time() + YEAR_IN_SECONDS, '/');
        }
        $_COOKIE['tnl_lang'] = $qv;
        return;
    }
    // Trang chủ gốc chưa có prefix -> chuyển sang /{lang}/
    if (is_front_page()) {
        $lang = (isset($_COOKIE['tnl_lang']) && in_array($_COOKIE['tnl_lang'], ['en', 'vi'], true)) ? $_COOKIE['tnl_lang'] : 'en';
        wp_safe_redirect(home_url('/' . $lang . '/'));
        exit;
    }
});

/* Đặt thuộc tính lang cho <html> theo ngôn ngữ đang chọn */
add_filter('language_attributes', function ($output) {
    $code = (tnl_lang() === 'vi') ? 'vi' : 'en';
    if (preg_match('/lang="[^"]*"/', $output)) {
        return preg_replace('/lang="[^"]*"/', 'lang="' . $code . '"', $output);
    }
    return $output . ' lang="' . $code . '"';
});

/* Ngôn ngữ hiện tại: path -> ?lang (fallback) -> cookie -> 'en' */
function tnl_lang() {
    static $lang = null;
    if ($lang !== null) return $lang;
    $qv = get_query_var('tnl_lang');
    if ($qv && in_array($qv, ['en', 'vi'], true)) {
        $lang = $qv;
    } elseif (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'vi'], true)) {
        $lang = $_GET['lang'];
    } elseif (isset($_COOKIE['tnl_lang']) && in_array($_COOKIE['tnl_lang'], ['en', 'vi'], true)) {
        $lang = $_COOKIE['tnl_lang'];
    } else {
        $lang = 'en';
    }
    return $lang;
}

/* URL chuyển ngôn ngữ: giữ nguyên trang hiện tại, chỉ đổi prefix /en/ /vi/ */
function tnl_lang_url($target) {
    $path = '';
    if (!is_front_page() && (is_page() || is_singular())) {
        $obj = get_queried_object();
        if ($obj && !empty($obj->ID)) {
            $uri = get_page_uri($obj->ID); // path phân cấp: parent/child
            if ($uri) $path = $uri . '/';
        }
    }
    return esc_url(home_url('/' . $target . '/' . $path));
}

/* Đường dẫn nội bộ có prefix ngôn ngữ hiện tại: tnl_url('contact') -> /vi/contact/ */
function tnl_url($slug = '') {
    $slug = trim($slug, '/');
    return esc_url(home_url('/' . tnl_lang() . '/' . ($slug ? $slug . '/' : '')));
}

/* Lấy chuỗi theo ngôn ngữ */
function tnl_t($key) {
    static $S = null;
    if ($S === null) $S = tnl_strings();
    $lang = tnl_lang();
    if (isset($S[$lang][$key])) return $S[$lang][$key];
    if (isset($S['en'][$key])) return $S['en'][$key];
    return '';
}

/* Dịch nhãn menu (EN title -> VI) */
function tnl_nav_label($title) {
    if (tnl_lang() !== 'vi') return $title;
    // chuẩn hoá: decode &amp; / &#038; về & để khớp map
    $key = trim(html_entity_decode($title, ENT_QUOTES | ENT_HTML5));
    $map = [
        'Home Page'               => 'Trang chủ',
        'Our Services & Products'  => 'Sản phẩm & Dịch vụ',
        'Assessment & Resources'   => 'Đánh giá & Tài nguyên',
        'Events'                   => 'Sự kiện',
        'Newsletter'               => 'Bản tin',
        'Contact'                  => 'Liên hệ',
        'Careers'                  => 'Tuyển dụng',
    ];
    return $map[$key] ?? $title;
}

/* Toàn bộ chuỗi */
function tnl_strings() {
    return [
        'en' => [
            // hero
            'hero_unmute'   => 'Unmute',
            'hero_skip'     => 'Skip to site',
            'hero_tagline'  => 'Become inspiring leaders to lead the change',
            'hero_btn1'     => 'Join Customized Leadership Program',
            'hero_btn2'     => 'Join Programs for Team members',
            // what we help
            'wwh_title' => 'What we<br>can help',
            'wwh_p1'    => 'Many leaders find it challenging in connecting people and inspiring them to take action. Using only rational arguments and statistic data to convince people rarely works.',
            'wwh_p2'    => 'We believe that if we want people to join us to adopt new ideas and embrace change, <span class="wwh-kw wwh-kw--teal">emotional intelligence</span> is a powerful tool to <span class="wwh-kw wwh-kw--green">connect</span> and <span class="wwh-kw wwh-kw--amber">inspire</span> people to <span class="wwh-kw wwh-kw--orange">take action</span>.',
            'wwh_p3'    => 'We will help you to develop these powerful skills.',
            // what we do
            'wwd_title' => 'What<br>we do',
            'wwd_desc'  => 'Emotional Intelligence Leadership Training with frameworks from worldwide accredited leadership programs of <strong>Harvard Kennedy School and Oxford University.</strong>',
            'wwd_pill1' => 'Practical.',
            'wwd_pill2' => 'People-centered.',
            'wwd_pill3' => 'Innovative.',
            'wwd_pill4' => 'Enduring impact',
            'wwd_offer_eyebrow' => 'What we offer',
            'wwd_offer_title'   => 'Our Services & Products',
            'wwd_offer_note'    => 'Four ways we partner with leaders and teams to create lasting impact.',
            'wwd_learn_more' => 'Learn more',
            'card1_title' => 'Business Programs:',
            'card1_desc'  => 'We customize EQ leadership & communication training programs for business leaders and their team members.',
            'card2_title' => 'Individuals programs:',
            'card2_desc'  => 'We support leaders to advance their communication skills to world-class standard.',
            'card3_title' => 'Creative innovative products:',
            'card3_desc'  => 'We create creative educational & technology / AI products to support business and individual transformation.',
            'card4_title' => 'Supportive community:',
            'card4_desc'  => 'We encourage leaders to share their expertise and inspire others to create supportive environment.',
            // testimonials
            'tm_title' => 'Our leaders say about the experience',
            't1_role' => 'Head of Business - Boehringer Ingelheim Vietnam',
            't1_quote'=> 'Leaders greatly benefit from understanding emotional management, as mastering one\'s own emotions and listening effectively can significantly ease the journey of life.',
            't2_role' => 'Operations Director - De Heus Vietnam',
            't2_quote'=> 'Developing from junior managers to senior managers is a long growing path. We reached out to The New Leaders who provide customized training in EQ management to grow our team. Supported by their experience, 3 of our teams have learned to know their inner person, the inner person of their coworkers and build trust within the team. Understanding each other\'s emotions better helped the teams to grow and elaborate more. A journey that took months and is still ongoing, but certainly worth every minute!',
            't3_role' => 'HR Director - T.A Viet Nam',
            't3_quote'=> 'Emotional Intelligence (EQ) is pivotal for business success today, regardless of size. The New Leaders\' workshop has boosted EQ and leadership skills among managers and leaders, fostering strong, competitive leadership within our organization.',
            't4_role' => 'Director - Grant Thornton Vietnam',
            't4_quote'=> 'The New Leaders course holds immense value because leaders in higher positions face increased demands for emotional intelligence skills. Being conscious of this fact is essential for optimal performance.',
            't5_role' => 'Former CEO Lodgis Hospitality Holdings, Former CEO Fusion Resorts & Hotels, Former CEO Sofitel Legend Metropole Hanoi, MBA Harvard',
            't5_quote'=> 'What separates successful Leaders and Managers are not THEIR technical COMPETENCE, but the ability to connect to their people. Of course, CEO\'s often have great strategic thinking and financial skills, but it is their sharp EQ that drives their organizations. The executive coaching from The New Leaders develop and hone this essential capability.',
            't6_role' => 'Head of Research Department at VNDIRECT Securities Corporation',
            't6_quote'=> 'Ngan has really helped me to be a better leader. She is a great listener and draws upon a wealth of knowledge and experience to offer insightful, practical advice to guide me in facing problems and inspiring my team to perform and develop.',
            // about
            'about_title'   => 'About us',
            'about_mission' => 'Our mission is to advance EQ Leadership &amp; Communication skills to a world-class standard for leaders and their team members.',
            'about_p1' => 'We constantly strive for improvement in everything we do, knowing that improvement is always possible.',
            'about_p2' => 'We take an evidence-led approach to challenging convention and we are courageous enough to change the status quo.',
            'about_p3' => 'We are the drivers of change.',
            'about_p4' => 'We bring global leadership frameworks to Vietnamese leaders and organisations.',
            // why us
            'whyus_title' => 'Why us?',
            'whyus_lead'  => 'We are distinguished from others because we provide:',
            'whyus1_title'=> 'Worldwide recognized-quality Leadership Programs',
            'whyus1_desc' => 'The leading educational organization in Vietnam provides Emotional Intelligence (EQ) Leadership Training programs based on Harvard Business School and Oxford University\'s Leadership Frameworks.',
            'whyus2_title'=> 'World-class Working Standard Vision',
            'whyus2_desc' => 'Our mission is to advance EQ Communication skills to a world-class standard for leaders and their team members.',
            'whyus3_title'=> 'Practical Training Program Design',
            'whyus3_desc' => 'As skills need to be practiced to master them, the program will be designed with 80% of the training is to practice, discuss and get coaching directly based on real & practical case scenarios in business so that you can apply directly the gained knowledge to your daily work.',
            'whyus4_title'=> 'Long-term program to make real impacts',
            'whyus4_desc' => 'Long term follow-up & coaching (varied per program) by our coach/trainers and technology/AI after the training workshop to support them to build and develop their EQ Communication skills in life and at work.',
            // values
            'values_title' => 'Our<br>Values',
            'val1_title'=> 'Leadership',   'val1_desc'=> 'We are leading in NEW leadership mindset.',
            'val2_title'=> 'Respect',      'val2_desc'=> 'We respect people\'s stories, values and backgrounds.',
            'val3_title'=> 'Inclusiveness','val3_desc'=> 'We strive to offer skills to anyone who has potential to be great leaders for great purpose.',
            'val4_title'=> 'Authenticity', 'val4_desc'=> 'What we do is based on our true values.',
            'val5_title'=> 'Optimism',     'val5_desc'=> 'We are optimistic about the better futures created by value-driven leaders.',
            // growing
            'growing_title' => 'Growing together',
            'growing_desc'  => 'A thriving online community of likeminded peers who\'ll help you get clear on your next move and provide the support you need to make it happen.',
            // partners
            'partners_title' => 'Hear it from<br>our partners',
            'partners_desc'  => 'We\'re trusted by leading educational institutes, NGOs, startups and corporates to strengthen leadership and create changes in their businesses and society.',
            // newsletter
            'nl_title'  => 'Want Leadership &amp; EQ materials &amp; updates sent straight to your inbox?',
            'nl_name'   => 'Name:',
            'nl_email'  => 'Email:',
            'nl_submit' => 'Submit',
            // cta / footer
            'cta_w1' => 'Connect.', 'cta_w2' => 'Inspire.', 'cta_w3' => 'Lead.', 'cta_w4' => 'Pioneer.',
            'cta_heading' => 'Get in touch',
            'cta_lang'    => 'Language:',
            'copyright'   => 'All rights reserved.',
        ],

        'vi' => [
            // hero
            'hero_unmute'   => 'Bật tiếng',
            'hero_skip'     => 'Bỏ qua',
            'hero_tagline'  => 'Trở thành nhà lãnh đạo truyền cảm hứng ngay hôm nay!',
            'hero_btn1'     => 'Tham gia chương trình EQ cho lãnh đạo',
            'hero_btn2'     => 'Tham gia chương trình EQ cho đội ngũ',
            // what we help
            'wwh_title' => 'Chúng tôi hỗ trợ<br>các nhà lãnh đạo',
            'wwh_p1'    => 'Số liệu, lý lẽ, lập luận khô khan... kể cả có đúng về mặt logic, hiếm khi có thể hoàn toàn thuyết phục để đội ngũ cống hiến và tạo ra những sự đột phá. Kết nối, xây dựng niềm tin và truyền cảm hứng cho đội nhóm là thách thức đối với nhiều lãnh đạo của thời đại mới. Vậy phải làm khác đi như thế nào?',
            'wwh_p2'    => 'The New Leaders tin rằng <span class="wwh-kw wwh-kw--teal">Trí tuệ cảm xúc (EQ)</span> chính là một công cụ đắc lực để các nhà lãnh đạo có thể <span class="wwh-kw wwh-kw--green">kết nối</span>, <span class="wwh-kw wwh-kw--amber">truyền cảm hứng và tạo động lực</span> cho đội ngũ <span class="wwh-kw wwh-kw--orange">hành động</span> để đạt được mục tiêu với hiệu suất cao.',
            'wwh_p3'    => 'Hãy để The New Leaders giúp bạn phát triển những kỹ năng ưu việt này!',
            // what we do
            'wwd_title' => 'Chúng tôi sẽ<br>giúp bạn như thế nào?',
            'wwd_desc'  => 'Mang đến chương trình đào tạo kỹ năng lãnh đạo bằng Trí tuệ cảm xúc (EQ) thiết kế dựa trên cấu trúc các chương trình đào tạo lãnh đạo danh tiếng thế giới từ <strong>trường Đại học Harvard và Đại học Oxford</strong> tới Việt Nam.',
            'wwd_pill1' => 'Thiết thực.',
            'wwd_pill2' => 'Lấy con người làm trung tâm.',
            'wwd_pill3' => 'Đổi mới.',
            'wwd_pill4' => 'Tác động lâu dài.',
            'wwd_offer_eyebrow' => 'Chúng tôi cung cấp',
            'wwd_offer_title'   => 'Sản phẩm & Dịch vụ',
            'wwd_offer_note'    => 'Bốn cách chúng tôi đồng hành cùng lãnh đạo và đội ngũ để tạo tác động lâu dài.',
            'wwd_learn_more' => 'Tìm hiểu thêm',
            'card1_title' => 'Chương trình dành cho Doanh nghiệp:',
            'card1_desc'  => 'Chúng tôi thiết kế chương trình đào tạo kỹ năng giao tiếp và lãnh đạo bằng trí tuệ cảm xúc (EQ) chuyên biệt cho mỗi doanh nghiệp (cho quản lý và cho các thành viên trong đội ngũ).',
            'card2_title' => 'Chương trình dành cho Cá nhân:',
            'card2_desc'  => 'Chúng tôi hỗ trợ các nhà lãnh đạo nâng cao kỹ năng giao tiếp theo tiêu chuẩn quốc tế.',
            'card3_title' => 'Sản phẩm sáng tạo và đổi mới:',
            'card3_desc'  => 'Các sản phẩm giáo dục sáng tạo và các sản phẩm sử dụng công nghệ/Trí tuệ nhân tạo để thúc đẩy sự cải tiến trong doanh nghiệp và cho từng cá nhân.',
            'card4_title' => 'Cộng đồng các nhà lãnh đạo tân tiến:',
            'card4_desc'  => 'Cộng đồng để các nhà lãnh đạo chia sẻ kiến thức chuyên môn và truyền cảm hứng cho mọi người xung quanh và cùng nhau thực hiện những thay đổi tích cực.',
            // testimonials
            'tm_title' => 'Đánh giá của các nhà lãnh đạo về khoá học của chúng tôi',
            't1_role' => 'Giám đốc Kinh doanh - Boehringer Ingelheim Việt Nam',
            't1_quote'=> 'Các nhà lãnh đạo được hưởng lợi rất nhiều từ việc hiểu biết về quản lý cảm xúc, vì việc làm chủ cảm xúc của chính mình và lắng nghe hiệu quả có thể giúp hành trình cuộc sống trở nên dễ dàng hơn đáng kể.',
            't2_role' => 'Giám đốc Vận hành - De Heus Việt Nam',
            't2_quote'=> 'Chúng tôi đã liên hệ với The New Leaders để thiết kế chương trình chuyên biệt về kỹ năng lãnh đạo dựa trên EQ nhằm phát triển đội ngũ quản lý. Nhờ kinh nghiệm của họ, 3 đội nhóm của chúng tôi đã học cách thấu hiểu bản thân, thấu hiểu đồng nghiệp và xây dựng niềm tin trong đội. Hiểu cảm xúc của nhau giúp các đội phát triển hơn — một hành trình kéo dài nhiều tháng và vẫn đang tiếp diễn, nhưng thực sự xứng đáng từng phút!',
            't3_role' => 'Giám đốc Nhân sự - T.A Việt Nam',
            't3_quote'=> 'Trí tuệ cảm xúc (EQ) đóng vai trò then chốt cho thành công của doanh nghiệp ngày nay, bất kể quy mô. Workshop của The New Leaders đã nâng cao EQ và kỹ năng lãnh đạo cho quản lý và lãnh đạo, xây dựng năng lực lãnh đạo mạnh mẽ và cạnh tranh trong tổ chức.',
            't4_role' => 'Giám đốc - Grant Thornton Việt Nam',
            't4_quote'=> 'Khóa học của The New Leaders mang lại giá trị to lớn vì các nhà lãnh đạo ở vị trí cao hơn phải đối mặt với những yêu cầu ngày càng tăng về kỹ năng trí tuệ cảm xúc. Ý thức được điều này là yếu tố thiết yếu để đạt hiệu suất tối ưu.',
            't5_role' => 'Cựu CEO Lodgis Hospitality Holdings, Cựu CEO Fusion Resorts & Hotels, Cựu CEO Sofitel Legend Metropole Hà Nội, MBA Harvard',
            't5_quote'=> 'Điều tạo nên sự khác biệt giữa Quản lý và Nhà lãnh đạo thành công không phải là năng lực chuyên môn, mà là khả năng kết nối với con người. Tất nhiên, các CEO thường có tư duy chiến lược và kỹ năng tài chính xuất sắc, nhưng chính EQ nhạy bén mới dẫn dắt tổ chức của họ. Chương trình huấn luyện điều hành của The New Leaders phát triển và mài giũa năng lực thiết yếu này.',
            't6_role' => 'Giám đốc Nghiên cứu - VNDIRECT Securities Corporation',
            't6_quote'=> 'Ngân đã thực sự giúp tôi trở thành một nhà lãnh đạo tốt hơn. Cô ấy biết lắng nghe và dựa trên kiến thức cùng kinh nghiệm phong phú để đưa ra những lời khuyên sâu sắc, thiết thực, giúp tôi đối mặt với vấn đề và truyền cảm hứng cho đội ngũ phát triển.',
            // about
            'about_title'   => 'Về chúng tôi',
            'about_mission' => 'The New Leaders mang trong mình sứ mệnh hỗ trợ các nhà lãnh đạo và các thành viên trong đội ngũ của họ nâng cao kỹ năng lãnh đạo &amp; giao tiếp bằng Trí tuệ cảm xúc (EQ) để vươn tầm quốc tế',
            'about_p1' => 'Chúng tôi không ngừng nỗ lực cải thiện và phát triển bởi chúng tôi tin rằng luôn có cách để làm tốt hơn nữa.',
            'about_p2' => 'Chúng tôi tiếp cận vấn đề dựa trên những bằng chứng nghiên cứu và sẵn sàng để đón đầu những thay đổi.',
            'about_p3' => 'Chúng tôi đi đầu để thúc đẩy sự thay đổi.',
            'about_p4' => 'Chúng tôi mang các cấu trúc đào tạo lãnh đạo toàn cầu đến với các nhà lãnh đạo và tổ chức tại Việt Nam.',
            // why us
            'whyus_title' => 'Điều khiến chúng tôi khác biệt?',
            'whyus_lead'  => 'Chúng tôi khác biệt bởi:',
            'whyus1_title'=> 'Dựa trên các chương trình đào tạo lãnh đạo hàng đầu trên thế giới',
            'whyus1_desc' => 'Tổ chức giáo dục tiên phong tại Việt Nam cung cấp các chương trình Đào tạo Lãnh đạo với Trí tuệ Cảm xúc (EQ) dựa trên cấu trúc đào tạo lãnh đạo của trường Đại học Harvard và Đại học Oxford.',
            'whyus2_title'=> 'Tầm nhìn nhân lực vươn tầm quốc tế',
            'whyus2_desc' => 'Chúng tôi mang trong mình sứ mệnh nâng tầm kỹ năng giao tiếp bằng Trí tuệ cảm xúc (EQ) cho các nhà lãnh đạo và toàn bộ đội ngũ nhân sự theo chuẩn quốc tế.',
            'whyus3_title'=> 'Thiết kế chương trình đào tạo mang tính thực tế',
            'whyus3_desc' => 'Luyện tập thường xuyên là chìa khoá để hình thành và thuần thục kỹ năng. Chính vì vậy, chương trình của chúng tôi được thiết kế với 80% thời lượng đào tạo là thực hành và thảo luận dựa trên các tình huống thực tế trong doanh nghiệp và nhận đánh giá trực tiếp từ chuyên gia để bạn có thể áp dụng trực tiếp những kiến thức đã học vào công việc của mình và cuộc sống hàng ngày.',
            'whyus4_title'=> 'Chương trình đào tạo dài hạn mang lại hiệu quả lâu dài',
            'whyus4_desc' => 'Chương trình dài hạn với các hoạt động thực hành liên tục và tham vấn cùng chuyên gia sau workshop đào tạo (tùy theo chương trình) nhằm xây dựng và phát triển kỹ năng giao tiếp bằng trí tuệ cảm xúc (EQ) trong cuộc sống và công việc.',
            // values
            'values_title' => 'Những giá trị<br>mà chúng tôi theo đuổi',
            'val1_title'=> 'Lãnh đạo tiên phong', 'val1_desc'=> 'Chúng tôi dẫn đầu về tư duy lãnh đạo kiểu MỚI.',
            'val2_title'=> 'Tôn trọng',            'val2_desc'=> 'Chúng tôi tôn trọng câu chuyện, giá trị và nền tảng của mỗi cá nhân.',
            'val3_title'=> 'Tính toàn diện',        'val3_desc'=> 'Chúng tôi hỗ trợ phát triển kỹ năng cho bất kỳ ai đang hoặc có tiềm năng trở thành nhà lãnh đạo để thực hiện những mục tiêu tốt đẹp của họ.',
            'val4_title'=> 'Tính xác thực',         'val4_desc'=> 'Những gì chúng tôi làm đều dựa trên giá trị đích thực của chúng tôi.',
            'val5_title'=> 'Sự tích cực',           'val5_desc'=> 'Chúng tôi tin tưởng lãnh đạo dựa trên giá trị sống sẽ tạo nên những thay đổi tích cực lâu dài.',
            // growing
            'growing_title' => 'Cùng nhau phát triển',
            'growing_desc'  => 'Cộng đồng trực tuyến quy tụ những người có cùng chí hướng, những người sẽ giúp bạn hiểu rõ bước đi tiếp theo của mình và cung cấp sự hỗ trợ mà bạn cần để đạt được mục tiêu.',
            // partners
            'partners_title' => 'Lắng nghe từ<br>đối tác của chúng tôi',
            'partners_desc'  => 'Chúng tôi được các viện giáo dục, tổ chức phi chính phủ, công ty khởi nghiệp và tập đoàn hàng đầu tin tưởng để tăng cường khả năng lãnh đạo và tạo ra những thay đổi tích cực trong doanh nghiệp và xã hội của họ.',
            // newsletter
            'nl_title'  => 'Nhận ngay các tài liệu và thông tin cập nhật về Lãnh đạo &amp; Trí tuệ cảm xúc (EQ) được gửi thẳng đến hộp thư đến của bạn',
            'nl_name'   => 'Tên:',
            'nl_email'  => 'Email:',
            'nl_submit' => 'Gửi',
            // cta / footer
            'cta_w1' => 'Kết nối.', 'cta_w2' => 'Truyền cảm hứng.', 'cta_w3' => 'Dẫn dắt.', 'cta_w4' => 'Tiên phong.',
            'cta_heading' => 'Liên hệ',
            'cta_lang'    => 'Ngôn ngữ:',
            'copyright'   => 'Bản quyền thuộc về The New Leaders.',
        ],
    ];
}
