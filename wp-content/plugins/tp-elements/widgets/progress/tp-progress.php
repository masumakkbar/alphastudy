<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Progress_Widget extends \Elementor\Widget_Base {
	
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
		return 'tp-progress-bar';
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
		return esc_html__( 'TP Progress Bar', 'tp-elements' );
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
		return 'glyph-icon flaticon-progress';
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
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_progress',
			[
				'label' => esc_html__( 'Progress Bar', 'tp-elements' ),
			]
		);

		$this->add_control(
			'percent',
			[
				'label' => esc_html__( 'Percentage', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 50,
					'unit' => '%',
				],
				'label_block' => true,
			]
		);

		$this->add_control( 'tp_progress_bar_style', [
			'label' => esc_html__( 'Style', 'tp-elements' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'style1',
			'options' => [
				'style1' => esc_html__( 'Style 1', 'tp-elements' ),
				'style2' => esc_html__( 'Style 2', 'tp-elements' ),
			],
		] );

		$this->add_control( 'tp_linear_bar_style', [
			'label' => esc_html__( 'Linear Background Style', 'tp-elements' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'basic',
			'options' => [
				'basic' => esc_html__( 'Basic', 'tp-elements' ),
				'striped' => esc_html__( 'Striped', 'tp-elements' ),
				'animation' => esc_html__( 'Striped Animation', 'tp-elements' ),
			],
		] );

		$this->add_control( 'display_percentage', [
			'label' => esc_html__( 'Display Percentage', 'tp-elements' ),
			'type' => Controls_Manager::SELECT,
			'default' => 'show',
			'separator' => 'before',
			'options' => [
				'show' => esc_html__( 'Show', 'tp-elements' ),
				'hide' => esc_html__( 'Hide', 'tp-elements' ),
			],
		] );

		$this->add_responsive_control(
			'tp_progress_title_position_horizontal',
			[
				'label' => esc_html__( 'Item Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'stretch',
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
					'stretch' => [
						'title' => esc_html__( 'Stretch', 'tp-elements' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
                'prefix_class' => 'tp-progress-item-position-',
			]
		);

		$this->add_responsive_control(
			'tp_progress_title_position',
			[
				'label' => esc_html__( 'Title Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'left',
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'tp-progressbar-position-',
				'condition' => [
					'display_percentage' => 'show'
				]
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
				],
				'size_units' => [ 'px', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .tp-skillbar-head' => 'gap: {{SIZE}}{{UNIT}}',
				],
				'condition' => [
					'tp_progress_title_position_horizontal!' => 'stretch',
				],
			]
		);

		$this->add_control(
			'tp_progress_inner_text',
			[
				'label' => esc_html__( 'Title Text', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'separator' => 'before',
				'placeholder' => esc_html__( 'Web Designer', 'tp-elements' ),
				'default' => esc_html__( 'Web Designer', 'tp-elements' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'tp_view',
			[
				'label' => esc_html__( 'View', 'tp-elements' ),
				'type' => Controls_Manager::HIDDEN,
				'default' => 'traditional',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'tp_section_progress_style',
			[
				'label' => esc_html__( 'Progress Bar', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'tp_progressbar_item',
			[
				'label' => esc_html__( 'Item', 'tp-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
            'item_area_padding',
            [
                'label' => esc_html__( 'Item Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-skill-bar.style1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

		$this->add_control(
			'tp_progressbar_item_content',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'tp_progressbar_item_content_position',
			[
				'label' => esc_html__( 'Content Position', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
				],
				'size_units' => [ 'px', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .tp-skillbar-head' => 'top: {{SIZE}}{{UNIT}}',
				],
			]
		);

		$this->add_control(
			'tp_bar_inline_color',
			[
				'label' => esc_html__( 'Title Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .skillbar .skillbar-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_bar_inner_typography',
				'selector' => '{{WRAPPER}} .tp-skill-bar .skillbar .skillbar-title',
				'exclude' => [
					'line_height',
				],
			]
		);

		$this->add_control(
			'tp_inner_percent',
			[
				'label' => esc_html__( 'Percent Style', 'tp-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'tp_bar_percent_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .skillbar .skill-bar-percent' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tp_bar_percent_typography',
				'selector' => '{{WRAPPER}} .tp-skill-bar .skillbar .skill-bar-percent',
				'exclude' => [
					'line_height',
				],
			]
		);

		$this->add_control(
			'tp_inner_text_heading',
			[
				'label' => esc_html__( 'Progress Bar', 'tp-elements' ),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		
		$this->add_control(
			'tp_bar_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .skillbar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-skill-bar.style2 .skillbar .skillbar-title' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'tp_inner_bar_height',
			[
				'label' => esc_html__( 'Inner Height', 'tp-elements' ),
				'type' => Controls_Manager::SLIDER,
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .skillbar .skillbar-bar' => 'height: {{SIZE}}{{UNIT}}; line-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tp_bar_bg_animate_color',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tp-skill-bar .skillbar .skillbar-bar',
            ]
        );
		
		$this->add_control(
			'tp_area_title_bg_color',
			[
				'label' => esc_html__( 'Title Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar.style2 .skillbar .skillbar-title' => 'background-color: {{VALUE}};',
				],
				'condition' => [
					'tp_progress_bar_style' => 'style2',
				],
			]
		);

		$this->add_control(
            'progressbar_inner_margin',
            [
                'label' => esc_html__( 'Inner Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-skill-bar.style1 .skillbar .skillbar-bar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

		$this->add_control(
            'progress_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-skill-bar.style1 .skillbar .skillbar-bar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
		$this->add_control(
			'tp_area_bar_bg_color',
			[
				'label' => esc_html__( 'Gray Area Background Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tp-skill-bar .skillbar' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'progressbar_border',
				'selector' => '{{WRAPPER}} .tp-skill-bar .skillbar',
                
			]
		);
		$this->add_control(
            'grey_progress_border_radius',
            [
                'label' => esc_html__( 'Grey Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-skill-bar.style1 .skillbar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		$this->end_controls_section();
	}

	/**
	 * Render progress widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$this->add_inline_editing_attributes( 'tp_progress_inner_text', 'basic' );
        $this->add_render_attribute( 'tp_progress_inner_text', 'class', 'skillbar-title' );

		$this->add_render_attribute( 'progress-bar', [
			'class' => 'skillbar',
			'data-percent' => $settings['percent']['size'],
		] );?>

		<div class="tp-skill-bar <?php echo esc_html($settings['tp_linear_bar_style']); ?>  <?php echo esc_html($settings['tp_progress_bar_style']); ?>"> 
            <div <?php echo wp_kses_post( $this->get_render_attribute_string( 'progress-bar' ) ); ?>> 
				<div class="tp-skillbar-head">
                	<span <?php echo wp_kses_post( $this->get_render_attribute_string( 'tp_progress_inner_text' ) ); ?>><?php echo esc_html($settings['tp_progress_inner_text']); ?></span>
					
					<?php if($settings['display_percentage'] == 'show') {?>
						<span class="skill-bar-percent"></span> 
					<?php } ?>
				</div>
                <p class="skillbar-bar"></p>
            </div>
        </div>

        <script type="text/javascript">			
			jQuery(document).ready(function(){
				jQuery('.skillbar').skillBars({  
		            from: 0,    
		            speed: 4000,    
		            interval: 100,  
		            decimals: 0,    
		        });
			});
		</script>

		<?php
	}
}
