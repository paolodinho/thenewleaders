<?php
$s3 = get_template_directory_uri() . '/assets/media/partners/';
$p_vi = (function_exists('tnl_lang') && tnl_lang() === 'vi');
$partner_alt = $p_vi ? 'Đối tác' : 'Partner';
$page_lbl = $p_vi ? 'Trang' : 'Page';

/* Đầy đủ 57 logo đối tác — khớp y hệt trang đang live thenewleaders.asia (2026-06-02) */
$s3_logos = [
    ['img' => $s3 . 'logo_vietinbank_inhoahiep_co_slogan_dd8f4e3d4b.png',                                                  'name' => 'VietinBank'],
    ['img' => $s3 . 'z7381879365515_15103e9d69a9b5ab7d05208b1c006371_db96cbeeaf.jpg',                                      'name' => 'Đối tác'],
    ['img' => $s3 . 'logo_01_5412217b6a.png',                                                                             'name' => 'Nam Dược'],
    ['img' => $s3 . 'de_heus_9ab80d28a7.png',                                                                             'name' => 'De Heus'],
    ['img' => $s3 . 'be_272b68b9ae.png',                                                                                  'name' => 'Be'],
    ['img' => $s3 . 'fossil_3d6f6f232c.png',                                                                              'name' => 'Fossil Group'],
    ['img' => $s3 . 'sanofi_889aa54e3d.png',                                                                              'name' => 'Sanofi'],
    ['img' => $s3 . 'gameloft_fc7122ed66.png',                                                                            'name' => 'Gameloft'],
    ['img' => $s3 . 'JW_Marriott_logo_d552a0212c.png',                                                                    'name' => 'JW Marriott'],
    ['img' => $s3 . 'bi_2bdd3a0c39.png',                                                                                  'name' => 'Boehringer Ingelheim'],
    ['img' => $s3 . 'brother_logo_B454723_F07_seeklogo_com_91ccdd42bd.png',                                               'name' => 'Brother'],
    ['img' => $s3 . 'vinacapital_a87042c961.png',                                                                         'name' => 'VinaCapital'],
    ['img' => $s3 . 'usaid_4357aa36e8.png',                                                                               'name' => 'USAID'],
    ['img' => $s3 . 'got_it_3513127745.png',                                                                              'name' => 'Got It'],
    ['img' => $s3 . 'miss_universe_947536df6b.png',                                                                       'name' => 'Miss Universe'],
    ['img' => $s3 . 'medigroup_d488fb14a6.png',                                                                           'name' => 'Medigroup'],
    ['img' => $s3 . 'acoc_132c4ac247.png',                                                                                'name' => 'ACOC'],
    ['img' => $s3 . 'Duc_logo_partner_website_mau_1920_x_1080_px_18_1024x576_b0f64de37a.png',                             'name' => 'Đối tác'],
    ['img' => $s3 . 'techfest_c85ff83d0d.png',                                                                            'name' => 'Techfest'],
    ['img' => $s3 . 'rmit_cd852e7436.png',                                                                                'name' => 'RMIT'],
    ['img' => $s3 . 'recto_1501537b5b.png',                                                                               'name' => 'Recto'],
    ['img' => $s3 . 'mari_d0cfd1f7ae.png',                                                                                'name' => 'Mari'],
    ['img' => $s3 . 'santen_0f70b624c3.png',                                                                              'name' => 'Santen'],
    ['img' => $s3 . 'fulbright_b24f14e800.png',                                                                           'name' => 'Fulbright'],
    ['img' => $s3 . 'ACCA_logo_svg_8e0ad6f978.png',                                                                       'name' => 'ACCA'],
    ['img' => $s3 . 'Logo_Top_CV_no_slogan_8ef163adf5.png',                                                               'name' => 'TopCV'],
    ['img' => $s3 . 'pearl_global_0d5e895a99.png',                                                                        'name' => 'Pearl Global'],
    ['img' => $s3 . 'akyn_741869e4d4.png',                                                                                'name' => 'Akyn'],
    ['img' => $s3 . 'obama_88db2c6848.png',                                                                               'name' => 'Obama Foundation'],
    ['img' => $s3 . 'teach_for_vn_978989c5b2.png',                                                                        'name' => 'Teach For Vietnam'],
    ['img' => $s3 . 'bizzi_b4c3c6f4d1.png',                                                                               'name' => 'Bizzi'],
    ['img' => $s3 . 'PMAX_LOGO_1024x413_c2f7b771c2.png',                                                                  'name' => 'PMAX'],
    ['img' => $s3 . 'vais_d6353e1598.png',                                                                                'name' => 'VAIS'],
    ['img' => $s3 . 'make_it_01eb23e2de.png',                                                                             'name' => 'Make It'],
    ['img' => $s3 . 'hcmiu_71a8d8ecc4.png',                                                                               'name' => 'HCMIU'],
    ['img' => $s3 . 'pre_seed_accelerator_logos_b5402953567039a6ea6d9362e4a1aeed3718953fdd339d805979da38bd2943c4_0287d64a2d.png', 'name' => 'Pre-Seed Accelerator'],
    ['img' => $s3 . 'fpt_9bc1b3c6ff.png',                                                                                 'name' => 'FPT'],
    ['img' => $s3 . 'MUFG_logo_09a94b8204.png',                                                                           'name' => 'MUFG'],
    ['img' => $s3 . 'gamuda_logo_60cb97d0b9.png',                                                                         'name' => 'Gamuda Land'],
    ['img' => $s3 . 'hachi_hachi_5d808f7a13.jpg',                                                                         'name' => 'Hachi Hachi'],
    ['img' => $s3 . 'IPSEN_logo_29b8014d6d.webp',                                                                         'name' => 'Ipsen'],
    ['img' => $s3 . 'lodgis_fusion_bae246d830.webp',                                                                      'name' => 'Lodgis Fusion'],
    ['img' => $s3 . 'Vietcombank_logo_004991bd7d.png',                                                                    'name' => 'Vietcombank'],
    ['img' => $s3 . 'GBA_30th_logo_5f55b5b312.svg',                                                                       'name' => 'GBA'],
    ['img' => $s3 . 'Asset_1_4x_100_49071ed4ea.jpg',                                                                      'name' => 'Đối tác'],
    ['img' => $s3 . 'Heineken_Logo_1991_present_f46467771f.jpg',                                                          'name' => 'Heineken'],
    ['img' => $s3 . 'VNG_Corp_logo_svg_1_0e30f94e7c.png',                                                                 'name' => 'VNG'],
    ['img' => $s3 . 'download_844cb64003.png',                                                                            'name' => 'Đối tác'],
    ['img' => $s3 . 'download_1_27aec1c61f.png',                                                                          'name' => 'Đối tác'],
    ['img' => $s3 . 'ampersand_6a90a7e236.png',                                                                           'name' => 'Ampersand'],
    ['img' => $s3 . 'Logo_OCB_Na_753635ed61.webp',                                                                        'name' => 'OCB'],
    ['img' => $s3 . '556_352127f6c5.jpg',                                                                                 'name' => 'Đối tác'],
    ['img' => $s3 . 'SGLN_logo_fd36b3d88c.png',                                                                           'name' => 'SGLN'],
    ['img' => $s3 . 'dgm_nttt_TRB_Chemedica_icon_1fe4e3f6c0.png',                                                         'name' => 'TRB Chemedica'],
    ['img' => $s3 . '1200px_Imperial_tobacco_logo_svg_50cb74cbb8.png',                                                    'name' => 'Imperial Tobacco'],
    ['img' => $s3 . 'greenyellow_f467f0fe60.png',                                                                         'name' => 'GreenYellow'],
    ['img' => $s3 . 'vndirect_811b7370fd.png',                                                                            'name' => 'VNDIRECT'],
];
?>

