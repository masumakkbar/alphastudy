<?php
/**
 * Blockquote Widget
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Pro_Blockquote_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'tpblockquote';
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
        return esc_html__( 'TP Blockquote', 'tp-elements' );
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
        return 'glyph-icon flaticon-ballot-box';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'blockquote',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'blockquote_icon_show',
            [
                'label' => esc_html__( 'Show', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-elements' ),
                'label_off' => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
          
        $this->add_control(
            'tp_blockquote_icon',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::ICONS,
                'options' => tp_framework_get_icons(),
                'default' => [
                    'value' => 'fas fa-star',
                    'library' => 'fa-solid',
                ],
                'skin' => 'inline',
				'label_block' => false,
                'condition' => [
                    'blockquote_icon_show' => 'yes'
                ],
                'separator'   => 'after', 
            ]
        );                  

        $this->add_control(
            'block_content',
            [
                'label'       => esc_html__( 'Blockquote Content', 'tp-elements' ),
                'type'        => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'     => __( 'Blockquote Description Here', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'author_title',
            [
                'label'       => esc_html__( 'Author', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => false,                    
                'separator'   => 'before', 
            ]
        );         

        $this->end_controls_section();

        $this->start_controls_section(
            'blockquote_box_style',
            [
                'label' => esc_html__( 'Item', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );   

        $this->add_responsive_control(
			'blockquote_direction',
			[
				'label' => esc_html__( 'Flex Direction', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'column',
				'options' => [
                    'column' => [
						'title' => esc_html__( 'Column', 'tp-elements' ),
						'icon' => 'eicon-v-align-bottom',
					],
					'row' => [
						'title' => esc_html__( 'Row', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					]
				],	
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote' => 'flex-direction: {{VALUE}};',
                ],
			]
		);

        $this->add_responsive_control(
			'blockquote_align',
			[
				'label' => esc_html__( 'Align Items', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-text-align-right',
					]
				],
				'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote' => 'align-items: {{VALUE}};',
                ],
			]
		);

        $this->add_responsive_control(
			'blockquote_justify_content',
			[
				'label' => esc_html__( 'Justify content', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-text-align-center',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-text-align-right',
                    ],
					'space-between' => [
						'title' => esc_html__( 'Between', 'tp-elements' ),
						'icon' => 'eicon-text-align-justify',
					]
				],
				'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'blockquote_direction' => 'row'
                ]
			]
		);

        $this->add_responsive_control(
            'blockquote_box_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],               
            ]
        );

        $this->start_controls_tabs( 'blockquote_box_tabs' );

		$this->start_controls_tab(
            'blockquote_box_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'blockquote_box_bg',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient', 'image' ],
				'selector' => '{{WRAPPER}} .tp-blockquote blockquote',
			]
		);
        
        $this->add_control(
            'blockquote_box_before_color',
            [
                'label' => esc_html__( 'Before Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote::before' => 'background-color:{{VALUE}};',
                ],
               'condition' => [
                    'blockquote_box_position' => 'absolute'
                ]
            ]
        ); 

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'blockquote_box_border',
		        'selector' => '{{WRAPPER}} .tp-blockquote blockquote',
		    ]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
            'blockquote_box_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 
        
        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'blockquote_box_bg_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient', 'image' ],
				'selector' => '{{WRAPPER}} .tp-blockquote blockquote:hover',
			]
		);

        $this->add_control(
            'blockquote_box_before_color_hover',
            [
                'label' => esc_html__( 'Before Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover:before' => 'background-color:{{VALUE}};',
                ],
               'condition' => [
                    'blockquote_box_position' => 'absolute'
                ]
            ]
        ); 

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'blockquote_box_border_hover',
		        'selector' => '{{WRAPPER}} .tp-blockquote blockquote:hover',
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_control(
		    'blockquote_box_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-blockquote blockquote' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

        $this->add_control(
            'blockquote_box_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'prefix_class' => 'tp-blockquote-position-', 
                                               
            ]
        );

        $this->add_responsive_control(
            'blockquote_box_position_left',
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
                    'blockquote_box_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote::before' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_box_position_right',
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
                    'blockquote_box_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote::before' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_box_before_width',
            [
                'label' => esc_html__( 'Width', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-blockquote blockquote::before' => 'width: {{SIZE}}{{UNIT}};',
                ],    
                'condition' => [
                    'blockquote_box_position' => 'absolute'
                ]
            ]
        );   

        $this->add_responsive_control(
            'blockquote_box_before_height',
            [
                'label' => esc_html__( 'Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-blockquote blockquote::before' => 'height: {{SIZE}}{{UNIT}};',
                ],    
                'condition' => [
                    'blockquote_box_position' => 'absolute'
                ]
            ]
        );   

        $this->end_controls_section();

        $this->start_controls_section(
            'blockquote_content_style',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );   

        $this->add_responsive_control(
			'blockquote_text_align',
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
				],
				'default' => 'left',
				'selectors' => [
					'{{WRAPPER}} .tp-blockquote blockquote' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'blockquote_content_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'tp-elements' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blockquote_content_title_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .tp-blockquote blockquote',
                
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs( 'blockquote_title_tabs' );

		$this->start_controls_tab(
            'blockquote_title_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blockquote_title_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'blockquote_title_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 
        
        $this->add_control(
            'blockquote_title_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
           
        $this->add_control(
            'blockquote_desc_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blockquote_desc_pseudo',
            [
                'label'   => esc_html__( 'Pseudo Before', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'before' => 'Before',                             
                ],      
                'prefix_class' => 'tp-desc-before-',
                'separator' => 'before',                                
            ]
        );

        $this->add_responsive_control(
            'blockquote_before_width',
            [
                'label' => esc_html__( 'Width', 'tp-elements' ),
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
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote cite::before' => 'width: {{SIZE}}{{UNIT}};',
                ],    
                'condition' => [
                    'blockquote_desc_pseudo' => 'before'
                ]
            ]
        );   

        $this->add_responsive_control(
            'blockquote_before_height',
            [
                'label' => esc_html__( 'Height', 'tp-elements' ),
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
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote cite::before' => 'height: {{SIZE}}{{UNIT}};',
                ],    
                'condition' => [
                    'blockquote_desc_pseudo' => 'before'
                ]
            ]
        );   

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blockquote_desc_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .tp-blockquote blockquote cite',
                
            ]
        );   

        $this->start_controls_tabs( 'blockquote_desc_tabs' );

		$this->start_controls_tab(
            'blockquote_desc_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blockquote_desc_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote cite' => 'color:{{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'blockquote_desc_before_color',
            [
                'label' => esc_html__( 'Before Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote cite::before' => 'background-color:{{VALUE}};',
                ],
                'condition' => [
                    'blockquote_desc_pseudo' => 'before'
                ]
            ]
        ); 

        $this->add_control(
            'blockquote_desc_bg',
            [
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote cite' => 'background:{{VALUE}};',
                ],
            ]
        );   
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .tp-blockquote blockquote cite',
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'blockquote_desc_tab_hover',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blockquote_desc_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover cite' => 'color:{{VALUE}};',
                ],
            ]
        ); 
          
        $this->add_control(
            'blockquote_desc_before_color_hover',
            [
                'label' => esc_html__( 'Before Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover cite::before' => 'background-color:{{VALUE}};',
                ],
                'condition' => [
                    'blockquote_desc_pseudo' => 'before'
                ]
            ]
        ); 

        $this->add_control(
            'blockquote_desc_bg_hover',
            [
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover cite' => 'background:{{VALUE}};',
                ],
            ]
        ); 
        
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'item_border_hover',
                'selector' => '{{WRAPPER}} .tp-blockquote blockquote:hover cite',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
		    'blockquote_desc_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [ 
                    '{{WRAPPER}} .tp-blockquote blockquote cite' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
		        ],
                
		    ]
		);

        $this->add_responsive_control(
            'description_gap',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .tp-blockquote blockquote cite' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'description_gap_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote cite' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        
        $this->start_controls_section(
            'blockquote_icon_style',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blockquote_icon_show' => 'yes'
                ] 
            ]
        );    

        $this->add_responsive_control(
            'blockquote_icon_size',
            [
                'label' => esc_html__( 'Font Size', 'tp-elements' ),
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
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],    
                      
            ]
        );   

        $this->add_responsive_control(
            'blockquote_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],      
                'separator' => 'after',   
                      
            ]
        ); 

		$this->start_controls_tabs( 'blockquote_icon_tabs' );

		$this->start_controls_tab(
            'blockquote_icon_normal',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blockquote_icon_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon svg' => 'fill: {{VALUE}};',
                ],
                
            ]
        );         

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'blockquote_bg',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon',
                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'blockquote_icon_border',
				'selector' => '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon',
                
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
            'blockquote_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blockquote_icon_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon svg' => 'fill: {{VALUE}};',
                ],
                
            ]
        );         

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'blockquote_bg_hover',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon',
                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'blockquote_icon_border_hover',
				'selector' => '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon',
                
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
		    'blockquote_icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [ 
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
		        ],
                
		    ]
		);

        $this->add_control(
            'blockquote_icon_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'position: {{VALUE}};',
                ],   
                                               
            ]
        );

        $this->add_responsive_control(
			'blockquote_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'blockquote_icon_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'blockquote_icon_position_top',
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
                    'blockquote_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_icon_position_bottom',
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
                    'blockquote_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_icon_position_left',
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
                    'blockquote_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blockquote_icon_position_right',
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
                    'blockquote_icon_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote .tp-blockquote-icon' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


    }
  
    protected function render() {
        $settings = $this->get_settings_for_display();       
       
        // $bicon = !empty($settings['tp_blockquote_icon']) ? '<i class="'.$settings['tp_blockquote_icon'].'"></i>' : '';       
    
    ?>
    <div class="tp-blockquote">
       <blockquote>

        <?php if(!empty($settings['tp_blockquote_icon'])) : ?>
            <span class="tp-blockquote-icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['tp_blockquote_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </span>
        <?php endif; ?>
        <?php  echo wp_kses_post($settings['block_content']);?>

        <?php if(!empty($settings['author_title'])): ?>
            <cite><?php echo esc_html($settings['author_title']); ?></cite>
        <?php endif; ?>
        
       </blockquote>       
    </div>
    <?php
    }
}
