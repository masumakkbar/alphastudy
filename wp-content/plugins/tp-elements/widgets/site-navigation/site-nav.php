<?php
/**
 * Elementor Classes.
 *
 * @package tp-elements
 */


// Elementor Classes.
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * Class Nav Menu.
 */
class Themephi_Navigation_Menu extends Widget_Base {


	/**
	 * Menu index.
	 *
	 * @access protected
	 * @var $nav_menu_index
	 */
	protected $nav_menu_index = 1;

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'navigation-menu';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'TP Navigation Menu', 'tp-elements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'hfe-icon-navigation-menu';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'pielements_category' ];
	}

	

	/**
	 * Retrieve the menu index.
	 *
	 * Used to get index of nav menu.
	 *
	 * @since 1.3.0
	 * @access protected
	 *
	 * @return string nav index.
	 */
	protected function get_nav_menu_index() {
		return $this->nav_menu_index++;
	}

	/**
	 * Retrieve the list of available menus.
	 *
	 * Used to get the list of available menus.
	 *
	 * @since 1.3.0
	 * @access private
	 *
	 * @return array get WordPress menus list.
	 */
	private function get_available_menus() {

		$menus = wp_get_nav_menus();

		$options = [];

		foreach ( $menus as $menu ) {
			$options[ $menu->slug ] = $menu->name;
		}

		return $options;
	}

	/**
	 * Check if the Elementor is updated.
	 *
	 * @since 1.3.0
	 *
	 * @return boolean if Elementor updated.
	 */
	public static function is_elementor_updated() {
		if ( class_exists( 'Elementor\Icons_Manager' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Register Nav Menu controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {

		$this->register_general_content_controls();
		$this->register_style_content_controls();
		$this->register_dropdown_content_controls();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_general_content_controls() {

		$this->start_controls_section(
			'section_menu',
			[
				'label' => __( 'Menu', 'tp-elements' ),
			]
		);

		$menus = $this->get_available_menus();

		if ( ! empty( $menus ) ) {
			$this->add_control(
				'menu',
				[
					'label'        => __( 'Menu', 'tp-elements' ),
					'type'         => Controls_Manager::SELECT,
					'options'      => $menus,
					'default'      => array_keys( $menus )[0],
					'save_default' => true,
					/* translators: %s Nav menu URL */
					'description'  => sprintf( __( 'Go to the <a href="%s" target="_blank">Menus screen</a> to manage your menus.', 'tp-elements' ), admin_url( 'nav-menus.php' ) ),
				]
			);
		} else {
			$this->add_control(
				'menu',
				[
					'type'            => Controls_Manager::RAW_HTML,
					/* translators: %s Nav menu URL */
					'raw'             => sprintf( __( '<strong>There are no menus in your site.</strong><br>Go to the <a href="%s" target="_blank">Menus screen</a> to create one.', 'tp-elements' ), admin_url( 'nav-menus.php?action=edit&menu=0' ) ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				]
			);
		}

		$this->add_control(
			'menu_last_item',
			[
				'label'     => __( 'Last Menu Item', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'options'   => [
					'none' => __( 'Default', 'tp-elements' ),
					'cta'  => __( 'Button', 'tp-elements' ),
				],
				'default'   => 'none',
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_control(
			'schema_support',
			[
				'label'        => __( 'Enable Schema Support', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tp-elements' ),
				'label_off'    => __( 'No', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'render_type'  => 'template',
				'separator'    => 'before',
			]
		);

		$current_theme = wp_get_theme();

		if ( 'Twenty Twenty-One' === $current_theme->get( 'Name' ) ) {
			$this->add_control(
				'hide_theme_icons',
				[
					'label'        => __( 'Hide + & - Sign', 'tp-elements' ),
					'type'         => Controls_Manager::SWITCHER,
					'label_on'     => __( 'Yes', 'tp-elements' ),
					'label_off'    => __( 'No', 'tp-elements' ),
					'return_value' => 'yes',
					'default'      => 'no',
					'prefix_class' => 'hfe-nav-menu__theme-icon-',
				]
			);
		}

		$this->end_controls_section();

			$this->start_controls_section(
				'section_layout',
				[
					'label' => __( 'Layout', 'tp-elements' ),
				]
			);

			$this->add_control(
				'layout',
				[
					'label'   => __( 'Layout', 'tp-elements' ),
					'type'    => Controls_Manager::SELECT,
					'default' => 'horizontal',
					'options' => [
						'horizontal' => __( 'Horizontal', 'tp-elements' ),
						'vertical'   => __( 'Vertical', 'tp-elements' ),
						'expandible' => __( 'Expanded', 'tp-elements' ),
						'flyout'     => __( 'Flyout', 'tp-elements' ),
					],
				]
			);

			$this->add_control(
				'navmenu_align',
				[
					'label'        => __( 'Alignment', 'tp-elements' ),
					'type'         => Controls_Manager::CHOOSE,
					'options'      => [
						'left'    => [
							'title' => __( 'Left', 'tp-elements' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'  => [
							'title' => __( 'Center', 'tp-elements' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'   => [
							'title' => __( 'Right', 'tp-elements' ),
							'icon'  => 'eicon-h-align-right',
						],
						'justify' => [
							'title' => __( 'Justify', 'tp-elements' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'      => 'left',
					'condition'    => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
					'prefix_class' => 'hfe-nav-menu__align-',
				]
			);

			$this->add_control(
				'flyout_layout',
				[
					'label'     => __( 'Flyout Orientation', 'tp-elements' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'left',
					'options'   => [
						'left'  => __( 'Left', 'tp-elements' ),
						'right' => __( 'Right', 'tp-elements' ),
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'flyout_type',
				[
					'label'       => __( 'Appear Effect', 'tp-elements' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'normal',
					'label_block' => false,
					'options'     => [
						'normal' => __( 'Slide', 'tp-elements' ),
						'push'   => __( 'Push', 'tp-elements' ),
					],
					'render_type' => 'template',
					'condition'   => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_responsive_control(
				'hamburger_align',
				[
					'label'                => __( 'Hamburger Align', 'tp-elements' ),
					'type'                 => Controls_Manager::CHOOSE,
					'default'              => 'center',
					'options'              => [
						'left'   => [
							'title' => __( 'Left', 'tp-elements' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center' => [
							'title' => __( 'Center', 'tp-elements' ),
							'icon'  => 'eicon-h-align-center',
						],
						'right'  => [
							'title' => __( 'Right', 'tp-elements' ),
							'icon'  => 'eicon-h-align-right',
						],
					],
					'selectors_dictionary' => [
						'left'   => 'margin-right: auto',
						'center' => 'margin: 0 auto',
						'right'  => 'margin-left: auto',
					],
					'selectors'            => [
						'{{WRAPPER}} .hfe-nav-menu__toggle,
						{{WRAPPER}} .hfe-nav-menu-icon' => '{{VALUE}}',
					],
					'condition'            => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'label_block'          => false,
					'frontend_available'   => true,
				]
			);

			$this->add_responsive_control(
				'hamburger_menu_align',
				[
					'label'              => __( 'Menu Items Align', 'tp-elements' ),
					'type'               => Controls_Manager::CHOOSE,
					'options'            => [
						'flex-start'    => [
							'title' => __( 'Left', 'tp-elements' ),
							'icon'  => 'eicon-h-align-left',
						],
						'center'        => [
							'title' => __( 'Center', 'tp-elements' ),
							'icon'  => 'eicon-h-align-center',
						],
						'flex-end'      => [
							'title' => __( 'Right', 'tp-elements' ),
							'icon'  => 'eicon-h-align-right',
						],
						'space-between' => [
							'title' => __( 'Justify', 'tp-elements' ),
							'icon'  => 'eicon-h-align-stretch',
						],
					],
					'default'            => 'space-between',
					'condition'          => [
						'layout' => [ 'expandible', 'flyout' ],
					],
					'selectors'          => [
						'{{WRAPPER}} li.menu-item a' => 'justify-content: {{VALUE}};',
						'{{WRAPPER}} li .elementor-button-wrapper' => 'text-align: {{VALUE}};',
						'{{WRAPPER}}.hfe-menu-item-flex-end li .elementor-button-wrapper' => 'text-align: right;',
					],
					'prefix_class'       => 'hfe-menu-item-',
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'submenu_icon',
				[
					'label'        => __( 'Submenu Icon', 'tp-elements' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'arrow',
					'options'      => [
						'arrow'   => __( 'Arrows', 'tp-elements' ),
						'plus'    => __( 'Plus Sign', 'tp-elements' ),
						'classic' => __( 'Classic', 'tp-elements' ),
					],
					'prefix_class' => 'hfe-submenu-icon-',
				]
			);

			$this->add_control(
				'submenu_animation',
				[
					'label'        => __( 'Submenu Animation', 'tp-elements' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'none',
					'options'      => [
						'none'     => __( 'Default', 'tp-elements' ),
						'slide_up' => __( 'Slide Up', 'tp-elements' ),
					],
					'prefix_class' => 'hfe-submenu-animation-',
					'condition'    => [
						'layout' => 'horizontal',
					],
				]
			);

			$this->add_control(
				'link_redirect',
				[
					'label'        => __( 'Action On Menu Click', 'tp-elements' ),
					'type'         => Controls_Manager::SELECT,
					'default'      => 'child',
					'description'  => __( 'For Horizontal layout, this will affect on the selected breakpoint', 'tp-elements' ),
					'options'      => [
						'child'     => __( 'Open Submenu', 'tp-elements' ),
						'self_link' => __( 'Redirect To Self Link', 'tp-elements' ),
					],
					'prefix_class' => 'hfe-link-redirect-',
				]
			);

			$this->add_control(
				'heading_responsive',
				[
					'type'      => Controls_Manager::HEADING,
					'label'     => __( 'Responsive', 'tp-elements' ),
					'separator' => 'before',
					'condition' => [
						'layout' => [ 'horizontal', 'vertical' ],
					],
				]
			);

		$this->add_control(
			'dropdown',
			[
				'label'        => __( 'Breakpoint', 'tp-elements' ),
				'type'         => Controls_Manager::SELECT,
				'default'      => 'tablet',
				'options'      => [
					'mobile' => __( 'Mobile (768px >)', 'tp-elements' ),
					'tablet' => __( 'Tablet (1025px >)', 'tp-elements' ),
					'none'   => __( 'None', 'tp-elements' ),
				],
				'prefix_class' => 'hfe-nav-menu__breakpoint-',
				'condition'    => [
					'layout' => [ 'horizontal', 'vertical' ],
				],
				'render_type'  => 'template',
			]
		);

		$this->add_control(
			'resp_align',
			[
				'label'                => __( 'Alignment', 'tp-elements' ),
				'type'                 => Controls_Manager::CHOOSE,
				'options'              => [
					'left'   => [
						'title' => __( 'Left', 'tp-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'tp-elements' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'tp-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'              => 'center',
				'description'          => __( 'This is the alignement of menu icon on selected responsive breakpoints.', 'tp-elements' ),
				'condition'            => [
					'layout'    => [ 'horizontal', 'vertical' ],
					'dropdown!' => 'none',
				],
				'selectors_dictionary' => [
					'left'   => 'margin-right: auto',
					'center' => 'margin: 0 auto',
					'right'  => 'margin-left: auto',
				],
				'selectors'            => [
					'{{WRAPPER}} .hfe-nav-menu__toggle' => '{{VALUE}}',
				],
			]
		);

		$this->add_control(
			'full_width_dropdown',
			[
				'label'        => __( 'Full Width', 'tp-elements' ),
				'description'  => __( 'Enable this option to stretch the Sub Menu to Full Width.', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tp-elements' ),
				'label_off'    => __( 'No', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'dropdown!' => 'none',
					'layout!'   => 'flyout',
				],
				'render_type'  => 'template',
			]
		);

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Menu Icon', 'tp-elements' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'fas fa-align-justify',
						'library' => 'fa-solid',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_icon',
				[
					'label'       => __( 'Icon', 'tp-elements' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-align-justify',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		if ( $this->is_elementor_updated() ) {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'tp-elements' ),
					'type'        => Controls_Manager::ICONS,
					'label_block' => 'true',
					'default'     => [
						'value'   => 'far fa-window-close',
						'library' => 'fa-regular',
					],
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		} else {
			$this->add_control(
				'dropdown_close_icon',
				[
					'label'       => __( 'Close Icon', 'tp-elements' ),
					'type'        => Controls_Manager::ICON,
					'label_block' => 'true',
					'default'     => 'fa fa-close',
					'condition'   => [
						'dropdown!' => 'none',
					],
				]
			);
		}

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_style_content_controls() {

		$this->start_controls_section(
			'section_style_main-menu',
			[
				'label'     => __( 'Main Menu', 'tp-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'layout!' => 'expandible',
				],
			]
		);

		$this->add_responsive_control(
			'width_flyout_menu_item',
			[
				'label'              => __( 'Flyout Box Width', 'tp-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 500,
						'min' => 100,
					],
				],
				'default'            => [
					'size' => 300,
					'unit' => 'px',
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-flyout-wrapper .hfe-side' => 'width: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-flyout-open.left'  => 'left: -{{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-flyout-open.right' => 'right: -{{SIZE}}{{UNIT}}',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'render_type'        => 'template',
				'frontend_available' => true,
			]
		);

			$this->add_responsive_control(
				'padding_flyout_menu_item',
				[
					'label'              => __( 'Flyout Box Padding', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 30,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .hfe-flyout-content' => 'padding: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_menu_item',
				[
					'label'              => __( 'Horizontal Padding', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.hfe-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} .menu-item a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-nav-menu__layout-vertical .menu-item ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-nav-menu__layout-vertical .menu-item ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-nav-menu__layout-vertical .menu-item ul ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_menu_item',
				[
					'label'              => __( 'Vertical Padding', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.hfe-menu-item, {{WRAPPER}} .menu-item a.hfe-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_space_between',
				[
					'label'              => __( 'Space Between', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}}',
						'body.rtl {{WRAPPER}} .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-left: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav:not(.hfe-nav-menu__layout-horizontal) .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
						'(tablet)body:not(.rtl) {{WRAPPER}}.hfe-nav-menu__breakpoint-tablet .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(mobile)body:not(.rtl) {{WRAPPER}}.hfe-nav-menu__breakpoint-mobile .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-right: 0px',
						'(tablet)body {{WRAPPER}} nav.hfe-nav-menu__layout-vertical .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0px',
						'(mobile)body {{WRAPPER}} nav.hfe-nav-menu__layout-vertical .hfe-nav-menu > li.menu-item:not(:last-child)' => 'margin-bottom: 0px',
					],
					'condition'          => [
						'layout!' => 'expandible',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_row_space',
				[
					'label'              => __( 'Row Spacing', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'body:not(.rtl) {{WRAPPER}} .hfe-nav-menu__layout-horizontal .hfe-nav-menu > li.menu-item' => 'margin-bottom: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'menu_top_space',
				[
					'label'              => __( 'Menu Item Top Spacing', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px', '%' ],
					'range'              => [
						'px' => [
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .hfe-flyout-wrapper .hfe-nav-menu > li.menu-item:first-child' => 'margin-top: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'flyout',
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'bg_color_flyout',
				[
					'label'     => __( 'Background Color', 'tp-elements' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#FFFFFF',
					'selectors' => [
						'{{WRAPPER}} .hfe-flyout-content' => 'background-color: {{VALUE}}',
					],
					'condition' => [
						'layout' => 'flyout',
					],
				]
			);

			$this->add_control(
				'pointer',
				[
					'label'     => __( 'Link Hover Effect', 'tp-elements' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'none',
					'options'   => [
						'none'        => __( 'None', 'tp-elements' ),
						'underline'   => __( 'Underline', 'tp-elements' ),
						'overline'    => __( 'Overline', 'tp-elements' ),
						'double-line' => __( 'Double Line', 'tp-elements' ),
						'framed'      => __( 'Framed', 'tp-elements' ),
						'text'        => __( 'Text', 'tp-elements' ),
					],
					'condition' => [
						'layout' => [ 'horizontal' ],
					],
				]
			);

		$this->add_control(
			'animation_line',
			[
				'label'     => __( 'Animation', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'     => 'Fade',
					'slide'    => 'Slide',
					'grow'     => 'Grow',
					'drop-in'  => 'Drop In',
					'drop-out' => 'Drop Out',
					'none'     => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => [ 'underline', 'overline', 'double-line' ],
				],
			]
		);

		$this->add_control(
			'animation_framed',
			[
				'label'     => __( 'Frame Animation', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'fade',
				'options'   => [
					'fade'    => 'Fade',
					'grow'    => 'Grow',
					'shrink'  => 'Shrink',
					'draw'    => 'Draw',
					'corners' => 'Corners',
					'none'    => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'framed',
				],
			]
		);

		$this->add_control(
			'animation_text',
			[
				'label'     => __( 'Animation', 'tp-elements' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'grow',
				'options'   => [
					'grow'   => 'Grow',
					'shrink' => 'Shrink',
					'sink'   => 'Sink',
					'float'  => 'Float',
					'skew'   => 'Skew',
					'rotate' => 'Rotate',
					'none'   => 'None',
				],
				'condition' => [
					'layout'  => [ 'horizontal' ],
					'pointer' => 'text',
				],
			]
		);

		$this->add_control(
			'style_divider',
			[
				'type' => Controls_Manager::DIVIDER,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'menu_typography',
				'global'    => [
					'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
				],
				'separator' => 'before',
				'selector'  => '{{WRAPPER}} a.hfe-menu-item, {{WRAPPER}} a.hfe-sub-menu-item',
			]
		);

		$this->start_controls_tabs( 'tabs_menu_item_style' );

				$this->start_controls_tab(
					'tab_menu_item_normal',
					[
						'label' => __( 'Normal', 'tp-elements' ),
					]
				);

					$this->add_control(
						'color_menu_item',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_TEXT,
							],
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item, {{WRAPPER}} .sub-menu a.hfe-sub-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item',
						[
							'label'     => __( 'Background Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item, {{WRAPPER}} .sub-menu, {{WRAPPER}} nav.hfe-dropdown, {{WRAPPER}} .hfe-dropdown-expandible' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_hover',
					[
						'label' => __( 'Hover', 'tp-elements' ),
					]
				);

					$this->add_control(
						'color_menu_item_hover',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item:hover,
								{{WRAPPER}} .sub-menu a.hfe-sub-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item,
								{{WRAPPER}} .menu-item a.hfe-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.hfe-menu-item:focus' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_hover',
						[
							'label'     => __( 'Background Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item:hover,
								{{WRAPPER}} .sub-menu a.hfe-sub-menu-item:hover,
								{{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item,
								{{WRAPPER}} .menu-item a.hfe-menu-item.highlighted,
								{{WRAPPER}} .menu-item a.hfe-menu-item:focus' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_hover',
						[
							'label'     => __( 'Link Hover Effect Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'global'    => [
								'default' => Global_Colors::COLOR_ACCENT,
							],
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent a.hfe-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent .sub-menu .hfe-has-submenu-container a:after' => 'background-color: unset',
								'{{WRAPPER}} .hfe-pointer__framed .menu-item.parent a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-pointer__framed .menu-item.parent a.hfe-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_menu_item_active',
					[
						'label' => __( 'Active', 'tp-elements' ),
					]
				);

					$this->add_control(
						'color_menu_item_active',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.hfe-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'bg_color_menu_item_active',
						[
							'label'     => __( 'Background Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item.current-menu-item a.hfe-menu-item,
								{{WRAPPER}} .menu-item.current-menu-ancestor a.hfe-menu-item' => 'background-color: {{VALUE}}',
							],
							'condition' => [
								'layout!' => 'flyout',
							],
						]
					);

					$this->add_control(
						'pointer_color_menu_item_active',
						[
							'label'     => __( 'Link Hover Effect Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent.current-menu-item a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-nav-menu-layout:not(.hfe-pointer__framed) .menu-item.parent.current-menu-item a.hfe-menu-item:after' => 'background-color: {{VALUE}}',
								'{{WRAPPER}} .hfe-nav-menu:not(.hfe-pointer__framed) .menu-item.parent .sub-menu .hfe-has-submenu-container a.current-menu-item:after' => 'background-color: unset',
								'{{WRAPPER}} .hfe-pointer__framed .menu-item.parent.current-menu-item a.hfe-menu-item:before,
								{{WRAPPER}} .hfe-pointer__framed .menu-item.parent.current-menu-item a.hfe-menu-item:after' => 'border-color: {{VALUE}}',
							],
							'condition' => [
								'pointer!' => [ 'none', 'text' ],
								'layout!'  => 'flyout',
							],
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Register Nav Menu General Controls.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function register_dropdown_content_controls() {

		$this->start_controls_section(
			'section_style_dropdown',
			[
				'label' => __( 'Dropdown', 'tp-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'dropdown_description',
				[
					'raw'             => __( '<b>Note:</b> On desktop, below style options will apply to the submenu. On mobile, this will apply to the entire menu.', 'tp-elements' ),
					'type'            => Controls_Manager::RAW_HTML,
					'content_classes' => 'elementor-descriptor',
					'condition'       => [
						'layout!' => [
							'expandible',
							'flyout',
						],
					],
				]
			);

			$this->start_controls_tabs( 'tabs_dropdown_item_style' );

				$this->start_controls_tab(
					'tab_dropdown_item_normal',
					[
						'label' => __( 'Normal', 'tp-elements' ),
					]
				);

					$this->add_control(
						'color_dropdown_item',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item, 
								{{WRAPPER}} .elementor-menu-toggle,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'background_color_dropdown_item',
						[
							'label'     => __( 'Background Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '#fff',
							'selectors' => [
								'{{WRAPPER}} .sub-menu,
								{{WRAPPER}} nav.hfe-dropdown,
								{{WRAPPER}} nav.hfe-dropdown-expandible,
								{{WRAPPER}} nav.hfe-dropdown .menu-item a.hfe-menu-item,
								{{WRAPPER}} nav.hfe-dropdown .menu-item a.hfe-sub-menu-item' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_hover',
					[
						'label' => __( 'Hover', 'tp-elements' ),
					]
				);

					$this->add_control(
						'color_dropdown_item_hover',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item:hover, 
								{{WRAPPER}} .elementor-menu-toggle:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item:hover' => 'color: {{VALUE}}',
							],
						]
					);

					$this->add_control(
						'background_color_dropdown_item_hover',
						[
							'label'     => __( 'Background Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item:hover,
								{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item:hover' => 'background-color: {{VALUE}}',
							],
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_dropdown_item_active',
					[
						'label' => __( 'Active', 'tp-elements' ),
					]
				);

				$this->add_control(
					'color_dropdown_item_active',
					[
						'label'     => __( 'Text Color', 'tp-elements' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active,	
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-item a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-ancestor a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active
							' => 'color: {{VALUE}}',

						],
					]
				);

				$this->add_control(
					'background_color_dropdown_item_active',
					[
						'label'     => __( 'Background Color', 'tp-elements' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active,	
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-item a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .menu-item.current-menu-ancestor a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown .sub-menu .menu-item.current-menu-item a.hfe-sub-menu-item.hfe-sub-menu-item-active' => 'background-color: {{VALUE}}',
						],
						'separator' => 'after',
					]
				);

				$this->end_controls_tabs();

			$this->end_controls_tabs();

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'dropdown_typography',
					'global'    => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'separator' => 'before',
					'selector'  => '
							{{WRAPPER}} .sub-menu li a.hfe-sub-menu-item,
							{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
							{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
							{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_border',
					'selector' => '{{WRAPPER}} nav.hfe-nav-menu__layout-horizontal .sub-menu, 
							{{WRAPPER}} nav:not(.hfe-nav-menu__layout-horizontal) .sub-menu.sub-menu-open,
							{{WRAPPER}} nav.hfe-dropdown .hfe-nav-menu,
						 	{{WRAPPER}} nav.hfe-dropdown-expandible .hfe-nav-menu',
				]
			);

			$this->add_responsive_control(
				'dropdown_border_radius',
				[
					'label'              => __( 'Border Radius', 'tp-elements' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} .sub-menu li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden;',
						'{{WRAPPER}} .sub-menu li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.hfe-dropdown li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown-expandible' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						'{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:first-child' => 'border-top-left-radius: {{TOP}}{{UNIT}}; border-top-right-radius: {{RIGHT}}{{UNIT}};overflow:hidden',
						'{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:last-child' => 'border-bottom-right-radius: {{BOTTOM}}{{UNIT}}; border-bottom-left-radius: {{LEFT}}{{UNIT}};overflow:hidden',
					],
					'frontend_available' => true,
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'      => 'dropdown_box_shadow',
					'exclude'   => [
						'box_shadow_position',
					],
					'selector'  => '{{WRAPPER}} .hfe-nav-menu .sub-menu,
								{{WRAPPER}} nav.hfe-dropdown,
						 		{{WRAPPER}} nav.hfe-dropdown-expandible',
					'separator' => 'after',
				]
			);

			$this->add_responsive_control(
				'width_dropdown_item',
				[
					'label'              => __( 'Dropdown Width (px)', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => 0,
							'max' => 500,
						],
					],
					'default'            => [
						'size' => '220',
						'unit' => 'px',
					],
					'selectors'          => [
						'{{WRAPPER}} ul.sub-menu' => 'width: {{SIZE}}{{UNIT}}',
					],
					'condition'          => [
						'layout' => 'horizontal',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_horizontal_dropdown_item',
				[
					'label'              => __( 'Horizontal Padding', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu li a.hfe-sub-menu-item,
						{{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
						{{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
						'{{WRAPPER}} nav.hfe-dropdown-expandible a.hfe-sub-menu-item,
						{{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 20px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 40px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 60px );padding-right: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .hfe-dropdown .menu-item ul ul ul ul a.hfe-sub-menu-item,
						{{WRAPPER}} .hfe-dropdown-expandible .menu-item ul ul ul ul a.hfe-sub-menu-item' => 'padding-left: calc( {{SIZE}}{{UNIT}} + 80px );padding-right: {{SIZE}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'padding_vertical_dropdown_item',
				[
					'label'              => __( 'Vertical Padding', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'size_units'         => [ 'px' ],
					'default'            => [
						'size' => 15,
						'unit' => 'px',
					],
					'range'              => [
						'px' => [
							'max' => 50,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} .sub-menu a.hfe-sub-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown li a.hfe-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown li a.hfe-sub-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-menu-item,
						 {{WRAPPER}} nav.hfe-dropdown-expandible li a.hfe-sub-menu-item' => 'padding-top: {{SIZE}}{{UNIT}}; padding-bottom: {{SIZE}}{{UNIT}}',
					],
					'frontend_available' => true,
				]
			);

			$this->add_responsive_control(
				'distance_from_menu',
				[
					'label'              => __( 'Top Distance', 'tp-elements' ),
					'type'               => Controls_Manager::SLIDER,
					'range'              => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors'          => [
						'{{WRAPPER}} nav.hfe-nav-menu__layout-horizontal:not(.hfe-dropdown) ul.sub-menu, {{WRAPPER}} nav.hfe-nav-menu__layout-expandible.menu-is-active, {{WRAPPER}} nav.hfe-nav-menu__layout-vertical:not(.hfe-dropdown) ul.sub-menu' => 'margin-top: {{SIZE}}px;',
						'{{WRAPPER}} .hfe-dropdown.menu-is-active' => 'margin-top: {{SIZE}}px;',
					],
					'condition'          => [
						'layout' => [ 'horizontal', 'vertical', 'expandible' ],
					],
					'frontend_available' => true,
				]
			);

			$this->add_control(
				'heading_dropdown_divider',
				[
					'label'     => __( 'Divider', 'tp-elements' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'dropdown_divider_border',
				[
					'label'       => __( 'Border Style', 'tp-elements' ),
					'type'        => Controls_Manager::SELECT,
					'default'     => 'solid',
					'label_block' => false,
					'options'     => [
						'none'   => __( 'None', 'tp-elements' ),
						'solid'  => __( 'Solid', 'tp-elements' ),
						'double' => __( 'Double', 'tp-elements' ),
						'dotted' => __( 'Dotted', 'tp-elements' ),
						'dashed' => __( 'Dashed', 'tp-elements' ),
					],
					'selectors'   => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-style: {{VALUE}};',
					],
				]
			);
			$this->add_control(
				'divider_border_color',
				[
					'label'     => __( 'Border Color', 'tp-elements' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#c4c4c4',
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-color: {{VALUE}};',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

			$this->add_control(
				'dropdown_divider_width',
				[
					'label'     => __( 'Border Width', 'tp-elements' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px' => [
							'max' => 50,
						],
					],
					'default'   => [
						'size' => '1',
						'unit' => 'px',
					],
					'selectors' => [
						'{{WRAPPER}} .sub-menu li.menu-item:not(:last-child), 
						{{WRAPPER}} nav.hfe-dropdown li.menu-item:not(:last-child),
						{{WRAPPER}} nav.hfe-dropdown-expandible li.menu-item:not(:last-child)' => 'border-bottom-width: {{SIZE}}{{UNIT}}',
					],
					'condition' => [
						'dropdown_divider_border!' => 'none',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'style_toggle',
			[
				'label' => __( 'Menu Trigger & Close Icon', 'tp-elements' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_toggle_style' );

		$this->start_controls_tab(
			'toggle_style_normal',
			[
				'label' => __( 'Normal', 'tp-elements' ),
			]
		);

		$this->add_control(
			'toggle_color',
			[
				'label'     => __( 'Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.hfe-nav-menu-icon' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.hfe-nav-menu-icon svg' => 'fill: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'toggle_background_color',
			[
				'label'     => __( 'Background Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-nav-menu-icon' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'toggle_hover',
			[
				'label' => __( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
			'toggle_hover_color',
			[
				'label'     => __( 'Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} div.hfe-nav-menu-icon:hover' => 'color: {{VALUE}}',
					'{{WRAPPER}} div.hfe-nav-menu-icon:hover svg' => 'fill: {{VALUE}}',

				],
			]
		);

		$this->add_control(
			'toggle_hover_background_color',
			[
				'label'     => __( 'Background Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hfe-nav-menu-icon:hover' => 'background-color: {{VALUE}}; padding: 0.35em;',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'toggle_size',
			[
				'label'              => __( 'Icon Size', 'tp-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-nav-menu-icon'     => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .hfe-nav-menu-icon svg' => 'font-size: {{SIZE}}px;line-height: {{SIZE}}px;height: {{SIZE}}px;width: {{SIZE}}px;',
				],
				'frontend_available' => true,
				'separator'          => 'before',
			]
		);

		$this->add_responsive_control(
			'toggle_border_width',
			[
				'label'              => __( 'Border Width', 'tp-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'max' => 10,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-nav-menu-icon' => 'border-width: {{SIZE}}{{UNIT}}; padding: 0.35em;',
				],
				'frontend_available' => true,
			]
		);

		$this->add_responsive_control(
			'toggle_border_radius',
			[
				'label'              => __( 'Border Radius', 'tp-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} .hfe-nav-menu-icon' => 'border-radius: {{SIZE}}{{UNIT}}',
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'close_color_flyout',
			[
				'label'     => __( 'Close Icon Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#7A7A7A',
				'selectors' => [
					'{{WRAPPER}} .hfe-flyout-close'     => 'color: {{VALUE}}',
					'{{WRAPPER}} .hfe-flyout-close svg' => 'fill: {{VALUE}}',

				],
				'condition' => [
					'layout' => 'flyout',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'close_flyout_size',
			[
				'label'              => __( 'Close Icon Size', 'tp-elements' ),
				'type'               => Controls_Manager::SLIDER,
				'range'              => [
					'px' => [
						'min' => 15,
					],
				],
				'selectors'          => [
					'{{WRAPPER}} .hfe-flyout-close,
					{{WRAPPER}} .hfe-flyout-close svg' => 'height: {{SIZE}}px; width: {{SIZE}}px; font-size: {{SIZE}}px; line-height: {{SIZE}}px;',
				],
				'condition'          => [
					'layout' => 'flyout',
				],
				'frontend_available' => true,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'style_button',
			[
				'label'     => __( 'Button', 'tp-elements' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'menu_last_item' => 'cta',
				],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'all_typography',
					'label'    => __( 'Typography', 'tp-elements' ),
					'global'   => [
						'default' => Global_Typography::TYPOGRAPHY_ACCENT,
					],
					'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
				]
			);
			$this->add_responsive_control(
				'padding',
				[
					'label'              => __( 'Padding', 'tp-elements' ),
					'type'               => Controls_Manager::DIMENSIONS,
					'size_units'         => [ 'px', 'em', '%' ],
					'selectors'          => [
						'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'frontend_available' => true,
				]
			);

			$this->start_controls_tabs( '_button_style' );

				$this->start_controls_tab(
					'_button_normal',
					[
						'label' => __( 'Normal', 'tp-elements' ),
					]
				);

					$this->add_control(
						'all_text_color',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_color',
							'label'          => __( 'Background Color', 'tp-elements' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_group_control(
						Group_Control_Border::get_type(),
						[
							'name'     => 'all_border',
							'label'    => __( 'Border', 'tp-elements' ),
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
						]
					);

					$this->add_control(
						'all_border_radius',
						[
							'label'      => __( 'Border Radius', 'tp-elements' ),
							'type'       => Controls_Manager::DIMENSIONS,
							'size_units' => [ 'px', '%' ],
							'selectors'  => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'     => 'all_button_box_shadow',
							'selector' => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button',
						]
					);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'all_button_hover',
					[
						'label' => __( 'Hover', 'tp-elements' ),
					]
				);

					$this->add_control(
						'all_hover_color',
						[
							'label'     => __( 'Text Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover' => 'color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Background::get_type(),
						[
							'name'           => 'all_background_hover_color',
							'label'          => __( 'Background Color', 'tp-elements' ),
							'types'          => [ 'classic', 'gradient' ],
							'selector'       => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover',
							'fields_options' => [
								'color' => [
									'global' => [
										'default' => Global_Colors::COLOR_ACCENT,
									],
								],
							],
						]
					);

					$this->add_control(
						'all_border_hover_color',
						[
							'label'     => __( 'Border Hover Color', 'tp-elements' ),
							'type'      => Controls_Manager::COLOR,
							'default'   => '',
							'selectors' => [
								'{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover' => 'border-color: {{VALUE}};',
							],
						]
					);

					$this->add_group_control(
						Group_Control_Box_Shadow::get_type(),
						[
							'name'      => 'all_button_hover_box_shadow',
							'selector'  => '{{WRAPPER}} .menu-item a.hfe-menu-item.elementor-button:hover',
							'separator' => 'after',
						]
					);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Add itemprop for Navigation Schema.
	 *
	 * @since 1.5.2
	 * @param string $atts link attributes.
	 * @access public
	 */
	public function handle_link_attrs( $atts ) {

		$atts .= ' itemprop="url"';
		return $atts;
	}

	/**
	 * Add itemprop to the li tag of Navigation Schema.
	 *
	 * @since 1.6.0
	 * @param string $value link attributes.
	 * @access public
	 */
	public function handle_li_values( $value ) {

		$value .= ' itemprop="name"';
		return $value;
	}

	/**
	 * Get the menu and close icon HTML.
	 *
	 * @since 1.5.2
	 * @param array $settings Widget settings array.
	 * @access public
	 */
	public function get_menu_close_icon( $settings ) {
		$menu_icon     = '';
		$close_icon    = '';
		$icons         = [];
		$icon_settings = [
			$settings['dropdown_icon'],
			$settings['dropdown_close_icon'],
		];

		foreach ( $icon_settings as $icon ) {
			if ( $this->is_elementor_updated() ) {
				ob_start();
				\Elementor\Icons_Manager::render_icon(
					$icon,
					[
						'aria-hidden' => 'true',
						'tabindex'    => '0',
					]
				);
				$menu_icon = ob_get_clean();
			} else {
				$menu_icon = '<i class="' . esc_attr( $icon ) . '" aria-hidden="true" tabindex="0"></i>';
			}

			array_push( $icons, $menu_icon );
		}

		return $icons;
	}

	/**
	 * Render Nav Menu output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.3.0
	 * @access protected
	 */
	protected function render() { ?>
		<div class="menu-area">
         
		 	<div class="menu_one">   
					  
							 
				<div class="col-cell menu-responsive">  
					<?php
					if ( has_nav_menu( 'menu-1' ) ) {
						// User has assigned menu to this location;
						// output it
						?>
						<nav class="nav navbar">
							<div class="navbar-menu">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'menu-1',
										'menu_id'        => 'primary-menu-main',
										'walker'        => ''
									) );
								?>
							</div>
						</nav>
						<?php
					}
					?>
				</div>  
				
				
				
			<div class="sidebarmenu-area text-right mobilehum">                                    
				<ul class="offcanvas-icon">
					<li class="nav-link-container"> 
						<a href='#' class="nav-menu-link menu-button">
							<span class="dot1"></span>
							<span class="dot2"></span>
							<span class="dot3"></span>
							<span class="dot4"></span>                                          
						</a> 
					</li>
				</ul>                                       
			</div>      
		 	</div>
	 	</div> 
		 
		 
	<?php }		
}