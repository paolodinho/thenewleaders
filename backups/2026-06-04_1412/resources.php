<?php
/** Trang Đánh giá & Tài nguyên (Resources) — verbatim từ live (EN/VI) */
$vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');

if ($vi) {
$T = [
  'lead1'   => 'Tận hưởng hành trình khám phá Trí tuệ Cảm xúc (EQ) với bài đăng trên blog, các tài liệu và công cụ hỗ trợ của chúng tôi!',
  'scroll'  => 'Kéo xuống để tìm hiểu thêm.',
  'lead2'   => 'Khai phá sức mạnh của Khả năng lãnh đạo EQ bằng các tài liệu và công cụ toàn diện của chúng tôi!',
  'tabs'    => ['Blog', 'Thư viện', 'Công cụ hỗ trợ'],
  'blog_h'  => 'Blog',
  'blog'    => [
    'Khi đội ngũ im lặng, tổ chức bắt đầu rạn nứt',
    'Đổi tư duy, thay kết quả',
    'Hiệu suất đội ngũ không chỉ đến từ KPI — mà đến từ cảm xúc',
    'Mưa bão, nhân viên xin off, sếp EQ cao sẽ nói gì?',
    '5 biểu hiện của sếp có EQ "cần cải thiện"',
    'Nhân viên không cần sếp luôn "công tư phân minh"',
    'KHI MỸ ĐÀM PHÁN, HỌ KHÔNG CHƠI CỜ VUA – MÀ LÀ POKER',
    'Tái khởi động đội nhóm: Đừng để năm mới bắt đầu bằng sự ì trệ!',
  ],
  'lib_h'   => 'Thư viện tài liệu Lãnh đạo EQ',
  'lib_more'=> 'Tìm hiểu thêm',
  'tools_h' => 'Công cụ hỗ trợ',
  'tools'   => [
    ['n' => 'FONOS', 'd' => 'Ứng dụng cung cấp sách nói, tóm tắt sách, và các nội dung âm thanh chất lượng cao, giúp bạn học hỏi và giải trí mọi lúc mọi nơi.'],
    ['n' => 'Audible', 'd' => 'Ứng dụng cung cấp sách nói, podcast và nội dung âm thanh đa dạng, với thư viện quốc tế khổng lồ và tính năng nghe offline, mang đến trải nghiệm nghe phong phú mọi lúc mọi nơi.'],
    ['n' => 'Shopee', 'd' => 'Nền tảng thương mại điện tử hàng đầu tại Đông Nam Á, cung cấp hàng triệu sản phẩm đa dạng và tiện lợi mua sắm trực tuyến.'],
    ['n' => 'Coursera', 'd' => 'Nền tảng học trực tuyến, cung cấp hàng ngàn khóa học và chứng chỉ từ các trường đại học và tổ chức danh tiếng.'],
    ['n' => 'FAHASA', 'd' => 'Hệ thống bán lẻ sách lớn tại Việt Nam, cung cấp đa dạng sách, văn phòng phẩm và sản phẩm liên quan.'],
    ['n' => 'Alpha Books', 'd' => 'Nhà xuất bản hàng đầu tại Việt Nam, chuyên cung cấp sách chất lượng về giáo dục, kinh doanh và phát triển cá nhân.'],
  ],
];
} else {
$T = [
  'lead1'   => 'Enjoy the journey of exploring Emotional Intelligence (EQ) with our blog post, supporting materials and tools!',
  'scroll'  => 'Keep scrolling for more!',
  'lead2'   => 'Unlock the power of EQ Leadership with our comprehensive materials and tools!',
  'tabs'    => ['Our Blog', 'The library', 'Supporting Tools'],
  'blog_h'  => 'Our Blog',
  'blog'    => [
    'Khi đội ngũ im lặng, tổ chức bắt đầu rạn nứt',
    'Đổi tư duy, thay kết quả',
    'Hiệu suất đội ngũ không chỉ đến từ KPI — mà đến từ cảm xúc',
    'Mưa bão, nhân viên xin off, sếp EQ cao sẽ nói gì?',
    '5 biểu hiện của sếp có EQ "cần cải thiện"',
    'Nhân viên không cần sếp luôn "công tư phân minh"',
    'KHI MỸ ĐÀM PHÁN, HỌ KHÔNG CHƠI CỜ VUA – MÀ LÀ POKER',
    "Team Restart: Don't Let the New Year Begin with Stagnation!",
  ],
  'lib_h'   => 'The EQ Leadership Library',
  'lib_more'=> 'Learn more',
  'tools_h' => 'Supporting Tools',
  'tools'   => [
    ['n' => 'FONOS', 'd' => 'The platform for audiobooks and podcasts, perfect for enjoying inspirational stories and educational content on the go.'],
    ['n' => 'Audible', 'd' => 'The ultimate audiobook and podcast service by Amazon, offering a vast library of books and exclusive content for book lovers.'],
    ['n' => 'Shopee', 'd' => 'The online learning platform offering courses from top universities and institutions, perfect for advancing your career or exploring new interests.'],
    ['n' => 'Coursera', 'd' => 'The online learning platform offering courses from top universities and institutions, perfect for advancing your career or exploring new interests.'],
    ['n' => 'FAHASA', 'd' => 'Leading book retail system in Vietnam, providing a variety of books, stationery and related products.'],
    ['n' => 'Alpha Books', 'd' => 'Leading publisher in Vietnam, specializing in providing quality books on education, business and personal development.'],
  ],
];
}
$tools_anchors = ['#blog', '#library', '#tools'];

