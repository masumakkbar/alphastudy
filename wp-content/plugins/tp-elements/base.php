<?php
/**
 * Main Elementor Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
final class TPelements_Elementor_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.4';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {
		load_plugin_textdomain( 'tp-elements' );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}
		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_category' ] );
        add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_tpaddon_category' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'resgister_header_footer_category' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'tpelements_register_widget_styles' ] );	
		add_action( 'wp_enqueue_scripts', [ $this, 'tpaddon_register_plugin_styles' ] );		
		add_action( 'admin_enqueue_scripts', [ $this, 'tpaddon_admin_defualt_css' ] );		
		add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'tpaddon_register_plugin_admin_styles' ] );
		$this->include_files();		
	}

	public function tpelements_register_widget_styles() {		
		$dir = plugin_dir_url(__FILE__);        
		$tpelements_addon_setting = get_option( 'tpelements_addon_option' );

			
		//Contact Form 7
		if( isset( $tpelements_addon_setting['tp_contact_form_7_setting'] ) == 'tpelement_contact_form_7' ) {
			wp_enqueue_style( 'tpelements-cf7', $dir.'widgets/cf7/cf7-css/cf7.css' );			
		}			
		//price table
		if( isset( $tpelements_addon_setting['tp_pricing_table_setting'] ) == 'tpelement_pricing_table' ) {
			wp_enqueue_style( 'tpelements-pricing-table', $dir.'widgets/pricing-table/pricing-table-css/pricing-table.css' );
		}		
		//CTA
		if( isset( $tpelements_addon_setting['tp_cta_setting'] ) == 'tpelement_cta' ) {			
			wp_enqueue_style( 'tpelements-cta', $dir.'widgets/cta/cta-css/cta.css' );	
		}
		//Flip Box
		// if( isset( $tpelements_addon_setting['tp_flip_box_setting'] ) == 'tpelement_flip_box' ) {
		// 	wp_enqueue_style( 'tpelements-flipbox', $dir.'widgets/flip-box/flipbox.css' );
		// }

		//Icon Box
		if( isset( $tpelements_addon_setting['tp_icon_box_setting'] ) == 'tpelement_icon_box' ){
			wp_enqueue_style( 'tpelements-iconbox', $dir.'widgets/iconbox/tp-iconbox-css/iconbox.css' );
		}
		//Progress Pie
		if( isset( $tpelements_addon_setting['tp_progress_pie_setting'] ) == 'tpelement_progress_pie' ) {
			wp_enqueue_style( 'tpelements-progress-pie', $dir.'widgets/progress-pie/progress-pie-css/progress-pie.css' );
		}

		// Counter CSS
		wp_enqueue_style( 'tpelements-counter', $dir.'widgets/counter/tp-counter-css/counter.css' );	 
		
		// Accordion CSS
		wp_enqueue_style( 'tpelements-accordion-two', $dir.'widgets/accordion-two/accordion-css/accordion-two.css' );	 
		
		// video CSS
		wp_enqueue_style( 'tpelements-video', $dir.'widgets/video/video-css/video.css' );	
		
		// Feature list CSS
		wp_enqueue_style( 'tpelements-feature-list', $dir.'widgets/feature-list/feature-list-css/feature-list.css' );	

		// icon CSS
		wp_enqueue_style( 'tpelements-icon', $dir.'widgets/icon/icon-css/icon.css' );	
		
		// button CSS
		wp_enqueue_style( 'tpelements-button', $dir.'widgets/button/button-css/button.css' );	
		
		// progress bar CSS
		wp_enqueue_style( 'tpelements-progress', $dir.'widgets/progress/progress-css/progress.css' );	

		// Countdown css
		wp_enqueue_style( 'tpelements-countdown', $dir.'widgets/countdown/countdown.css' );	

		// progress bar CSS
		wp_enqueue_style( 'tpelements-business-hour', $dir.'widgets/business-hour/tp-hour-css/business-hour.css' );	

		// advance tab CSS
		wp_enqueue_style( 'tpelements-advance-tab', $dir.'widgets/advanced-tab/adv-tab-css/advance-tab.css' );	

		// blockquote CSS
		wp_enqueue_style( 'tpelements-blockquote', $dir.'widgets/blockquote/blockquote-css/blockquote.css' );	

		// header-footer CSS
		wp_enqueue_style( 'tpelements-header-footer', $dir.'widgets/header-footer/css/style.css' );	

		// contact box CSS
		wp_enqueue_style( 'tpelements-contact-box', $dir.'widgets/contact-box/contact-box-css/contact-box.css' );	

		// Blog CSS
		wp_enqueue_style( 'tpelements-blog-css', $dir.'widgets/blog-grid/blog-css/blog-grid.css' );	

		// Blog category CSS
		wp_enqueue_style( 'tpelements-blog-category-css', $dir.'widgets/blog-category/blog-category-css/blog-category.css' );	

		// testimonial box CSS
		wp_enqueue_style( 'tpelements-testimonial', $dir.'widgets/testimonials/testimonial-css/testimonial.css' );	

		// timeline CSS
		wp_enqueue_style( 'tpelements-timeline', $dir.'widgets/timeline/timeline-css/timeline.css' );	

		// dual heading CSS
		wp_enqueue_style( 'tpelements-dual-heading', $dir.'widgets/dual-heading/dual-heading-css/dual-heading.css' );	

		// Mailchimp CSS
		wp_enqueue_style( 'tpelements-mailchimp', $dir.'widgets/mailchimp/mailchip-css/mailchimp.css' );	

		// Events CSS
		wp_enqueue_style( 'tpelements-event-css', $dir.'widgets/tribe-events/events/events-css/events.css' );

		// Events List CSS
		wp_enqueue_style( 'tpelements-event-list-css', $dir.'widgets/tribe-events/events-list/events-list-css/events-list.css' );

		// course CSS
		wp_enqueue_style( 'tpelements-course-css', $dir.'widgets/tutor/courses/courses-css/courses.css' );

		// team CSS
		wp_enqueue_style( 'tpelements-team-css', $dir.'widgets/teams/teams-css/teams.css' );

	}

	public function tpaddon_register_plugin_styles() {		
		$dir = plugin_dir_url(__FILE__);       
		wp_enqueue_style( 'custom-elements', $dir.'assets/css/aos.css' );		
		wp_enqueue_style( 'aos', $dir.'assets/css/elements.css' );     
        //enqueue javascript   		  
		wp_enqueue_script( 'aos', $dir.'assets/js/aos.js' , array('jquery'), '201513434', true);
		wp_enqueue_script( 'hover-revel', $dir.'assets/js/hover-revel.js' , array('jquery'), '201513435', true);
		wp_enqueue_script( 'twinmax', $dir.'assets/js/twinmax.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'jquery-plugin-progressbar', $dir.'assets/js/jQuery-plugin-progressbar.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'jquery-plugin-timecircle', $dir.'assets/js/TimeCircles.js' , array('jquery'), '201513434', true);
        wp_enqueue_script( 'tpaddons-custom-pro', $dir.'assets/js/custom.js', array('jquery', 'imagesloaded'), '201513434', true);       	
        
    }

    public function tpaddon_register_plugin_admin_styles(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'tpaddons-admin-pro', $dir.'assets/css/admin/admin.css' );
    	wp_enqueue_style( 'tpaddons-admin-floaticon-pro', $dir.'assets/fonts/flaticon.css' );
    } 

    public function tpaddon_admin_defualt_css(){
    	$dir = plugin_dir_url(__FILE__);
    	wp_enqueue_style( 'tpaddons-admin-pro-style', $dir.'assets/css/admin/style.css' );    	
    }

     public function include_files() {       
        require( __DIR__ . '/inc/tp-addon-icons.php' ); 
        require( __DIR__ . '/inc/form.php' );  
        require( __DIR__ . '/inc/helper.php' );  
        require( __DIR__ . '/inc/single-templates.php' );
        require( __DIR__ . '/inc/subscription-modal.php' );
    }

	public function add_category( $elements_manager ) {
        $elements_manager->add_category(
            'pielements_category',
            [
                'title' => esc_html__('TP Elementor Addons', 'tp-elements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_tpaddon_category( $elements_manager ) {
        $elements_manager->add_category(
            'tpaddon_category',
            [
                'title' => esc_html__('TP Elementor Pro Addons', 'tp-elements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }

    public function resgister_header_footer_category( $elements_manager ) {
        $elements_manager->add_category(
            'header_footer_category',
            [
                'title' => esc_html__('TP Header Footer Elements', 'tp-elements' ),
                'icon' => 'fa fa-smile-o',
            ]
        );
    }


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'tp-elements' ),
			'<strong>' . esc_html__( 'TP Elementor Addon', 'tp-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tp-elements' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tp-elements' ),
			'<strong>' . esc_html__( 'TP Elementor Addon', 'tp-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'tp-elements' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'tp-elements' ),
			'<strong>' . esc_html__( 'TP Elementor Addon', 'tp-elements' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'tp-elements' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {
		$tpelements_addon_setting = get_option( 'tpelements_addon_option' );		
		
		// add new teams
		require_once(__DIR__ . '/widgets/header-footer/course-category.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_hfe_course_category());
		
		// add new teams
		require_once(__DIR__ . '/widgets/teams/teams.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Teachers_Widget());
		
		// add new events 
		require_once(__DIR__ . '/widgets/tribe-events/events/events.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Tribe_Events_Widget());
		
		// add new events list
		require_once(__DIR__ . '/widgets/tribe-events/events-list/events-list.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Tribe_Events_List_Widget());
		
		// add new Course Search
		require_once(__DIR__ . '/widgets/tutor/course-search/course-search.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Tutor_Course_Search());
		
		// add new Course Category
		require_once(__DIR__ . '/widgets/tutor/course-category/course-category.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Course_Category_Widget());

		// add new Course
		require_once(__DIR__ . '/widgets/tutor/courses/courses.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Courses_Widget());

		// add new Blog Category
		require_once(__DIR__ . '/widgets/blog-category/blog-category.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Blog_Category_Widget());

		// add new Blog Fullwidth 
		require_once(__DIR__ . '/widgets/blog-fullwidth/blog-fullwidth.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Blog_Fullwidth_Widget());

		// add new testimonial slider
		require_once(__DIR__ . '/widgets/testimonials/testimonials.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Testimonials_Widget());

		// add new swiper navigation
		require_once(__DIR__ . '/widgets/swiper-navigation/swiper-navigation.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Swiper_Navigation_Widget());

		// new Switcher Masum
		require_once(__DIR__ . '/widgets/switcher/switcher.php');
		\Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Switcher_Widget());

		// countdown new
		require_once( __DIR__ . '/widgets/countdown/countdown.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pro_Countdown_Widget() );

		//heading
		if( isset( $tpelements_addon_setting['tp_heading_setting'] ) == 'tp_element_heading' ) {
            require_once(__DIR__ . '/widgets/heading/heading.php');
            \Elementor\Plugin::instance()->widgets_manager->register(new \Themephi_Elementor_Heading_Widget());
        }

		//Animated Hheading Setting
		if( isset( $tpelements_addon_setting['tp_animated_heading_setting'] ) == 'tpelement_animated_heading' ) {
			require_once( __DIR__ . '/widgets/animated-heading/animated-heading.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Animated_Heading_Widget() );
		}

        if( isset( $tpelements_addon_setting['tp_blockquote_setting'] ) == 'tpelement_blockquote' ) {
		require_once( __DIR__ . '/widgets/blockquote/blockquote.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Blockquote_Widget() );
        }
		

		//Image Showcase
		if( isset( $tpelements_addon_setting['tp_image_showcase_setting'] ) == 'tpelement_image_showcase' ) {
		require_once( __DIR__ . '/widgets/image-widget/image.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Image_Showcase_Widget() );		
		}

		//Counter
		if( isset( $tpelements_addon_setting['tp_counter_setting'] ) == 'tpelement_counter' ){
			require_once( __DIR__ . '/widgets/counter/tp-counter.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Counter_Widget() );
		}
		
		//Video
		if( isset( $tpelements_addon_setting['tp_video_setting'] ) == 'tpelement_video' ) {
			require_once( __DIR__ . '/widgets/video/tp-video.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Video_Widget() );
		}

		//pricing table
		if( isset( $tpelements_addon_setting['tp_pricing_table_setting'] ) == 'tpelement_pricing_table' ) {
			require_once( __DIR__ . '/widgets/pricing-table/pricing-table.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pricing_Table_Widget() );
		}

		//Button
		if( isset( $tpelements_addon_setting['tp_button_setting'] ) == 'tpelement_button' ) {
			require_once( __DIR__ . '/widgets/button/button.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Button_Widget() );
		}

		//Logo Showcase
        if( isset( $tpelements_addon_setting['tp_logo_showcase_setting'] ) == 'tpelement_logo_showcase' ){
		require_once( __DIR__ . '/widgets/logo-widget/logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Logo_Showcase_Widget() );
		}

		//CTA
		if( isset( $tpelements_addon_setting['tp_cta_setting'] ) == 'tpelement_cta' ) {				
			require_once( __DIR__ . '/widgets/cta/cta.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_CTA_Widget() );
		}

		//Flip Box 
		// if( isset( $tpelements_addon_setting['tp_flip_box_setting'] ) == 'tpelement_flip_box' ) {
		// 	require_once( __DIR__ . '/widgets/flip-box/flip-box.php' );
		// 	\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Flip_Box_Widget() );
		// }
		
		//Advance Tab
        if( isset( $tpelements_addon_setting['tp_advance_tab_setting'] ) == 'tpelement_advance_tab' ) {
		require_once( __DIR__ . '/widgets/advanced-tab/tab.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Advance_Tab_Widget() );
        }

        //Icon Box
        if( isset( $tpelements_addon_setting['tp_icon_box_setting'] ) == 'tpelement_icon_box' ){
		require_once( __DIR__ . '/widgets/iconbox/tp-iconbox.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Icon_Box_Widget() );	
		}

		//Blog Grid
        if( isset( $tpelements_addon_setting['tp_blog_grid_setting'] ) == 'tpelement_blog_grid' ){
			require_once( __DIR__ . '/widgets/blog-grid/blog-grid-widget.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Blog_Grid_Widget () );
		}

		//Contact Form 7
		if( isset( $tpelements_addon_setting['tp_contact_form_7_setting'] ) == 'tpelement_contact_form_7' ) {
			require_once( __DIR__ . '/widgets/cf7/contact-cf7.php' );
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_CF7_Widget() );
		}

		//Progress Bar
		if( isset( $tpelements_addon_setting['tp_progress_bar_setting'] ) == 'tpelement_progress_bar' ) {
			require_once( __DIR__ . '/widgets/progress/tp-progress.php' );	
			\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Progress_Widget() );	
		}
		// Iconbox Top
		// if( isset( $tpelements_addon_setting['tp_icon_bar_setting'] ) == 'tpelement_icon_bar' ) {
		// 	require_once( __DIR__ . '/widgets/header-footer/topbar-icon.php' );
		// 	\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Topbar_Icon_Bar_Widget() );
		// }

		// Contact Box
		if( isset( $tpelements_addon_setting['tp_real_contactbox_setting'] ) == 'tpelement_real_contactbox' ) {
		require_once( __DIR__ . '/widgets/contact-box/contact-box.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pro_Contactbox_Grid_Widget() );
		}

		//Progress Pie
		if( isset( $tpelements_addon_setting['tp_progress_pie_setting'] ) == 'tpelement_progress_pie' ) {
		require_once( __DIR__ . '/widgets/progress-pie/progress-pie.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Progress_Pie_Widget() );		
		}

		//business hour
		if( isset( $tpelements_addon_setting['tp_business_hour_setting'] ) == 'tpelement_business_hour_box' ){
		require_once( __DIR__ . '/widgets/business-hour/tp-hour.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Business_Hour_Widget() );
		}

		//image hover effect
		if( isset( $tpelements_addon_setting['tp_image_hover_effect_setting'] ) == 'tpelement_image_hover_effect' ){
		require_once( __DIR__ . '/widgets/image-hover-widget/image-hover-effect.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Image_Hover_Effect_Widget() );
		}

		//features list
		if( isset( $tpelements_addon_setting['tp_features_list_setting'] ) == 'tpelement_features_list' ){
		require_once( __DIR__ . '/widgets/feature-list/feature-list.php' );	
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Features_List_Widget() );
		}

		//Newsletter
        if( isset( $tpelements_addon_setting['tp_newsletter_setting'] ) == 'tpelement_newsletter' ){
		require_once( __DIR__ . '/widgets/mailchimp/mailchimp.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Mailchimp_Widget() );
		}

		//Marquee
        if( isset( $tpelements_addon_setting['tp_marquee_setting'] ) == 'tpelement_marquee' ){
		require_once( __DIR__ . '/widgets/marquee/marquee.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Pro_Marquee_Widget() );
		}

		//Line Draw
        if( isset( $tpelements_addon_setting['tp_linedraw_setting'] ) == 'tpelement_linedraw' ){
		require_once( __DIR__ . '/widgets/line-draw/line-draw.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_pro_Line_Draw_Widget() );	
		}

		//Timeline
        if( isset( $tpelements_addon_setting['tp_timeline_setting'] ) == 'tpelement_timeline' ){
		require_once( __DIR__ . '/widgets/timeline/timeline.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Timeline_Showcase_Widget() );
		}

		//Feature Image
        if( isset( $tpelements_addon_setting['tp_featured_image_setting'] ) == 'tpelement_featured_image' ){
		require_once( __DIR__ . '/widgets/featured-image/image.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Featured_Image_Showcase_Widget() );
		}
	
		//Site Logo
        if( isset( $tpelements_addon_setting['tp_site_logo_setting'] ) == 'tpelement_site_logo' ){
		require_once( __DIR__ . '/widgets/header-footer/site-logo.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Site_Logo() );	

		}
			
		//Site Search
        if( isset( $tpelements_addon_setting['tp_site_search_setting'] ) == 'tpelement_site_search' ){
		require_once( __DIR__ . '/widgets/header-footer/site-search.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Search_Button() );	

		}

		//Site Canvas
        if( isset( $tpelements_addon_setting['tp_site_canvas_setting'] ) == 'tpelement_site_canvas' ){
		require_once( __DIR__ . '/widgets/header-footer/site-canvas.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Offcanvas() );	

		}

		//Offcanvas Menu New Masum
		require_once( __DIR__ . '/widgets/header-footer/offcanvas.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Offcanvas_Menu() );	


		//Site Navigation
        if( isset( $tpelements_addon_setting['tp_site_navigation_setting'] ) == 'tpelement_site_navigation' ){
		require_once( __DIR__ . '/widgets/header-footer/site-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Navigation_Menu() );	

		}

		//Scroll To Top
        if( isset( $tpelements_addon_setting['tp_scroll_to_top_setting'] ) == 'tpelement_scroll_to_top' ){
		require_once( __DIR__ . '/widgets/header-footer/scroll-to-top.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Scroll_To_Top_Widget() );	

		}

		//Single Page Navigation
        if( isset( $tpelements_addon_setting['tp_single_navigation_setting'] ) == 'tpelement_single_navigation' ){
		require_once( __DIR__ . '/widgets/header-footer/single-page-nav.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Single_Navigation_Menu() );	

		}

		//Copyright
        if( isset( $tpelements_addon_setting['tp_copyright_setting'] ) == 'tpelement_copyright' ){
		require_once( __DIR__ . '/widgets/header-footer/copyright.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Copyright_Widget() );

		}

		//Cart
        if( isset( $tpelements_addon_setting['tp_cart_setting'] ) == 'tpelement_cart' ){
		require_once( __DIR__ . '/widgets/woocommerce/cart.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Product_Cart() );

		}

		// require_once( __DIR__ . '/widgets/search/site-search.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Site_Search_Button() );

        // require_once( __DIR__ . '/widgets/dual-button/dual-button.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Dual_Button_Widget() );
        
        require_once( __DIR__ . '/widgets/dual-heading/dual-heading.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Heading_Dual_Widget() );
        
        // require_once( __DIR__ . '/widgets/event-grid/event-grid-widget.php' );
		// \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_Events_Grid_Widget() );
        
        require_once( __DIR__ . '/widgets/gallery/gallery-widget.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_pro_Gallery_Widget() );
        
        require_once( __DIR__ . '/widgets/instagram/instagram.php' );
		\Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Instagram_Widget() );

        //Site Navigation
        // require_once( __DIR__ . '/widgets/site-navigation/site-nav.php' );
        // \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Navigation_Menu() );
        
        require_once( __DIR__ . '/widgets/table/table.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Pro_Table_Elementor_Widget() );


        require_once( __DIR__ . '/widgets/accordion-two/accordion-two.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Widget_Accordion_Two() );


        require_once( __DIR__ . '/widgets/icon/tp-icon.php' );
        \Elementor\Plugin::instance()->widgets_manager->register( new \Themephi_Elementor_icon_Widget() );
        

			
		// Register widget				
		add_action( 'elementor/elements/categories_registered', [$this, 'add_category'] );
        add_action( 'elementor/elements/categories_registered', [$this, 'resgister_tpaddon_category'] );
		add_action( 'elementor/elements/categories_registered', [$this, 'resgister_header_footer_category'] );
		
	}
}
TPelements_Elementor_Extension::instance();