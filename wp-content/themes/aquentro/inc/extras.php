<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Aquentro
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function aquentro_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if(is_singular() && has_post_thumbnail()){
	    $classes[] = 'has-header-image';
    }

    if(has_nav_menu('menu-4')){
        $classes[] = 'has-vertical-menu';
    }


	return $classes;
}
add_filter( 'body_class', 'aquentro_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function aquentro_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'aquentro_pingback_header' );


add_filter('aquentro_content_area_classes', 'aquentro_content_area_classes_filter');
function aquentro_content_area_classes_filter($classes){
    if(!is_active_sidebar('sidebar-1')){
        $classes[] = 'boxed';
    }
    return $classes;
}

function aquentro_get_footer_image_url(){
	$url = get_template_directory_uri() . '/images/footer_skyline.png';
	$url = get_theme_mod('aquentro_footer_image', $url);

	return $url;
}

function aquentro_generate_footer_styles(){
	$style = '';
	$padding_top = get_theme_mod('aquentro_footer_padding_top', 80);
	$padding_bottom = get_theme_mod('aquentro_footer_padding_bottom', 240);

	if($padding_top != 80){
		$style .= 'padding-top:'.$padding_top.'px;';
	}

	if($padding_bottom != 240){
		$style .= 'padding-bottom:'.$padding_bottom.'px;';
	}

	if($style){
		return $style;
	}

	return '';
}