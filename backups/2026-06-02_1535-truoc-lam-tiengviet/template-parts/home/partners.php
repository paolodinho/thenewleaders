<?php
$s3 = get_template_directory_uri() . '/assets/media/partners/';

$s3_logos = [
    ['img' => $s3 . 'logo_01_5412217b6a.png',                             'name' => 'Nam Dược'],
    ['img' => $s3 . 'de_heus_9ab80d28a7.png',                             'name' => 'De Heus'],
    ['img' => $s3 . 'be_272b68b9ae.png',                                  'name' => 'Be'],
    ['img' => $s3 . 'fossil_3d6f6f232c.png',                              'name' => 'Fossil Group'],
    ['img' => $s3 . 'sanofi_889aa54e3d.png',                              'name' => 'Sanofi'],
    ['img' => $s3 . 'gameloft_fc7122ed66.png',                            'name' => 'Gameloft'],
    ['img' => $s3 . 'JW_Marriott_logo_d552a0212c.png',                    'name' => 'JW Marriott'],
    ['img' => $s3 . 'logo_vietinbank_inhoahiep_co_slogan_dd8f4e3d4b.png', 'name' => 'Vietinbank'],
];

$partners_query = new WP_Query([
    'post_type'      => 'partner',
    'posts_per_page' => 20,
    'post_status'    => 'publish',
    'orderby'        => 'menu_order',
    'order'          => 'ASC',
]);
$use_wp = $partners_query->have_posts();
?>

<section class="partners" id="partners">

  <!-- Intro: title + description -->
  <div class="partners__intro">
    <div class="container">
      <h2 class="partners__title">Hear it from<br>our partners</h2>
      <p class="partners__desc">We're trusted by leading educational institutes, NGOs, startups and corporates to strengthen leadership and create changes in their businesses and society.</p>
    </div>
  </div>

  <!-- Logo grid -->
  <div class="partners__strip">
    <div class="container">
      <div class="partners__logos">
        <?php if ($use_wp) :
          while ($partners_query->have_posts()) : $partners_query->the_post(); ?>
            <div class="partner-logo">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('medium', ['loading' => 'lazy', 'alt' => get_the_title()]); ?>
              <?php else : ?>
                <span class="partner-logo__name"><?php the_title(); ?></span>
              <?php endif; ?>
            </div>
          <?php endwhile;
          wp_reset_postdata();

        else :
          foreach ($s3_logos as $logo) : ?>
            <div class="partner-logo">
              <img src="<?php echo esc_url($logo['img']); ?>" alt="<?php echo esc_attr($logo['name']); ?>" loading="lazy">
            </div>
          <?php endforeach;
        endif; ?>
      </div>
    </div>
  </div>

</section>
