<?php 
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Icons_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;

class Themephi_Instagram_Widget extends \Elementor\Widget_Base {
    
    /**
	 * Retrieve instagram feed widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'pp-instafeed';
    }

    /**
	 * Retrieve instagram feed widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
    public function get_title() {
        return __( 'TP Instagram Feed', 'tp-elements' );
    }

    /**
	 * Retrieve the list of categories the instagram feed widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
    public function get_categories() {
        return [ 'tpaddon_category' ];
    }

    /**
	 * Retrieve instagram feed widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
    public function get_icon() {
        return 'ppicon-instagram-feed power-pack-admin-icon';
    }
    
    /**
	 * Retrieve the list of scripts the instagram feed widget depended on.
	 *
	 * Used to set scripts dependencies required to run the widget.
	 *
	 * @access public
	 *
	 * @return array Widget scripts dependencies.
	 */
 
    /**
	 * Register instagram feed widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
    protected function register_controls() {

        /*-----------------------------------------------------------------------------------*/
        /*	CONTENT TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Content Tab: Instagram Account
         */
        $this->start_controls_section(
            'section_instaaccount',
            [
                'label'                 => __( 'Instagram Account', 'tp-elements' ),
            ]
        );
		
		$this->add_control(
			'api_info',
			[
				'type'                  => Controls_Manager::RAW_HTML,
				'raw'					=> __( 'Starting October 15, 2019, new client registration and permission review on Instagram API platform are discontinued.', 'tp-elements' ),
				'separator'             => 'after',
				'content_classes' => 'pp-editor-info',
			]
		);
        
