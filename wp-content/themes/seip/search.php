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
              <?php
              if (have_posts()) {
                echo '<ul class="list-group">';
                while (have_posts()) {
                  the_post();
                  ?>
                  <li class="list-group-item d-flex align-items-center mb-2">
                    <i class="fas fa-file-pdf fa-2-5x mr-3"></i>
                    <div class="mbc-0 pr-5 w-100">
                      <div class="text-truncate font-weight-bold"><a
                            href="<?= __(the_permalink()) ?>"><?= __(the_title()) ?></a></div>
                      <p><?= __(get_the_date()) ?></p>
                    </div>
                  </li>
                  <?php
                } // end while
                echo '</ul>';
              } else {
                echo '<h3 class="mb-3">Nothing found. If you want to search more please search here: </h3>';
//                    get_search_form();
                ?>
                <form role="search" method="get" id="searchform"
                    class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
                  <div>
                    <label class="screen-reader-text" for="s"><?php _x('Search for:', 'label'); ?></label>
                    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s"/>
                    <input type="submit" id="searchsubmit"
                        value="<?php echo esc_attr_x('Search', 'submit button'); ?>"/>
                  </div>
                </form>
                <?php
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
