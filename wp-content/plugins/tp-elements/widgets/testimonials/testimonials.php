<?php
/**
 * Logo widget class
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined( 'ABSPATH' ) || die();
class Themephi_Elementor_Testimonials_Widget  extends \Elementor\Widget_Base {
  
    /**
     * Get widget name.
     *   
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'tp-testimonials';
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
        return esc_html__( 'TP Testimonials', 'tp-elements' );
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
        return 'eicon-gallery-grid';
    }
    public function get_categories() {
        return [ 'pielements_category' ];
    }
    public function get_keywords() {
        return [ 'slider' ];
    }
    protected function register_controls() {

        $this->start_controls_section(
            '_services_slider_s',
            [
                'label' => esc_html__( 'Testimonial Global', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'testimonial_grid_source',
			[
				'label'   => esc_html__( 'Testimonial Type', 'tp-elements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'custom',				
				'options' => [
					'custom' => esc_html__('Custom', 'tp-elements'),					
					'slider' => esc_html__('Slider', 'tp-elements'),						
				],											
			]
		);

        $this->add_control(
            'testimonial_style',
            [
                'label'   => esc_html__( 'Select Style', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [					
                    'style1' => esc_html__( 'Style 1', 'tp-elements'),
                    'style2' => esc_html__( 'Style 2', 'tp-elements'),
                    'style3' => esc_html__( 'Style 3', 'tp-elements'),
                    'style4' => esc_html__( 'Style 4', 'tp-elements'),
                    'style5' => esc_html__( 'Style 5', 'tp-elements'),
                    'style6' => esc_html__( 'Style 6', 'tp-elements'),
                ],
            ]
        ); 
                
		$this->add_control(
			'show_quote_icon',
			[
				'label' => esc_html__( 'Show Quote Icon', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
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
                    'show_quote_icon' => 'yes',
                ],
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Select Icon', 'tp-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => 'icon',
                    'show_quote_icon' => 'yes',
				],				
			]
		);
		$this->add_control(
			'selected_image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,				
				
				'condition' => [
					'icon_type' => 'image',
                    'show_quote_icon' => 'yes',
				],
				'separator' => 'before',
			]
		);		

        $this->add_control(
			'custom_item_image',
			[
				'label' => esc_html__( 'Item Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,	
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'testimonial_style' => 'style3'
                ]
			]
		);

        $this->end_controls_section();

        
		$this->start_controls_section(
			'section_custom_content',
			[
				'label' => esc_html__( 'Custom Content', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'testimonial_grid_source' => 'custom',
				],	
			]
		);

		$this->add_control(
			'custom_image',
			[
				'label' => esc_html__( 'Choose Image', 'tp-elements' ),
				'type'  => Controls_Manager::MEDIA,	
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],			
				'separator' => 'before',
			]
		);
        
        $this->add_control(
            'custom_designation',
            [
                'label' => esc_html__('Designation', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'designation', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'custom_name',
            [
                'label' => esc_html__('Name', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Masum Billah', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'custom_description',
            [
                'label' => esc_html__('Description', 'tp-elements'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );


        $this->add_control(
            'custom_rating',
            [
                'label'   => esc_html__( 'Select Rating', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '5',
                'options' => [					
                    '1' => esc_html__( '1', 'tp-elements'),
                    '1.5' => esc_html__( '1.5', 'tp-elements'),
                    '2' => esc_html__( '2', 'tp-elements'),
                    '2.5' => esc_html__( '2.5', 'tp-elements'),
                    '3' => esc_html__( '3', 'tp-elements'),
                    '3.5' => esc_html__( '3.5', 'tp-elements'),
                    '4' => esc_html__( '4', 'tp-elements'),
                    '4.5' => esc_html__( '4.5', 'tp-elements'),
                    '5' => esc_html__( '5', 'tp-elements'),
                ],
                
            ]
        );

        
		$this->add_control(
			'custom_enable_btn',
			[
				'label' => esc_html__( 'Enable Button', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $this->add_control(
            'custom_btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'tp-elements' ),
                'separator'   => 'before',
                'condition' => [
                    'custom_enable_btn' => 'yes'
                ],
            ]
        );
        
        $this->add_control(
            'custom_link',
            [
                'label' => esc_html__('Link', 'tp-elements'),
                'type' => Controls_Manager::URL,  
                'condition' => [
                    'custom_enable_btn' => 'yes'
                ],              
            ]
        ); 


		$this->end_controls_section();


        $this->start_controls_section(
            '_slider_content',
            [
                'label' => esc_html__( 'Slider Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
					'testimonial_grid_source' => 'slider',
				],	
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'tp-elements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        ); 

		$repeater->add_control(
            'person_designation',
            [
                'label' => esc_html__('Designation', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Web Developer', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'designation', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'person_name',
            [
                'label' => esc_html__('Title', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Masum Billah', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'tp-elements'),
                'type' => Controls_Manager::WYSIWYG,
                'default' => __('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Description', 'tp-elements' ),
                'separator'   => 'before',
            ]
        );


        $repeater->add_control(
            'tp_rating',
            [
                'label'   => esc_html__( 'Select Rating', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '5',
                'options' => [					
                    '1' => esc_html__( '1', 'tp-elements'),
                    '1.5' => esc_html__( '1.5', 'tp-elements'),
                    '2' => esc_html__( '2', 'tp-elements'),
                    '2.5' => esc_html__( '2.5', 'tp-elements'),
                    '3' => esc_html__( '3', 'tp-elements'),
                    '3.5' => esc_html__( '3.5', 'tp-elements'),
                    '4' => esc_html__( '4', 'tp-elements'),
                    '4.5' => esc_html__( '4.5', 'tp-elements'),
                    '5' => esc_html__( '5', 'tp-elements'),
                ],
            ]
        );
        
        $repeater->add_control(
			'enable_btn',
			[
				'label' => esc_html__( 'Enable Button', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'tp-elements' ),
				'label_off' => esc_html__( 'Hide', 'tp-elements' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

        $repeater->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'tp-elements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('', 'tp-elements'),
                'label_block' => true,
                'placeholder' => esc_html__( 'Name', 'tp-elements' ),
                'separator'   => 'before',
                'condition' => [
                    'enable_btn' => 'yes'
                ],
            ]
        );
        
        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'tp-elements'),
                'type' => Controls_Manager::URL, 
                'condition' => [
                    'enable_btn' => 'yes'
                ],               
            ]
        ); 

        $this->add_control(
            'slider_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
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
					'testimonial_grid_source' => 'slider',
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
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'tp-elements' ),
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
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'tp-elements' ),
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
            'pcat_prev_text',
            [
                'label' => esc_html__( 'Previous Text', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Previous', 'tp-elements' ),
                'placeholder' => esc_html__( 'Type your title here', 'tp-elements' ),
                'condition' => [
                    'slider_nav' => 'true',
                ],
            ]
        );

        $this->add_control(
            'pcat_next_text',
            [
                'label' => esc_html__( 'Next Text', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__( 'Next', 'tp-elements' ),
                'placeholder' => esc_html__( 'Type your title here', 'tp-elements' ),
                'condition' => [
                    'slider_nav' => 'true',
                ],

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
			'contact_box_item_wrap',
			[
				'label' => esc_html__( 'Item Wrap', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_style' => ['style3', 'style5']
                ]
			]
		);

        $this->add_control(
		    'testimonial_item_wrap_direction',
		    [
		        'label' => esc_html__( 'Direction', 'tp-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => [
		        	'vertical' => esc_html__( 'Vertical', 'tp-elements'),
		        	'horizontal' => esc_html__( 'Horizontal', 'tp-elements'),		

		        ],
		        'default' => 'horizontal',
				'prefix_class' => 'tp-item-wrap-direction-',
		    ]
		);

        $this->add_responsive_control(
			'testimonial_item_wrap_position',
			[
				'label' => esc_html__( 'Align Items', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .item--wrap' => 'align-items: {{VALUE}};',
                ],
			]
		);

        $this->add_responsive_control(
			'testimonial_item_wrap_spacing',
			[
				'label' => esc_html__( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
					'vw' => [
						'max' => 50,
						'step' => 0.1,
					],
				],
				'size_units' => [ 'px', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .item--wrap' => 'gap: {{SIZE}}{{UNIT}}',
				]
			]
		);

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'testimonial_item_wrap_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .item--wrap',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_item_wrap_shadow_hover',
				'selector' => '{{WRAPPER}} .item--wrap',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_item_wrap_border',
				'selector' => '{{WRAPPER}} .item--wrap',
			]
		);
        
        $this->add_responsive_control(
			'testimonial_item_wrap_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .item--wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->add_responsive_control(
            'testimonial_item_wrap_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .item--wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'item_wrap_image_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Image', 'tp-elements' ),
		        'separator' => 'after'
		    ]
		);

        $this->add_responsive_control(
		    'item_wrap_image_width',
		    [
		        'label' => esc_html__( 'Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
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
		            '{{WRAPPER}} .item--img' => 'width: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_responsive_control(
		    'item_wrap_image_height',
		    [
		        'label' => esc_html__( 'Height', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
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
		            '{{WRAPPER}} .item--img' => 'height: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
		    'item_wrap_image_img_size',
		    [
		        'label' => esc_html__( 'Display Size', 'tp-elements' ),
		        'type' => Controls_Manager::SELECT,
                'responsive' => true,
		        'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'cover' => esc_html__( 'Cover', 'tp-elements' ),
                    'fill' => esc_html__( 'Fill', 'tp-elements' ),
                    'contain' => esc_html__( 'Contain', 'tp-elements' ),
                ],
		        'default' => '',
                'prefix_class' => 'tp-item-wrap-img-',
		    ]
		);
        
        $this->add_control(
		    'item_wrap_image_img_position',
		    [
		        'label' => esc_html__( 'Position', 'tp-elements' ),
		        'type' => Controls_Manager::SELECT,
                'responsive' => true,
		        'options' => [
                    '' => esc_html__( 'Default', 'tp-elements' ),
                    'top' => esc_html__( 'Top Center', 'tp-elements' ),
                    'center' => esc_html__( 'Center Center', 'tp-elements' ),
                    'bottom' => esc_html__( 'Bottom Center', 'tp-elements' ),

                ],
		        'default' => '',
                'prefix_class' => 'tp-item-wrap-img-position-',
		    ]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'item_wrap_image_border',
				'selector' => '{{WRAPPER}} .item--img img',
			]
		);
        
        $this->add_responsive_control(
			'item_wrap_image_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .item--img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
			'contact_box_item',
			[
				'label' => esc_html__( 'Item', 'tp-elements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        
		$this->add_responsive_control(
            'testimonial_text_align',
            [
                'label' => esc_html__( 'Text Align', 'tp-elements' ),
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
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .single--item' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( 'testimonial_item_tabs' );

		$this->start_controls_tab(
            'testimonial_item_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'testimonial_item_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .single--item',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_item_shadow',
				'selector' => '{{WRAPPER}} .single--item',
			]
		);
        
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_item_border',
				'selector' => '{{WRAPPER}} .single--item',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'testimonial_item_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'tp-elements' ),
			]
		);

		$this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'testimonial_item_background_hover',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .single--item:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'testimonial_item_shadow_hover',
				'selector' => '{{WRAPPER}} .single--item:hover',
			]
		);

        $this->add_control(
		    'testimonial_item_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .single--item:hover' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_responsive_control(
			'testimonial_item_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'tp-elements' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .single--item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->add_responsive_control(
            'testimonial_item_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .single--item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_item_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .single--item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'item_tooltip_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Tooltip', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'testimonial_style' => 'style4'
                ]
		    ]
		);

        $this->add_responsive_control(
            'item_tooltip_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-testimonial-style4 .single--item::before' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'style4'
                ]
            ]
        );

        $this->add_responsive_control(
            'item_tooltip_position_left',
            [
                'label' => esc_html__( 'Left', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-testimonial-style4 .single--item::before' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'testimonial_style' => 'style4'
                ]
            ]
        );

        $this->add_responsive_control(
		    'item_tooltip_width',
		    [
		        'label' => esc_html__( 'Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
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
		            '{{WRAPPER}} .tp-testimonial-style4 .single--item::before' => 'width: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'testimonial_style' => 'style4'
                ]
		    ]
		);

		$this->add_responsive_control(
		    'item_tooltip_height',
		    [
		        'label' => esc_html__( 'Height', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
		            '{{WRAPPER}} .tp-testimonial-style4 .single--item::before' => 'height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'testimonial_style' => 'style4'
                ]
		    ]
		);

        $this->add_group_control(
		    Group_Control_Background::get_type(),
			[
				'name' => 'item_tooltip_background',
				'label' => esc_html__( 'Background', 'tp-elements' ),
				'types' => [ 'classic', 'gradient' ],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .tp-testimonial-style4 .single--item::before',
                'condition' => [
                    'testimonial_style' => 'style4'
                ]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
		    'rs_contact_icons',
		    [
		        'label' => esc_html__( 'Admin Info', 'tp-elements' ),
		        'tab'   => Controls_Manager::TAB_STYLE,
		    ]
		);

        $this->add_responsive_control(
            'admin_text_align',
            [
                'label' => esc_html__( 'Text Align', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'left',
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
                    ]
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .content--box .description' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
		    'testimonial_admin',
		    [
		        'label' => esc_html__( 'Direction', 'tp-elements' ),
		        'type' => Controls_Manager::SELECT,
		        'options' => [
		        	'vertical' => esc_html__( 'Vertical', 'tp-elements'),
		        	'horizontal' => esc_html__( 'Horizontal', 'tp-elements'),		

		        ],
		        'default' => 'horizontal',
				'prefix_class' => 'tp-testimonial-direction-',
		    ]
		);

        $this->add_responsive_control(
			'testimonial_admin_position',
			[
				'label' => esc_html__( 'Align Items', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .content--box' => 'align-items: {{VALUE}};',
                ],
			]
		);

        $this->add_responsive_control(
			'testimonial_admin_justify',
			[
				'label' => esc_html__( 'Justify Content', 'tp-elements' ),
				'type' => Controls_Manager::CHOOSE,
                'default'   => 'start',
				'options' => [
					'start' => [
						'title' => esc_html__( 'Start', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-start-h',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'tp-elements' ),
						'icon' => 'eicon-align-center-v',
					],
					'end' => [
						'title' => esc_html__( 'End', 'tp-elements' ),
						'icon' => 'eicon-flex eicon-align-end-h',
					],
				],
                'selectors' => [
                    '{{WRAPPER}} .content--box' => 'justify-content: {{VALUE}};',
                ],
                'condition' => [
                    'testimonial_admin' => 'horizontal'
                ]
			]
		);

        $this->add_responsive_control(
			'testimonial_admin_spacing',
			[
				'label' => esc_html__( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
					'vw' => [
						'max' => 50,
						'step' => 0.1,
					],
				],
				'size_units' => [ 'px', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .content--box' => 'gap: {{SIZE}}{{UNIT}}',
				]
			]
		);

        $this->add_control(
            'testimonial_admin_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'tp-elements' ),
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
                    '{{WRAPPER}} .content--box' => 'margin-bottom:{{SIZE}}{{UNIT}};',                  
                ],
                'condition' => [
                    'testimonial_style!' => 'style6'
                ]
            ]
        ); 

        $this->add_control(
            'testimonial_admin_wrap_bottom',
            [
                'label' => esc_html__( 'Margin Bottom', 'tp-elements' ),
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
                    '{{WRAPPER}} .content-wrap' => 'margin-bottom:{{SIZE}}{{UNIT}};',                    
                ],
                'condition' => [
                    'testimonial_style' => 'style6'
                ]
            ]
        ); 

        $this->add_control(
		    'admin_image_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Image', 'tp-elements' ),
		        'separator' => 'before',
                'condition' => [
                    'testimonial_style!' => 'style5'
                ]
		    ]
		);

        $this->add_responsive_control(
		    'admin_image_width',
		    [
		        'label' => esc_html__( 'Width', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px', '%', 'custom' ],
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
		            '{{WRAPPER}} .banner-image' => 'width: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'testimonial_style!' => 'style5'
                ]
		    ]
		);

		$this->add_responsive_control(
		    'admin_image_height',
		    [
		        'label' => esc_html__( 'Height', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'custom' ],
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
		            '{{WRAPPER}} .banner-image' => 'height: {{SIZE}}{{UNIT}};',
		        ],
                'condition' => [
                    'testimonial_style!' => 'style5'
                ]
		    ]
		);

        $this->add_group_control(
		    Group_Control_Border::get_type(),
		    [
		        'name' => 'admin_image_border',
		        'selector' => '{{WRAPPER}} .banner-image',
                'condition' => [
                    'testimonial_style!' => 'style5'
                ]
		    ]
		);

		$this->add_responsive_control(
		    'admin_image_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%' ],
		        'selectors' => [
		            '{{WRAPPER}} .banner-image, {{WRAPPER}} .banner-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		        ],
                'condition' => [
                    'testimonial_style!' => 'style5'
                ]
		    ]
		);

        $this->add_responsive_control(
            'admin_image_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}}  .banner-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
                'condition' => [
                    'testimonial_style!' => 'style5'
                ]
            ]
        );

        $this->add_control(
		    'admin_title_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Title', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'admin_title_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}}  .slider-title',
		        
		    ]
		);	

        $this->add_control(
            'admin_title_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-title' => 'color: {{VALUE}};',
                ],              
            ]
        );

        $this->add_responsive_control(
            'admin_title_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
                'selectors' => [
                    '{{WRAPPER}}  .slider-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
		    'admin_subtitle_heading',
		    [
		        'type' => Controls_Manager::HEADING,
		        'label' => esc_html__( 'Subtitle', 'tp-elements' ),
		        'separator' => 'before'
		    ]
		);

        $this->add_group_control(
		    Group_Control_Typography::get_type(),
		    [
		        'name' => 'admin_subtitle_typography',
		        'label' => esc_html__( 'Typography', 'tp-elements' ),
		        'selector' => '{{WRAPPER}}  .slider-subtitle',
		        
		    ]
		);	

        $this->add_control(
            'admin_subtitle_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-subtitle' => 'color: {{VALUE}};',
                ],              
            ]
        );

        $this->add_responsive_control(
            'admin_subtitle_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'max' => 50,
					],
					'em' => [
						'min' => 0,
						'max' => 5,
					],
					'rem' => [
						'min' => 0,
						'max' => 5,
					],
				],
                'selectors' => [
                    '{{WRAPPER}}  .slider-subtitle' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

		$this->end_controls_section();

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testimonial_desc_title',
            [
                'label' => esc_html__( 'Description', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des__typography',
                'selector' => '{{WRAPPER}} .review-body .desc',
            ]
        );
        
        $this->add_control(
            'des__color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .review-body .desc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'des__bg_color',
            [
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .review-body .desc' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'desc_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .review-body .desc' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'des__padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .review-body .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'des__margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .review-body .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'testimonial_rating_title',
            [
                'label' => esc_html__( 'Rating', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
			'testimonial_rating_gap',
			[
				'label' => esc_html__( 'Gap', 'elementor' ),
				'type' => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'max' => 400,
					],
					'vw' => [
						'max' => 50,
						'step' => 0.1,
					],
				],
				'size_units' => [ 'px', 'vw', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tp-el-star' => 'gap: {{SIZE}}{{UNIT}}',
				]
			]
		);

        $this->add_control(
            'rating_bg_color',
            [
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-star i' => 'background: {{VALUE}}',
                    '{{WRAPPER}} .tp-el-star span' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'rating_border',
				'selector' => '{{WRAPPER}} .tp-el-star span, {{WRAPPER}} .tp-el-star i',
                
			]
		);

        $this->add_control(
            'rating_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-star span, {{WRAPPER}} .tp-el-star i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'rating_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tp-el-star span, {{WRAPPER}} .tp-el-star i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
		    'rating_size',
		    [
		        'label' => esc_html__( 'Font Size', 'tp-elements' ),
		        'type' => Controls_Manager::SLIDER,
		        'size_units' => [ 'px' ],
		        'range' => [
		            'px' => [
		                'min' => 10,
		                'max' => 300,
		            ],
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-el-star i' => 'font-size: {{SIZE}}{{UNIT}};',
		        ],
		    ]
		);

        $this->add_control(
            'rating_title_color',
            [
                'label' => esc_html__( 'Rating Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-star i' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'testimonial_rating_number',
            [
                'label' => esc_html__( 'Rating Number', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'rating_number_typography',
                'selector' => '{{WRAPPER}} .tp-el-star span',
            ]
        );

        $this->add_control(
            'rating_number_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-el-star span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'testimonial_quote_style',
            [
                'label' => esc_html__( 'Quote Icon', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_quote_icon' => 'yes',
                ],
            ]
        );    

        $this->add_responsive_control(
            'testimonial_quote_size',
            [
                'label' => esc_html__( 'Size', 'tp-elements' ),
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
                    '{{WRAPPER}} .testimonial-quote-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testimonial-quote-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],    
                'condition' => [
                    'icon_type' => 'icon'
                ]   
            ]
        );  

        $this->add_control(
			'testimonial_quote_img_size',
			[
				'label' => esc_html__( 'Width & Height', 'tp-elements' ),
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
					'{{WRAPPER}} .testimonial-quote-icon img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				],
                'condition' => [
                    'icon_type' => 'image'
                ] 
			]
		);

        $this->add_responsive_control(
            'testimonial_quote_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],      
                'separator' => 'after',   
                      
            ]
        ); 

        $this->add_responsive_control(
            'testimonial_quote_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
                'condition' => [
                    'testimonial_quote_position!' => 'absolute',
                ],
            ]
        );

		$this->start_controls_tabs( 'testimonial_quote_tabs' );

		$this->start_controls_tab(
            'testimonial_quote_normal',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'testimonial_quote_color',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .testimonial-quote-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type' => 'icon'
                ]
                
            ]
        );         

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'blockquote_bg',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .testimonial-quote-icon',
                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'testimonial_quote_border',
				'selector' => '{{WRAPPER}} .testimonial-quote-icon',
                
			]
		);

        $this->end_controls_tab();

		$this->start_controls_tab(
            'testimonial_quote_hover',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'testimonial_quote_color_hover',
            [
                'label' => esc_html__( 'Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'icon_type' => 'icon'
                ]
            ]
        );         

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'      => 'blockquote_bg_hover',
                'label'     => esc_html__('Background', 'tp-elements'),
                'types'     => ['classic', 'gradient'],
                'exclude'   => [ 'image' ],
                'selector'  => '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon',
                
            ]
        );

        $this->add_control(
		    'testimonial_quote_border_hover',
		    [
		        'label' => esc_html__( 'Border Color', 'tp-elements' ),
		        'type' => Controls_Manager::COLOR,
		        'condition' => [
		            'button_border_border!' => '',
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .tp-blockquote blockquote:hover .tp-blockquote-icon' => 'border-color: {{VALUE}};',
		        ],
		    ]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
		    'testimonial_quote_border_radius',
		    [
		        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
		        'type' => Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
		        'selectors' => [ 
                    '{{WRAPPER}} .testimonial-quote-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};', 
		        ],
                
		    ]
		);

        $this->add_control(
            'testimonial_quote_position',
            [
                'label'   => esc_html__( 'Position', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',               
                'options' => [                    
                    'default' => 'Default',
                    'absolute' => 'Absolute',                             
                ],      
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'position: {{VALUE}};',
                ],   
                                               
            ]
        );

        $this->add_responsive_control(
			'blockquote_z_index',
			[
				'label' => esc_html__( 'Z-Index', 'elementor' ),
				'type' => Controls_Manager::NUMBER,
				'selectors' => [
					'{{WRAPPER}} .testimonial-quote-icon' => 'z-index: {{VALUE}};',
				],
                'condition' => [
                    'testimonial_quote_position' => 'absolute',
                ],
			]
		);

        $this->add_responsive_control(
            'testimonial_quote_position_top',
            [
                'label' => esc_html__( 'Top', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'testimonial_quote_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_quote_position_bottom',
            [
                'label' => esc_html__( 'Bottom', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'condition' => [
                    'testimonial_quote_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_quote_position_left',
            [
                'label' => esc_html__( 'Left', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
               'condition' => [
                    'testimonial_quote_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'testimonial_quote_position_right',
            [
                'label' => esc_html__( 'Right', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
               'condition' => [
                    'testimonial_quote_position' => 'absolute',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonial-quote-icon' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'testimonial_button_title',
            [
                'label' => esc_html__( 'Button', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'btn_color',
            [
                'label' => esc_html__( 'Button Text Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-btn' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_bg_color',
            [
                'label' => esc_html__( 'Button Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-btn' => 'background: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_color',
            [
                'label' => esc_html__( 'Button Hover Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-btn:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'btn_hover_bg_color',
            [
                'label' => esc_html__( 'Button Hover Background', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-btn:hover' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slider_btn_typography',
                'selector' => '{{WRAPPER}} .slider-btn',
            ]
        );

        $this->add_responsive_control(
            'slider_btn_margin',
            [
                'label' => esc_html__( 'Margin', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'slider_btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .slider-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->end_controls_section();

    }
    protected function render() {
        $settings = $this->get_settings_for_display();

        
        $sstyle = $settings['testimonial_style'];
    
        if( $settings['testimonial_grid_source'] == 'custom' ) { 

            $customimgId = $settings['custom_image']['id'];
                                                                
            if($customimgId ){
                $customimage = wp_get_attachment_image_src($customimgId, 'full')[0];
                $customIMGstyle = 'style="background-image: url( '. $customimage .' );"';
            }else{
                $customIMGstyle = '';
                $customimage = '';
            }
            $custom_designation  = !empty($settings['custom_designation']) ? $settings['custom_designation'] : ''; 
            $custom_name  = !empty($settings['custom_name']) ? $settings['custom_name'] : ''; 
            $custom_designation  = !empty($settings['custom_designation']) ? $settings['custom_designation'] : ''; 
            $custom_designation  = !empty($settings['custom_designation']) ? $settings['custom_designation'] : ''; 
            $custom_btn_text     = !empty($settings['custom_btn_text']) ? $settings['custom_btn_text'] : '';
            $target       = !empty($settings['custom_link']['is_external']) ? 'target=_blank' : '';  
            $custom_link         = !empty($settings['custom_link']['url']) ? $settings['custom_link']['url'] : '';
            $custom_description  = !empty($settings['custom_description']) ? $settings['custom_description'] : '';
            $custom_rating  = !empty($settings['custom_rating']) ? $settings['custom_rating'] : '5';
    

        }

		if( $settings['testimonial_grid_source'] == 'slider' ) {

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
			$sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
			$sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';        
			$infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
			$centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
            $col_xl          = $settings['col_xl'];
			$col_lg          = $settings['col_lg'];
			$col_md          = $settings['col_md'];
			$col_sm          = $settings['col_sm'];
			$col_xs          = $settings['col_xs'];
			$item_gap        = $settings['item_gap_custom']['size'];
			$item_gap        = !empty($item_gap) ? $item_gap : '30';
			$prev_text       = $settings['pcat_prev_text'];
			$prev_text       = !empty($prev_text) ? $prev_text : '';
			$next_text       = $settings['pcat_next_text'];
			$next_text       = !empty($next_text) ? $next_text : '';
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


            $pagination_type = $settings['pagination_type'] === 'pagination_progressbar' ? 'progressbar' : ($settings['pagination_type'] ==='pagination_fraction' ? 'fraction' : '');
        
            $dynamic_bullets = $settings['pagination_type'] === 'pagination_dynamic' ? 'true' : 'false';
            $pagination_class = '.tp-testimonial-pagination ';

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
        <div class="tp-testimonial-wrapper tp-testimonial-<?php echo esc_attr( $sstyle ); ?>">

            <?php if( $settings['testimonial_grid_source'] == 'slider' ) : ?>

            <div class="swiper tp_testimonial_slider-<?php echo esc_attr($unique); ?>">

                <div class="swiper-wrapper">                   
                <?php
                    foreach ( $settings['slider_list'] as $index => $item ) :                        
                        $imgId = $item['image']['id'];
                                                
                        if($imgId ){
                            $image = wp_get_attachment_image_src($imgId, 'full')[0];
                            $IMGstyle = 'style="background-image: url( '. $image .' );"';
                        }else{
                            $IMGstyle = '';
                            $image = '';
                        }                                 
                        $person_name        = !empty($item['person_name']) ? $item['person_name'] : '';                              
                        $person_designation    = !empty($item['person_designation']) ? $item['person_designation'] : '';                              
                        $description  = !empty($item['description']) ? $item['description'] : '';
                        $tp_rating  = !empty($item['tp_rating']) ? $item['tp_rating'] : '5';
                        $btn_text     = !empty($item['btn_text']) ? $item['btn_text'] : '';
                        $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';  
                        $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';                                          
                    
                        if($sstyle){
                            require plugin_dir_path(__FILE__)."/slider/$sstyle.php";
                        }else{
                            require plugin_dir_path(__FILE__)."/slider/style1.php";
                        }
                    endforeach; ?>

                </div>    

            </div>

            <?php else : 

                if($sstyle){
                    require plugin_dir_path(__FILE__)."/custom/$sstyle.php";
                }else{
                    require plugin_dir_path(__FILE__)."/custom/style1.php";
                }
            endif; ?>
        </div>

		<script type="text/javascript"> 
		jQuery(document).ready(function(){
					
			var swiper = new Swiper(".tp_testimonial_slider-<?php echo esc_attr($unique); ?>", {				
				slidesPerView: <?php echo $slidesToShow;?>,
				speed: <?php echo esc_attr($autoplaySpeed); ?>,
				
				loop: <?php echo esc_attr($infinite ); ?>,
				<?php echo esc_attr($slider_autoplay); ?>,
				spaceBetween:  <?php echo esc_attr($item_gap); ?>,
				<?php echo $pagination; ?>,
				centeredSlides: <?php echo esc_attr($centerMode); ?>,
				navigation: {
					nextEl: ".tp-testimonial-slide-next",
					prevEl: ".tp-testimonial-slide-prev",
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
    }
}