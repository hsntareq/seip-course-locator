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
            <h1 class="mb-0">Notices</h1>
            <?php
            $notice_cats = get_terms(array(
              'taxonomy' => 'notice',
              'parent' => 0
            ));

            if ($notice_cats) {
              ?>
              <div>
                <ul class="nav mb-3">
                  <?php foreach ($notice_cats as $notice_cat) { ?>
                    <li class="nav-item">
                      <a class="nav-link badge  px-3 <?= get_query_var('term') == $notice_cat->slug ? 'active' : '' ?>"
                          href="<?= get_term_link($notice_cat); ?>"><?= $notice_cat->name ?></a>
                    </li>
                  <?php } ?>
                </ul>
              </div>
            <?php } ?>
            <div class="content pScroll">
              <ul class="list-group">
                <?php
                if (have_posts()) {
                  while (have_posts()) {
                    the_post();
                    ?>
                    <li class="list-group-item d-flex align-items-center">
                      <i class="fas fa-file-pdf fa-2-5x mr-3"></i>
                      <div class="mbc-0 pr-5 w-100">
                        <div class="text-truncate font-weight-bold"><a
                              href="<?= __(the_permalink()) ?>"><?= __(the_title()) ?></a></div>
                        <p><?= __(get_the_date()) ?></p>
                      </div>
                    </li>
                    <?php
                  } // end while
                } // end if
                ?>

              </ul>
            </div>
            <div class="paginate pb-2">
              <?= wp_pagenavi(); ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer() ?>
