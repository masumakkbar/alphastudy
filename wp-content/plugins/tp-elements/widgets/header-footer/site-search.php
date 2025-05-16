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
class Themephi_Search_Button extends Widget_Base {
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
        return 'hfe-search-button';
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
        return __( 'TP HFE Search', 'tp-elements');
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
        return 'eicon-search';
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
        return [ 'header_footer_category' ];
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
                'label' => __( 'Search Layout', 'tp-elements'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'        => __( 'Layout ', 'tp-elements'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'icon',
                'options'      => [
                    'icon'      => __( 'Icon', 'tp-elements'),
                    'input_box'      => __( 'Input Box', 'tp-elements'),
                    'input_box_button' => __( 'Input Box With Button', 'tp-elements'),
                ],
                'prefix_class' => 'hfe-search-layout-',
                'render_type'  => 'template',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_search_controls_start',
            [
                'label' => __( 'Search Content', 'tp-elements'),
            ]
        );

        $this->add_control(
            'placeholder',
            [
                'label'     => __( 'Placeholder', 'tp-elements'),
                'type'      => Controls_Manager::TEXT,
                'default'   => __( 'Search', 'tp-elements') . '...',
                'placeholder'   => __( 'Type & Hit Enter', 'tp-elements'),
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );
        
		$this->add_control(
			'button_type',
			[
				'label'   => esc_html__( 'Select Button Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'icon',			
				'options' => [					
					'icon' => esc_html__( 'Icon', 'tp-elements'),
					'text' => esc_html__( 'Text', 'tp-elements'),			
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'icon_button',
			[
				'label'     => esc_html__( 'Select Icon', 'tp-elements' ),		
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-search',
					'library' => 'fa-solid',
				],			
				'separator' => 'before',	
				'label_block' => true,	

				'condition' => [
					'button_type' => 'icon',
				],				
			]
		);

		$this->add_control(
			'text_button',
			[
				'label' => esc_html__( 'Submit Text', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Search', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Type Submit Text', 'tp-elements' ),
                'separator'   => 'before',
				'condition' => [
					'button_type' => 'text',
				],
			]
		);	

        $this->add_control(
            'show_reset_icon',
            [
                'label' => esc_html__( 'Show Reset Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-elements' ),
                'label_off' => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
					'layout' => 'input_box',
				],
            ]
        );

		$this->add_control(
			'reset_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'tp-elements' ),		
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-close',
					'library' => 'solid',
				],			
				'separator' => 'before',	
				'label_block' => true,	
				'condition' => [
					'show_reset_icon' => 'yes',
                    'layout' => 'input_box',
				],				
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
            'section_input_box_style',
            [
                'label' => __( 'Input Box', 'tp-elements'),
                'tab'   => Controls_Manager::TAB_STYLE,                

            ]
        );

        $this->add_control(
            'input_box_background_color',
            [
                'label'     => __( 'Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__container' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'input_box_width',
            [
                'label'              => __( 'Width', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-search-form__container' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'input_box_display',
            [
                'label'   => esc_html__( 'Display', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'flex',               
                'options' => [                    
                    'flex' => 'Flex',
                    'block' => 'Block',                             
                ],      
                'prefix_class' => 'tp-input-box-', 
                                               
            ]
        );

        $this->add_control(
		    'input_box_display_gap',
		    [
		        'label' => esc_html__( 'Input Box Gap', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 12
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-search-form__container' => 'gap: {{SIZE}}{{UNIT}};',         
		        ],
                'condition' => [
                    'input_box_display' => 'flex'
                ]
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'input_box_border',
				'selector' => '{{WRAPPER}} .hfe-search-form__container',
			]
		);

        $this->add_responsive_control(
		    'input_box_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .hfe-search-form__container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

        $this->add_responsive_control(
            'input_box_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .hfe-search-form__container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
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

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'input_typography',
                'selector' => '{{WRAPPER}} input[type="search"].hfe-search-form__input,{{WRAPPER}} .hfe-search-icon-toggle',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'input_icon_width',
            [
                'label'              => __( 'Width', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle input[type=search]' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hfe-search-form__input' => 'width: {{SIZE}}{{UNIT}};',
                ],
                // 'condition'          => [
                //     'layout' => 'icon',
                // ],
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'input_icon_height',
            [
                'label'              => __( 'Height', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'default'            => [
                    'size' => 56,
                ],
                'size_units' => [ 'px', '%', 'custom' ],
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 1500,
                    ],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle input[type=search]' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .hfe-search-form__input' => 'height: {{SIZE}}{{UNIT}};',
                ],
                // 'condition'          => [
                //     'layout' => 'icon',
                // ],
                'frontend_available' => true,
            ]
        );

        $this->start_controls_tabs( 'tabs_input_colors' );

        $this->start_controls_tab(
            'tab_input_normal',
            [
                'label'     => __( 'Normal', 'tp-elements'),
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_text_color',
            [
                'label'     => __( 'Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_placeholder_color',
            [
                'label'     => __( 'Placeholder Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input::placeholder' => 'color: {{VALUE}}',
                ],
                'default'   => '#7A7A7A6B',
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_background_color',
            [
                'label'     => __( 'Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ededed',
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input, {{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle .hfe-search-form__input' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .hfe-search-icon-toggle .hfe-search-form__input' => 'background-color: transparent;',
                ],
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'      => 'input_box_shadow',
                'selector'  => '{{WRAPPER}} .hfe-search-form__container,{{WRAPPER}} input.hfe-search-form__input',
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );
        $this->add_control(
            'border_style',
            [
                'label'       => __( 'Border Style', 'tp-elements'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', 'tp-elements'),
                    'solid'  => __( 'Solid', 'tp-elements'),
                    'double' => __( 'Double', 'tp-elements'),
                    'dotted' => __( 'Dotted', 'tp-elements'),
                    'dashed' => __( 'Dashed', 'tp-elements'),
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hfe-search-form__input,{{WRAPPER}} .hfe-input-focus .hfe-search-form__input' => 'border-style: {{VALUE}};',
                ],
                'condition'   => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => __( 'Border Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input,{{WRAPPER}} .hfe-input-focus .hfe-search-form__input' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'layout!' => 'icon',
                    'border_style!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label'      => __( 'Border Width', 'tp-elements'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hfe-search-form__input,{{WRAPPER}} .hfe-input-focus .hfe-search-form__input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'layout!' => 'icon',
                    'border_style!' => 'none'
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'     => __( 'Border Radius', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input,{{WRAPPER}} .hfe-input-focus .hfe-search-form__input' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before',
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_input_focus',
            [
                'label'     => __( 'Focus', 'tp-elements'),
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_text_color_focus',
            [
                'label'     => __( 'Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-form__input:focus,
                    {{WRAPPER}} .tps-search-button-wrapper input[type=search]:focus' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_placeholder_hover_color',
            [
                'label'     => __( 'Placeholder Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input:focus::placeholder' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_background_color_focus',
            [
                'label'     => __( 'Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__input:focus,
                    {{WRAPPER}}.hfe-search-layout-icon .hfe-search-icon-toggle .hfe-search-form__input' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'input_box_shadow_focus',
                'selector'       =>
                '{{WRAPPER}} .tps-search-button-wrapper.hfe-input-focus .hfe-search-form__container,
                 {{WRAPPER}} .tps-search-button-wrapper.hfe-input-focus input.hfe-search-form__input',
                'fields_options' => [
                    'box_shadow_type' => [
                        'separator' => 'default',
                    ],
                ],
                'condition'      => [
                    'layout!' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'input_border_color_focus',
            [
                'label'     => __( 'Border Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-form__container,
                     {{WRAPPER}} .hfe-search-form__input:focus' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'layout!' => 'icon',
                    'border_style!' => 'none'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'icon_text_color_focus',
            [
                'label'     => __( 'Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-form__input:focus' => 'color: {{VALUE}}',
                ],
                'condition' => [
                    'layout' => 'icon',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_text_background_color_focus',
            [
                'label'     => __( 'Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#ededed',
                'selectors' => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-form__input:focus' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'layout' => 'icon',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'           => 'icon_box_shadow_focus',
                'selector'       =>
                '{{WRAPPER}} .tps-search-button-wrapper.hfe-input-focus .hfe-search-form__container,
                 {{WRAPPER}} .tps-search-button-wrapper.hfe-input-focus input.hfe-search-form__input',
                'fields_options' => [
                    'box_shadow_type' => [
                        'separator' => 'default',
                    ],
                ],
                'condition'      => [
                    'layout' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_border_style',
            [
                'label'       => __( 'Border Style', 'tp-elements'),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'none',
                'label_block' => false,
                'options'     => [
                    'none'   => __( 'None', 'tp-elements'),
                    'solid'  => __( 'Solid', 'tp-elements'),
                    'double' => __( 'Double', 'tp-elements'),
                    'dotted' => __( 'Dotted', 'tp-elements'),
                    'dashed' => __( 'Dashed', 'tp-elements'),
                ],
                'selectors'   => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle .hfe-search-form__input' => 'border-style: {{VALUE}};',
                ],
                'condition'   => [
                    'layout' => 'icon',
                ],
            ]
        );

        $this->add_control(
            'icon_border_color_focus',
            [
                'label'     => __( 'Border Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-form__container,
                     {{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle .hfe-search-form__input' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'layout'             => 'icon',
                    'icon_border_style!' => 'none',
                ],
            ]
        );

        $this->add_control(
            'icon_border_width',
            [
                'label'      => __( 'Border Width', 'tp-elements'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px' ],
                'default'    => [
                    'top'    => '1',
                    'bottom' => '1',
                    'left'   => '1',
                    'right'  => '1',
                    'unit'   => 'px',
                ],
                'condition'  => [
                    'icon_border_style!' => 'none',
                    'layout'             => 'icon',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle .hfe-search-form__input' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_focus_border_radius',
            [
                'label'     => __( 'Border Radius', 'tp-elements'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-input-focus .hfe-search-icon-toggle .hfe-search-form__input' => 'border-radius: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'layout' => 'icon',
                ],
            ]
        );

        $this->add_responsive_control(
			'input_border_radius',
			[
				'label' => esc_html__( 'Padding', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
					'px' => [
						'max' => 200,
					],
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
					'em' => [
						'max' => 20,
					],
					'rem' => [
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .hfe-search-form__input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_button_style',
            [
                'label'     => __( 'Button', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'icon_text',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_button_colors' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'tp-elements'),
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label'     => __( 'Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#fff',
                'selectors' => [
                    '{{WRAPPER}} button.hfe-search-submit' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'button_background',
                'label'          => __( 'Background', 'tp-elements'),
                'types'          => [ 'classic', 'gradient' ],
                'exclude'        => [ 'image' ],
                'selector'       => '{{WRAPPER}} .hfe-search-submit',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color'      => [
                        'default' => '#818a91',
                    ],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'tp-elements'),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( 'Icon Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color_hover',
            [
                'label'     => __( 'Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit:hover' => 'background-color: {{VALUE}}',
                ],
                'condition' => [
                    'button_background_color_hover!' => '',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'button_background_hover',
                'label'     => __( 'Background', 'tp-elements'),
                'types'     => [ 'classic', 'gradient' ],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .hfe-search-submit:hover',
                'condition' => [
                    'button_background_color_hover' => '',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
            [
                'label'              => __( 'Icon Size', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'            => [
                    'size' => '16',
                    'unit' => 'px',
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-search-submit' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
                'condition'          => [
                    'layout!' => 'icon',
                ],
                'separator'          => 'before',
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            'button_width',
            [
                'label'              => __( 'Width', 'tp-elements'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'max'  => 500,
                        'step' => 5,
                    ],
                ],
                'selectors'          => [
                    '{{WRAPPER}} .hfe-search-form__container .hfe-search-submit' => 'width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .hfe-close-icon-yes button#clear_with_button' => 'right: {{SIZE}}{{UNIT}}',
                ],
                'condition'          => [
                    'layout' => 'icon_text',
                ],
                'render_type'        => 'template',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style',
            [
                'label'     => __( 'Icon', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'icon',
                ],
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
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search:hover i' => 'color: {{VALUE}};',
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

     
         $this->add_control(
            'width',
            [
                'label' => esc_html__( 'Icon Box width', 'tp-elements' ),
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
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search' => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
          $this->add_control(
            'height',
            [
                'label' => esc_html__( 'Icon Box Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search' => 'height: {{SIZE}}{{UNIT}};',
                   
                ],
            ]
        );
           $this->add_control(
            'line-height',
            [
                'label' => esc_html__( 'Icon Box Line Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .tps-search-button-wrapper .sticky_search' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Box Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '.tps-search-button-wrapper .sticky_search',
            ]
        );   

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Icon Box Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '.tps-search-button-wrapper .sticky_search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    {{WRAPPER}} .hfe-search-submit i,
                   
                {{WRAPPER}} .hfe-search-form__container button#clear-with-button i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                 '.close-search:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'frontend_available' => true,

            ]
        );

        $this->add_responsive_control(
            'close_icon_width',
            [
                'label' => esc_html__( 'Width', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'default'            => [
                    'size' => 56,
                ],
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
                    '{{WRAPPER}} .hfe-search-submit' => 'width: {{SIZE}}{{UNIT}};',
                ]
            ]
        );   

        $this->add_responsive_control(
            'close_icon_height',
            [
                'label' => esc_html__( 'Height', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'default'            => [
                    'size' => 56,
                ],
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
                    '{{WRAPPER}} .hfe-search-submit' => 'height: {{SIZE}}{{UNIT}};',
                ]
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
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
                'default'   => '#7a7a7a',
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-form__container button#clear-with-button,
                    {{WRAPPER}} .hfe-search-form__container button#clear,
                    {{WRAPPER}} .hfe-search-submit,
                    {{WRAPPER}} .close-search,
                    {{WRAPPER}} .hfe-search-icon-toggle button#clear' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'close_icon_background',
            [
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );   

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'close_icon_border',
                'selector' => '{{WRAPPER}} .hfe-search-submit',
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
                    {{WRAPPER}} .hfe-search-submit:hover,
                    {{WRAPPER}} .hfe-search-icon-toggle button#clear:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'close_icon_background_hover',
            [
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit:hover' => 'background-color :{{VALUE}};',
                ],
            ]
        );   

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'close_icon_border_hover',
                'selector' => '{{WRAPPER}} .hfe-search-submit:hover',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
		    'close_icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [ 
                    '{{WRAPPER}} .hfe-search-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
		        ],
                
		    ]
		);

        $this->add_responsive_control(
            'close_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .hfe-search-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'close_icon_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'relative',               
                'options' => [                    
                    'relative' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit' => 'position: {{VALUE}};',
                ],   
                                               
            ]
        );

        $this->add_responsive_control(
			'close_icon_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .hfe-search-submit' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'close_icon_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'close_icon_position_top',
            [
                'label' => esc_html__( 'Top', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'close_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_icon_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'close_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_icon_position_left',
            [
                'label' => esc_html__( 'Left', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
               'condition' => [
                    'close_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'close_icon_position_right',
            [
                'label' => esc_html__( 'Right', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
               'condition' => [
                    'close_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-search-submit' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

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

        $this->add_render_attribute(
            'input',
            [
                'placeholder' => $settings['placeholder'],
                'class'       => 'hfe-search-form__input',
                'type'        => 'search',
                'name'        => 's',
                'title'       => __( 'Search', 'tp-elements'),
                'value'       => get_search_query(),

            ]
        );

        $this->add_render_attribute(
            'container',
            [
                'class' => [ 'hfe-search-form__container' ],
                'role'  => 'tablist',
            ]
        );

        ?>
        <style>
            .search-type-icon .only_icon_or_text {
                color: #fff;
                cursor: pointer;
                font-size: 18px;
                font-weight: 300;
            }
            .search-type-input_box {
                [type="search"] {
                    border-color: transparent;
                    background-color: transparent;
                    border-bottom: 1px solid #eee;

                }
                [type="submit"] {
                    border-color: transparent;
                    background-color: transparent;
                    border-bottom: 1px solid #eee;
                    color: #000;
                    padding-left: 0;
                    padding-right: 0;
                }
                button[type="reset"] {
                    background: transparent;
                    color: #000;
                }
            }
        </style>
        <form class="tps-search-button-wrapper search-type-<?php echo esc_attr( $settings['layout'] ); ?>" action="<?php echo home_url(); ?>" method="get">

            <!-- Start from here  -->
            <?php if ( 'input_box_button' === $settings['layout'] ) { ?>

            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'container' ) ); ?>>

                <input <?php echo $this->get_render_attribute_string( 'input' ); ?>><?php if( !empty($settings['icon_button']) || !empty($settings['text_button']) ) : ?><button class="hfe-search-submit" type="submit"><?php if(!empty($settings['icon_button'])) : ?><?php \Elementor\Icons_Manager::render_icon( $settings['icon_button'], [ 'aria-hidden' => 'true' ] ); ?><?php endif; ?><?php if(!empty($settings['text_button'])) : ?><?php echo esc_html( $settings['text_button'] ); ?><?php endif; ?></button><?php endif; ?>
 
            </div>
          
            <?php } elseif( 'input_box' === $settings['layout'] ) { ?>

            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'container' ) ); ?>>

                <input <?php echo $this->get_render_attribute_string( 'input' ); ?>><?php if( !empty($settings['icon_button']) || !empty($settings['text_button']) ) : ?><button class="hfe-search-submit" type="submit"><?php if(!empty($settings['icon_button'])) : ?><?php \Elementor\Icons_Manager::render_icon( $settings['icon_button'], [ 'aria-hidden' => 'true' ] ); ?><?php endif; ?><?php if(!empty($settings['text_button'])) : ?><?php echo esc_html( $settings['text_button'] ); ?><?php endif; ?></button><?php endif; ?><?php if( 'yes' == $settings['show_reset_icon'] && !empty($settings['reset_icon']) ) : ?><button id="clear" type="reset"><?php \Elementor\Icons_Manager::render_icon( $settings['reset_icon'], [ 'class' => 'clearable__clear', 'aria-hidden' => 'true' ] ); ?></button><?php endif; ?>
            
            </div>

            <?php } else { ?>

            <?php if( !empty($settings['icon_button']) || !empty($settings['text_button']) ) : ?>
            <div class="sticky_search d-inline-block only_icon_or_text" >
                <?php if(!empty($settings['icon_button'])) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['icon_button'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>
                <?php if(!empty($settings['text_button'])) : ?>
                    <?php echo esc_html( $settings['text_button'] ); ?>
                <?php endif; ?>
            </div>
            <?php endif; ?>


        <?php } ?>
        </form>
        <?php
    }
}
