<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Aquentro_Engine_Advanced_Carousel extends Widget_Base {

    public function get_name() {
        return 'aquentro-carousel';
    }
    public function get_categories() {
        return [ 'aquentro-elements' ];
    }

    public function get_id() {
        return 'aquentro-carousel';
    }

    public function get_title() {
        return esc_html__( 'Aquentro carousel', 'aquentro-engine' );
    }
    public function get_script_depends() {
        return ['slick-slider', 'aquentro-carousel'];
    }

    public function get_style_depends(){
        return ['slick-style'];
    }

    public function get_icon() {
        return 'eicon-shortcode';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_carousel',
            [
                'label' => esc_html__( 'Slider', 'aquentro-engine' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'slide_title', [
                'label' => esc_html__( 'Title', 'aquentro-engine' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Slide Title' , 'aquentro-engine' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_content', [
                'label' => esc_html__( 'Content', 'aquentro-engine' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Slide Content' , 'aquentro-engine' ),
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'slide_image', [
                'label' => esc_html__('Slide Image', 'aquentro-engine'),
                'type'  => Controls_Manager::MEDIA
            ]
        );

        $repeater->add_control(
            'slide_link_text', [
                'label' => esc_html__('Link Text', 'aquentro-engine'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read more', 'aquentro-engine')
            ]
        );

        $repeater->add_control(
            'slide_link',
            [
                'label' => esc_html__( 'Link', 'aquentro-engine' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->add_control(
            'slider_items',
            [
                'label'     => esc_html__('Slider Items', 'aquentro-engine'),
                'type'      => Controls_Manager::REPEATER,
                'fields'     => $repeater->get_controls(),
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings();

        if($settings['slider_items']):
            ?>
            <div class="aquentro-slider-wrapper">
                <div class="slider-counter">
                    <span class="current">01</span>
                    <span class="total">/01</span>
                </div>
                <div class="aquentro-slider">
                    <?php
                    foreach ($settings['slider_items'] as $item):
                        ?>
                        <div class="carousel-item">
                            <div class="slide-thumbnail">
                                <?php
                                echo wp_get_attachment_image($item['slide_image']['id'], 'post-thumbnail');
                                ?>
                            </div>
                            <div class="slide-wrapper">
                                <h2 class="slide-title">
                                <?php
                                    $target = $item['slide_link']['is_external'] ? ' target="_blank"' : '';
                                    $nofollow = $item['slide_link']['nofollow'] ? ' rel="nofollow"' : '';

                                    if($item['slide_link']['url']){
                                        printf('<a href="%1$s"' . $target . $nofollow .'>%2$s</a>',
                                            esc_url($item['slide_link']['url']),
                                            esc_html($item['slide_title']));
                                    }else {
                                        echo esc_html($item['slide_title']);
                                    }
                                ?>
                                </h2>
                                <div class="slide-content">
                                <?php
                                    echo wp_kses($item['slide_content'], 'post');
                                    if($item['slide_link']['url'] && $item['slide_link_text']){
                                        echo '<a href="'.esc_url($item['slide_link']['url']).'" ' . $target . $nofollow .' class="more-link">'.esc_html($item['slide_link_text']).'</a>';
                                    }
                                ?>
                                </div>

                            </div>
                        </div>
                        <?php
                    endforeach;
                    ?>
                </div>
            </div>
            <?php
        endif;
    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Aquentro_Engine_Advanced_Carousel());

