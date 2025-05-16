<?php
/**
 * Feature List
 *
 */
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Features_List_Widget extends \Elementor\Widget_Base {

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
        return 'tp-featureslist';
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
        return esc_html__( 'TP Features List', 'tp-elements' );
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
        return 'glyph-icon flaticon-price';
    }


    public function get_categories() {
        return [ 'tpaddon_category' ];
    }

    public function get_keywords() {
        return [ 'list', 'title', 'features', 'heading', 'plan' ];
    }

	protected function register_controls() {
		$this->start_controls_section(
			'_section_header',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);     

        $repeater = new Repeater();

        $repeater->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'tp tp-check',
					'library' => 'solid',
				],	 
                'label_block' => true,              
            ]
        );

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__( 'Text', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '100GB free space with hosting', 'tp-elements' ),
                'label_block' => true,  
            ]
        );
        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tp-elements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'features_list',
            [
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'show_label' => false,
                'default' => [
                    [
                        'text' => esc_html__( '100GB Free Space with Hosting', 'tp-elements' ),
                        'icon' => 'fa fa-check',
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->add_responsive_control(
			'icon_position',
			[
				'label' => esc_html__( 'Icon Position', 'tp-elements' ),
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
				'prefix_class' => 'tp-feature_list-position-',	
                'separator' => 'before', 
			]
		);

        $this->add_control(
		    'icon_spacing',
		    [
		        'label' => esc_html__( 'Icon Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-features-list li' => 'gap: {{SIZE}}{{UNIT}};',         
		        ],	
		    ]
		);	

        $this->end_controls_section();


    
        $this->start_controls_section(
            '_section_style_general',
            [
                'label' => esc_html__( 'General', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );  
        $this->add_responsive_control(
            'feature_item_align',
            [
                'label' => esc_html__( 'Align Items', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'top', 'tp-elements' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-justify-center-v',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-justify-end-v',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li' => 'align-items: {{VALUE}}',
                ],
            ]
        );    

        $this->add_control(
		    'list_spacing',
		    [
		        'label' => esc_html__( 'List Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
                'separator' => 'before', 
		        'selectors' => [
		            '{{WRAPPER}} .tp-features-list' => 'gap: {{SIZE}}{{UNIT}};',         
		        ],	
		    ]
		);	

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_color',
                'label' => esc_html__( 'List Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tp-features-list li',
            ]
        );       

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'general_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .tp-features-list li'
            ]
        );   

        $this->add_responsive_control(
            'general_padding',
            [
                'label' => esc_html__( 'List Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'general_margin',
            [
                'label' => esc_html__( 'List Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
      
       $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_border',
                'selector' => '{{WRAPPER}} .tp-features-list li'                
            ]
        );

       $this->add_responsive_control(
            'features_title_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();   

        $this->start_controls_section(
            '_section_style_text',
            [
                'label' => esc_html__( 'Text', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'feature_list_text',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Text', 'tp-elements' ),
				'separator' => 'before',
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'selector' => '{{WRAPPER}} .tp-features-text',
                
            ]
        );   

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-features-text' => 'color: {{VALUE}};',
                ],
            ]
        ); 

        $this->add_control(
            'text_hover_color',
            [
                'label' => esc_html__( 'Text Hover Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-features-text:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
			'feature_list_description',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__( 'Description', 'tp-elements' ),
				'separator' => 'before',
			]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .tp-feature-description',
                
            ]
        );   

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__( 'Description Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-features-description' => 'color: {{VALUE}};',
                ],
            ]
        );   
        
        $this->add_responsive_control(
            'description_margin',
            [
                'label' => esc_html__( 'Description Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();       


        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
			'feature_list_size',
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
					'{{WRAPPER}} .tp-features-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .tp-features-list li svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li .tp-features-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-features-list li .tp-features-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );      

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .tp-features-list li .tp-features-icon',
            ]
        );   

        $this->add_responsive_control(
            'icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li .tp-features-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_responsive_control(
            'icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li .tp-features-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );          
       

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'list_item_icon_border',
                'selector' => '{{WRAPPER}} .tp-features-list li .tp-features-icon'                
            ]
        );

         $this->add_responsive_control(
            'features_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-features-list li .tp-features-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );
        
        $this->end_controls_section();
    }

  

	protected function render() {
        $settings = $this->get_settings_for_display();?> 

        <div class="tp-features-list-content">        
            <?php if ( is_array( $settings['features_list'] ) ) : ?>
                <ul class="tp-features-list">
                    <?php foreach ( $settings['features_list'] as $index => $feature ) :
                        $name_key = $this->get_repeater_setting_key( 'text', 'features_list', $index );
                        $this->add_inline_editing_attributes( $name_key, 'basic' );
                        $this->add_render_attribute( $name_key, 'class', 'tp-features-text' );
                        ?>
                        <li class="<?php echo esc_attr( 'elementor-repeater-item-' . $feature['_id'] ); ?>">

                            <?php if ( $feature['icon'] ) : ?>
                                <span class="tp-features-icon">
                                <?php \Elementor\Icons_Manager::render_icon( $feature['icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                            <?php endif; ?>
                            <div class="tp-features-content">
                                <span <?php $this->print_render_attribute_string( $name_key ); ?>><?php echo wp_kses_post( $feature['text'] ); ?></span>
                                <?php if ( $feature['description'] ) : ?>
                                <div class="tp-features-description">
                                    <?php echo wp_kses_post( $feature['description'] ); ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>           
        </div>
        <?php
    }
}
