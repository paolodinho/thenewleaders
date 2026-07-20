<?php
/**
 * Template Name: Landing sự kiện
 * Trang landing full-width cho sự kiện. Dùng các "khối sự kiện" (block patterns) brand.
 */
if (!defined('ABSPATH')) exit;

get_header();
?>
<main class="tnl-landing">
  <?php
  while (have_posts()) : the_post();
      the_content();
  endwhile;
  ?>
</main>
<?php
get_footer();
