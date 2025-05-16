<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Core\Schemes\Color;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Global_Colors;


defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Counter_Widget extends \Elementor\Widget_Base {
	
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
		return 'tp-counter';
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
		return esc_html__( 'TP Counter', 'tp-elements' );
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
		return 'glyph-icon flaticon-count';
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
		return [ 'counter' ];
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
			'section_counter',
			[
				'label' => esc_html__( 'Counter', 'tp-elements' ),
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__( 'Select Counter Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
					'style1' => esc_html__( 'Style 1', 'tp-elements'),
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_counter_icon',
			[
				'label' => esc_html__( 'Icon / Image', 'tp-elements' ),
			]
		);

		$this->add_control(
			'icon_type',
			[
				'label'   => esc_html__( 'Select Icon Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'tp-elements'),
					'image' => esc_html__( 'Image', 'tp-elements'),
								
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label' => esc_html__( 'Select Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,			
				'default' => [
					'value' => 'fa fa-trophy',
					'library' => 'solid', 
				],
				'separator' => 'before',
				
				'condition' => [
					'icon_type' => 'icon',
				],
				
			]
		);

		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'counter_icon_position_horizontal',
			[
				'label' => esc_html__( 'Horizontal Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default'   => 'top',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
                'prefix_class' => 'tp-horizontal-icon-position-',
			]
		);

		$this->add_responsive_control(
			'counter_icon_position_vertical',
			[
				'label' => esc_html__( 'Vertical Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'middle',
				'options' => [

					'top' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => esc_html__( 'Middle', 'tp-elements' ),
						'icon' => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'tp-elements' ),
						'icon' => 'eicon-v-align-bottom',
					],

				],
                'prefix_class' => 'tp-vertical-icon-position-',
                'condition'    => [
                    'counter_icon_position_horizontal!' => 'top',
                ]
			]
		);

		$this->add_responsive_control(
            'align',
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
                    '{{WRAPPER}} .tp-counter-top-area' => 'text-align: {{VALUE}}'
                ],                
				'separator' => 'before',
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section(
			'section_counter_content',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
			]
		);

		$this->add_control(
			'prefix',
			[
				'label' => esc_html__( 'Number Prefix', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => 'Prefix',
				'separator' => 'before',
			]
		);

		$this->add_control(
			'number',
			[
				'label' => esc_html__( 'Counter Number', 'tp-elements' ),
				'type' => Controls_Manager::NUMBER,
				'default' => 100,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'suffix',
			[
				'label' => esc_html__( 'Number Suffix', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => '',
				'placeholder' => esc_html__( 'Suffix', 'tp-elements' ),
				'separator' => 'before',
			]
			
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__( 'Counter Text', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__( 'Happy Clients', 'tp-elements' ),
				'placeholder' => esc_html__( 'Write Counter Text', 'tp-elements' ),
				'separator' => 'before',
			]
			
		);

		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_counter_style',
			[
				'label' => esc_html__( 'Counter', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'section_counter_style_padding',
			[
				'label' => esc_html__( 'Padding', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tp-counter-top-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',

				],
			]
		);

		$this->add_responsive_control(
			'section_counter_style_margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tp-counter-top-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'section_counter_style_box_shadow',
				'selector' => '{{WRAPPER}} .tp-counter-top-area',
			]
		);

		$this->start_controls_tabs( 'section_counter_tabs' );

		$this->start_controls_tab(
			'section_counter_tabs_normal',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'section_counter_style_bg',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-counter-top-area',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'section_counter_style_border',
				'selector' => '{{WRAPPER}} .tp-counter-top-area',
			]
		);

		$this->add_control(
			'section_counter_style_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tp-counter-top-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'section_counter_tabs_hover',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'section_counter_style_hover_bg',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-counter-top-area:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'section_counter_style_hover_border',
				'selector' => '{{WRAPPER}} .tp-counter-top-area:hover',
			]
		);

		$this->add_control(
			'section_counter_style_hover_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tp-counter-top-area:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		
		$this->start_controls_section(
			'section_counter_icon_style',
			[
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
		    'svg_width',
		    [
		        'label' => esc_html__( 'SVG Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%' ],
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
				'default' => [
					'unit' => 'px',
					'size' => 70,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-counter-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],

		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[	'label' => esc_html__( 'Typography', 'tp-elements' ),
				'name' => 'counter_typography_icon',				
				'selector' => '{{WRAPPER}} .tp-counter-icon i, {{WRAPPER}} .tp-counter-icon svg',
			]
		);

		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-counter-icon, {{WRAPPER}} .tp-counter-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'icon_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-counter-icon, {{WRAPPER}} .tp-counter-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'icon_box_shadow',
				'selector' => '{{WRAPPER}} .tp-counter-icon i, {{WRAPPER}} .tp-counter-icon svg',
			]
		);

		$this->start_controls_tabs( 'icon_tabs' );

		    $this->start_controls_tab(
		        'icon_tabs_normal',
		        [
		            'label' => esc_html__( 'Normal', 'tp-elements' ),
		        ]
		    );

			$this->add_control(
				'icon_color',
				[
					'label' => esc_html__( 'Icon Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [
						'{{WRAPPER}} .tp-counter-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .tp-counter-icon svg path' => 'fill: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'icon_part_bg',
					'label' => esc_html__( 'Background', 'tp-elements' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .tp-counter-icon, {{WRAPPER}} .tp-counter-icon',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'icon_part_border',
					'selector' => '{{WRAPPER}} .tp-counter-icon, {{WRAPPER}} .tp-counter-icon',
				]
			);

			$this->add_control(
				'icon_part_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'tp-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tp-counter-icon, {{WRAPPER}} .tp-counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
			    'icon_tabs_hover',
			    [
			        'label' => esc_html__( 'Hover', 'tp-elements' ),
			    ]
			);

			$this->add_control(
				'icon_hover_color',
				[
					'label' => esc_html__( 'Icon Hover Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon i' => 'color: {{VALUE}};',
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon svg path' => 'fill: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'icon_part_hover_bg',
					'label' => esc_html__( 'Background', 'tp-elements' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon, {{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon',
				]
			);


			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'icon_part_hover_border',
					'selector' => '{{WRAPPER}} .tpcounter-top-area:hover .tp-counter-icon, {{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon',
				]
			);

			$this->add_control(
				'icon_part_hover_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'tp-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon, {{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		    $this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();


		$this->start_controls_section(
			'section_counter_image_style',
			[
				'label' => esc_html__( 'Image', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
		    'image_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-counter-icon .tp-counter-img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'image_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-counter-icon .tp-counter-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .tp-counter-icon .tp-counter-img',
			]
		);

		$this->start_controls_tabs( 'image_tabs' );

		    $this->start_controls_tab(
		        'image_tabs_normal',
		        [
		            'label' => esc_html__( 'Normal', 'tp-elements' ),
		        ]
		    );

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'image_css_filters',
					'selector' => '{{WRAPPER}} .tp-counter-icon .tp-counter-img img',
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'image_part_bg',
					'label' => esc_html__( 'Background', 'tp-elements' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .tp-counter-icon .tp-counter-img',
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'image_part_border',
					'selector' => '{{WRAPPER}} .tp-counter-icon .tp-counter-img',
				]
			);

			$this->add_control(
				'image_part_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'tp-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tp-counter-icon .tp-counter-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
			    'image_tabs_hover',
			    [
			        'label' => esc_html__( 'Hover', 'tp-elements' ),
			    ]
			);

			$this->add_group_control(
				Group_Control_Css_Filter::get_type(),
				[
					'name' => 'image_hover_css_filters',
					'selector' => '{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon .tp-counter-img img',
				]
			);

			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'image_part_hover_bg',
					'label' => esc_html__( 'Background', 'tp-elements' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon .tp-counter-img',
				]
			);


			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' => 'image_part_hover_border',
					'selector' => '{{WRAPPER}} .tpcounter-top-area:hover .tp-counter-icon .tp-counter-img',
				]
			);

			$this->add_control(
				'image_part_hover_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'tp-elements' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors' => [
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-counter-icon .tp-counter-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		    $this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		$this->start_controls_section(
			'section_number',
			[
				'label' => esc_html__( 'Number', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		    'number_padding',
		    [
		    	'label' => esc_html__( 'Padding', 'tp-elements' ),
		    	'type' => Controls_Manager::DIMENSIONS,
		    	'size_units' => [ 'px', 'em', '%' ],
		    	'selectors' => [
		    	    '{{WRAPPER}} .tp-count-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		    	],
		    ]
		);

		$this->add_control(
		    'number_margin',
		    [
		    	'label' => esc_html__( 'Margin', 'tp-elements' ),
		    	'type' => Controls_Manager::DIMENSIONS,
		    	'size_units' => [ 'px', 'em', '%' ],
		    	'selectors' => [
		    	    '{{WRAPPER}} .tp-count-number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		    	],
		    ]
		);

		$this->add_control(
            'show_number_background',
            [
				'label'        => esc_html__( 'Show Text Background', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',				
            ]
        );

         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'number_bg_color',
                'label' => esc_html__( 'Text Background Color', 'tp-elements' ),
                'types' => [ 'gradient' ],
                'exclude' => [ 'classic','image' ],             
				'selector' => '{{WRAPPER}} .tp-counter-top-area.yes .tps-counter-list .tp-count-number ',
				'condition' => [
					'show_number_background' => 'yes',
				],
                'fields_options' => [
                    'background' => [
                        'default' => 'gradient',
                    ],
                ],
                
            ]
        ); 

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'number_border',
				'selector' => '{{WRAPPER}} .tp-counter-top-area.yes .tps-counter-list .tp-count-number ',
				'condition' => [
					'show_number_background' => 'yes',
				],
			]
		);

		$this->add_control(
			'number_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .tp-counter-top-area.yes .tps-counter-list .tp-count-number ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_number_background' => 'yes',
				],
			]
		);

		$this->start_controls_tabs( 'number_tabs' );

		    $this->start_controls_tab(
		        'number_tabs_normal',
		        [
		            'label' => esc_html__( 'Number', 'tp-elements' ),
		        ]
		    );

			$this->add_control(
				'number_color',
				[
					'label' => esc_html__( 'Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [
						'{{WRAPPER}} .tp-count-number span' => 'color: {{VALUE}};',
					],
				]
			);
	
			
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	'label' => esc_html__( 'Typography', 'tp-elements' ),
					'name' => 'typography_number',
					
					'selector' => '{{WRAPPER}} .tp-count-number span',
				]
			);
	
			$this->add_group_control(
				Group_Control_Text_Stroke::get_type(),
				[
					'name' => 'number_stroke',
					'selector' => '{{WRAPPER}} .tp-count-number span.tp-counter',
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
		        'prefix_tabs_normal',
		        [
		            'label' => esc_html__( 'Prefix', 'tp-elements' ),
		        ]
		    );

			$this->add_control(
				'prefix_color',
				[
					'label' => esc_html__( 'Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [
						'{{WRAPPER}} .tp-count-number span.tp-prefix' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	'label' => esc_html__( 'Typography', 'tp-elements' ),
					'name' => 'typography_prefix',
					
					'selector' => '{{WRAPPER}} .tp-count-number span.tp-prefix',
				]
			);
	
			$this->add_group_control(
				Group_Control_Text_Stroke::get_type(),
				[
					'name' => 'prefix_stroke',
					'selector' => '{{WRAPPER}} .tp-count-number span.tp-prefix',
				]
			);

			$this->add_control(
				'prefix_translate',
				[
					'label' => esc_html__( 'Translate Y', 'tp-elements' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tp-count-number span.tp-prefix' => '-webkit-transform: translateY({{SIZE}}{{UNIT}}) !important; transform: translateY({{SIZE}}{{UNIT}}) !important;',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
		        'suffix_tabs_normal',
		        [
		            'label' => esc_html__( 'Suffix', 'tp-elements' ),
		        ]
		    );

			$this->add_control(
				'suffix_color',
				[
					'label' => esc_html__( 'Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [
						'{{WRAPPER}} .tp-count-number span.tp-suffix' => 'color: {{VALUE}};',
					],
				]
			);
	
			
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[	'label' => esc_html__( 'Typography', 'tp-elements' ),
					'name' => 'typography_suffix',
					
					'selector' => '{{WRAPPER}} .tp-count-number span.tp-suffix',
				]
			);
	
			$this->add_group_control(
				Group_Control_Text_Stroke::get_type(),
				[
					'name' => 'suffix_stroke',
					'selector' => '{{WRAPPER}} .tp-count-number span.tp-suffix',
				]
			);

			$this->add_control(
				'suffix_translate',
				[
					'label' => esc_html__( 'Translate Y', 'tp-elements' ),
					'type' => Controls_Manager::SLIDER,
					'range' => [
						'px' => [
							'min' => -100,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tp-count-number span.tp-suffix' => '-webkit-transform: translateY({{SIZE}}{{UNIT}}) !important; transform: translateY({{SIZE}}{{UNIT}}) !important;',
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
		        'number_hover_tabs_normal',
		        [
		            'label' => esc_html__( 'Hover', 'tp-elements' ),
		        ]
		    );

			$this->add_control(
				'number_hover_color',
				[
					'label' => esc_html__( 'Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span, {{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span.tp-prefix, {{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span.tp-suffix' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'number_hover_stroke_color',
				[
					'label' => esc_html__( 'Stroke Color', 'tp-elements' ),
					'type' => Controls_Manager::COLOR,				
					'selectors' => [					
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span, {{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span.tp-prefix, {{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span.tp-suffix' => 'stroke: {{VALUE}};',
						'{{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span, {{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span.tp-prefix, {{WRAPPER}} .tp-counter-top-area:hover .tp-count-number span.tp-suffix' => '-webkit-text-stroke-color: {{VALUE}};',
					],
				]
			);

			$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_counter_text',
			[
				'label' => esc_html__( 'Text', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_text',				
				'selector' => '{{WRAPPER}} .tp-count-title',
			]
		);

		$this->start_controls_tabs( 'text_tabs' );

		$this->start_controls_tab(
			'text_tabs_normal',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);
		$this->add_control(
			'text_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-count-title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->end_controls_tab();

		$this->start_controls_tab(
			'text_tabs_hover',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);
		$this->add_control(
			'text_hover_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-counter-top-area:hover .tp-count-title' => 'color: {{VALUE}};',
				],
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
		?>

		<div class="tp-counter-top-area <?php echo esc_attr($settings['show_number_background']);?> tp-counter-<?php echo esc_attr( $settings['style']);?>">
		    <div class="tps-counter-list">	

				<?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
				<div class="tp-counter-icon">
					<?php if(!empty($settings['selected_icon'])) : ?>
						<?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					<?php endif; ?>

					<?php if(!empty($settings['selected_image'])) :?>
						<span class="tp-counter-img d-inline-block">
						<img src="<?php echo esc_url($settings['selected_image']['url']);?>" alt="image"/>
						</span>
					<?php endif;?>
				</div>	
				<?php }?>
						
				<div class="tp-count-text">
					<span class="tp-count-number d-inline-block">
						<?php if($settings['prefix']) :?><span class="tp-prefix d-inline-block"><?php echo esc_html($settings['prefix']);?></span><?php endif; ?>
						<span data-letters="500" class="tp-counter d-inline-block"> <?php echo esc_html($settings['number']);?></span>
						<?php if($settings['suffix']) :?><span class="tp-suffix d-inline-block"><?php echo esc_html($settings['suffix']);?></span><?php endif; ?>
					</span>
					<?php if(!empty($settings['title'])) : ?>
					<span class="tp-count-title d-block">  <?php echo esc_html($settings['title']);?></span>	
					<?php endif; ?>	
				</div>

			</div>
		</div>	

	<?php
	}
}
