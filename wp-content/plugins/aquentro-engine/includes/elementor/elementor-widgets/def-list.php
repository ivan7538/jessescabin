<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Aquentro_Engine_Definitions_List extends Widget_Base {

    public function get_name() {
        return 'aquentro-definitions-list';
    }
    public function get_categories() {
        return [ 'aquentro-elements' ];
    }

    public function get_id() {
        return 'aquentro-definitions-list';
    }

    public function get_title() {
        return esc_html__( 'Aquentro definitions list', 'aquentro-engine' );
    }

    public function get_icon() {
        return 'eicon-shortcode';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_block',
            [
                'label' => esc_html__( 'List', 'aquentro-engine' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'aquentro-engine'),
                'type'  => Controls_Manager::TEXT
            ]
        );

        $repeater->add_control(
            'definition',
            [
                'label' => esc_html__('Definition', 'aquentro-engine'),
                'type'  => Controls_Manager::TEXTAREA
            ]
        );

        $this->add_control(
            'def-list',
            [
                'label' => esc_html__('List', 'aquentro-engine'),
                'type'  => Controls_Manager::REPEATER,
                'fields'    => $repeater->get_controls(),
                'title_field'   => '{{{ title }}}'
            ]
        );

        $this->end_controls_section();


    }

    protected function render( $instance = [] ) {

        $settings = $this->get_settings();

        $list = $settings['def-list'];
        if($list):
        ?>
        <div class="aquentro-definitions">
            <ul>
                <?php
                foreach ($list as $list_item):
                ?>
                <li>
                    <span class="def-title"><?php echo esc_html($list_item['title']);?></span>
                    <span class="def"><?php echo esc_html($list_item['definition']);?></span>
                </li>
                <?php
                endforeach;
                ?>
            </ul>
        </div>
        <?php
        endif;
    }

    protected function content_template() {}

    public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Aquentro_Engine_Definitions_List());

