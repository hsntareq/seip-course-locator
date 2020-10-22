<?php
define('THEME',get_stylesheet_directory_uri());


add_image_size( 'stuff-thumb', 200, 220 , array( 'center', 'center' ) );

add_theme_support( 'post-thumbnails' );

function pr($var){
	echo '<pre>';print_r($var);echo '</pre>';
}