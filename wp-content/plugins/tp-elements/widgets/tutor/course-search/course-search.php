<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Search Button.
 *
 * HFE widget for Search Button.
 *
 * @since 1.5.0
 */
class Themephi_Tutor_Course_Search extends Widget_Base {
    /**
     * Retrieve the widget name.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'tutor-search-course';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'TP Course Search', 'tp-elements');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'hfe-icon-search';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'tpaddon_category' ];
    }

    /**
     * Retrieve the list of scripts the navigation menu depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.5.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
 

    /**
     * Register Search Button controls.
     *
     * @since 1.5.7
     * @access protected
     */
    protected function register_controls() {
        $this->register_general_content_controls();
        $this->register_search_style_controls();
    }
    /**
     * Register Search General Controls.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Search Box', 'tp-elements'),
            ]
        );
        
        $this->add_control(
            'layout',
            [
                'label'        => __( 'Select Layout', 'tp-elements'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'style1',
                'options'      => [
                    'style1'      => __( 'Input Box', 'tp-elements'),
                    'style2'      => __( 'Input Box With Category', 'tp-elements'),
                ],
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label'     => __( 'Placeholder', 'tp-elements'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Type & Hit Enter', 'tp-elements') . '...',
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'button_show_hide',
            [
                'label' => esc_html__( 'Button Option', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'icon',
                'options' => [
                    'icon' => esc_html__( 'Icon', 'tp-elements' ),
                    'text' => esc_html__( 'Text', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'search_button_icon',
			[
                'label' => esc_html__( 'Button Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'tp tp-search',
				],
                'condition' => [
                    'button_show_hide' => 'icon',
                ]
			]
		);

		$this->add_control(
			'search_button_text',
			[
                'label'       => esc_html__( 'Button Text', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Read More',
                'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
                'separator'   => 'before',
                'condition'   => [
                    'button_show_hide' => 'text',
                ]
			]
		);

        $this->end_controls_section();

    }
    /**
     * Register Search Style Controls.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function register_search_style_controls() {

        $this->start_controls_section(
            'section_category_style',
            [
                'label'     => __( 'Category', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->add_responsive_control(
			'category_max_width',
			[
				'label' => esc_html__( 'Max Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #course-category-select' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'category_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} #course-category-select' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'category_typography',
                'selector' => '{{WRAPPER}} #course-category-select',
            ]
        );

        $this->add_control(
            'category_text_color',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #course-category-select' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'category_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} #course-category-select',
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'category_border',
		        'selector' => '{{WRAPPER}} #course-category-select'               
		    ]
		);

        $this->add_control(
            'category_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} #course-category-select' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],      
            ]
        );
        
        $this->add_responsive_control(
            'category_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} #course-category-select' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        
        $this->add_responsive_control(
            'category_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  #course-category-select' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_box_style',
            [
                'label'     => __( 'Input Box', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'input_box_direction',
            [
                'label' => esc_html__( 'Flex Direction', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Row', 'tp-elements' ),
                        'icon' => 'eicon-justify-center-v',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'tp-elements' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                ],
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .tp-coupn-search-input-wrapper' => 'flex-direction: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_box_align',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'top', 'tp-elements' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-justify-center-v',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-justify-end-v',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-coupn-search-input-wrapper' => 'align-items: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_box_gap',
            [
                'label' => esc_html__( 'Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-coupn-search-input-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .tp-coupn-search-input-wrapper',
                'separator' => 'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .tp-coupn-search-input-wrapper',
            ]
        );
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'input_box_border',
		        'selector' => '{{WRAPPER}} .tp-coupn-search-input-wrapper'               
		    ]
		);
        
        $this->add_control(
            'input_box_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .tp-coupn-search-input-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],   
                'separator' => 'before',        
            ]
        );

        $this->add_responsive_control(
            'input_box_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-coupn-search-input-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_input_style',
            [
                'label' => __( 'Input', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'input_width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'elementor' ),
					'inherit' => esc_html__( 'Full Width', 'elementor' ) . ' (100%)',
					'auto' => esc_html__( 'Inline', 'elementor' ) . ' (auto)',
					'initial' => esc_html__( 'Custom', 'elementor' ),
				],
				'selectors_dictionary' => [
					'inherit' => '100%',
				],
				'selectors' => [
					'{{WRAPPER}} input#course-search-input' => 'width: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'input_custom_width',
			[
				'label' => esc_html__( 'Custom Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} input#course-search-input' => 'width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [ 'input_width' => 'initial' ],
			]
		);

        $this->add_responsive_control(
			'input_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} input#course-search-input' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'input_typography',
                'selector' => '{{WRAPPER}} input#course-search-input',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );
        $this->add_control(
		    'hr_input',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label'     => __( 'Normal', 'tp-elements'),
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input#course-search-input' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} input#course-search-input',
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'input_border',
		        'selector' => '{{WRAPPER}} input#course-search-input'               
		    ]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label'     => __( 'Focus', 'tp-elements'),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'input_background_focus',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} input#course-search-input:focus',
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label'     => __( 'Border Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input#course-search-input:focus' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'input_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} input#course-search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],    
                'separator' => 'before'       
            ]
        );
        
        $this->add_responsive_control(
            'input_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} input#course-search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        
        $this->add_responsive_control(
            'input_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  input#course-search-input' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'input_box_shadow',
                'selector'  => '{{WRAPPER}} input#course-search-input',
            ]
        );
        
        $this->add_control(
		    'input_placeholder_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Placeholder', 'tp-elements' ),
		        'separator' => 'before',
		    ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'placeholder_typography',
                'selector' => '{{WRAPPER}} input#course-search-input::placeholder',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'input_placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} input#course-search-input::placeholder' => 'color: {{VALUE}}',
                ],
                'default'   => '#777',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_button_style',
            [
                'label'     => __( 'Button', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'button_width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
				'type' => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => esc_html__( 'Default', 'elementor' ),
					'inherit' => esc_html__( 'Full Width', 'elementor' ) . ' (100%)',
					'auto' => esc_html__( 'Inline', 'elementor' ) . ' (auto)',
					'initial' => esc_html__( 'Custom', 'elementor' ),
				],
				'selectors_dictionary' => [
					'inherit' => '100%',
				],
				'selectors' => [
					'{{WRAPPER}} button.tp-coupn-search-btn' => 'width: {{VALUE}}; max-width: {{VALUE}}',
				],
			]
		);

		$this->add_responsive_control(
			'button_custom_width',
			[
				'label' => esc_html__( 'Custom Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'default' => [
					'unit' => '%',
				],
				'range' => [
					'px' => [
						'max' => 1000,
					],
				],
				'selectors' => [
					'{{WRAPPER}} button.tp-coupn-search-btn' => 'width: {{SIZE}}{{UNIT}}; max-width: {{SIZE}}{{UNIT}}; flex-shrink: 0;',
				],
				'condition' => [ 'button_width' => 'initial' ],
			]
		);
        $this->add_responsive_control(
			'input_btn_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} button.tp-coupn-search-btn' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
		    'hr_input_btn_2',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_meta_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} button.tp-coupn-search-btn',
                'condition' => [
                    'button_show_hide' => 'text'
                ]
            ]
        );
        
        $this->add_control(
		    'button_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} button.tp-coupn-search-btn i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} button.tp-coupn-search-btn svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'button_show_hide' => 'icon'
                ]
		    ]
		);

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'button_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%', 'custom'],
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'hr_input_btn',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

        $this->start_controls_tabs( 'tabs__button' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'     => __( 'Normal', 'tp-elements'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'color: {{VALUE}}',
                    '{{WRAPPER}} button.tp-coupn-search-btn svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} button.tp-coupn-search-btn svg rect' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} button.tp-coupn-search-btn',
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} button.tp-coupn-search-btn'               
		    ]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'     => __( 'Hover', 'tp-elements'),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} button.tp-coupn-search-btn:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} button.tp-coupn-search-btn:hover svg rect' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'button_background_hover',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} button.tp-coupn-search-btn:hover',
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'     => __( 'Border Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
		    'hr_button_3',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

        $this->add_control(
            'input_button_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} button.tp-coupn-search-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],   
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'button_btn_shadow',
                'selector'  => '{{WRAPPER}} button.tp-coupn-search-btn',
            ]
        );

        $this->add_responsive_control(
            'search_btn_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'initial',               
                'options' => [                    
                    'initial' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'position: {{VALUE}} !important;',
                ],                          
            ]
        );
        
		$this->add_responsive_control(
			'horizontal_offset',
			[
				'label' => esc_html__( 'Horizontal Orientation', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
                    'search_btn_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'search_btn_position_left',
            [
                'label' => esc_html__( 'Left', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
               'condition' => [
                    'search_btn_position' => 'absolute',
                    'horizontal_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'search_btn_position_right',
            [
                'label' => esc_html__( 'Right', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
               'condition' => [
                    'search_btn_position' => 'absolute',
                    'horizontal_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_responsive_control(
			'vertical_offset',
			[
				'label' => esc_html__( 'Vertical Orientation', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'tp-elements' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
                    'search_btn_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'search_btn_position_top',
            [
                'label' => esc_html__( 'Top', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
                'condition' => [
                    'search_btn_position' => 'absolute',
                    'vertical_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'search_btn_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
                'condition' => [
                    'search_btn_position' => 'absolute',
                    'vertical_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} button.tp-coupn-search-btn' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'search_btn_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'tp-elements' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} button.tp-coupn-search-btn' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'search_btn_position' => 'absolute',
                ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style',
            [
                'label'     => __( 'Icon', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
                // 'condition' => [
                //     'layout' => 'icon',
                // ],
            ]
        );

        $this->start_controls_tabs( 'tabs_toggle_color' );

        $this->start_controls_tab(
            'tab_toggle_normal',
            [
                'label' => __( 'Normal', 'tp-elements'),
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-icon-toggle i' => 'color: {{VALUE}}; border-color: {{VALUE}}; fill: {{VALUE}};',
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_toggle_hover',
            [
                'label' => __( 'Hover', 'tp-elements'),
            ]
        );

        $this->add_control(
            'toggle_color_hover',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-icon-toggle i:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}',
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search i:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

       
        $this->add_responsive_control(
            'toggle_icon_size',
            [
                'label'              => __( 'Icon Size', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'size' => 15,
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-search-icon-toggle input[type=search]' => 'padding: 0 calc( {{SIZE}}{{UNIT}} / 2);',
                    '{{WRAPPER}} .hfe-search-icon-toggle i.fa-search:before' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hfe-search-icon-toggle i.fa-search, {{WRAPPER}} .hfe-search-icon-toggle' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search i' => 'font-size: {{SIZE}}{{UNIT}};',

                ],
                'condition'          => [
                    'layout' => 'icon',
                ],
                'separator'          => 'before',
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_wrap_icon',
            [
                'label'     => __( 'Search Popup ', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
                
            ]
        );

         $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'search_background_hover',
                'label'     => __( 'Search Popup Background', 'tp-elements'),
                'types'     => [ 'classic', 'gradient' ],
                'separator'          => 'before',
                'selector'  => '.sticky_form.tps-search-popup',
                
            ]
        );
        $this->end_controls_section();
        

        $this->start_controls_section(
            'section_close_icon',
            [
                'label'     => __( 'Close Icon', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
                
            ]
        );

        $this->add_responsive_control(
            'close_icon_size',
            [
                'label'              => __( 'Size', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default'            => [
                    'size' => '20',
                    'unit' => 'px',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-search-form__container button#clear i:before,
                    
                    {{WRAPPER}} .hfe-search-icon-toggle button#clear i:before,
                   
                {{WRAPPER}} .hfe-search-form__container button#clear-with-button i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                 '.close-search:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'frontend_available' => true,

            ]
        );

        $this->add_responsive_control(
            'close_icon_lineheight',
            [
                'label'              => __( 'Line Height', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default'            => [
                    'size' => '20',
                    'unit' => 'px',
                ],
                'selectors'          => [
                  
                    '.close-search:before' => 'line-height: {{SIZE}}{{UNIT}};',

                ],
                'frontend_available' => true,

            ]
        );

        $this->start_controls_tabs( 'close_icon_normal' );

        $this->start_controls_tab(
            'normal_close_button',
            [
                'label' => __( 'Normal', 'tp-elements'),
            ]
        );
        $this->add_control(
            'text_color',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#7a7a7a',
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__container button#clear-with-button,
                    {{WRAPPER}} .hfe-search-form__container button#clear,
                    {{WRAPPER}} .close-search,
                    {{WRAPPER}} .hfe-search-icon-toggle button#clear' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'hover_close_icon',
            [
                'label' => __( 'Hover', 'tp-elements'),
            ]
        );

        $this->add_control(
            'hover_close_icon_text',
            [
                'label'     => __( 'Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__container button#clear-with-button:hover,
                    {{WRAPPER}} .hfe-search-form__container button#clear:hover,
                    {{WRAPPER}} .hfe-search-icon-toggle button#clear:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_sticky_options',
            [
                'label' => esc_html__('Sticky Options', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->start_controls_tabs( 'tabs_cart_style_stikcy' );

			$this->start_controls_tab(
				'stikcy_cart_item_normal',
				[
					'label' => __( 'Normal', 'tp-elements' ),
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sticky_search_input_wrappr_background',
                    'label' => esc_html__( 'Search Wrapper Background', 'tp-elements' ),
                    'types' => [ 'classic', 'gradient', 'tp-elements' ],
                    'exclude' => [
                        'image'
                    ],
                    'selector' => '.tp-sticky {{WRAPPER}} .tp-coupn-search-input-wrapper',
                    'separator' => 'before',
                ]
            );
    
            $this->add_control(
                'sticky_input_text_color',
                [
                    'label'     => __( 'Search Input Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} input#course-search-input' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sticky_input_background',
                    'label' => esc_html__( 'Search Input Background', 'tp-elements' ),
                    'types' => [ 'classic', 'gradient', 'tp-elements' ],
                    'exclude' => [
                        'image'
                    ],
                    'selector' => '.tp-sticky {{WRAPPER}} input#course-search-input',
                ]
            );
    
            
            $this->add_control(
                'sticky_input_placeholder_color',
                [
                    'label'     => __( 'Input Placeholder Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} input#course-search-input::placeholder' => 'color: {{VALUE}}',
                    ],
                    'default'   => '#777',
                ]
            );
    
            $this->add_control(
                'sticky_button_text_color',
                [
                    'label'     => __( 'Search Button Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} button.tp-coupn-search-btn' => 'color: {{VALUE}}',
                        '.tp-sticky  {{WRAPPER}} button.tp-coupn-search-btn svg path' => 'fill: {{VALUE}};',
                        '.tp-sticky  {{WRAPPER}} button.tp-coupn-search-btn svg rect' => 'fill: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sticky_button_background',
                    'label' => esc_html__( 'Search Button Background', 'tp-elements' ),
                    'types' => [ 'classic', 'gradient', 'tp-elements' ],
                    'exclude' => [
                        'image'
                    ],
                    'selector' => '.tp-sticky {{WRAPPER}} button.tp-coupn-search-btn',
                ]
            );
    
            
            $this->add_control(
                'sticky_toggle_color',
                [
                    'label'     => __( 'Serch Icon Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} .hfe-search-icon-toggle i' => 'color: {{VALUE}}; border-color: {{VALUE}}; fill: {{VALUE}};',
                        '.tp-sticky {{WRAPPER}} .tps-search-button-wrapper .sticky_search i' => 'color: {{VALUE}};',
                    ],
                ]
            );

			$this->end_controls_tab();

			$this->start_controls_tab(
				'sticky_menu_item_hover',
				[
					'label' => __( 'Hover', 'tp-elements' ),
				]
			);

            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sticky_search_input_wrappr_background_hover',
                    'label' => esc_html__( 'Search Input Wrapper Background', 'tp-elements' ),
                    'types' => [ 'classic', 'gradient', 'tp-elements' ],
                    'exclude' => [
                        'image'
                    ],
                    'selector' => '.tp-sticky {{WRAPPER}} .tp-coupn-search-input-wrapper:hover',
                    'separator' => 'before',
                ]
            );
    
            $this->add_control(
                'sticky_input_text_color_hover',
                [
                    'label'     => __( 'Search Input Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} input#course-search-input:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );
    
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sticky_input_background_hover',
                    'label' => esc_html__( 'Search Input Background', 'tp-elements' ),
                    'types' => [ 'classic', 'gradient', 'tp-elements' ],
                    'exclude' => [
                        'image'
                    ],
                    'selector' => '.tp-sticky {{WRAPPER}} input#course-search-input:hover',
                ]
            );
    
            $this->add_control(
                'sticky_button_text_color_hover',
                [
                    'label'     => __( 'Search Button Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} button.tp-coupn-search-btn:hover' => 'color: {{VALUE}}',
                        '.tp-sticky  {{WRAPPER}} button.tp-coupn-search-btn:hover svg path' => 'fill: {{VALUE}};',
                        '.tp-sticky  {{WRAPPER}} button.tp-coupn-search-btn:hover svg rect' => 'fill: {{VALUE}};',
                    ],
                ]
            );
    
            $this->add_group_control(
                \Elementor\Group_Control_Background::get_type(),
                [
                    'name' => 'sticky_button_background_hover',
                    'label' => esc_html__( 'Search Button Background', 'tp-elements' ),
                    'types' => [ 'classic', 'gradient', 'tp-elements' ],
                    'exclude' => [
                        'image'
                    ],
                    'selector' => '.tp-sticky {{WRAPPER}} button.tp-coupn-search-btn:hover',
                ]
            );
    
            
            $this->add_control(
                'sticky_toggle_color_hover',
                [
                    'label'     => __( 'Serch Icon Color', 'tp-elements'),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '.tp-sticky {{WRAPPER}} .hfe-search-icon-toggle i:hover' => 'color: {{VALUE}}; border-color: {{VALUE}}; fill: {{VALUE}};',
                        '.tp-sticky {{WRAPPER}} .tps-search-button-wrapper .sticky_search i:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );

			$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

    }
    /**
     * Render Search button output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $sstyle = $settings['layout'];

        ?>

        <style>
        /* Course Search Results Container */
        #course-search-results {
            position: absolute;
            width: 100%;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            max-height: 200px;
            overflow-y: auto;
            top: 100%;
            padding: 0 20px;
            z-index: 1000;
        }

        #course-search-results ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #course-search-results li {
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }

        #course-search-results li a {
            text-decoration: none;
            color: #333;
            font-weight: 500;
        }

        #course-search-results li a:hover {
            color: #ff6a3d;
        }

        /* Search Button */
        button.tp-course-search-btn {
            position: absolute;
            height: 100%;
            line-height: 100%;
            min-width: 40px;
            padding: 0;
            border-radius: 50%;
            right: 8px;
            height: calc(100% - 10px);
            top: 50%;
            transform: translateY(-50%);
            background-color: #ff6a3d;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button.tp-course-search-btn:hover {
            background-color: #e55a2e;
        }

        /* Search Input Field */

        /* Wrapper for Input and Button */
        .tp-course-search {
            display: flex;
            position: relative;
            align-items: center;
            background: #fff;
            border-radius: 100px;
            border: 1px solid #ddd;
            padding-right: 10px;
        }

        /* Category Dropdown */
        .tp-course-category {
            width: max-content;
            background-color: transparent;
            border-right: 1px solid rgba(213, 224, 228, 1);
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            margin-bottom: 0;
            padding: 0 15px;
            height: 45px;
            line-height: 45px;
            border: none;
            color: #333;
            font-weight: 500;
        }

        .tp-course-category:focus {
            outline: none;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            #course-search-results {
                font-size: 14px;
            }

            /* input#course-search-input {
                height: 40px;
            } */

            .tp-course-category {
                height: 40px;
                line-height: 40px;
                padding: 0 10px;
            }

            button.tp-course-search-btn {
                height: 40px;
            }
        }

        </style>

        <?php

        if($sstyle){
            require plugin_dir_path(__FILE__)."/$sstyle.php";
        }else{
            require plugin_dir_path(__FILE__)."/style1.php";
        }
        
    }

    
}