/* Ảnh blog (thứ tự khớp cả EN/VI) — kéo từ live */
$media = get_template_directory_uri() . '/assets/media/blog/';
$blog_imgs = [
    $media . '571135366_10238738229575339_2131594489788019463_n_4154f6840d.jpg',
    $media . 'Size_vuong_eb87cb841d.png',
    $media . 'Dopamine_Thap_678b521bf3.png',
    $media . 'Image_03_10_2025_at_14_39_e36951a7cb.jpeg',
    $media . '40_6dca95d84a.png',
    $media . '543056423_1342889727838456_4964845161702234963_n_4d3401ed37.jpg',
    $media . '489051529_1063902545764159_4132571832738208689_n_2c76ddae9f.jpg',
    $media . 'banner_desktop_efb6dea7c1.png',
];
?>
<main class="site-main page-resources">

  <!-- Hero -->
  <section class="res-hero section">
    <div class="container">
      <p class="res-hero__lead"><?php echo esc_html($T['lead1']); ?></p>
      <p class="res-hero__scroll"><?php echo esc_html($T['scroll']); ?></p>
      <h1 class="res-hero__title"><?php echo esc_html($T['lead2']); ?></h1>

      <nav class="res-tabs" aria-label="Resources">
        <?php foreach ($T['tabs'] as $i => $tab) : ?>
          <a href="<?php echo $tools_anchors[$i]; ?>" class="res-tab"><?php echo esc_html($tab); ?></a>
        <?php endforeach; ?>
      </nav>
    </div>
  </section>

  <!-- Blog -->
  <section class="res-block section" id="blog">
    <div class="container">
      <h2 class="res-block__title"><?php echo esc_html($T['blog_h']); ?></h2>
      <div class="res-blog">
        <?php foreach ($T['blog'] as $i => $post) : ?>
          <a href="<?php echo esc_url(tnl_url('contact')); ?>" class="res-post">
            <span class="res-post__thumb">
              <?php if (!empty($blog_imgs[$i])) : ?>
                <img src="<?php echo esc_url($blog_imgs[$i]); ?>" alt="<?php echo esc_attr($post); ?>" loading="lazy">
              <?php endif; ?>
            </span>
            <span class="res-post__title"><?php echo esc_html($post); ?></span>
          </a>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Library -->
  <section class="res-library section" id="library">
    <div class="container res-library__inner">
      <h2 class="res-library__title"><?php echo esc_html($T['lib_h']); ?></h2>
      <a href="<?php echo esc_url(tnl_url('contact')); ?>" class="btn btn--primary res-library__more"><?php echo esc_html($T['lib_more']); ?></a>
    </div>
  </section>

  <!-- Supporting Tools -->
  <section class="res-block section" id="tools">
    <div class="container">
      <h2 class="res-block__title"><?php echo esc_html($T['tools_h']); ?></h2>
      <div class="res-tools">
        <?php foreach ($T['tools'] as $tool) : ?>
          <article class="res-tool">
            <h3 class="res-tool__name"><?php echo esc_html($tool['n']); ?></h3>
            <p class="res-tool__desc"><?php echo esc_html($tool['d']); ?></p>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <?php get_template_part('template-parts/home/partners'); ?>
  <?php get_template_part('template-parts/home/newsletter'); ?>

</main>
