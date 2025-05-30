<?php
/**
 * Flipbox widget
 *
 */
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Pro_Flip_Box_Widget extends \Elementor\Widget_Base {

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
        return 'tp-flipbox';
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
        return esc_html__( 'TP Flip Box', 'tp-elements' );
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
        return 'glyph-icon flaticon-ballot-box';
    }


    public function get_categories() {
        return [ 'tpaddon_category' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'flip_box_front',
            [
                'label' => esc_html__( 'Front Part', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'front_icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', 'tp-elements' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'tp-elements' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'tp-elements' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
            ]
        );

        $this->add_control(
            'front_icon',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fa fa-home',
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
                'options' => tp_framework_get_icons(),
            ]
        );

        $this->add_control(
            'front_image',
            [
                'label' => esc_html__( 'Image', 'tp-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'front_image_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'front_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'front_title',
            [
                'label' => esc_html__( 'Title', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__('Front Title', 'tp-elements' ),
                'separator' => 'before', 
            ]
        );

        $this->add_control(
            'front_title_tag',
            [
                'label' => esc_html__( 'Title Tag', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'tp-elements' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'tp-elements' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'tp-elements' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'tp-elements' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'tp-elements' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'tp-elements' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'front_desc',
            [
                'label' => esc_html__( 'Description', 'tp-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => false,
                'default' => esc_html__( 'Front Description Here', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'front_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '', 'tp-elements' ),
                'placeholder' => esc_html__( 'Type button text here', 'tp-elements' ),
                'label_block' => false,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'front_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'tp-elements' ),
                'type' => Controls_Manager::URL,
                'label_block' => false,
                'placeholder' => esc_html__( 'https://example.com/', 'tp-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'front_btn_icon',
            [
                'label' => esc_html__( 'Button Icon', 'tp-elements' ),
                'type' => Controls_Manager::ICON,
                'options' => tp_framework_get_icons(),               
                'default' => '',
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'front_btn_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon-before' => [
                        'title' => esc_html__( 'Before', 'tp-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'icon-after' => [
                        'title' => esc_html__( 'After', 'tp-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'icon-after',
                'toggle' => false,
                'condition' => [
                    'front_btn_icon!' => '',
                ],
            ]
        ); 

        $this->add_control(
            'front_btn_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'condition' => [
                    'front_btn_icon!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'flip_box_back',
            [
                'label' => esc_html__( 'Back Part', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'back_icon_type',
            [
                'label' => esc_html__( 'Icon Type', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default' => 'icon',
                'options' => [
                    'none' => [
                        'title' => esc_html__( 'None', 'tp-elements' ),
                        'icon' => 'eicon-close',
                    ],
                    'icon' => [
                        'title' => esc_html__( 'Icon', 'tp-elements' ),
                        'icon' => 'eicon-star',
                    ],
                    'image' => [
                        'title' => esc_html__( 'Image', 'tp-elements' ),
                        'icon' => 'eicon-image',
                    ],
                ],
                'toggle' => false,
            ]
        );

        $this->add_control(
            'back_icon',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type' => Controls_Manager::ICON,
                'default' => '',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
                'options' => tp_framework_get_icons(),
            ]
        );

        $this->add_control(
            'back_image',
            [
                'label' => esc_html__( 'Image', 'tp-elements' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'back_image_thumbnail',
                'default' => 'thumbnail',
                'exclude' => [
                    'full',
                    'shop_catalog',
                    'shop_single',
                ],
                'condition' => [
                    'back_icon_type' => 'image'
                ]
            ]
        );

        $this->add_control(
            'back_title',
            [
                'label' => esc_html__( 'Title', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'default' => esc_html__('', 'tp-elements' ),
                'separator' => 'before', 
            ]
        );

        $this->add_control(
            'back_title_tag',
            [
                'label' => esc_html__( 'Title Tag', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => esc_html__( 'H1', 'tp-elements' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => esc_html__( 'H2', 'tp-elements' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => esc_html__( 'H3', 'tp-elements' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => esc_html__( 'H4', 'tp-elements' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => esc_html__( 'H5', 'tp-elements' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => esc_html__( 'H6', 'tp-elements' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_control(
            'back_title_link',
            [
                'label' => esc_html__( 'Title Link', 'tp-elements' ),
                'type' => Controls_Manager::URL,
                'label_block' => false,
                'placeholder' => esc_html__( 'https://example.com/', 'tp-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'back_desc',
            [
                'label' => esc_html__( 'Description', 'tp-elements' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => false,
                'default' => esc_html__('', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'back_btn_text',
            [
                'label' => esc_html__( 'Button Text', 'tp-elements' ),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Back Btn', 'tp-elements' ),
                'placeholder' => esc_html__( 'Type button text here', 'tp-elements' ),
                'label_block' => false,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'back_btn_link',
            [
                'label' => esc_html__( 'Button Link', 'tp-elements' ),
                'type' => Controls_Manager::URL,
                'label_block' => false,
                'placeholder' => esc_html__( 'https://example.com/', 'tp-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'back_btn_icon',
            [
                'label' => esc_html__( 'Button Icon', 'tp-elements' ),
                'type' => Controls_Manager::ICON,
                'options' => tp_framework_get_icons(),               
                'default' => '',
                'separator' => 'before',            
            ]
        );

        $this->add_control(
            'back_btn_icon_position',
            [
                'label' => esc_html__( 'Icon Position', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon-before' => [
                        'title' => esc_html__( 'Before', 'tp-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'icon-after' => [
                        'title' => esc_html__( 'After', 'tp-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'icon-after',
                'toggle' => false,
                'condition' => [
                    'back_btn_icon!' => '',
                ],
            ]
        ); 

        $this->add_control(
            'back_btn_icon_spacing',
            [
                'label' => esc_html__( 'Icon Spacing', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'condition' => [
                    'back_btn_icon!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn.icon-before i' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn.icon-after i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section(); 
    
        $this->start_controls_section(
            'flip_box_style',
            [
                'label' => esc_html__( 'General', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'flip_position',
            [
                'label' => esc_html__( 'Flip Direction', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'tp-flip-right',
                'label_block' => false,
                'options' => [
                    'tp-flip-right' => [
                        'title' => esc_html__( 'Left To Right', 'tp-elements' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'tp-flip-up' => [
                        'title' => esc_html__( 'Bottom To Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'tp-flip-down' => [
                        'title' => esc_html__( 'Top To Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'tp-flip-left' => [
                        'title' => esc_html__( 'Right To Left', 'tp-elements' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                ],
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'flip_box_height',
            [
                'label' => esc_html__( 'Height', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-flip-box .tp-flip-box-inner .back-part, 
                    {{WRAPPER}}  .tp-flip-box .tp-flip-box-inner .front-part' => 'height: {{SIZE}}{{UNIT}};',
                ],                
            ]
        );

        $this->add_responsive_control(
            'flip_box_transition',
            [
                'label' => esc_html__( 'Transition', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.10,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-flip-box .tp-flip-box-inner .back-part, 
                    {{WRAPPER}}  .tp-flip-box .tp-flip-box-inner .front-part' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'flip_box_front_style',
            [
                'label' => esc_html__( 'Front Part', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'flip_box_front_align',
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
                    '{{WRAPPER}} .front-part' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'flip_box_front_align_items',
            [
                'label' => esc_html__( 'Vertical Align', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .front-part' => 'align-items: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'flip_box_front_content_transition',
            [
                'label' => esc_html__( 'Content Transition', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.10,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-flip-box .tp-flip-box-inner .front-content-part' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_part_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .front-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_part_border',
                'selector' => '{{WRAPPER}} .front-part',
            ]
        );

        $this->add_control(
            'front_part_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .front-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_part_box_shadow',
                'selector' => '{{WRAPPER}} .front-part',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_part_bg',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .front-part::before',
            ]
        );

        $this->add_control(
            'front_part_icon_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'separator' => 'before',
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_part_icon_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon',
                
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_responsive_control(
            'front_part_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_responsive_control(
            'front_part_icon_gap',
            [
                'label' => esc_html__( 'Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'front_part_icon_width',
            [
                'label' => esc_html__( 'Icon/Image Part Width', 'tp-elements' ),
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
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon,'
                    .'{{WRAPPER}} .back-icon-part .front-img' => 'width: {{SIZE}}{{UNIT}};',
                ],            
            ]
        );

        $this->add_responsive_control(
            'front_part_icon_height',
            [
                'label' => esc_html__( 'Icon/Image Part Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon,'
                    .'{{WRAPPER}} .back-icon-part .front-img' => 'height: {{SIZE}}{{UNIT}};',
                ],             
            ]
        ); 

        $this->add_responsive_control(
            'front_part_icon_line_height',
            [
                'label' => esc_html__( 'Line/Image Part Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon,'
                    .'{{WRAPPER}} .back-icon-part .front-img' => 'line-height: {{SIZE}}{{UNIT}};',
                ],               
            ]
        );

        $this->add_control(
            'front_part_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_part_icon_bg',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon',
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_part_icon_border',
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon',
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_responsive_control(
            'front_part_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_part_icon_box_shadow',
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-icon-part .front-icon',
                'condition' => [
                    'front_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'front_part_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_part_title_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .front-title-part .front-title',
                
            ]
        );

        $this->add_responsive_control(
            'front_part_title_gap',
            [
                'label' => esc_html__( 'Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-title-part' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_part_title_color',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-title-part .front-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'front_part_desc_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_part_desc_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-desc-part .front-desc',
                
            ]
        );

        $this->add_responsive_control(
            'front_part_desc_gap',
            [
                'label' => esc_html__( 'Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-desc-part' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'front_part_desc_color',
            [
                'label' => esc_html__( 'Description Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-desc-part .front-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'front_part_btn',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'front_part_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'front_part_btn_typography',
                'selector' => '{{WRAPPER}} .front-btn-part .front-btn',
                
            ]
        );                

        $this->add_control(
            'front_part_btn_color',
            [
                'label' => esc_html__( 'Text Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'front_part_btn_bg',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'front_part_btn_border_color',
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn',
            ]
        );

        $this->add_responsive_control(
            'front_part_btn_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'front_part_btn_box_shadow',
                'selector' => '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn',
            ]
        );

        $this->add_control(
            'front_part_btn_icon_translate',
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
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                    '{{WRAPPER}} .front-part .front-content-part .front-btn-part .front-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->end_controls_section(); 

        $this->start_controls_section(
            'flip_box_back_style',
            [
                'label' => esc_html__( 'Back Part', 'tp-elements' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'flip_box_back_align',
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
                    '{{WRAPPER}} .back-part' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'flip_box_back_align_items',
            [
                'label' => esc_html__( 'Vertical Align', 'tp-elements' ),
                'type' => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => [
                    'start' => [
                        'title' => esc_html__( 'Top', 'tp-elements' ),
                        'icon' => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon' => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'Bottom', 'tp-elements' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .back-part' => 'align-items: {{VALUE}}'
                ]
            ]
        );

        $this->add_responsive_control(
            'flip_box_back_content_transition',
            [
                'label' => esc_html__( 'Content Transition', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0.10,
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .tp-flip-box .tp-flip-box-inner .front-content-part' => 'transition: {{SIZE}}s;',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_part_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .back-part' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_part_border',
                'selector' => '{{WRAPPER}} .back-part',
            ]
        );

        $this->add_control(
            'back_part_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .back-part' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_part_box_shadow',
                'selector' => '{{WRAPPER}} .back-part',
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_part_bg',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .back-part::before',
            ]
        );

        $this->add_control(
            'back_part_icon_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'separator' => 'before',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_part_icon_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon',
                
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_part_icon_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_part_icon_gap',
            [
                'label' => esc_html__( 'Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'back_part_icon_width',
            [
                'label' => esc_html__( 'Icon/Image Part Width', 'tp-elements' ),
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
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon,'
                    .'{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-img' => 'width: {{SIZE}}{{UNIT}};',
                ],            
            ]
        );

        $this->add_responsive_control(
            'back_part_icon_height',
            [
                'label' => esc_html__( 'Icon/Image Part Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon,'
                    .'{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-img' => 'height: {{SIZE}}{{UNIT}};',
                ],              
            ]
        ); 

        $this->add_responsive_control(
            'back_part_icon_line_height',
            [
                'label' => esc_html__( 'Icon/Image Part Line Height', 'tp-elements' ),
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
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon,'
                    .'{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-img' => 'line-height: {{SIZE}}{{UNIT}};',
                ],              
            ]
        );

        $this->add_control(
            'back_part_icon_color',
            [
                'label' => esc_html__( 'Icon Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'back_part_icon_bg',
                'label' => esc_html__( 'Background', 'tp-elements' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'back_part_icon_border',
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_responsive_control(
            'back_part_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'back_part_icon_box_shadow',
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-icon-part .back-icon',
                'condition' => [
                    'back_icon_type' => 'icon'
                ],
            ]
        );

        $this->add_control(
            'back_part_title_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Title', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_part_title_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-title-part .back-title',
                
            ]
        );

        $this->add_responsive_control(
            'back_part_title_gap',
            [
                'label' => esc_html__( 'Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-title-part' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_part_title_color',
            [
                'label' => esc_html__( 'Title Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-title-part .back-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_part_desc_style',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Description', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_part_desc_typography',
                'label' => esc_html__( 'Typography', 'tp-elements' ),
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-desc-part .back-desc',
                
            ]
        );

        $this->add_responsive_control(
            'back_part_desc_gap',
            [
                'label' => esc_html__( 'Bottom Gap', 'tp-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -200,
                        'max' => 200,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-desc-part' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'back_part_desc_color',
            [
                'label' => esc_html__( 'Description Color', 'tp-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-desc-part .back-desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'back_part_btn',
            [
                'type' => Controls_Manager::HEADING,
                'label' => esc_html__( 'Button', 'tp-elements' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'back_part_btn_padding',
            [
                'label' => esc_html__( 'Padding', 'tp-elements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'back_part_btn_typography',
                'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn',
                
            ]
        );

        $this->start_controls_tabs( 'back_part_btn_tabs' );

            $this->start_controls_tab(
                'back_part_btn_tabs_normal',
                [
                    'label' => esc_html__( 'Normal', 'tp-elements' ),
                ]
            );

                $this->add_control(
                    'back_part_btn_color',
                    [
                        'label' => esc_html__( 'Text Color', 'tp-elements' ),
                        'type' => Controls_Manager::COLOR,
                        'default' => '',
                        'selectors' => [
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'back_part_btn_bg',
                        'label' => esc_html__( 'Background', 'tp-elements' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'back_part_btn_border_color',
                        'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn',
                    ]
                );

                $this->add_responsive_control(
                    'back_part_btn_border_radius',
                    [
                        'label' => esc_html__( 'Border Radius', 'tp-elements' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'back_part_btn_box_shadow',
                        'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn',
                    ]
                );

                $this->add_control(
                    'back_part_btn_icon_translate',
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
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn.icon-before i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn.icon-after i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                        ],
                    ]
                );

            $this->end_controls_tab();

            $this->start_controls_tab(
                'back_part_btn_tabs_hover',
                [
                    'label' => esc_html__( 'Hover', 'tp-elements' ),
                ]
            );

                $this->add_control(
                    'back_part_btn_hover_color',
                    [
                        'label' => esc_html__( 'Text Color', 'tp-elements' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'back_part_btn_hover_bg',
                        'label' => esc_html__( 'Background', 'tp-elements' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn:hover',
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name' => 'back_part_btn_hover_border_color',
                        'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn:hover',
                    ]
                );

                $this->add_responsive_control(
                    'back_part_btn_hover_border_radius',
                    [
                        'label' => esc_html__( 'Hover Border Radius', 'tp-elements' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'size_units' => [ 'px', '%' ],
                        'selectors' => [
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Box_Shadow::get_type(),
                    [
                        'name' => 'back_part_btn_hover_box_shadow',
                        'selector' => '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn:hover',
                    ]
                );

                $this->add_control(
                    'back_part_btn_hover_icon_translate',
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
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn.icon-before:hover i' => '-webkit-transform: translateX(calc(-1 * {{SIZE}}{{UNIT}})); transform: translateX(calc(-1 * {{SIZE}}{{UNIT}}));',
                            '{{WRAPPER}} .back-part .back-content-part .back-btn-part .back-btn.icon-after:hover i' => '-webkit-transform: translateX({{SIZE}}{{UNIT}}); transform: translateX({{SIZE}}{{UNIT}});',
                        ],
                    ]
                );

            $this->end_controls_tab();

        $this->end_controls_tab();

        $this->end_controls_section();        

    }

  

    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Front Part Icon/Image
        if ( $settings['front_image']['id'] && isset( $settings['front_image']['url'] ) ) {
            $this->add_render_attribute( 'front_image', 'src', $settings['front_image']['url'] );
            $this->add_render_attribute( 'front_image', 'alt', Control_Media::get_image_alt( $settings['front_image'] ) );
            $this->add_render_attribute( 'front_image', 'title', Control_Media::get_image_title( $settings['front_image'] ) );
        }
        
        // Back Part Icon/Image
        if ( $settings['back_image']['id'] && isset( $settings['back_image']['url'] ) ) {
            $this->add_render_attribute( 'back_image', 'src', $settings['back_image']['url'] );
            $this->add_render_attribute( 'back_image', 'alt', Control_Media::get_image_alt( $settings['back_image'] ) );
            $this->add_render_attribute( 'back_image', 'title', Control_Media::get_image_title( $settings['back_image'] ) );
        }
        
    ?>
        


    <div class="tp-flip-box">
        <div class="tp-flip-box-inner <?php echo esc_attr($settings['flip_position']);?>">
            <div class="tp-flip-box-wrap">
                <div class="front-part">
                    <div class="front-content-part">
                        <?php if( !empty($settings['front_icon']) || !empty($settings['front_image']['url'])){?>
                            <div class="front-icon-part">
                                <?php if(!empty($settings['front_icon'])) : ?>
                                    <span class="front-icon"><i class="<?php echo esc_attr($settings['front_icon']);?>"></i></span>
                                <?php endif; ?>
                                <?php if(!empty($settings['front_image'])) : ?>
                                    <span class="front-img">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'front_image_thumbnail', 'front_image' ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php }?>

                        <?php if(!empty($settings['front_title'])) { ?>
                            <div class="front-title-part">
                                <<?php echo esc_attr($settings['front_title_tag']);?> class="front-title"> <?php echo esc_attr($settings['front_title']);?></<?php echo esc_attr($settings['front_title_tag']);?>>                                
                            </div>
                        <?php } ?>

                        <?php if(!empty($settings['front_desc'])) : ?>
                            <div class="front-desc-part">
                                <p class="front-desc"><?php echo esc_attr($settings['front_desc']);?></p>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['front_btn_text'])) : ?>
                            <div class="front-btn-part">
                                <a class="front-btn <?php echo esc_attr($settings['front_btn_icon_position']);?>" href="<?php echo esc_url($settings['front_btn_link']['url']);?>">
                                    <span class="front-btn-txt"><?php echo esc_attr($settings['front_btn_text']);?></span>
                                    <?php if(!empty($settings['front_btn_icon'])) : ?>
                                        <i class="<?php echo esc_attr($settings['front_btn_icon']);?>"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
                <div class="back-part">
                    <div class="back-content-part">
                        <?php if( !empty($settings['back_icon']) || !empty($settings['back_image']['url'])){?>
                            <div class="back-icon-part">
                                <?php if(!empty($settings['back_icon'])) : ?>
                                    <span class="back-icon"><i class="<?php echo esc_attr($settings['back_icon']);?>"></i></span>
                                <?php endif; ?>
                                <?php if(!empty($settings['back_image'])) : ?>
                                    <span class="back-img">
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'back_image_thumbnail', 'back_image' ); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php }?>

                        <?php if(!empty($settings['back_title'])) { ?>
                            <div class="back-title-part">
                                <?php if(!empty($settings['back_title_link']['url'])) : ?>
                                    <<?php echo esc_attr($settings['back_title_tag']);?> class="back-title"> 
                                        <a href="<?php echo esc_url($settings['back_title_link']['url']);?>"><?php echo esc_attr($settings['back_title']);?></a>
                                    </<?php echo esc_attr($settings['back_title_tag']);?>>
                                <?php else: ?>
                                    <<?php echo esc_attr($settings['back_title_tag']);?> class="back-title"> <?php echo esc_attr($settings['back_title']);?></<?php echo esc_attr($settings['back_title_tag']);?>>
                                <?php endif; ?>
                            </div>
                        <?php } ?>

                        <?php if(!empty($settings['back_desc'])) : ?>
                            <div class="back-desc-part">
                                <p class="back-desc"><?php echo esc_attr($settings['back_desc']);?></p>
                            </div>
                        <?php endif; ?>

                        <?php if(!empty($settings['back_btn_text'])) : ?>
                            <div class="back-btn-part">
                                <a class="back-btn <?php echo esc_attr( $settings['back_btn_icon_position'] );?>" href="<?php echo esc_url($settings['back_btn_link']['url']);?>">
                                    <span class="back-btn-txt"><?php echo esc_attr($settings['back_btn_text']);?></span>
                                    <?php if(!empty($settings['back_btn_icon'])) : ?>
                                        <i class="<?php echo esc_attr($settings['back_btn_icon']);?>"></i>
                                    <?php endif; ?>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <?php
    }
}
