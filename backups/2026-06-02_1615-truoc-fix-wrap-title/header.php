<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
  <div class="container">
    <div class="site-header__inner">

      <!-- Logo -->
      <a href="<?php echo esc_url(home_url('/')); ?>" class="site-header__logo" aria-label="<?php bloginfo('name'); ?>">
        <?php if (has_custom_logo()) : ?>
          <?php the_custom_logo(); ?>
        <?php else : ?>
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/tnl-logo.svg'); ?>" alt="The New Leaders" class="site-header__logo-svg">
        <?php endif; ?>
      </a>

      <!-- Primary Nav -->
      <nav class="site-header__nav" aria-label="Primary navigation">
        <?php
        // Items that get a dropdown chevron (visual only)
        $dropdown_items = ['Our Services & Products', 'Assessment & Resources', 'Events'];

        wp_nav_menu([
            'theme_location' => 'primary',
            'container'      => false,
            'menu_class'     => 'nav-menu',
            'fallback_cb'    => false,
            'walker'         => new TNL_Nav_Walker(),
        ]);
        ?>
      </nav>

      <!-- Language switcher: VN first, EN second -->
      <div class="site-header__lang">
        <a href="<?php echo tnl_lang_url('vi'); ?>" class="lang-btn <?php echo tnl_lang()==='vi'?'lang-btn--active':''; ?>" aria-label="Tiếng Việt">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/vi.svg'); ?>" alt="VI" width="20" height="20">
        </a>
        <span class="lang-sep">|</span>
        <a href="<?php echo tnl_lang_url('en'); ?>" class="lang-btn <?php echo tnl_lang()==='en'?'lang-btn--active':''; ?>" aria-label="English">
          <img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/en.svg'); ?>" alt="EN" width="20" height="20">
        </a>
      </div>

      <!-- Hamburger (mobile) -->
      <button class="site-header__hamburger" aria-label="Toggle menu" aria-expanded="false">
        <span></span><span></span><span></span>
      </button>

    </div>
  </div>
</header>

<?php
/**
 * Custom nav walker — adds chevron SVG to items with slug dropdown
 */
class TNL_Nav_Walker extends Walker_Nav_Menu {
    private $dropdown_slugs = ['our-services-products', 'assessment-resources', 'events'];
    // Match by title keywords
    private $dropdown_titles = ['Services', 'Resources', 'Events'];

    public function start_el(&$output, $data_object, $depth = 0, $args = null, $current_object_id = 0) {
        $item = $data_object;
        $title = apply_filters('the_title', $item->title, $item->ID);
        $url   = $item->url ?: '#';

        // Skip "Home Page" / "Home" — logo already links home, frees nav space
        if (preg_match('/^\s*home(\s*page)?\s*$/i', $title)) {
            return;
        }

        $classes = empty($item->classes) ? [] : (array) $item->classes;
        if (in_array($item->object_id, [get_queried_object_id()], true)) {
            $classes[] = 'current-menu-item';
        }
        $class_str = implode(' ', array_filter($classes));

        // Detect dropdown items by title keywords
        $is_dropdown = false;
        foreach ($this->dropdown_titles as $kw) {
            if (stripos($title, $kw) !== false) { $is_dropdown = true; break; }
        }

        $chevron = $is_dropdown
            ? ' <svg class="nav-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none" aria-hidden="true"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'
            : '';

        $label = function_exists('tnl_nav_label') ? tnl_nav_label($title) : $title;
        $output .= '<li class="' . esc_attr($class_str) . '">';
        $output .= '<a href="' . esc_url($url) . '">' . esc_html($label) . $chevron . '</a>';
    }

    public function end_el(&$output, $data_object, $depth = 0, $args = null) {
        $output .= '</li>';
    }
}
?>
