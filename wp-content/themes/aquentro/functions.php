<?php
/**
 * Aquentro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Aquentro
 */
if ( ! function_exists( 'aquentro_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function aquentro_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on aquentro, use a find and replace
		 * to change 'aquentro' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'aquentro', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

        set_post_thumbnail_size( 840);

        add_image_size( 'aquentro-thumb-medium', 840, 466, true );
        add_image_size( 'aquentro-thumb-large', 2560);

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'aquentro' ),
			'menu-3' => esc_html__( 'Footer bottom(socials)', 'aquentro' ),
            'menu-4' => esc_html__( 'Content left', 'aquentro'),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add page support excerpt.
//		add_post_type_support( 'page', 'excerpt' );

        add_theme_support( 'custom-logo', array(
            'height'      => 60,
            'width'       => 60,
            'flex-width'  => true,
            'flex-height' => true,
            'header-text' => array( 'site-title' ),
        ) );

		/*
		* This theme styles the visual editor to resemble the theme style,
		* specifically font, colors, icons, and column width.
		*/
		add_editor_style( array( 'css/editor-style.css', aquentro_fonts_url() ) );
	}
endif;
add_action( 'after_setup_theme', 'aquentro_setup' );

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 */
if ( ! isset( $content_width ) ) {
	$content_width = apply_filters( 'aquentro_content_width', 800 );
}
function aquentro_adjust_content_width() {
    global $content_width;

    if(is_page_template('template-full-width-grid-page.php') || is_page_template('template-full-width-page.php') || is_page_template('template-front-page.php')){
        $content_width = 1280;
    }

}
add_action( 'template_redirect', 'aquentro_adjust_content_width');

/**
 * Get theme vertion.
 *
 * @access public
 * @return string
 */
