<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Aquentro_Engine_Content_Block extends Widget_Base {

    public function get_name() {
        return 'aquentro-content-block';
    }
    public function get_categories() {
        return [ 'aquentro-elements' ];
    }

    public function get_id() {
        return 'aquentro-content-block';
    }

    public function get_title() {
        return esc_html__( 'Aquentro content block', 'aquentro-engine' );
    }

    public function get_icon() {
        return 'eicon-shortcode';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_block',
            [
                'label' => esc_html__( 'Content block', 'aquentro-engine' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
          'block_number', [
              'label' => esc_html__('Block Number', 'aquentro-engine'),
              'type'    => Controls_Manager::TEXT
            ]
        );

        $this->add_control(
          'block_title', [
              'label' => esc_html__('Block Title', 'aquentro-engine'),
              'type'    => Controls_Manager::TEXT,
              'default' => esc_html('Title')
            ]
        );

        $this->add_control(
          'block_content', [
              'label' => esc_html__('Block Content', 'aquentro-engine'),
              'type'    => Controls_Manager::TEXTAREA,
              'default' => esc_html('Content')
            ]
        );

        $this->add_control(
            'block_link_text', [
                'label' => esc_html__('Link Text', 'aquentro-engine'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Read more', 'aquentro-engine')
            ]
        );

        $this->add_control(
            'block_link',
            [
                'label' => esc_html__( 'Link', 'aquentro-engine' ),
                'type' => Controls_Manager::URL,
            ]
        );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings();


        ?>
        <div class="aquentro-content-block">
            <div class="content-block-wrapper">
               <div class="number">
                   <?php
                   echo esc_html($settings['block_number']);
                   ?>
                   <span class="square"></span>
               </div>
               <h2 class="block-title">
                   <?php
                   $target = $settings['block_link']['is_external'] ? ' target="_blank"' : '';
                   $nofollow = $settings['block_link']['nofollow'] ? ' rel="nofollow"' : '';
                   if($settings['block_link']['url']){
                       printf('<a href="%1$s"' . $target . $nofollow .'>%2$s</a>',
                           esc_url($settings['block_link']['url']),
                           esc_html($settings['block_title']));
                   }else{
                       echo esc_html($settings['block_title']);
                   }
                   ?>
               </h2>
                <div class="block-content">
                    <?php
                    echo esc_html($settings['block_content']);
                    if($settings['block_link']['url'] && $settings['block_link_text']){
                        echo '<a href="'.esc_url($settings['block_link']['url']).'" ' . $target . $nofollow .' class="more-link">'.esc_html($settings['block_link_text']).'</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php



    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Aquentro_Engine_Content_Block());

