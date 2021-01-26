<?php

/**
 *
 * Demo data
 *
 **/

function aquentro_ocdi_import_files() {
	$import_notice = '<h4>' . esc_html__( 'Important note before importing sample data.', 'aquentro' ) . '</h4>';
    $import_notice .= 
	esc_html__( 'If you want to use such features as Testimonials, Contact form and Tiled galleries that are presented in the theme demo, you should perform the following steps before importing sample data.', 'aquentro' ) . '<br/>' .
	'<ol>' .
		'<li>' . esc_html__( 'Install and activate Jetpack plugin if you have not done that yet.', 'aquentro' ) . '</li>' .
		'<li>' . __( 'Connect Jetpack to WordPress.com (it\'s free). Jetpack is a top popular plugin to improve your website at many levels, but if for some reason you don\'t want to connect it to WordPress.com, you can still use it by activating Jetpack Dev Mode with a help of <a href="https://wordpress.org/plugins/jetpack-dev-mode/">this plugin</a>.', 'aquentro' ) . '</li>' .
		'<li>' . sprintf( __( 'Once Jetpack is activated, go to its <a href="%s">settings</a> and activate the following modules: Carousel, Contact Form, Custom content types, Tiled Galleries. Skip the modules you are not going to use.', 'aquentro' ), admin_url('/admin.php?page=jetpack_modules')) . '</li>' .
		'<li>' . esc_html__( 'Proceed to importing sample data.', 'aquentro' ) . '</li>' .
	'</ol>' .
    esc_html__( 'Data import is generally not immediate and can take up to 10-15 minutes.', 'aquentro' );
	
	$import_notice = wp_kses(
		$import_notice,
		array(
			'a' => array(
				'href' => array(),
			),
			'ol' => array(),
			'li' => array(),
			'h4' => array(),
			'br' => array(),
		)
	);

    return array(
        array(
            'import_file_name'             => 'Demo Import 1',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'assets/demo-data/aquentro.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'assets/demo-data/aquentro-widgets.wie',
            'import_preview_image_url'     => '',
            'import_notice'                => $import_notice,
            'preview_url'                  => 'https://themes.getmotopress.com/aquentro/',
        ),
    );
}
add_filter( 'pt-ocdi/import_files', 'aquentro_ocdi_import_files' );

function aquentro_ocdi_after_import_setup() {

    // Assign menus to their locations.
    $menu1 = get_term_by( 'slug', 'primary-menu', 'nav_menu' );
    $menu2 = get_term_by( 'slug', 'contacts-menu', 'nav_menu' );
    $menu3 = get_term_by( 'slug', 'socials-menu', 'nav_menu' );


    set_theme_mod( 'nav_menu_locations', array(
            'menu-1' => $menu1->term_id,
            'menu-3' => $menu3->term_id,
            'menu-4' => $menu3->term_id,
        )
    );

    // Assign menu to widget
    $menu5 = get_term_by( 'name', 'Contacts menu', 'nav_menu' );
    $nav_menu_widget = get_option('widget_nav_menu');

    if($nav_menu_widget ){
        if($menu2 && !empty($nav_menu_widget[2])){
            $nav_menu_widget[2]['nav_menu'] = $menu2->term_id;
        }
        update_option('widget_nav_menu', $nav_menu_widget);
    }

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Home' );
    $blog_page_id  = get_page_by_title( 'News' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );


    // Assign Hotel Booking default pages.
    $search_results_page = get_page_by_title('Search Results');
    $booking_confirmation_page = get_page_by_title('Booking Confirmation');
    $terms_conditions_page = get_page_by_title('Terms & Conditions');
    $booking_confirmed_page = get_page_by_title('Booking Confirmed');
    $booking_cancelled_page = get_page_by_title('Booking Cancelled');

    update_option('mphb_search_results_page', $search_results_page->ID);
    update_option('mphb_checkout_page', $booking_confirmation_page->ID);
    update_option('mphb_terms_and_conditions_page', $terms_conditions_page->ID);
    update_option('mphb_booking_confirmation_page',$booking_confirmed_page->ID);
    update_option('mphb_user_cancel_redirect_page', $booking_cancelled_page->ID);

    // enable direct booking
    update_option('mphb_direct_booking', 1);


    // elementor_scheme_color
    $elementor_color_pallet = array (
        1 => '#222222',
        2 => '#222222',
        3 => '#484848',
        4 => '#7a68e2',
    );
    update_option( 'elementor_scheme_color', $elementor_color_pallet );

    /*
     * elementor_scheme_color-picker
     */
    $elementor_scheme_color_picker = array(
        '#7a68e2',
        '#222222',
        '#484848',
        '#475764',
        '#96acbd',
        '#9688e4',
        '#909090',
        '#ffffff'
    );
    update_option('elementor_scheme_color-picker', $elementor_scheme_color_picker);

    /*
     * elementor_container_width
     */
    update_option('elementor_container_width', 1280);

    $elementor_scheme_typography = array(
        1 => array(
            'font_family' => 'Oswald',
            'font_weight' => '400'
        ),
        2 => array(
            'font_family' => 'Oswald',
            'font_weight' => '400'
        ),
        3 => array(
            'font_family' => 'Roboto',
            'font_weight' => '400'
        ),
        4 => array(
            'font_family' => 'Roboto',
            'font_weight' => '500'
        ),
    );
    update_option('elementor_scheme_typography', $elementor_scheme_typography);

    //update taxonomies
    $update_taxonomies = array(
        'post_tag',
        'category'
    );
    foreach ($update_taxonomies as $taxonomy ) {
        aquentro_ocdi_update_taxonomy( $taxonomy );
    }

    // skip hotel booking wizard
    update_option( 'mphb_wizard_passed', true);

    //set site default logo
    $args = array(
        'post_type' => 'attachment',
        'name' => 'aquentro_text_logo',
        'posts_per_page' => 1,
        'post_status' => 'inherit',
    );
    $_logo = get_posts( $args );
    $logo = $_logo ? array_pop($_logo) : null;
    if($logo){
        set_theme_mod('custom_logo', $logo->ID);
    }

    //hide site title
    set_theme_mod('header_text', 0);

}
add_action( 'pt-ocdi/after_import', 'aquentro_ocdi_after_import_setup' );

// Disable generation of smaller images (thumbnails) during the content import
//add_filter( 'pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false' );

// Disable the branding notice
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

function aquentro_ocdi_update_taxonomy( $taxonomy ) {
    $get_terms_args = array(
        'taxonomy' => $taxonomy,
        'fields' => 'ids',
        'hide_empty' => false,
    );

    $update_terms = get_terms($get_terms_args);
    if ( $taxonomy && $update_terms ) {
        wp_update_term_count_now($update_terms, $taxonomy);
    }
}
