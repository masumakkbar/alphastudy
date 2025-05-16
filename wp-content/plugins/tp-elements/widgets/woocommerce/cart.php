<?php
/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Themephi_Product_Cart extends \Elementor\Widget_Base {

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
		return 'tp-product-cart';
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
		return __( 'TP Woo Cart', 'tp-elements' );
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
		return 'glyph-icon flaticon-multimedia';
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
        return [ 'pielements_category' ];
    }

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'product', 'list', 'category' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
    {
    	$this->start_controls_section(
            'rt_cart_content',
            [
                'label' => esc_html__('Cart Item', 'tp-elements'),
               
            ]
        );

        $this->add_control(
			'cart_icon',
			[
				'label'       => __( 'Cart Icon', 'tp-elements' ),
				'type'        => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-shopping-cart',
					'library' => 'fa-solid',
				]
            ]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_typography',
            [
                'label' => esc_html__('Color &amp; Typography', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_heading',
            [
                'label' => __('Icon', 'tp-elements'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'cart_icon_color',
            [
				'label'   => esc_html__('Cart Icon Color', 'tp-elements'),
				'type'    => Controls_Manager::COLOR,
				'default' => '#040404',
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area svg path' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .menu-cart-area i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'width',
            [
                'label' => esc_html__( 'Cart Icon Box width', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area' => 'width: {{SIZE}}{{UNIT}};',
                    
                ],
            ]
        );
          $this->add_control(
            'height',
            [
                'label' => esc_html__( 'Cart Icon Box Height', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [                    
                    '{{WRAPPER}} .menu-cart-area' => 'height: {{SIZE}}{{UNIT}};',
                   
                ],
            ]
        );
           $this->add_control(
            'line-height',
            [
                'label' => esc_html__( 'Cart Icon Box Line Height', 'tp-elements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area' => 'line-height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'icon_bg',
                'label' => esc_html__( 'Icon Box Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .menu-cart-area',
            ]
        );   

        $this->add_control(
            'icon_border_radius',
            [
                'label' => esc_html__( 'Icon Box Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
			'align',
			[
				'label'              => __( 'Icon Alignment', 'tp-elements' ),
				'type'               => Controls_Manager::CHOOSE,
				'options'            => [
					'left'   => [
						'title' => __( 'Left', 'tp-elements' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'tp-elements' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'tp-elements' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				
				'selectors'          => [
					'{{WRAPPER}} .menu-cart-area' => 'text-align: {{VALUE}};',
				],
				'frontend_available' => true,
			]
		);     

        $this->add_control(
            'cart_number_color',
            [
				'label'   => esc_html__('Cart Count Color', 'tp-elements'),
				'type'    => Controls_Manager::COLOR,
				'default' => '#272727',
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area span.icon-num' => 'color: {{VALUE}};',
                ],
            ]
        );

        
        $this->add_control(
            'cart_count_bg_color',
            [
                'label' => esc_html__('Count Bg Color', 'tp-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#B79B6C',
                'selectors' => [
                    '{{WRAPPER}} .menu-cart-area span.icon-num' => 'background: {{VALUE}};',
                  

                ],
            ]
        );

        $this->add_responsive_control(
			'position',
			[
				'label'     => __( 'Count Bg Top Position', 'tp-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'max'  => 100,
						'min'  => 1,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area span.icon-num' => 'top: {{SIZE}}%;',
				],
			]
		);

        $this->add_responsive_control(
			'position2',
			[
				'label'     => __( 'Count BG Right Position', 'tp-elements' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'%' => [
						'max'  => 100,
						'min'  => -50,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .menu-cart-area span.icon-num' => 'right: {{SIZE}}%;',
				],
			]
		);

        $this->end_controls_section();

        $this->start_controls_section(
            'tp_sticky_options',
            [
                'label' => esc_html__('Sticky Options', 'tp-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

		$this->start_controls_tabs( 'tabs_cart_style_stikcy' );

			$this->start_controls_tab(
				'stikcy_cart_item_normal',
				[
					'label' => __( 'Normal', 'tp-elements' ),
				]
			);

			$this->add_control(
				'sticky_cart_icon_color',
				[
					'label'   => esc_html__('Cart Icon Color', 'tp-elements'),
					'type'    => Controls_Manager::COLOR,
					'selectors' => [
						'.tp-sticky {{WRAPPER}} .menu-cart-area svg path' => 'fill: {{VALUE}};',
						'.tp-sticky {{WRAPPER}} .menu-cart-area i' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'sticky_icon_bg',
					'label' => esc_html__( 'Icon Box Background', 'tp-elements' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '.tp-sticky {{WRAPPER}} .menu-cart-area',
				]
			);

			$this->add_control(
				'sticky_cart_number_color',
				[
					'label'   => esc_html__('Cart Count Color', 'tp-elements'),
					'type'    => Controls_Manager::COLOR,
					'default' => '#272727',
					'selectors' => [
						'.tp-sticky {{WRAPPER}} .menu-cart-area span.icon-num' => 'color: {{VALUE}};',
					],
				]
			);
	
			
			$this->add_control(
				'sticky_cart_count_bg_color',
				[
					'label' => esc_html__('Count Bg Color', 'tp-elements'),
					'type' => Controls_Manager::COLOR,
					'default' => '#B79B6C',
					'selectors' => [
						'.tp-sticky {{WRAPPER}} .menu-cart-area span.icon-num' => 'background: {{VALUE}};',
					  
	
					],
				]
			);

			$this->end_controls_tab();

			$this->start_controls_tab(
				'sticky_menu_item_hover',
				[
					'label' => __( 'Hover', 'tp-elements' ),
				]
			);

			
			$this->add_control(
				'sticky_cart_icon_hover_color',
				[
					'label'   => esc_html__('Cart Icon Color', 'tp-elements'),
					'type'    => Controls_Manager::COLOR,
					'selectors' => [
						'.tp-sticky {{WRAPPER}} .menu-cart-area:hover svg path' => 'fill: {{VALUE}};',
						'.tp-sticky {{WRAPPER}} .menu-cart-area:hover i' => 'color: {{VALUE}};',
					],
				]
			);
	
			$this->add_group_control(
				Group_Control_Background::get_type(),
				[
					'name' => 'sticky_icon_hover_bg',
					'label' => esc_html__( 'Icon Box Background', 'tp-elements' ),
					'types' => [ 'classic', 'gradient' ],
					'selector' => '.tp-sticky {{WRAPPER}} .menu-cart-area:hover',
				]
			);

			$this->add_control(
				'sticky_cart_number_hover_color',
				[
					'label'   => esc_html__('Cart Count Color', 'tp-elements'),
					'type'    => Controls_Manager::COLOR,
					'default' => '#272727',
					'selectors' => [
						'.tp-sticky {{WRAPPER}} .menu-cart-area:hover span.icon-num' => 'color: {{VALUE}};',
					],
				]
			);
	
			
			$this->add_control(
				'sticky_cart_count_hover_bg_color',
				[
					'label' => esc_html__('Count Bg Color', 'tp-elements'),
					'type' => Controls_Manager::COLOR,
					'default' => '#B79B6C',
					'selectors' => [
						'.tp-sticky {{WRAPPER}} .menu-cart-area:hover span.icon-num' => 'background: {{VALUE}};',
					],
				]
			);


			$this->end_controls_tab();

		$this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render(){
        $settings = $this->get_settings_for_display();
		global $woocommerce;
		if ( class_exists( 'WooCommerce' ) ) {?>
			<div class="menu-cart-area">
			<?php \Elementor\Icons_Manager::render_icon( $settings['cart_icon'], [ 'aria-hidden' => 'true' ] ); ?> <span class="icon-num"><?php echo is_object( WC()->cart ) ? WC()->cart->get_cart_contents_count() : '';?></span>
				
			</div>	
            		
		<?php } 
    	
    }   

}