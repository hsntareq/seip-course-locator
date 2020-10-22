<?php
/*
 * Template name: Quick Links
 * */
?>
<?php get_header() ?>
  <div class="w-100 flex-fill overflow-h h-100">
    <div class="content-wrap py-2 h-100">
      <div class="container-fluid h-100">
        <div class="row h-100">
          <?php get_template_part('template/page', 'nav') ?>

          <div class="col-sm-12 col-xl-10 col-lg-9 h-100">
            <div class="content-area d-flex flex-column h-100">
              <?php
            if (function_exists('yoast_breadcrumb')) {
              yoast_breadcrumb('<div id="breadcrumbs">', '</div>');
            }
            ?>

              <h1 class="mb-4"><?= __(the_title()) ?></h1>
              <div class="content flex-fill pScroll">
                <?php if ($sections = get_field('section_info')) {
                  foreach ($sections as $section) {
                    ?>
                    <h5><?= __($section['section_icon']) ?> <?= __($section['section_name']) ?></h5>
                    <div class="overflow-h mb-3">
                      <ul class="list-group-custom">
                      <?php foreach ($section['section_images'] as $section_img) { ?>
                        <li><a href="<?= __($section_img['section_image_url']?$section_img['section_image_url']:'#') ?>"><?= $section_img['section_image_title']?$section_img['section_image_title']:'' ?></a></li>
                        <!-- <img class="card-img-top" src="<?= __($section_img['section_image']) ?>" alt="image"> -->
                      <?php } ?>
                      </ul>
                    </div>
                  <?php }
                } else {
                  if (have_posts()) {
                    while (have_posts()) {
                      the_post();
                      //
                      the_content();
                      //
                    } // end while
                  } // end if
                }
                ?>

              </div>

            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
<?php get_footer() ?>
