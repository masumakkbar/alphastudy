<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Progress_Pie_Widget extends \Elementor\Widget_Base {

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
		return 'tp-progress-pie';
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
		return esc_html__( 'TP Progress Pie', 'tp-elements' );
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
		return 'glyph-icon flaticon-percentage';
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
        return [ 'pielements_category'];
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
				'label' => esc_html__( 'Progress Pie', 'tp-elements' ),
			]
		);
		$this->add_control(
			'rs_progress_title',
			[
				'label' => esc_html__( 'Title', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,				
				'default' => esc_html__( 'Web Designer', 'tp-elements' ),
				'label_block' => true,
				'separator' => 'before',
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
				'separator' => 'before',
			]
		);
		$this->add_responsive_control(
			'tppie_size',
			[
				'label' => esc_html__( 'Size', 'tp-elements' ),				
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 80,
                        'max' => 500,
                    ],
                ],
                'default' => [
                    'size' => 200,
                ],                
				'separator' => 'before',			
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'rs_section_progress_style',
			[
				'label' => esc_html__( 'Progress Pie', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);		

		$this->add_control(
			'rs_default_bar_color',
			[
				'label' => esc_html__( 'Bar Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);

		$this->add_control(
			'rs_bar_active_color',
			[
				'label' => esc_html__( 'Active Bar Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,	
				'separator' => 'before',			
			]
		);

		$this->add_responsive_control(
			'bar_size',
			[
				'label' => esc_html__( 'Boder Width', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => 8,	
				'separator' => 'before',			
			]
		);


		$this->add_control(
			'percent_color',
			[
				'label' => esc_html__( 'Percentage Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tppie-value' => 'color: {{VALUE}};',
				],	
				'separator' => 'before',			
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .tppie-value',                
                'separator' => 'before',
            ]
        );	


		$this->end_controls_section();

		$this->start_controls_section(
			'rs_section_progress_title_style',
			[
				'label' => esc_html__( 'Title', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__( 'Color', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .number' => 'color: {{VALUE}};',
				],	
				'separator' => 'before',			
			]
		);

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography_number',
                'selector' => '{{WRAPPER}} .number',                
                'separator' => 'before',
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'title_border_pie',
                'selector' => '{{WRAPPER}} .number'                
            ]
        );

        $this->add_control(
			'number_bg',
			[
				'label' => esc_html__( 'Title Background', 'tp-elements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .number' => 'background-color: {{VALUE}};',
				],	
				'separator' => 'before',			
			]
		);	

        $this->add_responsive_control(
		    'title_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .number' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'title_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 10,
                ],  
		        'selectors' => [
		            '{{WRAPPER}} .number' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$unique = rand(10,6554120);
		$piesize = $settings['tppie_size']['size'];
		$rs_default_bar_color = !empty($settings['rs_default_bar_color']) ? $settings['rs_default_bar_color'] : '#eee';
		$rs_bar_active_color = !empty($settings['rs_bar_active_color']) ? $settings['rs_bar_active_color'] : '#68b828';

		$this->add_inline_editing_attributes( 'rs_progress_title', 'basic' );
        $this->add_render_attribute( 'rs_progress_title', 'class', 'number' );
	?>
		
	<div class="tp-pie-content">
		<div id="tp-pie-<?php echo esc_attr($unique);?>" class="tppie-title-center" data-percent="<?php echo esc_attr($settings['percent']['size']);?>">
			<span class="tppie-value"></span> 
			
		</div>
		<?php if(!empty($settings['rs_progress_title'])) : ?>
			<div class="number"><?php echo esc_html($settings['rs_progress_title']);?></div>
		<?php endif; ?>
	</div>

	<script type="text/javascript">
        jQuery(document).ready(function () {
            jQuery('#tp-pie-<?php echo esc_attr($unique);?>').pieChart({
                barColor: '<?php echo esc_html($rs_bar_active_color);?>',
                trackColor: '<?php echo esc_html($rs_default_bar_color);?>',
                lineCap: 'round',
                lineWidth: <?php echo esc_html($settings['bar_size']);?>,
                size: <?php echo esc_html($piesize);?>,
                onStep: function (from, to, percent) {
                    jQuery(this.element).find('.tppie-value').text(Math.round(percent) + '%');
                }
            });
        });

    </script>       
	<?php
	}
}