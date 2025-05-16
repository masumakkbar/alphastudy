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

class Themephi_Elementor_Blog_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'tp-blog';
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
		return esc_html__( 'TP Blogs', 'tp-elements' );
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

		$post_categories = get_terms( 'category' );

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
			'blog_grid_source',
			[
				'label'   => esc_html__( 'Blog Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dynamic',				
				'options' => [
					'dynamic' => esc_html__('Dynamic', 'tp-elements'),					
					'slider' => esc_html__('Slider', 'tp-elements'),						
				],											
			]
		);

		$this->add_control(
			'blog_grid_style',
			[
				'label'   => esc_html__( 'Blog Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
                    'style1' => esc_html__( 'Style 1', 'tp-elements'),
					'style2' => esc_html__( 'Style 2', 'tp-elements'),
					'style3' => esc_html__( 'Style 3', 'tp-elements'),
					'style4' => esc_html__( 'Style 4', 'tp-elements'),
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
					'blog_grid_source' => ['dynamic'],
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
					'blog_grid_source' => ['dynamic'],
				],	
				'separator' => 'before',
			]
		);


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Blog Show Per Page', 'tp-elements' ),
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
            'blog_image',
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
                    'blog_image' => 'yes',
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
                    'blog_image' => 'yes',
                ],
			]
		);

        $this->add_control(
            'blog_content_show_hide',
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
            'blog_word_show',
            [
                'label' => esc_html__( 'Show Content Limit', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'tp-elements' ),
                'separator' => 'before',
                'condition' => [
                    'blog_content_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'blog_pagination_show_hide',
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
            'blog_col_xxl',
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
					'blog_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );
    
        $this->add_control(
            'blog_col_xl',
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
					'blog_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );
    
        $this->add_control(
            'blog_col_lg',
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
					'blog_grid_source' => ['dynamic'],
				],
                'separator' => 'before',                            
            ]
            
        );

        $this->add_control(
            'blog_col_md',
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
					'blog_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'blog_col_sm',
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
					'blog_grid_source' => ['dynamic'],
				],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'blog_col_xs',
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
					'blog_grid_source' => ['dynamic'],
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
            'blog_meta_show_hide',
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
            'blog_meta_position',
            [
                'label' => esc_html__( 'Display Meta Position', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'after_title',
                'options' => [
                    'before_title' => esc_html__( 'Before Title', 'tp-elements' ),
                    'after_title' => esc_html__( 'After Title', 'tp-elements' ),
                    'after_content' => esc_html__( 'After Content', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );

		$this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Author Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            'meta_avatar_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'blog_avatar_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'meta_avatar_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
				'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
                ],			
			]
		);

		$this->add_control(
            'blog_cat_show_hide',
            [
                'label' => esc_html__( 'Category Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'blog_category_position',
            [
                'label' => esc_html__( 'Category Position', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'content_area',
                'options' => [
                    'image_area' => esc_html__( 'Image Area', 'tp-elements' ),
                    'content_area' => esc_html__( 'Content Area', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'blog_cat_show_hide' => 'yes',
                    'blog_grid_style!' => ['style4'],
                ],
            ]
        );

        $this->add_control(
            'meta_cat_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'blog_cat_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'meta_category_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'tp tp-tags',
					'library' => 'solid',
				],
				'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ],			
			]
		);

		$this->add_control(
            'reading_time_show_hide',
            [
                'label' => esc_html__( 'Reading Time Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            'meta_reading_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'reading_time_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'meta_reading_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
				'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'reading_time_show_hide' => 'yes',
                    'meta_reading_switch' => 'yes'
                ],			
			]
		);

		$this->add_control(
            'blog_date_show_hide',
            [
                'label' => esc_html__( 'Date Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            'meta_date_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'blog_date_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'meta_date_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'tp tp-calendar-days',
					'library' => 'solid',
				],
				'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_date_show_hide' => 'yes',
                    'meta_date_switch' => 'yes'
                ],			
			]
		);

		$this->add_control(
            'blog_comments_show_hide',
            [
                'label' => esc_html__( 'Comments Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            'meta_comment_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'blog_comments_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'meta_comment_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'fas fa-user',
					'library' => 'solid',
				],
				'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_comments_show_hide' => 'yes',
                    'meta_comment_switch' => 'yes'
                ],			
			]
		);

        
		$this->add_control(
            'visitors_show_hide',
            [
                'label' => esc_html__( 'Visitors Show / Hide', 'tp-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'tp-elements' ),
                    'no' => esc_html__( 'No', 'tp-elements' ),
                ],                
                'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );
        $this->add_control(
            'meta_visitor_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_meta_show_hide' => 'yes',
                    'visitors_show_hide' => 'yes',
                ]
            ]
        );
        
        $this->add_control(
			'meta_visitor_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'fas fa-eye',
					'library' => 'solid',
				],
				'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'visitors_show_hide' => 'yes',
                    'meta_visitor_switch' => 'yes'
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
            'blog_readmore_show_hide',
            [
                'label' => esc_html__( 'Read More Show / Hide', 'tp-elements' ),
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
			'blog_btn_text',
			[
                'label'       => esc_html__( 'Button Text', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Read More',
                'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
                'separator'   => 'before',
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
			]
		);

        $this->add_control(
            'blog_btn_switch',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
                'condition'   => [
                    'blog_readmore_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
			'blog_btn_icon',
			[
				'type' => Controls_Manager::ICONS,
                'label' => esc_html__( '', 'tp-elements' ),
                'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_switch' => 'yes'
                ]
			]
		);
				
		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Blog Item', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_responsive_control(
            'blog_item_direction',
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
                    '{{WRAPPER}} .blog-item' => 'flex-direction: {{VALUE}}',
                ],
                'condition' => [
                    'blog_content_position!' => 'absolute',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_item_align',
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
                    '{{WRAPPER}} .blog-item' => 'align-items: {{VALUE}}',
                ],
               'condition' => [
                    'blog_content_position!' => 'absolute',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_item_gap',
            [
                'label' => esc_html__( 'Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .blog-item' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .blog-item',
                'separator' => 'before',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .blog-item',
            ]
        );
        
        $this->add_control(
            'blog_item_border_style',
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
                    '{{WRAPPER}} .blog-item' => 'border-style: {{VALUE}}',
                ],
        
            ]
        );
        
        $this->add_responsive_control(
            'blog_item_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_item_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_item_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-item' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_item_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->add_control(
		    'blog_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_item_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->add_control(
            'blog_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .blog-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
				],           
            ]
        );

        $this->add_responsive_control(
            'blog_item_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'blog_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
					'blog_grid_source' => 'slider',
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
				'label' => esc_html__( 'Blog Image', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .image-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'img_background',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'selector' => '{{WRAPPER}} .image-part',
                
            ]
        );
    
        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'blog_image_border',
				'selector' => '{{WRAPPER}} .image-part',
			]
		);

        $this->add_control(
            'blog_image_border_radius',
            [
                'label' => esc_html__( 'Border radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
					'{{WRAPPER}} .image-part, {{WRAPPER}} .image-part img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],              
            ]
        );
                
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .image-part',
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
			'image_width',
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
					'{{WRAPPER}} .image-part' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'image_max_width',
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
					'{{WRAPPER}} .image-part' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
			'image_height',
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
					'{{WRAPPER}} .image-part' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_control(
            'blog_image_overlay',
            [
                'label'   => esc_html__( 'Background Overlay', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'hide',               
                'options' => [                    
                    'hide' => 'Hide',
                    'show' => 'Show',                             
                ],      
                'prefix_class' => 'tp-blog-img-overlay-', 
                                               
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'blog_image_overlay_color',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient', 'tp-elements' ],
                'exclude' => [
                    'image'
                ],
                'selector' => '{{WRAPPER}} .image-part::before',
                'condition' => [
                    'blog_image_overlay' => 'show'
                ]   
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_grid_style',
            [
                'label' => esc_html__( 'Blog Meta', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                ],
            ]
        );

        $this->add_control(
		    'blog_meta_item_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Meta Box', 'tp-elements' ),
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'blog_meta_item_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .blog-item .blog-content .blog-meta',
			]
		);

        $this->add_responsive_control(
            'blog_meta_item_padding',
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
                    '{{WRAPPER}} .blog-item .blog-content .blog-meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_meta_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .blog-item .blog-content .blog-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_meta_item_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .blog-meta' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_meta_gap',
            [
                'label' => esc_html__( 'Item Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'custom'],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .blog-meta' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
		    'blog_meta_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Meta item', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_meta_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item',
            ]
        );

        $this->start_controls_tabs( '_tabs_blog_meta' );

		$this->start_controls_tab(
            'meta_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blog_meta_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'blog_meta_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .blog-content .blog-meta .meta-item',
			]
		);

        $this->add_control(
            'blog_meta_border_style',
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
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_meta_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_meta_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_meta_border_style!' => ['', 'none'],
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
            'blog_meta_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'blog_meta_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover',
			]
		);

        $this->add_control(
		    'blog_meta_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_meta_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'blog_meta_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'blog_meta_padding',
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
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'blog_meta_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'blog_meta_icon_heading',
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
		            '{{WRAPPER}} .blog-content .blog-meta .meta-item i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
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
            'blog_meta_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'blog_meta_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'blog_meta_icon_border_style',
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
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_meta_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_meta_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_meta_icon_border_style!' => ['', 'none'],
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
            'blog_meta_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'blog_meta_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'blog_meta_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-content .blog-meta .meta-item:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_meta_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'blog_meta_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_meta_icon_padding',
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
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_meta_icon_margin',
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
                    '{{WRAPPER}} .blog-content .blog-meta .meta-item .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_category',
            [
                'label' => esc_html__( 'Blog Category', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide'  => ['yes'],
                ],
            ]
        );

        $this->add_control(
            'blog_category_space_between',
            [
                'label' => esc_html__( 'Enable Space Between Category & Content ?', 'tp-elements' ),
                'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',  
                'options' => [                    
                    'no' => 'Hide',
                    'yes' => 'Show',                             
                ],               
                'separator' => 'before',
                'prefix_class' => 'tp-blog-category-', 
                'condition' => [
                    'blog_grid_style' => ['style4'],
                ]
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_meta_cat_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => 
                    '{{WRAPPER}} .blog-item .blog-content .meta_category, {{WRAPPER}} .blog-item .image-part .meta_category',
            ]
        );

        $this->start_controls_tabs( '_tabs_blog_meta_cat' );

		$this->start_controls_tab(
            'meta_cat_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blog_meta_cat_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category, {{WRAPPER}} .blog-item .image-part .meta_category' => 'color: {{VALUE}};',
                    
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'blog_meta_cat_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .blog-item .blog-content .meta_category, {{WRAPPER}} .blog-item .image-part .meta_category',
			]
		);

        $this->add_control(
            'blog_meta_cat_border_style',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_category, {{WRAPPER}} .blog-item .image-part .meta_category' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_meta_cat_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category, {{WRAPPER}} .blog-item .image-part .meta_category' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_cat_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_meta_cat_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category, {{WRAPPER}} .blog-item .image-part .meta_category' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_meta_cat_border_style!' => ['', 'none'],
                ],
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
            'blog_meta_cat_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category:hover' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'blog_meta_cat_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
                'exclude' => [
                    'image'
                ],
				'selector' => '{{WRAPPER}} .blog-item .blog-content .meta_category:hover, {{WRAPPER}} .blog-item .image-part .meta_category:hover',
			]
		);

        $this->add_control(
		    'blog_meta_cat_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_category:hover' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .blog-item .image-part .meta_category:hover' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_meta_cat_border_style!' => ['', 'none'],
                ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'blog_meta_cat_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'blog_meta_cat_padding',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
                
        $this->add_responsive_control(
            'blog_meta_cat_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'blog_meta_cat_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Category Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]
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
		            '{{WRAPPER}} .blog-item .blog-content .meta_category i' => 'font-size: {{SIZE}}{{UNIT}};',
		            '{{WRAPPER}} .blog-item .image-part .meta_category i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_category svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]
		    ]
		);

        $this->start_controls_tabs( '_tabs_meta_cat_icon', ['condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]] );

		$this->start_controls_tab(
            'meta_cat_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
                
            ]
        ); 

        $this->add_control(
            'blog_meta_cat_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_category svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_category svg rect' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'blog_meta_cat_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'blog_meta_cat_icon_border_style',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'border-style: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_meta_cat_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_cat_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_meta_cat_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_meta_cat_icon_border_style!' => ['', 'none'],
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
            'blog_meta_cat_icon_color_hover',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_category:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_category:hover svg rect' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category:hover svg rect' => 'fill: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'blog_meta_cat_icon_bg_hover',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category:hover .icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category:hover .icon' => 'background-color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
		    'blog_meta_cat_icon_border_hover',
		    [
		        'label' => esc_html__( 'Hover Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_category:hover .icon' => 'border-color: {{VALUE}};',
		            '{{WRAPPER}} .blog-item .image-part .meta_category:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_meta_cat_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'blog_meta_cat_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'blog_meta_cat_icon_padding',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'blog_meta_cat_icon_margin',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_category .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .image-part .meta_category .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_cat_show_hide' => 'yes',
                    'meta_cat_switch' => 'yes'
                ]
            ]
        );

		$this->add_control(
			'cat_horizontal_offset',
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
                'separator' => 'before',
				'condition' => [
                    'blog_category_position' => 'image_area',
                ],
			]
		);

        
        $this->add_responsive_control(
            'blog_meta_cat_left',
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
                    'cat_horizontal_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'blog_meta_cat_right',
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
                    'cat_horizontal_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

		$this->add_control(
			'cat_vertical_offset',
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
                    'blog_category_position' => 'image_area',
                ],
			]
		);

        $this->add_responsive_control(
            'blog_meta_cat_top',
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
                    'cat_vertical_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_meta_cat_bottom',
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
                    'cat_vertical_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .image-part .meta_category' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
			'blog_meta_cat_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'tp-elements' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .blog-item .image-part .meta_category' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'blog_category_position' => 'image_area',
                ],
			]
		);

        $this->end_controls_section();

        
        $this->start_controls_section(
            'section_content_sec',
            [
                'label' => esc_html__( 'Blog Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
			'blog_content_width',
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
					'{{WRAPPER}} .blog-item .blog-content' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
			'blog_content_height',
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
					'{{WRAPPER}} .blog-item .blog-content' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'content_alignment',
            [
                'label' => esc_html__( 'Content Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'top', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'end' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content' => 'align-items: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .blog-content .blog-meta' => 'justify-content: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part' => 'justify-content: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .blog-content-top.category_space_between' => 'align-items: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .blog-content' => 'text-align: {{VALUE}}',
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
                    '{{WRAPPER}} .blog-item .blog-content' => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .blog-item .blog-content' => 'justify-content: {{VALUE}}',
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
                'selector' => '{{WRAPPER}} .blog-item .blog-content',
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
                    '{{WRAPPER}} .blog-item .blog-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .blog-item .blog-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .blog-item .blog-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
            'blog_content_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content' => 'position: {{VALUE}};',
                ],   
                'condition' => [
                    'blog_grid_style!' => 'style2',
                    'blog_category_position!' => 'image_area'
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
                    'blog_content_position' => 'absolute',
                ],
			]
		);

        
        $this->add_responsive_control(
            'blog_content_position_left',
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
                    'blog_content_position' => 'absolute',
                    'horizontal_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'blog_content_position_right',
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
                    'blog_content_position' => 'absolute',
                    'horizontal_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content' => 'right: {{SIZE}}{{UNIT}};',
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
                    'blog_content_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'blog_content_position_top',
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
                    'blog_content_position' => 'absolute',
                    'vertical_offset' => ['start'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_content_position_bottom',
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
                    'blog_content_position' => 'absolute',
                    'vertical_offset' => ['end'],
                ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
			'blog_content_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'tp-elements' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .blog-item .blog-content' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'blog_content_position' => 'absolute',
                ],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slider_title',
            [
                'label' => esc_html__( 'Title & Description', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
		    'blog_title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'tp-elements' ),
		    ]
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Typography', 'tp-elements' ),
				'selector' => 
                    '{{WRAPPER}} .blog-item .blog-content .title',
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
                    '{{WRAPPER}} .blog-item .blog-content .title a' => 'color: {{VALUE}};',
                ],       
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'title_border',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .title'               
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
                    '{{WRAPPER}} .blog-item .blog-content .title:hover a' => 'color: {{VALUE}};',
                ],                
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .title:hover a' => 'background-image: -webkit-gradient(linear, left top, right top, color-stop(50%, {{VALUE}}), color-stop(50%, transparent)); background-image: linear-gradient(to right, {{VALUE}} 50%, transparent 50%);',
                ],                
            ]
        );

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'title_border_hover',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .title'               
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
                    '{{WRAPPER}} .blog-item .blog-content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .blog-item .blog-content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
		    'blog_desc_heading',
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
                    '{{WRAPPER}} .blog-item .blog-content p.txt ',
            ]
        );
        
        $this->add_control(
            'des_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content p.txt ' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .blog-item .blog-content p.txt ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

		$this->end_controls_section();

        //author Style
		$this->start_controls_section(
		    '_section_style_author',
		    [
		        'label' => esc_html__( 'Author', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                ],    
		    ]
		);

        $this->add_responsive_control(
            'Position',
            [
                'label' => esc_html__( 'Content Alignment', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .blog-content-bottom' => 'flex-direction: {{VALUE}}',
                ],
                'condition' => [
                    'blog_grid_style' => 'style1'
                ]
            ]
        );
        $this->add_responsive_control(
            'author_alignment',
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
                    'space-between' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .blog-content-bottom' => 'justify-content: {{VALUE}}',
                ],
                'condition' => [
                    'blog_grid_style' => 'style1'
                ]
            ]
        );

		$this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'author_typography',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .meta_author',
		    ]
		);

		$this->start_controls_tabs( '_tabs_author' );

		$this->start_controls_tab(
		    '_blog_author_normal',
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
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_author_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_control(
		    'blog_author_icon_translate',
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
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .blog-item .blog-content .meta_author' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_author_box_shadow',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .meta_author',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'blog_author_meta_border',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .meta_author'               
		    ]
		);
        
		$this->end_controls_tab();
		$this->start_controls_tab(
		    '_blog_author_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'blog_author_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content:hover .meta_author, 
                    {{WRAPPER}} .blog-item .blog-content:focus .meta_author' => 'color: {{VALUE}}',
                   
		        ],
		    ]
		);

		$this->add_control(
		    'blog_author_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content:hover .meta_author' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_author_hover_icon_translate',
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
		            '{{WRAPPER}} .blog-item:hover .blog-content .meta_author' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .blog-item:hover .blog-content .meta_author' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .blog-item:hover .blog-content .meta_author' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .blog-item:hover .blog-content .meta_author' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_author_box_shadow_hover',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .meta_author:hover',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'blog_author_meta_border_hover',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content:hover .meta_author'               
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
		    'blog_author_meta_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        
		$this->add_responsive_control(
		    'blog_author_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'blog_author_link_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_author' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'blog_author_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Author Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
                ],
		    ]
		);

        $this->add_control(
		    'blog_author_icon_font_size',
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
		            '{{WRAPPER}} .blog-item .blog-content .meta_author i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_author svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
                ],
		    ]
		);

        $this->start_controls_tabs( '_tabs_blog_author_icon', ['condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
                ],] );

		$this->start_controls_tab(
            'blog_author_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blog_author_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_author svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_author svg rect' => 'fill: {{VALUE}};',
                ],            
            ]
        );
        $this->add_control(
            'blog_author_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'background-color: {{VALUE}};',
                ],         
            ]
        );

        $this->add_control(
            'blog_author_icon_border_style',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_author_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_author_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_author_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_author_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'blog_author_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'blog_author_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_author:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .meta_author:hover svg rect' => 'fill: {{VALUE}};',
                ],       
            ]
        );

        $this->add_control(
            'blog_author_icon_bg_hover',
            [
                'label' => esc_html__( 'Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author:hover .icon' => 'background-color: {{VALUE}};',
                ],          
            ]
        );

        $this->add_control(
		    'blog_author_icon_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .meta_author:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_author_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'blog_author_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_author_icon_padding',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_author_icon_margin',
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
                    '{{WRAPPER}} .blog-item .blog-content .meta_author .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'blog_meta_show_hide' => ['yes'],
                    'blog_avatar_show_hide' => 'yes',
                    'meta_avatar_switch' => 'yes'
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
                    'blog_readmore_show_hide' => 'yes',
                ]
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'button_typography',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .btn-part a',
		    ]
		);

		$this->start_controls_tabs( '_tabs_button' );

		$this->start_controls_tab(
		    '_blog_button_normal',
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
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_button_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_control(
		    'blog_button_icon_translate',
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
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_button_box_shadow',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .btn-part a',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'button_border',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .btn-part a'               
		    ]
		);
        
		$this->end_controls_tab();
		$this->start_controls_tab(
		    '_blog_button_button_hover',
		    [
		        'label' => esc_html__( 'Hover', 'tp-elements' ),
		    ]
		);

		$this->add_control(
		    'blog_button_hover_color',
		    [
		        'label' => esc_html__( 'Text Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover,
                    {{WRAPPER}} .blog-item .meta_author:hover' => 'color: {{VALUE}}',
                   
		        ],
		    ]
		);

		$this->add_control(
		    'blog_button_hover_bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_button_hover_icon_translate',
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
		            '{{WRAPPER}} .blog-item:hover .blog-content .btn-part a' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
		            '{{WRAPPER}} .blog-item:hover .blog-content .btn-part a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                    '{{WRAPPER}} .blog-item:hover .blog-content .btn-part a' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .blog-item:hover .blog-content .btn-part a' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Box_Shadow::get_type(),
		    [
		        'name' => 'blog_button_box_shadow_hover',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover',
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'blog_button_border_hover',
		        'selector' => '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover'               
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
		    'blog_button_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);
        
		$this->add_responsive_control(
		    'blog_button_link_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

		$this->add_responsive_control(
		    'blog_button_link_margin',
		    [
		        'label' => esc_html__( 'Margin', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'blog_button_icon_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Button Icon', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_switch' => 'yes'
                ]
		    ]
		);

        $this->add_control(
		    'blog_button_icon_font_size',
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
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_switch' => 'yes'
                ]
		    ]
		);

        $this->start_controls_tabs( '_tabs_blog_button_icon', [ 'condition' => [
            'blog_readmore_show_hide' => 'yes',
            'blog_btn_switch' => 'yes'
        ]] );

		$this->start_controls_tab(
            'blog_button_icon_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'blog_button_icon_color',
            [
                'label' => esc_html__( 'Meta Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a svg rect' => 'fill: {{VALUE}};',
                ],            
            ]
        );
        $this->add_control(
            'blog_button_icon_bg',
            [
                'label' => esc_html__( 'Meta Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'background-color: {{VALUE}};',
                ],         
            ]
        );

        $this->add_control(
            'blog_button_icon_border_style',
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
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'border-style: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'blog_button_icon_border_width',
            [
                'label' => esc_html__( 'Border Width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_button_icon_border_style!' => ['', 'none'],
                ],
            ]
        );
        
        $this->add_control(
            'blog_button_icon_border_color',
            [
                'label' => esc_html__( 'Border Color', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'border-color: {{VALUE}}',
                ],
                'condition' => [
                    'blog_button_icon_border_style!' => ['', 'none'],
                ],
            ]
        );

        $this->end_controls_tab();

		$this->start_controls_tab(
            'blog_button_icon_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'blog_button_icon_color_hover',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover svg rect' => 'fill: {{VALUE}};',
                ],       
            ]
        );

        $this->add_control(
            'blog_button_icon_bg_hover',
            [
                'label' => esc_html__( 'Icon Bg', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover .icon' => 'background-color: {{VALUE}};',
                ],          
            ]
        );

        $this->add_control(
		    'blog_button_icon_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .blog-item .blog-content .btn-part a:hover .icon' => 'border-color: {{VALUE}};',
		        ],
                'condition' => [
                    'blog_button_icon_border_style!' => ['', 'none'],
                ],
		    ]
		);
        
		$this->end_controls_tab();
		$this->end_controls_tabs();

        $this->add_responsive_control(
            'blog_button_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'blog_button_icon_padding',
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
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_switch' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'blog_button_icon_margin',
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
                    '{{WRAPPER}} .blog-item .blog-content .btn-part a .icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
                'condition' => [
                    'blog_readmore_show_hide' => 'yes',
                    'blog_btn_switch' => 'yes'
                ]
            ]
        );
		
		$this->end_controls_section();

		// Start Blog Pagination Style
		$this->start_controls_section(
		    '_blog_pagination_style',
		    [
		        'label' => esc_html__( 'Pagination Style', 'tp-elements' ),
		        'tab' => Controls_Manager::TAB_STYLE,
		        'condition' => [
                    'blog_pagination_show_hide' => 'yes',
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
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links a' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_pagiesc_html__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links a' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagi_btn_border',
		        'selector' => '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links a'               
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_shadow',
				'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
				'selector' => '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links a',
			]
		);

        $this->add_responsive_control(
		    '_pagi_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span, {{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span.current' => 'color: {{VALUE}};',
		        ],
		    ]
		);

		$this->add_control(
		    'blog_pagiesc_hover__bg_color',
		    [
		        'label' => esc_html__( 'Background Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'selectors' => [
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span.current' => 'background-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'pagi_hover_btn_border',
		        'selector' => '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span.current'               
		    ]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'box_pagi_hover_shadow',
				'label' => esc_html__( 'Box Shadow', 'tp-elements' ),
				'selector' => '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span.current',
			]
		);

        $this->add_responsive_control(
		    '_pagi_active_padding',
		    [
		        'label' => esc_html__( 'Padding', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', 'em', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .themephi-blog-grid .themephi-pagination-area .nav-links span.current' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        $sstyle = $settings['blog_grid_style'];

		if( $settings['blog_grid_source'] == 'slider' ) {

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
            <?php if( $settings['blog_grid_style'] == 'style11' ) : ?>
            .blog-content-position-absolute {
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
        </style>

        <?php if($settings['show_filter'] == 'filter_show') : ?>
        
        <div class="portfolio-filter">
            <button class="active" data-filter="*"><?php echo esc_html($settings['filter_title']);?></button>
            <?php $taxonomy = "category";
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
        
        <?php endif; ?>

		<div class="themephi-blog-grid tp-blog--<?php echo esc_attr( $settings['blog_grid_style'] ); ?> <?php echo esc_attr( $settings['image_hover_effect'] ); ?>">
            <?php if( $settings['blog_grid_source'] == 'dynamic' ) : ?>           
            <div class="tp-blog-dynamic-wrapper">
                <div class="row blog-gird-item <?php echo esc_attr( $grid ); ?> " <?php if( $settings['messonry_show_hide'] == 'yes' ) : ?> data-masonry=' { "columnWidth": ".grid-item", "percentPosition": false }' <?php endif; ?> >
                <?php elseif($settings['blog_grid_source'] == 'slider') : ?>   
            <div class="swiper tp_blog-<?php echo esc_attr($unique); ?> ">
                <div class="swiper-wrapper ">
                <?php else : ?>
                <?php endif; ?>
                    <?php
                    $cat = $settings['category'];     
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                    if(empty($cat)){
                        $best_wp = new wp_Query(array(
                            'post_type'      => 'post',
                            'posts_per_page' => $settings['per_page'],										
                            'offset'		 => $settings['post_offset'],
                            'paged'          => $paged		
                        ));	    
                    }   
                    else{
                        $best_wp = new wp_Query(array(
                            'post_type'      => 'post',
                            'posts_per_page' =>  $settings['per_page'],										
                            'offset'         => $settings['post_offset'],
                            'paged'          => $paged,
                            'tax_query'      => array(
                                array(
                                    'taxonomy' => 'category',
                                    'field'    => 'slug', 
                                    'terms'    => $cat 
                                ),
                            )
                        ));	  
                    }

                    $x=1;
                    while($best_wp->have_posts()): $best_wp->the_post(); 

                        $full_date      = get_the_date();
                        $blog_date      = get_the_date();	
                        $post_admin     = get_the_author();
                        $comment_ccount = wp_count_comments()->total_comments;
                        $category = get_the_category(); 

                        if(!empty($settings['title_word_count'])){
                            $title_limit = $settings['title_word_count']; 
                        }
                        else{
                            $title_limit = 10;
                        }

                        if(!empty($settings['blog_word_show'])){
                            $limit = $settings['blog_word_show']; 
                        }
                        else{
                            $limit = 20;
                        }
                        
                        if( $settings['blog_grid_source'] == 'dynamic' ) {

                            $termsArray = get_the_terms( $best_wp->ID, "category" );  //Get the terms for this particular item
                            $termsString = ""; //initialize the string that will contain the terms
                            foreach ( $termsArray as $term ) { // for each term 
                            $termsString .= 'filter_'.$term->slug.' '; //create a string that has all the slugs 
                            }

                            if($sstyle){
                                require plugin_dir_path(__FILE__)."/dynamic/$sstyle.php";
                            }else{
                                require plugin_dir_path(__FILE__)."/dynamic/style1.php";
                            }
                        }

                        if( $settings['blog_grid_source'] == 'slider' ) {

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

            <?php if( $settings['blog_grid_source'] == 'dynamic' || $settings['blog_grid_source'] == 'slider' ) : ?>      
                </div>   
            </div>   
                        	    
            <?php 
            endif; 

            if( $settings['blog_grid_source'] == 'dynamic' ) {

                $blog_item_data = array(
                'per_page'  => $settings['per_page']
    
                );
    
                wp_localize_script( 'vloglab-main', 'blog_load_data', $blog_item_data );
    
                $paginate = paginate_links( array(
                    'total' => $best_wp->max_num_pages
                ));
    
                if(!empty($paginate ) && ($settings['blog_pagination_show_hide'] == 'yes')){ ?>
                    <div class="themephi-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
                <?php } 

            }
            
            ?>  

		</div>

        <?php if( $settings['blog_grid_source'] == 'slider' ) : ?>
        <script>

            jQuery(document).ready(function(){
					
                var swiper = new Swiper(".tp_blog-<?php echo esc_attr($unique); ?> ", {				
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
}?>