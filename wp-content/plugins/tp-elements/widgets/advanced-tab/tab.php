<?php
/**
 * Tab widget class
 *
 */
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Themephi_Advance_Tab_Widget extends \Elementor\Widget_Base {
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
        return 'tp-tab-advanced';
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
        return esc_html__( 'TP Advance Tab', 'tp-elements' );
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
        return 'glyph-icon flaticon-tabs-1';
    }


    public function get_categories() {
        return [ 'tpaddon_category' ];
    }

    public function get_keywords() {
        return [ 'tab', 'vertical', 'icon', 'horizental' ];
    }

	protected function register_controls() {
        // $category_dropdown[0] = 'Select Template';
        // $best_wp = new wp_Query(array(
        // 'post_type'      => 'tpelements_pro',
        // 'posts_per_page' => -1
                                         
        // ));  

        //  while($best_wp->have_posts()): $best_wp->the_post(); 

        //     $title = get_the_title();
        //     $id = get_the_ID();
        //     $category_dropdown[$id] = $title;

        //  endwhile; 
        //  wp_reset_query();  
      

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'tp-elements' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
			'button_type',
			[
				'label' => esc_html__( 'Button Type', 'tp-elements' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
                    'button_normal' => esc_html__( 'Button Normal', 'tp-elements' ),
                    'button_checkbox' => esc_html__( 'Button Checkbox', 'tp-elements' ),
                    'button_iconbox' => esc_html__( 'Button With Icon', 'tp-elements' ),
				],
				'default' => 'button_normal',
				'toggle' => true,
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
                'condition' => [
					'button_type' => 'button_iconbox',
				],
			]
		);

		$repeater->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'tp-elements' ),
				'type'      => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
				'separator' => 'before',
				'condition' => [
					'icon_type' => 'icon',
                    'button_type' => 'button_iconbox',
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
                    'button_type' => 'button_iconbox',
				],
				'separator' => 'before',
			]
		);	
        
        $repeater->add_control(
            'icon_position_set',
            [
                'label' => esc_html__( 'Icon/Radio Position', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-arrow-left',
                    ],
                    'top' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-arrow-down',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-arrow-right',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
				'separator' => 'before',
                'condition' => [
                    'button_type!' => 'button_normal',
				],
            ]
        );

        $repeater->add_control(
			'enable_tab_subtitle',
			[
				'label' => esc_html__( 'Enable Subtitle ?', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $repeater->add_control(
            'tab_subtitle',
            [
                'label'       => esc_html__( 'Sub Title', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Sub Title', 'tp-elements' ),
                'placeholder' => esc_html__( 'Tab Sub Title', 'tp-elements' ),
                'label_block' => true,
                'condition' => [
                    'enable_tab_subtitle' => ['yes'],
                ],
            ]
        );

        $repeater->add_control(
            'subtitle_position_set',
            [
                'label' => esc_html__( 'Subtitle Position', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'top' => [
                        'title' => esc_html__( 'Before Title', 'tp-elements' ),
                        'icon' => 'eicon-arrow-up',
                    ],
                    'bottom' => [
                        'title' => esc_html__( 'After Title', 'tp-elements' ),
                        'icon' => 'eicon-arrow-down',
                    ],
                ],
                'default' => 'top',
                'toggle' => true,
				'separator' => 'before',
                'condition' => [
                    'enable_tab_subtitle' => ['yes'],
                ],
            ]
        );

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Title', 'tp-elements' ),
                'placeholder' => esc_html__( 'Tab Title', 'tp-elements' ),
                'label_block' => true,

            ]
        );

        $repeater->add_control(
            'content_location',
            [
                'label'       => esc_html__( 'Select Content Location', 'tp-elements' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'default'     => 'editor',               
                'options' => [
                    'editor'    => 'Editor',
                    'shortcodes' => 'Shortcodes',                                 
                ],                                          
            ]
        );
 
        $repeater->add_control(
            'tab_shortcode',
            [
                'label'       => esc_html__( 'Tab Shortcode', 'tp-elements' ),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__( '', 'tp-elements' ),
                'placeholder' => esc_html__( 'Shortcode here', 'tp-elements' ),
                'label_block' => true,
                'condition' => [
                    'content_location' => 'shortcodes',
                ],
            ]
        );
        $repeater->add_control(
            'tab_content',
            [
                'label'       => esc_html__( 'Content', 'tp-elements' ),
                'default'     => __( 'Tab Content', 'tp-elements' ),
                'placeholder' => esc_html__( 'Tab Content', 'tp-elements' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
                 'condition' => [
                    'content_location' => 'editor',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Tabs Items', 'tp-elements' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title'   => esc_html__( 'Tab #1', 'tp-elements' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'tp-elements' ),
                    ],
                    [
                        'tab_title'   => esc_html__( 'Tab #2', 'tp-elements' ),
                        'tab_content' => esc_html__( 'Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'tp-elements' ),
                    ],

                    [
                        'tab_title'   => esc_html__( 'Tab #3', 'tp-elements' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'tp-elements' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__( 'View', 'tp-elements' ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Tab Type', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    
                    'vertical' => esc_html__( 'Vertical', 'tp-elements' ),
                    'horizontal' => esc_html__( 'Horizontal', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );



        $this->end_controls_section();

        //start title styling

        $this->start_controls_section(
            'section_tabs_icon_style',
            [
                'label' => esc_html__( 'Item Box', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
		    'tab_item_spacing',
		    [
		        'label' => esc_html__( 'Item Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 12
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-tab-advance-wrapper ul' => 'gap: {{SIZE}}{{UNIT}};',         
		        ],	
		    ]
		);

        $this->add_responsive_control(
            'tab_item_margin',
            [
                'label' => esc_html__( 'Item Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-tab-advance-wrapper ul' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
			'tab_icon_align',
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
                    '{{WRAPPER}} .tp-checkbox-item-inner' => 'align-items: {{VALUE}};',
                    '{{WRAPPER}} .tp-iconbox-item-inner' => 'align-items: {{VALUE}};',
                ],
			]
		);

        $this->add_control(
		    'tab_icon_spacing',
		    [
		        'label' => esc_html__( 'Spacing', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'default' => [
		            'size' => 10
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-checkbox-item-inner' => 'gap: {{SIZE}}{{UNIT}};',         
		            '{{WRAPPER}} .tp-iconbox-item-inner' => 'gap: {{SIZE}}{{UNIT}};',         
		        ],	
		    ]
		);

        $this->add_control(
            'tab_box_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Icon Box', 'tp-elements' ),
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'tab_icon_box_color',
            [
                'label' => esc_html__( 'Background Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-checkbox-box' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .tp-nav-icon' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_icon_box_width',
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
                    '{{WRAPPER}} .tp-checkbox-box' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-nav-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_responsive_control(
            'tab_icon_box_height',
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
                    '{{WRAPPER}} .tp-checkbox-box' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-nav-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        ); 

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_icon_box_border',
                'selector' => '{{WRAPPER}} .tp-checkbox-box',
            ]
        );

        $this->add_responsive_control(
            'tab_icon_box_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-checkbox-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .tp-nav-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_input_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Input Box', 'tp-elements' ),
                'separator' => 'before',
            ]
        ); 

        $this->add_responsive_control(
            'tab_icon_control_width',
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
                    '{{WRAPPER}} .tp-checkbox-control' => 'width: {{SIZE}}{{UNIT}};'
                ],    
                'separator' => 'before', 
            ]
        );

        $this->add_responsive_control(
            'tab_icon_control_height',
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
                    '{{WRAPPER}} .tp-checkbox-control' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        ); 

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_icon_control_border',
                'selector' => '{{WRAPPER}} .tp-checkbox-control',
            ]
        );

        $this->add_responsive_control(
            'tab_icon_control_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-checkbox-control' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_input_check_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Check Box', 'tp-elements' ),
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'tab_icon_active_color',
            [
                'label' => esc_html__( 'Background Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-checkbox-item-inner.active .tp-checkbox-control::after' => 'background-color: {{VALUE}};'
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_icon_active_width',
            [
                'label' => esc_html__( 'Button Size', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-checkbox-item-inner.active .tp-checkbox-control::after' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_icon_active_border',
                'selector' => '{{WRAPPER}} .tp-checkbox-item-inner.active .tp-checkbox-control::after',
            ]
        );

        $this->add_responsive_control(
            'tab_icon_active_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-checkbox-item-inner.active .tp-checkbox-control::after' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->end_controls_section();
       
        //start content styling

        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'tp_tab_content_align',
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
					'{{WRAPPER}} .tp-checkbox-label' => 'text-align: {{VALUE}};',
				],
			]
		);

        $this->add_control(
            'tab_title_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'tp-elements' ),
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'tab_title_color',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-tab-advance-wrapper ul li span .title' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_title_typography',
                'selector' => '{{WRAPPER}} .tp-tab-advance-wrapper ul li span .title',
                
            ]
        );

        $this->add_responsive_control(
            'tab_title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-checkbox-label .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'tab_subtitle_heading',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Subtitle', 'tp-elements' ),
                'separator' => 'before',
            ]
        ); 

        $this->add_control(
            'tab_subtitle_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-tab-advance-wrapper ul li span .subtitle' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_subtitle_typography',
                'selector' => '{{WRAPPER}} .tp-tab-advance-wrapper ul li span .subtitle',
                
            ]
        );

        $this->end_controls_section();

    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $tabs = $this->get_settings_for_display('tabs');  
        $settings = $this->get_settings_for_display();  
        $id_int = substr( $this->get_id_int(), 0, 3 ); 
        ?>

        <div class="tp-tab-advance-section <?php echo esc_attr( $settings['type'] ); ?>"> 

            <div class="tp-tab-advance-wrapper d-flex <?php if( $settings['type'] == 'horizontal' ) : ?> flex-column <?php else : ?> <?php endif; ?> controler-tab-class" >        
                <ul class="nav " id="v-pills-tab" role="tablist" aria-orientation="<?php echo $settings['type'];?>">
                    <?php
                    $unique = rand(20124535,3554120);
                    $x = 0;
                    $y = 1;
                    foreach ( $tabs as $index => $item ) :
                        $x++;
                        $span = $y++;

                        if($x == 1){
                            $active_tab = 'active';
                        }else{
                            $active_tab = '';
                        }

                        $tab_count = $index + 1;
                        $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

                        $this->add_render_attribute( $tab_title_setting_key, [
                            'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                            'class' => [ 'elementor-tab-title', 'elementor-tab-desktop-title' ],
                            'data-tab' => $tab_count,
                            'role' => 'tab',
                            'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                        ] ); 

                        ?>           

                        <?php if( $item['button_type'] == 'button_iconbox' ) : ?>
                        <li class="tp-iconbox-item ">
                            <div class="tp-iconbox-item-inner tp-icon-position-<?php echo esc_attr( $item['icon_position_set'] ); ?> <?php echo $active_tab;?>" id="v-pills<?php echo esc_html($x);?><?php echo esc_html($unique);?>" data-bs-toggle="pill" data-bs-target="#v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-controls="v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-selected="false">
                                <?php if( $item['icon_type'] == 'image' && !empty( $item['selected_image'] ) ) { ?>
                                <span class="tp-nav-icon"><img src="<?php echo esc_url($item['selected_image']['url']);?>" alt="image"/></span>
                                <?php } else { ?>
                                <span class="tp-nav-icon"><?php echo \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?></span>
                                <?php } ?>  
                                <span class="tp-nav-button tp-subtitle-position-<?php echo esc_attr( $item['subtitle_position_set'] ); ?>">
                                    <?php if( !empty( $item['tab_subtitle'] ) && $item['enable_tab_subtitle'] == 'yes' ) : ?>
                                    <span class="subtitle"><?php echo esc_html($item['tab_subtitle']); ?></span>
                                    <?php endif; ?>
                                    <?php if( !empty( $item['tab_title'] ) ) : ?>
                                    <span class="title"><?php echo esc_html($item['tab_title']); ?></span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </li>
                        <?php endif; ?>

                        <?php if( $item['button_type'] == 'button_checkbox' ) : ?>

                        <li class="tp-checkbox-item">
                            <div class="tp-checkbox-item-inner tp-icon-position-<?php echo esc_attr( $item['icon_position_set'] ); ?> <?php echo $active_tab;?>" id="v-pills<?php echo esc_html($x);?><?php echo esc_html($unique);?>" data-bs-toggle="pill" data-bs-target="#v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-controls="v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-selected="false">
                                <span class="tp-checkbox-box">
                                    <input type="radio" class="tp-checkbox-input" id="choice1-<?php echo esc_attr( $x ); ?>" name="choice1">
                                    <span class="tp-checkbox-control"></span>
                                </span>
                                <span class="tp-checkbox-label tp-subtitle-position-<?php echo esc_attr( $item['subtitle_position_set'] ); ?>">
                                    <?php if( !empty( $item['tab_subtitle'] ) && $item['enable_tab_subtitle'] == 'yes' ) : ?>
                                    <span class="subtitle"><?php echo esc_html($item['tab_subtitle']); ?></span>
                                    <?php endif; ?>
                                    <?php if( !empty( $item['tab_title'] ) ) : ?>
                                    <span class="title"><?php echo esc_html($item['tab_title']); ?></span>
                                    <?php endif; ?>
                                </span>
                            </div>
                        </li>

                        <?php endif; ?>

                        <?php if( $item['button_type'] == 'button_normal' ) : ?>

                        <li class="tp-button-item">
                            <span class="tp-nav-button tp-subtitle-position-<?php echo esc_attr( $item['subtitle_position_set'] ); ?> <?php echo $active_tab;?>" id="v-pills<?php echo esc_html($x);?><?php echo esc_html($unique);?>" data-bs-toggle="pill" data-bs-target="#v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-controls="v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-selected="false">
                            
                                <?php if( !empty( $item['tab_subtitle'] ) && $item['enable_tab_subtitle'] == 'yes' ) : ?>
                                <span class="subtitle"><?php echo esc_html($item['tab_subtitle']); ?></span>
                                <?php endif; ?>
                                <?php if( !empty( $item['tab_title'] ) ) : ?>
                                <span class="title"><?php echo esc_html($item['tab_title']); ?></span>
                                <?php endif; ?>

                            </span>
                        </li>

                        <?php endif; ?>

                    <?php endforeach; ?>                    
                
                </ul>

                <div class="tp-tab-content" id="v-pills-tabContent">
                
                    <?php
                    $x = 0;
                    foreach ( $tabs as $index => $item ) :
                    $tab_count = $index + 1;
                    $x++;
                    if($x == 1){
                        $active_tab = 'active show';
                    }else{
                        $active_tab = '';
                    }
                    $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                    $tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

                    $this->add_render_attribute( $tab_content_setting_key, [
                        'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
                        'data-tab' => $tab_count,
                        'role' => 'tabpanel',
                    ] );

                    $this->add_render_attribute( $tab_title_mobile_setting_key, [
                        'class' => [ 'elementor-tab-title', 'elementor-tab-mobile-title' ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                    ] );

                    $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );                       
                    ?>                
                
                    <div class="tab-pane fade <?php echo esc_attr($active_tab);?>" id="v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" role="tabpanel">
                        <!-- start tab content -->
                        <?php if ( $item['content_location'] == 'shortcodes' && !empty( $item['tab_shortcode'] ) ) : ?>
                        <div class="tp-tab-content-wrapper">
                            <?php echo do_shortcode( $item['tab_shortcode'] ); ?>
                        </div>
                        <?php endif; ?>
                        <?php if ( $item['content_location'] == 'editor' && !empty( $item['tab_content'] ) ) : ?>
                        <div class="tp-tab-content-wrapper">
                            <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>
                        </div>
                        <?php endif; ?>
                        <!-- start tab content End -->     
                    </div>
                    <?php endforeach; ?>
                
                </div>
            </div>

        </div>

        <?php
    }
}