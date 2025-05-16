<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Search Button.
 *
 * HFE widget for Search Button.
 *
 * @since 1.5.0
 */
class Themephi_hfe_course_category extends Widget_Base {
    /**
     * Retrieve the widget name.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'hfe-course-category';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'TP HFE Course Category', 'tp-elements');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-search';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'header_footer_category' ];
    }

    /**
     * Retrieve the list of scripts the navigation menu depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.5.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
 

    /**
     * Register Search Button controls.
     *
     * @since 1.5.7
     * @access protected
     */
    protected function register_controls() {
        $this->register_general_content_controls();
        $this->register_search_style_controls();
    }
    /**
     * Register Search General Controls.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function register_general_content_controls() {
        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Course Category Layout', 'tp-elements'),
            ]
        );

        $this->add_control(
            'layout',
            [
                'label'        => __( 'Layout ', 'tp-elements'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'style1',
                'options'      => [
                    'style1'      => __( 'Style 1', 'tp-elements'),
                ],
            ]
        );

        $this->end_controls_section();

    }
    /**
     * Register Search Style Controls.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function register_search_style_controls() {

        $this->start_controls_section(
            'section_button_style',
            [
                'label'     => __( 'Button', 'tp-elements'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs( 'tabs_button_colors' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'tp-elements'),
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label'     => __( 'Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#1E1E1E',
                'selectors' => [
                    '{{WRAPPER}} .h2_header-category-submenu li a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name'           => 'button_background',
                'label'          => __( 'Background', 'tp-elements'),
                'types'          => [ 'classic', 'gradient' ],
                'exclude'        => [ 'image' ],
                'selector'       => '{{WRAPPER}} .h2_header-category-submenu li a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'tp-elements'),
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'     => __( 'Text Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h2_header-category-submenu li:hover > a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_background_color_hover',
            [
                'label'     => __( 'Background Color', 'tp-elements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .h2_header-category-submenu li:hover > a' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }
    /**
     * Render Search button output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $args = [
            'taxonomy' => 'course-category',
            'hide_empty' => false,
        ];
        $categories = get_terms($args);


        if (!empty($categories)) { ?> 

            <style>
            .h2_header-category {
                position: relative;
                z-index: 99;
            }
            .h2_header-category:hover > .h2_header-category-submenu {
                opacity: 1;
                visibility: visible;
            }
            .h2_header-category a {
                color: #1E1E1E;
                font-size: 16px;
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 15px 0;
            }
            .h2_header-category a span {
                display: block;
                font-size: 16px;
                line-height: 1;
                font-weight: 500;
                color: #1E1E1E;
                -webkit-transition: all 0.3s linear 0s;
                -moz-transition: all 0.3s linear 0s;
                -ms-transition: all 0.3s linear 0s;
                -o-transition: all 0.3s linear 0s;
                transition: all 0.3s linear 0s;
            }
            .h2_header-category-submenu {
                position: absolute;
                left: 0;
                top: 100%;
                background: #fff;
                width: 240px;
                opacity: 0;
                visibility: hidden;
                -webkit-transition: all 0.3s linear 0s;
                -moz-transition: all 0.3s linear 0s;
                -ms-transition: all 0.3s linear 0s;
                -o-transition: all 0.3s linear 0s;
                transition: all 0.3s linear 0s;
                box-shadow: 0 9px 19px rgba(0, 0, 0, 0.1);
                z-index: 99;
                margin: 0;
            }
            .h2_header-category-submenu li {
                display: block;
                margin-right: 0;
                position: relative;
                z-index: 99;
            }
            .h2_header-category-submenu li:not(:last-child) {
                border-bottom: 1px solid #f2f2f2;
            }
            .h2_header-category-submenu li a {
                padding: 12px 25px;
                display: block;
                color: #1E1E1E;
                -webkit-transition: all 0.3s linear 0s;
                -moz-transition: all 0.3s linear 0s;
                -ms-transition: all 0.3s linear 0s;
                -o-transition: all 0.3s linear 0s;
                transition: all 0.3s linear 0s;
            }
            .h2_header-category-submenu li:hover > a {
                background-color: #1268EB;
                color: #fff;
            }
            </style>
            <div class="h2_header-category ">
                <a href="#">
                    <i class="fa fa-th" aria-hidden="true"></i> <span><?php echo esc_html__( 'Category', 'tp-elements' ); ?></span>
                </a>
                <ul class="h2_header-category-submenu">              
                    <?php
                    foreach ($categories as $category) {
                    $category_link = get_term_link($category->term_id);
                    ?>
                    <li><a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html( $category->name ); ?></a></li>
                    <?php 
                    } ?>
                </ul>
            </div>
            <?php
        }
    }
}
