<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Button_Widget extends \Elementor\Widget_Base {

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
		return 'tp-button';
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
		return esc_html__( 'TP Button', 'tp-elements' );
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
		return 'glyph-icon flaticon-menu';
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
			'section_button',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
			]
		);

		$this->add_control(
			'button_style',
			[
				'label'   => esc_html__( 'Select Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'label_block' => true,
				'default' => 'primary_btn',
				'separator' => 'before',
				'options' => [					
					'primary_btn' => esc_html__( 'Primary Button', 'tp-elements'),
					'secondary_btn' => esc_html__( 'Secondary Button', 'tp-elements'),
					
				],
			]
		);
		
		$this->add_control(
			'btn_text',
			[
				'label'       => esc_html__( 'Button Text', 'tp-elements' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
				'default'     => 'Sample',
				'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label'       => esc_html__( ' Button Link', 'tp-elements' ),
				'type'        => Controls_Manager::URL,
				'label_block' => true,						
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
                    '{{WRAPPER}} .themephi-button' => 'text-align: {{VALUE}}',
                ]
            ]
        );

		$this->add_responsive_control(
			'button_hover_effect',
			[
				'label' => esc_html__( 'Button Hover Effect', 'tp-elements' ),
				'type' => Controls_Manager::SELECT,
                'default'   => 'no_shape',
				'options' => [
					'no_shape' => 'No Shape',
					'style1' => 'Shape 1',
					'upload' => 'Upload',
					'new_page' => 'New Page',
					'render' => 'Render',
					'reshape' => 'Reshape',
					'export_file' => 'Export File',
					'add' => 'Add',
					'swipe' => 'Swipe',
					'double_swipe' => 'Double Swipe',
					'smooth' => 'Smooth',
					'diagonal_close' => 'Diagonal Close',
					'collision' => 'Collision',
				],
                'prefix_class' => 'tp-button-',
			]
		);

		$this->add_control(
            'icon',
            [
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'type'  => Controls_Manager::HEADING,               
            ]
        );

		$this->add_control(
            'show_icon',
            [
				'label'        => esc_html__( 'Show Icon', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'yes',
            ]
        );

		$this->add_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'after',
				'options' => [
					'before'  => esc_html__( 'Before Content', 'tp-elements' ),
					'after' => esc_html__( 'After Content', 'tp-elements' ),
				],

				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_control(
			'btn_icon',
			[
				'label'     => esc_html__( 'Icon', 'tp-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'tp tp-arrow-left',					
				],
				'separator' => 'before',

				'condition' => [
					'show_icon' => 'yes',
				],				
			]
		);

			$this->add_control(
		    'btn_icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Left Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		      
		        'selectors' => [		
					'{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',	            
		        ],
		        'condition' => [
					'icon_position' => 'after',
				],	
		    ]
		);		

		$this->add_control(
		    'btn_icon_spacing_left',
		    [
		        'label' => esc_html__( 'Icon Right Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',	           
		        ],
		        'condition' => [
					'icon_position' => 'before',
				],	
		    ]
		);		

		$this->add_control(
		    'btn_icon_spacing_top',
		    [
		        'label' => esc_html__( 'Icon Top/Bottom Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'px' => [
					'min' => -100,
					'max' => 100,
					'step' => 1,
				],
				'default' => [					
					'size' => 0,
					
				],
		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button i' => 'top: {{SIZE}}px;',		 
					'{{WRAPPER}} .themephi-button a svg' => 'top: {{SIZE}}px;',	           
		        ],
		        'condition' => [
					'show_icon' => 'yes',
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
			'tp_button_width',
			[
				'label' => esc_html__( 'Width', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themephi_button' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .themephi-button a .themephi-button-text',
		        
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
		            '{{WRAPPER}} .themephi-button a .themephi-button-text' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_normal',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [
                    'image',
                ],
				'selector' => '{{WRAPPER}} .themephi-button a',
			]
		);

		$this->add_control(
		    'btn_before_bg_color_normal',
		    [
		        'label' => esc_html__( 'Before BG Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a::before' => 'background: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => [ 'reshape', ],
				]
		    ]
		);

		$this->add_control(
		    'btn_after_border_color_normal',
		    [
		        'label' => esc_html__( 'After Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a::after' => 'border-color: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => [ 'reshape', ],
				]
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .themephi-button a',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-button a',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_hover_typography',
		        'selector' => '{{WRAPPER}} .themephi-button a:hover .themephi-button-text',
		        
		    ]
		);

		$this->add_control(
		    'btn_text_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover .themephi-button-text' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => [
                    'image',
                ],
				'selector' => '{{WRAPPER}} .themephi-button a:hover',
			]
		);

		$this->add_control(
		    'btn_before_bg_color',
		    [
		        'label' => esc_html__( 'Before BG Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a::before' => 'background: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => ['style1', 'upload', 'new_page', 'render', 'export_file', 'add', 'swipe', 'smooth', 'collision'],
				]
		    ]
		);
		$this->add_control(
		    'btn_before_bg_color_hover',
		    [
		        'label' => esc_html__( 'Before BG Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover:before' => 'background: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => [ 'reshape', ],
				]
		    ]
		);

		$this->add_control(
		    'btn_after_bg_color',
		    [
		        'label' => esc_html__( 'After BG Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a::after' => 'background: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => ['style1', 'export_file', 'smooth', 'collision']
				]
		    ]
		);

		$this->add_responsive_control(
			'before_border_size',
			[
				'label' => esc_html__( 'Before Border Size', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a::before' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'button_hover_effect' => [ 'double_swipe', 'diagonal_close', ],
				]
			]
		);

		$this->add_control(
		    'btn_before_border_color',
		    [
		        'label' => esc_html__( 'Before Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a::before' => 'border-color: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => [ 'double_swipe', 'diagonal_close', ],
				]
		    ]
		);

		$this->add_responsive_control(
			'after_border_size',
			[
				'label' => esc_html__( 'After Border Size', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a::after' => 'border-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'button_hover_effect' => [ 'double_swipe', 'diagonal_close', ],
				]
			]
		);

		$this->add_control(
		    'btn_after_border_color_two',
		    [
		        'label' => esc_html__( 'Before Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a::after' => 'border-color: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => [ 'double_swipe', 'diagonal_close', ],
				]
		    ]
		);

		$this->add_control(
		    'btn_after_border_color_hover',
		    [
		        'label' => esc_html__( 'After Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover:after' => 'border-color: {{VALUE}};',
		        ],
				'condition' => [
					'button_hover_effect' => [ 'reshape', ],
				]
		    ]
		);
		$this->add_control(
		    'button_hover_border',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'button_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .themephi-button a:hover',
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
		            '{{WRAPPER}} .themephi-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
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
		            '{{WRAPPER}} .themephi-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    '_section_style_icon',
		    [
		        'label' => esc_html__( 'Icon', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
			'button_icon_size',
			[
				'label' => esc_html__( 'Size', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 6,
						'max' => 300,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .themephi-button a .themephi-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .themephi-button a .themephi-button-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
		    'icon_text_color',
		    [
		        'label' => esc_html__( 'Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a .themephi-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a .themephi-button-icon svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_hover_color',
		    [
		        'label' => esc_html__( 'Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,		      
		        'selectors' => [
		            '{{WRAPPER}} .themephi-button a:hover .themephi-button-icon i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a:hover .themephi-button-icon svg' => 'fill: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'icon_background',			[
				
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a .themephi-button-icon i' => 'background: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a .themephi-button-icon svg' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
		    'icon_hover_background',			[
				
				'label' => esc_html__( 'Hover Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .themephi-button a:hover .themephi-button-icon i'=> 'background: {{VALUE}};',
					'{{WRAPPER}} .themephi-button a:hover .themephi-button-icon svg'=> 'background: {{VALUE}};',
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
		            '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

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
		$this->add_inline_editing_attributes( 'btn_text', 'basic' );
        $this->add_render_attribute( 'btn_text', 'class', 'btn_text' );
	?>	
		
		<div class="themephi-button <?php echo esc_attr($settings['button_style']);?>">
			<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : '';?>
			<a class="themephi_button " href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php echo esc_attr($target);?>>
			
				<?php if(!empty($settings['btn_icon']) &&  ($settings['icon_position']=='before')) : ?>
					<span class="themephi-button-icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php endif; ?>
				<span class="themephi-button-text"><?php echo esc_html($settings['btn_text']);?></span>
				<?php if(!empty($settings['btn_icon']) &&  ($settings['icon_position']=='after')) : ?>
					<span class="themephi-button-icon">
					<?php \Elementor\Icons_Manager::render_icon( $settings['btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</span>
				<?php endif; ?>
			</a>
		</div>

	<?php 
	}
}