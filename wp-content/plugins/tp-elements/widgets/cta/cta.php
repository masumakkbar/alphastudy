<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_CTA_Widget extends \Elementor\Widget_Base {

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
		return 'tp-cta';
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
		return esc_html__( 'TP CTA', 'tp-elements' );
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
		return 'glyph-icon flaticon-error';
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
		return [ 'button' ];
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
			'section_cta',
			[
				'label' => esc_html__( 'CTA Content', 'tp-elements' ),
			]
		);				

		$this->add_control(
            'content',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__( 'CTA Title', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Default Call To Action', 'tp-elements'),
				'placeholder' => esc_html__( 'Title', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'cta_link',
			[
				'label' => esc_html__( 'Link', 'tp-elements' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,						
			]
		);
		
		$this->add_control(
			'cta_desc',
			[
				'label' => esc_html__( 'CTA Description', 'tp-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default' => esc_html__('With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'tp-elements'),
				'placeholder' => esc_html__( 'Description', 'tp-elements' ),
				'separator' => 'before',
			]
		);


		$this->add_control(
            'button',
            [
                'label' => esc_html__( 'Button', 'tp-elements' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('View More', 'tp-elements'),
				'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( ' Button Link', 'tp-elements' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,						
			]
		);

		$this->add_control(
            'show_icon',
            [
                'label' => esc_html__( 'Show Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-elements' ),
                'label_off' => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
		$this->add_control(
			'btn_icon',
			[
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICON,
				'options' => tp_framework_get_icons(),				
				'default' => 'fa fa-angle-right',
				'separator' => 'before',

				'condition' => [
					'show_icon' => 'yes',
				],				
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_cta',
		    [
		        'label' => esc_html__( 'CTA', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
			'cta_full_width',
			[
		        'label' => esc_html__( 'Full Width ', 'tp-elements' ),
		        'type'    => Controls_Manager::SELECT,
		        'default' => 'inline-flex',
		        'options' => [
		            'inline-block' => esc_html__( 'Enable', 'tp-elements' ),
                    'inline-flex' => esc_html__( 'Disable', 'tp-elements' ),
		        ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta' => 'display: {{VALUE}};',
                ],
		    ]
		);

		$this->add_responsive_control(
            'cta_top_position',
            [
                'label' => esc_html__( 'Align Items', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
		        'default' => '',
		        'options' => [
		            'center' => esc_html__( 'Center', 'tp-elements' ),
                    'start' => esc_html__( 'Start', 'tp-elements' ),
                    'baseline' => esc_html__( 'Baseline', 'tp-elements' ),
                    'unset' => esc_html__( 'Unset
                    	', 'tp-elements' ),
		        ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_cta' );

		$this->start_controls_tab(
            'cta_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

		$this->add_responsive_control(
            'cta_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_border',
                'selector' => '{{WRAPPER}} .tp-cta',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_box_shadow',
                'selector' => '{{WRAPPER}} .tp-cta',
            ]
        ); 

        $this->add_responsive_control(
            'cta_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'cta_bg_color',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-cta',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'cta_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_responsive_control(
            'cta_hover_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'cta_hover_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'cta_hover_border',
                'selector' => '{{WRAPPER}} .tp-cta:hover',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'cta_hover_box_shadow',
                'selector' => '{{WRAPPER}} .tp-cta:hover',
            ]
        ); 

        $this->add_responsive_control(
            'cta_hover_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'cta_hover_bg_color',
				'label' => esc_html__( 'Hover Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-cta:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
		    '_section_style_content',
		    [
		        'label' => esc_html__( 'Content', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'content_width',
		    [
		        'label' => esc_html__( 'Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta .cta-content' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
            'content_position',
            [
                'label' => esc_html__( 'Position', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
				'default' => '-1',
                'options' => [
                    '-1' => esc_html__( 'Left', 'tp-elements'),
					'15' => esc_html__( 'Right', 'tp-elements'),
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-cta .cta-content' => 'order: {{VALUE}};'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'content_align',
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
                    '{{WRAPPER}} .tp-cta .cta-content' => 'text-align: {{VALUE}}'
                ]
            ]
        );

		$this->add_responsive_control(
            'content_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta .cta-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta .cta-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'content_border',
                'selector' => '{{WRAPPER}} .tp-cta .cta-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'content_box_shadow',
                'selector' => '{{WRAPPER}} .tp-cta .cta-content',
            ]
        ); 

        $this->add_responsive_control(
            'content_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta .cta-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );        

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'content_bg_color',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-cta .cta-content',
			]
		);

        
        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'content_hover_bg_color',
				'label' => esc_html__( 'Background Hover Color', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-cta:hover .cta-content',
			]
		);

		$this->add_control(
            'title_style',
            [
                'label' => esc_html__( 'Title Style', 'tp-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => esc_html__( 'Title HTML Tag', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'tp-elements' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'tp-elements' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'tp-elements' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'tp-elements' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'tp-elements' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'tp-elements' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h3',
                'toggle' => false,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}}  .cta-title .title',
                
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
		    'title_gap',
		    [
		        'label' => esc_html__( 'Title Gap', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .cta-title .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .cta-title .title' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'title_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta:hover .cta-title .title' => 'color: {{VALUE}};',
		        ],
		    ]
		);
		
		$this->add_control(
            'desc_style',
            [
                'label' => esc_html__( 'Description Style', 'tp-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'desc_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}}  .cta-text .desc',
                
                'separator'   => 'before',
            ]
        );

        $this->add_responsive_control(
		    'desc_gap',
		    [
		        'label' => esc_html__( 'Description Gap', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .cta-text .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
		    'desc_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .cta-text .desc' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'desc_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta:hover .cta-text .desc' => 'color: {{VALUE}};',
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

		$this->add_control(
            'btn_style',
            [
                'label' => esc_html__( 'Button Style', 'tp-elements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
		    'btn_width',
		    [
		        'label' => esc_html__( 'Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta .tp-cta-button' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
            'btn_position',
            [
                'label' => esc_html__( 'Position', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
				'default' => '14',
                'options' => [
                    '-2' => esc_html__( 'Left', 'tp-elements'),
					'14' => esc_html__( 'Right', 'tp-elements'),
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-cta .tp-cta-button' => 'order: {{VALUE}};'
                ],
				'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'btn_align',
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
                    '{{WRAPPER}} .tp-cta .tp-cta-button' => 'text-align: {{VALUE}}'
                ]
            ]
        );

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-cta-button a',
			]
		);

		$this->add_control(
            'btn_opacity',
            [
                'label' => esc_html__( 'Opacity', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta-button a' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->add_responsive_control(
		    'link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'link_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .tp-cta-button a',
		        
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .tp-cta-button a',
		    ]
		);

		$this->add_control(
		    'button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-cta-button a',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

		$this->add_control(
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta:hover .tp-cta-button a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-cta:hover .tp-cta-button a',
			]
		);

		$this->add_control(
            'btn_hover_opacity',
            [
                'label' => esc_html__( 'Opacity', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'max' => 1,
                        'min' => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-cta-button:hover a' => 'opacity: {{SIZE}};',
                ],
            ]
        );

		$this->add_responsive_control(
		    'link_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta:hover .tp-cta-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'link_hover_margin',
		    [
                'label'      => esc_html__( 'Margin', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta:hover .tp-cta-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
                'name'     => 'btn_hover_typography',
                'selector' => '{{WRAPPER}} .tp-cta:hover .tp-cta-button a',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
                'name'     => 'button_hover_border',
                'selector' => '{{WRAPPER}} .tp-cta:hover .tp-cta-button a',
		    ]
		);

		$this->add_control(
		    'button_hover_border_radius',
		    [
                'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta:hover .tp-cta-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .tp-cta:hover .tp-cta-button a',
		    ]
		);

		$this->add_control(
            'hover_animation',
            [
                'label' => esc_html__( 'Hover Animation', 'tp-elements' ),
                'type' => Controls_Manager::HOVER_ANIMATION,
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_control(
            'btn_icon_style',
            [
                'label'     => esc_html__( 'Button Icon', 'tp-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_icon' => 'yes'
                ],
            ]
        );

		$this->start_controls_tabs( '_tabs_button_icon' );

		$this->start_controls_tab(
            'btn_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
                'condition' => [
                    'show_icon' => 'yes'
                ],
            ]
        ); 

		$this->add_control(
		    'btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);


		$this->add_control(
		    'icon_text_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a i' => 'color: {{VALUE}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_background',
		    [
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .tp-cta-button a i' => 'background: {{VALUE}};',],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
			]
		);

		$this->add_responsive_control(
		    'icon_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'btn_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
                'condition' => [
                    'show_icon' => 'yes'
                ],
            ]
        ); 

		$this->add_control(
		    'btn_icon_hover_spacing',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		        'condition' => [
					'show_icon' => 'yes',
				],	
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button:hover a i' => 'color: {{VALUE}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_hover_background',
		    [				
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => ['{{WRAPPER}} .tp-cta-button:hover a i'=> 'background: {{VALUE}};',],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
			]
		);

		$this->add_responsive_control(
		    'icon_hover_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button:hover a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
	            ],
		    ]
		);

		$this->add_control(
		    'icon_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-cta-button:hover a i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
	            'condition' => [
	                'show_icon' => 'yes'
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

            $this->add_inline_editing_attributes( 'cta_title', 'basic' );
            $this->add_render_attribute( 'cta_title', 'class', 'title' );

            $this->add_inline_editing_attributes( 'cta_desc', 'basic' );
            $this->add_render_attribute( 'cta_desc', 'class', 'desc' ); 

            $this->add_inline_editing_attributes( 'btn_text', 'basic' );
            $this->add_render_attribute( 'btn_text', 'class', 'btn_text' ); 
        ?>
		<div class="tp-cta">
			<div class="cta-content">
				<?php if(!empty($settings['cta_title'])):?>
			        <div class="cta-title">
			        	<?php $target = $settings['cta_link']['is_external'] ? 'target=_blank' : '';?>

			            <<?php echo esc_attr($settings['title_tag']);?> class="title"> 
			            	<a href="<?php echo esc_url($settings['cta_link']['url']);?>" <?php echo esc_attr($target);?>>				
			            		<?php echo esc_attr ($settings['cta_title']);?>
			            	</a>

			            </<?php echo esc_attr($settings['title_tag']);?>>

			        </div>
				<?php endif;?>
				<?php if(!empty($settings['cta_desc'])):?>
			        <div class="cta-text">
			            <p class="desc"> <?php echo wp_kses_post ($settings['cta_desc']);?></p>
			        </div>
				<?php endif;?>
			</div>

            <?php if(!empty($settings['btn_text'])): ?>
			
    			<div class="tp-cta-button">

    				<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : '';?>

    				<a class="readon themephi_button elementor-animation-<?php echo esc_html($settings['hover_animation']);?>" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php echo esc_attr($target);?>>				
    					<span class="btn_text"><?php echo esc_html($settings['btn_text']);?></span>

    					<?php if(!empty($settings['btn_icon'])) : ?>
    						<i class="fa <?php echo esc_html($settings['btn_icon']);?>"></i>
    					<?php endif; ?>
    				</a>

    			</div>
            <?php endif; ?>    

		</div>   
	<?php 
	}
}