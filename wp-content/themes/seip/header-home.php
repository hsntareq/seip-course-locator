<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" type="image/png" href="<?= THEME ?>/images/favicon.png"/>
  <title><?php wp_title( '' ) ?></title>
	<?php wp_head();?>
</head>
<body>
<header class="d-flex flex-column justify-content-between shadow-sm">
  <div class="header-top">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center logo-wrap">
          <div class="logo">
            <a href="<?= home_url() ?>">
              <img
                  src="<?= get_field( 'logo', 'option' ) ? get_field( 'logo', 'option' ) : THEME . '/images/logo.png' ?>"
                  alt="logo">
            </a>
          </div>
          <span class="h-auto ml-3 display-6 text-white text-shadow">
            <?= get_field( 'logo_text', 'option' ) ? get_field( 'logo_text', 'option' ) : 'Skills For Employment Investment Program' ?>
          </span>
        </div>
        <div class="d-flex justify-content-end align-items-center">
          <div class="partners d-flex">
			  <?php
			  if ( get_field( 'logo_partners', 'option' ) ) {
				  foreach ( get_field( 'logo_partners', 'option' ) as $partner ) {
					  echo '<img src="' . $partner['partner_image'] . '" alt="' . $partner['partner_title'] . '" class="' . $partner['image_class'] . '">';
				  }
			  }
			  ?>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div class="header-bottom">
    <div class="slider">
		<?php
		if ( get_field( 'banner_slides', 'option' ) ) {
			foreach ( get_field( 'banner_slides', 'option' ) as $banner_slide ) {
//			  pr($banner_slide['banner_image']);
				?>
              <div>
                <img
                    src="<?= $banner_slide['banner_image'] ? $banner_slide['banner_image'] : '/images/slider/01.jpg' ?>"
                    alt="slide">
				  <?php
				  if ( $banner_slide['banner_content_slides'] ) {
					  ?>
                    <div class="banner-content flex-fill align-items-center d-flex">
                      <div class="container">

						  <?php
						  $slide_no = 0;
						  foreach ( $banner_slide['banner_content_slides'] as $banner_content ) {
							  $slide_no += 1;
							  ?>
                            <div class="header-content text-white text-center float-right text-slide-<?= $slide_no ?>">
                              <div class="p-3 mb-0"><span
                                    class="display-6"><?= __( $banner_content['content_title'] ) ?></span>
                                <small><?= __( $banner_content['content_subtitle'] ) ?></small>
                              </div>
                              <div class="d-flex fs-16">
								  <?php
								  foreach ( $banner_content['content_infos'] as $cont_info ) {
									  ?>
                                    <div class="flex-fill <?=$cont_info['content_info_bg']?> py-2 col">
                                      <p><?= __( $cont_info['content_info_title'] ) ?></p>
                                      <p><?= __( $cont_info['content_info_value'] ) ?></p>
                                    </div>
									  <?php
								  }
								  ?>

                              </div>
                            </div>
							  <?php
						  }
						  ?>
                      </div>
                    </div>
					  <?php
				  }
				  ?>
              </div>
				<?php
			}
		}
		?>
    </div>
  </div>
</header>