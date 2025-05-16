<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Text_Stroke;

defined( 'ABSPATH' ) || die();

class Themephi_Switcher_Widget extends \Elementor\Widget_Base {

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
		return 'tp-switcher';
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
		return esc_html__( 'TP Switcher', 'tp-elements' );
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
		return [ 'button', 'switch' ];
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
			'section_switch',
			[
				'label' => esc_html__( 'Switcher', 'tp-elements' ),
			]
		);				

		$this->add_control(
            'button_style',
            [
                'label'   => esc_html__( 'Select Style', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [					
                    'style1' => esc_html__( 'Style 1', 'tp-elements'),
                ],
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
			'switch_package_name',
			[
				'label' => esc_html__( 'Switch Package', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Monthly', 'tp-elements'),
				'placeholder' => esc_html__( 'Write Package Name', 'tp-elements' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'switch_package_name2',
			[
				'label' => esc_html__( 'Switch Another Package', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Yearly', 'tp-elements'),
				'placeholder' => esc_html__( 'Write Package Name', 'tp-elements' ),
				'separator' => 'before',
			]
		);
		$this->add_control(
            'monthly_shortcode',
            [
                'label' => esc_html__('Package Shortcode', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__('Type your Shortcode here', 'tp-elements'),
            ]
        );
		$this->add_control(
            'yearly_shortcode',
            [
                'label' => esc_html__('Package Shortcode Two', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'rows' => 10,
                'placeholder' => esc_html__('Type your Shortcode here', 'tp-elements'),
            ]
        );
		
		$this->end_controls_section();



		$this->start_controls_section(
		    '_section_style_switch',
		    [
		        'label' => esc_html__( 'Switch', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);
        $this->add_responsive_control(
            'switch_align',
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
                    '{{WRAPPER}}  .elementor-widget-container' => 'text-align: {{VALUE}}'
                ]
            ]
        );

		$this->add_responsive_control(
            'switch_bottom_spacing',
            [
                'label' => esc_html__( 'Bottom Spacing', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 3,
                        'max' => 50,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tpprice-switch' => 'margin-bottom: {{SIZE}}{{UNIT}} ;',
                ],                
            ]
        );

		
		$this->start_controls_tabs( '_tabs_switch_toggle' );

		$this->start_controls_tab(
            'style_switch_toggle',
            [
                'label' => esc_html__( 'Switch Toggle', 'tp-elements' ),
            ]
        ); 


		$this->add_responsive_control(
            'switch_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-price-parent .toggle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'switch_width',
			[
				'label' => esc_html__( 'Width', 'tp-elements' ),
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
					'{{WRAPPER}} .tp-price-parent .toggle' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
			'switch_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
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
					'{{WRAPPER}} .tp-price-parent .toggle' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'switch_bg_color',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-price-parent .toggle',
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'switch_border',
		        'selector' => '{{WRAPPER}} .tp-price-parent .toggle',
		    ]
		);

        $this->add_responsive_control(
            'switch_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .tp-price-parent .toggle' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                    '{{WRAPPER}} .tp-price-parent .switch' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_switch_shadow',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggle',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'style_toggle_inner_switch',
            [
                'label' => esc_html__( 'Toggle Inner', 'tp-elements' ),
            ]
        ); 

		$this->add_responsive_control(
            'switch_inner_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-price-parent .toggle .switch' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'switch_inner_bg_color',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .tp-price-parent .toggle .switch',
			]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'switch_inner_border',
		        'selector' => '{{WRAPPER}} .tp-price-parent .toggle .switch',
		    ]
		);

        $this->add_responsive_control(
            'switch_inner_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [          
                    '{{WRAPPER}} .tp-price-parent .toggle .switch' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],               
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => '_switch_inner_shadow',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggle .switch',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs( );

		$this->end_controls_section();
		
		$this->start_controls_section(
		    '_style_switch_text',
		    [
		        'label' => esc_html__( 'Text', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->start_controls_tabs( '_tabs_switch_text' );

		$this->start_controls_tab(
            'style_switch_text_normal',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_text_normal__typography',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggler',
			]
		);
		
		$this->add_control(
            'text_normal_color',
            [
                'label' => esc_html__( 'Text Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-price-parent .toggler' => 'color: {{VALUE}} !important ;',
                ],
            ]
        );
  
        $this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => '_text_normal_shadow',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggler',
			]
		);

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => '_text_normal_stoke',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggler',
            ]
        );

		$this->end_controls_tab();
		
		$this->start_controls_tab(
            'style_switch_text_active',
            [
                'label' => esc_html__( 'Active', 'tp-elements' ),
            ]
        ); 

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => '_text_active__typography',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggler.toggler--is-active',
			]
		);

		$this->add_control(
            'active_text_color',
            [
                'label' => esc_html__( 'Text Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-price-parent .toggler.toggler--is-active' => 'color: {{VALUE}} !important ;',
                ],
            ]
        );

		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => '_text_active_shadow',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggler.toggler--is-active',
			]
		);

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name' => '_text_active_stoke',
				'selector' => '{{WRAPPER}} .tp-price-parent .toggler.toggler--is-active',
            ]
        );

		$this->end_controls_tab();

		$this->end_controls_tabs( );

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
		$unique          = rand(20125,351209989);
		
		?>

		<style>
			.tp-check:checked ~ .switch {
				right: 5px;
				left: 57.5%;
				transition: 0.25s cubic-bezier(0.785, 0.135, 0.15, 0.86);
				transition-property: left, right;
				transition-delay: 0.08s, 0s;
			}
			.toggle {
				position: relative;
				width: 70px;
				height: 32px;
				border-radius: 100px;
				background-color: #452FF4;
				overflow: hidden;
				box-shadow: inset 0 0 2px 1px rgba(0, 0, 0, 0.05);
				margin: 0 10px;
			}
			.tp-price-parent .toggle, .tp-price-parent .toggler {
				display: inline-block;
				vertical-align: middle;
			}
			.tp-price-parent .toggler {
				transition: 0.2s;
				cursor: pointer;
				font-weight: 500;
				font-size: 20px;
				line-height: 1;
				color: #354764;
				text-align: center;
			}
			.toggler--is-active {
				color: #452FF4 !important;
			}
			.tp-check {
				position: absolute;
				display: block;
				cursor: pointer;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				opacity: 0;
				z-index: 6;
			}
			.tp-price-parent .switch {
				position: absolute;
				left: 5px;
				top: 4px;
				bottom: 4px;
				right: 57.5%;
				background-color: #fff;
				border-radius: 36px;
				z-index: 1;
				transition: 0.25s cubic-bezier(0.785, 0.135, 0.15, 0.86);
				transition-property: left, right;
				transition-delay: 0s, 0.08s;
				box-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
			}
			.tp-price-toggle {
				position: relative;
			}
			.tp-price-parent .hide {
				display: none;
			}

		</style>

		<!-- pricing-area-start -->
		<section class="tp-price-parent ">
			<div class="tppricing-wrapper">
				<div class="tpprice-switch p-relative">
					<div class="tpprice-switch-wrapper"> 
						<?php if( !empty( $settings['switch_package_name'] ) ) : ?>
						<label class="toggler toggler--is-active" id="filt-monthly-<?php echo esc_attr($unique); ?>"><?php echo esc_html( $settings['switch_package_name'] ); ?></label>
						<?php endif; ?>
						<div class="toggle">
							<input type="checkbox" id="switcher-<?php echo esc_attr($unique); ?>" class="tp-check">
							<b class="switch"></b>
						</div>
						<?php if( !empty( $settings['switch_package_name2'] ) ) : ?>
						<label class="toggler" id="filt-yearly-<?php echo esc_attr($unique); ?>"><?php echo esc_html( $settings['switch_package_name2'] ); ?></label>
						<?php endif; ?>
					</div>
				</div>
				<div class="tp-price-toggle">
					<?php if( !empty( $settings['monthly_shortcode'] ) ) : ?>
					<div id="monthly-<?php echo esc_attr($unique); ?>" class="wrapper-full">
						<?php echo do_shortcode($settings['monthly_shortcode']) ?>
					</div>
					<?php endif; ?>
					<?php if( !empty( $settings['yearly_shortcode'] ) ) : ?>
					<div id="hourly-<?php echo esc_attr($unique); ?>" class="wrapper-full hide">
						<?php echo do_shortcode($settings['yearly_shortcode']) ?>
					</div>
					<?php endif; ?>
				</div>
			</div>
		</section>
		<!-- pricing-area-end -->

		<script type="text/javascript"> 
			jQuery(document).ready(function($){
					
				// 01. nav-tabs
				function tabtable_active() {
				
				var nt = document.getElementById("switcher-<?php echo esc_attr($unique); ?>");

				var e = document.getElementById("filt-monthly-<?php echo esc_attr($unique); ?>"),
					d = document.getElementById("filt-yearly-<?php echo esc_attr($unique); ?>"),
					t = nt,
					m = document.getElementById("monthly-<?php echo esc_attr($unique); ?>"),
					y = document.getElementById("hourly-<?php echo esc_attr($unique); ?>");

				e.addEventListener("click", function () {
					t.checked = false;
					e.classList.add("toggler--is-active");
					d.classList.remove("toggler--is-active");
					m.classList.remove("hide");
					y.classList.add("hide");
				});

				d.addEventListener("click", function () {
					t.checked = true;
					d.classList.add("toggler--is-active");
					e.classList.remove("toggler--is-active");
					m.classList.add("hide");
					y.classList.remove("hide");
				});

				t.addEventListener("click", function () {
					d.classList.toggle("toggler--is-active");
					e.classList.toggle("toggler--is-active");
					m.classList.toggle("hide");
					y.classList.toggle("hide");
				})
				}
				if ($('#filt-monthly-<?php echo esc_attr($unique); ?>').length > 0) { 
				tabtable_active();
				}

			});
		</script>

	<?php 
	}
}