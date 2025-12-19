<?php

use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Have the elementor custom nav menu
 */

class Nav_Menu extends Widget_Base {

   /**
	 * Get widget name.
	 *
	 * Retrieve devKit widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);

		wp_enqueue_script('devKit-js-menu', plugin_dir_url( __FILE__ ) . '../assets/js/menu.js');
		wp_enqueue_style('devKit-css-menu', plugin_dir_url( __FILE__ ) . '../assets/css/menu.css');
	}

	public function get_name(): string {
		return 'devkit-nav-menu';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve devKit widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title(): string {
		return esc_html__( 'DevKit Nav Menu', 'devkit' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve devKit widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon(): string {
		return 'eicon-nav-menu';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the devKit widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories(): array {
		return [ 'devkit-elementor-widget' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the devKit widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords(): array {
		return [ 'devkit-nav-menu', 'Nav', 'Menu' ];
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url(): string {
		return 'https://developers.elementor.com/docs/widgets/';
	}

	/**
	 * Script depends
	 *
	 * @return array
	 */
	public function get_script_depends(): array {
		return ['devKit-js-menu'];
	}

	/**
	 * Style depends
	 *
	 * @return array
	 */
	public function get_style_depends(): array {
		return ['devKit-css-menu'];
	}

	/**
	 * Whether the widget requires inner wrapper.
	 *
	 * Determine whether to optimize the DOM size.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return bool Whether to optimize the DOM size.
	 */
	public function has_widget_inner_wrapper(): bool {
		return false;
	}

	/**
	 * Whether the element returns dynamic content.
	 *
	 * Determine whether to cache the element output or not.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @return bool Whether to cache the element output.
	 */
	protected function is_dynamic_content(): bool {
		return false;
	}

	/**
	 * Register deVkit widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls(): void {

		

	}

	/**
	 * Render devKit widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render(): void {
		echo wp_nav_menu(
			[
				'container_class' => 'devKit-menu-container',
				'menu_class'      => 'devKit-menu'
			]
		);
	}

    protected function content_template() {
        return parent::content_template();
		// echo wp_nav_menu();
    }

}