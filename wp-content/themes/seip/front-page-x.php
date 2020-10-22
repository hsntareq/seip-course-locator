<?php get_header( 'home' ) ?>
  <nav class="main-nav">
    <div class="container d-flex justify-content-between">
		<?= wp_nav_menu( array(
			'theme_location' => 'main_menu'
		) ) ?>
      <div class="search-wrap position-relative">
        <button class="btn btn-sm bg-white"><i class="fas fa-search"></i></button>
        <input type="text" autofocus class="form-control form-control-sm" placeholder="Type to search ...">
      </div>
  </nav>
<?php
$ticker_args  = array(
	'post_type'      => array( 'post', 'admission-circular', 'notices' ),
	'post_status'    => 'publish',
	'posts_per_page' => - 1,
	'meta_key'       => 'news_ticker',
	'meta_value'     => true
);
$ticker_posts = new WP_Query( $ticker_args );
//pr($ticker_posts);die;
?>
  <div class="ticker-container">
    <div class="ticker-wrap">
      <div class="ticker">
		  <?php foreach ( $ticker_posts->posts as $ticker ) { ?>
            <div class="ticker__item">
              <a href="<?= get_permalink($ticker->ID) ?>"><?= $ticker->post_title ?></a>
            </div>
		  <?php } ?>
      </div>
    </div>
  </div>

  <div class="content-wrap py-3">
    <div class="container">
      <div class="content-area">
        <div class="row">
          <div class="col-sm-4 mb-4 mb-md-0">
            <div class="card">
              <div class="card-header">
                <h5 class="mb-0"><?= get_field( 'featured_title_one', 'option' ) ?></h5>
              </div>
              <ul class="list-group list-group-flush list-sm">
				  <?php
				  $latest_news = get_posts( array( 'numberposts' => 5, 'post_type' => 'post' ) );
				  foreach ( $latest_news as $news ) {
					  ?>
                    <a href="<?= get_permalink( $news->ID ) ?>"
                       class="list-group-item text-truncate"><?= __( $news->post_title ) ?></a>
					  <?php
				  }
				  ?>
              </ul>
            </div>
          </div>
          <div class="col-sm-4 mb-4 mb-md-0">
            <div class="card">

              <a href="<?= get_post_type_archive_link( 'admission-circular' ); ?>"
                 class="card-header mb-0 h5 text-truncate"><?= get_field( 'featured_title_two', 'option' ) ?></a>

              <ul class="list-group list-group-flush list-sm">
				  <?php
				  $admission_circular = get_posts( array( 'numberposts' => 5, 'post_type' => 'admission-circular' ) );
				  foreach ( $admission_circular as $circular ) {
					  ?>
                    <a href="<?= get_permalink( $circular->ID ) ?>"
                       class="list-group-item text-truncate"><?= __( $circular->post_title ) ?></a>
					  <?php
				  }
				  ?>
              </ul>
            </div>
          </div>
          <div class="col-sm-4 mb-4 mb-md-0">
            <div class="card">
              <a href="<?= get_post_type_archive_link( 'notices' ); ?>"
                 class="card-header mb-0 h5 text-truncate"><?= get_field( 'featured_title_three', 'option' ) ?></a>

              <ul class="list-group list-group-flush list-sm">
				  <?php
				  $admission_circular = get_posts( array( 'numberposts' => 5, 'post_type' => 'notices' ) );
				  foreach ( $admission_circular as $circular ) {
					  ?>
                    <a href="<?= get_permalink( $circular->ID ) ?>"
                       class="list-group-item text-truncate"><?= __( $circular->post_title ) ?></a>
					  <?php
				  }
				  ?>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
<?php get_footer() ?>