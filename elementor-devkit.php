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
 * Requires Plugins: elementor
 * Elementor tested up to: 3.25.0
 * Elementor Pro tested up to: 3.25.0
 * 
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// require_once plugin_dir_path( __FILE__ ) . '/vendor/autoload.php';

final class Elementor_DevKit {

    private static $instance;

    const VERSION = '1.0.0';
    const ELEMENTOR_MINIMUM_VERSION = '3.25.0';
    const PHP_MINIMUM_VERSION = '7.0';

    private function __construct() {
        add_action( 'init', [ $this, 'i18n' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    public function i18n() {
        load_plugin_textdomain( 'devkit' );
    }

    public function init_plugin() {
        // Check PHP version
        if ( version_compare( PHP_VERSION, self::PHP_MINIMUM_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'php_version_notice' ] );
            return;
        }
        
        // Check Elementor installed & activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'elementor_missing_notice' ] );
            return;
        }

        // Check Elementor minimum version
        if ( version_compare( ELEMENTOR_VERSION, self::ELEMENTOR_MINIMUM_VERSION, '<' ) ) {
            add_action( 'admin_notices', [ $this, 'elementor_version_notice' ] );
            return;
        }

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

    public function php_version_notice() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php
                printf(
                    esc_html__(
                        'Elementor DevKit requires PHP version %s or greater.',
                        'devkit'
                    ),
                    self::PHP_MINIMUM_VERSION
                );
                ?>
            </p>
        </div>
        <?php
    }

    public function elementor_missing_notice() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php esc_html_e(
                    'Elementor DevKit requires Elementor to be installed and activated.',
                    'devkit'
                ); ?>
            </p>
        </div>
        <?php
    }

    public function elementor_version_notice() {
        ?>
        <div class="notice notice-error">
            <p>
                <?php
                printf(
                    esc_html__(
                        'Elementor DevKit requires Elementor version %s or greater.',
                        'devkit'
                    ),
                    self::ELEMENTOR_MINIMUM_VERSION
                );
                ?>
            </p>
        </div>
        <?php
    }



}

Elementor_DevKit::get_instance();