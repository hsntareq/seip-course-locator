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
            <div class="content flex-basis">

              <?php
              if (have_posts()) {
                while (have_posts()) {
                  the_post();
                  if (get_post_type(get_the_ID()) == 'e-news') {
                    echo '<div class="overflow-h h-100">';
                    echo do_shortcode('[embeddoc url="' . wp_get_attachment_url(get_field('attached_file')) . '" download="all" viewer="google"]');
                    echo '</div>';
                  } else {
                    echo '<div class="overflow-h">';
                    the_content();
                    echo '</div>';
                  }
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
<?php get_footer() ?>
