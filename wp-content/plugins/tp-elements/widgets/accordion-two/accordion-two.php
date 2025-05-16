<?php
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Text_Stroke;;

defined( 'ABSPATH' ) || die();
class Themephi_Widget_Accordion_Two extends \Elementor\Widget_Base {
  
    public function get_name() {
        return 'tp-custom-accordions-two';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'TP Accordion Two', 'tp-elements' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-accordion';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'AccordionTwo' ];
    } 

    protected function register_controls() {
        $this->start_controls_section(
            '_section_accordion',
            [
                'label' => esc_html__( 'Item', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'accordion_style',
            [
                'label'   => esc_html__( 'Select Style', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',               
                'options' => [                    
                    'style1' => 'Style 1',
                    'style2' => 'Style 2',                              
                ],                                          
            ]
        );

        $repeater = new Repeater();

    

        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Item Title', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Title', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Item Description', 'tp-elements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                
            ]
        ); 

        $this->add_control(
			'accordion_icon',
			[
				'label' => esc_html__( 'Accordion Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-up',
					'library' => 'solid',
				],			
				'separator' => 'before',	
                'skin' => 'inline',
				'label_block' => true,		
			]
		);

        $this->add_control(
			'accordion_active_icon',
			[
				'label' => esc_html__( 'Accordion Active Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-down',
					'library' => 'solid',
				],			
				'separator' => 'before',
                'skin' => 'inline',
				'label_block' => false,		
                // 'condition' => [
				// 	'accordion_icon[value]!' => '',
				// ],	
			]
		);

        $this->add_control(
			'heading_accordion_item_title_icon',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'accordion_item_title_icon_position',
			[
				'label' => esc_html__( 'Horizontal Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
                'prefix_class' => 'tp-icon-position-',
			]
		);

		$this->add_responsive_control(
			'accordion_item_title_icon_position_vertical',
			[
				'label' => esc_html__( 'Vertical Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
				],
                'prefix_class' => 'tp-icon-two-position-',
                'condition'    => [
                    'accordion_item_title_icon_position!' => 'end'
                ]
			]
		);

        
        $this->add_responsive_control(
			'accordion_item_title_position_vertical',
			[
				'label' => esc_html__( 'Item Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'separator' => 'before',
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-h-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
				],
                'prefix_class' => 'tp-item-two-position-',
                'condition'    => [
                    'accordion_item_title_icon_position_vertical!' => 'start',
                    'accordion_item_title_icon_position!' => 'end'
                ]
			]
		);

        $this->add_control(
            'show_title_count',
            [
                'label' => esc_html__( 'Show Title Count', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-elements' ),
                'label_off' => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
       

       $this->end_controls_section();


       $this->start_controls_section(
        '_accordion_item_style',
        [
            'label' => esc_html__( 'Accordion Item', 'tp-elements' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
        );

        $this->add_responsive_control(
			'accordion_item_title_space_between',
			[
				'label' => esc_html__( 'Space between Items', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
					'rem' => [
						'max' => 20,
					],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_responsive_control(
			'accordion_item_title_distance_from_content',
			[
				'label' => esc_html__( 'Distance from content', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
					'rem' => [
						'max' => 20,
					],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body' => 'margin-top: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_item_shadow',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'accordion_item_border',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item',
			]
		);

        $this->add_responsive_control(
		    'accordion_item_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		            '{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-header button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

        $this->add_responsive_control(
			'accordion_padding',
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion_icon_style',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'title_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-header button .accordion-icon-active' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'title_icon_width',
			[
				'label' => esc_html__( 'Icon Width', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-header button .accordion-icon-active i' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'title_icon_height',
			[
				'label' => esc_html__( 'Icon Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-header button .accordion-icon-active i' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->start_controls_tabs(
            'icon_style_tabs'
        );

        $this->start_controls_tab(
            'icon_style_accordion_tab',
            [
                'label' => esc_html__( 'Normal ', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'accordion_icon_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span svg' => 'fill: {{VALUE}}',
                ],       
                'separator'   => 'before',     
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'accordion_icon_background_color',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span',
            ]
        );

		

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'accordion_icon_border',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span',
                
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'icon_style_accordion_tab_active',
            [
                'label' => esc_html__( 'Active ', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'accordion_icon_color_active',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span.accordion-icon-active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span.accordion-icon-active svg' => 'fill: {{VALUE}}',
                ],       
                'separator'   => 'before',     
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'accordion_icon_background_color_active',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span.accordion-icon-active',
            ]
        );

		

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'accordion_icon_border_active',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span.accordion-icon-active',
                
			]
		);

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
		    'accordion_icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [ 
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',    
		        ],
		    ]
		);

        $this->add_responsive_control(
			'accordion_icon_padding',
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button-icon span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'icon_spacing',
			[
				'label' => esc_html__( 'Spacing', 'elementor' ),
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-button' => 'gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'accordion_item_title_position_horizontal!' => 'stretch',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
        'accordion_heading_style',
        [
            'label' => esc_html__( 'Heading', 'tp-elements' ),
            'tab' => Controls_Manager::TAB_STYLE,
        ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_title__typography',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item button.accordion-button .accordion-button-title',
			]
		);

        $this->add_control(
            'heading_text_align',
            [
                'label' => esc_html__( 'Alignment', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'start',
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'textdomain' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'textdomain' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'textdomain' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                    
                ],
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item button .accordion-button-heading' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'heading_style_tabs_icon'
        );

        $this->start_controls_tab(
            'heading_style_accordion_tab',
            [
                'label' => esc_html__( 'Normal ', 'tp-elements' ),
            ]
        );

        $this->add_control(
            '_title_color',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button .accordion-button-title' => 'color: {{VALUE}}',
                ],               
            ]
        );     
        
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => '_title_shadow',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button .accordion-button-title',
			]
		);

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => '_title_stoke',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button .accordion-button-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => '_title_background',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button',
            ]
        );

        
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'new_accordion_item_border',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button',
			]
		);

        $this->add_responsive_control(
		    'new_item_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'heading_style_tab_active',
            [
                'label' => esc_html__( 'Active', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            '_title_color_active',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button:not(.collapsed) .accordion-button-title' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-header button.accordion-button' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .tps-accordion-two.style3 .accordion-item .accordion-header button.accordion-button' => 'color: {{VALUE}} !important',
                ],           
            ]
        );
          
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => '_title_shadow_active',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button:not(.collapsed) .accordion-button-title',
			]
		);

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => '_title_stoke_active',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button:not(.collapsed) .accordion-button-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => '_title_background_active',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button:not(.collapsed)',
            ]
        );

        
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'new_accordion_item_border_active',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button:not(.collapsed)',
			]
		);

        $this->add_responsive_control(
		    'new_item_border_radius_active',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button:not(.collapsed)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
			'heading_padding',
			[
				'label' => esc_html__( 'Padding', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'range' => [
					'px' => [
						'max' => 200,
					],
					'%' => [
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button.accordion-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'accordion_heading_number',
            [
                'label' => esc_html__( 'Heading Number', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title_count' => 'yes'
                ]   
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => '_title_number_typography',
                'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item button .accordion-button-number',
            ]
        );

        $this->start_controls_tabs(
            'heading_number_tabs'
        );

        $this->start_controls_tab(
            'heading_number_accordion_tab',
            [
                'label' => esc_html__( 'Normal ', 'tp-elements' ),
            ]
        );
        
        $this->add_control(
            '_title_number_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button .accordion-button-number' => 'color: {{VALUE}}',
                ],      
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => '_title_number_background',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button .accordion-button-number',
            ]
        );

        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_title_number_border',
                'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button .accordion-button-number',
            ]
        );

        $this->add_responsive_control(
            '_title_number_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button .accordion-button-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'heading_number_tab_active',
            [
                'label' => esc_html__( 'Active', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            '_title_number_color_active',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button:not(.collapsed) .accordion-button-number' => 'color: {{VALUE}}'
                ],           
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => '_title_number_background_active',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button:not(.collapsed) .accordion-button-number',
            ]
        );

        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => '_title_number_border_active',
                'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button:not(.collapsed) .accordion-button-number',
            ]
        );

        $this->add_responsive_control(
            '_title_number_border_radius_active',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button:not(.collapsed) .accordion-button-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],
            ]
        );


        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'heading_number_padding',
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
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-header button .accordion-button-number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'heading_number_space',
			[
				'label' => esc_html__( 'Distance From Title', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 200,
					],
					'em' => [
						'max' => 20,
					],
					'rem' => [
						'max' => 20,
					],
				],
				'default' => [
					'size' => 0,
				],
				'selectors' => [
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item button .accordion-button-number' => 'margin-right: {{SIZE}}{{UNIT}}',
				],
			]
		);

        $this->end_controls_section();

        

        $this->start_controls_section(
        'accordion_content_style',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_desc__typography',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body',
			]
		);

        $this->add_control(
            'desc_text_align',
            [
                'label' => esc_html__( 'Alignment', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'start',
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Start', 'textdomain' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'textdomain' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'End', 'textdomain' ),
                        'icon' => 'eicon-text-align-right',
                    ]
                    
                ],
                'selectors' => [
                    '{{WRAPPER}} .accordion-body' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            '_desc__color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body' => 'color: {{VALUE}}',
                ],       
                'separator'   => 'before',     
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => '_desc_background_color',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body',
            ]
        );

		

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => '_desc__border',
				'selector' => '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body',
                
			]
		);

        $this->add_responsive_control(
		    '_desc_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [ 
                    '{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',     
                    '{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-body' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',     
		        ],
		    ]
		);

        
        $this->add_responsive_control(
			'_desc__padding',
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .tps-accordion-two.style2 .accordion-item .accordion-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                 'separator' => 'after'
			]
		);

        $this->add_responsive_control(
			'_desc__margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
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
					'{{WRAPPER}} .tps-accordion-two.style1 .accordion-item .accordion-body' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                 'separator' => 'after'
			]
		);

        $this->end_controls_section();

   }
    protected function render() {    	
        $settings = $this->get_settings_for_display();
        $unique = rand(2012,35120);
        ?>
        <div class="tps-accordion-two <?php echo $settings['accordion_style'];?>" id="accordionExample<?php echo $unique;?>">
            <?php $x = 0; 
            foreach ( $settings['logo_list'] as $index => $item ) :
                $title = !empty($item['name']) ? $item['name'] : '';
                $description = !empty($item['description']) ? $item['description'] : '';
             $x++;
         
            if($x== 1){
                $collapse  = '';
                $show = 'show';
                $true = 'true';
            }
            else{
                $collapse  = 'collapsed';
                $show = '';
                $true = 'false';
            }
           
            $dataUnique = $unique . $x;
           
            if( $settings['accordion_style'] == 'style1'): ?>                                
         
                <div class="accordion-item">
                    <div class="accordion-header" id="heading<?php echo $dataUnique;?>">
                        <button class="accordion-button <?php echo $collapse;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $dataUnique;?>" aria-expanded="<?php echo $true;?>" aria-controls="collapse<?php echo $dataUnique;?>">
                            <span class="accordion-button-heading">
                                <?php if( ($settings['show_title_count'] == 'yes') ) : ?>
                                    <span class="accordion-button-number"><?php echo '0'.$x.'.';?></span>
                                <?php endif;?>
                                <span class="accordion-button-title">
                                    <?php echo wp_kses_post($title);?>
                                </span>
                            </span>
                            <span class="accordion-button-icon">
                                <span class="accordion-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <span class="accordion-icon-active">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_active_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            </span>
                        </button>
                    </div>
                    <div id="collapse<?php echo $dataUnique;?>" class="accordion-collapse collapse <?php echo $show;?>" aria-labelledby="heading<?php echo $dataUnique;?>" data-bs-parent="#accordionExample<?php echo $unique;?>">
                        <div class="accordion-body">
                            <?php echo wp_kses_post( $description ); ?>
                        </div>
                    </div>
                </div>
                
            <?php else : ?>
                <div class="accordion-item">
                    <div class="accordion-header this_is_style2" id="heading-<?php echo $dataUnique;?>">
                        <button class="accordion-button <?php echo $collapse;?>" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $dataUnique;?>" aria-expanded="<?php echo $true;?>" aria-controls="collapse<?php echo $dataUnique;?>">
                        
                            <?php if($settings['show_title_count']) :?>
                                <span><?php echo '0'.$x.'.';?></span>
                            <?php endif;?> 
                            <?php echo wp_kses_post ($title);?> 
                            <span class="accordion-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                                <span class="accordion-icon-active">
                                     <?php \Elementor\Icons_Manager::render_icon( $settings['accordion_active_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                        </button>
                    </div>
                    <div id="collapse<?php echo $dataUnique;?>" class="accordion-collapse collapse <?php echo $show;?>" aria-labelledby="heading<?php echo $dataUnique;?>" data-bs-parent="#accordionExample<?php echo $unique;?>">
                        <div class="accordion-body">
                        <?php echo esc_attr ($description);?>
                        </div>
                    </div>
                </div>
            <?php    

            endif;
                endforeach; ?>                  
                  
            </div>            
        <?php
    }
} ?>