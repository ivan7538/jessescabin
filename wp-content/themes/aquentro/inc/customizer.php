<?php
/**
 * Aquentro Theme Customizer
 *
 * @package Aquentro
 */

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Aquentro 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function aquentro_customize_register($wp_customize)
{
    $color_scheme = aquentro_get_color_scheme();

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';

    if (isset($wp_customize->selective_refresh)) {
        $wp_customize->selective_refresh->add_partial('blogname', array(
            'selector' => '.site-title a',
            'container_inclusive' => false,
            'render_callback' => 'aquentro_customize_partial_blogname',
        ));
        $wp_customize->selective_refresh->add_partial('blogdescription', array(
            'selector' => '.site-description',
            'container_inclusive' => false,
            'render_callback' => 'aquentro_customize_partial_blogdescription',
        ));
    }

// Add main text color setting and control.
    $wp_customize->add_setting('main_text_color', array(
        'default' => $color_scheme[0],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_text_color', array(
        'label' => esc_html__('Text Color', 'aquentro'),
        'section' => 'colors',
    )));

    // Add Brand color setting and control.
    $wp_customize->add_setting('brand_color', array(
        'default' => $color_scheme[1],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_color', array(
        'label' => esc_html__('Accent Color', 'aquentro'),
        'section' => 'colors',
		'description' => esc_html__( "The color of some content blocks can't be changed in this menu and requires manual configuration.", 'aquentro' ),
    )));

    // Add Hover Brand color setting and control.
    $wp_customize->add_setting('brand_color_hover', array(
        'default' => $color_scheme[2],
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'postMessage',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'brand_color_hover', array(
        'label' => esc_html__('Accent Hover Color', 'aquentro'),
        'section' => 'colors',
    )));

    $wp_customize->add_panel('aquentro_theme_options', array(
       'title'  => esc_html__('Theme Options')
    ));

    /**
     * FOOTER OPTIONS
     */
    $wp_customize->add_section('aquentro_footer_options', array(
        'title' => esc_html__('Footer Options', 'aquentro'),
        'panel' => 'aquentro_theme_options'
    ));

    $wp_customize->add_setting('aquentro_show_footer_text', array(
        'default' => true,
        'transport' => 'refresh',
        'type' => 'theme_mod',
        'sanitize_callback' => 'aquentro_sanitize_checkbox'
    ));
    $wp_customize->add_control('aquentro_show_footer_text', array(
            'label' => esc_html__('Show Footer Text?', 'aquentro'),
            'section' => 'aquentro_footer_options',
            'type' => 'checkbox',
            'settings' => 'aquentro_show_footer_text'
        )
    );

    $wp_customize->add_setting('aquentro_footer_text', array(
        'default' => esc_html_x('&copy; %1$s All Rights Reserved.', 'Default footer text. %1$s - current year', 'aquentro'),
        'transport' => 'postMessage',
        'type' => 'theme_mod',
        'sanitize_callback' => 'aquentro_sanitize_text'
    ));
    $wp_customize->add_control('aquentro_footer_text', array(
            'label' => esc_html__('Footer Text', 'aquentro'),
            'description' => esc_html__('Use %1$s to insert the current year. Doesn`t work for Live Preview.', 'aquentro'),
            'section' => 'aquentro_footer_options',
            'type' => 'textarea',
            'settings' => 'aquentro_footer_text'
        )
    );

    $wp_customize->add_setting('aquentro_footer_image', array(
        'default' => get_template_directory_uri() . '/images/footer_skyline.png',
        'transport' => 'postMessage',
        'type' => 'theme_mod',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
		    $wp_customize,
		    'aquentro_footer_image',
		    array(
			    'label'      => __( 'Footer Image', 'theme_name' ),
			    'section'    => 'aquentro_footer_options',
			    'settings'   => 'aquentro_footer_image'
		    )
	    )
    );

	$wp_customize->add_setting( 'aquentro_footer_padding_top', array(
		'transport' => 'postMessage',
		'type' => 'theme_mod',
		'default' => 80,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'aquentro_footer_padding_top', array(
		'type' => 'number',
		'section' => 'aquentro_footer_options',
		'label' => __( 'Footer Padding Top', 'aquentro' ),
		'description' => __( 'Default is 80px', 'aquentro' ),
	) );

	$wp_customize->add_setting( 'aquentro_footer_padding_bottom', array(
		'transport' => 'postMessage',
		'type' => 'theme_mod',
		'default' => 240,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'aquentro_footer_padding_bottom', array(
		'type' => 'number',
		'section' => 'aquentro_footer_options',
		'label' => __( 'Footer Padding Bottom', 'aquentro' ),
		'description' => __( 'Default is 240px', 'aquentro' ),
	) );
}

add_action('customize_register', 'aquentro_customize_register', 11);

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Aquentro 1.2
 * @see aquentro_customize_register()
 *
 * @return void
 */
function aquentro_customize_partial_blogname()
{
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Aquentro 1.2
 * @see aquentro_customize_register()
 *
 * @return void
 */
function aquentro_customize_partial_blogdescription()
{
    bloginfo('description');
}

function aquentro_sanitize_checkbox( $input ){
    if ($input == 1) {
        return 1;
    } else {
        return '';
    }
}

function aquentro_sanitize_text($txt){
    return wp_kses_post($txt);
}

function aquentro_sanitize_select( $input, $setting ){

    //input must be a slug: lowercase alphanumeric characters, dashes and underscores are allowed only
    $input = sanitize_key($input);

    //get the list of possible select options
    $choices = $setting->manager->get_control( $setting->id )->choices;

    //return input if valid or return default option
    return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

}

/**
 * Registers color schemes for Aquentro.
 *
 * Can be filtered with {@see 'aquentro_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Main Text Color.
 * 5. Secondary Text Color.
 *
 * @since Aquentro 1.0
 *
 * @return array An associative array of color scheme options.
 */
function aquentro_get_color_schemes()
{
    /**
     * Filter the color schemes registered for use with Aquentro.
     *
     * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
     *
     * @since Aquentro 1.0
     *
     * @param array $schemes {
     *     Associative array of color schemes data.
     *
     * @type array $slug {
     *         Associative array of information for setting up the color scheme.
     *
     * @type string $label Color scheme label.
     * @type array $colors HEX codes for default colors prepended with a hash symbol ('#').
     *                              Colors are defined in the following order: Main background, page
     *                              background, link, main text, secondary text.
     *     }
     * }
     */
    return apply_filters('aquentro_color_schemes', array(
        'default' => array(
            'label' => esc_html__('Default', 'aquentro'),
            'colors' => array(
                '#484848',
                '#7a68e2',
                '#9688e4',
            ),
        )
    ));
}

if (!function_exists('aquentro_get_color_scheme')) :
    /**
     * Retrieves the current Aquentro color scheme.
     *
     * Create your own aquentro_get_color_scheme() function to override in a child theme.
     *
     * @since Aquentro 1.0
     *
     * @return array An associative array of either the current or default color scheme HEX values.
     */
    function aquentro_get_color_scheme()
    {
        $color_scheme_option = get_theme_mod('color_scheme', 'default');
        $color_schemes = aquentro_get_color_schemes();

        if (array_key_exists($color_scheme_option, $color_schemes)) {
            return $color_schemes[$color_scheme_option]['colors'];
        }

        return $color_schemes['default']['colors'];
    }
endif; // aquentro_get_color_scheme

if (!function_exists('aquentro_get_color_scheme_choices')) :
    /**
     * Retrieves an array of color scheme choices registered for Aquentro.
     *
     * Create your own aquentro_get_color_scheme_choices() function to override
     * in a child theme.
     *
     * @since Aquentro 1.0
     *
     * @return array Array of color schemes.
     */
    function aquentro_get_color_scheme_choices()
    {
        $color_schemes = aquentro_get_color_schemes();
        $color_scheme_control_options = array();

        foreach ($color_schemes as $color_scheme => $value) {
            $color_scheme_control_options[$color_scheme] = $value['label'];
        }

        return $color_scheme_control_options;
    }
endif; // aquentro_get_color_scheme_choices


if (!function_exists('aquentro_sanitize_color_scheme')) :
    /**
     * Handles sanitization for Aquentro color schemes.
     *
     * Create your own aquentro_sanitize_color_scheme() function to override
     * in a child theme.
     *
     * @since Aquentro 1.0
     *
     * @param string $value Color scheme name value.
     *
     * @return string Color scheme name.
     */
    function aquentro_sanitize_color_scheme($value)
    {
        $color_schemes = aquentro_get_color_scheme_choices();

        if (!array_key_exists($value, $color_schemes)) {
            return 'default';
        }

        return $value;
    }
endif; // aquentro_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Aquentro 1.0
 *
 * @see wp_add_inline_style()
 */
function aquentro_color_scheme_css()
{
    $color_scheme_option = get_theme_mod('color_scheme', 'default');

    // Don't do anything if the default color scheme is selected.
    if ('default' === $color_scheme_option) {
        return;
    }

    $color_scheme = aquentro_get_color_scheme();


    // If we get this far, we have a custom color scheme.
    $colors = array(
        'main_text_color' => $color_scheme[0],
        'brand_color' => $color_scheme[1],
        'secondary_text_color' => $color_scheme[2],

    );

    $color_scheme_css = aquentro_get_color_scheme_css($colors);

    wp_add_inline_style('aquentro-style', $color_scheme_css);
}

add_action('wp_enqueue_scripts', 'aquentro_color_scheme_css');

/**
 * Returns CSS for the color schemes.
 *
 * @since Aquentro 1.0
 *
 * @param array $colors Color scheme colors.
 *
 * @return string Color scheme CSS.
 */
function aquentro_get_color_scheme_css($colors)
{
    $colors = wp_parse_args($colors, array(
        'main_text_color' => '',
        'brand_color' => '',
        'brand_color_hover' => '',
    ));


    return <<<CSS
	/* Color Scheme */
	
	/* Brand Color */
	a,
	.search-form button:hover,
	.jetpack-testimonial-shortcode.column-1 .testimonial-entry .testimonial-entry-title a:hover,
	.main-navigation a:hover,
	.main-navigation .current_page_item > a,
    .main-navigation .current-menu-item > a,
    .main-navigation .current_page_ancestor > a,
    .main-navigation .current-menu-ancestor > a,
    .main-navigation .menu-item-has-children .current_page_item > a,
    .main-navigation .menu-item-has-children .current-menu-item > a,
    .main-navigation .menu-item-has-children .current_page_ancestor > a,
    .main-navigation .menu-item-has-children .current-menu-ancestor > a,
    .content-left-menu-container .content-left-menu li a:hover,
    .post-navigation a:hover .post-title,
    .footer-navigation .theme-social-menu a[href*="twitter.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="facebook.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="plus.google.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="pinterest.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="foursquare.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="yahoo.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="skype:"]:hover, 
    .footer-navigation .theme-social-menu a[href*="yelp.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="linkedin.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="viadeo.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="xing.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="soundcloud.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="spotify.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="last.fm"]:hover, 
    .footer-navigation .theme-social-menu a[href*="youtube.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="vimeo.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="vine.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="flickr.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="500px.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="instagram.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="wordpress.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="wordpress.org"]:hover, 
    .footer-navigation .theme-social-menu a[href*="tumblr.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="reddit.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="dribbble.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="stumbleupon.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="digg.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="behance.net"]:hover, 
    .footer-navigation .theme-social-menu a[href*="delicious.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="deviantart.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="play.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="wikipedia.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="apple.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="github.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="github.io"]:hover, 
    .footer-navigation .theme-social-menu a[href*="windows.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="tripadvisor."]:hover, 
    .footer-navigation .theme-social-menu a[href*="slideshare.net"]:hover, 
    .footer-navigation .theme-social-menu a[href*=".rss"]:hover, 
    .footer-navigation .theme-social-menu a[href*="vk.com"]:hover,
    .widget.widget_wpcom_social_media_icons_widget a.genericon:hover,
    body.search .site-main .entry-footer a:hover,
    body.archive .site-main .entry-footer a:hover,
    body.blog .site-main .entry-footer a:hover,
    .sticky-post,
    .entry-title a:hover,
    .comment-author .fn a:hover,
    .site-footer .theme-social-menu li a:hover,
    .site-footer .footer-widget-area .widget a:hover,
    .elementor-widget .aquentro-slider .carousel-item .slide-wrapper .slide-title a:hover,
    .elementor-widget .aquentro-content-block .number,
    .elementor-widget .aquentro-content-block .block-title a:hover,
    .entry-content .elementor-slick-slider ul.slick-dots li button:before,
    .entry-content .elementor-slick-slider ul.slick-dots li.slick-active button:before,
    .mphb-calendar .datepick-ctrl a,
    .datepick-popup .datepick-ctrl a,
    .datepick-popup .mphb-datepick-popup .datepick-month td .datepick-today,
    .mphb-view-details-button,
    .mphb-service-title > a:hover{
		color: {$colors['brand_color']};
	}
		
	.jetpack-testimonial-shortcode.column-1 .testimonial-entry .testimonial-featured-image:after,
	.jetpack-testimonial-shortcode.column-1 .slick-dots li:hover:before,
	.jetpack-testimonial-shortcode.column-1 .slick-dots li.slick-active:before,
	.main-navigation ul ul a:before,
	.main-navigation a:before,
	.tagcloud a:hover {
	    background: {$colors['brand_color']};
	}
	
    mark, ins ,code, kbd, tt, var, blockquote:before,
    .button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    .pagination .prev:before,
    .pagination .next:before,
    .elementor-widget .aquentro-slider-wrapper .aquentro-slider .slick-prev:before, 
    .elementor-widget .aquentro-slider-wrapper .aquentro-slider .slick-next:before,
    .entry-content .elementor-slick-slider .slick-next:before,
    .entry-content .elementor-slick-slider .slick-prev:before,
    .mphb-calendar.mphb-datepick .datepick-month td .mphb-booked-date,
    body .mphb-flexslider .flexslider ul.flex-direction-nav a:before,
    body .flexslider ul.flex-direction-nav a:before{
		background-color: {$colors['brand_color']};
	}
	
	.button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"]{
        border: 1px solid {$colors['brand_color']};
    }
    select:focus,
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="search"]:focus,
    input[type="number"]:focus,
    input[type="tel"]:focus,
    input[type="range"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="week"]:focus,
    input[type="time"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="color"]:focus,
    textarea:focus {
        border-color: {$colors['brand_color']};
    }
	
	.elementor-widget-button .elementor-button,
	.elementor-widget-button.elementor-button-info .elementor-button:hover{
        background-color: {$colors['brand_color']} !important;
    }
	
	
	.entry-child-pages-list .more-link:hover, .entry-child-pages-list .more-link:focus,
    button:hover,
    button:focus,
    .button:hover,
    .button:focus,
    input[type="button"]:hover,
    input[type="button"]:focus,
    input[type="reset"]:hover,
    input[type="reset"]:focus,
    input[type="submit"]:hover,
    input[type="submit"]:focus{
        border-color: {$colors['brand_color_hover']};
		background-color: {$colors['brand_color_hover']};
	}
	
	.more-link:hover,
	.elementor-widget .aquentro-content-block .more-link:hover,
	.mphb-view-details-button:hover, .mphb-view-details-button:focus{
	    color: {$colors['brand_color_hover']};
	}
	
	.elementor-widget-button .elementor-button:hover,
	 .elementor-widget-button.elementor-button-info .elementor-button{
      background-color: {$colors['brand_color_hover']} !important;
    }

	/* Main Text Color */
	body,
	select,
    input[type="text"],
    input[type="email"],
    input[type="url"],
    input[type="password"],
    input[type="search"],
    input[type="number"],
    input[type="tel"],
    input[type="range"],
    input[type="date"],
    input[type="month"],
    input[type="week"],
    input[type="time"],
    input[type="datetime"],
    input[type="datetime-local"],
    input[type="color"],
    textarea,
    .main-navigation ul ul a,
    .main-navigation.toggled .menu-toggle-wrapper button,
    .pagination .prev,
    .pagination .next,
    .tagcloud a,
    .site-header,
    body .mphb-flexslider .flexslider ul.flex-direction-nav a,
    body .flexslider ul.flex-direction-nav a,
    .mphb_checkout-services-list li label, .mphb_sc_checkout-services-list li label,
    .mphb-rate-chooser .mphb-room-rate-variant label,
    .mphb-gateways-list .mphb-gateway label,
    .homepage-widget-area .mphb_sc_search-form .mphb-rooms-quantity-wrapper select option, 
    .homepage-widget-area .mphb-booking-form .mphb-rooms-quantity-wrapper select option, 
    .homepage-widget-area .mphb_widget_search-form .mphb-rooms-quantity-wrapper select option,
    body.single .mphb_room_type .mphb-booking-form .mphb-rooms-quantity-wrapper,
    .mphb-calendar .datepick-ctrl .datepick-cmd:hover,
    .datepick-popup .datepick-ctrl .datepick-cmd:hover,
    .mphb-calendar .datepick-month-header, .mphb-calendar .datepick-month-header select, .mphb-calendar .datepick-month-header input,
    .datepick-popup .datepick-month-header,
    .datepick-popup .datepick-month-header select,
    .datepick-popup .datepick-month-header input,
    .mphb-calendar .datepick-month a,
    .datepick-popup .datepick-month a,
    .mphb-calendar.mphb-datepick .datepick-month td .mphb-available-date,
    .mphb-calendar.mphb-datepick .datepick-month td .mphb-booked-date,
    .aquentro-slider-wrapper .aquentro-slider .carousel-item .slide-wrapper .slide-content ,
    .aquentro-slider-wrapper .aquentro-slider .slick-prev, aquentro-slider-wrapper .aquentro-slider .slick-next,
    .homepage-widget-area select{
		color: {$colors['main_text_color']};
	}
		 body  .datepick{
		color: {$colors['main_text_color']}!important;
	}
	a:focus {
      outline-color: {$colors['main_text_color']};
    }

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since Aquentro 1.0
 */
function aquentro_color_scheme_css_template()
{
    $colors = array(
        'main_text_color' => '{{ data.main_text_color }}',
        'brand_color' => '{{ data.brand_color }}',
        'brand_color_hover' => '{{ data.brand_color_hover }}',
    );
    ?>
    <script type="text/html" id="tmpl-aquentro-color-scheme">
        <?php echo aquentro_get_color_scheme_css($colors); ?>
    </script>
    <?php
}

add_action('customize_controls_print_footer_scripts', 'aquentro_color_scheme_css_template');


/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Aquentro 1.0
 *
 * @see wp_add_inline_style()
 */
function aquentro_brand_color_css()
{
    $color_scheme = aquentro_get_color_scheme();
    $default_color = $color_scheme[1];
    $brand_color = get_theme_mod('brand_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($brand_color === $default_color) {
        return;
    }

    $css = '	
	a,
	.search-form button:hover,
	.jetpack-testimonial-shortcode.column-1 .testimonial-entry .testimonial-entry-title a:hover,
	.main-navigation a:hover,
	.main-navigation .current_page_item > a,
    .main-navigation .current-menu-item > a,
    .main-navigation .current_page_ancestor > a,
    .main-navigation .current-menu-ancestor > a,
    .main-navigation .menu-item-has-children .current_page_item > a,
    .main-navigation .menu-item-has-children .current-menu-item > a,
    .main-navigation .menu-item-has-children .current_page_ancestor > a,
    .main-navigation .menu-item-has-children .current-menu-ancestor > a,
    .content-left-menu-container .content-left-menu li a:hover,
    .post-navigation a:hover .post-title,
    .footer-navigation .theme-social-menu a[href*="twitter.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="facebook.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="plus.google.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="pinterest.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="foursquare.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="yahoo.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="skype:"]:hover, 
    .footer-navigation .theme-social-menu a[href*="yelp.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="linkedin.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="viadeo.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="xing.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="soundcloud.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="spotify.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="last.fm"]:hover, 
    .footer-navigation .theme-social-menu a[href*="youtube.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="vimeo.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="vine.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="flickr.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="500px.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="instagram.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="wordpress.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="wordpress.org"]:hover, 
    .footer-navigation .theme-social-menu a[href*="tumblr.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="reddit.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="dribbble.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="stumbleupon.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="digg.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="behance.net"]:hover, 
    .footer-navigation .theme-social-menu a[href*="delicious.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="deviantart.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="play.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="wikipedia.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="apple.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="github.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="github.io"]:hover, 
    .footer-navigation .theme-social-menu a[href*="windows.com"]:hover, 
    .footer-navigation .theme-social-menu a[href*="tripadvisor."]:hover, 
    .footer-navigation .theme-social-menu a[href*="slideshare.net"]:hover, 
    .footer-navigation .theme-social-menu a[href*=".rss"]:hover, 
    .footer-navigation .theme-social-menu a[href*="vk.com"]:hover,
    .widget.widget_wpcom_social_media_icons_widget a.genericon:hover,
    .menu-toggle:hover, .menu-toggle:focus,
    .main-navigation.toggled .menu-toggle:hover, 
    .main-navigation.toggled .menu-toggle:focus,
    body.search .site-main .entry-footer a:hover,
    body.archive .site-main .entry-footer a:hover,
    body.blog .site-main .entry-footer a:hover,
    .sticky-post,
    .entry-title a:hover,
    .comment-author .fn a:hover,
    .site-footer .theme-social-menu li a:hover,
    .site-footer .footer-widget-area .widget a:hover,
    .elementor-widget .aquentro-slider .carousel-item .slide-wrapper .slide-title a:hover,
    .elementor-widget .aquentro-content-block .number,
    .elementor-widget .aquentro-content-block .block-title a:hover,
    .entry-content .elementor-slick-slider ul.slick-dots li button:before,
    .entry-content .elementor-slick-slider ul.slick-dots li.slick-active button:before,
    .mphb-calendar .datepick .datepick-ctrl a,
    .datepick-popup .datepick .datepick-ctrl a,
    .datepick-popup .datepick.mphb-datepick-popup .datepick-month td .datepick-today,
    .button.mphb-view-details-button,
    .mphb-service-title > a:hover{
		color: %1$s;
	}
		
	.jetpack-testimonial-shortcode.column-1 .testimonial-entry .testimonial-featured-image:after,
	.jetpack-testimonial-shortcode.column-1 .slick-dots li:hover:before,
	.jetpack-testimonial-shortcode.column-1 .slick-dots li.slick-active:before,
	.main-navigation ul ul a:before,
	.main-navigation a:before,
	.tagcloud a:hover {
	    background: %1$s;
	}
	
    mark, ins ,code, kbd, tt, var, blockquote:before,
    .button,
    .entry-child-pages-list .more-link,
	button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    .pagination .prev:before,
    .pagination .next:before,
    .elementor-widget .aquentro-slider-wrapper .aquentro-slider .slick-prev:before, 
    .elementor-widget .aquentro-slider-wrapper .aquentro-slider .slick-next:before,
    .entry-content .elementor-slick-slider .slick-next:before,
    .entry-content .elementor-slick-slider .slick-prev:before,
    .mphb-calendar.mphb-datepick .datepick-month td .mphb-booked-date,
    body .mphb-flexslider.flexslider ul.flex-direction-nav li a:before,
    body .flexslider ul.flex-direction-nav a:before{
		background-color: %1$s;
	}
	
	.entry-child-pages-list .more-link,
	button,
	.button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"]{
        border: 1px solid %1$s;
    }
    select:focus,
    input[type="text"]:focus,
    input[type="email"]:focus,
    input[type="url"]:focus,
    input[type="password"]:focus,
    input[type="search"]:focus,
    input[type="number"]:focus,
    input[type="tel"]:focus,
    input[type="range"]:focus,
    input[type="date"]:focus,
    input[type="month"]:focus,
    input[type="week"]:focus,
    input[type="time"]:focus,
    input[type="datetime"]:focus,
    input[type="datetime-local"]:focus,
    input[type="color"]:focus,
    textarea:focus {
        border-color: %1$s;
    }
	
	.elementor-widget-button .elementor-button,
	.elementor-widget-button.elementor-button-info .elementor-button:hover{
        background-color: %1$s !important;
    }
	
	';
    wp_add_inline_style('aquentro-style', sprintf($css, $brand_color));
}

add_action('wp_enqueue_scripts', 'aquentro_brand_color_css', 11);

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Aquentro 1.0
 *
 * @see wp_add_inline_style()
 */
function aquentro_main_text_color_css()
{
    $color_scheme = aquentro_get_color_scheme();
    $default_color = $color_scheme[0];
    $main_text_color = get_theme_mod('main_text_color', $default_color);

    // Don't do anything if the current color is the default.
    if ($main_text_color === $default_color) {
        return;
    }

    $css = '
		body,
        select,
        input[type="text"],
        input[type="email"],
        input[type="url"],
        input[type="password"],
        input[type="search"],
        input[type="number"],
        input[type="tel"],
        input[type="range"],
        input[type="date"],
        input[type="month"],
        input[type="week"],
        input[type="time"],
        input[type="datetime"],
        input[type="datetime-local"],
        input[type="color"],
        textarea,
        .main-navigation ul ul a,
        .main-navigation.toggled .menu-toggle-wrapper button,
        .pagination .prev,
        .pagination .next,
        .tagcloud a,
        .site-header,
        body .mphb-flexslider .flexslider ul.flex-direction-nav a,
        body .flexslider ul.flex-direction-nav a,
        .mphb_checkout-services-list li label, .mphb_sc_checkout-services-list li label,
        .mphb-rate-chooser .mphb-room-rate-variant label,
        .mphb-gateways-list .mphb-gateway label,
        .homepage-widget-area .mphb_sc_search-form .mphb-rooms-quantity-wrapper select option, 
        .homepage-widget-area .mphb-booking-form .mphb-rooms-quantity-wrapper select option, 
        .homepage-widget-area .mphb_widget_search-form .mphb-rooms-quantity-wrapper select option,
        body.single .mphb_room_type .mphb-booking-form .mphb-rooms-quantity-wrapper,
        .mphb-calendar .datepick-ctrl .datepick-cmd:hover,
        .datepick-popup .datepick-ctrl .datepick-cmd:hover,
        .mphb-calendar .datepick-month-header, .mphb-calendar .datepick-month-header select, .mphb-calendar .datepick-month-header input,
        .datepick-popup .datepick-month-header,
        .datepick-popup .datepick-month-header select,
        .datepick-popup .datepick-month-header input,
        .mphb-calendar .datepick-month a,
        .datepick-popup .datepick-month a,
        .mphb-calendar.mphb-datepick .datepick-month td .mphb-available-date,
        .mphb-calendar.mphb-datepick .datepick-month td .mphb-booked-date,
        .elementor-widget .aquentro-slider-wrapper .aquentro-slider .carousel-item .slide-wrapper .slide-content,
        .elementor-widget .aquentro-slider-wrapper .aquentro-slider .slick-prev, .elementor-widget .aquentro-slider .slick-next,
        .homepage-widget-area select{
            color: %1$s;
        }
        body  .datepick{
            color: %1$s !important;
        }
        a:focus {
          outline-color: %1$s;
        }
	';
    wp_add_inline_style('aquentro-style', sprintf($css, $main_text_color));
}

add_action('wp_enqueue_scripts', 'aquentro_main_text_color_css', 11);


/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Aquentro 1.0
 *
 * @see wp_add_inline_style()
 */
function aquentro_brand_color_hover_css()
{
    $color_scheme = aquentro_get_color_scheme();
    $default_color = $color_scheme[2];
    $brand_color_hover = get_theme_mod('brand_color_hover', $default_color);

    // Don't do anything if the current color is the default.
    if ($brand_color_hover === $default_color) {
        return;
    }

    $css = '
        .entry-child-pages-list .more-link:hover, .entry-child-pages-list .more-link:focus,
        button:hover,
        button:focus,
        .button:hover,
        .button:focus,
        input[type="button"]:hover,
        input[type="button"]:focus,
        input[type="reset"]:hover,
        input[type="reset"]:focus,
        input[type="submit"]:hover,
        input[type="submit"]:focus{
            border-color: %1$s;
            background-color: %1$s;
        }
        
        .more-link:hover,
        .elementor-widget .aquentro-content-block .more-link:hover,
        .button.mphb-view-details-button:hover, .button.mphb-view-details-button:focus{
            color: %1$s;
        }
        
        .elementor-widget-button .elementor-button:hover,
         .elementor-widget-button.elementor-button-info .elementor-button{
          background-color: %1$s !important;
        }
	';

    wp_add_inline_style('aquentro-style', sprintf($css, $brand_color_hover));
}

add_action('wp_enqueue_scripts', 'aquentro_brand_color_hover_css', 11);


/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 */
function aquentro_customize_control_js()
{
    wp_enqueue_script('color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array(
        'customize-controls',
        'iris',
        'underscore',
        'wp-util'
    ), aquentro_get_theme_version(), true);
    wp_localize_script('color-scheme-control', 'colorScheme', aquentro_get_color_schemes());
}

add_action('customize_controls_enqueue_scripts', 'aquentro_customize_control_js');

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 */
function aquentro_customize_preview_js()
{
    wp_enqueue_script('aquentro-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array('customize-preview'), aquentro_get_theme_version(), true);
}

add_action('customize_preview_init', 'aquentro_customize_preview_js');

function aquentro_update_elementor_colors(){


    $color_scheme = aquentro_get_color_scheme();

    // If we get this far, we have a custom color scheme.
    $colors = array(
        'main_text_color' => $color_scheme[0],
        'brand_color' => $color_scheme[1],
        'secondary_text_color' => $color_scheme[2],

    );


    $brand_color = get_theme_mod('brand_color', $colors['brand_color']);
    $main_text_color = get_theme_mod('main_text_color', $colors['main_text_color']);
    $secondary_text_color = get_theme_mod('brand_color_hover', $colors['secondary_text_color']);

//    var_dump($secondary_text_color);die;

    $elementor_color_pallet = array (
        1 => '#222222',
        2 => '#222222',
        3 => $main_text_color,
        4 => $brand_color,
    );
    update_option( 'elementor_scheme_color', $elementor_color_pallet );

    $elementor_scheme_color_picker = array(
        $brand_color,
        '#222222',
        $main_text_color,
        '#475764',
        $secondary_text_color,
        $secondary_text_color,
        '#909090',
        '#ffffff'
    );
    update_option('elementor_scheme_color-picker', $elementor_scheme_color_picker);

    \Elementor\Plugin::instance()->files_manager->clear_cache();
}

add_action( 'customize_save_after', 'aquentro_update_elementor_colors' );