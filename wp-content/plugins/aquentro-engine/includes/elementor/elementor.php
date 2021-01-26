<?php

add_action( 'elementor/elements/categories_registered', function() {
    \Elementor\Plugin::$instance->elements_manager->add_category(
        'aquentro-elements',
        [
            'title' => __( 'Theme Elements', 'aquentro-engine' ),
            'icon' => 'fa fa-plug', //default icon
        ]
    );
} );

add_action( 'elementor/widgets/widgets_registered', 'aquentro_engine_elementor_widgets_registered' );
function aquentro_engine_elementor_widgets_registered() {
    $widgets = array(
        'advanced-carousel/advanced-carousel',
        'content-block',
        'def-list'
    );
    foreach ($widgets as $widget){
        require_once __DIR__ . '/elementor-widgets/'.$widget.'.php';
    }
}

add_action( 'elementor/frontend/after_register_scripts', function() {
   wp_register_script( 'slick-slider', AQUENTRO_ENGINE_PLUGIN_URL . '/assets/slick/slick.min.js', array('jquery'), '1.9.0');
   wp_register_style( 'slick-style', AQUENTRO_ENGINE_PLUGIN_URL . '/assets/slick/slick.css', array(), '1.9.0');
   wp_register_script( 'aquentro-carousel', AQUENTRO_ENGINE_PLUGIN_URL . '/includes/elementor/elementor-widgets/advanced-carousel/advanced-carousel.js', array('jquery','slick-slider'));
});

