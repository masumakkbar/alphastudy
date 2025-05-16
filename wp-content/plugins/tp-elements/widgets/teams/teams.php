<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_Teachers_Widget extends \Elementor\Widget_Base {

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
		return 'tp-teachers';
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
		return __( 'TP Teachers', 'tp-elements' );
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
		return 'glyph-icon flaticon-network';
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
	 * Register team grid widget controls.
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
				'label' => esc_html__( 'Global Setting', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'team_grid_source',
			[
				'label'   => esc_html__( 'Select Team Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',				
				'options' => [
					'custom' => esc_html__('Custom', 'tp-elements'),
					'dynamic' => esc_html__('Dynamic', 'tp-elements'),					
					'slider' => esc_html__('Slider', 'tp-elements'),						
				],											
			]
		);

		$this->add_control(
			'team_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',				
				'options' => [
					'style1' => esc_html__('Style 1', 'tp-elements'),					
					'style2' => esc_html__('Style 2', 'tp-elements'),					
					'style3' => esc_html__('Style 3', 'tp-elements'),					
					'style4' => esc_html__('Style 4', 'tp-elements'),					
					'style5' => esc_html__('Style 5', 'tp-elements'),					
				],
				'separator' => 'before',										
			]
		);

		
        $this->end_controls_section();

		$this->start_controls_section(
			'section_dynamic',
			[
				'label' => esc_html__( 'Slider / Dynamic Content', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'team_grid_source' => ['dynamic', 'slider'],
				],
			]
		);

		$repeater = new Repeater();
 		
		$repeater->add_control(
			'teacher_image',
			[
				'label' => esc_html__( 'Member Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'separator' => 'before',
			]
		);

		$repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'tutor_image',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        ); 

		$repeater->add_control(
			'teacher_image_hover_effect',
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

		$repeater->add_control(
            'teacher_name',
            [
                'label' => esc_html__( 'Name', 'tp-elements' ),                
                'type' => Controls_Manager::TEXT,
                'default' => 'Elements Name',
                'placeholder' => esc_html__( 'Type Member Name', 'tp-elements' ),
                'separator' => 'before',
			]

        );

        $repeater->add_control(
            'teacher_details_url',
            [
                'label' => esc_html__( 'URL', 'tp-elements' ),                
                'type' => Controls_Manager::URL,
                'placeholder' => esc_html__( 'Type URL', 'tp-elements' ),
                'separator' => 'before',
			]

        );

        $repeater->add_control(
            'teacher_designation',
            [
                'label' => esc_html__( 'Designation', 'tp-elements' ),               
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'tp-elements' ),
                'separator' => 'before',
                'placeholder' => esc_html__( 'Type Member Designation', 'tp-elements' ),
            ]
        );
        $repeater->add_control(
            'techer_phone',
            [
                'label' => esc_html__( 'Phone', 'tp-elements' ),               
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',                
            ]
        );
        $repeater->add_control(
            'teacher_email',
            [
                'label' => esc_html__( 'Email', 'tp-elements' ),                
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Email Address', 'tp-elements' ),
                'separator' => 'before',               
            ]
        );
		
        $repeater->add_control(
            'teacher_bio',
            [
                'label' => esc_html__( 'Short Bio', 'tp-elements' ),                
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Type Short Biography for Person', 'tp-elements' ),
                'rows' => 5,
                'separator' => 'before',
            ]
        );

		$repeater->add_control(
			'social_icon_teachers',
			[
				'label' => esc_html__( 'Social Profiles', 'tp-elements' ),
				'type' => Controls_Manager::REPEATER,
				'fields' => [
					[
						'name' => 'social_link',
						'label' => esc_html__('Enter Link', 'tp-elements'),
						'type' => Controls_Manager::URL,
					],
					[
						'name' => 'social_icon',
						'label' => esc_html__( 'Icon', 'tp-elements' ),
						'type' => Controls_Manager::ICONS,
					]
				],
				'title_field' => '{{{ social_icon.value }}}',
				'default' => [
					[
						'social_link' => '#',
						'social_icon' => 'fab fa-facebook-f',
					],
					[
						'social_link' => '#',
						'social_icon' => 'fab fa-twitter',
					],
					[
						'social_link' => '#',
						'social_icon' => 'fab fa-linkedin-in',
					],
				],
			]
		);

		$this->add_control(
			'teacher_items',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => [
					[
						'teacher_title' => esc_html__( 'Teacher #1', 'tp-elements' ),
					],
					[
						'teacher_title' => esc_html__( 'Teacher #2', 'tp-elements' ),
					],
				],
				'title_field' => '{{{ teacher_name }}}',
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_teacher_custom',
            [
                'label' => esc_html__( 'Custom', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'team_grid_source' => 'custom',
				],
            ]
        );

		$this->add_control(
			'member_image',
			[
				'label' => esc_html__( 'Member Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
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
            'name',
            [
                'label' => esc_html__( 'Name', 'tp-elements' ),                
                'type' => Controls_Manager::TEXT,
                'default' => 'Elements Name',
                'placeholder' => esc_html__( 'Type Member Name', 'tp-elements' ),
                'separator' => 'before',
			]

        );

        $this->add_control(
            'details_url',
            [
                'label' => esc_html__( 'URL', 'tp-elements' ),                
                'type' => Controls_Manager::TEXT,
                'default' => '#',
                'placeholder' => esc_html__( 'Type URL', 'tp-elements' ),
                'separator' => 'before',
			]

        );

        $this->add_control(
            'designation',
            [
                'label' => esc_html__( 'Designation', 'tp-elements' ),               
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'tp-elements' ),
                'separator' => 'before',
                'placeholder' => esc_html__( 'Type Member Designation', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => esc_html__( 'Phone', 'tp-elements' ),               
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',                
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__( 'Email', 'tp-elements' ),                
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter Email Address', 'tp-elements' ),
                'separator' => 'before',               
            ]
        );
		
        $this->add_control(
            'bio',
            [
                'label' => esc_html__( 'Short Bio', 'tp-elements' ),                
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Type Short Biography for Person', 'tp-elements' ),
                'rows' => 5,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_social',
            [
                'label' => esc_html__( 'Social Profiles', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'team_grid_source' => ['custom'],
				],
            ]
        );

 		$repeater = new Repeater();
 		
 		$repeater->add_control(
 		    'link',
 		    [
 		        'label' => esc_html__('Enter Link', 'tp-elements'),
 		        'type' => Controls_Manager::URL,                
 		    ]
 		); 

		 $repeater->add_control(
			'social_icon_pick',
			[
				'label'     => esc_html__( 'Icon', 'tp-elements' ),
				'type'      => Controls_Manager::ICONS,
				'separator' => 'before',
			]
		);

 		$this->add_control(
 		    'social_icon_list',
 		    [
 		        'show_label' => false,
 		        'type' => Controls_Manager::REPEATER,
 		        'fields' => $repeater->get_controls(),
 		        'title_field' => '{{{ social_icon_pick.value }}}',
 		        'default' => [
                    [
                        'link' => '#',
                        'social_icon_pick' => 'fab fa-facebook-f',
                    ],
                    [
                        'link' => '#',
                        'social_icon_pick' => 'fab fa-twitter',
                    ],
                    [
                        'link' => '#',
                        'social_icon_pick' => 'fab fa-linkedin-in',
                    ],                  
                ],
 		    ]
 		);
				
		$this->end_controls_section();
		        
		$this->start_controls_section(
            'dynamic_settings',
            [
                'label' => esc_html__( 'Dynamic Settings', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,  
				'condition' => [
					'team_grid_source' => 'dynamic',
				],           
            ]
        );

        $this->add_control(
            'team_col_xxl',
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
                'separator' => 'before',
                            
            ]
            
        );
    
        $this->add_control(
            'team_col_xl',
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
                'separator' => 'before',
                            
            ]
            
        );
    
        $this->add_control(
            'team_col_lg',
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
                'separator' => 'before',                            
            ]
            
        );

        $this->add_control(
            'team_col_md',
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
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'team_col_sm',
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
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'team_col_xs',
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
                'separator' => 'before',
                            
            ]
            
        );

		$this->end_controls_section();

		        
		$this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__( 'Slider Settings', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_CONTENT,  
				'condition' => [
					'team_grid_source' => 'slider',
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
                
        $this->end_controls_section();

        $this->start_controls_section(
			'team_item_style',
			[
				'label' => esc_html__( 'Item', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        

        // $this->add_responsive_control(
		// 	'team_item_direction',
		// 	[
		// 		'label' => esc_html__( 'Vertical Position', 'tp-elements' ),
		// 		'type' => Controls_Manager::CHOOSE,
        //         'default'   => 'column',
		// 		'options' => [
		// 			'column' => [
		// 				'title' => esc_html__( 'Top', 'tp-elements' ),
		// 				'icon' => 'eicon-align-start-v',
		// 			],
		// 			'row' => [
		// 				'title' => esc_html__( 'Start', 'tp-elements' ),
		// 				'icon' => 'eicon-flex eicon-align-start-h',
		// 			],
		// 		],
        //         'selectors' => [
        //             '{{WRAPPER}} .team-item .team-inner-wrap' => 'flex-direction: {{VALUE}};',
        //         ],
		// 	]
		// );

        
        // $this->add_responsive_control(
		// 	'team_item_position',
		// 	[
		// 		'label' => esc_html__( 'Item Position', 'tp-elements' ),
		// 		'type' => Controls_Manager::CHOOSE,
        //         'default'   => 'start',
		// 		'options' => [
		// 			'start' => [
		// 				'title' => esc_html__( 'Start', 'tp-elements' ),
		// 				'icon' => 'eicon-flex eicon-align-start-h',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__( 'Center', 'tp-elements' ),
		// 				'icon' => 'eicon-align-center-v',
		// 			],
		// 			'end' => [
		// 				'title' => esc_html__( 'End', 'tp-elements' ),
		// 				'icon' => 'eicon-flex eicon-align-end-h',
		// 			],
		// 		],
        //         'selectors' => [
        //             '{{WRAPPER}} .team-item .team-inner-wrap' => 'align-items: {{VALUE}};',
        //         ],
        //         'condition' => [
        //             'team_item_direction!' => 'column'
        //         ]
		// 	]
		// );

        // $this->start_controls_tabs( 'team_style_tabs' );

		// $this->start_controls_tab(
        //     'team_normal_tab',
        //     [
        //         'label' => esc_html__( 'Normal', 'tp-elements' ),
        //     ]
        // ); 

        // $this->add_group_control(
		//     Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'team_item_bg',
		// 		'label' => esc_html__( 'Background', 'tp-elements' ),
		// 		'types' => [ 'classic', 'gradient', 'image' ],
		// 		'selector' => '{{WRAPPER}} .team-item .team-inner-wrap',
		// 	]
		// );

        // $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name' => 'team_item_border',
		//         'selector' => '{{WRAPPER}} .team-item .team-inner-wrap',
		//     ]
		// );

        // $this->end_controls_tab();

		// $this->start_controls_tab(
        //     'team_hover_tab',
        //     [
        //         'label' => esc_html__( 'Hover', 'tp-elements' ),
        //     ]
        // ); 
        
        // $this->add_group_control(
		//     Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'team_item_bg_hover',
		// 		'label' => esc_html__( 'Background', 'tp-elements' ),
		// 		'types' => [ 'classic', 'gradient', 'image' ],
		// 		'selector' => '{{WRAPPER}} .team-item .team-inner-wrap:hover',
		// 	]
		// );

        // $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name' => 'team_item_border_hover',
		//         'selector' => '{{WRAPPER}} .team-item .team-inner-wrap:hover',
		//     ]
		// );

        // $this->end_controls_tab();
        // $this->end_controls_tabs();
        
        // $this->add_control(
		//     'team_item_border_radius',
		//     [
		//         'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		//         'type' => Controls_Manager::DIMENSIONS,
		//         'size_units' => [ 'px', '%' ],
		//         'selectors' => [
		//             '{{WRAPPER}} .team-item .team-inner-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		//         ],
		//     ]
		// );

        // $this->add_responsive_control(
        //     'team_item_padding',
        //     [
        //         'label' => esc_html__( 'Padding', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}}  .team-item .team-inner-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->end_controls_section();

        // $this->start_controls_section(
		// 	'team_image_style',
		// 	[
		// 		'label' => esc_html__( 'Image', 'tp-elements' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

        // $this->add_responsive_control(
		// 	'team_image_width',
		// 	[
		// 		'label' => esc_html__( 'Width', 'tp-elements' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		// 		'range' => [
		// 			'px' => [
		// 				'max' => 200,
		// 			],
        //             '%' => [
        //                 'min' => 1,
        //                 'max' => 100,
        //             ],
		// 			'em' => [
		// 				'max' => 20,
		// 			],
		// 			'rem' => [
		// 				'max' => 20,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .image-wrap' => 'width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

        // $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name' => 'team_image_border',
		//         'selector' => '{{WRAPPER}} .image-wrap',
		//     ]
		// );

        // $this->add_control(
		//     'team_image_border_radius',
		//     [
		//         'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		//         'type' => Controls_Manager::DIMENSIONS,
		//         'size_units' => [ 'px', '%' ],
		//         'selectors' => [
		//             '{{WRAPPER}} .image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		//         ],
		//     ]
		// );

        // // $this->add_control(
        // //     'image_overlay',
        // //     [
        // //         'label' => esc_html__( 'Image Overlay', 'tp-elements' ),
        // //         'type' => Controls_Manager::COLOR,
        // //         'condition' => [
        // //         	'team_grid_style' => 'style3',
        // //         ],
        // //         'selectors' => [
        // //             '{{WRAPPER}} .team_area-style3 .team-inner-wrap::before' => 'background: {{VALUE}};',

        // //         ],                
        // //     ]
        // // );

        // // $this->add_control(
        // //     'image_corner_border_color',
        // //     [
        // //         'label' => esc_html__( 'Image Corner Border Color', 'tp-elements' ),
        // //         'type' => Controls_Manager::COLOR,
        // //         'condition' => [
        // //         	'team_grid_style' => 'style3',
        // //         ],
        // //         'selectors' => [
        // //             '{{WRAPPER}} .team_area-style3 .team-item::before' => 'border-bottom-color: {{VALUE}};',
        // //             '{{WRAPPER}} .team_area-style3 .team-item::after' => 'border-top-color: {{VALUE}};',

        // //         ],
        // //     ]
        // // );

        // $this->end_controls_section();

        // $this->start_controls_section(
		// 	'team_content_box_style',
		// 	[
		// 		'label' => esc_html__( 'Content Box', 'tp-elements' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

        // // $this->add_responsive_control(
        // //     'team_content_box_position_bottom',
        // //     [
        // //         'label' => esc_html__( 'Bottom', 'tp-elements' ),
        // //         'type' => Controls_Manager::SLIDER,
        // //         'size_units' => [ 'px', '%', 'custom' ],
        // //         'range' => [
        // //             '%' => [
        // //                 'min' => 0,
        // //                 'max' => 100,
        // //             ],
        // //             'px' => [
        // //                 'min' => -100,
        // //                 'max' => 100,
        // //             ],
        // //         ],
        // //         'condition' => [
        // //             'team_grid_style' => 'style4',
        // //         ],
        // //         'selectors' => [
        // //             '{{WRAPPER}} .team_area-style4 .team-item .team-content' => 'bottom: {{SIZE}}{{UNIT}};',
        // //         ],
        // //     ]
        // // );
        
        // $this->add_responsive_control(
		// 	'team_content_box_max_width',
		// 	[
		// 		'label' => esc_html__( 'Max Width', 'tp-elements' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		// 		'range' => [
		// 			'px' => [
		// 				'max' => 200,
		// 			],
        //             '%' => [
        //                 'min' => 1,
        //                 'max' => 100,
        //             ],
		// 			'em' => [
		// 				'max' => 20,
		// 			],
		// 			'rem' => [
		// 				'max' => 20,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .team-content' => 'max-width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );
        
        // $this->add_responsive_control(
		// 	'team_content_box_width',
		// 	[
		// 		'label' => esc_html__( 'Width', 'tp-elements' ),
		// 		'type' => \Elementor\Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		// 		'range' => [
		// 			'px' => [
		// 				'max' => 200,
		// 			],
        //             '%' => [
        //                 'min' => 1,
        //                 'max' => 100,
        //             ],
		// 			'em' => [
		// 				'max' => 20,
		// 			],
		// 			'rem' => [
		// 				'max' => 20,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .team-content' => 'width: {{SIZE}}{{UNIT}};',
		// 		],
		// 	]
		// );

        // $this->add_responsive_control(
		// 	'team_content_box_align',
		// 	[
		// 		'label' => esc_html__( 'Text Align', 'tp-elements' ),
		// 		'type' => Controls_Manager::CHOOSE,
		// 		'default' => 'left',
		// 		'options' => [
		// 			'start' => [
		// 				'title' => esc_html__( 'Start', 'tp-elements' ),
		// 				'icon' => 'eicon-text-align-left',
		// 			],
		// 			'center' => [
		// 				'title' => esc_html__( 'Center', 'tp-elements' ),
		// 				'icon' => 'eicon-text-align-center',
		// 			],
		// 			'end' => [
		// 				'title' => esc_html__( 'End', 'tp-elements' ),
		// 				'icon' => 'eicon-text-align-right',
		// 			]
		// 		],
		// 		'selectors' => [
        //             '{{WRAPPER}} .team-content' => 'text-align: {{VALUE}};',
        //         ],
		// 	]
		// );

        // $this->start_controls_tabs( 'team_content_box_tabs' );

		// $this->start_controls_tab(
        //     'team_content_box_normal_tab',
        //     [
        //         'label' => esc_html__( 'Normal', 'tp-elements' ),
        //     ]
        // ); 

        // $this->add_group_control(
		//     Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'team_content_box_bg',
		// 		'label' => esc_html__( 'Background', 'tp-elements' ),
		// 		'types' => [ 'classic', 'gradient', 'image' ],
		// 		'selector' => '{{WRAPPER}} .team-content',
		// 	]
		// );

        // $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name' => 'team_content_box_border',
		//         'selector' => '{{WRAPPER}} .team-content',
		//     ]
		// );

        // $this->add_group_control(
		// 	\Elementor\Group_Control_Box_Shadow::get_type(),
		// 	[
		// 		'name' => 'team_content_box_shadow',
		// 		'selector' => '{{WRAPPER}} .team-content',
		// 	]
		// );

        // $this->end_controls_tab();

		// $this->start_controls_tab(
        //     'team_content_box_hover_tab',
        //     [
        //         'label' => esc_html__( 'Hover', 'tp-elements' ),
        //     ]
        // ); 
        
        // $this->add_group_control(
		//     Group_Control_Background::get_type(),
		// 	[
		// 		'name' => 'team_content_box_bg_hover',
		// 		'label' => esc_html__( 'Background', 'tp-elements' ),
		// 		'types' => [ 'classic', 'gradient', 'image' ],
		// 		'selector' => '{{WRAPPER}} .team-content:hover',
		// 	]
		// );

        // $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name' => 'team_content_box_border_hover',
		//         'selector' => '{{WRAPPER}} .team-content:hover',
		//     ]
		// );

        // $this->add_group_control(
		// 	\Elementor\Group_Control_Box_Shadow::get_type(),
		// 	[
		// 		'name' => 'team_content_box_shadow',
		// 		'selector' => '{{WRAPPER}} .team-content:hover',
		// 	]
		// );

        // $this->end_controls_tab();
        // $this->end_controls_tabs();
        
        // $this->add_control(
		//     'team_content_box_border_radius',
		//     [
		//         'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		//         'type' => Controls_Manager::DIMENSIONS,
		//         'size_units' => [ 'px', '%' ],
		//         'selectors' => [
		//             '{{WRAPPER}} .team-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
		//         ],
		//     ]
		// );

        // $this->add_responsive_control(
        //     'team_content_box_padding',
        //     [
        //         'label' => esc_html__( 'Padding', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}}  .team-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->add_responsive_control(
        //     'team_content_box_margin',
        //     [
        //         'label' => esc_html__( 'Margin', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}}  .team-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->end_controls_section();

        // $this->start_controls_section(
		// 	'team_content_style',
		// 	[
		// 		'label' => esc_html__( 'Content', 'tp-elements' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

        // $this->add_control(
        //     'team_content_head_title',
        //     [
        //         'type' => Controls_Manager::HEADING,
        //         'label' => esc_html__( 'Content Head', 'tp-elements' ),
        //         'separator'   => 'before', 
        //     ]
        // );

        // $this->add_group_control(
		//     Group_Control_Border::get_type(),
		//     [
		//         'name' => 'team_content_head_border',
		//         'selector' => '{{WRAPPER}} .team-item .team-head',
		//     ]
		// );

        // $this->add_responsive_control(
        //     'team_content_head_padding',
        //     [
        //         'label' => esc_html__( 'Padding', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}}  .team-item .team-head' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'team_content_title',
        //     [
        //         'type' => Controls_Manager::HEADING,
        //         'label' => esc_html__( 'Title', 'tp-elements' ),
        //         'separator'   => 'before', 
        //     ]
        // );

        // $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'team_title_typography',
		// 		'label' => esc_html__( 'Typography', 'tp-elements' ),
		// 		'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
		// 		'selector' =>
        //             '{{WRAPPER}} .team-item .team-content .team-name'
		// 	]
		// );

        // $this->start_controls_tabs( 'team_content_tabs' );

		// $this->start_controls_tab(
        //     'team_content_normal_tab',
        //     [
        //         'label' => esc_html__( 'Normal', 'tp-elements' ),
        //     ]
        // ); 

        // $this->add_control(
        //     'title_color',
        //     [
        //         'label' => esc_html__( 'Color', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .team_area-style1 .team-item .team-content h3.team-name a' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style6 .team-item .team-content h3.team-name a' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style7 .team-item .team-content h3.team-name a' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style2 .team-item-wrap .team-img .team-content .team-name a' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style3 .team-img .team-img-sec .team-content .team-name a' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style4 .team-item .team-content .team-name a' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style5 .team-inner-wrap .team-content .member-desc .team-name a' => 'color: {{VALUE}};',
        //         ],                
        //     ]
        // );

        // $this->end_controls_tab();

		// $this->start_controls_tab(
        //     'team_content_hover_tab',
        //     [
        //         'label' => esc_html__( 'Hover', 'tp-elements' ),
        //     ]
        // ); 
        
        // $this->add_control(
        //     'title_color_hover',
        //     [
        //         'label' => esc_html__( 'Color', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .team_area-style1 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style6 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style7 .team-item .team-content h3.team-name a:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style2 .team-item-wrap .team-img .team-content .team-name a:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style3 .team-img .team-img-sec .team-content .team-name a:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style4 .team-item .team-content .team-name a:hover' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style5 .team-inner-wrap:hover .team-content .member-desc .team-name a:hover' => 'color: {{VALUE}};',
        //         ],                
        //     ]
        // );

        // $this->end_controls_tab();
        // $this->end_controls_tabs();

        // $this->add_responsive_control(
        //     'team_title_margin',
        //     [
        //         'label' => esc_html__( 'Margin', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}} .team-item .team-content .team-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'team_content_subtitle',
        //     [
        //         'type' => Controls_Manager::HEADING,
        //         'label' => esc_html__( 'Subtitle', 'tp-elements' ),
        //         'separator'   => 'before', 
        //     ]
        // );

        // $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'team_subtitle_typography',
		// 		'label' => esc_html__( 'Typography', 'tp-elements' ),
		// 		'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
		// 		'selector' =>
        //             '{{WRAPPER}} .team-item .team-content .team-title'
		// 	]
		// );

        // $this->add_control(
        //     'team_subtitle_color',
        //     [
        //         'label' => esc_html__( 'Color', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .team-item .team-content .team-title' => 'color: {{VALUE}};',
        //         ],                
        //     ]
        // );

        // $this->add_responsive_control(
        //     'team_subtitle_margin',
        //     [
        //         'label' => esc_html__( 'Margin', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}} .team-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'team_content_description',
        //     [
        //         'type' => Controls_Manager::HEADING,
        //         'label' => esc_html__( 'Description', 'tp-elements' ),
        //         'separator'   => 'before', 
        //     ]
        // );

        // $this->add_group_control(
		// 	Group_Control_Typography::get_type(),
		// 	[
		// 		'name' => 'team_desc_typography',
		// 		'label' => esc_html__( 'Typography', 'tp-elements' ),
		// 		'scheme' => Elementor\Core\Schemes\Typography::TYPOGRAPHY_1,
		// 		'selector' =>
        //             '{{WRAPPER}} .team-desc'
		// 	]
		// );

        // $this->add_control(
        //     'team_desc_color',
        //     [
        //         'label' => esc_html__( 'Color', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .team-desc' => 'color: {{VALUE}};',
        //         ],                
        //     ]
        // );

        // $this->add_responsive_control(
        //     'team_desc_margin',
        //     [
        //         'label' => esc_html__( 'Margin', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}} .team-desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->end_controls_section();


		// $this->start_controls_section(
		// 	'team_social_style',
		// 	[
		// 		'label' => esc_html__( 'Team Social', 'tp-elements' ),
		// 		'tab' => Controls_Manager::TAB_STYLE,
		// 	]
		// );

        // $this->add_responsive_control(
        //     'team_social_align',
        //     [
        //         'label' => esc_html__( 'Alignment', 'tp-elements' ),
        //         'type' => \Elementor\Controls_Manager::CHOOSE,
        //         'default' => 'start',
        //         'options' => [
        //             'start' => [
        //                 'title' => esc_html__( 'Start', 'tp-elements' ),
        //                 'icon' => 'eicon-text-align-left',
        //             ],
        //             'center' => [
        //                 'title' => esc_html__( 'Center', 'tp-elements' ),
        //                 'icon' => 'eicon-text-align-center',
        //             ],
        //             'end' => [
        //                 'title' => esc_html__( 'End', 'tp-elements' ),
        //                 'icon' => 'eicon-text-align-right',
        //             ],
        //             'space-between' => [
        //                 'title' => esc_html__( 'Justify', 'tp-elements' ),
        //                 'icon' => 'eicon-text-align-right',
        //             ]
                    
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .team-content .social-icons' => 'justify-content: {{VALUE}};',
        //         ],
        //     ]
        // );

        // $this->add_responsive_control(
		// 	'team_social_spacing',
		// 	[
		// 		'label' => esc_html__( 'Gap', 'elementor' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'range' => [
		// 			'px' => [
		// 				'max' => 400,
		// 			],
		// 			'vw' => [
		// 				'max' => 50,
		// 				'step' => 0.1,
		// 			],
		// 		],
		// 		'size_units' => [ 'px', 'vw', 'custom' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .team-content .social-icons' => 'gap: {{SIZE}}{{UNIT}}',
		// 		]
		// 	]
		// );

        // $this->add_responsive_control(
        //     'team_social_padding',
        //     [
        //         'label' => esc_html__( 'Padding', 'tp-elements' ),
        //         'type' => Controls_Manager::DIMENSIONS,
        //         'size_units' => [ 'px', 'em', '%' ],
        //         'selectors' => [
        //             '{{WRAPPER}}  .team-content .social-icons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
        //         ],
        //     ]
        // );

        // $this->add_control(
        //     'icon_section_bg',
        //     [
        //         'label' => esc_html__( 'Icon Section Background', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'condition' => [
        //         	'team_grid_style' => 'style1',
        //         ],
        //         'selectors' => [
        //             '{{WRAPPER}} .team_area-style1 .team-item .image-wrap .social-icons1' => 'background: {{VALUE}};',
        //         ],             
        //     ]
        // );
		
        
		// $this->add_responsive_control(
		// 	'team_icon_size',
		// 	[
		// 		'label' => esc_html__( 'Size', 'tp-elements' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => 6,
		// 				'max' => 300,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .social-icons .social-icon' => 'font-size: {{SIZE}}{{UNIT}};',
		// 			'{{WRAPPER}} .social-icons .social-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
		// 		],
		// 		'separator' => 'before',
		// 	]
		// );


        // $this->start_controls_tabs( 'team_social_tabs' );

		// $this->start_controls_tab(
        //     'team_social_normal_tab',
        //     [
        //         'label' => esc_html__( 'Normal', 'tp-elements' ),
        //     ]
        // ); 

        // $this->add_control(
        //     'icon_color',
        //     [
        //         'label' => esc_html__( 'Icon Color', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .social-icons1 a i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .social-icons1 a svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team-social a i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team-social a svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style4 .team-item .team-content .social-icons a i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style4 .team-item .team-content .social-icons a svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style5 .team-inner-wrap .team-content .social-icons a i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style5 .team-inner-wrap .team-content .social-icons a svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team-inner-wrap .social-icons a i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team-inner-wrap .social-icons a svg' => 'fill: {{VALUE}};',
        //         ],              
        //     ]
        // );

		// $this->add_control(
		// 	'team_icon_background',
		// 	[
		// 		'label' => esc_html__( 'Background Color', 'tp-elements' ),
		// 		'type' => Controls_Manager::COLOR,	
		// 		'selectors' => [
		// 			'{{WRAPPER}} .social-icons .social-icon' => 'background: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Box_Shadow::get_type(),
		// 	[
		// 		'name' => 'team_icon_shadow',
		// 		'selector' => '{{WRAPPER}} .social-icons .social-icon',
		// 	]
		// );
        
		// $this->add_group_control(
		// 	\Elementor\Group_Control_Border::get_type(),
		// 	[
		// 		'name' => 'team_icon_border',
		// 		'selector' => '{{WRAPPER}} .social-icons .social-icon',
		// 	]
		// );

		// $this->end_controls_tab();

		// $this->start_controls_tab(
		// 	'team_icon_colors_hover',
		// 	[
		// 		'label' => esc_html__( 'Hover', 'tp-elements' ),
		// 	]
		// );

		// $this->add_control(
        //     'icon_color_hover',
        //     [
        //         'label' => esc_html__( 'Icon Color', 'tp-elements' ),
        //         'type' => Controls_Manager::COLOR,
        //         'selectors' => [
        //             '{{WRAPPER}} .social-icons1 a:hover i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .social-icons1 a:hover svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team-social a:hover i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team-social a:hover svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style4 .team-item .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style4 .team-item .team-content .social-icons a:hover svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style5 .team-inner-wrap .team-content .social-icons a:hover i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team_area-style5 .team-inner-wrap .team-content .social-icons a:hover svg' => 'fill: {{VALUE}};',
        //             '{{WRAPPER}} .team-inner-wrap .social-icons a:hover i' => 'color: {{VALUE}};',
        //             '{{WRAPPER}} .team-inner-wrap .social-icons a:hover svg' => 'fill: {{VALUE}};',
        //         ],              
        //     ]
        // );

		// $this->add_control(
		// 	'team_hover_icon_background',
		// 	[
		// 		'label' => esc_html__( 'Background Color', 'tp-elements' ),
		// 		'type' => Controls_Manager::COLOR,				
		// 		'selectors' => [
		// 			'{{WRAPPER}} .social-icons .social-icon:hover' => 'background: {{VALUE}};',
		// 		],
		// 	]
		// );

		// $this->add_group_control(
		// 	\Elementor\Group_Control_Box_Shadow::get_type(),
		// 	[
		// 		'name' => 'team_hover_icon_shadow',
		// 		'selector' => '{{WRAPPER}} .social-icons .social-icon:hover',
		// 	]
		// );
        
		// $this->add_group_control(
		// 	\Elementor\Group_Control_Border::get_type(),
		// 	[
		// 		'name' => 'team_icon_border',
		// 		'selector' => '{{WRAPPER}} .social-icons .social-icon:hover',
		// 	]
		// );

		// $this->end_controls_tab();

		// $this->end_controls_tabs();

		// $this->add_responsive_control(
		// 	'team_icon_border_radius',
		// 	[
		// 		'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		// 		'type' => Controls_Manager::DIMENSIONS,
		// 		'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .social-icons .social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		// 		],
		// 	]
		// );

		// $this->add_responsive_control(
		// 	'team_icon_padding',
		// 	[
		// 		'label' => esc_html__( 'Padding', 'tp-elements' ),
		// 		'type' => Controls_Manager::SLIDER,
		// 		'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .social-icons .social-icon' => 'padding: {{SIZE}}{{UNIT}};',
		// 		],
		// 		'range' => [
		// 			'px' => [
		// 				'max' => 50,
		// 			],
		// 			'em' => [
		// 				'min' => 0,
		// 				'max' => 5,
		// 			],
		// 			'rem' => [
		// 				'min' => 0,
		// 				'max' => 5,
		// 			],
		// 		],
		// 	]
		// );

		$this->end_controls_section();

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
		$team_style = $settings['team_grid_style'];

		if( $settings['team_grid_source'] == 'slider' ) {

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
			$pagination_class = '.tp-team-pagination ';

			if (!empty($settings['pagination_type'])) {
				$pagination = 'pagination: { ';
				$pagination .= 'el: "' . $pagination_class . '", ';
				$pagination .= 'type: "' . $pagination_type . '", ';
				$pagination .= 'dynamicBullets: ' . $dynamic_bullets;
				$pagination .= ' }';
			}

		}

		?>

		<div class="tp-teams-wrapper team_area-<?php echo esc_html($settings['team_grid_style']);?>">

			<?php if( $settings['team_grid_source'] == 'dynamic' || $settings['team_grid_source'] == 'slider' ) : ?>
			<?php if( $settings['team_grid_source'] == 'dynamic' ) : ?>
			<!-- start for team dynamics  -->
			<div class="team_area-dynamic">
				<div class="row ">
				<?php elseif($settings['team_grid_source'] == 'slider') : ?>
			<div class="swiper tp_team-<?php echo esc_attr($unique); ?> ">
				<div class="swiper-wrapper ">
				<?php else : ?>
				<?php endif; ?>
						<?php 

						if ( $settings['teacher_items'] ) {	
						foreach (  $settings['teacher_items'] as $teacher ) :					


						?>

						<?php if($settings['team_grid_source'] == 'dynamic') : 
						
						if($team_style){
							require plugin_dir_path(__FILE__)."/dynamic/$team_style.php";
						}else{
							require plugin_dir_path(__FILE__)."/dynamic/style1.php";
						}

						endif; ?>

						<?php if($settings['team_grid_source'] == 'slider') : 
						  
						if($team_style){
							require plugin_dir_path(__FILE__)."/slider/$team_style.php";
						}else{
							require plugin_dir_path(__FILE__)."/slider/style1.php";
						}
						
						endif; ?>
						
						<?php 

					endforeach;
					}
					?>  
			<?php if( $settings['team_grid_source'] == 'dynamic' || $settings['team_grid_source'] == 'slider' ) : ?>
				</div>
			</div>
			<!-- end for team dynamics  -->
			 <?php endif; ?>

			<?php else :

				if($team_style){
					require plugin_dir_path(__FILE__)."/custom/$team_style.php";
				}else{
					require plugin_dir_path(__FILE__)."/custom/style1.php";
				}

			endif;
			?>

		</div>

		<?php if( $settings['team_grid_source'] == 'slider' ) : ?>

		<script type="text/javascript"> 
		jQuery(document).ready(function(){
					
			var swiper = new Swiper(".tp_team-<?php echo esc_attr($unique); ?>", {				
				slidesPerView: <?php echo $slidesToShow;?>,
				<?php echo $seffect; ?>
				speed: <?php echo esc_attr($autoplaySpeed); ?>,
				loop: <?php echo esc_attr($infinite ); ?>,
				<?php echo esc_attr($slider_autoplay); ?>,
				spaceBetween:  <?php echo esc_attr($item_gap); ?>,
				<?php echo $pagination; ?>,
				centeredSlides: <?php echo esc_attr($centerMode); ?>,
				navigation: {
					nextEl: ".tp-team-slide-next",
					prevEl: ".tp-team-slide-prev",
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

?>