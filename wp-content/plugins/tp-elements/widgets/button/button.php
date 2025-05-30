<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Core\Schemes\Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class Themephi_Button_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'tp-button';
    }

    public function get_title() {
        return esc_html__( 'TP Button', 'tp-elements' );
    }

    public function get_icon() {
        return 'glyph-icon flaticon-menu';
    }

    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'button' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_button',
            [
                'label' => esc_html__( 'Content', 'tp-elements' ),
            ]
        );

        $this->add_control(
            'button_style',
            [
                'label'       => esc_html__( 'Select Style', 'tp-elements' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'     => 'primary_btn',
                'separator'   => 'before',
                'options'     => [                    
                    'primary_btn' => esc_html__( 'Primary Button', 'tp-elements'),
                    'tutor_btn'   => esc_html__( 'Tutor Button', 'tp-elements'),
                ],
            ]
        );
        
        $this->add_control(
            'btn_text',
            [
                'label'       => esc_html__( 'Button Text', 'tp-elements' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => 'Sample',
                'placeholder' => esc_html__( 'Button Text', 'tp-elements' ),
                'separator'   => 'before',
                'condition'   => [
                    'button_style' => 'primary_btn',
                ],
            ]
        );

        $this->add_control(
            'btn_link',
            [ 
                'label'       => esc_html__( 'Button Link', 'tp-elements' ),
                'type'        => Controls_Manager::URL,
                'label_block' => true,        
                'condition'   => [
                    'button_style' => 'primary_btn',
                ],
                'default'     => [
                    'url'         => '#',
                    'is_external' => false,
                    'nofollow'    => false,
                ],                
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'   => esc_html__( 'Alignment', 'tp-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'    => [
                        'title' => esc_html__( 'Left', 'tp-elements' ),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'tp-elements' ),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__( 'Right', 'tp-elements' ),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'tp-elements' ),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}} .themephi-button' => 'text-align: {{VALUE}}',
                ]
            ]
        );

        $this->add_responsive_control(
            'button_hover_effect',
            [
                'label'   => esc_html__( 'Button Hover Effect', 'tp-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'no_shape',
                'options' => [
                    'no_shape'      => 'No Shape',
                    'style1'        => 'Shape 1',
                    'upload'        => 'Upload',
                    'new_page'      => 'New Page',
                    'render'        => 'Render',
                    'reshape'       => 'Reshape',
                    'export_file'   => 'Export File',
                    'add'           => 'Add',
                    'swipe'         => 'Swipe',
                    'double_swipe'  => 'Double Swipe',
                    'smooth'        => 'Smooth',
                    'diagonal_close'=> 'Diagonal Close',
                    'collision'     => 'Collision',
                ],
                'prefix_class' => 'tp-button-',
            ]
        );

        $this->add_control(
            'icon_heading',
            [
                'label' => esc_html__( 'Icon', 'tp-elements' ),
                'type'  => Controls_Manager::HEADING,               
            ]
        );

        $this->add_control(
            'show_icon',
            [
                'label'        => esc_html__( 'Show Icon', 'tp-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Show', 'tp-elements' ),
                'label_off'    => esc_html__( 'Hide', 'tp-elements' ),
                'return_value' => 'yes',
                'default'      => 'yes',
            ]
        );

        $this->add_control(
            'icon_position',
            [
                'label'     => esc_html__( 'Icon Position', 'tp-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'after',
                'options'   => [
                    'before' => esc_html__( 'Before Content', 'tp-elements' ),
                    'after'  => esc_html__( 'After Content', 'tp-elements' ),
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'btn_icon',
            [
                'label'     => esc_html__( 'Icon', 'tp-elements' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value' => 'tp tp-arrow-left',                    
                ],
                'separator' => 'before',
                'condition' => [
                    'show_icon' => 'yes',
                    'button_style' => 'primary_btn',
                ],                
            ]
        );

        $this->add_control(
            'student_icon',
            [
                'label'     => esc_html__( 'Student Icon', 'tp-elements' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value' => 'fas fa-user-graduate',
                ],
                'separator' => 'before',
                'condition' => [
                    'show_icon' => 'yes',
                    'button_style' => 'tutor_btn',
                ],
            ]
        );

        $this->add_control(
            'instructor_icon',
            [
                'label'     => esc_html__( 'Instructor Icon', 'tp-elements' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value' => 'fas fa-chalkboard-teacher',
                ],
                'separator' => 'before',
                'condition' => [
                    'show_icon' => 'yes',
                    'button_style' => 'tutor_btn',
                ],
            ]
        );

        $this->add_control(
            'admin_icon',
            [
                'label'     => esc_html__( 'Admin Icon', 'tp-elements' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value' => 'fas fa-user-shield',
                ],
                'separator' => 'before',
                'condition' => [
                    'show_icon' => 'yes',
                    'button_style' => 'tutor_btn',
                ],
            ]
        );

        $this->add_control(
            'btn_icon_spacing',
            [
                'label' => esc_html__( 'Icon Left Spacing', 'tp-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'selectors' => [        
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'margin-left: {{SIZE}}{{UNIT}};',            
                ],
                'condition' => [
                    'icon_position' => 'after',
                ],    
            ]
        );        

        $this->add_control(
            'btn_icon_spacing_left',
            [
                'label' => esc_html__( 'Icon Right Spacing', 'tp-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'margin-right: {{SIZE}}{{UNIT}};',           
                ],
                'condition' => [
                    'icon_position' => 'before',
                ],    
            ]
        );        

        $this->add_control(
            'btn_icon_spacing_top',
            [
                'label' => esc_html__( 'Icon Top/Bottom Spacing', 'tp-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [                    
                    'size' => 0,
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi-button i' => 'top: {{SIZE}}px;',     
                    '{{WRAPPER}} .themephi-button a svg' => 'top: {{SIZE}}px;',           
                ],
                'condition' => [
                    'show_icon' => 'yes',
                ],    
            ]
        );    
        
        $this->end_controls_section();    

        // Style Tab - Button
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => esc_html__( 'Button', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'tp_button_width',
            [
                'label'      => esc_html__( 'Width', 'tp-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi_button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_typography',
                'selector' => '{{WRAPPER}} .themephi-button a .themephi-button-text',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        // Normal State Tab
        $this->start_controls_tab(
            'style_normal_tab',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_control(
            'btn_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_normal',
                'label'    => esc_html__( 'Background', 'tp-elements' ),
                'types'    => [ 'classic', 'gradient' ],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}} .themephi-button a',
            ]
        );

        $this->add_control(
            'btn_before_bg_color_normal',
            [
                'label'     => esc_html__( 'Before BG Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_control(
            'btn_after_border_color_normal',
            [
                'label'     => esc_html__( 'After Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_border',
                'selector' => '{{WRAPPER}} .themephi-button a',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .themephi-button a',
            ]
        );

        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'style_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_hover_typography',
                'selector' => '{{WRAPPER}} .themephi-button a:hover .themephi-button-text',
            ]
        );

        $this->add_control(
            'btn_text_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a:hover .themephi-button-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_hover',
                'label'    => esc_html__( 'Background', 'tp-elements' ),
                'types'    => [ 'classic', 'gradient' ],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}} .themephi-button a:hover',
            ]
        );

        $this->add_control(
            'btn_before_bg_color',
            [
                'label'     => esc_html__( 'Before BG Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => ['style1', 'upload', 'new_page', 'render', 'export_file', 'add', 'swipe', 'smooth', 'collision'],
                ]
            ]
        );
        
        $this->add_control(
            'btn_before_bg_color_hover',
            [
                'label'     => esc_html__( 'Before BG Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a:hover:before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_control(
            'btn_after_bg_color',
            [
                'label'     => esc_html__( 'After BG Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::after' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => ['style1', 'export_file', 'smooth', 'collision']
                ]
            ]
        );

        $this->add_responsive_control(
            'before_border_size',
            [
                'label'      => esc_html__( 'Before Border Size', 'tp-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::before' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'double_swipe', 'diagonal_close' ],
                ]
            ]
        );

        $this->add_control(
            'btn_before_border_color',
            [
                'label'     => esc_html__( 'Before Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::before' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'double_swipe', 'diagonal_close' ],
                ]
            ]
        );

        $this->add_responsive_control(
            'after_border_size',
            [
                'label'      => esc_html__( 'After Border Size', 'tp-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::after' => 'border-width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'double_swipe', 'diagonal_close' ],
                ]
            ]
        );

        $this->add_control(
            'btn_after_border_color_two',
            [
                'label'     => esc_html__( 'Before Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a::after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'double_swipe', 'diagonal_close' ],
                ]
            ]
        );

        $this->add_control(
            'btn_after_border_color_hover',
            [
                'label'     => esc_html__( 'After Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a:hover:after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );
        
        $this->add_control(
            'button_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} .themephi-button a:hover',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'button_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],
            ]
        );
        
        $this->add_responsive_control(
            'link_padding',
            [
                'label'      => esc_html__( 'Padding', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Icon
        $this->start_controls_section(
            '_section_style_icon',
            [
                'label' => esc_html__( 'Button Icon', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_icon_size',
            [
                'label'      => esc_html__( 'Size', 'tp-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_text_color',
            [
                'label'     => esc_html__( 'Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_color',
            [
                'label'     => esc_html__( 'Hover Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a:hover .themephi-button-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .themephi-button a:hover .themephi-button-icon svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_background',
            [
                'label'     => esc_html__( 'Background', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon i' => 'background: {{VALUE}};',
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon svg' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_hover_background',
            [
                'label'     => esc_html__( 'Hover Background', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .themephi-button a:hover .themephi-button-icon i'=> 'background: {{VALUE}};',
                    '{{WRAPPER}} .themephi-button a:hover .themephi-button-icon svg'=> 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__( 'Padding', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button a .themephi-button-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        
        // Style Tab - Button Dropdown
        $this->start_controls_section(
            '_section_style_button_dropdown',
            [
                'label' => esc_html__( 'Dropdown Button', 'tp-elements' ),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'button_style' => ['tutor_btn'],
                ],
            ]
        );
        
        $this->add_responsive_control(
            'tp_dropdown_button_width',
            [
                'label'      => esc_html__( 'Dropdown Width', 'tp-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range'      => [
                    'px' => [
                        'min'  => 0,
                        'max'  => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tp_dropdown_padding',
            [
                'label'      => esc_html__( 'Padding', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => '_dropdown_background_normal',
                'label'    => esc_html__( 'Background', 'tp-elements' ),
                'types'    => [ 'classic', 'gradient' ],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}} .themephi-button-tutor-dropdown',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => '_dropdown_button_border',
                'selector' => '{{WRAPPER}} .themephi-button-tutor-dropdown',
            ]
        );

        $this->add_control(
            'button_dropdown_wrapper_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_button_dropdown' );

        // Normal State Tab
        $this->start_controls_tab(
            'style_normal_tab_dropdown',
            [
                'label' => esc_html__( 'Normal', 'tp-elements' ),
            ]
        ); 

        $this->add_responsive_control(
            '_dropdown_btn_padding',
            [
                'label'      => esc_html__( 'Padding', 'tp-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => '_dropdown_btn_typography',
                'selector' => '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a',
            ]
        );

        $this->add_control(
            'btn_dropdown_text_color',
            [
                'label'     => esc_html__( 'Text Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => 'background_dropdown_item_normal',
                'label'    => esc_html__( 'Background', 'tp-elements' ),
                'types'    => [ 'classic', 'gradient' ],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'button_dropdown_border',
                'selector' => '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a',
            ]
        );

        $this->add_control(
            'button_dropdown_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],
            ]
        );

        /* eikhan start */

        $this->add_control(
            'btn_dropdown_before_bg_color_normal',
            [
                'label'     => esc_html__( 'Before BG Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_control(
            'btn_dropdown_after_border_color_normal',
            [
                'label'     => esc_html__( 'After Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a::after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_dropdown_box_shadow',
                'selector' => '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a',
            ]
        );

        /* eikhan end */


        $this->end_controls_tab();

        // Hover State Tab
        $this->start_controls_tab(
            'style_dropdown_hover_tab',
            [
                'label' => esc_html__( 'Hover', 'tp-elements' ),
            ]
        ); 

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'btn_dropdown_hover_typography',
                'selector' => '{{WRAPPER}} .themephi-button-tutor-dropdown a:hover',
            ]
        );

        $this->add_control(
            'btn_dropdown_text_hover_color',
            [
                'label'     => esc_html__( 'Text Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'     => '_dropdown_background_item_hover',
                'label'    => esc_html__( 'Background', 'tp-elements' ),
                'types'    => [ 'classic', 'gradient' ],
                'exclude'  => [ 'image' ],
                'selector' => '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a:hover',
            ]
        );

        $this->add_control(
            'button_dropdown_hover_border',
            [
                'label'     => esc_html__( 'Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        
        $this->add_control(
            'button_dropdown_hover_border_radius',
            [
                'label'      => esc_html__( 'Border Radius', 'tp-elements' ),
                'type'      => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .themephi-button-tutor-dropdown a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',           
                ],
            ]
        );

        /* eikhan start */

        $this->add_control(
            'btn_dropdown_hover_before_bg_color_normal',
            [
                'label'     => esc_html__( 'Before BG Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a:hover::before' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_control(
            'btn_dropdown_hover_after_border_color_normal',
            [
                'label'     => esc_html__( 'After Border Color', 'tp-elements' ),
                'type'      => Controls_Manager::COLOR,          
                'selectors' => [
                    '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a:hover::after' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'button_hover_effect' => [ 'reshape' ],
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'button_dropdown_hover_box_shadow',
                'selector' => '{{WRAPPER}} .tutor_btn .themephi-button-tutor-dropdown a:hover',
            ]
        );

        /* eikhan end */

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {    
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes( 'btn_text', 'basic' );
        $this->add_render_attribute( 'btn_text', 'class', 'btn_text' );

        // Initialize variables
        $button_text = '';
        $link_attr = '';
        $icon_html = '';
        $dropdown_html = '';

        // Handle link attributes based on button type
        if ($settings['button_style'] === 'primary_btn') {
            // Primary button link handling
            $url = !empty($settings['btn_link']['url']) ? esc_url($settings['btn_link']['url']) : '#';
            $target = !empty($settings['btn_link']['is_external']) ? ' target="_blank"' : '';
            $nofollow = !empty($settings['btn_link']['nofollow']) ? ' rel="nofollow"' : '';
            $link_attr = 'href="' . $url . '"' . $target . $nofollow;
            $button_text = esc_html($settings['btn_text']);
        } else {
            // Tutor button handling
            if (is_user_logged_in()) {
                $user = wp_get_current_user();
                $roles = (array) $user->roles;
                
                // Determine user role text
                if (in_array('tutor_instructor', $roles)) {
                    $role_text = esc_html__('Instructor', 'tp-elements');
                } elseif (in_array('administrator', $roles)) {
                    $role_text = esc_html__('Administrator', 'tp-elements');
                } else {
                    $role_text = esc_html__('Student', 'tp-elements');
                }
                
                $button_text = $role_text;
                $link_attr = 'href="' . esc_url(site_url('/dashboard')) . '"';
                
                // Add logout link to dropdown
                $dropdown_html = '<div class="themephi-button-tutor-dropdown">';
                $dropdown_html .= '<a href="' . esc_url( site_url('/dashboard') ) . '">';
                $dropdown_html .= esc_html__('My Dashboard', 'tp-elements') . '</a>';
                $dropdown_html .= '<a href="' . esc_url(wp_logout_url(home_url())) . '">';
                $dropdown_html .= esc_html__('Logout', 'tp-elements') . '</a>';
                $dropdown_html .= '</div>';
            } else {
                $button_text = '<i class="tp tp-user-1"></i> ' . esc_html__('Student', 'tp-elements');
                $link_attr = 'href="' . esc_url(wp_login_url()) . '"';
                
                // Add login/register links to dropdown
                $dropdown_html = '<div class="themephi-button-tutor-dropdown">';
                $dropdown_html .= '<a href="' . esc_url( site_url('/dashboard') ) . '">';
                $dropdown_html .= esc_html__('Login', 'tp-elements') . '</a>';
                $dropdown_html .= '<a href="' . esc_url( site_url('/student-registration') ) . '">';
                $dropdown_html .= esc_html__('Register', 'tp-elements') . '</a>';
                $dropdown_html .= '</div>';
            }
        }

        // Handle icon rendering
        if ($settings['show_icon'] === 'yes') {
            $icon = null;
            
            if ($settings['button_style'] === 'tutor_btn' && is_user_logged_in()) {
                $user = wp_get_current_user();
                $roles = (array) $user->roles;
                
                if (in_array('tutor_instructor', $roles) && !empty($settings['instructor_icon'])) {
                    $icon = $settings['instructor_icon'];
                } elseif (in_array('administrator', $roles) && !empty($settings['admin_icon'])) {
                    $icon = $settings['admin_icon'];
                } elseif (!empty($settings['student_icon'])) {
                    $icon = $settings['student_icon'];
                }
            } elseif (!empty($settings['btn_icon'])) {
                $icon = $settings['btn_icon'];
            }
            
            if ($icon) {
                ob_start();
                \Elementor\Icons_Manager::render_icon($icon, ['aria-hidden' => 'true']);
                $icon_html = '<span class="themephi-button-icon">' . ob_get_clean() . '</span>';
            }
        }
        ?>
        
        <div class="themephi-button <?php echo esc_attr($settings['button_style']); ?>">
            <a class="themephi_button" <?php echo $link_attr; ?>>
                <?php if (!empty($icon_html) && $settings['icon_position'] === 'before') : ?>
                    <?php echo $icon_html; ?>
                <?php endif; ?>
                
                <span class="themephi-button-text">
                    <?php echo $button_text; ?>
                </span>
                
                <?php if (!empty($icon_html) && $settings['icon_position'] === 'after') : ?>
                    <?php echo $icon_html; ?>
                <?php endif; ?>
            </a>
            
            <?php echo $dropdown_html; ?>
        </div>
        <?php 
    }
}