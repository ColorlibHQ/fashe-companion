<?php
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Fashe Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */



// Make sure the same class is not loaded twice in free/premium versions.
if ( !class_exists( 'Fashe_El_Widgets' ) ) {
    /**
     * Main Fashe Elementor Widgets Class
     *
     *
     * @since 1.7.0
     */
    final class Fashe_El_Widgets {
        /**
         * Fashe Companion Core Version
         *
         * Holds the version of the plugin.
         *
         * @since 1.7.0
         * @since 1.7.1 Moved from property with that name to a constant.
         *
         * @var string The plugin version.
         */
        const  VERSION = '1.0' ;
        /**
         * Minimum Elementor Version
         *
         * Holds the minimum Elementor version required to run the plugin.
         *
         * @since 1.7.0
         * @since 1.7.1 Moved from property with that name to a constant.
         *
         * @var string Minimum Elementor version required to run the plugin.
         */
        const  MINIMUM_ELEMENTOR_VERSION = '1.7.0';
        /**
         * Minimum PHP Version
         *
         * Holds the minimum PHP version required to run the plugin.
         *
         * @since 1.7.0
         * @since 1.7.1 Moved from property with that name to a constant.
         *
         * @var string Minimum PHP version required to run the plugin.
         */
        const  MINIMUM_PHP_VERSION = '5.4' ;
        /**
         * Instance
         *
         * Holds a single instance of the `Press_Elements` class.
         *
         * @since 1.7.0
         *
         * @access private
         * @static
         *
         * @var Press_Elements A single instance of the class.
         */
        private static  $_instance = null ;

        /**
         * Instance
         *
         * Ensures only one instance of the class is loaded or can be loaded.
         *
         * @since 1.7.0
         *
         * @access public
         * @static
         *
         * @return Press_Elements An instance of the class.
         */
        public static function instance() {
            if ( is_null( self::$_instance ) ) {
                self::$_instance = new self();
            }
            return self::$_instance;
        }

        /**
         * Clone
         *
         * Disable class cloning.
         *
         * @since 1.7.0
         *
         * @access protected
         *
         * @return void
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'fashe-companion' ), '1.7.0' );
        }

        /**
         * Wakeup
         *
         * Disable unserializing the class.
         *
         * @since 1.7.0
         *
         * @access protected
         *
         * @return void
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden.
            _doing_it_wrong( __FUNCTION__, esc_html__( 'Cheatin&#8217; huh?', 'fashe-companion' ), '1.7.0' );
        }

        /**
         * Constructor
         *
         * Initialize the fashe elementor widgets.
         *
         * @since 1.7.0
         *
         * @access public
         */
        public function __construct() {
           
            $this->init_hooks();
            do_action( 'press_elements_loaded' );
        }


        /**
         * Init Hooks
         *
         * Hook into actions and filters.
         *
         * @since 1.7.0
         *
         * @access private
         */
        private function init_hooks() {
            add_action( 'init', [ $this, 'init' ] );
        }


        /**
         * Init Fashe Elementor Widget
         *
         * Load the plugin after Elementor (and other plugins) are loaded.
         *
         * @since 1.0.0
         * @since 1.7.0 The logic moved from a standalone function to this class method.
         *
         * @access public
         */
        public function init() {

            if ( !did_action( 'elementor/loaded' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
                return;
            }

            // Check for required Elementor version

            if ( !version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
                return;
            }

            // Check for required PHP version

            if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
                add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
                return;
            }

            // Add new Elementor Categories
            add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_category' ] );
            // Register Widget Scripts
            add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_widget_scripts' ] );
            // Register Widget Styles
            add_action( 'admin_enqueue_scripts', [ $this, 'register_admin_styles' ] );
            add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'register_widget_styles' ] );
            add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_widget_styles' ] );
            add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'register_widget_styles' ] );

            // Register New Widgets
            add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );

            // Fashe Companion enqueue style and scripts
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_element_widgets_scripts' ] );

        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have Elementor installed or activated.
         *
         * @since 1.1.0
         * @since 1.7.0 Moved from a standalone function to a class method.
         *
         * @access public
         */
        public function admin_notice_missing_main_plugin() {
            $message = sprintf(
            /* translators: 1: Elementor */
                esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'fashe-companion' ),
                '<strong>' . esc_html__( 'Fashe Theme', 'fashe-companion' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'fashe-companion' ) . '</strong>'
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required Elementor version.
         *
         * @since 1.1.0
         * @since 1.7.0 Moved from a standalone function to a class method.
         *
         * @access public
         */
        public function admin_notice_minimum_elementor_version() {
            $message = sprintf(
            /* translators: 1: Elementor 2: Required Elementor version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'fashe-companion' ),
                '<strong>' . esc_html__( 'Fashe', 'fashe-companion' ) . '</strong>',
                '<strong>' . esc_html__( 'Elementor', 'fashe-companion' ) . '</strong>',
                self::MINIMUM_ELEMENTOR_VERSION
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Admin notice
         *
         * Warning when the site doesn't have a minimum required PHP version.
         *
         * @access public
         */
        public function admin_notice_minimum_php_version() {
            $message = sprintf(
            /* translators: 1: PHP 2: Required PHP version */
                esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'fashe-companion' ),
                '<strong>' . esc_html__( 'Fashe', 'fashe-companion' ) . '</strong>',
                '<strong>' . esc_html__( 'PHP', 'fashe-companion' ) . '</strong>',
                self::MINIMUM_PHP_VERSION
            );
            printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
        }

        /**
         * Add new Elementor Categories
         *
         * Register new widget categories for Fashe widgets.
         *
         * @access public
         */
        public function add_elementor_category() {

            \Elementor\Plugin::instance()->elements_manager->add_category( 'fashe-elements', [
                'title' => __( 'Fashe Elements', 'fashe-companion' ),
            ], 1 );

        }

        /**
         * Enqueue Widgets Scripts
         *
         * Enqueue custom scripts required to run fashe elementor widgets.
         *
         * @access public
         */
        public function enqueue_element_widgets_scripts() {
            // googlr map api key
            $apiKey  = fashe_opt('fashe_map_apikey');

            /******************
                Enqueue Css
            ******************/
            wp_enqueue_style( 'slick', plugins_url( 'assets/css/slick.css', __FILE__ ), array(), '1.0.0', 'all' );

            /*****************
                Enqueue Js
            ******************/
                
            // google api js
            wp_register_script( 'maps-googleapis', '//maps.googleapis.com/maps/api/js?key='.$apiKey );
            // mailchimp validate js
            wp_register_script( 'mc-validate', '//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js' );
            // countdowntime js
            wp_enqueue_script( 'countdowntime', plugins_url( 'assets/js/countdowntime.js', __FILE__ ), array('jquery'), '1.0.0', true );
            // map custom js
            wp_register_script( 'fashe-map-custom', plugins_url( 'assets/js/map-custom.js', __FILE__ ), array('jquery'), '1.0', true );
            // slick js
            wp_enqueue_script( 'slick', plugins_url( 'assets/js/slick.min.js', __FILE__ ), array('jquery'), '1.0', true );
            // slick custom js
            wp_enqueue_script( 'fashe-slick-custom', plugins_url( 'assets/js/slick-custom.js', __FILE__ ), array('jquery'), '1.0', true );

            // fashe companion main js
            wp_enqueue_script( 'fashe-companion', plugins_url( 'assets/js/fashe-companion-main.js', __FILE__ ), array('jquery'), '1.0', true );


        }

        /**
         * Register Widget Scripts
         *
         * Register custom scripts required to run.
         *
         * @access public
         */
        public function register_widget_scripts() {


        }

        /**
         * Register Widget Styles
         *
         * Register custom styles required to run Fashe.
         *
         * @access public
         */
        public function register_widget_styles() {
            // Typing Effect
            wp_enqueue_style( 'fashe-companion-elementor-edit', plugins_url( '/assets/css/elementor-edit.css', __FILE__ ) );
        }


        /**
         * Register Admin Styles
         *
         * Register custom styles required to Fashe Companion WordPress Admin Dashboard.
         *
         * @access public
         */
        public function register_admin_styles() {
        }

        /**
         * Register New Widgets
         *
         * Include Fashe Companion widgets files and register them in Elementor.
         *
         * @since 1.0.0
         * @since 1.7.1 The method moved to this class.
         *
         * @access public
         */
        public function on_widgets_registered() {
            $this->include_widgets();
            $this->register_widgets();
        }

        /**
         * Include Widgets Files
         *
         * Load fashe companion widgets files.
         *
         * @since 1.0.0
         * @since 1.7.1 The method moved to this class.
         *
         * @access private
         */
        private function include_widgets() {
            
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-banner-countdown.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-banner-video.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-blog.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-feature-products.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-instagram.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-our-products.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-product-categories.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-shipping.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-slider.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-about.php';
            require_once FASHE_COMPANION_EW_DIR_PATH . 'widgets/fashe-contact.php';

        }

        /**
         * Register Widgets
         *
         * Register fashe companion widgets.
         *
         * @since 1.0.0
         * @since 1.7.1 The method moved to this class.
         *
         * @access private
         */
        private function register_widgets() {
            //  Register elements widgets   
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Banner_Counter() );
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Banner_Video() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Blog() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Feature_Products() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Instagram() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Our_Products() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Product_Categories() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Shipping() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Slider() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_About() ); 
            \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Fasheelementor\Widgets\Fashe_Contact() ); 

        }

    }
}
// Make sure the same function is not loaded twice in free/premium versions.



if ( !function_exists( 'fashe_el_widgets_load' ) ) {
    /**
     * Load Fashe elementor widget
     *
     * Main instance of Press_Elements.
     *
     * @since 1.0.0
     * @since 1.7.0 The logic moved from this function to a class method.
     */
    function fashe_el_widgets_load() {
        return Fashe_El_Widgets::instance();
    }

    // Run fashe elementor widget
    fashe_el_widgets_load();
}


add_action( 'wp_enqueue_scripts', function() {
    wp_dequeue_style('elementor-global');
});