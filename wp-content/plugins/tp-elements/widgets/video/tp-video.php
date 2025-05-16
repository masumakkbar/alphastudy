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

class Themephi_Elementor_Video_Widget extends \Elementor\Widget_Base {

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
		return 'tp-video';
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
		return __( 'TP Video', 'tp-elements' );
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
		return [ 'video' ];
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
				'label' => esc_html__( 'Content', 'tp-elements' ),
			]
		);

		$this->add_control(
			'play_icon',
			[
				'label' => esc_html__( 'Button Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'tp-play',
					'library' => 'solid',
				],			
				'separator' => 'before',	
                'skin' => 'inline',
				'label_block' => false,
			]
		);

		$this->add_responsive_control(
			'play_btn_position',
			[
				'label' => esc_html__( 'Button Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
					'bottom' => [
						'title' => esc_html__( 'Bottom', 'tp-elements' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'tp-btn-position-',	
			]
		);

		$this->add_control(
		    'play_btn_spacing_left',
		    [
		        'label' => esc_html__( 'Button Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 20
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-video-playBtn' => 'gap: {{SIZE}}{{UNIT}};',         
		        ],	
		    ]
		);

		$this->add_responsive_control(
			'play_btn_animation',
			[
				'label' => esc_html__( 'Play Btn Animation', 'tp-elements' ),
				'type' => Controls_Manager::SELECT,
                'default'   => 'no_shape',
				'options' => [
					'no_shape' => 'No Shape',
					'shape1' => 'Shape 1',
					'shape2' => 'Shape 2',
					'shape3' => 'Shape 3',
				],
                'prefix_class' => 'tp-video-',
			]
		);

		$this->add_control(
			'video_link',
			[
				'label' => esc_html__( 'Enter Link Here', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__( 'Video link here', 'tp-elements' ),
			]
		);

		$this->add_control(
            'show_content',
            [
				'label'        => esc_html__( 'Show Content', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'tp-elements' ),
				'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'separator' => 'before',
            ]
        );

		$this->add_responsive_control(
            'align',
            [
                'label' => esc_html__( 'Content Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
				'separator' => 'before',
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
                'default'     => 'center',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .themephi-video' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .tp-video-playBtn' => 'text-align: {{VALUE}}'
                ],
				'condition' => [
		            'show_content' => 'yes'
		        ],
            ]
        );

		$this->add_control(
			'tp_video_title',
			[
				'label' => esc_html__( 'Video Title', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,	
				'default'     => 'Add Your Title',
				'condition' => [
		            'show_content' => 'yes'
		        ],
			]
		);
			
		$this->add_control(
			'tp_video_description',
			[
				'label' => esc_html__( 'Video Description', 'tp-elements' ),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,	
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__( 'Add your video description here..', 'tp-elements' ),
				'condition' => [
		            'show_content' => 'yes'
		        ],
			]
			
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_icon',
			[
				'label' => esc_html__( 'Icon', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'play_icon_size',
			[
				'label' => esc_html__( 'Icon Size', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-video-playBtn a svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs(
            'tp_video_icon'
        );

        $this->start_controls_tab(
            'tp_video_icon_normal',
            [
                'label' => esc_html__( 'Normal ', 'tp-elements' ),
            ]
        );

		$this->add_control(
			'play_btn_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-video-playBtn a svg' => 'fill: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'play_btn_bg',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'video_button_shadow',
				'selector' => '{{WRAPPER}} .tp-video-playBtn a',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'video_button_border',
				'selector' => '{{WRAPPER}} .tp-video-playBtn a',
			]
		);

		$this->end_controls_tab();

        $this->start_controls_tab(
            'tp_video_icon_hover',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

		$this->add_control(
			'play_btn_color_hover',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a:hover' => 'color: {{VALUE}};',
					'{{WRAPPER}} .tp-video-playBtn a:hover svg' => 'fill: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'play_btn_bg_hover',
			[
				'label' => esc_html__( 'Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a:hover' => 'background: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'video_button_shadow_hover',
				'selector' => '{{WRAPPER}} .tp-video-playBtn a:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'video_button_border_hover',
				'selector' => '{{WRAPPER}} .tp-video-playBtn a:hover',
			]
		);

		$this->end_controls_tab();

        $this->end_controls_tabs();

		$this->add_responsive_control(
		    'play_box_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-video-playBtn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		        ],
		    ]
		);

		$this->add_control(
			'play_box_width',
			[
				'label' => esc_html__( 'Box Size', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'play_animation_border_color',
			[
				'label' => esc_html__( 'Animation Border Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a:before' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .tp-video-playBtn a:after' => 'border-color: {{VALUE}};',
				],
				'condition' => [
					'play_btn_animation!' => 'no_shape' 
				]
			]
		);

		$this->add_responsive_control(
		    'video_button_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-video-playBtn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'play_animation_background_color',
			[
				'label' => esc_html__( 'Animation Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-playBtn a:after' => 'background-color: {{VALUE}} !important;',
				],
				'condition' => [
					'play_btn_animation' => 'shape1' 
				]
			]
		);

		$this->end_controls_section();

			
		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
				'condition' => [
					'show_content' => 'yes'
				]
			]
		);

		// $this->add_control(
		// 	'content_width',
		// 	[
		// 		'label' => esc_html__( 'Content Box Width', 'tp-elements' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 0,
		// 				'max' => 1000,
		// 				'step' => 1,
		// 			],
		// 			'%' => [
        //                 'min' => 1,
        //                 'max' => 100,
        //             ],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tp-video-playBtn' => 'width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

		$this->add_control(
			'video_title',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Title', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_title_typography',				
				'selector' => '{{WRAPPER}} .tp-video-title',
				
			]
		);

		$this->add_control(
			'video_title_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-title' => 'color: {{VALUE}};',
				],				
			]
		);
		

        $this->add_responsive_control(
		    'video_title_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-video-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_control(
			'video_desc',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'video_desc_typography',				
				'selector' => '{{WRAPPER}} .tp-video-desc',
				
			]
		);

		$this->add_control(
			'video_desc_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .tp-video-desc' => 'color: {{VALUE}};',
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
		$rand = rand(12, 3330);
		?>
		
		<div class="tp-video-playBtn">
			<a class="tp-popup-btn" href="<?php echo esc_url($settings['video_link']);?>">
				<?php \Elementor\Icons_Manager::render_icon( $settings['play_icon'], [ 'aria-hidden' => 'true' ] ); ?>
			</a>

			<?php if( ($settings['show_content'] == 'yes') ) : ?>
			<?php if( !empty( $settings['tp_video_title']) || !empty( $settings['tp_video_description']) ) : ?>
			<div class="tp-video-info">
				<?php if( !empty( $settings['tp_video_title'])) : ?>
				<h4 class="tp-video-title">
					<?php echo wp_kses_post($settings['tp_video_title']); ?>
				</h4>
				<?php endif;?>

				<?php if( !empty( $settings['tp_video_description']) ) : ?>
				<div class="tp-video-desc">
					<?php echo wp_kses_post($settings['tp_video_description']); ?>
				</div>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<?php endif; ?>
		</div>		

		<script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.popup-videos').magnificPopup({
			        disableOn: 10,
			        type: 'iframe',
			        mainClass: 'mfp-fade',
			        removalDelay: 160,
			        preloader: false,

			        fixedContentPos: false
			    }); 
			});
		</script>
    
<?php 
	}
}