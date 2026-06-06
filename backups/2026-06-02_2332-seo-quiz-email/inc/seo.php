<?php
/**
 * SEO: meta description, Open Graph, Twitter Card, canonical, hreflang, JSON-LD.
 * Lang-aware (en/vi). Không cần plugin.
 */
if (!defined('ABSPATH')) exit;

/* Bản đồ title + description theo slug (en/vi). Front page slug = '' */
function tnl_seo_map() {
    return [
        '' => [
            'en' => ['The New Leaders | EQ Leadership & Communication Training', 'Become inspiring leaders. Emotional Intelligence (EQ) Leadership & Communication training based on Harvard Kennedy School & Oxford University frameworks.'],
            'vi' => ['The New Leaders | Đào tạo Lãnh đạo & Giao tiếp bằng EQ', 'Trở thành nhà lãnh đạo truyền cảm hứng. Đào tạo Lãnh đạo & Giao tiếp bằng Trí tuệ Cảm xúc (EQ) theo cấu trúc từ Harvard & Oxford.'],
        ],
        'our-services' => [
            'en' => ['Our Services & Programs', 'Customized EQ Leadership & Communication training programs for managers, teams, executives and individuals.'],
            'vi' => ['Sản phẩm & Dịch vụ', 'Các chương trình đào tạo Lãnh đạo & Giao tiếp bằng EQ thiết kế riêng cho quản lý, đội ngũ, lãnh đạo điều hành và cá nhân.'],
        ],
        'products' => [
            'en' => ['Our Products', 'EQ guidebooks, decks, e-books and calendar to master emotional intelligence with daily practice.'],
            'vi' => ['Sản phẩm', 'Cẩm nang, bộ bài, e-book và lịch EQ giúp làm chủ trí tuệ cảm xúc bằng thực hành mỗi ngày.'],
        ],
        'resources' => [
            'en' => ['Resources & Assessment', 'Blog posts, supporting tools and the EQ library to explore Emotional Intelligence leadership.'],
            'vi' => ['Đánh giá & Tài nguyên', 'Bài viết blog, công cụ hỗ trợ và thư viện EQ để khám phá lãnh đạo bằng Trí tuệ Cảm xúc.'],
        ],
        'events' => [
            'en' => ['EQ Leadership Events', 'Workshops and events to embrace and spread the power of EQ for positive change.'],
            'vi' => ['Sự kiện', 'Các workshop và sự kiện lan tỏa sức mạnh của EQ để tạo ra thay đổi tích cực.'],
        ],
        'eq-quiz' => [
            'en' => ['Free Emotional Intelligence Quiz from Harvard Business Review', 'Take the free 25-question EQ quiz to evaluate your Emotional Intelligence across 5 aspects.'],
            'vi' => ['Bài trắc nghiệm Trí tuệ cảm xúc (EQ) miễn phí', 'Làm bài trắc nghiệm 25 câu miễn phí để đánh giá Trí tuệ Cảm xúc của bạn ở 5 phương diện.'],
        ],
        'newsletter' => [
            'en' => ['Newsletter', 'Elevate your Leadership & Communication skills with just 5 minutes weekly. Actionable EQ tips to your inbox.'],
            'vi' => ['Bản tin', 'Nâng cao kỹ năng Lãnh đạo & Giao tiếp chỉ với 5 phút mỗi tuần. Mẹo EQ hữu ích gửi thẳng hộp thư.'],
        ],
        'contact' => [
            'en' => ['Contact Us', 'Get in touch with The New Leaders for EQ leadership training and coaching.'],
            'vi' => ['Liên hệ', 'Liên hệ The New Leaders để được tư vấn về đào tạo và coaching lãnh đạo bằng EQ.'],
        ],
        'careers' => [
            'en' => ['Careers', 'Join our pioneering team and grow every day while creating meaningful value for the community.'],
            'vi' => ['Tuyển dụng', 'Gia nhập đội ngũ tiên phong, phát triển mỗi ngày và tạo ra giá trị ý nghĩa cho cộng đồng.'],
        ],
        'for-manager' => [
            'en' => ['EQ Leadership for Managers & Leaders', 'Advance EQ Leadership skills to inspire trust, foster team motivation and harness your team\'s potential.'],
            'vi' => ['EQ cho Quản lý & Lãnh đạo', 'Nâng tầm kỹ năng lãnh đạo bằng EQ để tạo động lực, xây dựng niềm tin và phát huy tiềm năng đội ngũ.'],
        ],
        'for-team-member' => [
            'en' => ['EQ Communication for Team Members', 'Cultivate EQ communication skills to enhance team cohesion and optimize performance.'],
            'vi' => ['Giao tiếp EQ cho đội ngũ', 'Tăng cường kỹ năng giao tiếp bằng EQ để gắn kết đội nhóm và tối ưu hiệu suất.'],
        ],
        'executive-coach' => [
            'en' => ['1:1 Executive Coaching with Ngan Tran', 'Personalized executive leadership coaching to elevate your leadership excellence with emotional intelligence.'],
            'vi' => ['Coaching 1:1 cùng Ngân Trần', 'Chương trình coaching lãnh đạo điều hành cá nhân hoá để nâng tầm khả năng lãnh đạo bằng EQ.'],
        ],
        'individual-courses' => [
            'en' => ['Individual EQ Leadership Courses', 'EQ leadership communication courses to speak with impact, influence behaviors and drive meaningful action.'],
            'vi' => ['Khoá học EQ cá nhân', 'Các khoá học giao tiếp lãnh đạo bằng EQ để truyền tải ấn tượng và tạo hành động ý nghĩa.'],
        ],
        'heart-heart-hand' => [
            'en' => ['Head, Heart, Hand — EQ Guidebook for Leaders', 'Elevate your leadership with the EQ model from the world\'s top universities. 9 key EQ topics.'],
            'vi' => ['Head, Heart, Hand — Cẩm nang EQ cho lãnh đạo', 'Mô hình lãnh đạo thành công với Trí tuệ Cảm xúc từ các đại học hàng đầu thế giới. 9 chủ đề EQ.'],
        ],
        'the-story-of-empathy' => [
            'en' => ['The Story of Empathy — E-book', 'An immersive e-book on empathy with music, illustrations and interactive exercises.'],
            'vi' => ['Chuyện về Thấu cảm — E-book', 'Cuốn e-book tương tác về thấu cảm với âm nhạc, hình minh hoạ và bài tập thực hành.'],
        ],
        'the-eq-calendar' => [
            'en' => ['The EQ Calendar 2026', 'A desk calendar and daily EQ leadership companion — 12 months, 12 EQ leadership topics.'],
            'vi' => ['The EQ Calendar 2026', 'Cuốn lịch để bàn kiêm cẩm nang lãnh đạo EQ mỗi ngày — 12 tháng, 12 chủ đề EQ Leadership.'],
        ],
        'eq-with-ngan-tran' => [
            'en' => ['EQ Videos with Ngan Tran', 'Watch leadership journey videos and one-minute EQ insights from Ngan Tran.'],
            'vi' => ['Video EQ cùng Ngân Trần', 'Xem các video hành trình lãnh đạo và mẹo EQ một phút cùng Ngân Trần.'],
        ],
    ];
}

