<?php
/*
 * Template name: Stuff Lists
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

              <h1 class="mb-0"><?= __(the_title()) ?></h1>

              <?php
              $departments = get_terms(array(
                'taxonomy' => 'department',
                'parent' => 0
              ));
              ?>
              <div>
                <ul class="nav mb-3">
                  <?php
                  $dept_no = 0;
                  foreach ($departments as $dept) {
                    $dept_no += 1;
                    ?>
                    <li class="nav-item">
                      <a class="nav-link badge <?= $dept_no == 1 ? 'active' : '' ?>" href="#<?= __($dept->slug) ?>"
                          data-toggle="pill"><?= __($dept->name) ?></a>
                    </li>
                  <?php } ?>
                </ul>
              </div>

              <div class="pScroll">
                <div class="tab-content overflow-h" id="pills-tabContent">
                  <?php
                  $dept_no = 0;
                  foreach ($departments as $dept) {
                    $dept_no += 1;

                    $dept_args = array(
                      'showposts' => -1,
                      'post_type' => 'stuffs',
                      'orderby' => 'menu_order',
                      'order' => 'ASC',
                      'tax_query' => array(
                        array(
                          'taxonomy' => $dept->taxonomy,
                          'field' => 'term_id',
                          'terms' => $dept->term_id
                        )
                      )
                    );
                    $dept_stuffs = new WP_Query($dept_args);
                    ?>
                    <div class="tab-pane fade show <?= $dept_no == 1 ? 'active' : '' ?>" id="<?= $dept->slug ?>"
                        role="tabpanel"
                        aria-labelledby="pills-home-tab">
                      <div class="row">
                        <?php foreach ($dept_stuffs->posts as $stuff) {
                          $stuff_image = get_the_post_thumbnail_url($stuff->ID, 'stuff-thumb');
                          ?>
                          <div class="col-xl-6 col-md-6 col-lg-12 col-sm-12 col-12">
                            <div class="team-member d-flex align-items-start">
                              <img src="<?= $stuff_image ?>" height="210" width="200"/>
                              <div class="team-data">
                                <p class="fw-semibold"><?= __($stuff->post_title) ?></p>
                                <p><?= __(get_field("stuff_position", $stuff->ID)) ?></p>
                                <p><?= __(get_field("stuff_office", $stuff->ID)) ?></p>
                                <p>Phone: <a href="tel:<?= __(get_field("stuff_phone", $stuff->ID)) ?>"><?= __(get_field("stuff_phone", $stuff->ID)) ?></a><?= get_field("staff_phone_extra", $stuff->ID)?get_field("staff_phone_extra", $stuff->ID):'' ?> <?= get_field("staff_phone_extension", $stuff->ID)?'Ext: '.get_field("staff_phone_extension", $stuff->ID):'' ?> </p>
                                <p>E-mail: <a href="mailto:<?= __(get_field("stuff_email", $stuff->ID)) ?>"><?= __(get_field("stuff_email", $stuff->ID)) ?></a></p>
                              </div>
                            </div>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php get_footer() ?>
