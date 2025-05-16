<?php use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * HFE Site Logo widget
 *
 * HFE widget for Site Logo.
 *
 * @since 1.3.0
 */
class Themephi_Offcanvas_Menu extends Widget_Base {

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
		return 'site-offcanvas-menu';
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
		return __( 'Hamburger Menu Masum', 'tp-elements' );
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
		return 'eicon-menu-bar';
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
		return [ 'header_footer_category' ];
	}

	/**
	 * Register Site Logo controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Hamburger Menu Settings', 'tp-elements'),
            ]
        );

        $this->add_control(
            'layout_settings',
            [
                'label'     => __( 'Layout', 'tp-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,               
                
            ]
        );
        $this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Select Hamburger Layuot', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'layout1',
				'options' => [
					'layout1' => esc_html__( 'Hamburger Normal', 'tp-elements'),
					'layout2'  => esc_html__( 'Hamburger Animated', 'tp-elements'),					
				],
				'label_block' => true,
			]
		);

		$this->add_control(
			'normal_style',
			[
				'label' => esc_html__( 'Choose Normal Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Normal Style 1', 'textdomain' ),
					'2' => esc_html__( 'Normal Style 2', 'textdomain' ),
					'3' => esc_html__( 'Normal Style 3', 'textdomain' ),
					'4' => esc_html__( 'Normal Style 4', 'textdomain' ),
					'5' => esc_html__( 'Normal Style 5', 'textdomain' ),
					'6' => esc_html__( 'Normal Style 6', 'textdomain' ),
					'7' => esc_html__( 'Normal Style 7', 'textdomain' ),
				],
				'label_block' => true,
				'condition' => [
					'layout' => ['layout1'],
				],
			]
		);

		$this->add_control(
			'animated_style',
			[
				'label' => esc_html__( 'Choose Animated Style', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '1',
				'options' => [
					'1' => esc_html__( 'Animated Style 1', 'textdomain' ),
					'2' => esc_html__( 'Animated Style 2', 'textdomain' ),
					'3' => esc_html__( 'Animated Style 3', 'textdomain' ),
					'4' => esc_html__( 'Animated Style 4', 'textdomain' ),
					'5' => esc_html__( 'Animated Style 5', 'textdomain' ),
					'6' => esc_html__( 'Animated Style 6', 'textdomain' ),
					'7' => esc_html__( 'Animated Style 7', 'textdomain' ),
					'8' => esc_html__( 'Animated Style 8', 'textdomain' ),
				],
				'label_block' => true,
				'condition' => [
					'layout' => ['layout2'],
				],
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
		    '_offcanvas_menu_style',
		    [
		        'label' => esc_html__( 'Offcanvas Menu Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

 		$this->add_control(
            'menu_bar_settings',
            [
                'label'     => __( 'Menu Bar', 'tp-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,               
                
            ]
        );

		
		$this->add_responsive_control(
		    'menuBar_width',
		    [
		        'label' => esc_html__( 'Menubar Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .nav-menu-link' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'menuBar_height',
		    [
		        'label' => esc_html__( 'MenuBar Height', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 1,
		                'max' => 400,
		            ],
		            '%' => [
		                'min' => 1,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .nav-menu-link' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'menu_bar_width',
			[
				'label' => esc_html__( 'MenuLine Width', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .tp-hamburger .tp-line' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'layout' => ['layout1'],
				],
			]
		);
		$this->add_control(
			'menu_bar_height',
			[
				'label' => esc_html__( 'MenuLine Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} .tp-hamburger .tp-line' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-hamburger .tp-svg-line' => 'stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
		    'menu_bar_margin',
		    [
		        'label' => esc_html__( 'MenuLine Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .tp-hamburger ' => 'gap: {{SIZE}}{{UNIT}};',
		        ],
				'condition' => [
					'layout' => ['layout1'],
				],
		    ]
		);

		$this->start_controls_tabs( '_tabs_menu_bar' );

		$this->start_controls_tab(
		    '_tab_menu_bar_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'menu_bar_line_bg_color',
		    [
		        'label' => esc_html__( 'BarLine Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-hamburger .tp-line' => 'background-color: {{VALUE}}', 
		            '{{WRAPPER}} .tp-hamburger .tp-svg-line' => 'stroke: {{VALUE}}', 
		        ],
		    ]
		);

		$this->add_control(
		    'menu_bar_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .nav-menu-link' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'menu_bar_box_shadow',
		        'label' => esc_html__( 'Shadow', 'tp-elements' ),
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .nav-menu-link',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'menu_bar_border',
		        'selector' => '{{WRAPPER}} .nav-menu-link',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_menu_bar_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'menu_bar_line_bg_color_hover',
		    [
		        'label' => esc_html__( 'MenuLIne Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-hamburger:hover .tp-line' => 'background-color: {{VALUE}}',
					'{{WRAPPER}} .tp-hamburger:hover .tp-svg-line' => 'stroke: {{VALUE}}', 
		        ],
		    ]
		);

		$this->add_control(
		    'menu_bar_bg_color_hover',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .nav-menu-link:hover' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'menu_bar_box_shadow_hover',
		        'label' => esc_html__( 'Shadow', 'tp-elements' ),
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .nav-menu-link:hover',
		    ]
		);

		$this->add_control(
		    'menu_bar_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .nav-menu-link:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
		    'menu_bar_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .nav-menu-link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);	


 		$this->add_control(
            'icon_settings',
            [
                'label'     => __( 'Icon Settings', 'tp-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,               
                
            ]
        );

        $this->add_control(
            'dot_icon_color',
            [
                'label'     => __( 'Off Canvas Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    '{{WRAPPER}} svg rect' => 'fill: {{VALUE}}', 
                ],
                'condition' => [
                	'layout' => '2',
                ],
                
            ]
        );

        $this->add_control(
            'bar_icon_color',
            [
                'label'     => __( 'Off Canvas Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    '{{WRAPPER}} .offcanvas-icon .nav-link-container .nav-menu-link span' => 'background: {{VALUE}}', 
                ],
                'condition' => [
                	'layout' => '1',
                ],
                
            ]
        );

		$this->add_control(
            'dot_icon_color_hover',
            [
                'label'     => __( 'Off Canvas Icon Hover Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} .nav-menu-link:hover svg rect' => 'fill: {{VALUE}}',
                    '{{WRAPPER}} .nav-menu-link:hover svg rect' => 'fill: {{VALUE}}',
                
                ],
                'separator' => 'before',
                
            ]
        );
        $this->add_control(
			'width',
			[
				'label' => esc_html__( 'Off Canvas Icon Box Width', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} ul.offcanvas-icon .nav-link-container' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'height',
			[
				'label' => esc_html__( 'Off Canvas Icon Box Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				
				'selectors' => [
					'{{WRAPPER}} ul.offcanvas-icon .nav-link-container' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
            'dot_icon_color_box',
            [
                'label'     => __( 'Off Canvas Icon Box BG', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} ul.offcanvas-icon .nav-link-container' => 'background: {{VALUE}}',
                ],
                
            ]
        );

        $this->add_responsive_control(
			'dropdown_border_radius',
			[
				'label'              => __( 'Border Radius', 'tp-elements' ),
				'type'               => Controls_Manager::DIMENSIONS,
				'size_units'         => [ 'px', '%' ],
				'selectors'          => [
					'{{WRAPPER}} ul.offcanvas-icon .nav-link-container'        => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],
				'frontend_available' => true,
			]
		);

        $this->add_control(
			'icon_align',
			[
				'label' => esc_html__( 'Alignment', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-text-align-right',
					],
				],
				
				'toggle' => true,
			]
		);

        $this->add_control(
            'content_settings',
            [
                'label'     => __( 'Content Area Settings', 'tp-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                
                
            ]
        );

       
        $this->add_group_control(
        	\Elementor\Group_Control_Background::get_type(),
        	[
        		'name' => 'background',
        		'label' => esc_html__( 'Background', 'tp-elements' ),
        		'types' => [ 'classic', 'gradient', 'video' ],
        		'selector' => '.menu-wrap-off',
        				
        		]
        );

        $this->add_control(
            'close_icon_settings',
            [
                'label'     => __( 'Close Icon Settings', 'tp-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
                
                
            ]
        );

        $this->add_control(
            'close_icon',
            [
                'label'     => __( 'Close Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '.menu-wrap-off .inner-offcan .nav-link-container .close-button' => 'color: {{VALUE}}',
                ],
                
            ]
        );
         $this->add_control(
            'close_icon_bg',
            [
                'label'     => __( 'Close Icon Background', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '.menu-wrap-off .inner-offcan .nav-link-container .close-button' => 'background: {{VALUE}}',
                ],
                
            ]
        );

		$this->add_control(
            'responsive_settings',
            [
                'label'     => __( 'Responsive Menu Color Settings', 'tp-elements'),
                'type'      => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
				   
                
            ]
        );

        $this->add_control(
            'menu_icon',
            [
                'label'     => __( 'Menu Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '#mobile_menu .submenu-button' => 'color: {{VALUE}}',
                ],
                
            ]
        );

		$this->add_control(
            'menu_icon_bg',
            [
                'label'     => __( 'Menu Icon Bg', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '#mobile_menu .submenu-button' => 'background: {{VALUE}}',
                ],

            ]
        );
         $this->add_control(
            'menu_text',
            [
                'label'     => __( 'Menu Text Hover Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [                   
                    '.sidenav .widget_nav_menu ul li a:hover' => 'color: {{VALUE}}',
					'.sidenav .widget_nav_menu ul li.current-menu-item a' => 'color: {{VALUE}}',
                ],
                
            ]
        );
		$this->end_controls_section();

	}
	
	protected function render() {
		
		$settings = $this->get_settings_for_display(); 
		?>

		<style>

		.nav-menu-link {
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.tp-hamburger .tp-line{
			width: 50px;
			height: 5px;
			background-color: #ecf0f1;
			display: block;
			-webkit-transition: all 0.3s ease-in-out;
			-o-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		.tp-hamburger {
			cursor: pointer;
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		/* ONE */
		#tp-hamburger-1.off-open .tp-line:nth-child(2){
			opacity: 0;
		}

		#tp-hamburger-1.off-open .tp-line:nth-child(1){
			-webkit-transform: translateY(13px) rotate(45deg);
			-ms-transform: translateY(13px) rotate(45deg);
			-o-transform: translateY(13px) rotate(45deg);
			transform: translateY(13px) rotate(45deg);
		}

		#tp-hamburger-1.off-open .tp-line:nth-child(3){
			-webkit-transform: translateY(-13px) rotate(-45deg);
			-ms-transform: translateY(-13px) rotate(-45deg);
			-o-transform: translateY(-13px) rotate(-45deg);
			transform: translateY(-13px) rotate(-45deg);
		}

						
		/* TWO */
		#tp-hamburger-2.off-open .tp-line:nth-child(1){
			-webkit-transform: translateY(13px);
			-ms-transform: translateY(13px);
			-o-transform: translateY(13px);
			transform: translateY(13px);
		}

		#tp-hamburger-2.off-open .tp-line:nth-child(3){
			-webkit-transform: translateY(-13px);
			-ms-transform: translateY(-13px);
			-o-transform: translateY(-13px);
			transform: translateY(-13px);
		}

		/* Three */
		#tp-hamburger-3{
			-webkit-transition: all 0.3s ease-in-out;
			-o-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
		}

		#tp-hamburger-3.off-open{
			animation: smallbig 0.6s forwards;
		}

		@keyframes smallbig{
			0%, 100%{
				-webkit-transform: scale(1);
				-ms-transform: scale(1);
				-o-transform: scale(1);
				transform: scale(1);
			}

			50%{
				-webkit-transform: scale(0);
				-ms-transform: scale(0);
				-o-transform: scale(0);
				transform: scale(0);
			}
		}

		#tp-hamburger-3.off-open .tp-line:nth-child(1),
		#tp-hamburger-3.off-open .tp-line:nth-child(2),
		#tp-hamburger-3.off-open .tp-line:nth-child(3){
			-webkit-transition-delay: 0.2s;
			-o-transition-delay: 0.2s;
			transition-delay: 0.2s;
		}

		#tp-hamburger-3.off-open .tp-line:nth-child(2){
			opacity: 0;
		}

		#tp-hamburger-3.off-open .tp-line:nth-child(1){
			-webkit-transform: translateY(13px) rotate(45deg);
			-ms-transform: translateY(13px) rotate(45deg);
			-o-transform: translateY(13px) rotate(45deg);
			transform: translateY(13px) rotate(45deg);
		}

		#tp-hamburger-3.off-open .tp-line:nth-child(3){
			-webkit-transform: translateY(-13px) rotate(-45deg);
			-ms-transform: translateY(-13px) rotate(-45deg);
			-o-transform: translateY(-13px) rotate(-45deg);
			transform: translateY(-13px) rotate(-45deg);
		}
	
		/* Four */
		#tp-hamburger-4.off-open .tp-line:nth-child(1){
			opacity: 0;
			-webkit-transform: translateX(-100%);
			-ms-transform: translateX(-100%);
			-o-transform: translateX(-100%);
			transform: translateX(-100%);
		}

		#tp-hamburger-4.off-open .tp-line:nth-child(3){
			opacity: 0;
			-webkit-transform: translateX(100%);
			-ms-transform: translateX(100%);
			-o-transform: translateX(100%);
			transform: translateX(100%);
		}

		/* Five */
		/* #tp-hamburger-5.off-open .tp-line:nth-child(1),
		#tp-hamburger-5.off-open .tp-line:nth-child(3){
			width: 40px;
		} */

		#tp-hamburger-5.off-open .tp-line:nth-child(1){
			-webkit-transform: translateX(-10px) rotate(-45deg);
			-ms-transform: translateX(-10px) rotate(-45deg);
			-o-transform: translateX(-10px) rotate(-45deg);
			transform: translateX(-10px) rotate(-45deg);
		}

		#tp-hamburger-5.off-open .tp-line:nth-child(3){
			-webkit-transform: translateX(-10px) rotate(45deg);
			-ms-transform: translateX(-10px) rotate(45deg);
			-o-transform: translateX(-10px) rotate(45deg);
			transform: translateX(-10px) rotate(45deg);
		}

		
		/* Six */
		#tp-hamburger-6.off-open{
			-webkit-transition: all 0.3s ease-in-out;
			-o-transition: all 0.3s ease-in-out;
			transition: all 0.3s ease-in-out;
			-webkit-transition-delay: 0.6s;
			-o-transition-delay: 0.6s;
			transition-delay: 0.6s;
			-webkit-transform: rotate(45deg);
			-ms-transform: rotate(45deg);
			-o-transform: rotate(45deg);
			transform: rotate(45deg);
		}

		#tp-hamburger-6.off-open .tp-line:nth-child(2){
			width: 0px;
		}

		#tp-hamburger-6.off-open .tp-line:nth-child(1),
		#tp-hamburger-6.off-open .tp-line:nth-child(3){
			-webkit-transition-delay: 0.3s;
			-o-transition-delay: 0.3s;
			transition-delay: 0.3s;
		}

		#tp-hamburger-6.off-open .tp-line:nth-child(1){
			-webkit-transform: translateY(13px);
			-ms-transform: translateY(13px);
			-o-transform: translateY(13px);
			transform: translateY(13px);
		}

		#tp-hamburger-6.off-open .tp-line:nth-child(3){
			-webkit-transform: translateY(-13px) rotate(90deg);
			-ms-transform: translateY(-13px) rotate(90deg);
			-o-transform: translateY(-13px) rotate(90deg);
			transform: translateY(-13px) rotate(90deg);
		}

		/* Seven */
		/* #tp-hamburger-7.off-open .tp-line:nth-child(1){
			width: 30px;
		}

		#tp-hamburger-7.off-open .tp-line:nth-child(2){
			width: 40px;
		} */

		#tp-hamburger-7.off-open .tp-line{
			-webkit-transform: rotate(30deg);
			-ms-transform: rotate(30deg);
			-o-transform: rotate(30deg);
			transform: rotate(30deg);
		}

		/* 
		##########################################################
		Style SVG Start From Here
		##########################################################
		*/
		.tp-svg-hamburger {
			cursor: pointer;
			-webkit-tap-highlight-color: transparent;
			transition: transform 400ms;
			-moz-user-select: none;
			-webkit-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}
		.tp-svg-hamburgerRotate.off-open {
			transform: rotate(45deg);
		}
		.tp-svg-hamburgerRotate180.off-open {
			transform: rotate(180deg);
		}
		.tp-svg-line {
			fill:none;
			transition: stroke-dasharray 400ms, stroke-dashoffset 400ms;
			stroke:#000;
			stroke-width:5.5;
			stroke-linecap:round;
		}
		.tp-svg-hamburger1 .tp-svg-top {
			stroke-dasharray: 40 139;
		}
		.tp-svg-hamburger1 .tp-svg-bottom {
			stroke-dasharray: 40 180;
		}
		.tp-svg-hamburger1.off-open .tp-svg-top {
			stroke-dashoffset: -98px;
		}
		.tp-svg-hamburger1.off-open .tp-svg-bottom {
			stroke-dashoffset: -138px;
		}
		.tp-svg-hamburger2 .tp-svg-top {
			stroke-dasharray: 40 121;
		}
		.tp-svg-hamburger2 .tp-svg-bottom {
			stroke-dasharray: 40 121;
		}
		.tp-svg-hamburger2.off-open .tp-svg-top {
			stroke-dashoffset: -102px;
		}
		.tp-svg-hamburger2.off-open .tp-svg-bottom {
			stroke-dashoffset: -102px;
		}
		.tp-svg-hamburger3 .tp-svg-top {
			stroke-dasharray: 40 130;
		}
		.tp-svg-hamburger3 .tp-svg-middle {
			stroke-dasharray: 40 140;
		}
		.tp-svg-hamburger3 .tp-svg-bottom {
			stroke-dasharray: 40 205;
		}
		.tp-svg-hamburger3.off-open .tp-svg-top {
			stroke-dasharray: 75 130;
			stroke-dashoffset: -63px;
		}
		.tp-svg-hamburger3.off-open .tp-svg-middle {
			stroke-dashoffset: -102px;
		}
		.tp-svg-hamburger3.off-open .tp-svg-bottom {
			stroke-dasharray: 110 205;
			stroke-dashoffset: -86px;
		}
		.tp-svg-hamburger4 .tp-svg-top {
			stroke-dasharray: 40 121;
		}
		.tp-svg-hamburger4 .tp-svg-bottom {
			stroke-dasharray: 40 121;
		}
		.tp-svg-hamburger4.off-open .tp-svg-top {
			stroke-dashoffset: -68px;
		}
		.tp-svg-hamburger4.off-open .tp-svg-bottom {
			stroke-dashoffset: -68px;
		}
		.tp-svg-hamburger5 .tp-svg-top {
			stroke-dasharray: 40 82;
		}
		.tp-svg-hamburger5 .tp-svg-bottom {
			stroke-dasharray: 40 82;
		}
		.tp-svg-hamburger5.off-open .tp-svg-top {
			stroke-dasharray: 14 82;
			stroke-dashoffset: -72px;
		}
		.tp-svg-hamburger5.off-open .tp-svg-bottom {
			stroke-dasharray: 14 82;
			stroke-dashoffset: -72px;
		}
		.tp-svg-hamburger6 .tp-svg-top {
			stroke-dasharray: 40 172;
		}
		.tp-svg-hamburger6 .tp-svg-middle {
			stroke-dasharray: 40 111;
		}
		.tp-svg-hamburger6 .tp-svg-bottom {
			stroke-dasharray: 40 172;
		}
		.tp-svg-hamburger6.off-open .tp-svg-top {
			stroke-dashoffset: -132px;
		}
		.tp-svg-hamburger6.off-open .tp-svg-middle {
			stroke-dashoffset: -71px;
		}
		.tp-svg-hamburger6.off-open .tp-svg-bottom {
			stroke-dashoffset: -132px;
		}
		.tp-svg-hamburger7 .tp-svg-top {
			stroke-dasharray: 40 82;
		}
		.tp-svg-hamburger7 .tp-svg-middle {
			stroke-dasharray: 40 111;
		}
		.tp-svg-hamburger7 .tp-svg-bottom {
			stroke-dasharray: 40 161;
		}
		.tp-svg-hamburger7.off-open .tp-svg-top {
			stroke-dasharray: 17 82;
			stroke-dashoffset: -62px;
		}
		.tp-svg-hamburger7.off-open .tp-svg-middle {
			stroke-dashoffset: 23px;
		}
		.tp-svg-hamburger7.off-open .tp-svg-bottom {
			stroke-dashoffset: -83px;
		}
		.tp-svg-hamburger8 .tp-svg-top {
			stroke-dasharray: 40 160;
		}
		.tp-svg-hamburger8 .tp-svg-middle {
			stroke-dasharray: 40 142;
			transform-origin: 50%;
			transition: transform 400ms;
		}
		.tp-svg-hamburger8 .tp-svg-bottom {
			stroke-dasharray: 40 85;
			transform-origin: 50%;
			transition: transform 400ms, stroke-dashoffset 400ms;
		}
		.tp-svg-hamburger8.off-open .tp-svg-top {
			stroke-dashoffset: -64px;
		}
		.tp-svg-hamburger8.off-open .tp-svg-middle {
		/* stroke-dashoffset: -20px; */
			transform: rotate(90deg);
		}
		.tp-svg-hamburger8.off-open .tp-svg-bottom {
			stroke-dashoffset: -64px;
		}

		</style>


		<div class="nav-link-container d-inline-block">
			<a href="#" class="nav-menu-link menu-button">

				<?php if( !empty( $settings['layout'] == 'layout2' ) ) : ?> 
				
				<?php if( $settings['animated_style'] == '1' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburgerRotate tp-svg-hamburger1 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 30,33 h 40 c 0,0 9.044436,-0.654587 9.044436,-8.508902 0,-7.854315 -8.024349,-11.958003 -14.89975,-10.85914 -6.875401,1.098863 -13.637059,4.171617 -13.637059,16.368042 v 40" />
					<path class="tp-svg-line tp-svg-middle" d="m 30,50 h 40" />
					<path class="tp-svg-line tp-svg-bottom" d="m 30,67 h 40 c 12.796276,0 15.357889,-11.717785 15.357889,-26.851538 0,-15.133752 -4.786586,-27.274118 -16.667516,-27.274118 -11.88093,0 -18.499247,6.994427 -18.435284,17.125656 l 0.252538,40" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '2' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburger2 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 70,33 h -40 c -6.5909,0 -7.763966,-4.501509 -7.763966,-7.511428 0,-4.721448 3.376452,-9.583771 13.876919,-9.583771 14.786182,0 11.409257,14.896182 9.596449,21.970818 -1.812808,7.074636 -15.709402,12.124381 -15.709402,12.124381" />
					<path class="tp-svg-line tp-svg-middle" d="m 30,50 h 40" />
					<path class="tp-svg-line tp-svg-bottom" d="m 70,67 h -40 c -6.5909,0 -7.763966,4.501509 -7.763966,7.511428 0,4.721448 3.376452,9.583771 13.876919,9.583771 14.786182,0 11.409257,-14.896182 9.596449,-21.970818 -1.812808,-7.074636 -15.709402,-12.124381 -15.709402,-12.124381" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '3' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburger3 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 70,33 h -40 c -11.092231,0 11.883874,13.496726 -3.420361,12.956839 -0.962502,-2.089471 -2.222071,-3.282996 -4.545687,-3.282996 -2.323616,0 -5.113897,2.622752 -5.113897,7.071068 0,4.448316 2.080609,7.007933 5.555839,7.007933 2.401943,0 2.96769,-1.283974 4.166879,-3.282995 2.209342,0.273823 4.031294,1.642466 5.857227,-0.252538 v -13.005715 16.288404 h 7.653568" />
					<path class="tp-svg-line tp-svg-middle" d="m 70,50 h -40 c -5.6862,0 -8.534259,5.373483 -8.534259,11.551069 0,7.187738 3.499166,10.922274 13.131984,10.922274 11.021777,0 7.022787,-15.773343 15.531095,-15.773343 3.268142,0 5.177031,-2.159429 5.177031,-6.7 0,-4.540571 -1.766442,-7.33533 -5.087851,-7.326157 -3.321409,0.0092 -5.771288,2.789632 -5.771288,7.326157 0,4.536525 2.478983,6.805271 5.771288,6.7" />
					<path class="tp-svg-line tp-svg-bottom" d="m 70,67 h -40 c 0,0 -3.680675,0.737051 -3.660714,-3.517857 0.02541,-5.415597 3.391687,-10.357143 10.982142,-10.357143 4.048418,0 17.88928,0.178572 23.482143,0.178572 0,2.563604 2.451177,3.403635 4.642857,3.392857 2.19168,-0.01078 4.373905,-1.369814 4.375,-3.392857 0.0011,-2.023043 -1.924401,-2.589191 -4.553571,-4.107143 -2.62917,-1.517952 -4.196429,-1.799562 -4.196429,-3.660714 0,-1.861153 2.442181,-3.118811 4.196429,-3.035715 1.754248,0.0831 4.375,0.890841 4.375,3.125 2.628634,0 6.160714,0.267857 6.160714,0.267857 l -0.178571,-2.946428 10.178571,0 -10.178571,0 v 6.696428 l 8.928571,0 -8.928571,0 v 7.142858 l 10.178571,0 -10.178571,0" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '4' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburgerRotate tp-svg-hamburger4 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 70,33 h -40 c 0,0 -8.5,-0.149796 -8.5,8.5 0,8.649796 8.5,8.5 8.5,8.5 h 20 v -20" />
					<path class="tp-svg-line tp-svg-middle" d="m 70,50 h -40" />
					<path class="tp-svg-line tp-svg-bottom" d="m 30,67 h 40 c 0,0 8.5,0.149796 8.5,-8.5 0,-8.649796 -8.5,-8.5 -8.5,-8.5 h -20 v 20" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '5' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburgerRotate180 tp-svg-hamburger5 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 30,33 h 40 c 0,0 8.5,-0.68551 8.5,10.375 0,8.292653 -6.122707,9.002293 -8.5,6.625 l -11.071429,-11.071429" />
					<path class="tp-svg-line tp-svg-middle" d="m 70,50 h -40" />
					<path class="tp-svg-line tp-svg-bottom" d="m 30,67 h 40 c 0,0 8.5,0.68551 8.5,-10.375 0,-8.292653 -6.122707,-9.002293 -8.5,-6.625 l -11.071429,11.071429" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '6' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburger6 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 30,33 h 40 c 13.100415,0 14.380204,31.80258 6.899646,33.421777 -24.612039,5.327373 9.016154,-52.337577 -12.75751,-30.563913 l -28.284272,28.284272" />
					<path class="tp-svg-line tp-svg-middle" d="m 70,50 c 0,0 -32.213436,0 -40,0 -7.786564,0 -6.428571,-4.640244 -6.428571,-8.571429 0,-5.895471 6.073743,-11.783399 12.286435,-5.570707 6.212692,6.212692 28.284272,28.284272 28.284272,28.284272" />
					<path class="tp-svg-line tp-svg-bottom" d="m 69.575405,67.073826 h -40 c -13.100415,0 -14.380204,-31.80258 -6.899646,-33.421777 24.612039,-5.327373 -9.016154,52.337577 12.75751,30.563913 l 28.284272,-28.284272" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '7' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburgerRotate tp-svg-hamburger7 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 70,33 h -40 c 0,0 -6,1.368796 -6,8.5 0,7.131204 6,8.5013 6,8.5013 l 20,-0.0013" />
					<path class="tp-svg-line tp-svg-middle" d="m 70,50 h -40" />
					<path class="tp-svg-line tp-svg-bottom" d="m 69.575405,67.073826 h -40 c -5.592752,0 -6.873604,-9.348582 1.371031,-9.348582 8.244634,0 19.053564,21.797129 19.053564,12.274756 l 0,-40" />
				</svg>
				<?php endif; ?>

				<?php if( $settings['animated_style'] == '8' ) : ?>
				<svg class="tp-svg-hamburger tp-svg-hamburgerRotate tp-svg-hamburger8 tp-hamburger" viewBox="0 0 100 100" width="80" >
					<path class="tp-svg-line tp-svg-top" d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20" />
					<path class="tp-svg-line tp-svg-middle" d="m 30,50 h 40" />
					<path class="tp-svg-line tp-svg-bottom" d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20" />
				</svg>
				<?php endif; ?>

				<?php else : ?>

				<strong class="tp-hamburger " id="tp-hamburger-<?php echo esc_attr( $settings['normal_style'] ); ?>">
					<span class="tp-line"></span>
					<span class="tp-line"></span>
					<span class="tp-line"></span>
				</strong>

				<?php endif; ?>

			</a>
		</div>

		<script>
        jQuery(document).ready(function(){
			jQuery(".menu-button, .close-button").on('click', function() {
				jQuery(".tp-hamburger").toggleClass("off-open");
			});
        });
    	</script>
 

	<?php
	}

}
