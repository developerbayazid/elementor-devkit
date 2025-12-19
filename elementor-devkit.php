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
        // bring in the controls
    }

    private function init_controls() {
       
    }

    private function init_widgets() {

    }

    public static function get_instance() {
        if ( self::$instance ) {
            return self::$instance;
        }
        self::$instance = new self();
        return self::$instance;
    }


}

Elementor_DevKit::get_instance();