function tnl_seo_current() {
    $lang = function_exists('tnl_lang') ? tnl_lang() : 'en';
    $slug = '';
    if (is_page() && !is_front_page()) {
        $slug = get_post_field('post_name', get_queried_object_id());
    }
    $map = tnl_seo_map();
    $entry = $map[$slug] ?? $map[''];
    $row = $entry[$lang] ?? $entry['en'];
    return [
        'lang'  => $lang,
        'title' => $row[0],
        'desc'  => $row[1],
        'url'   => function_exists('tnl_lang_url') ? tnl_lang_url($lang) : home_url('/'),
        'image' => get_template_directory_uri() . '/assets/media/og-default.png',
    ];
}

/* Title tag */
add_filter('document_title_parts', function ($parts) {
    $s = tnl_seo_current();
    $parts['title'] = $s['title'];
    unset($parts['tagline']);
    $parts['site'] = 'The New Leaders';
    return $parts;
});

/* Meta + OG + Twitter + canonical + hreflang */
add_action('wp_head', function () {
    $s = tnl_seo_current();
    $en = function_exists('tnl_lang_url') ? tnl_lang_url('en') : home_url('/en/');
    $vi = function_exists('tnl_lang_url') ? tnl_lang_url('vi') : home_url('/vi/');
    $locale = $s['lang'] === 'vi' ? 'vi_VN' : 'en_US';
    $e = fn($v) => esc_attr($v);
    echo "\n<!-- TNL SEO -->\n";
    echo '<meta name="description" content="' . $e($s['desc']) . '">' . "\n";
    echo '<link rel="canonical" href="' . esc_url($s['url']) . '">' . "\n";
    echo '<link rel="alternate" hreflang="en" href="' . esc_url($en) . '">' . "\n";
    echo '<link rel="alternate" hreflang="vi" href="' . esc_url($vi) . '">' . "\n";
    echo '<link rel="alternate" hreflang="x-default" href="' . esc_url($en) . '">' . "\n";
    // Open Graph
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:site_name" content="The New Leaders">' . "\n";
    echo '<meta property="og:locale" content="' . $e($locale) . '">' . "\n";
    echo '<meta property="og:title" content="' . $e($s['title']) . '">' . "\n";
    echo '<meta property="og:description" content="' . $e($s['desc']) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($s['url']) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($s['image']) . '">' . "\n";
    // Twitter
    echo '<meta name="twitter:card" content="summary_large_image">' . "\n";
    echo '<meta name="twitter:title" content="' . $e($s['title']) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . $e($s['desc']) . '">' . "\n";
    echo '<meta name="twitter:image" content="' . esc_url($s['image']) . '">' . "\n";
    // JSON-LD Organization (chỉ trang chủ)
    if (is_front_page()) {
        $org = [
            '@context' => 'https://schema.org',
            '@type'    => 'Organization',
            'name'     => 'The New Leaders',
            'url'      => home_url('/'),
            'logo'     => get_template_directory_uri() . '/assets/images/tnl-logo.svg',
            'email'    => 'info@thenewleaders.asia',
            'telephone'=> '(84) 91 666 3670',
            'sameAs'   => [
                'https://www.facebook.com/share/5AUg8xvJDnxr13ub',
                'https://www.linkedin.com/company/thenewleaders-asia',
                'https://youtube.com/@thenewleaders5553',
                'https://www.instagram.com/thenewleaders.asia',
                'https://www.tiktok.com/@thenewleaders.asia',
            ],
        ];
        echo '<script type="application/ld+json">' . wp_json_encode($org, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
    }
    echo "<!-- /TNL SEO -->\n";
}, 1);
