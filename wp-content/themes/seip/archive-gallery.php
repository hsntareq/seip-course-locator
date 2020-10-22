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

              <h1 class="mb-4"><?= __(post_type_archive_title()) ?></h1>
              <div class="content pScroll">
                <div class="overflow-h">
                  <div class="row">

                    <?php
                    if (have_posts()) {
                      while (have_posts()) {
                        the_post();
                        $gallery_type = get_field('gallery_type');
                        if ($gallery_type == 'video') {
                          get_template_part('template/gallery', 'video');
                        } else {
                          get_template_part('template/gallery', 'image');
                        }// end if
                      } // end while
                    } // end if
                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php get_footer() ?>
