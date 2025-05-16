<?php
/**
 * Marquee widget class
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

defined( 'ABSPATH' ) || die();

class Themephi_Elementor_pro_Line_Draw_Widget extends \Elementor\Widget_Base {


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
        return 'tp-linedraw';
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
        return esc_html__( 'TP Line Draw', 'tp-elements' );
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
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }

    protected function register_controls() {   


        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'tp-elements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'top-to-bottom',
			[
				'label' => esc_html__( 'Link', 'tp-elements' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'please insert your link', 'tp-elements' ),
			]
		);

		$this->end_controls_section();

        
    }

    protected function render() {

        $settings = $this->get_settings_for_display();   

        ?>

        <style>
            
        /* line drow  */
        .tps-to-bottom-start a {
            width: 20px;
            height: 32px;
            line-height: 30px;
            display: inline-block;
            border-radius: 10px;
            border: 2px solid var(--bodyColor);
            position: relative;
        }
        .tps-to-bottom-start a::before {
            content: '';
            position: absolute;
            left: 50%;
            top: 30%;
            transform: translate(-50%, -30%);
            height: 7px;
            width: 2px;
            background: var(--whiteColor);
            animation: jump-5 3s linear infinite;
        }

        @keyframes jump-5 {
            0% {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }

            40% {
                transform: translate3d(0, 10px, 0);
            }

            100% {
                -webkit-transform: translate3d(0, 0, 0);
                transform: translate3d(0, 0, 0);
            }
        }

        </style>

        <div class="tp-line-draw">
            <div class="tps-to-bottom-start">
                <a href="<?php echo esc_html($settings['top-to-bottom']); ?>" class="active"></a>
            </div>          
        </div>
<?php
    }
}