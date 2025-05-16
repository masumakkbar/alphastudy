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

class Themephi_Elementor_Courses_Widget extends \Elementor\Widget_Base {

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
		return 'tp-courses';
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
		return esc_html__( 'TP Courses', 'tp-elements' );
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

		$post_categories = get_terms( 'course-category' );

        $post_options = [];
        foreach ( $post_categories as $category ) {
            $post_options[ $category->slug ] = $category->name;
        }


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
				'label'   => esc_html__( 'Course Type', 'tp-elements' ),
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
				'label'   => esc_html__( 'Blog Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
                    'style1' => esc_html__( 'Style 1', 'tp-elements'),
                    'style2' => esc_html__( 'Style 2', 'tp-elements'),
                    'style3' => esc_html__( 'Style 3', 'tp-elements'),
                    'style4' => esc_html__( 'Style 4', 'tp-elements'),
                    'extraCode' => esc_html__( 'Extra Code', 'tp-elements'),
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
			'category',
			[
				'label'   => esc_html__( 'Category', 'tp-elements' ),				
				'type'        => Controls_Manager::SELECT2,
                'options'     => $post_options,
                'default'     => [],
				'multiple' => true,	
				'separator' => 'before',		
			]
		);

        $this->add_control(
			'show_filter',
			[
				'label'   => esc_html__( 'Show Filter', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_hide',	
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',				
				],	
				'condition' => [
					'course_grid_source' => ['dynamic'],
				],										
			]
		);

		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__( 'Filter Title', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
					'show_filter' => 'filter_show',
					'course_grid_source' => ['dynamic'],
				],	
				'separator' => 'before',
			]
		);

		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Course Show Per Page', 'tp-elements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '6', 'tp-elements' ),
				'separator' => 'before',
			]
		);

        $this->add_control(
            'title_word_count',
            [
                'label' => esc_html__( 'Title Word Count', 'tp-elements' ),
                'type' => Controls_Manager::NUMBER,  
                'placeholder' => esc_html__( '10', 'tp-elements' ),           
            ]
        );

        $this->add_control(
            'post_offset',
            [
                'label' => esc_html__( 'Offset', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',
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
                'name' => 'course_image_size',
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
                'default' => 'yes',
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
            'meta_section',
            [
                'label' => esc_html__( 'Meta Settings', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'course_meta_show_hide',
            [
                'label' => esc_html__( 'Meta Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'course_author_show_hide',
            [
                'label' => esc_html__( 'Author Show / Hide', 'tp-elements' ),
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
            'course_rating_show_hide',
            [
                'label' => esc_html__( 'Rating Show / Hide', 'tp-elements' ),
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
            'course_price_show_hide',
            [
                'label' => esc_html__( 'Price Show / Hide', 'tp-elements' ),
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
            'course_cat_show_hide',
            [
                'label' => esc_html__( 'Category Show / Hide', 'tp-elements' ),
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
            'course_duration_show_hide',
            [
                'label' => esc_html__( 'Duration Show / Hide', 'tp-elements' ),
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
            'meta_duration_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'course_duration_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'duration_icon',
			[
				'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'tp tp-clock-regular',
					'library' => 'solid',
				],
				'condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ],			
			]
		);

        $this->add_control(
            'course_wishlist_show_hide',
            [
                'label' => esc_html__( 'Bookmark Show / Hide', 'tp-elements' ),
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
            'course_lesson_show_hide',
            [
                'label' => esc_html__( 'Lesson Show / Hide', 'tp-elements' ),
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
            'meta_lesson_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'course_lesson_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'lesson_icon',
			[
				'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'tp tp-book',
					'library' => 'solid',
				],		
                'condition'   => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes',
                ]
			]
		);

        $this->add_control(
            'course_student_show_hide',
            [
                'label' => esc_html__( 'Student Show / Hide', 'tp-elements' ),
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
            'meta_student_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'course_student_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'student_icon',
			[
				'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'tp tp-user-2',
					'library' => 'solid',
				],
				'condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ],			
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
                'label' => esc_html__( 'Button Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
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
                'default'     => 'Read More',
                'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
                'separator'   => 'before',
                'condition'   => [
                    'button_show_hide' => 'yes',
                ]
			]
		);

        $this->add_control(
            'btn_switch',
            [
                'label' => esc_html__( 'Icon Show Hide', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'button_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
			'btn_icon',
			[
				'label'     => esc_html__( 'Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
                'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
                'condition' => [
                    'button_show_hide' => 'yes',
                    'btn_switch' => 'yes'
                ]
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

        // Filter Button Style 	
        $this->start_controls_section(
			'section_portfolio_style',
			[
				'label' => esc_html__( 'Filter Button', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
					'show_filter' => 'filter_show',
				],	
			]
		);

		$this->add_responsive_control(
		    'filter_wrapp_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

        $this->add_responsive_control(
            'filter_wrapp__padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_control(
		    'filter_wrapp_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter-inner' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'filter_wrapp_border',
		        'selector' => '{{WRAPPER}} .portfolio-filter-inner',
		    ]
		);

		$this->add_control(
		    'filter_wrapp_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
            'filter_btn_align',
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
                    '{{WRAPPER}} .portfolio-filter' => 'text-align: {{VALUE}}'
                ],
				'separator' => 'before',
            ]
        );

		$this->add_control(
		    'hr_fitler_btn',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

		$this->start_controls_tabs( '_tabs_filter_btn' );

		$this->start_controls_tab(
		    '_tab_filter_btn_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'filter_btn_typography',
		        'selector' => '{{WRAPPER}} .portfolio-filter button',
		    ]
		);

        $this->add_responsive_control(
		    'filter_btn_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
		    ]
		);

        $this->add_responsive_control(
            'filter_btn__padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

		$this->add_control(
		    'filter_btn_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'filter_btn_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);
		
		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'filter_btn_button_border',
		        'selector' => '{{WRAPPER}} .portfolio-filter button',
		    ]
		);

		$this->add_control(
		    'filter_btn_button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'filter_btn_button_box_shadow',
		        'selector' => '{{WRAPPER}} .portfolio-filter button',
		    ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
		    '_tab_filter_btn_hover',
		    [
		        'label' => esc_html__( 'Hover/Active', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'filter_btn_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button:hover, {{WRAPPER}} .portfolio-filter button.active' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'filter_btn_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button:hover, {{WRAPPER}} .portfolio-filter button.active' => 'background: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'filter_btn_hover_border',
		        'selector' => '{{WRAPPER}} .portfolio-filter button:hover, {{WRAPPER}} .portfolio-filter button.active',
		    ]
		);

		$this->add_control(
		    'filter_btn_hover_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .portfolio-filter button:hover, {{WRAPPER}} .portfolio-filter button.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'filter_btn_hover_box_shadow',
		        'selector' => '{{WRAPPER}} .portfolio-filter button:hover, {{WRAPPER}} .portfolio-filter button.active',
		    ]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->end_controls_section();

		$this->start_controls_section(
			'section_item_style',
			[
				'label' => esc_html__( 'Course Item', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item' => 'flex-direction: {{VALUE}}',
                ],
                // 'condition' => [
                //     'course_content_position!' => 'absolute',
                // ],
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
                    '{{WRAPPER}} .tp-course-item' => 'align-items: {{VALUE}}',
                ],
               'condition' => [
                    'course_content_position!' => 'absolute',
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
                    '{{WRAPPER}} .tp-course-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'course_item_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .tp-course-item',
                'separator' => 'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'course_item_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .tp-course-item',
            ]
        );
        
        $this->add_control(
            'course_item_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item' => 'border-style: {{VALUE}}',
                ],
        
            ]
        );
        
        $this->add_responsive_control(
            'course_item_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_item_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_item_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_item_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->add_control(
		    'course_item_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_item_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->add_control(
            'course_item_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .tp-course-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],           
            ]
        );

        $this->add_responsive_control(
            'course_item_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'course_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_image_style',
			[
				'label' => esc_html__( 'Course Image', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
        $this->add_responsive_control(
            'course_image_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .tp-course-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'course_image_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .tp-course-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_control(
            'demo_test',
            [
                'label' => esc_html__( 'Enable style', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',               
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'course_image_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'selector' => '{{WRAPPER}} .tp-course-image',
                'condition' => [
                    'demo_test' => 'yes'
                ]
            ]
        );
    
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'course_image_border',
				'selector' => '{{WRAPPER}} .tp-course-image',
			]
		);

        $this->add_control(
            'course_image_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .tp-course-image, {{WRAPPER}} .tp-course-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],              
            ]
        );
                
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'course_image_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .tp-course-image',
            ]
        );

        $this->add_control(
		    'hr_image',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);

        $this->add_responsive_control(
			'course_image_width',
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
					'{{WRAPPER}} .tp-course-image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'course_image_max_width',
			[
				'label' => esc_html__( 'Max Width', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom'],
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
					'{{WRAPPER}} .tp-course-image' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'course_image_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
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
				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .tp-course-image' => 'height: {{SIZE}}{{UNIT}};',
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
                'prefix_class' => 'tp-course-img-overlay-', 
                                               
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'course_image_overlay_color',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .tp-course-image::before',
                'condition' => [
                    'course_image_overlay' => 'show'
                ]   
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_meta_style',
            [
                'label' => esc_html__( 'Course Meta', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_responsive_control(
            'course_meta_wrap_margin',
            [
                'label' => esc_html__( 'Meta Box Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],  
                'selectors' => [
                    '{{WRAPPER}} .tp-course-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_grid_style' => ['style3', 'style4']
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_meta_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta',
            ]
        );

        $this->start_controls_tabs( '_tabs_course_meta' );

		$this->start_controls_tab(
            'meta_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta',
			]
		);

        $this->add_control(
            'course_meta_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_border__width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover',
			]
		);

        $this->add_control(
		    'course_meta_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'course_meta_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Meta Icon', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

        $this->add_control(
		    'meta_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->start_controls_tabs( '_tabs_meta_icon' );

		$this->start_controls_tab(
            'meta_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta svg .icon path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta svg .icon rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'course_meta_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_icon_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'course_meta_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'course_meta_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_meta_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'course_meta_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-common-meta .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_category_style',
            [
                'label' => esc_html__( 'Course Category', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_cat_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_category_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-meta-category',
            ]
        );

        $this->start_controls_tabs( '_tabs_course_meta_cat' );

		$this->start_controls_tab(
            'meta_cat_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_cat_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_cat_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-category',
			]
		);

        $this->add_control(
            'course_meta_cat_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_cat_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_cat_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->add_control(
            'course_meta_cat_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_cat_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'course_category_shadow',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-category',
		    ]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_cat_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_cat_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_cat_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-category:hover',
			]
		);

        $this->add_control(
		    'course_meta_cat_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-category:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_cat_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'course_category_shadow_hover',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-category:hover',
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_cat_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_cat_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_cat_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'course_meta_cat_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Category Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'course_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ],			
		    ]
		);

        $this->add_control(
		    'meta_cat_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-category .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'course_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ],			
		    ]
		);

        $this->start_controls_tabs( '_tabs_meta_cat_icon', ['condition' => [
                    'course_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]] );

		$this->start_controls_tab(
            'meta_cat_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_cat_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'course_meta_cat_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_cat_icon_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_cat_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_cat_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_cat_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_cat_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_cat_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'course_meta_cat_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-category:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-category:hover .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_cat_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'course_meta_cat_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-category:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_cat_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_cat_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_cat_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_cat_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-category .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ],			
            ]
        );

		$this->add_control(
            'course_cate_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'position: {{VALUE}};',
                ],
                                               
            ]
        );
        
		$this->add_control(
			'category_horizontal_offset',
			[
				'label' => esc_html__( 'Horizontal Orientation', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
                    'course_cate_position' => 'absolute',
                ],
			]
		);

        
        $this->add_responsive_control(
            'course_cate_position_left',
            [
                'label' => esc_html__( 'Left', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
               'condition' => [
                    'course_cate_position' => 'absolute',
                    'horizontal_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'course_cate_position_right',
            [
                'label' => esc_html__( 'Right', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
               'condition' => [
                    'course_cate_position' => 'absolute',
                    'horizontal_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'category_vertical_offset',
			[
				'label' => esc_html__( 'Vertical Orientation', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'tp-elements' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
                    'course_cate_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'course_cate_position_top',
            [
                'label' => esc_html__( 'Top', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
                'condition' => [
                    'course_cate_position' => 'absolute',
                    'vertical_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_cate_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
                'condition' => [
                    'course_cate_position' => 'absolute',
                    'vertical_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-category' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
			'course_category_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'tp-elements' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .tp-course-item .tp-meta-category' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'course_cate_position' => 'absolute',
                ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_rating_style',
            [
                'label' => esc_html__( 'Course Rating', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_rating_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_control(
		    'course_rating_typography',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating span' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],	
		    ]
		);

        $this->add_responsive_control(
            'course_meta_rating_gap',
            [
                'label' => esc_html__( 'Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating .tp-course-ratings-stars' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'course_meta_rating_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating span' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_rating_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating',
			]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_meta_rating_border',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating'               
		    ]
		);

        $this->add_responsive_control(
            'course_meta_rating_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_rating_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_rating_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_lesson_style',
            [
                'label' => esc_html__( 'Course Lesson', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_lesson_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_lesson_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson span',
            ]
        );

        $this->start_controls_tabs( '_tabs_course_lesson' );

		$this->start_controls_tab(
            'meta_lesson_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_lesson_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson span' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_lesson_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson',
			]
		);

        $this->add_control(
            'course_meta_lesson_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_lesson_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_lesson_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_lesson_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_lesson_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_lesson_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_lesson_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover span' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_lesson_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover',
			]
		);

        $this->add_control(
		    'course_meta_lesson_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_lesson_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_lesson_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_lesson_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_lesson_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'course_meta_lesson_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Category Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes'
                ],			
		    ]
		);

        $this->add_control(
		    'meta_lesson_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes'
                ],			
		    ]
		);

        $this->start_controls_tabs( '_tabs_meta_lesson_icon', ['condition' => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes'
                ]] );

		$this->start_controls_tab(
            'meta_lesson_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
                
            ]
        ); 

        $this->add_control(
            'course_meta_lesson_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon svg rect' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'course_meta_lesson_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_lesson_icon_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_lesson_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_lesson_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_lesson_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_lesson_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_lesson_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'course_meta_lesson_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover .icon svg rect' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-lesson:hover .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_lesson_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'course_meta_lesson_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_lesson_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_lesson_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_lesson_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_lesson_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-lesson .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_lesson_show_hide' => 'yes',
                    'meta_lesson_switch' => 'yes'
                ],			
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_student_style',
            [
                'label' => esc_html__( 'Course Student', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_student_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_student_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student span',
            ]
        );

        $this->start_controls_tabs( '_tabs_course_student' );

		$this->start_controls_tab(
            'meta_student_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_student_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student span' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_student_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student',
			]
		);

        $this->add_control(
            'course_meta_student_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_student_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_student_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_student_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_student_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_student_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_student_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover span' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_student_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover',
			]
		);

        $this->add_control(
		    'course_meta_student_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_student_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_student_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_student_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_student_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'course_meta_student_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Category Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ],			
		    ]
		);

        $this->add_control(
		    'meta_student_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ],			
		    ]
		);

        $this->start_controls_tabs( '_tabs_meta_student_icon', ['condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ]] );

		$this->start_controls_tab(
            'meta_student_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
                
            ]
        ); 

        $this->add_control(
            'course_meta_student_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon svg rect' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'course_meta_student_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_student_icon_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_student_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_student_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_student_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_student_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_student_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'course_meta_student_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover .icon svg rect' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .image-part .tp-meta-student:hover .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_student_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'course_meta_student_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_student_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_student_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_student_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_student_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-student .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_student_show_hide' => 'yes',
                    'meta_student_switch' => 'yes'
                ],			
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_duration_style',
            [
                'label' => esc_html__( 'Course Duration', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_duration_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_duration_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration span',
            ]
        );

        $this->start_controls_tabs( '_tabs_course_duration' );

		$this->start_controls_tab(
            'meta_duration_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_duration_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration span' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_duration_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-duration',
			]
		);

        $this->add_control(
            'course_meta_duration_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_duration_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_duration_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_duration_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_duration_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_duration_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_duration_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover span' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_duration_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover',
			]
		);

        $this->add_control(
		    'course_meta_duration_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_duration_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_duration_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_duration_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_duration_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'course_meta_duration_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Category Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ],			
		    ]
		);

        $this->add_control(
		    'meta_duration_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ],			
		    ]
		);

        $this->start_controls_tabs( '_tabs_meta_duration_icon', ['condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ]] );

		$this->start_controls_tab(
            'meta_duration_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
                
            ]
        ); 

        $this->add_control(
            'course_meta_duration_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'course_meta_duration_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_duration_icon_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_duration_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_duration_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_duration_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_duration_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_duration_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'course_meta_duration_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover .icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover .icon svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover .icon svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'course_meta_duration_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'course_meta_duration_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-duration:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_duration_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_duration_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_duration_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ],			
            ]
        );

        $this->add_responsive_control(
            'course_meta_duration_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-duration .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'course_duration_show_hide' => 'yes',
                    'meta_duration_switch' => 'yes'
                ],			
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_bookmark_style',
            [
                'label' => esc_html__( 'Course Bookmark', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_wishlist_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_control(
		    'course_bookmark_typography',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-bookmark span' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],	
		    ]
		);

        $this->start_controls_tabs( '_tabs_course_bookmark' );

		$this->start_controls_tab(
            'meta_bookmark_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_bookmark_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark span' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_bookmark_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-bookmark',
			]
		);

        $this->add_control(
            'course_meta_bookmark_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_meta_bookmark_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_meta_bookmark_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_meta_bookmark_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_meta_bookmark_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'meta_bookmark_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_meta_bookmark_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark:hover span' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_bookmark_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-meta-bookmark:hover',
			]
		);

        $this->add_control(
		    'course_meta_bookmark_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-meta-bookmark:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_meta_bookmark_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'course_meta_bookmark_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_bookmark_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_bookmark_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-meta-bookmark' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_price_style',
            [
                'label' => esc_html__( 'Course Price', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_price_show_hide' => 'yes',
                ],			
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_price_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price span',
            ]
        );

        $this->add_control(
            'course_meta_price_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price span' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'course_meta_price_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price',
			]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_price_border',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price'               
		    ]
		);

        $this->add_responsive_control(
            'course_meta_price_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'course_meta_price_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'course_meta_price_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'course_price_discount_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Discount', 'tp-elements' ),
                'separator' => 'before',
		    ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'course_price_del_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price del',
            ]
        );

        $this->add_control(
            'course_meta_price_del_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price del' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_responsive_control(
            'course_meta_price_del_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-meta-price del' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
        
        $this->start_controls_section(
            'section_content_style',
            [
                'label' => esc_html__( 'Course Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => esc_html__( 'Text Alignment', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content__bg_color',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content',
            ]
        );

        $this->add_responsive_control(
            'course_contents_padding',
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );  

        $this->add_responsive_control(
            'course_contents_margin',
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 

        $this->add_control(
		    'course_contents_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
            'course_content_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'position: {{VALUE}};',
                ],
                                               
            ]
        );
        
		$this->add_control(
			'horizontal_offset',
			[
				'label' => esc_html__( 'Horizontal Orientation', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Left', 'tp-elements' ),
						'icon' => 'eicon-h-align-left',
					],
					'end' => [
						'title' => esc_html__( 'Right', 'tp-elements' ),
						'icon' => 'eicon-h-align-right',
					],
				],
				'condition' => [
                    'course_content_position' => 'absolute',
                ],
			]
		);

        
        $this->add_responsive_control(
            'course_content_position_left',
            [
                'label' => esc_html__( 'Left', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
               'condition' => [
                    'course_content_position' => 'absolute',
                    'horizontal_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'course_content_position_right',
            [
                'label' => esc_html__( 'Right', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
               'condition' => [
                    'course_content_position' => 'absolute',
                    'horizontal_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'vertical_offset',
			[
				'label' => esc_html__( 'Vertical Orientation', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
				'default' => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Top', 'tp-elements' ),
						'icon' => 'eicon-v-align-top',
					],
					'end' => [
						'title' => esc_html__( 'Bottom', 'tp-elements' ),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'condition' => [
                    'course_content_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'course_content_position_top',
            [
                'label' => esc_html__( 'Top', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
                'condition' => [
                    'course_content_position' => 'absolute',
                    'vertical_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_content_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
					'px' => [
						'min' => -1000,
						'max' => 1000,
					],
					'%' => [
						'min' => -200,
						'max' => 200,
					],
					'vh' => [
						'min' => -200,
						'max' => 200,
					],
					'vw' => [
						'min' => -200,
						'max' => 200,
					],
				],
				'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'vw', 'custom' ],
				'default' => [
					'size' => 0,
				],
                'condition' => [
                    'course_content_position' => 'absolute',
                    'vertical_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
			'course_content_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'tp-elements' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .tp-course-item .tp-course-content-top' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'course_content_position' => 'absolute',
                ],
			]
		);

        $this->add_control(
		    'course_title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'tp-elements' ),
                'separator' => 'before',
		    ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'tp-elements' ),
				'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title',
			]
		);

        $this->start_controls_tabs( '_tabs_title' );

		$this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title a' => 'color: {{VALUE}};',
                ],       
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_title_border',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title'               
		    ]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 
        
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title:hover a' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title:hover a' => 'background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, {{VALUE}}), color-stop(50%, transparent)); background-image: linear-gradient(to right, {{VALUE}} 50%, transparent 50%);',
                ],                
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_title_border_hover',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title'               
		    ]
		);

        $this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'title_padding',
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
		    'course_desc_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Description', 'tp-elements' ),
                'separator' => 'before',
		    ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'des_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                
                'selector' => 
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-text',
            ]
        );
        
        $this->add_control(
            'des_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-text' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'des_content_margin',
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        
		$this->start_controls_section(
		    'section_style_content_bottom',
		    [
		        'label' => esc_html__( 'Content Bottom', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_grid_style' => ['style1', 'style2', 'style3', 'style4']
                ]
		    ]
		);

        $this->add_responsive_control(
            'course_bottom_item_direction',
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
                'default' => 'row',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-content-bottom' => 'flex-direction: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_bottom_item_align',
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
                    '{{WRAPPER}} .tp-course-content-bottom' => 'align-items: {{VALUE}}',
                ],
               'condition' => [
                    'course_content_position!' => 'absolute',
                ],
            ]
        );

        $this->add_responsive_control(
            'course_bottom_justify_content',
            [
                'label' => esc_html__( 'Justify Content', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-align-start-v',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-justify-center-v',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-justify-end-v',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-content-bottom' => 'justify-content: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'course_bottom_item_gap',
            [
                'label' => esc_html__( 'Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-content-bottom' => 'gap: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-course-content-bottom .tp-course-meta' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_content_border',
		        'selector' => '{{WRAPPER}} .tp-course-content-bottom',
                'separator' => 'before',          
		    ]
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'content_bottom_bg_color',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content-bottom',
            ]
        );

        $this->add_responsive_control(
            'content_bottom_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-content-bottom' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'content_bottom_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-content-bottom' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

		$this->end_controls_section();

        //author Style
		$this->start_controls_section(
		    'section_style_author',
		    [
		        'label' => esc_html__( 'Author', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'course_author_show_hide' => 'yes'
                ]
		    ]
		);

        $this->add_control(
		    'author_image_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Author Image', 'tp-elements' ),
		    ]
		);

        $this->add_responsive_control(
			'course_author_image_width',
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
					'{{WRAPPER}} .tp-course-item .tp-course-content .tutor-avatar' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'course_author_image_height',
			[
				'label' => esc_html__( 'Height', 'tp-elements' ),
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
					'{{WRAPPER}} .tp-course-item .tp-course-content .tutor-avatar' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'author_image_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tutor-avatar' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
				'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'author_image_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tutor-avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'author_image_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tutor-avatar' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_control(
		    'author_info_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Author Info', 'tp-elements' ),
		        'separator' => 'before',
		    ]
		);

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'author_typography',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name',
		    ]
		);

		$this->start_controls_tabs( '_tabs_author' );

		$this->start_controls_tab(
		    '_course_author_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'author_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'course_author_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'course_author_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_author_name_border',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name'               
		    ]
		);
        
		$this->end_controls_tab();
		$this->start_controls_tab(
		    '_course_author_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'course_author_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name:hover' => 'color: {{VALUE}}',
                   
		        ],
		    ]
		);

		$this->add_control(
		    'course_author_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'course_author_box_shadow_hover',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name:hover',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_author_name_border_hover',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name:hover'               
		    ]
		);

		$this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_control(
		    'hr_author',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);
        
		$this->add_control(
		    'course_author_name_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        
		$this->add_responsive_control(
		    'course_author_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'course_author_link_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-author .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->end_controls_section();

		//Read More Style
		$this->start_controls_section(
		    '_section_style_button',
		    [
		        'label' => esc_html__( 'Button', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition'   => [
                    'button_show_hide' => 'yes',
                ]
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'button_typography',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_course_button_normal',
		    [
		        'label' => esc_html__( 'Normal', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'button_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'course_button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_control(
		    'course_button_icon_translate',
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
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'course_button_box_shadow',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a'               
		    ]
		);
        
		$this->end_controls_tab();
		$this->start_controls_tab(
		    '_course_button_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'course_button_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover,
                    {{WRAPPER}} .tp-course-item .meta_author:hover' => 'color: {{VALUE}}',
                   
		        ],
		    ]
		);

		$this->add_control(
		    'course_button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'course_button_hover_icon_translate',
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
		            '{{WRAPPER}} .tp-course-item:hover .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .tp-course-item:hover .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .tp-course-item:hover .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .tp-course-item:hover .tp-course-content .tp-course-btn a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'course_button_box_shadow_hover',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'course_button_border_hover',
		        'selector' => '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover'               
		    ]
		);

		$this->end_controls_tab();
        $this->end_controls_tabs();

		$this->add_control(
		    'hr_button',
		    [
		        'type' => Controls_Manager::DIVIDER,
		        'style' => 'thick',
		    ]
		);
        
		$this->add_control(
		    'course_button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        
		$this->add_responsive_control(
		    'course_button_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'course_button_link_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'course_button_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Button Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'button_show_hide' => 'yes',
                    'btn_switch' => 'yes'
                ]
		    ]
		);

        $this->add_control(
		    'course_button_icon_font_size',
		    [
		        'label' => esc_html__( 'Icon Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'range' => [
		            'px' => [
		                'min' => -100,
		                'max' => 100,
		            ],
		        ],
                'default' => [
					'unit' => 'px',
					'size' => 15,
				],
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'button_show_hide' => 'yes',
                    'btn_switch' => 'yes'
                ]
		    ]
		);

        $this->start_controls_tabs( '_tabs_course_button_icon', [ 'condition' => [
            'button_show_hide' => 'yes',
            // 'btn_switch' => 'yes'
        ]] );

		$this->start_controls_tab(
            'course_button_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'course_button_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a svg rect' => 'fill: {{VALUE}};',
                ],            
            ]
        );
        $this->add_control(
            'course_button_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'background-color: {{VALUE}};',
                ],         
            ]
        );

        $this->add_control(
            'course_button_icon_border_style',
            [
                'label' => esc_html__( 'Border Style', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'none' => esc_html__( 'None', 'tp-elements' ),
                    'solid' => esc_html__( 'Solid', 'tp-elements' ),
                    'double' => esc_html__( 'Double', 'tp-elements' ),
                    'dotted' => esc_html__( 'Dotted', 'tp-elements' ),
                    'dashed' => esc_html__( 'Dashed', 'tp-elements' ),
                    'groove' => esc_html__( 'Groove', 'tp-elements' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'course_button_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'course_button_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'course_button_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'course_button_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'course_button_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'course_button_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover svg rect' => 'fill: {{VALUE}};',
                ],       
            ]
        );

        $this->add_control(
            'course_button_icon_bg_hover',
            [
                'label' => esc_html__( 'Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover .icon' => 'background-color: {{VALUE}};',
                ],          
            ]
        );

        $this->add_control(
		    'course_button_icon_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'course_button_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'course_button_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'button_show_hide' => 'yes',
                    'btn_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'course_button_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'button_show_hide' => 'yes',
                    'btn_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'course_button_icon_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
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
                    '{{WRAPPER}} .tp-course-item .tp-course-content .tp-course-btn a .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'button_show_hide' => 'yes',
                    'btn_switch' => 'yes'
                ]
            ]
        );
		
		$this->end_controls_section();

		// Start Blog Pagination Style
		$this->start_controls_section(
		    '_course_pagination_style',
		    [
		        'label' => esc_html__( 'Pagination Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition' => [
                    'pagination_show_hide' => 'yes',
                ]
		    ]
		);

        $this->add_responsive_control(
		    'course_pagi_margin',
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
		    'course_pagi_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'course_pagiesc_html__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagi_btn_border',
		        'selector' => '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links a'               
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_shadow',
				'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
				'selector' => '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links a',
			]
		);

        $this->add_responsive_control(
		    '_pagi_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		    'course_pagi_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'default' => '',
		        'selectors' => [
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span.current' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'course_pagiesc_hover__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span.current' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagi_hover_btn_border',
		        'selector' => '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span.current'               
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_hover_shadow',
				'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
				'selector' => '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span.current',
			]
		);

        $this->add_responsive_control(
		    '_pagi_active_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-course-grid .themephi-pagination-area .nav-links span.current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			$pagination_class = '.tp-blog-pagination ';
			
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

       if($settings['show_filter'] == 'filter_show'){
            $grid = 'grid';

        }else{
            $grid = "";
        }

        ?>


        <style>
            <?php if( $settings['course_grid_style'] == 'style11' ) : ?>
            .tp-course-content-position-absolute {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                display: flex;
            }
            <?php endif; ?>
            <?php if( $settings['enable_space_between_cat_content'] == 'yes' ) : ?>
                .enable_space_between_cat_content {
                    display: flex;
                    width: 100%;
                    height: 100%;
                    flex-direction: column;
                    justify-content: space-between;
                }
            <?php endif; ?>
            .cat_list.position-absolute {
                left: 0;
                top: 0;
                display: flex;
                width: 100%;
                height: 100%;
            }


            /* for favourite icon  */

            .tp-course-wishlist {
            display: inline-block;
            margin: 10px 0;
        }

        .tutor-wishlist-btn span {
            font-size: 24px;
            cursor: pointer;
            transition: color 0.3s ease;
        }

        .tutor-wishlist-btn span:hover {
            color: #ff0000; /* Change to red on hover */
        }

        </style>

        <?php if($settings['show_filter'] == 'filter_show') : ?>
        
        <div class="portfolio-filter">
            <div class="portfolio-filter-inner d-inline-block">
                <?php if( $settings['filter_title'] ) : ?>
                <button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']);?></button>
                <?php endif; ?>
                <?php $taxonomy = "course-category";
                    $select_cat = $settings['category'];
                    foreach ($select_cat as $catid) {
                    $term = get_term_by('slug', $catid, $taxonomy);
                    $term_name  =  $term->name;
                    $term_slug  =  $term->slug;
                ?>
                    <button data-filter=".filter_<?php echo esc_html($term_slug);?>"><?php echo esc_html($term_name);?></button>
                <?php  } 
                
                ?>
            </div>

        </div>
        
        <?php endif; ?>

		<div class="themephi-course-grid tp-course--<?php echo esc_attr( $settings['course_grid_style'] ); ?> <?php echo esc_attr( $settings['image_hover_effect'] ); ?>">
            <?php if( $settings['course_grid_source'] == 'dynamic' ) : ?>           
            <div class="tp-course-dynamic-wrapper">
                <div class="row course-gird-item <?php echo esc_attr( $grid ); ?> " <?php if( $settings['messonry_show_hide'] == 'yes' ) : ?> data-masonry=' { "columnWidth": ".grid-item", "percentPosition": false }' <?php endif; ?> >
                <?php elseif($settings['course_grid_source'] == 'slider') : ?>   
            <div class="swiper tp_course-<?php echo esc_attr($unique); ?> ">
                <div class="swiper-wrapper ">
                <?php else : ?>
                <?php endif; ?>
                    <?php
                    $cat = $settings['category'];     
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    if(empty($cat)){
                        $best_wp = new wp_Query(array(
                            'post_type'      => 'courses',
                            'posts_per_page' => $settings['per_page'],										
                            'offset'		 => $settings['post_offset'],
                            'paged'          => $paged		
                        ));	    
                    }   
                    else{
                        $best_wp = new wp_Query(array(
                            'post_type'      => 'courses',
                            'posts_per_page' =>  $settings['per_page'],										
                            'offset'         => $settings['post_offset'],
                            'paged'          => $paged,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'course-category',
                                    'field'    => 'slug', 
                                    'terms'    => $cat 
                                ),
                            )
                        ));	  
                    }

                    $x=1;
                    while($best_wp->have_posts()): $best_wp->the_post(); 
                        global $post, $authordata;
                        $course_id = get_the_ID();
                        $profile_url       = tutor_utils()->profile_url( $authordata->ID, true );
                        $categories = get_the_terms($course_id, 'course-category');
                        //$course_duration = tutor_utils()->get_option( 'enable_course_duration' ) ? get_tutor_course_duration_context() : null;  // hours and minutes text of duration
                        $course_duration = get_tutor_course_duration_context( 0, true );
                        $course_duration = ( ! empty( $course_duration ) ) ? $course_duration : 0;
                        $course_students = tutor_utils()->get_option( 'enable_course_total_enrolled' ) ? tutor_utils()->count_enrolled_users_by_course() : null;
                        $is_wish_listed = tutor_utils()->is_wishlisted( $course_id );
                        $action_class = '';
                        if ( is_user_logged_in() ) {
                            $action_class = apply_filters('tutor_wishlist_btn_class', 'tutor-course-wishlist-btn');
                        } else {
                            $action_class = apply_filters('tutor_popup_login_class', 'cart-required-login');
                        }
                        $image_size = isset($settings['course_image_size']) ? $settings['course_image_size'] : 'large';
                        $image_url  = get_tutor_course_thumbnail( $image_size, $url = true );
                        $price 	= tutor_utils()->get_course_price( get_the_ID() );
                        $course_excerpt = get_the_excerpt(); 
                        $course_description = get_the_content(); 
                        $max_students = get_post_meta($course_id, '_tutor_course_max_students', true);
                        $is_public_course = get_post_meta($course_id, '_tutor_is_public_course', true);
                        $visibility = get_post_status($course_id); // Can be 'publish', 'private', 'password_protected', etc.
                        $tags = get_the_terms($course_id, 'course-tag');
                        $lesson_count = tutor_utils()->get_lesson_count_by_course($course_id);
                        $quiz_count = tutor_utils()->get_quiz_count_by_course($course_id);
                        $materials = get_post_meta($course_id, '_tutor_course_material_includes', true);


                        if(!empty($settings['title_word_count'])){
                            $title_limit = $settings['title_word_count']; 
                        }
                        else{
                            $title_limit = 10;
                        }

                        if(!empty($settings['content_word_show'])){
                            $limit = $settings['content_word_show']; 
                        }
                        else{
                            $limit = 20;
                        }
                        
                        if( $settings['course_grid_source'] == 'dynamic' ) {

                            $termsArray = get_the_terms( $best_wp->ID, "course-category" ); 
                            $termsString = ""; 
                            foreach ( $termsArray as $term ) {  
                            $termsString .= 'filter_'.$term->slug.' ';
                            }

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
                    
                    ?>  
                    
                    <?php
                    $x++;
                    endwhile;
                    
                    wp_reset_query();  ?>     

            <?php if( $settings['course_grid_source'] == 'dynamic' || $settings['course_grid_source'] == 'slider' ) : ?>      
                </div>   
            </div>   
                        	    
            <?php 
            endif; 

            if( $settings['course_grid_source'] == 'dynamic' ) {

                $course_item_data = array(
                'per_page'  => $settings['per_page']
    
                );
    
                wp_localize_script( 'vloglab-main', 'course_load_data', $course_item_data );
    
                $paginate = paginate_links( array(
                    'total' => $best_wp->max_num_pages
                ));
    
                if(!empty($paginate ) && ($settings['pagination_show_hide'] == 'yes')){ ?>
                    <div class="themephi-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
                <?php } 

            }
            
            ?>  

		</div>

        <?php if( $settings['course_grid_source'] == 'slider' ) : ?>
        <script>

            jQuery(document).ready(function(){
					
                var swiper = new Swiper(".tp_course-<?php echo esc_attr($unique); ?> ", {				
                    slidesPerView: <?php echo $slidesToShow;?>,
                    <?php echo $seffect; ?>
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    loop: <?php echo esc_attr($infinite ); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,
                    spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    <?php echo $pagination; ?>,
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    navigation: {
                        nextEl: ".tp-blog-slide-next",
                        prevEl: ".tp-blog-slide-prev",
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
}