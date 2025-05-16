<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Swiper_Navigation_Widget extends \Elementor\Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'tp-swiper-navigation';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'TP Slider Controls', 'tp-elements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-multimedia';
	}

	/**
	 * Retrieve the list of scripts the counter widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @since 1.3.0
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'navigation' ];
	}

	

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_navigation',
			[
				'label' => esc_html__( 'Slider Controls', 'tp-elements' ),
			]
		);

		$this->add_control(
			'slider_control_type',
			[
				'label'   => esc_html__( 'Slider Control Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'navigation_only',				
				'options' => [
					'navigation_only' => esc_html__('Slider Navigation', 'tp-elements'),					
					'pagination_only' => esc_html__('Slider Pagination', 'tp-elements'),									
				],
				'separator' => 'before',										
			]
		);

		$this->add_control(
			'navigation_style',
			[
				'label'   => esc_html__( 'Select Navigation For', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'blog_navigation',				
				'options' => [
					'blog_navigation' => esc_html__('Blog', 'tp-elements'),					
					'fullwidth_blog_navigation' => esc_html__('Fullwidth Blog', 'tp-elements'),					
					'blog_category_navigation' => esc_html__('Blog Category', 'tp-elements'),									
					'logo_navigation' => esc_html__('Logo Showcase', 'tp-elements'),
					'testimonial_navigation' => esc_html__('Testimonial', 'tp-elements'),					
					'events_navigation' => esc_html__('Events', 'tp-elements'),					
					'course_category_navigation' => esc_html__('Course Category', 'tp-elements'),					
				],
				'condition' => [
					'slider_control_type' => ['navigation_only'],
				],
				'separator' => 'before',										
			]
		);

		$this->add_control(
            'navigation_slider_prev',
            [
				'label' => esc_html__( 'Navigation Prev', 'tp-elements' ),
				'type'  => Controls_Manager::HEADING, 
				'condition' => [
					'slider_control_type' => ['navigation_only'],
				],              
            ]
        );

		$this->add_control(
			'prev_icon_type',
			[
				'label'   => esc_html__( 'Previous Icon Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'prev_icon',			
				'options' => [					
					'prev_icon' => esc_html__( 'Icon', 'tp-elements'),
					'prev_image' => esc_html__( 'Image', 'tp-elements'),			
				],
				'condition' => [
					'slider_control_type' => ['navigation_only'],
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'prev_icon',
			[
				'label'     => esc_html__( 'Previous Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-left',
					'library' => 'solid',
				],
				'condition' => [
					'prev_icon_type' => 'prev_icon',
					'slider_control_type' => ['navigation_only'],
				],				
			]
		);
		$this->add_control(
			'prev_image',
			[
				'label' => esc_html__( 'Previous Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'prev_icon_type' => 'prev_image',
					'slider_control_type' => ['navigation_only'],
				],
				'separator' => 'before',
			]
		);

		// Navigation Next
		$this->add_control(
            'navigation_slider_next',
            [
				'label' => esc_html__( 'Navigation Next', 'tp-elements' ),
				'type'  => Controls_Manager::HEADING,  
				'condition' => [
					'slider_control_type' => ['navigation_only'],
				],             
            ]
        );

		$this->add_control(
			'next_icon_type',
			[
				'label'   => esc_html__( 'Next Icon Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'next_icon',			
				'options' => [					
					'next_icon' => esc_html__( 'Icon', 'tp-elements'),
					'next_image' => esc_html__( 'Image', 'tp-elements'),			
				],
				'condition' => [
					'slider_control_type' => ['navigation_only'],
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'next_icon',
			[
				'label'     => esc_html__( 'Next Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'next_icon_type' => 'next_icon',
					'slider_control_type' => ['navigation_only'],
				],				
			]
		);
		$this->add_control(
			'next_image',
			[
				'label' => esc_html__( 'Next Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'next_icon_type' => 'next_image',
					'slider_control_type' => ['navigation_only'],
				],
				'separator' => 'before',
			]
		);


		$this->add_control(
			'pagination_style',
			[
				'label'   => esc_html__( 'Select Pagination For', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'blog_pagination',				
				'options' => [
					'blog_pagination' => esc_html__('Blog', 'tp-elements'),									
					'logo_pagination' => esc_html__('Logo Showcase', 'tp-elements'),					
					'fullwidth_blog_pagination' => esc_html__('Fullwidth Blog', 'tp-elements'),					
					'blog_category_pagination' => esc_html__('Blog Category', 'tp-elements'),					
					'testimonial_pagination' => esc_html__('Testimonial', 'tp-elements'),					
					'events_pagination' => esc_html__('Events', 'tp-elements'),					
					'course_category_pagination' => esc_html__('Course Category', 'tp-elements'),					
				],
				'condition' => [
					'slider_control_type' => ['pagination_only'],
				],
				'separator' => 'before',										
			]
		);

		$this->end_controls_section();

				
		$this->start_controls_section(
		    '_section_style_navigation',
		    [
		        'label' => esc_html__( 'Navigation Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'margin_navigation',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_responsive_control(
		    'padding_navigation',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'navigation_typography',
		        'selector' => '{{WRAPPER}} .tp-swiper-slider-navigation i',
		        
		    ]
		);

		$this->add_responsive_control(
            'navigation_display',
            [
                'label' => esc_html__( 'Display', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'inline-block' => [
                        'title' => esc_html__( 'Inline', 'tp-elements' ),
                        'icon' => 'eicon-navigation-horizontal',
                    ],
                    'block' => [
                        'title' => esc_html__( 'Block', 'tp-elements' ),
                        'icon' => 'eicon-navigation-vertical',
                    ],
                ],
                'toggle' => true,
				'condition' => [
		            'navigation_align!' => '',
		            'navigation_space_between' => '',
		        ],
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-slider-navigation > div' => 'display: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
            'navigation_align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
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
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-slider-navigation' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
			'navigation_spacing',
			[
				'label' => esc_html__( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
					'vw' => [
						'max' => 50,
						'step' => 0.1,
					],
				],
				'size_units' => [ 'px', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tp-swiper-slider-navigation' => 'gap: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_responsive_control(
            'navigation_space_between',
            [
                'label' => esc_html__( 'Space Between', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'tp-elements' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => esc_html__( 'Space Around', 'tp-elements' ),
                        'icon' => 'eicon-justify-space-around-h',
                    ],
                    'start' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-justify-end-h',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-swiper-slider-navigation' => 'display: flex; justify-content: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
		    'hr_six',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_navigation' );

		$this->start_controls_tab(
		    '_tab_navigation_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_responsive_control(
		    'padding_navigation_button',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_control(
		    'navigation_color',
		    [
		        'label' => esc_html__( 'Icon Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'navigation_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'navigation_button_border',
		        'selector' => '.tp-swiper-slider-navigation > div',
		    ]
		);

		$this->add_control(
		    'navigation_button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'navigation_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'navigation_button_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-swiper-slider-navigation > div',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_navigation_hover',
		    [
		        'label' => esc_html__( 'Hover/Active', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'navigation_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'navigation_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div:hover' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'navigation_hover_border',
		        'selector' => '{{WRAPPER}} .tp-swiper-slider-navigation > div:hover',
		    ]
		);

		$this->add_control(
		    'navigation_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'tp_navigation_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-swiper-slider-navigation > div:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'navigation_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-swiper-slider-navigation > div:hover',
		    ]
		);


		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_pagination',
		    [
		        'label' => esc_html__( 'Pagination Default Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'margin_pagination',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

		$this->add_responsive_control(
            'pagination_align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination' => 'justify-content: {{VALUE}}; align-items: {{VALUE}}',
                ],
				'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
            'pagination_display',
            [
                'label' => esc_html__( 'Display', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Inline', 'tp-elements' ),
                        'icon' => 'eicon-navigation-horizontal',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Block', 'tp-elements' ),
                        'icon' => 'eicon-navigation-vertical',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination' => 'flex-direction: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
		    'hr_pagination',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_pagination' );

		$this->start_controls_tab(
		    '_tab_pagination_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_responsive_control(
		    'pagination_bullet_width',
		    [
		        'label' => esc_html__( 'Bullet Width', 'tp-elements' ),
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
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'pagination_bullet_height',
		    [
		        'label' => esc_html__( 'Bullet Height', 'tp-elements' ),
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
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_control(
		    'pagination_bullet_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagination_bullet_border',
		        'selector' => '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet',
		    ]
		);

		$this->add_control(
		    'pagination_bullet_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'pagination_bullet_border_color_normal',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'pagination_bullet_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_pagination_hover',
		    [
		        'label' => esc_html__( 'Active', 'tp-elements' ),
		    ]
		);

		$this->add_responsive_control(
		    'pagination_bullet_hover_width',
		    [
		        'label' => esc_html__( 'Bullet Width', 'tp-elements' ),
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
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);

		$this->add_responsive_control(
		    'pagination_bullet_hover_height',
		    [
		        'label' => esc_html__( 'Bullet Height', 'tp-elements' ),
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
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		        'separator' => 'before',
		    ]
		);


		$this->add_control(
		    'pagination_bullet_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagination_bullet_hover_border',
		        'selector' => '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
		    ]
		);

		$this->add_control(
		    'pagination_bullet_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'pagination_bullet_hover_border_color_norm',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'pagination_bullet_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active',
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {	
	
	$settings = $this->get_settings_for_display();	
	$rand = rand(12, 3330);

	if( $settings['navigation_style'] == 'logo_navigation' ) {

		$nav_next_class = 'tp-logo-slide-next';
		$nav_prev_class = 'tp-logo-slide-prev';

	} elseif( $settings['navigation_style'] == 'events_navigation' ) {

		$nav_next_class = 'tp-events-slide-next';
		$nav_prev_class = 'tp-events-slide-prev';

	} elseif( $settings['navigation_style'] == 'testimonial_navigation' ) {

		$nav_next_class = 'tp-testimonial-slide-next';
		$nav_prev_class = 'tp-testimonial-slide-prev';

	} elseif( $settings['navigation_style'] == 'blog_category_navigation' ) {

		$nav_next_class = 'tp-blog-category-slide-next';
		$nav_prev_class = 'tp-blog-category-slide-prev';

	} elseif( $settings['navigation_style'] == 'fullwidth_blog_navigation' ) {

		$nav_next_class = 'tp-fullwidth-blog-slide-next';
		$nav_prev_class = 'tp-fullwidth-blog-slide-prev';

	} elseif( $settings['navigation_style'] == 'course_category_navigation' ) {

		$nav_next_class = 'tp-course-category-slide-next';
		$nav_prev_class = 'tp-course-category-slide-prev';

	} else {

		$nav_next_class = 'tp-blog-slide-next';
		$nav_prev_class = 'tp-blog-slide-prev';

	}
	
	if( $settings['slider_control_type'] =='pagination_only' ) { 

		if( $settings[ 'pagination_style' ] == 'testimonial_pagination' ) {
			$pag_class = 'tp-testimonial-pagination ';
		} elseif( $settings[ 'pagination_style' ] == 'events_pagination' ) {
			$pag_class = 'tp-events-pagination ';
		} elseif( $settings[ 'pagination_style' ] == 'logo_pagination' ) {
			$pag_class = 'tp-logo-pagination ';
		} elseif( $settings[ 'pagination_style' ] == 'blog_category_pagination' ) {
			$pag_class = 'tp-blog-category-pagination ';
		} elseif( $settings[ 'pagination_style' ] == 'fullwidth_blog_pagination' ) {
			$pag_class = 'tp-fullwidth-blog-pagination ';
		} elseif( $settings[ 'pagination_style' ] == 'course_category_pagination' ) {
			$pag_class = 'tp-course-category-pagination ';
		} else {
			$pag_class = 'tp-blog-pagination ';
		}

	}

	?>

	<style>
		.tp-swiper-slider-navigation > div {
			display: inline-block;
		}
		.tp-swiper-slider-navigation > div i {
			display: inline-block;
			cursor: pointer;
		}

		.tp-pagination-all-style .swiper-pagination {
			display: flex;
			position: relative;
			gap: 10px;
			z-index: 99;
		}
		.tp-pagination-all-style .swiper-pagination .swiper-pagination-bullet {
			margin: 0;
			width: 10px;
			height: 10px;
			border-radius: 0;
		}

	</style>
	<?php if( $settings['slider_control_type'] == 'navigation_only' ) : ?> 
	<div class="tp-swiper-slider-navigation tp-navigation-style-<?php echo esc_attr( $settings[ 'navigation_style' ] ); ?>">
		<?php if( !empty($settings['prev_icon']) || !empty($settings['prev_image']['url'])) : ?>
		<div class="tp-swiper-slide-prev <?php echo esc_attr( $nav_prev_class ); ?>">
			<?php if(!empty($settings['prev_image'])) : ?>
			<img src="<?php echo esc_url( $settings['prev_image']['url'] );?>" alt="next-img">
			<?php else : 
			\Elementor\Icons_Manager::render_icon( $settings['prev_icon'], [ 'aria-hidden' => 'true' ] );
			endif; ?>
		</div>
		<?php endif; ?>
		<?php if( !empty($settings['next_icon']) || !empty($settings['next_image']['url'])) : ?>
		<div class="tp-swiper-slide-next <?php echo esc_attr( $nav_next_class ); ?>">
			<?php if(!empty($settings['next_image'])) : ?>
			<img src="<?php echo esc_url( $settings['next_image']['url'] );?>" alt="next-img">
			<?php else : 
			\Elementor\Icons_Manager::render_icon( $settings['next_icon'], [ 'aria-hidden' => 'true' ] );
			endif; ?>
		</div>
		<?php endif; ?>
	</div>
	<?php else : ?>

	<div class="tp-pagination-all-style tp-pagination-style-<?php echo esc_attr( $settings[ 'pagination_style' ] ); ?>">
		<div class="<?php echo esc_attr( $pag_class ); ?> swiper-pagination" ></div>
	</div>

	<?php endif; ?>

<?php 
	}
}