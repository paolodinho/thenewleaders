<?php
/**
 * front-page.php — CLONE MODE
 * Render markup + CSS lấy nguyên từ trang live (thenewleaders.asia) để đạt parity ~100%.
 * Markup tĩnh trong clone/parts/home-{vi,en}.html, CSS trong clone/css/live.css.
 * Asset: images/ -> theme clone uri; S3 (../bucketeer...) -> URL online.
 * Sau khi parity OK sẽ wire lại JS (slider/menu/video) trỏ vào class live.
 */

$clone_uri  = get_template_directory_uri() . '/clone';
$clone_path = get_template_directory() . '/clone';

// VI là front page mặc định. EN home xử lý riêng (markup chưa mirror).
$lang = (function_exists('tnl_lang') && tnl_lang() === 'en') ? 'en' : 'vi';
$markup_file = $clone_path . "/parts/home-$lang.html";
if (!is_readable($markup_file) || filesize($markup_file) === 0) {
    $markup_file = $clone_path . '/parts/home-vi.html';
}
$markup = file_get_contents($markup_file);

// Rewrite đường dẫn asset:
//  - "images/..."          -> "<clone_uri>/images/..."
//  - "../bucketeer-...s3.." -> "https://bucketeer-...s3.." (ảnh/video online)
$s3host = 'bucketeer-4deb826f-734a-4fe9-b45f-0e12646315fb.s3.eu-west-1.amazonaws.com';
$markup = str_replace(
    ['="images/',                    '../' . $s3host . '/'],
    ['="' . $clone_uri . '/images/', 'https://' . $s3host . '/'],
    $markup
);

// Bỏ theme styles (sections/pages/style) trên front page để live.css render thuần.
add_action('wp_head', function () {
    wp_dequeue_style('tnl-sections');
    wp_dequeue_style('tnl-pages');
    wp_dequeue_style('tnl-style');
}, 0);
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo esc_url($clone_uri . '/css/live.css?v=' . filemtime($clone_path . '/css/live.css')); ?>">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php echo $markup; ?>
<script src="<?php echo esc_url($clone_uri . '/js/clone.js?v=' . filemtime($clone_path . '/js/clone.js')); ?>"></script>
<?php wp_footer(); ?>
</body>
</html>
