<?php
/**
 * Plugin Name: Aquentro Engine
 * Plugin URI:  https://motopress.com
 * Description: Aquentro Engine
 * Version:     0.0.3
 * Author:      MotoPress
 * Author URI:  https://motopress.com
 * Text Domain: aquentro-engine
 * Domain Path: /languages
 */

if ( !class_exists('Aquentro_Engine') ) :

    final class Aquentro_Engine
    {

        /**
         * The single instance of the class.
         */
        protected static $_instance = null;
        private $prefix;
        private $theme_prefix;

        /**
         * Main Aquentro_Engine Instance.
         *
         * Ensures only one instance of WooCommerce is loaded or can be loaded.
         *
         * @since
         * @static
         * @see AquentroEngine_Instance()
         * @return Aquentro_Engine - Main instance.
         */
        public static function instance()
        {
            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        public function __construct()
        {
            $this->prefix = 'aquentro_engine';
            $this->theme_prefix = 'aquentro';
            /*
             *  Path to classes folder in Plugin
             */

            define('AQUENTRO_ENGINE_PATH', plugin_dir_path(__FILE__) );
            define('AQUENTRO_ENGINE_INCLUDES_PATH', plugin_dir_path(__FILE__) . 'includes/');
            define('AQUENTRO_ENGINE_PLUGIN_URL', plugin_dir_url(__FILE__));

            $this->include_files();

            add_action('plugins_loaded', array($this, 'aquentro_engine_plugins_loaded'));
            add_action( 'wp_enqueue_scripts', array($this, 'aquentro_engine_scripts' ));

        }

        /**
         * Load plugin textdomain.
         *
         * @access public
         * @return void
         */
        function aquentro_engine_plugins_loaded()
        {
            load_plugin_textdomain('aquentro-engine', false, basename(dirname(__FILE__)) . '/languages/');

        }

        /**
         * Get prefix.
         *
         * @access public
         * @return sting
         */
        public function get_prefix()
        {
            return $this->prefix . '_';
        }

        /**
         * Get theme prefix.
         *
         * @access public
         * @return sting
         */
        public function get_theme_prefix()
        {
            return $this->theme_prefix . '_';
        }

        /**
         * Is theme aquentroengine.
         *
         * @access public
         * @return sting
         */
        public static function is_aquentroengine_theme()
        {

            if (get_template() === 'aquentro') {
                return true;
            }

            return false;
        }

        public function include_files()
        {

            include_once AQUENTRO_ENGINE_PATH . 'functions.php';

            /**
             * Include Elementor widgets
             */
            include_once AQUENTRO_ENGINE_INCLUDES_PATH . 'elementor/elementor.php';


        }

        /**
         *  Enqueue scripts/styles
         */
        public function aquentro_engine_scripts(){

        }

    }

    /**
     * Main instance of Aquentro_Engine_Instance.
     *
     * Returns the main instance of WC to prevent the need to use globals.
     *
     * @since
     * @return
     */
    function aquentro_engine_instance()
    {
        return Aquentro_Engine::instance();
    }

    /*
     * Global for backwards compatibility.
     */
    $GLOBALS['aquentro_engine_instance'] = aquentro_engine_instance();

endif;