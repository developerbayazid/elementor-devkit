<?php

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Css_Filter;

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

		$this->get_menus();

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

	private function get_menus() {
		$menus = wp_get_nav_menus();
		
		$menu_list = [];

		foreach ($menus as $menu) {
			$menu_list[$menu->slug] = $menu->name;
		}

		return $menu_list;
	}

	private function get_default_slug() {
		$menus = $this->get_menus();
		return key($menus);
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

		$this->start_controls_section(
			'layout_section', 
			[
				'label' => esc_html__( 'Layout', 'devKit' ),
				'tab' => Controls_Manager::TAB_CONTENT
			]
		);

		$this->add_control(
			'menu',
			[
				'label' => esc_html__( 'Menu', 'devKit' ),
				'type' => Controls_Manager::SELECT,
				'default' => $this->get_default_slug(),
				'options' => $this->get_menus(),
				'label_block' => false
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'style_section',
			[
				'label' => esc_html__( 'Main Menu',  'devKit'  ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'menu_background_color',
			[
				'label' => esc_html__( 'Background Color', 'devKit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#0128B9',
				'selectors' => [
					'{{WRAPPER}} .devKit-menu' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography',
				'label'    => esc_html__( 'Typography', 'devKit' ),
				'selector' => '{{WRAPPER}} .devKit-menu li a',
			]
		);

		$this->start_controls_tabs('menu_item_style');

	
		$this->start_controls_tab(
			'menu_item_normal',
			[
				'label' => esc_html__('Normal', 'devKit')
			]
		);

		$this->add_control(
			'menu_color_normal',
			[
				'label' => esc_html__( 'Color', 'devKit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .devKit-menu a' => 'color: {{VALUE}}',
				],
			]
		);



		$this->end_controls_tab();
		$this->start_controls_tab(
			'menu_item_hover',
			[
				'label' => esc_html__('Hover', 'devKit')
			]
		);

		$this->add_control(
			'menu_color_hover',
			[
				'label' => esc_html__( 'Color', 'devKit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .devKit-menu a:hover' => 'color: {{VALUE}}',
				],
			]
		);


		
		$this->end_controls_tab();
		$this->start_controls_tab(
			'menu_item_active',
			[
				'label' => esc_html__('Active', 'devKit')
			]
		);

		$this->add_control(
			'menu_color_active',
			[
				'label' => esc_html__( 'Color', 'devKit' ),
				'type' => Controls_Manager::COLOR,
				'default' => '#ededed',
				'selectors' => [
					'{{WRAPPER}} .devKit-menu .current-menu-item > a,
					{{WRAPPER}} .devKit-menu .current-menu-ancestor > a,
					{{WRAPPER}} .devKit-menu .current_page_item > a' => 'color: {{VALUE}}',
				],
			]
		);




		$this->end_controls_tab();

		$this->end_controls_tab();
		$this->end_controls_section();
		

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

		$settings = $this->get_settings_for_display();

		echo wp_nav_menu(
			[
				'menu' => $settings['menu'],
				'container_class' => 'devKit-menu-container',
				'menu_class'      => 'devKit-menu'
			]
		);
	}

    protected function content_template() {
        return parent::content_template();
    }

}