function aquentro_get_theme_version() {
	$theme_info = wp_get_theme( get_template() );

	return $theme_info->get( 'Version' );
}

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aquentro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'aquentro' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'aquentro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'aquentro' ),
		'id'            => 'sidebar-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'aquentro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page Top', 'aquentro' ),
		'id'            => 'sidebar-5',
		'description'   => esc_html__( 'Appears on the Front Page.', 'aquentro' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'aquentro_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aquentro_scripts() {

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'aquentro-fonts', aquentro_fonts_url(), array(), null );
	wp_enqueue_style( 'aquentro-style', get_stylesheet_uri(), array(), aquentro_get_theme_version() );
	if ( class_exists( 'HotelBookingPlugin' ) ) {
		wp_enqueue_style( 'aquentro-motopress-hotel-booking', get_template_directory_uri() . '/css/motopress-hotel-booking.css', array(
			'aquentro-style'
		), aquentro_get_theme_version(), 'all' );
	}

    if(defined('ELEMENTOR_VERSION')) {
        wp_enqueue_style('aquentro-elementor', get_template_directory_uri() . '/css/elementor-widgets.css', array(), aquentro_get_theme_version());
    }

    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.7.0');


	wp_enqueue_script('headroom', get_template_directory_uri() . '/assets/headroom/headroom.min.js', array( 'jquery' ), '0.9.4');
	wp_enqueue_script('jquery-headroom', get_template_directory_uri() . '/assets/headroom/jquery.headroom.js', array( 'jquery' ), '0.9.4');

	wp_enqueue_script('scrolreveal', get_template_directory_uri() . '/assets/scrollreveal/scrollreveal.min.js', array(), '3.4.0');

    wp_register_script( 'slick-slider', get_template_directory_uri() . '/assets/slick/slick.min.js', array('jquery'), '1.9.0');
    wp_register_style( 'slick-style', get_template_directory_uri() . '/assets/slick/slick.css', array(), '1.9.0');

	wp_enqueue_script( 'aquentro-navigation', get_template_directory_uri() . '/js/navigation.js', array(), aquentro_get_theme_version(), true );

	if ( defined( 'JETPACK__VERSION')) {
		wp_enqueue_script('slick-slider');
		wp_enqueue_style('slick-style');
	}

	wp_enqueue_script( 'aquentro-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), aquentro_get_theme_version(), true );
	wp_enqueue_script( 'aquentro-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), aquentro_get_theme_version(), true );

	wp_localize_script( 'aquentro-script', 'screenReaderText', array(
		'expand'   => esc_html__( 'expand child menu', 'aquentro' ),
		'collapse' => esc_html__( 'collapse child menu', 'aquentro' ),
	) );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'aquentro_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
/**
 * Load TGM plugin activation.
 */
if ( current_user_can( 'install_plugins' ) ) {
	require get_template_directory() . '/inc/tgm-init.php';
}

/**
 * Import demo data
 */

require get_template_directory() . '/inc/demo-import.php';

/**
 * Add customizer settings
 */

require get_template_directory() . '/inc/customizer.php';


if ( ! function_exists( 'aquentro_theme_updater' ) ) :
	/**
	 * Theme Updater
	 * Easy Digital Downloads.
	 *
	 * @package EDD Sample Theme
	 * Action is used so that child themes can easily disable.
	 */

	function aquentro_theme_updater() {
		if ( current_user_can( 'update_themes' ) ) {
			require get_template_directory() . '/inc/updater/theme-updater.php';
		}
	}
endif;
add_action( 'after_setup_theme', 'aquentro_theme_updater' );




if ( ! function_exists( 'aquentro_the_custom_logo' ) ) :
	/**
	 * Displays the optional custom logo.
	 *
	 * Does nothing if the custom logo is not available.
	 *
	 * @since Aquentro 1.0.0
	 */
	function aquentro_the_custom_logo() {
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}
	}
endif;

if ( ! function_exists( 'aquentro_fonts_url' ) ) :
	/**
	 * Register Google fonts for Aquentro.
	 *
	 * Create your own aquentro_fonts_url() function to override in a child theme.
	 *
	 * @since Aquentro 1.0.0
	 *
	 * @return string Google fonts URL for the theme.
	 */
	function aquentro_fonts_url() {
		$fonts_url     = '';
		$font_families = array();
		
		/**
		 * Translators: If there are characters in your language that are not
		 * supported by Oswald, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$oswald = esc_html_x( 'on', 'Oswald font: on or off', 'aquentro' );
		if ( 'off' !== $oswald) {
			$font_families[] = 'Oswald:400,700';
		}
		/**
		 * Translators: If there are characters in your language that are not
		 * supported by Roboto, translate this to 'off'. Do not translate
		 * into your own language.
		 */
		$roboto = esc_html_x( 'on', 'Roboto font: on or off', 'aquentro' );
		if ( 'off' !== $roboto) {
			$font_families[] = 'Roboto:300,400,400i,500,700,700i';
		}
		
		$query_args    = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext,cyrillic' ),
		);
		if ( $font_families ) {
			$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;
/**
 * Modifies tag cloud widget arguments to have all tags in the widget same font size.
 *
 * @since Aquentro 1.0.0
 *
 * @param array $args Arguments for tag cloud widget.
 *
 * @return array A new modified arguments.
 */
function aquentro_widget_tag_cloud_args( $args ) {
	$args['largest']  = 0.75;
	$args['smallest'] = 0.75;
	$args['unit']     = 'rem';

	return $args;
}

add_filter( 'widget_tag_cloud_args', 'aquentro_widget_tag_cloud_args' );

/*
 * Filters the title of the default page template displayed in the drop-down.
 */
function aquentro_default_page_template_title() {
	return esc_html__( 'Page with sidebar', 'aquentro' );
}

add_filter( 'default_page_template_title', 'aquentro_default_page_template_title' );

/*
 * Set post-thumbnail as gallery image size
 */
function aquentro_mphb_loop_room_type_image_size() {
	return 'aquentro-thumb-medium';
}

add_filter( 'mphb_loop_room_type_gallery_main_slider_image_size', 'aquentro_mphb_loop_room_type_image_size' );

add_filter('mphb_loop_room_type_gallery_nav_slider_columns', function (){
    return 5;
});

add_filter('mphb_single_room_type_gallery_columns', function (){
    return 5;
});

add_filter('mphb_sc_booking_form_wrapper_classes', function ($class){
	if(!version_compare(MPHB()->getVersion(), '3.8.3', '>=')){
		return $class;
	}

	if(MPHB()->settings()->main()->getDirectBookingPricing() === 'capacity'){
		$class .= ' is-full-form';
	}

	return $class;
});