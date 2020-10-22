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
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    query_posts(array(
                      'posts_per_page' => -1,
                      'post_type'=> 'e-news',
                      'paged' => $paged,
                      'posts_per_page' => 30 // limit of posts
                    ));
                    if (have_posts()) {
                      while (have_posts()) {
                        the_post();
                        $image_id = get_field('attached_file');
                        ?>


                        <div class="col-lg-3 col-xl-2 col-sm-4 col-12">
                          <div class="card mb-4 shadow-sm">
                            <div
                                class="gallery-thumb d-flex justify-content-center align-items-center border-bottom alert-warning">
                              <?php echo wp_get_attachment_image(get_post_thumbnail_id($image_id), 'medium'); ?>
                              <a href="<?= get_the_permalink() ?>"
                                  class="d-flex align-items-center justify-content-center text-light">
                                <i class="fas fa-eye fa-3x"></i>
                              </a>
                            </div>
                            <p class="m-0 p-2 text-truncate" data-toggle="tooltip" data-placement="auto"
                                title="<?= get_the_title() ?>"><?= get_the_title() ?></p>
                          </div>
                        </div>

                        <?php
                      }
                    }
                    ?>
                  </div>

                  <div class="paginate pb-2">
                    <?= wp_pagenavi();?>
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