        $this->add_control(
            'use_api',
            [
                'label'                 => __( 'Use Instagram API', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
				'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'user_id',
            [
                'label'                 => __( 'User ID', 'tp-elements' ),
                'type'                  => Controls_Manager::TEXT,
				'condition'             => [
					'use_api'	=> 'yes',
				],
            ]
        );
        
        $this->add_control(
            'access_token',
            [
                'label'                 => __( 'Access Token', 'tp-elements' ),
                'type'                  => Controls_Manager::TEXT,
				'condition'             => [
					'use_api'	=> 'yes',
				],
            ]
        );
        
        $this->add_control(
            'client_id',
            [
                'label'                 => __( 'Client ID', 'tp-elements' ),
                'type'                  => Controls_Manager::TEXT,
				'condition'             => [
					'use_api'	=> 'yes',
				],
            ]
        );
        
        $this->add_control(
            'username',
            [
                'label'                 => __( 'Instagram Username', 'tp-elements' ),
                'description'			=> __( 'This must be public account.', 'tp-elements' ),
                'label_block'			=> true,
                'type'                  => Controls_Manager::TEXT,
				'frontend_available'    => true,
				'condition'             => [
					'use_api!'	=> 'yes',
				],
            ]
        );

        $this->end_controls_section();
        
        /**
         * Content Tab: Feed Settings
         */
        $this->start_controls_section(
            'section_instafeed',
            [
                'label'                 => __( 'Feed Settings', 'tp-elements' ),
            ]
        );
        
        $this->add_control(
            'images_count',
            [
                'label'                 => __( 'Images Count', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 5 ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
            ]
        );
		
		$this->add_control(
			'images_info',
			[
				'type'                  => Controls_Manager::RAW_HTML,
				'raw'					=> __( 'Maximum 12 images can be displayed without using API.', 'tp-elements' ),
				'separator'             => 'after',
				'content_classes'		=> 'pp-editor-info',
				'condition'             => [
					'use_api!'   => 'yes',
				],
			]
		);

        $this->add_control(
            'resolution',
            [
                'label'                 => __( 'Image Resolution', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'thumbnail'              => __( 'Thumbnail', 'tp-elements' ),
                   'low_resolution'         => __( 'Low Resolution', 'tp-elements' ),
                   'standard_resolution'    => __( 'Standard Resolution', 'tp-elements' ),
                ],
                'default'               => 'low_resolution',
            ]
        );

        $this->add_control(
            'sort_by',
            [
                'label'                 => __( 'Sort By', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'none'               => __( 'None', 'tp-elements' ),
                   'most-recent'        => __( 'Most Recent', 'tp-elements' ),
                   'least-recent'       => __( 'Least Recent', 'tp-elements' ),
                   'most-liked'         => __( 'Most Liked', 'tp-elements' ),
                   'least-liked'        => __( 'Least Liked', 'tp-elements' ),
                   'most-commented'     => __( 'Most Commented', 'tp-elements' ),
                   'least-commented'    => __( 'Least Commented', 'tp-elements' ),
                   'random'             => __( 'Random', 'tp-elements' ),
                ],
                'default'               => 'none',
            ]
        );

        $this->end_controls_section();

        /**
         * Content Tab: General Settings
         */
        $this->start_controls_section(
            'section_general_settings',
            [
                'label'                 => __( 'General Settings', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'feed_layout',
            [
                'label'                 => __( 'Layout', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'grid',
                'options'               => [
                   'grid'           => __( 'Grid', 'tp-elements' ),                  
                   'carousel'       => __( 'Carousel', 'tp-elements' ),
                ],
				'frontend_available'    => true,
            ]
        );
        
        $this->add_control(
            'square_images',
            [
                'label'                 => __( 'Square Images', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => '',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout'   => ['grid', 'carousel'],
				],
            ]
        );

        $this->add_responsive_control(
            'grid_cols',
            [
                'label'                 => __( 'Grid Columns', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => '5',
                'tablet_default'        => '3',
                'mobile_default'        => '2',
                'options'               => [
                   '1'              => __( '1', 'tp-elements' ),
                   '2'              => __( '2', 'tp-elements' ),
                   '3'              => __( '3', 'tp-elements' ),
                   '4'              => __( '4', 'tp-elements' ),
                   '5'              => __( '5', 'tp-elements' ),
                   '6'              => __( '6', 'tp-elements' ),
                   '7'              => __( '7', 'tp-elements' ),
                   '8'              => __( '8', 'tp-elements' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-grid .pp-feed-item' => 'width: calc( 100% / {{VALUE}} )',
                ],
				'condition'             => [
					'feed_layout'       => ['grid', 'masonry']
				],
            ]
        );
        
        $this->add_control(
            'insta_likes',
            [
                'label'                 => __( 'Likes', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Show', 'tp-elements' ),
                'label_off'             => __( 'Hide', 'tp-elements' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
				'frontend_available'    => true,
            ]
        );
        
        $this->add_control(
            'insta_comments',
            [
                'label'                 => __( 'Comments', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Show', 'tp-elements' ),
                'label_off'             => __( 'Hide', 'tp-elements' ),
                'return_value'          => 'yes',
				'frontend_available'    => true,
            ]
        );

        $this->add_control(
            'content_visibility',
            [
                'label'                 => __( 'Content Visibility', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'always',
                'options'               => [
                   'always'         => __( 'Always', 'tp-elements' ),
                   'hover'          => __( 'On Hover', 'tp-elements' ),
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );       
     
        
        $this->add_control(
            'insta_profile_link',
            [
                'label'                 => __( 'Show Link to Instagram Profile?', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
            ]
        );

        $this->add_control(
            'insta_link_title',
            [
                'label'                 => __( 'Link Title', 'tp-elements' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => __( 'Follow Us @ Instagram', 'tp-elements' ),
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'insta_profile_url',
            [
                'label'                 => __( 'Instagram Profile URL', 'tp-elements' ),
                'type'                  => Controls_Manager::URL,
                'placeholder'           => 'https://www.your-link.com',
                'default'               => [
                    'url'           => '#',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

		$this->add_control(
			'title_icon',
			[
				'label'					=> __( 'Title Icon', 'tp-elements' ),
				'type'					=> Controls_Manager::ICONS,
				'fa4compatibility'		=> 'insta_title_icon',
				'recommended'			=> [
					'fa-brands' => [
						'instagram',
					],
					'fa-solid' => [
						'user-check',
						'user-plus',
					],
				],
				'default'				=> [
					'value' => 'fab fa-instagram',
					'library' => 'fa-brands',
				],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
			]
		);

        $this->add_control(
            'insta_title_icon_position',
            [
                'label'                 => __( 'Icon Position', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'before_title'   => __( 'Before Title', 'tp-elements' ),
                   'after_title'    => __( 'After Title', 'tp-elements' ),
                ],
                'default'               => 'before_title',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->add_control(
            'load_more_button',
            [
                'label'                 => __( 'Show Load More Button', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
                'separator'             => 'before',
				'condition'             => [
					'use_api'       	=> 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'load_more_button_text',
            [
                'label'                 => __( 'Button Text', 'tp-elements' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => __( 'Load More', 'tp-elements' ),
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Content Tab: Carousel Settings
         */
        $this->start_controls_section(
            'section_carousel_settings',
            [
                'label'                 => __( 'Carousel Settings', 'tp-elements' ),
				'condition'             => [
					'feed_layout'   => 'carousel',
				],
            ]
        );

        $this->add_responsive_control(
            'items',
            [
                'label'                 => __( 'Visible Items', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 3 ],
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 10,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
				'condition'             => [
					'feed_layout' => 'carousel',
				],
            ]
        );
        
        $this->add_responsive_control(
            'margin',
            [
                'label'                 => __( 'Items Gap', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 10 ],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
				'condition'             => [
					'feed_layout'  => 'carousel',
				],
            ]
        );
        
        $this->add_control(
            'autoplay',
            [
                'label'                 => __( 'Autoplay', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout'  => 'carousel',
				],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'                 => __( 'Autoplay Speed', 'tp-elements' ),
                'type'                  => Controls_Manager::TEXT,
                'default'               => '2400',
                'title'                 => __( 'Enter carousel speed', 'tp-elements' ),
                'condition'             => [
                    'autoplay'     => 'yes',
					'feed_layout'  => 'carousel',
                ],
            ]
        );
        
        $this->add_control(
            'infinite_loop',
            [
                'label'                 => __( 'Infinite Loop', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout' => 'carousel',
				],
            ]
        );
        
        $this->add_control(
            'grab_cursor',
            [
                'label'                 => __( 'Grab Cursor', 'tp-elements' ),
                'description'           => __( 'Shows grab cursor when you hover over the slider', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => '',
                'label_on'          => __( 'Show', 'tp-elements' ),
                'label_off'         => __( 'Hide', 'tp-elements' ),
                'return_value'      => 'yes',
            ]
        );
        
        $this->add_control(
            'navigation_heading',
            [
                'label'                 => __( 'Navigation', 'tp-elements' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
            ]
        );
        
        $this->add_control(
            'arrows',
            [
                'label'                 => __( 'Arrows', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'yes',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
				'condition'             => [
					'feed_layout' => 'carousel',
				],
            ]
        );        
  
        
        $this->add_control(
            'direction',
            [
                'label'                 => __( 'Direction', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'left',
                'options'               => [
                    'left'       => __( 'Left', 'tp-elements' ),
                    'right'      => __( 'Right', 'tp-elements' ),
                ],
				'separator'             => 'before',
            ]
        );

        $this->end_controls_section();

	
        /*-----------------------------------------------------------------------------------*/
        /*	STYLE TAB
        /*-----------------------------------------------------------------------------------*/

        /**
         * Style Tab: Layout
         */
        $this->start_controls_section(
            'section_layout_style',
            [
                'label'                 => __( 'Layout', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'feed_layout'       => 'grid'
				],
            ]
        );$this->add_responsive_control(
			'columns_gap',
			[
				'label'                 => __( 'Columns Gap', 'tp-elements' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
                    'size' => '',
                    'unit' => 'px',
                ],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-instafeed-grid .pp-feed-item' => 'padding-left: calc({{SIZE}}{{UNIT}}/2); padding-right: calc({{SIZE}}{{UNIT}}/2);',
					'{{WRAPPER}} .pp-instafeed-grid' => 'margin-left: calc(-{{SIZE}}{{UNIT}}/2); margin-right: calc(-{{SIZE}}{{UNIT}}/2);',
				],
				'condition'             => [
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_responsive_control(
			'rows_gap',
			[
				'label'                 => __( 'Rows Gap', 'tp-elements' ),
				'type'                  => Controls_Manager::SLIDER,
				'default'               => [
                    'size' => '',
                    'unit' => 'px',
                ],
				'size_units'            => [ 'px', '%' ],
				'range'                 => [
					'px' => [
						'max' => 100,
					],
				],
				'tablet_default'        => [
					'unit' => 'px',
				],
				'mobile_default'        => [
					'unit' => 'px',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-instafeed-grid .pp-feed-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'feed_layout'       => 'grid'
				],
			]
		);

        $this->end_controls_section();

        /**
         * Style Tab: Images
         */
        $this->start_controls_section(
            'section_image_style',
            [
                'label'                 => __( 'Images', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_image_style' );

        $this->start_controls_tab(
            'tab_image_normal',
            [
                'label'                 => __( 'Normal', 'tp-elements' ),
            ]
        );
        
        $this->add_control(
            'insta_image_grayscale',
            [
                'label'                 => __( 'Grayscale Image', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'images_border',
				'label'                 => __( 'Border', 'tp-elements' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed .pp-if-img',
			]
		);

		$this->add_control(
			'images_border_radius',
			[
				'label'                 => __( 'Border Radius', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .pp-if-img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_hover',
            [
                'label'                 => __( 'Hover', 'tp-elements' ),
            ]
        );
        
        $this->add_control(
            'insta_image_grayscale_hover',
            [
                'label'                 => __( 'Grayscale Image', 'tp-elements' ),
                'type'                  => Controls_Manager::SWITCHER,
                'default'               => 'no',
                'label_on'              => __( 'Yes', 'tp-elements' ),
                'label_off'             => __( 'No', 'tp-elements' ),
                'return_value'          => 'yes',
            ]
        );

        $this->add_control(
            'images_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-feed-item:hover .pp-if-img' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Content
         */
        $this->start_controls_section(
            'section_content_style',
            [
                'label'                 => __( 'Content', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'content_typography',
                'label'                 => __( 'Typography', 'tp-elements' ),
                'selector'              => '{{WRAPPER}} .pp-feed-item .pp-overlay-container',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );

        $this->add_control(
            'likes_comments_color',
            [
                'label'                 => __( 'Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-feed-item .pp-overlay-container' => 'color: {{VALUE}};',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );
        
        $this->add_control(
			'content_vertical_align',
			[
				'label'                 => __( 'Vertical Align', 'tp-elements' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'toggle'                => false,
				'default'               => 'middle',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'tp-elements' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Center', 'tp-elements' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'tp-elements' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'selectors_dictionary'  => [
					'top'          => 'flex-start',
					'middle'       => 'center',
					'bottom'       => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-overlay-container'   => 'align-items: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);
        
        $this->add_control(
			'content_horizontal_align',
			[
				'label'                 => __( 'Horizontal Align', 'tp-elements' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'toggle'                => false,
				'default'               => 'center',
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'tp-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center'           => [
						'title' => __( 'Center', 'tp-elements' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'            => [
						'title' => __( 'Right', 'tp-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
                'selectors_dictionary'  => [
					'left'     => 'flex-start',
					'center'   => 'center',
					'right'    => 'flex-end',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-overlay-container' => 'justify-content: {{VALUE}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);

		$this->add_responsive_control(
			'content_padding',
			[
				'label'                 => __( 'Padding', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-overlay-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);
        
        $this->add_control(
            'icons_heading',
            [
                'label'                 => __( 'Icons', 'tp-elements' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );

		$this->add_control(
			'icons_style',
			[
				'label'					=> __( 'Style', 'tp-elements' ),
				'type'					=> Controls_Manager::CHOOSE,
				'label_block'			=> false,
				'toggle'				=> false,
				'default'				=> 'solid',
				'options'				=> [
					'solid'    		=> [
						'title' 	=> __( 'Solid', 'tp-elements' ),
						'icon' 		=> 'fa fa-comment',
					],
					'outline' 		=> [
						'title' 	=> __( 'Outline', 'tp-elements' ),
						'icon' 		=> 'fa fa-comment-o',
					],
				],
				'frontend_available'    => true,
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
			]
		);
        
        $this->add_responsive_control(
            'icon_size',
            [
                'label'                 => __( 'Size', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 2.5,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => [ 'px' ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-feed-item .pp-if-icon' => 'font-size: {{SIZE}}em;',
                    '{{WRAPPER}} .pp-feed-item .pp-overlay-container span' => 'font-size: {{SIZE}}em;',
                ],
				'conditions' => [
					'relation' => 'or',
					'terms' => [
						[
							'name' => 'insta_likes',
							'operator' => '==',
							'value' => 'yes',
						],
						[
							'name' => 'insta_comments',
							'operator' => '==',
							'value' => 'yes',
						]
					],
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Overlay
         */
        $this->start_controls_section(
            'section_overlay_style',
            [
                'label'                 => __( 'Overlay', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'overlay_blend_mode',
            [
                'label'                 => __( 'Blend Mode', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'normal',
                'options'               => [
                    'normal'		=> __( 'Normal', 'tp-elements' ),
                    'multiply'		=> __( 'Multiply', 'tp-elements' ),
                    'screen'		=> __( 'Screen', 'tp-elements' ),
                    'overlay'		=> __( 'Overlay', 'tp-elements' ),
                    'darken'		=> __( 'Darken', 'tp-elements' ),
                    'lighten'		=> __( 'Lighten', 'tp-elements' ),
                    'color-dodge'   => __( 'Color Dodge', 'tp-elements' ),
                    'color'			=> __( 'Color', 'tp-elements' ),
                    'hue'			=> __( 'Hue', 'tp-elements' ),
                    'hard-light'	=> __( 'Hard Light', 'tp-elements' ),
                    'soft-light'	=> __( 'Soft Light', 'tp-elements' ),
                    'difference'	=> __( 'Difference', 'tp-elements' ),
                    'exclusion'		=> __( 'Exclusion', 'tp-elements' ),
                    'saturation'	=> __( 'Saturation', 'tp-elements' ),
                    'luminosity'	=> __( 'Luminosity', 'tp-elements' ),
                ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-overlay-container' => 'mix-blend-mode: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_overlay_style' );

        $this->start_controls_tab(
            'tab_overlay_normal',
            [
                'label'                 => __( 'Normal', 'tp-elements' ),
            ]
        );
			
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'image_overlay_normal',
                'label'                 => __( 'Overlay', 'tp-elements' ),
                'types'                 => [ 'classic','gradient' ],
                'exclude'               => [
                    'image',
                ],
                'selector'              => '{{WRAPPER}} .pp-instagram-feed .pp-overlay-container',
            ]
        );
        
        $this->add_control(
			'overlay_margin_normal',
			[
				'label'                 => __( 'Margin', 'tp-elements' ),
				'type'                  => Controls_Manager::SLIDER,
				'range'                 => [
					'px' => [
                        'min'   => 0,
                        'max'   => 50,
                        'step'  => 1,
                    ],
				],
				'selectors'         => [
					'{{WRAPPER}} .pp-instagram-feed .pp-overlay-container' => 'top: {{SIZE}}px; bottom: {{SIZE}}px; left: {{SIZE}}px; right: {{SIZE}}px;',
				],
			]
		);
        
        $this->add_control(
            'image_overlay_opacity_normal',
            [
                'label'                 => __( 'Overlay Opacity', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-overlay-container' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_overlay_hover',
            [
                'label'                 => __( 'Hover', 'tp-elements' ),
            ]
        );
			
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'                  => 'image_overlay_hover',
                'label'                 => __( 'Overlay', 'tp-elements' ),
                'types'                 => [ 'classic','gradient' ],
                'exclude'               => [
                    'image',
                ],
                'selector'              => '{{WRAPPER}} .pp-instagram-feed .pp-feed-item:hover .pp-overlay-container',
            ]
        );
        
        $this->add_control(
            'image_overlay_opacity_hover',
            [
                'label'                 => __( 'Overlay Opacity', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 1,
                        'step'  => 0.1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .pp-feed-item:hover .pp-overlay-container' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Feed Title
         */
        $this->start_controls_section(
            'section_feed_title_style',
            [
                'label'                 => __( 'Feed Title', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->add_control(
			'feed_title_position',
			[
				'label'                 => __( 'Position', 'tp-elements' ),
				'type'                  => Controls_Manager::CHOOSE,
				'label_block'           => false,
				'default'               => 'middle',
				'options'               => [
					'top'          => [
						'title'    => __( 'Top', 'tp-elements' ),
						'icon'     => 'eicon-v-align-top',
					],
					'middle'       => [
						'title'    => __( 'Middle', 'tp-elements' ),
						'icon'     => 'eicon-v-align-middle',
					],
					'bottom'       => [
						'title'    => __( 'Bottom', 'tp-elements' ),
						'icon'     => 'eicon-v-align-bottom',
					],
				],
				'prefix_class'          => 'pp-insta-title-',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'feed_title_typography',
                'label'                 => __( 'Typography', 'tp-elements' ),
                'selector'              => '{{WRAPPER}} .pp-instagram-feed-title',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            [
                'label'                 => __( 'Normal', 'tp-elements' ),
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_color_normal',
            [
                'label'                 => __( 'Text Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap .pp-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap' => 'background: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'title_border_normal',
				'label'                 => __( 'Border', 'tp-elements' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed-title-wrap'
			]
		);

		$this->add_control(
			'title_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed-title-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            [
                'label'                 => __( 'Hover', 'tp-elements' ),
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'                 => __( 'Text Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap a:hover .pp-icon svg' => 'fill: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

        $this->add_control(
            'title_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed-title-wrap:hover' => 'background: {{VALUE}};',
                ],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'title_border_hover',
				'label'                 => __( 'Border', 'tp-elements' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed-title-wrap:hover'
			]
		);

		$this->add_control(
			'title_border_radius_hover',
			[
				'label'                 => __( 'Border Radius', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed-title-wrap:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->add_control(
			'title_padding',
			[
				'label'                 => __( 'Padding', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
                'separator'             => 'before',
			]
		);
        
        $this->add_control(
            'title_icon_heading',
            [
                'label'                 => __( 'Icon', 'tp-elements' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->add_responsive_control(
            'title_icon_spacing',
            [
                'label'                 => __( 'Spacing', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 4 ],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .pp-icon-before_title' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .pp-instagram-feed .pp-icon-after_title' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'insta_profile_link' => 'yes',
				],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Arrows
         */
        $this->start_controls_section(
            'section_arrows_style',
            [
                'label'                 => __( 'Arrows', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
                    'arrows'       => 'yes',
					'feed_layout'  => 'carousel',
                ],
            ]
        );
        
        $this->add_control(
            'arrow',
            [
                'label'                 => __( 'Choose Arrow', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'label_block'           => false,
                'default'               => 'fa fa-angle-right',
                'options'               => [
                    'fa fa-angle-right'             => __( 'Angle', 'tp-elements' ),
                    'fa fa-angle-double-right'      => __( 'Double Angle', 'tp-elements' ),
                    'fa fa-chevron-right'           => __( 'Chevron', 'tp-elements' ),
                    'fa fa-chevron-circle-right'    => __( 'Chevron Circle', 'tp-elements' ),
                    'fa fa-arrow-right'             => __( 'Arrow', 'tp-elements' ),
                    'fa fa-long-arrow-right'        => __( 'Long Arrow', 'tp-elements' ),
                    'fa fa-caret-right'             => __( 'Caret', 'tp-elements' ),
                    'fa fa-caret-square-o-right'    => __( 'Caret Square', 'tp-elements' ),
                    'fa fa-arrow-circle-right'      => __( 'Arrow Circle', 'tp-elements' ),
                    'fa fa-arrow-circle-o-right'    => __( 'Arrow Circle O', 'tp-elements' ),
                    'fa fa-toggle-right'            => __( 'Toggle', 'tp-elements' ),
                    'fa fa-hand-o-right'            => __( 'Hand', 'tp-elements' ),
                ],
            ]
        );
        
        $this->add_responsive_control(
            'arrows_size',
            [
                'label'                 => __( 'Arrows Size', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => '22' ],
                'range'                 => [
                    'px' => [
                        'min'   => 15,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        
        $this->add_responsive_control(
            'left_arrow_position',
            [
                'label'                 => __( 'Align Left Arrow', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => -100,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'         => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'left: {{SIZE}}{{UNIT}};',
				],
            ]
        );
        
        $this->add_responsive_control(
            'right_arrow_position',
            [
                'label'                 => __( 'Align Right Arrow', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => -100,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px' ],
				'selectors'         => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next' => 'right: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->start_controls_tabs( 'tabs_arrows_style' );

        $this->start_controls_tab(
            'tab_arrows_normal',
            [
                'label'                 => __( 'Normal', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'arrows_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_color_normal',
            [
                'label'                 => __( 'Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'color: {{VALUE}};',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'arrows_border_normal',
				'label'                 => __( 'Border', 'tp-elements' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev'
			]
		);

		$this->add_control(
			'arrows_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_arrows_hover',
            [
                'label'                 => __( 'Hover', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'arrows_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next:hover, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_color_hover',
            [
                'label'                 => __( 'Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next:hover, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrows_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-button-next:hover, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();

		$this->add_responsive_control(
			'arrows_padding',
			[
				'label'                 => __( 'Padding', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-button-next, {{WRAPPER}} .pp-instagram-feed .swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'separator'             => 'before',
			]
		);
        
        $this->end_controls_section();
        
        /**
         * Style Tab: Pagination: Dots
         */
        $this->start_controls_section(
            'section_dots_style',
            [
                'label'                 => __( 'Pagination: Dots', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label'                 => __( 'Position', 'tp-elements' ),
                'type'                  => Controls_Manager::SELECT,
                'options'               => [
                   'inside'     => __( 'Inside', 'tp-elements' ),
                   'outside'    => __( 'Outside', 'tp-elements' ),
                ],
                'default'               => 'outside',
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_size',
            [
                'label'                 => __( 'Size', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 2,
                        'max'   => 40,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'dots_spacing',
            [
                'label'                 => __( 'Spacing', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px' => [
                        'min'   => 1,
                        'max'   => 30,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'margin-left: {{SIZE}}{{UNIT}}; margin-right: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->start_controls_tabs( 'tabs_dots_style' );

        $this->start_controls_tab(
            'tab_dots_normal',
            [
                'label'                 => __( 'Normal', 'tp-elements' ),
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_color_normal',
            [
                'label'                 => __( 'Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'active_dot_color_normal',
            [
                'label'                 => __( 'Active Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'dots_border_normal',
				'label'                 => __( 'Border', 'tp-elements' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet',
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
			]
		);

		$this->add_control(
			'dots_border_radius_normal',
			[
				'label'                 => __( 'Border Radius', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
			]
		);

		$this->add_responsive_control(
			'dots_margin',
			[
				'label'                 => __( 'Margin', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
                'allowed_dimensions'    => 'vertical',
				'placeholder'           => [
					'top'      => '',
					'right'    => 'auto',
					'bottom'   => '',
					'left'     => 'auto',
				],
				'selectors'             => [
					'{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullets' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
			]
		);
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_hover',
            [
                'label'                 => __( 'Hover', 'tp-elements' ),
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_color_hover',
            [
                'label'                 => __( 'Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet:hover' => 'background: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );

        $this->add_control(
            'dots_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-instagram-feed .swiper-pagination-bullet:hover' => 'border-color: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'bullets',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Pagination: Fraction
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fraction_style',
            [
                'label'                 => __( 'Pagination: Fraction', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'fraction',
                ],
            ]
        );

        $this->add_control(
            'fraction_text_color',
            [
                'label'                 => __( 'Text Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .swiper-pagination-fraction' => 'color: {{VALUE}};',
                ],
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'fraction',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'fraction_typography',
                'label'                 => __( 'Typography', 'tp-elements' ),
                'selector'              => '{{WRAPPER}} .swiper-pagination-fraction',
                'condition'             => [
					'feed_layout'       => 'carousel',
                    'dots'              => 'yes',
                    'pagination_type'   => 'fraction',
                ],
            ]
        );
        
        $this->end_controls_section();

        /**
         * Style Tab: Button
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_load_more_button_style',
            [
                'label'                 => __( 'Load More Button', 'tp-elements' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );
        
        $this->add_responsive_control(
            'button_alignment',
            [
                'label'                 => __( 'Alignment', 'tp-elements' ),
				'type'                  => Controls_Manager::CHOOSE,
				'options'               => [
					'left'      => [
						'title' => __( 'Left', 'tp-elements' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center'    => [
						'title' => __( 'Center', 'tp-elements' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'     => [
						'title' => __( 'Right', 'tp-elements' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'               => 'center',
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button-wrap' => 'text-align: {{VALUE}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_control(
            'button_top_spacing',
            [
                'label'                 => __( 'Top Spacing', 'tp-elements' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [ 'size' => 20 ],
                'range'                 => [
                    'px' => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => ['px'],
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button-wrap' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_control(
			'button_size',
			[
				'label'                 => __( 'Size', 'tp-elements' ),
				'type'                  => Controls_Manager::SELECT,
				'default'               => 'md',
				'options'               => [
					'xs' => __( 'Extra Small', 'tp-elements' ),
					'sm' => __( 'Small', 'tp-elements' ),
					'md' => __( 'Medium', 'tp-elements' ),
					'lg' => __( 'Large', 'tp-elements' ),
					'xl' => __( 'Extra Large', 'tp-elements' ),
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __( 'Normal', 'tp-elements' ),
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Text Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'                  => 'button_border_normal',
				'label'                 => __( 'Border', 'tp-elements' ),
				'placeholder'           => '1px',
				'default'               => '1px',
				'selector'              => '{{WRAPPER}} .pp-load-more-button',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

		$this->add_control(
			'button_border_radius',
			[
				'label'                 => __( 'Border Radius', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'tp-elements' ),
                'selector'              => '{{WRAPPER}} .pp-load-more-button',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_responsive_control(
			'button_padding',
			[
				'label'                 => __( 'Padding', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', 'em', '%' ],
				'selectors'             => [
					'{{WRAPPER}} .pp-load-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow',
				'selector'              => '{{WRAPPER}} .pp-load-more-button',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);
        
        $this->add_control(
            'load_more_button_icon_heading',
            [
                'label'                 => __( 'Button Icon', 'tp-elements' ),
                'type'                  => Controls_Manager::HEADING,
                'separator'             => 'before',
                'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid',
                    'button_icon!' => '',
                ],
            ]
        );

		$this->add_responsive_control(
			'button_icon_margin',
			[
				'label'                 => __( 'Margin', 'tp-elements' ),
				'type'                  => Controls_Manager::DIMENSIONS,
				'size_units'            => [ 'px', '%' ],
				'placeholder'       => [
					'top'      => '',
					'right'    => '',
					'bottom'   => '',
					'left'     => '',
				],
                'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid',
                    'button_icon!' => '',
                ],
				'selectors'             => [
					'{{WRAPPER}} .pp-info-box .pp-button-icon' => 'margin-top: {{TOP}}{{UNIT}}; margin-left: {{LEFT}}{{UNIT}}; margin-right: {{RIGHT}}{{UNIT}}; margin-bottom: {{BOTTOM}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'tp-elements' ),
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button:hover' => 'background-color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button:hover' => 'color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'tp-elements' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-load-more-button:hover' => 'border-color: {{VALUE}}',
                ],
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
            ]
        );

		$this->add_control(
			'button_animation',
			[
				'label'                 => __( 'Animation', 'tp-elements' ),
				'type'                  => Controls_Manager::HOVER_ANIMATION,
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'                  => 'button_box_shadow_hover',
				'selector'              => '{{WRAPPER}} .pp-load-more-button:hover',
				'condition'             => [
					'use_api'       	=> 'yes',
					'load_more_button'  => 'yes',
					'feed_layout'       => 'grid'
				],
			]
		);

        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->end_controls_section();

    }

	/**
	 * Slider Settings.
	 *
	 * @access public
	 */
	public function slider_settings() {
        $settings = $this->get_settings();
        
        $slider_options = [
			'direction'              => 'horizontal',
			'speed'                  => 400,
			'slidesPerView'          => ( $settings['items']['size'] !== '' ) ? absint( $settings['items']['size'] ) : 3,
			'spaceBetween'           => ( $settings['margin']['size'] !== '' ) ? $settings['margin']['size'] : 10,
			'grabCursor'             => ( $settings['grab_cursor'] === 'yes' ),
			'autoHeight'             => true,
			'loop'                   => ( $settings['infinite_loop'] === 'yes' ),
		];
        
        if ( $settings['autoplay'] == 'yes' && ! empty( $settings['autoplay_speed'] ) ) {
            $autoplay_speed = $settings['autoplay_speed'];
        } else {
            $autoplay_speed = 999999;
        }
        
        $slider_options['autoplay'] = [
            'delay'                  => $autoplay_speed
        ];
        
        if ( $settings['dots'] == 'yes' ) {
            $slider_options['pagination'] = [
                'el'                 => '.swiper-pagination-'.esc_attr( $this->get_id() ),
                'type'               => $settings['pagination_type'],
                'clickable'          => true,
            ];
        }
        
        if ( $settings['arrows'] == 'yes' ) {
            $slider_options['navigation'] = [
                'nextEl'             => '.swiper-button-next-'.esc_attr( $this->get_id() ),
                'prevEl'             => '.swiper-button-prev-'.esc_attr( $this->get_id() ),
            ];
        }
        
        $slider_options['breakpoints'] = [
            '768'   => [
                'slidesPerView'      => ( $settings['items_tablet']['size'] !== '' ) ? absint( $settings['items_tablet']['size'] ) : 2,
                'spaceBetween'       => ( $settings['margin_tablet']['size'] !== '' ) ? $settings['margin_tablet']['size'] : 10,
            ],
            '480'   => [
                'slidesPerView'      => ( $settings['items_mobile']['size'] !== '' ) ? absint( $settings['items_mobile']['size'] ) : 1,
                'spaceBetween'       => ( $settings['margin_mobile']['size'] !== '' ) ? $settings['margin_mobile']['size'] : 10,
            ],
        ];
        
        $this->add_render_attribute(
			'insta-feed-container',
			[
				'data-slider-settings' => wp_json_encode( $slider_options ),
			]
		);
    }

    /**
	 * Render promo box widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render() {
        $settings = $this->get_settings();
		
		if ( $settings['feed_layout'] == 'carousel' ) {
			$layout = 'carousel';
		} else {
			$layout = 'grid';
		}
        
        $this->add_render_attribute( 'insta-feed-wrap', 'class', [
                'pp-instagram-feed',
                'clearfix',
                'pp-instagram-feed-' . $layout,
                'pp-instagram-feed-' . $settings['content_visibility']
            ]
        );

        if ( ($settings['feed_layout'] == 'grid' || $settings['feed_layout'] == 'masonry') && $settings['grid_cols'] ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-instagram-feed-grid-' . $settings['grid_cols'] );
        }

        if ( $settings['insta_image_grayscale'] == 'yes' ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-instagram-feed-gray' );
        }

        if ( $settings['insta_image_grayscale_hover'] == 'yes' ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-instagram-feed-hover-gray' );
        }
		
		if ( $settings['feed_layout'] != 'masonry' && $settings['square_images'] == 'yes' ) {
            $this->add_render_attribute( 'insta-feed-wrap', 'class', 'pp-if-square-images' );
        }
        
        $this->add_render_attribute( 'insta-feed-container', 'class', 'pp-instafeed' );
        
        $this->add_render_attribute( 'insta-feed', [
            'id'        => 'pp-instafeed-' . esc_attr( $this->get_id() ),
            'class'     => 'pp-instafeed-grid'
        ] );

        $this->add_render_attribute( 'insta-feed-inner', 'class', 'pp-insta-feed-inner' );
		
		if ( ! isset( $settings['insta_title_icon'] ) && ! Icons_Manager::is_migration_allowed() ) {
			// add old default
			$settings['insta_title_icon'] = 'fa fa-instagram';
		}

		$has_icon = ! empty( $settings['insta_title_icon'] );
		
		if ( $has_icon ) {
			$this->add_render_attribute( 'i', 'class', $settings['insta_title_icon'] );
			$this->add_render_attribute( 'i', 'aria-hidden', 'true' );
		}
		
		if ( ! $has_icon && ! empty( $settings['title_icon']['value'] ) ) {
			$has_icon = true;
		}
		$migrated = isset( $settings['__fa4_migrated']['title_icon'] );
		$is_new = ! isset( $settings['insta_title_icon'] ) && Icons_Manager::is_migration_allowed();
		
		$this->add_render_attribute( 'title-icon', 'class', 'pp-icon pp-icon-' . $settings['insta_title_icon_position'] );
        
        if ( $settings['feed_layout'] == 'carousel' ) {

            $this->add_render_attribute( 'insta-feed-inner', 'class', [
                'swiper-container-wrap',
                'pp-insta-feed-carousel-wrap'
            ] );
            
            $this->add_render_attribute( 'insta-feed-container', 'class', [
                'swiper-container',
                'swiper-container-' . esc_attr( $this->get_id() )
            ] );
            
            $this->slider_settings();
        
            if ( $settings['dots_position'] ) {
                $this->add_render_attribute( 'insta-feed-inner', 'class', 'swiper-container-dots-' . $settings['dots_position'] );
            } elseif ( $settings['pagination_type'] == 'fraction' ) {
                $this->add_render_attribute( 'insta-feed-inner', 'class', 'swiper-container-dots-outside' );
            }
        
            if ( $settings['direction'] == 'right' ) {
                $this->add_render_attribute( 'insta-feed-container', 'dir', 'rtl' );
            }
            
            $this->add_render_attribute( 'insta-feed', 'class', 'swiper-wrapper' );
        }
        
        if ( ! empty( $settings['insta_profile_url']['url'] ) ) {
            $this->add_render_attribute( 'instagram-profile-link', 'href', $settings['insta_profile_url']['url'] );

            if ( ! empty( $settings['insta_profile_url']['is_external'] ) ) {
                $this->add_render_attribute( 'instagram-profile-link', 'target', '_blank' );
            }
        }
        
        $pp_widget_options = [
            'user_id'           => ! empty( $settings['user_id'] ) ? $settings['user_id'] : '',
            'access_token'      => ! empty( $settings['access_token'] ) ? $settings['access_token'] : '',
            'sort_by'           => ! empty( $settings['sort_by'] ) ? $settings['sort_by'] : '',
            'images_count'      => ! empty( $settings['images_count']['size'] ) ? $settings['images_count']['size'] : '3',
            'target'            => 'pp-instafeed-'. esc_attr( $this->get_id() ),
            'resolution'        => ! empty( $settings['resolution'] ) ? $settings['resolution'] : '',
            //'popup'             => ( $settings['insta_image_popup'] == 'yes' ) ? '1' : '0',
        ];
        ?>
        <div <?php echo $this->get_render_attribute_string( 'insta-feed-wrap' ); ?> data-settings='<?php echo wp_json_encode( $pp_widget_options ); ?>'>
            
            <div <?php echo $this->get_render_attribute_string( 'insta-feed-inner' ); ?>>
                <div <?php echo $this->get_render_attribute_string( 'insta-feed-container' ); ?>>
					<?php if ( $settings['insta_profile_link'] == 'yes' && $settings['insta_link_title'] ) { ?>
						<span class="pp-instagram-feed-title-wrap">
							<a <?php echo $this->get_render_attribute_string( 'instagram-profile-link' ); ?>>
								<span class="pp-instagram-feed-title">
									<?php if ( $settings['insta_title_icon_position'] == 'before_title' && $has_icon ) { ?>
									<span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
										<?php
										if ( $is_new || $migrated ) {
											Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] );
										} elseif ( ! empty( $settings['insta_title_icon'] ) ) {
											?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
										}
										?>
									</span>
									<?php } ?>

									<?php echo esc_attr( $settings[ 'insta_link_title' ] ); ?>

									<?php if ( $settings['insta_title_icon_position'] == 'after_title' && $has_icon ) { ?>
									<span <?php echo $this->get_render_attribute_string( 'title-icon' ); ?>>
										<?php
										if ( $is_new || $migrated ) {
											Icons_Manager::render_icon( $settings['title_icon'], [ 'aria-hidden' => 'true' ] );
										} elseif ( ! empty( $settings['insta_title_icon'] ) ) {
											?><i <?php echo $this->get_render_attribute_string( 'i' ); ?>></i><?php
										}
										?>
									</span>
									<?php } ?>
								</span>
							</a>
						</span>
					<?php } ?>
                    <div <?php echo $this->get_render_attribute_string( 'insta-feed' ); ?>></div>
                </div>
                <?php
                    $this->render_load_more_button();

                    $this->render_dots();

                    $this->render_arrows();
                ?>
            </div>
        </div>
        <?php
    }

    /**
	 * Render load more button output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_load_more_button() {
        $settings = $this->get_settings();
        
        $this->add_render_attribute( 'load-more-button', 'class', [
				'pp-load-more-button',
				'elementor-button',
				'elementor-size-' . $settings['button_size'],
			]
		);

		if ( $settings['button_animation'] ) {
			$this->add_render_attribute( 'load-more-button', 'class', 'elementor-animation-' . $settings['button_animation'] );
		}

        if ( $settings['feed_layout'] == 'grid' && $settings['load_more_button'] == 'yes' ) { ?>
            <div class="pp-load-more-button-wrap">
                <div <?php echo $this->get_render_attribute_string( 'load-more-button' ) ?>>
                    <span class="pp-button-loader"></span>
                    <span class="pp-load-more-button-text">
                        <?php echo $settings['load_more_button_text']; ?>
                    </span>
                </div>
            </div>
        <?php }
    }

    /**
	 * Render insta feed carousel dots output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_dots() {
        $settings = $this->get_settings();

        if ( $settings['feed_layout'] == 'carousel' && $settings['dots'] == 'yes' ) { ?>
            <!-- Add Pagination -->
            <div class="swiper-pagination swiper-pagination-<?php echo esc_attr( $this->get_id() ); ?>"></div>
        <?php }
    }

    /**
	 * Render insta feed carousel arrows output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
    protected function render_arrows() {
        $settings = $this->get_settings();

        if ( $settings['feed_layout'] == 'carousel' && $settings['arrows'] == 'yes' ) { ?>
            <?php
                if ( $settings['arrow'] ) {
                    $pa_next_arrow = $settings['arrow'];
                    $pa_prev_arrow = str_replace("right","left",$settings['arrow']);
                }
                else {
                    $pa_next_arrow = 'fa fa-angle-right';
                    $pa_prev_arrow = 'fa fa-angle-left';
                }
            ?>
            <!-- Add Arrows -->
            <div class="swiper-button-next swiper-button-next-<?php echo esc_attr( $this->get_id() ); ?>">
                <i class="<?php echo esc_attr( $pa_next_arrow ); ?>"></i>
            </div>
            <div class="swiper-button-prev swiper-button-prev-<?php echo esc_attr( $this->get_id() ); ?>">
                <i class="<?php echo esc_attr( $pa_prev_arrow ); ?>"></i>
            </div>
        <?php }
    }

    protected function content_template() {}

}