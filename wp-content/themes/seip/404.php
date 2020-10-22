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

              <h1 class="mb-4"><?php the_title()?></h1>
              <div class="content flex-basis overflow-h">
                <div class="overflow-h h-100 pScroll">

                  <h2><?php _e( 'This is somewhat embarrassing, isn’t it?', 'twentythirteen' ); ?></h2>
                  <p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentythirteen' ); ?></p>

                  <form role="search" method="get" id="searchform"
                      class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <div>
                      <label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
                      <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" />
                      <input type="submit" id="searchsubmit"
                          value="<?php echo esc_attr_x( 'Search', 'submit button' ); ?>" />
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php get_footer() ?>
