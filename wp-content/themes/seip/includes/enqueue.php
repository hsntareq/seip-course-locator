<?php

function seip_styles_scripts() {
	wp_enqueue_style('google-fonts', get_template_directory_uri() . '/css/google-fonts.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('ticker', get_template_directory_uri() . '/css/ticker.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('fontawesome.min', get_template_directory_uri() . '/css/fontawesome.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('animate.min', get_template_directory_uri() . '/css/animate.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('bootstrap.min', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('animate.min', get_template_directory_uri() . '/css/animate.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('jquery.bxslider.min', get_template_directory_uri() . '/css/jquery.bxslider.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('jquery.fancybox.css', get_template_directory_uri() . '/css/jquery.fancybox.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('perfect-scrollbar.css', get_template_directory_uri() . '/css/perfect-scrollbar.min.css', array(), '1.0.0', 'all' );
	wp_enqueue_style('fixed-table.css', get_template_directory_uri() . '/css/fixed-table.css', array(), '1.0.0', 'all' );

	wp_enqueue_style('seip-style', get_stylesheet_uri());
	wp_enqueue_style('media-queries', get_template_directory_uri() . '/css/media-queries.css', array(), '1.0.0', 'all' );


	wp_enqueue_script( 'bootstrap.bundle.min', get_stylesheet_directory_uri() . '/js/bootstrap.bundle.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'jquery.bxslider.min', get_stylesheet_directory_uri() . '/js/jquery.bxslider.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'jquery.fancybox.js', get_stylesheet_directory_uri() . '/js/jquery.fancybox.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'perfect-scrollbar.js', get_stylesheet_directory_uri() . '/js/perfect-scrollbar.min.js', array( 'jquery' ), '1.0.0', true );
	wp_enqueue_script( 'pace.min', get_stylesheet_directory_uri() . '/js/pace.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'FileSaver.min', get_stylesheet_directory_uri() . '/js/FileSaver.min.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'xlsx.core.min', get_stylesheet_directory_uri() . '/js/xlsx.core.min.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'jspdf.min', get_stylesheet_directory_uri() . '/js/jspdf.min.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'jspdf.plugin.autotable', get_stylesheet_directory_uri() . '/js/jspdf.plugin.autotable.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'tableExport.min.js', get_stylesheet_directory_uri() . '/js/tableExport.min.js', array( 'jquery' ), '1.0.0', false );

	wp_enqueue_script( 'print.min.js', get_stylesheet_directory_uri() . '/js/print.min.js', array( 'jquery' ), '1.0.0', false );
	wp_enqueue_script( 'fixed-table.js', get_stylesheet_directory_uri() . '/js/fixed-table.js', array( 'jquery' ), '1.0.0', false );


	wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() . '/js/custom_script.js', array( 'jquery' ), '1.0.0', 'true' );
}
add_action( 'wp_enqueue_scripts', 'seip_styles_scripts' );