<section class="partners" id="partners">

  <!-- Intro: title + description -->
  <div class="partners__intro">
    <div class="container">
      <h2 class="partners__title"><?php echo tnl_t('partners_title'); ?></h2>
      <p class="partners__desc"><?php echo tnl_t('partners_desc'); ?></p>
    </div>
  </div>

  <!-- Logo carousel — 8 logo / trang (grid 4×2), giống live -->
  <div class="partners__strip">
    <div class="container">
      <?php $pages = array_chunk($s3_logos, 8); ?>
      <div class="partners__carousel" data-partners-carousel>
        <div class="partners__viewport">
          <div class="partners__track">
            <?php foreach ($pages as $page) : ?>
              <div class="partners__slide">
                <?php foreach ($page as $logo) : ?>
                  <div class="partner-logo">
                    <img src="<?php echo esc_url($logo['img']); ?>" alt="<?php echo esc_attr($logo['name'] === 'Đối tác' ? $partner_alt : $logo['name']); ?>" loading="lazy">
                  </div>
                <?php endforeach; ?>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?php if (count($pages) > 1) : ?>
          <div class="partners__dots" role="tablist" aria-label="<?php echo esc_attr($partner_alt); ?>">
            <?php foreach ($pages as $i => $_) : ?>
              <button class="partners__dot<?php echo $i === 0 ? ' is-active' : ''; ?>" type="button" data-slide="<?php echo $i; ?>" aria-label="<?php echo esc_attr($page_lbl); ?> <?php echo $i + 1; ?>"></button>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</section>
