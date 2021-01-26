<?php

// enqueue parent stylesheet
add_action( 'wp_enqueue_scripts', 'aquentro_child_wp_enqueue_scripts' );
function aquentro_child_wp_enqueue_scripts() {

	$parent_theme = wp_get_theme( get_template() );
	$child_theme = wp_get_theme();

	// Enqueue the parent stylesheet
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css', array(), $parent_theme['Version'] );
	wp_enqueue_style( 'aquentro-style', get_stylesheet_uri(), array('parent-style'), $child_theme['Version'] );

	// Enqueue the parent rtl stylesheet
	if ( is_rtl() ) {
		wp_enqueue_style( 'parent-style-rtl', get_template_directory_uri() . '/rtl.css', array(), $parent_theme['Version'] );
	}
}
