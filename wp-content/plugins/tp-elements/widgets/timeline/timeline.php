<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Themephi_Timeline_Showcase_Widget extends \Elementor\Widget_Base {
    /**
     * Get widget name.
     *
     * Retrieve logo widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'tp-timeline';
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
        return esc_html__( 'TP Timeline', 'tp-elements' );
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
        return 'eicon-gallery-grid';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'timeline', 'time', 'company', 'history'];
    }

    protected function _register_controls() {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__( 'Timeline Item', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
            'timeline_style',
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
            'image',
            [
                'label' => esc_html__('Image', 'tp-elements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'icon',
            [
                'label'       => esc_html__( 'Icon', 'tp-elements' ),
                'type'        => Controls_Manager::ICONS,
                'label_block' => true,                
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'badge',
            [
                'label'       => esc_html__( 'Badge', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Badge',
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'year',
            [
                'label'       => esc_html__( 'Date', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Released on Jul 22, 2025',
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => esc_html__( 'Title', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Title',
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label'       => esc_html__( 'Text', 'tp-elements' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'     => 'Text',
                'separator'   => 'before',
            ]
        );

		$repeater->add_control(
			'enable_btn',
			[
				'label' => esc_html__( 'Enable Button', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'tp-elements' ),
                'separator'   => 'before',
                'condition' => [
                    'enable_btn' => 'yes'
                ],
            ]
        );
        
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'tp-elements'),
                'type' => Controls_Manager::URL, 
                'condition' => [
                    'enable_btn' => 'yes'
                ],               
            ]
        ); 


        $this->add_control(
            'items_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );  

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

		$this->add_control(
			'show_image_in_left',
			[
				'label' => esc_html__( 'Show Image In Left', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Left', 'tp-elements' ),
				'label_off' => esc_html__( 'Right', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'content__alignment',
			[
				'label' => esc_html__( 'Content Alignment', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::CHOOSE,
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-align-start-v',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'tp-elements' ),
						'icon' => 'eicon-align-end-v',
					],
				],
				'default' => 'start',
				'toggle' => true,
			]
		);


        $this->end_controls_section();

        $this->start_controls_section(
            'timeline_section_item',
            [
                'label' => esc_html__( 'Item', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'timeline_item_position',
			[
				'label' => esc_html__( 'Align Items', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .timeline' => 'align-items: {{VALUE}};',
                ]
			]
		);

		$this->add_control(
            'timeline_item_background',
            [
                'label' => esc_html__( 'Background Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline' => 'background-color: {{VALUE}};',                      
                ],
            ]
        );

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'timeline_item_box_shadow',
		        'label' => esc_html__( 'Shadow', 'tp-elements' ),
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .timeline',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'timeline_item_border',
		        'selector' => '{{WRAPPER}} .timeline',
		    ]
		);

        $this->add_responsive_control(
            'timeline_item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .timeline' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
		    'timeline_item_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		
		$this->add_responsive_control(
			'timeline_spacing',
			[
				'label' => esc_html__( 'Padding Last Child', 'elementor' ),
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
					'{{WRAPPER}} .timeline:last-child' => 'padding-bottom: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'timeline_style' => 'style2'
				]
			]
		);
        
		$this->add_responsive_control(
		    'timeline_item_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'before_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Before', 'tp-elements' ),
		        'separator' => 'before',
				'condition' => [
					'timeline_style' => 'style2'
				]
		    ]
		);

		$this->add_control(
            'timeline_before_position',
            [
                'label'   => esc_html__( 'Before Line', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',               
                'options' => [                    
                    'none' => 'None',
                    'block' => 'Show',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .timeline::before' => 'display: {{VALUE}};',
                ],   
				'condition' => [
					'timeline_style' => 'style2'
				]
                                               
            ]
        );
		$this->add_responsive_control(
			'timeline_before_left',
			[
				'label' => esc_html__( 'Left', 'elementor' ),
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
					'{{WRAPPER}} .timeline::before' => 'left: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'timeline_style' => 'style2',
					'timeline_before_position' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'timeline_before_width',
			[
				'label' => esc_html__( 'Width', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
					'vw' => [
						'max' => 50,
						'step' => 0.1,
					],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
				],
				'size_units' => [ 'px', 'vw', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .timeline::before' => 'width: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'timeline_style' => 'style2',
					'timeline_before_position' => 'block'
				]
			]
		);
		$this->add_responsive_control(
			'timeline_before_height',
			[
				'label' => esc_html__( 'Height', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
					'vw' => [
						'max' => 50,
						'step' => 0.1,
					],
					'%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
				],
				'size_units' => [ 'px', 'vw', '%', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .timeline::before' => 'height: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'timeline_style' => 'style2',
					'timeline_before_position' => 'block'
				]
			]
		);

        $this->add_control(
            'timeline_before_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline::before' => 'background-color:{{VALUE}};',
				],
				'condition' => [
					'timeline_style' => 'style2',
					'timeline_before_position' => 'block'
				]
            ]
        ); 

        $this->end_controls_section();

        $this->start_controls_section(
			'section_style_icon',
			[
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
		    'timeline_icon_direction',
		    [
		        'label' => esc_html__( 'Direction', 'tp-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => [
		        	'vertical' => esc_html__( 'Vertical', 'tp-elements'),
		        	'horizontal' => esc_html__( 'Horizontal', 'tp-elements'),		

		        ],
		        'default' => 'horizontal',
				'prefix_class' => 'timeline-item-left-direction-',
		    ]
		);

        $this->add_responsive_control(
			'timeline_icon_position',
			[
				'label' => esc_html__( 'Align Items', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .timeline .item-left' => 'align-items: {{VALUE}};',
                ],
				'condition' => [
					'timeline_icon_direction' => 'horizontal'
				]
			]
		);
        
		$this->add_responsive_control(
			'timeline_icon_size',
			[
				'label' => esc_html__( 'Size', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .timeline .item .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .timeline .item .icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->start_controls_tabs( 'icon_items' );

		$this->start_controls_tab(
			'timeline_icon_normal',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);

		$this->add_control(
			'timeline_icon_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline .item .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .timeline .item .icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_icon_background',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .timeline .item .icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_icon_shadow',
				'selector' => '{{WRAPPER}} .timeline .item .icon',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_icon_border',
				'selector' => '{{WRAPPER}} .timeline .item .icon',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'timeline_icon_hover',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
			'timeline_icon_color_hover',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'default' => '',
				'selectors' => [
					'{{WRAPPER}} .timeline .item:hover .icon' => 'color: {{VALUE}};',
					'{{WRAPPER}} .timeline .item:hover .icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'timeline_icon_background_hover',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .timeline .item:hover .icon' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_icon_boxShadow_hover',
				'selector' => '{{WRAPPER}} .timeline .item:hover .icon',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_icon_border_hover',
				'selector' => '{{WRAPPER}} .timeline .item:hover .icon',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'timeline_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .timeline .item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
		    'timeline_icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        $this->add_responsive_control(
		    'timeline_icon_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();
		
        $this->start_controls_section(
			'_section_style_badge',
		    [
				'label' => esc_html__( 'Badge', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'timeline_style' => 'style2'
				]
			]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'badge_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}}  .timeline .item .item-badge',
		        
		    ]
		);

		$this->start_controls_tabs( 'badge_items' );

		$this->start_controls_tab(
			'timeline_badge_normal',
			[
				'label' => esc_html__( 'Normal', 'tp-elements' ),
			]
		);

		$this->add_control(
		    '_badge_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		             '{{WRAPPER}} .timeline .item .item-badge' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
			'timeline_badge_background',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .timeline .item .item-badge' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_badge_shadow',
				'selector' => '{{WRAPPER}} .timeline .item .item-badge',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'timeline_badge_border',
				'selector' => '{{WRAPPER}} .timeline .item .item-badge',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'timeline_badge_hover',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
		    '_badge_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [

		        	'{{WRAPPER}} .timeline .item:hover .item-badge' => 'color: {{VALUE}}',
					
		        ],
		    ]
		);

		$this->add_control(
			'timeline_badge_background_hover',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .timeline .item:hover .item-badge' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'timeline_badge_boxShadow_hover',
				'selector' => '{{WRAPPER}} .timeline .item:hover .item-badge',
			]
		);

		$this->add_control(
		    'timeline_badge_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item:hover .item-badge' => 'border-color: {{VALUE}};'
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->add_responsive_control(
			'timeline_badge_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .timeline .item .item-badge' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
		    'timeline_badge_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .item-badge' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    '_badge_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .item-badge' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();


        $this->start_controls_section(
			'_section_style_content',
		    [
			'label' => esc_html__( 'Content', 'tp-elements' ),
			'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
		    'content_padding',
		    [
		        'label' => esc_html__( 'Content Box Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .item-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'content_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		             '{{WRAPPER}} .tps-company-storyhear .timeline .item .item-wrap' => 'background-color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'content_border',
		        'selector' => '{{WRAPPER}} .timeline .item .item-wrap',
		    ]
		);

		$this->add_responsive_control(
		    'content_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .item-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);		

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'content_box_shadow',
		        'exclude' => [
		            'box_shadow_position',
		        ],
		        'selector' => '{{WRAPPER}} .timeline .item .item-wrap'
		    ]
		);

        $this->add_control(
		    'timeline_before_title',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Before', 'tp-elements' ),
		        'separator' => 'before',
				'condition' => [
					'timeline_style' => 'style1'
				]
		    ]
		);

        $this->add_responsive_control(
			'timeline_before_border',
			[
				'label' => esc_html__( 'Border Width', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .timeline ul li div::before' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};;',
				],
				'condition' => [
					'timeline_style' => 'style1'
				]
			]
		);

        $this->add_responsive_control(
		    'timeline_before_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline ul li div::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
				'condition' => [
					'timeline_style' => 'style1'
				]
		    ]
		);	

        $this->add_control(
            'timeline_before_color',
            [
                'label' => esc_html__( 'Before Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .timeline ul li div::before' => 'border-color:{{VALUE}};',
				],
				'condition' => [
					'timeline_style' => 'style1'
				]
            ]
        ); 

        $this->add_control(
		    'timeline_time_title',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Time', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'time_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}}  .timeline .item .time',
		        
		    ]
		);

		$this->add_control(
		    'time_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		             '{{WRAPPER}} .timeline .item .time,
					  {{WRAPPER}}  .timeline .item .time a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'time_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [

		        	'{{WRAPPER}} .timeline .item:hover .time ,
		            {{WRAPPER}}   .timeline .item:hover .time a' => 'color: {{VALUE}}',
					
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'time_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .time' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'timeline_heading_title',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'title_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}}  .timeline .item .title',
		        
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		             '{{WRAPPER}} .timeline .item .title,
					  {{WRAPPER}}  .timeline .item .title a' => 'color: {{VALUE}}',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		        	'{{WRAPPER}} .timeline .item:hover .title,
		            {{WRAPPER}}  .timeline .item:hover .title a' => 'color: {{VALUE}}',
					
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'title_spacing',
		    [
		        'label' => esc_html__( 'Bottom Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'timeline_desc_title',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Description', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'description_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}} .timeline .item p',
		        
		    ]
		);
		
		$this->add_control(
		    'description_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item p' => 'color: {{VALUE}}',
		            
		        ],
		    ]
		);

		$this->add_control(
		    'description_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item:hover p' => 'color: {{VALUE}}',
		        ],
		    ]
		);

        $this->add_responsive_control(
            'description_spacing',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .timeline .item p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'btn_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->add_responsive_control(
		    'btn_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .timeline .item .btn',
		        
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_tab_button_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'btn_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .timeline .item .btn',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .timeline .item .btn',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'button_hover_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn:hover' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'button_hover_border_color',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .timeline .item .btn:hover',
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .timeline .item .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
		$this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( empty($settings['items_list'] ) ) {
            return;
        }
        $img_left = $settings['show_image_in_left'];
        $c_alignment = $settings['content__alignment'];

        $order2 = $img_left == 'yes' ? ' order-2' : '';
        $align_items = !empty($c_alignment) ? ' align-items-'.$c_alignment : '';

        ?>
			<?php  if( $settings['timeline_style'] == 'style1'): ?> 
            <div class="tps-company-storyhear"> 
              

                    <section class="timeline">
                    <ul>
                    <?php foreach ( $settings['items_list'] as $index => $item ) :
                        $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );
                        
                        

                        $year   = !empty($item['year']) ? $item['year'] : '';                         
                        $title   = !empty($item['title']) ? $item['title'] : '';                         
                        $text   = !empty($item['text']) ? $item['text'] : '';                         

                        ?>
                        <li class="item">
                            <div class="item-wrap">
                                <section>
                                    <?php if(!empty($image)) : ?>
                                        <img src="<?php echo esc_url( $image ); ?>" alt="image">
                                    <?php endif ; ?>
                                    <?php if(!empty($item['icon'])) : ?>
                                        <span class="icon">
							                <?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                        </span>
						            <?php endif; ?>
                                    <span class="time"><?php echo esc_html($year);?></span>
                                    <h6 class="title"><?php echo esc_html($title);?></h6>
                                    <p><?php echo esc_html($text);?></p>
                                </section>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </section>
            </div>
			<?php else : ?>
				<div class="timeline-two">
					<?php foreach ( $settings['items_list'] as $index => $item ) :
                        $image = wp_get_attachment_image_url( $item['image']['id'], $settings['thumbnail_size'] );

                        $badge   = !empty($item['badge']) ? $item['badge'] : '';                         
                        $year   = !empty($item['year']) ? $item['year'] : '';                         
                        $title   = !empty($item['title']) ? $item['title'] : '';                         
                        $text   = !empty($item['text']) ? $item['text'] : '';

                        $btn_text   = !empty($item['btn_text']) ? $item['btn_text'] : '';

						$btn_link = !empty($item['link']['url']) ? $item['link']['url'] : '';
                    ?>
					<div class="timeline">
						<div class="item item-left">
							<?php if(!empty($item['icon'])) : ?>
								<span class="icon">
									<?php \Elementor\Icons_Manager::render_icon( $item['icon'], [ 'aria-hidden' => 'true' ] ); ?>
								</span>
							<?php endif; ?>
							<div class="item-info">
								<span class="item-badge"><?php echo esc_html($badge);?></span>
								<span class="time"><?php echo esc_html($year);?></span>
							</div>
						</div>
						<div class="item item-right">
							<div class="content">
								<h3 class="title"><?php echo esc_html($title);?></h3>
								<p class="text"><?php echo esc_html($text);?></p>
								<?php if(!empty($btn_text)) : ?>
								<a href="<?php echo esc_url($btn_link);?>" class="btn">
									<?php echo esc_html($btn_text);?>
								</a>
								<?php endif ; ?>

								<?php if(!empty($image)) : ?>
								<div class="image">
									<img src="<?php echo esc_url( $image ); ?>" alt="image">
								</div>
                                <?php endif ; ?>
							</div>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
            <script>
                var items = document.querySelectorAll(".timeline li");          
            
                function isElementInViewport(el) {
                    var rect = el.getBoundingClientRect();
                    return (
                    rect.top >= 0 &&
                    rect.left >= 0 &&
                    rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
                    rect.right <= (window.innerWidth || document.documentElement.clientWidth)
                    );
                }
                
                function callbackFunc() {
                    for (var i = 0; i < items.length; i++) {
                    if (isElementInViewport(items[i])) {
                        items[i].classList.add("in-view");
                    }
                    }
                }
                
                // listen for events
                window.addEventListener("load", callbackFunc);
                window.addEventListener("resize", callbackFunc);
                window.addEventListener("scroll", callbackFunc);
            </script>
           
        <?php

    }
}