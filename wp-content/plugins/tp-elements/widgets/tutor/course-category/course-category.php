<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Course_Category_Widget extends \Elementor\Widget_Base {

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
		return 'tp-course-category';
	}		

	/**
	 * Get widget title.
	 *
	 * Retrieve rsgallery widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'TP Course Category', 'tp-elements' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve rsgallery widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'glyph-icon flaticon-blogging';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the rsgallery widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
        return [ 'pielements_category' ];
    }


	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {		

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content Global', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'course_grid_source',
			[
				'label'   => esc_html__( 'Cetegory Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dynamic',				
				'options' => [
					'dynamic' => esc_html__('Dynamic', 'tp-elements'),					
					'slider' => esc_html__('Slider', 'tp-elements'),						
				],											
			]
		);

		$this->add_control(
			'course_grid_style',
			[
				'label'   => esc_html__( 'Category Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
                    'style1' => esc_html__( 'Style 1', 'tp-elements'),
				],
			]
		);

        $this->add_control(
            'messonry_show_hide',
            [
                'label' => esc_html__( 'Enable Massonry ?', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',               
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'enable_item_gutter',
            [
                'label' => esc_html__( 'Enable Gutter Space ?', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'tp-elements' ),
                'label_off' => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default' => 'no',
                'condition' => [
                    'course_grid_source' => ['dynamic'],
                ],
            ]
        );
        
        $this->add_control(
            'categories',
            [
                'label' => __('Select Categories', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_categories_options(),
                'multiple' => true,
                'default' => [], // Default to showing all categories
            ]
        );

        $this->add_control(
            'categories_per_page',
            [
                'label' => __('Categories Per Page', 'tp-elements'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10, // Default value
                'min' => 1,      // Minimum value
                'step' => 1,     // Increment step
            ]
        );

        $this->add_control(
            'course_image',
            [
                'label' => esc_html__( 'Image Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'condition' => [
                    'course_image' => 'yes',
                ],
                'separator' => 'before',
            ]
        ); 
       
		$this->add_control(
			'image_hover_effect',
			[
				'label'   => esc_html__( 'Image Effect', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no_effect',	
				'options' => [
					'no_effect' => 'No Effect',
					'zoomin_effect' => 'Zoom In Effect',				
					'buzz_effect' => 'Buzz Effect',				
				],											
			]
		);

        $this->add_control(
			'image_gray',
			[
				'label' => esc_html__( 'Enable Image Grayscale', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition' => [
                    'course_image' => 'yes',
                ],
			]
		);

        $this->add_control(
            'content_show_hide',
            [
                'label' => esc_html__( 'Description Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_word_show',
            [
                'label' => esc_html__( 'Show Content Limit', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'tp-elements' ),
                'separator' => 'before',
                'condition' => [
                    'content_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'dynamic_col_xxl',
            [
                'label'   => esc_html__( 'Wide Screen > 1366px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '4',
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                
                ],
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );
    
        $this->add_control(
            'dynamic_col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1200px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' =>'4',
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                
                ],
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );
    
        $this->add_control(
            'dynamic_col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1024px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' =>'4',
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                
                ],
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],
                'separator' => 'before',                            
            ]
            
        );

        $this->add_control(
            'dynamic_col_md',
            [
                'label'   => esc_html__( 'Laptop > 880px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' =>'6',         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                    
                ],
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'dynamic_col_sm',
            [
                'label'   => esc_html__( 'Tablets > 576px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '6',         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'dynamic_col_xs',
            [
                'label'   => esc_html__( 'Tablets < 575px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '12',         
                'options' => [
                    '12' => esc_html__( '1 Column', 'tp-elements' ), 
                    '6' => esc_html__( '2 Column', 'tp-elements' ),
                    '4' => esc_html__( '3 Column', 'tp-elements' ),
                    '3' => esc_html__( '4 Column', 'tp-elements' ),
                    '2' => esc_html__( '6 Column', 'tp-elements' ),               
                ],
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button Settings', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
            'button_show_hide',
            [
                'label' => esc_html__( 'Read More Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'btn_text',
			[
                'label'       => esc_html__( 'Button Text', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'View Category',
                'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
                'separator'   => 'before',
                'condition'   => [
                    'button_show_hide' => 'yes',
                ]
			]
		);


		$this->add_control(
			'btn_icon',
			[
                'label'     => esc_html__( 'Icon', 'tp-elements' ),
                'type'      => Controls_Manager::ICON,
                'options'   => tp_framework_get_icons(),				
                'default'   => 'fa fa-angle-right',
                'separator' => 'before',
                'condition' => [
                    'button_show_hide' => 'yes',
                ]			
			]
		);
				
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Category Item Style', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'course_item_direction',
            [
                'label' => esc_html__( 'Flex Direction', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'column' => [
                        'title' => esc_html__( 'Column', 'tp-elements' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'row' => [
                        'title' => esc_html__( 'Row', 'tp-elements' ),
                        'icon' => 'eicon-justify-center-v',
                    ],
                ],
                'default' => 'column',
                'selectors' => [
                    '{{WRAPPER}} .course-category-item' => 'flex-direction: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_item_align',
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
                    '{{WRAPPER}} .course-category-item' => 'align-items: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_item_gap',
            [
                'label' => esc_html__( 'Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .course-category-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .course-category-item',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'selector' => '{{WRAPPER}} .course-category-item',
                
            ]
        );

        $this->add_control(
		    'background_hover',
		    [
		        'label' => esc_html__( 'Hover Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'cat_s_border',
				'selector' => '{{WRAPPER}} .course-category-item',
                
			]
		);

        $this->add_control(
		    'cat_s_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_control(
            'cat_s_border_radius',
            [
                'label' => esc_html__( 'Item Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .course-category-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}} .themephi-category-grid1.course-category-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],              
            ]
        );

        $this->add_responsive_control(
            'blog_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .course-category-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_bottom_spacing',
            [
                'label' => esc_html__( 'Item Bottom Spacing', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .course-category-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themephi-category-grid .course-category-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        		        
		$this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,  
				'condition' => [
					'course_grid_source' => 'slider',
				],           
            ]
        );

        $this->add_control(
            'col_xxl',
            [
                'label'   => esc_html__( 'Wide Screen > 1366px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '3',
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1200px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '3',
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',            
            ]
        );
    
        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1024px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '3',
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                 
                ],
                'separator' => 'before',                            
            ]
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Laptop > 880px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' =>'2',         
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 576px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '2',         
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                  
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 575px', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '1',         
                'options' => [
                    '1' => esc_html__( '1 Column', 'tp-elements' ), 
                    '2' => esc_html__( '2 Column', 'tp-elements' ),
                    '3' => esc_html__( '3 Column', 'tp-elements' ),
                    '4' => esc_html__( '4 Column', 'tp-elements' ),
                    '5' => esc_html__( '5 Column', 'tp-elements' ),
                    '6' => esc_html__( '6 Column', 'tp-elements' ),                
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'tp_slider_effect',
            [
                'label' => esc_html__('Slider Effect', 'tp-elements'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
					'default' => esc_html__('Default', 'tp-elements'),					
					'fade' => esc_html__('Fade', 'tp-elements'),
					'flip' => esc_html__('Flip', 'tp-elements'),
					'cube' => esc_html__('Cube', 'tp-elements'),
					'coverflow' => esc_html__('Coverflow', 'tp-elements'),
					'creative' => esc_html__('Creative', 'tp-elements'),
					'cards' => esc_html__('Cards', 'tp-elements'),
                ],
            ]
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '1',         
                'options' => [
                    '1' => esc_html__( '1 Item', 'tp-elements' ),
                    '2' => esc_html__( '2 Item', 'tp-elements' ),
                    '3' => esc_html__( '3 Item', 'tp-elements' ),
                    '4' => esc_html__( '4 Item', 'tp-elements' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );      

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '3000',          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'tp-elements' ),
                    '2000' => esc_html__( '2 Seconds', 'tp-elements' ), 
                    '3000' => esc_html__( '3 Seconds', 'tp-elements' ), 
                    '4000' => esc_html__( '4 Seconds', 'tp-elements' ), 
                    '5000' => esc_html__( '5 Seconds', 'tp-elements' ), 
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                          
            ]
            
        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__( 'Autoplay Interval', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => '3000',          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'tp-elements' ), 
                    '4000' => esc_html__( '4 Seconds', 'tp-elements' ), 
                    '3000' => esc_html__( '3 Seconds', 'tp-elements' ), 
                    '2000' => esc_html__( '2 Seconds', 'tp-elements' ), 
                    '1000' => esc_html__( '1 Seconds', 'tp-elements' ),     
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__( 'Stop On Interaction', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__( 'Stop on Hover', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),              
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],                                                      
            ]
            
        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__( 'Loop', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'tp-elements' ),
                    'false' => esc_html__( 'Disable', 'tp-elements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
			'pagination_type',
			[
				'label'   => esc_html__( 'Pagination Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'pagination_default',				
				'options' => [
					'pagination_default' => esc_html__('Default', 'tp-elements'),					
					'pagination_dynamic' => esc_html__('Dynamic', 'tp-elements'),									
					'pagination_progressbar' => esc_html__('Progressbar', 'tp-elements'),									
					'pagination_fraction' => esc_html__('Fraction', 'tp-elements'),									
				],
				'separator' => 'before',										
			]
		);

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Middle Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          
            ]
        ); 

         $this->add_control(
            'item_gap_custom_bottom',
            [
                'label' => esc_html__( 'Item Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,               
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],          

                'selectors' => [
                    '{{WRAPPER}} .themephi-addon-slider .testimonial-item' => 'margin-bottom:{{SIZE}}{{UNIT}};',                    
                ],
            ]
        ); 
                
        $this->end_controls_section();

        $this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Category Image Style', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'imge_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'selector' => '{{WRAPPER}} .course-category-image',
                
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'image_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
    
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'course_image_border',
				'selector' => '{{WRAPPER}} .course-category-image',
			]
		);

        $this->add_control(
            'course_image_border_radius',
            [
                'label' => esc_html__( 'Item Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .course-category-image, {{WRAPPER}} .course-category-image img, {{WRAPPER}} .course-category-image::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],              
            ]
        );
                
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .course-category-image',
            ]
        );

        $this->add_responsive_control(
			'image_width',
			[
				'label' => esc_html__( 'Width', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .course-category-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'image_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .course-category-image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'course_image_overlay',
            [
                'label'   => esc_html__( 'Background Overlay', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hide',               
                'options' => [                    
                    'hide' => 'Hide',
                    'show' => 'Show',                             
                ],      
                'prefix_class' => 'tp-blog-overlay-', 
                                               
            ]
        );

        $this->add_control(
            'course_image_overlay_color',
            [
                'label' => esc_html__( 'Overlay Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-image::before' => 'background-color: {{VALUE}};',
                ],      
                'condition' => [
                    'course_image_overlay' => 'show'
                ]          
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_title',
            [
                'label' => esc_html__( 'Title & Description Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .title a' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .title a:hover' => 'color: {{VALUE}};',
                ],                
            ]
            
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Title Border Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .title:hover a' => 'background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, {{VALUE}}), color-stop(50%, transparent)); background-image: linear-gradient(to right, {{VALUE}} 50%, transparent 50%);',
                ],                
            ]
        );


        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'tp-elements' ),
				
				'selector' => 
                    '{{WRAPPER}} .course-category-item .course-category-content .title',
			]
		);

        $this->add_responsive_control(
            'title_content_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_content_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'title_border',
		        'selector' => '{{WRAPPER}} .course-category-item .course-category-content .title'               
		    ]
		);

        $this->add_control(
		    'course_number_title',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Course Number', 'tp-elements' ),
		    ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'number_title_typography',
				'label' => esc_html__( 'Title Typography', 'tp-elements' ),
				
				'selector' => 
                    '{{WRAPPER}} .course-category-item .course-category-content .tp-course-number',
			]
		);

        $this->add_control(
            'course_number',
            [
                'label' => esc_html__( 'Description Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .tp-course-number' => 'color: {{VALUE}};',
                ],                
            ]
        );
        
        $this->add_control(
		    'course_desc_title',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Course Description', 'tp-elements' ),
		    ]
		);

        $this->add_control(
            'des_color',
            [
                'label' => esc_html__( 'Description Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content p.txt ' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .themephi-category-grid1 .course-category-content p.txt ' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'des_typography',
                'label' => esc_html__( 'Description Typography', 'tp-elements' ),
                
                'selector' => 
                    '{{WRAPPER}} .course-category-item .course-category-content p.txt ',
                    '{{WRAPPER}} .themephi-category-grid1 .course-category-content p.txt ',
            ]
        );

        $this->add_responsive_control(
            'des_content_padding',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content p.txt ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .themephi-category-grid1 .course-category-content p.txt ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();


        $this->start_controls_section(
            'section_content_sec',
            [
                'label' => esc_html__( 'Content Style', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
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
                    '{{WRAPPER}} .course-category-content, {{WRAPPER}} .course-category-content .txt' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .blog-meta' => 'justify-content: {{VALUE}}',
                ]
            ]
        );

        
        $this->add_responsive_control(
            'vertical_alignment',
            [
                'label' => esc_html__( 'Vertical Alignment', 'tp-elements' ),
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
                'condition' => [
                    'course_grid_style' => ['style11'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .course-category-content' => 'align-items: {{VALUE}}',
                ]
            ]
        );

        $this->add_control(
            'content__bg_color',
            [
                'label' => esc_html__( 'Content Area Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content' => 'background:{{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'blog_contents_padding',
            [
                'label'=> esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        $this->add_responsive_control(
            'blog_contents_margin',
            [
                'label'=> esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 30,
                ],  
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_control(
		    'blog_contents_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
            'blog_category_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'prefix_class' => 'tp-blog-position-', 
                                               
            ]
        );

        $this->end_controls_section();

		//Read More Style
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Read More Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		    ]
		);

		$this->add_responsive_control(
		    'blog_btn_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content .btn-part a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'btn_typography',
		        'selector' => '{{WRAPPER}} .course-category-item .course-category-content .btn-part a',
		        
		    ]
		);

		$this->add_control(
		    'blog_btn_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content .btn-part a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_btn_box_shadow',
		        'selector' => '{{WRAPPER}} .course-category-item .course-category-content .btn-part a',
		    ]
		);
        $this->add_control(
            'top_border_color',
            [
                'label' => esc_html__( 'Top Border Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .course-category-item .course-category-content .btn-btm' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .themephi-category-grid1 .course-category-content .btn-btm' => 'border-color: {{VALUE}};',
                ],  
                'condition' => [
                    'course_grid_style' => 'default',
                ]              
            ]
        );

		$this->add_control(
		    'hr',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_blog_btn_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'link_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content .btn-part a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content .btn-part a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'btn_icon_translate',
		    [
		        'label' => esc_html__( 'Icon Translate X', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content .btn-part a i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .course-category-item .course-category-content .btn-part a i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .course-category-item .course-category-content .btn-part a i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_border',
		        'selector' => '{{WRAPPER}} .course-category-item .course-category-content .btn-part a'               
		    ]
		);
        

		$this->end_controls_tab();


		$this->start_controls_tab(
		    '_blog_btn_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content:hover .btn-part a,
                    {{WRAPPER}} .course-category-item .btn-part a:hover, 
                    {{WRAPPER}} .course-category-item .course-category-content:focus .btn-part' => 'color: {{VALUE}}',
                   
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .course-category-item .course-category-content:hover .btn-part a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_btn_hover_icon_translate',
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
		            '{{WRAPPER}} .course-category-item:hover .course-category-content .btn-part a i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .course-category-item:hover .course-category-content .btn-part a i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .course-category-item:hover .course-category-content .btn-part a i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .course-category-item:hover .course-category-content .btn-part a i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);
        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'btn_border_hover',
		        'selector' => '{{WRAPPER}} .course-category-item .course-category-content .btn-part a:hover'               
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Start Blog Pagination Style
		$this->start_controls_section(
		    '_blog_pagination_style',
		    [
		        'label' => esc_html__( 'Pagination Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition' => [
                    'pagination_show_hide' => 'yes',
                ]
		    ]
		);

        $this->add_responsive_control(
		    'blog_pagi_margin',
		    [
		        'label' => esc_html__( 'Wrapper Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-pagination-area' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
            'pagination_alignment',
            [
                'label' => esc_html__( 'Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ],

                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .themephi-pagination-area' => 'text-align: {{VALUE}}',
                ]
            ]
        );
        
		$this->add_control(
		    'hr_pagi',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_pagi_button' );

		$this->start_controls_tab(
		    '_pagi_btn_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

        $this->add_control(
		    'blog_pagi_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_pagiesc_html__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagi_btn_border',
		        'selector' => '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links a'               
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_shadow',
				'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
				'selector' => '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links a',
			]
		);

        $this->add_responsive_control(
		    '_pagi_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    '_pagi_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();


		$this->start_controls_tab(
		    '_pagi_btn_hover_active',
		    [
		        'label' => esc_html__( 'Hover/Active', 'tp-elements' ),
		    ]
		);

        $this->add_control(
		    'blog_pagi_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span.current' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_pagiesc_hover__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span.current' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagi_hover_btn_border',
		        'selector' => '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span.current'               
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_hover_shadow',
				'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
				'selector' => '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span.current',
			]
		);

        $this->add_responsive_control(
		    '_pagi_active_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-category-grid .themephi-pagination-area .nav-links span.current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

		// End Blog Pagination Style

	}

	/**
	 * Render rsgallery widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
        $sstyle = $settings['course_grid_style'];

		if( $settings['course_grid_source'] == 'slider' ) {

			$col_xxl          = $settings['col_xxl'];
			$col_xxl          = !empty($col_xxl) ? $col_xxl : 3;
			$slidesToShow    = $col_xxl;
			$autoplaySpeed   = $settings['slider_autoplay_speed'];
			$autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
			$interval        = $settings['slider_interval'];
			$interval        = !empty($interval) ? $interval : '3000';
			$slidesToScroll  = $settings['slides_ToScroll'];
			$slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
			$pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
			$pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
                  
			$infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
			$centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
            $col_xl          = $settings['col_xl'];
			$col_lg          = $settings['col_lg'];
			$col_md          = $settings['col_md'];
			$col_sm          = $settings['col_sm'];
			$col_xs          = $settings['col_xs'];
			$item_gap        = $settings['item_gap_custom']['size'];
			$item_gap        = !empty($item_gap) ? $item_gap : '30';

			$unique          = rand(289012,35120);

			if( $slider_autoplay =='true' ){
				$slider_autoplay = 'autoplay: { ' ;
				$slider_autoplay .= 'delay: '.$interval;
				if(  $pauseOnHover =='true'  ){
					 $slider_autoplay .= ', pauseOnMouseEnter: true';
				}else{
					$slider_autoplay .= ', pauseOnMouseEnter: false';
				}
				if(  $pauseOnInter =='true'  ){
					 $slider_autoplay .= ', disableOnInteraction: true';
				}else{
					$slider_autoplay .= ', disableOnInteraction: false';
				}
				$slider_autoplay .= ' }';
			}else{
				$slider_autoplay = 'autoplay: false' ;
			}


            $effect = $settings['tp_slider_effect'];

            if($effect== 'fade'){
                $seffect = "effect: 'fade', fadeEffect: { crossFade: true, },";
            }elseif($effect== 'cube'){
                $seffect = "effect: 'cube',";
            }elseif($effect== 'flip'){
                $seffect = "effect: 'flip',";
            }elseif($effect== 'coverflow'){
                $seffect = "effect: 'coverflow',";
            }elseif($effect== 'creative'){
                $seffect = "effect: 'creative', creativeEffect: { prev: { translate: [0, 0, -400], }, next: { translate: ['100%', 0, 0], }, },";
            }elseif($effect== 'cards'){
                $seffect = "effect: 'cards',";
            }else{
                $seffect = '';
            }


			$pagination_type = $settings['pagination_type'] === 'pagination_progressbar' ? 'progressbar' : ($settings['pagination_type'] ==='pagination_fraction' ? 'fraction' : '');
		
			$dynamic_bullets = $settings['pagination_type'] === 'pagination_dynamic' ? 'true' : 'false';
			$pagination_class = '.tp-course-category-pagination ';
			
			if (!empty($settings['pagination_type'])) {
				$pagination = 'pagination: { ';
                if( $settings['pagination_type'] === 'pagination_progressbar' ) {
                    $pagination .= 'el: "' . $pagination_class . '", ';
                    $pagination .= 'type: "' . $pagination_type . '", ';
                } elseif( $settings['pagination_type'] === 'pagination_fraction' ) {
                    $pagination .= 'el: "' . $pagination_class . '", ';
                    $pagination .= 'type: "' . $pagination_type . '", ';
                } elseif( $settings['pagination_type'] === 'pagination_dynamic' ) {
                    $pagination .= 'el: "' . $pagination_class . '", ';
                    $pagination .= 'dynamicBullets: ' . $dynamic_bullets;
                } else {
                    $pagination .= 'el: "' . $pagination_class . '", ';
                }
				$pagination .= ' }';
			}


		}


        ?>

		<div class="themephi-category-grid tp-course-category--<?php echo esc_attr( $settings['course_grid_style'] ); ?> <?php echo esc_attr( $settings['image_hover_effect'] ); ?>">
            <?php if( $settings['course_grid_source'] == 'dynamic' ) : ?>           
            <div class="tp-course-category-dynamic-wrapper">
                <div class="row category-gird-item <?php if ( $settings['enable_item_gutter'] == 'yes' ) : ?>  g-0 <?php endif; ?> " <?php if( $settings['messonry_show_hide'] == 'yes' ) : ?> data-masonry=' { "columnWidth": ".grid-item", "percentPosition": false }' <?php endif; ?> >
                <?php elseif($settings['course_grid_source'] == 'slider') : ?>   
            <div class="swiper tp_course-category-<?php echo esc_attr($unique); ?> ">
                <div class="swiper-wrapper ">
                <?php else : ?>
                <?php endif; ?>
                    <?php

                    $selected_categories = $settings['categories'];
                    $image_size = $settings['thumbnail_size']; 

                    $categories_per_page = !empty($settings['categories_per_page']) ? intval($settings['categories_per_page']) : 2;
                    $paged = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
                    $offset = ($paged - 1) * $categories_per_page;

                    $args = [
                        'taxonomy' => 'course-category',
                        'hide_empty' => false,
                        'number' => $categories_per_page,
                        'offset' => $offset,
                    ];

                    if (!empty($selected_categories)) {
                        $args['slug'] = $selected_categories;
                    }
                    $categories = get_terms($args);
                    $total_categories = wp_count_terms('category', ['taxonomy' => 'course-category', 'hide_empty' => false]);

                    if(!empty($settings['content_word_show'])){
                        $limit = $settings['content_word_show']; 
                    }
                    else{
                        $limit = 20;
                    }

                                                        

                    if (!empty($categories)) {
            
                        foreach ($categories as $category) {

                        $image_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                        $image_url = $image_id ? wp_get_attachment_image_url($image_id, $image_size) : '';
                        $category_link = get_term_link($category->term_id);
                        $category_description = wp_trim_words(category_description($category->term_id), $limit);
                        $course_count = $category->count;

                        
                        if( $settings['course_grid_source'] == 'dynamic' ) {

                            if($sstyle){
                                require plugin_dir_path(__FILE__)."/dynamic/$sstyle.php";
                            }else{
                                require plugin_dir_path(__FILE__)."/dynamic/style1.php";
                            }
                        }

                        if( $settings['course_grid_source'] == 'slider' ) {

                            if($sstyle){
                                require plugin_dir_path(__FILE__)."/slider/$sstyle.php";
                            }else{
                                require plugin_dir_path(__FILE__)."/slider/style1.php";
                            }
                        }

                        }
                    } else {
                        echo '<p>' . __('No categories found.', 'tp-elements') . '</p>';
                    }

                    // Pagination
                    $total_pages = ceil($total_categories / $categories_per_page);
                    if( $settings['pagination_show_hide'] == 'yes' ) {

                        if ($total_pages > 1) {
                            echo '<div class="tp-course-category-pagination">';
                            echo paginate_links([
                                'total' => $total_pages,
                                'current' => $paged,
                                'format' => '?paged=%#%',
                                'prev_text' => __('« Previous', 'tp-elements'),
                                'next_text' => __('Next »', 'tp-elements'),
                            ]);
                            echo '</div>';
                        }

                    }
                    
                    ?>     

            <?php if( $settings['course_grid_source'] == 'dynamic' || $settings['course_grid_source'] == 'slider' ) : ?>      
                </div>   
            </div>   
                        	    
            <?php 
            endif; 

            
            ?>  

		</div>

        <?php if( $settings['course_grid_source'] == 'slider' ) : ?>
        <script>
            jQuery(document).ready(function(){
					
                var swiper = new Swiper(".tp_course-category-<?php echo esc_attr($unique); ?> ", {				
                    slidesPerView: <?php echo $slidesToShow;?>,
                    <?php echo $seffect; ?>
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    loop: <?php echo esc_attr($infinite ); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                    spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    <?php echo $pagination; ?>,
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    navigation: {
                        nextEl: ".tp-course-category-slide-next",
                        prevEl: ".tp-course-category-slide-prev",
                    },
                    breakpoints: {
                        0: { slidesPerView: <?php echo $col_xs;?>},
                        <?php
                        echo (!empty($col_sm)) ?  '575: { slidesPerView: '. $col_sm .' },' : '';
                        echo (!empty($col_md)) ?  '779: { slidesPerView: '. $col_md .' },' : '';
                        echo (!empty($col_lg)) ?  '1023: { slidesPerView: '. $col_lg .' },' : '';
                        echo (!empty($col_xl)) ?  '1199: { slidesPerView: '. $col_xl .' },' : '';
                        ?>
                        1366: {
                            slidesPerView: <?php echo esc_attr($col_xxl); ?>,
                            spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                        }
                    }
                });
            });
        </script>
	   <?php
        endif; 
	}

    function get_categories_options() {
        $categories = get_categories();
        $options = [];

        foreach ($categories as $category) {
            $options[$category->slug] = $category->name;
        }

        return $options;
    }

} 
