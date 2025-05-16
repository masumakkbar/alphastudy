<?php
/**
 * Elementor Buisness Hour Widget.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Business_Hour_Widget extends \Elementor\Widget_Base {

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
		return 'tp-business-hour';
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
		return esc_html__( 'TP Business Hour', 'tp-elements' );
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
		return 'glyph-icon flaticon-24-hours';
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

	protected function register_controls() {
		$this->start_controls_section(
			'tps_section_title',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'business_day',
			[
				'label' => esc_html__( 'Day', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,							
			]
		);

		$repeater->add_control(
			'business_time',
			[
				'label' => esc_html__( 'Time', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,	
				'separator'    => 'before',		
			]
		);

		$repeater->add_control(
			'tps_close_this_day',
			[
				'label'        => esc_html__( 'Highlight this day', 'tp-elements' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => 'no',
				'separator'    => 'before',
			]
		);
		
		$repeater->add_responsive_control(
			'tps_single_business_day_color',
			[
				'label'     => esc_html__( 'Day Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,				
				'selectors' => [
					'{{WRAPPER}} .yes .rs-business-day' => 'color: {{VALUE}}',
				],
				'condition' => [
					'tps_close_this_day' => 'yes',
				],
				'default' => '#ff0000',
				'separator' => 'before',
			]
		);

		$repeater->add_responsive_control(
			'single_business_time_color',
			[
				'label'     => esc_html__( 'Time Color', 'tp-elements' ),
				'type'      => Controls_Manager::COLOR,
				
				'selectors' => [
					'{{WRAPPER}} .yes .rs-business-time' => 'color: {{VALUE}}',
				],
				'condition' => [
					'tps_close_this_day' => 'yes',
				],
				'default' => '#ff0000',
				'separator' => 'before',
			]
		);


		$this->add_control(
			'tps_business_hour_list',
			[
				'type'    => Controls_Manager::REPEATER,
				'fields'  => array_values( $repeater->get_controls() ),
				'default' => [					

					[
						'business_day'  => esc_html__( 'Saturday', 'tp-elements' ),
						'business_time' => esc_html__( '10:00 AM to 3:00 PM','tp-elements' ),						
					],

					[
						'business_day'  => esc_html__( 'Monday', 'tp-elements' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','tp-elements' ),
					],

					[
						'business_day'  => esc_html__( 'Tues Day', 'tp-elements' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','tp-elements' ),
					],

					[
						'business_day'  => esc_html__( 'Wednesday', 'tp-elements' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','tp-elements' ),
					],

					[
						'business_day'  => esc_html__( 'Thursday', 'tp-elements' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','tp-elements' ),
					],

					[
						'business_day'  => esc_html__( 'Friday', 'tp-elements' ),
						'business_time' => esc_html__( '10:00 AM to 5:00 PM','tp-elements' ),
					],

					[
						'business_day'      => esc_html__( 'Sunday', 'tp-elements' ),
						'business_time'     => esc_html__( 'Close','tp-elements' ),
						'tps_close_this_day' => esc_html__( 'yes','tp-elements' ),
					],
				],
				'title_field' => '{{{ business_day }}}',
			]
		);

		$this->add_responsive_control(
			'tp_hour_space_position_horizontal_2',
			[
				'label' => esc_html__( 'Item Position', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'stretch',
				'options' => [
					'end' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-h-align-center',
					],
					'start' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
					'stretch' => [
						'title' => esc_html__( 'Stretch', 'tp-elements' ),
						'icon' => 'eicon-h-align-stretch',
					],
				],
                'prefix_class' => 'tp-hour-space-position-',
				'condition' => [
					'tp_hour_position' => 'right'
				]
			]
		);
		$this->add_responsive_control(
			'tp_hour_space_position_horizontal',
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
                'prefix_class' => 'tp-hour-space-position-',
				'condition' => [
					'tp_hour_position' => 'left'
				]
			]
		);

		$this->add_responsive_control(
			'tp_hour_position',
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
				'prefix_class' => 'tp-hour-position-',
			]
		);

		$this->add_responsive_control(
			'tp_hour_spacing',
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
					'{{WRAPPER}} .rs-business-schedule' => 'gap: {{SIZE}}{{UNIT}}',
				],
			]
		);
		

       $this->end_controls_section();


		$this->start_controls_section(
			'section_faq_style_title',
			[
				'label' => esc_html__( 'Day/Time', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_color',
			[
				'label' => esc_html__( 'Item Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'color: {{VALUE}};',
				],
				'separator' => 'before',				
			]
		);

		$this->add_control(
			'item_background',
			[
				'label' => esc_html__( 'Item Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'background-color: {{VALUE}};',
				],
				'separator' => 'before',
			]
		);
		

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'item_typography',
				'selector' => '{{WRAPPER}} .rs-business-hour .rs-business-schedule span',
				
			]
		);

		
		$this->add_responsive_control(
			'item_padding',
			[
				'label' => esc_html__( 'Padding', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		
		$this->add_responsive_control(
			'item_margin',
			[
				'label' => esc_html__( 'Margin', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
    	    Group_Control_Border::get_type(),
    	    [
    	        'name' => 'item_border',
    	        'selector' => '{{WRAPPER}} .rs-business-hour .rs-business-schedule',
    	    ]
		);
		$this->add_control(
            'hour_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rs-business-hour .rs-business-schedule' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		
		$this->end_controls_section();
	}

	/**
	 * Render accordion widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		echo '<div class="rs-business-hour">';			
			foreach ( $settings['tps_business_hour_list'] as $index => $item ) :
			?>
				<div class="rs-business-schedule <?php echo esc_attr($item['tps_close_this_day']); ?>">
					<span class="rs-business-day"><?php echo esc_html($item['business_day']); ?></span>
					<span class="rs-business-time"><?php echo esc_html($item['business_time']); ?></span>
				</div>
			<?php					
			endforeach;
		echo '</div>';
	}
}