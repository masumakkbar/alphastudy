<?php
/**
 * Elementor TP Contact Box Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Pro_Contactbox_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'tp-contact-box';
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
		return esc_html__( 'TP Contact Box', 'tp-elements' );
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
		return 'glyph-icon flaticon-membership';
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
        return [ 'tpaddon_category' ];
    }
	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
		protected function register_controls() {


		$this->start_controls_section(
			'rs_section_contact_box',
			[
				'label' => esc_html__( 'Contact Box', 'tp-elements' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'type_contact_box',
			[
				'label'   => esc_html__( 'Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'text_box',
				'dynamic' => [
					'active' => true,
				],
				'options' => [					
					'text_box' => esc_html__( 'Address', 'tp-elements'),
					'email' => esc_html__( 'Email', 'tp-elements'),
					'phone' => esc_html__( 'Phone', 'tp-elements'),
				],
			]
		);

		$repeater->add_control(
			'contact_label',
			[
				'label' => esc_html__( 'label', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_content',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'Address', 'tp-elements' ),
				'show_label' => false,

				'condition' => [
		            'type_contact_box' => 'text_box'
		        ],
			]
		);


		$repeater->add_control(
			'contact_label_email',
			[
				'label' => esc_html__( 'Email', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
		            'type_contact_box' => 'email'
		        ],
			]
		);

		$repeater->add_control(
			'contact_label_phone',
			[
				'label' => esc_html__( 'Phone', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'label_block' => true,
				'condition' => [
		            'type_contact_box' => 'phone'
		        ],
			]
		);


		$repeater->add_control(
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

		$repeater->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'tp-elements' ),
				'type'      => Controls_Manager::ICONS,
				'options'   => tp_framework_get_icons(),				
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon',
				],				
			]
		);

		$repeater->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
				],
				'separator' => 'before',
			]
		);		
		

		$this->add_control(
			'tabs',
			[
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'contact_label' => esc_html__( 'Email:', 'tp-elements' ),
						'tab_content' => esc_html__( '(+088)589-8745', 'tp-elements' ),
						'selected_icon' => 'fa fa-home',
					],
					[
						'contact_label' => esc_html__( 'Phone:', 'tp-elements' ),
						'tab_content' => esc_html__( 'support@softivus.com', 'tp-elements' ),
						'selected_icon' => 'fa fa-phone',
					],
					[
						'contact_label' => esc_html__( 'Address:', 'tp-elements' ),
						'tab_content' => esc_html__( 'New Jesrsy, 1201, USA', 'tp-elements' ),
						'selected_icon' => 'fa fa-map-marker',
					],
				],
				'title_field' => '{{{ contact_label }}}',
			]
		);

		$this->add_control(
		    'rs_contact_box_style',
		    [
		        'label' => esc_html__( 'Contact Box Style', 'tp-elements' ),
		        'type' => Controls_Manager::SELECT,
				'label_block' => true,
		        'options' => [
		        	'vertical' => esc_html__( 'Vertical', 'tp-elements'),
		        	'horizontal' => esc_html__( 'Horizontal', 'tp-elements'),		

		        ],
		        'default' => 'horizontal',
				'prefix_class' => 'tp-contact-direction-',
		    ]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'contact_box_item',
			[
				'label' => esc_html__( 'Item', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
			'contact_box_item_position',
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
                    '{{WRAPPER}} .address-item' => 'align-items: {{VALUE}};',
                ],
			]
		);
		$this->add_responsive_control(
            'service_text_text_align',
            [
                'label' => esc_html__( 'Text Align', 'tp-elements' ),
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
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .address-item .address-text' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
			'service_box_item_spacing',
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
					'{{WRAPPER}} .address-item' => 'gap: {{SIZE}}{{UNIT}}',
				]
			]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'service_item_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .address-item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_box_border',
				'selector' => '{{WRAPPER}} .address-item ',
			]
		);

		$this->add_responsive_control(
			'service_box_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .address-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'service_box_item_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .address-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

		$this->add_responsive_control(
		    'service_box_item_margin',
		    [
		        'label' => esc_html__( 'Margin Bottom', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => ['px'],
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item' => 'margin-bottom: {{SIZE}}{{UNIT}} !important;',
		        ],
		    ]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    'rs_contact_icons',
		    [
		        'label' => esc_html__( 'Icon', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'icon_size',
		    [
		        'label' => esc_html__( 'Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
					'{{WRAPPER}} .address-item .address-icon' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .address-item .address-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

		// $this->add_control(
		//     'icon_hover_bg_color',
		//     [
		//         'label' => esc_html__( 'Background Effect Color', 'tp-elements' ),
		//         'type' => Controls_Manager::COLOR,
		//         'selectors' => [
		//             '{{WRAPPER}} .rs-contact-box .address-item .address-icon:before' => 'background-color: {{VALUE}} !important',
		//             '{{WRAPPER}} .rs-contact-box .address-item .address-icon:after' => 'background-color: {{VALUE}} !important',
		//         ],
		//     ]
		// );

		$this->start_controls_tabs( 'service_icon_tabs' );

		$this->start_controls_tab(
            'service_item_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'service_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .address-item .address-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .address-item .address-icon svg' => 'fill: {{VALUE}};',
                ],              
            ]
        );

		$this->add_control(
			'service_icon_background',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,	
				'selectors' => [
					'{{WRAPPER}} .address-item .address-icon' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_icon_shadow',
				'selector' => '{{WRAPPER}} .address-item .address-icon',
			]
		);
        
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_icon_border',
				'selector' => '{{WRAPPER}} .address-item .address-icon',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'service_icon_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_control(
            'service_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .address-item .address-icon:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .address-item .address-icon:hover svg' => 'fill: {{VALUE}};',
                ],              
            ]
        );

		$this->add_control(
			'service_icon_background_hover',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .address-item .address-icon:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'service_icon_shadow_hover',
				'selector' => '{{WRAPPER}} .address-item .address-icon:hover',
			]
		);
        
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'service_icon_border_hover',
				'selector' => '{{WRAPPER}} .address-item .address-icon:hover',
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'service_icon_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .address-item .address-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
            'service_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
                'selectors' => [
                    '{{WRAPPER}}  .address-item .address-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_title_style',
		    [
		        'label' => esc_html__( 'Label', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
            'label_display',
            [
                'label'   => esc_html__( 'Display', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'inline-block',               
                'options' => [                    
                    'inline-block' => 'Inline Block',
                    'block' => 'Block',                             
                ],      
                'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'display: {{VALUE}}',
		        ],
                                               
            ]
        );

		$this->add_control(
		    'label_color',
		    [
		        'label' => esc_html__( 'Label Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .rs-contact-box .address-item .address-text span.label',
				
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-contact-box .address-item .address-text span.label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
		

		$this->start_controls_section(
		    '_section_des_style',
		    [
		        'label' => esc_html__( 'Description', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_control(
		    'des_color',
		    [
		        'label' => esc_html__( 'Description Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a' => 'color: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text .des' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_control(
		    'des_hover_color',
		    [
		        'label' => esc_html__( 'Description Hover Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a:hover' => 'color: {{VALUE}} !important',
		        ],
		    ]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'des_typography',
				'selectors' => [
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text a' => 'color: {{VALUE}} !important',
		            '{{WRAPPER}} .rs-contact-box .address-item .address-text .des' => 'color: {{VALUE}} !important',
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
		$settings = $this->get_settings_for_display(); ?>
		

		<!-- Style 1 Start -->
		<div class="rs-contact-box">

		<?php 
			foreach ( $settings['tabs'] as $item ) :

		
			?>
				<div class="address-item <?php echo esc_attr($settings['rs_contact_box_style']); ?>">

					<?php if(!empty($item['selected_icon']) || !empty($item['selected_image'])){ ?>
		            <div class="address-icon">
		            	<?php if($item['selected_icon']) { ?>
		            		<?php \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
		            	<?php } else{ ?>
							

		            		<img src="<?php echo esc_html($item['selected_image']['url']); ?>" />
		            	<?php } ?>
		            </div>
		            <?php } ?>

		            <div class="address-text">

		            	<?php if(!empty($item['tab_content'])){ ?>
		            	<div class="text">
		            		<?php if($item['contact_label']){ ?>
		            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
		            		<?php } ?>
		            		<?php if(!empty($item['tab_content'])){ ?>
		            		<span class="des">
				                <?php echo esc_html($item['tab_content']);?>
				            </span>
				            <?php } ?>
			            </div>
			       		<?php } ?>


		            	<?php if(!empty($item['contact_label_phone'])){ ?>
			            	<div class="phone">
			            		<?php if($item['contact_label']){ ?>
			            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
			            		<?php } ?>
				                
				                <a href="tel:+<?php echo esc_html($item['contact_label_phone']);?>"><?php echo esc_html($item['contact_label_phone']);?></a>
				            </div>
			       		<?php } ?>


		            	<?php if(!empty($item['contact_label_email'])){ ?>
			            	<div class="email">
			            		<?php if($item['contact_label']){ ?>
			            		 <span class="label"><?php echo esc_html($item['contact_label']);?></span>
			            		<?php } ?>
				                <a href="mailto:<?php echo esc_html($item['contact_label_email']);?>"><?php echo esc_html($item['contact_label_email']);?></a>
				            </div>
			       		<?php } ?>

		            </div>
		        </div>

			<?php endforeach; ?>
		    </div>

		<!-- Style 1 End -->	
		
	<?php
	}
}
