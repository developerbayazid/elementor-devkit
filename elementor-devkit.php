<?php
/**
 * Plugin Name:       Elementor DevKit
 * Plugin URI:        https://github.com/developerbayazid/
 * Description:       Awesome elementor dev tool kit.
 * Version:           1.0.0
 * Author:            Bayazid Hasan
 * Author URI:        https://github.com/developerbayazid/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       devkit
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';

final class Elementor_DevKit {

    private static $instance;

    const VERSION = '1.0.0';
    const ELEMENTOR_MINIMUM_VERSION = '3.0.0';
    const PHP_MINIMUM_VERSION = '7.0';

    private function __construct() {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    public function i18n() {
        load_plugin_textdomain( 'devkit' );
    }

    public function init_plugin() {
        // Check php version
        // Check elementor installation
        // bring in the widgets classes
        add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );
        add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
        // bring in the controls
    }

    private function init_controls() {
       
    }

    public function init_widgets( $widgets_manager ) {
        require_once( __DIR__ . '/widgets/nav-menu.php' );
        
        $widgets_manager->register( new \Nav_Menu() );
    }

    public static function get_instance() {
        if ( self::$instance ) {
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }

    public function add_elementor_widget_categories( $elements_manager ) {
	    $elements_manager->add_category(
		    'devkit-elementor-widget',
                [
                    'title' => esc_html__( 'DevKit', 'devkit' ),
                    'icon' => 'eicon-import-kit',
                ]
        );       
    }


}

Elementor_DevKit::get_instance();