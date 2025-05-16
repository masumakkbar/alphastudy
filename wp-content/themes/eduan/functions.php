<?php

if ( ! function_exists( 'tp_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */ 

function tp_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on eduan, use a find and replace
	 * to change 'eduan' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'eduan', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );	
	add_theme_support( 'woocommerce' );	

	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	function tp_change_excerpt( $text )
	{
		$pos = strrpos( $text, '[');
		if ($pos === false)
		{
			return $text;
		}
		
		return rtrim (substr($text, 0, $pos) ) . '...';
	}
	add_filter('get_the_excerpt', 'tp_change_excerpt');


	// Limit Excerpt Length by number of Words
	function tp_custom_excerpt( $limit ) {
		$excerpt = explode(' ', get_the_excerpt(), $limit);
		if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt).'...';
		} else {
		$excerpt = implode(" ",$excerpt);
		}
		$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
		return $excerpt;
		}
		function content($limit) {
		$content = explode(' ', get_the_content(), $limit);
		if (count($content)>=$limit) {
		array_pop($content);
		$content = implode(" ",$content).'...';
		} else {
		$content = implode(" ",$content);
		}
		$content = preg_replace('/[.+]/','', $content);
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		return $content;
	}

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary Menu', 'eduan' ),		
		'menu-2' => esc_html__( 'Single Menu', 'eduan' ),
		
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'tp_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 250,
		'width'       => 250,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	//add support posts format
	add_theme_support( 'post-formats', array( 
		'aside', 
		'gallery',
		'audio',
		'video',
		'image',
		'quote',
		'link',
	) );

	add_theme_support( 'align-wide' );	

	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );

}
endif;
add_action( 'after_setup_theme', 'tp_theme_setup' );

function my_theme_register_block_patterns() {
    register_block_pattern( 'my-theme/my-pattern', array(
        'title'       => __( 'My Pattern', 'eduan' ),
        'description' => _x( 'A custom pattern for my theme.', 'Block pattern description', 'eduan' ),
        'content'     => "<!-- wp:paragraph --><p>" . __( 'Hello world!', 'eduan' ) . "</p><!-- /wp:paragraph -->",
    ));
}
add_action( 'init', 'my_theme_register_block_patterns' );

function my_theme_register_block_styles() {
    register_block_style( 'core/quote', array(
        'name'  => 'fancy-quote',
        'label' => __( 'Fancy Quote', 'eduan' ),
    ));
}
add_action( 'init', 'my_theme_register_block_styles' );

/**
*Custom Image Size
*/
add_image_size( 'blog-slider-imgsize', 420, 365, true );
add_image_size( 'blog-sideabr-imgsize', 87, 87, true );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function tp_theme_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'tp_theme_content_width', 640 );
}
add_action( 'after_setup_theme', 'tp_theme_content_width', 0 );

/**
 * Implement the Custom Header feature.
 */
require_once get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 *  Enqueue scripts and styles.
 */
require_once get_template_directory() . '/inc/theme-scripts.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/theme-functions.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once get_template_directory() . '/inc/theme-sidebar.php';

/**
 * Customizer additions.
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Custom Style
 */
require_once get_template_directory() . '/inc/dyanamic-css.php';
require_once get_template_directory() . '/libs/theme-option/config.php';
require_once get_template_directory() . '/inc/tgm/tgm-config.php';


//----------------------------------------------------------------------
// Remove Redux Framework NewsFlash
//----------------------------------------------------------------------
if ( ! class_exists( 'reduxNewsflash' ) ):
    class reduxNewsflash {
        public function __construct( $parent, $params ) {}
    }
endif;

function tp_remove_demo_mode_link() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'tp_remove_demo_mode_link');

/**
 * Registers an editor stylesheet for the theme.
 */
function tp_theme_add_editor_styles() {
    add_editor_style( 'css/custom-editor-style.css' );
}
add_action( 'admin_init', 'tp_theme_add_editor_styles' );


//------------------------------------------------------------------------
//Organize Comments form field
//-----------------------------------------------------------------------
function tp_wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'tp_wpb_move_comment_field_to_bottom' );	


//adding placeholder text for comment form

function tp_comment_textarea_placeholder( $args ) {
	$args['comment_field']        = str_replace( '<textarea', '<textarea placeholder="Comment"', $args['comment_field'] );
	return $args;
}
add_filter( 'comment_form_defaults', 'tp_comment_textarea_placeholder' );

/**
 * Comment Form Fields Placeholder
 *
 */
function tp_comment_form_fields( $fields ) {
	foreach( $fields as &$field ) {
		$field = str_replace( 'id="author"', 'id="author" placeholder="Name*"', $field );
		$field = str_replace( 'id="email"', 'id="email" placeholder="Email*"', $field );
		$field = str_replace( 'id="url"', 'id="url" placeholder="Website"', $field );
	}
	return $fields;
}
add_filter( 'comment_form_default_fields', 'tp_comment_form_fields' );


//customize archive tilte
add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        }
    return $title;
});

add_filter( 'get_the_archive_title', 'tp_archive_title_remove_prefix' );
function tp_archive_title_remove_prefix( $title ) {
	if ( is_post_type_archive() ) {
		$title = post_type_archive_title( '', false );
	}
	return $title;
}

function tp_menu_add_description_to_menu($item_output, $item, $depth, $args) {

   if (strlen($item->description) > 0 ) {
      // append description after link
      $item_output .= sprintf('<span class="description">%s</span>', esc_html($item->description));   
     
   }   
   return $item_output;
}
add_filter('walker_nav_menu_start_el', 'tp_menu_add_description_to_menu', 10, 4);

add_filter('wp_list_categories', 'tp_cat_count_span');
function tp_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span>(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}

function tp_style_the_archive_count($links) {
    $links = str_replace('</a>&nbsp;(', '</a> <span class="archiveCount">(', $links);
    $links = str_replace(')', ')</span>', $links);
    return $links;
}

add_filter('get_archives_link', 'tp_style_the_archive_count');

/**
 * Post title array
 */
function tp_get_postTitleArray($postType = 'post' ){
    $post_type_query  = new WP_Query(
        array (
            'post_type'      => $postType,
            'posts_per_page' => -1,
            'orderby' => 'title',
    		'order'   => 'ASC',
        )
    );
    // we need the array of posts
    $posts_array      = $post_type_query->posts;
    // the key equals the ID, the value is the post_title
    if ( is_array($posts_array) ) {
        $post_title_array = wp_list_pluck($posts_array, 'post_title', 'ID' );
    } else {
        $post_title_array['default'] = esc_html__( 'Default', 'eduan' );
    }
    return $post_title_array;
}


/**
 * Remove WooCommerce breadcrumbs 
 */
add_action( 'init', 'my_remove_breadcrumbs' );
function my_remove_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
/**
 * Remove WooCommerce Actions 
 */
add_action( 'init', 'woo_remove_actions' );
function woo_remove_actions() {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
}



// start related post 

function example_cats_related_post() {

    $post_id = get_the_ID();
    $cat_ids = array();
    $categories = get_the_category( $post_id );

    if(!empty($categories) && !is_wp_error($categories)):
        foreach ($categories as $category):
            array_push($cat_ids, $category->term_id);
        endforeach;
    endif;

    $current_post_type = get_post_type($post_id);

    $query_args = array( 
        'category__in'   => $cat_ids,
        'post_type'      => $current_post_type,
        'post__not_in'    => array($post_id),
        'posts_per_page'  => '3',
     );

    $related_cats_post = new WP_Query( $query_args );

    if($related_cats_post->have_posts()):
         while($related_cats_post->have_posts()): $related_cats_post->the_post(); ?>
		<div class="col-xl-4">
			<div class="tp-related-single-item mb-40">
				<div class="tp-related-single-item-img">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail(); ?>
					</a>
				</div>
				<div class="tp-related-single-item-content">
					<div class="tp-related-single-item-meta">
						<span class="tp-related-single-item-meta-author"><?php echo get_avatar(get_the_author_meta('ID'), 22); ?>
						<?php the_author_posts_link(); ?></span>
						<span class="tp-related-single-item-meta-date"><i class="tp tp-calendar-days"></i><?php echo get_the_date(); ?></span>
						<span class="tp-related-single-item-meta-comment"><i class="tp tp-message"></i><?php comments_number('No Comments', '1 Comment', '% Comments'); ?> </span>
					</div>
					<h4 class="tp-related-single-item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="tp-related-btn">
						<a href="<?php the_permalink(); ?>"><?php echo esc_html__('View Details', 'eduan'); ?> <i class="tp tp-arrow-up-right"></i></a>
					</div>
				</div>
			</div>
		</div>
        <?php endwhile;

        // Restore original Post Data
        wp_reset_postdata();
     endif;

}


/* Post Category Image */

// Add image upload field to category edit screen
function add_category_image_field($taxonomy) {
    ?>
    <div class="form-field term-group">
        <label for="category-image-id"><?php _e('Category Image', 'eduan'); ?></label>
        <input type="hidden" id="category-image-id" name="category-image-id" value="">
        <div id="category-image-wrapper"></div>
        <button type="button" class="button category-image-upload"><?php _e('Add Image', 'eduan'); ?></button>
        <button type="button" class="button category-image-remove"><?php _e('Remove Image', 'eduan'); ?></button>
    </div>
    <?php
}
add_action('category_add_form_fields', 'add_category_image_field', 10, 2);

// Save category image
function save_category_image($term_id, $tt_id) {
    if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
        add_term_meta($term_id, 'category-image-id', absint($_POST['category-image-id']), true);
    }
}
add_action('created_category', 'save_category_image', 10, 2);

// Edit category image field
function edit_category_image_field($term, $taxonomy) {
    $image_id = get_term_meta($term->term_id, 'category-image-id', true);
    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row">
            <label for="category-image-id"><?php _e('Category Image', 'eduan'); ?></label>
        </th>
        <td>
            <input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo esc_attr($image_id); ?>">
            <div id="category-image-wrapper">
                <?php if ($image_id) {
                    echo wp_get_attachment_image($image_id, 'thumbnail');
                } ?>
            </div>
            <button type="button" class="button category-image-upload"><?php _e('Add Image', 'eduan'); ?></button>
            <button type="button" class="button category-image-remove"><?php _e('Remove Image', 'eduan'); ?></button>
        </td>
    </tr>
    <?php
}
add_action('category_edit_form_fields', 'edit_category_image_field', 10, 2);

// Update category image
function update_category_image($term_id, $tt_id) {
    if (isset($_POST['category-image-id']) && '' !== $_POST['category-image-id']) {
        update_term_meta($term_id, 'category-image-id', absint($_POST['category-image-id']));
    } else {
        delete_term_meta($term_id, 'category-image-id');
    }
}
add_action('edited_category', 'update_category_image', 10, 2);

// Course Search
function enqueue_course_scripts() {
    wp_enqueue_script('course-search-js', get_template_directory_uri() . '/assets/js/course-search.js', array('jquery'), '1.0.0', true);

    wp_localize_script('course-search-js', 'tp_course_data', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('course_feedback_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_course_scripts');

// Course Search Ajax
function course_search_ajax() {
    // Verify nonce for security
    if (!isset($_GET['nonce']) || !wp_verify_nonce($_GET['nonce'], 'course_feedback_nonce')) {
        die('Permission denied!');
    }

    $search_query = isset($_GET['search_query']) ? sanitize_text_field($_GET['search_query']) : '';
    $category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : '';

    $args = array(
        'post_type'      => 'courses', // Ensure 'courses' is the correct post type for Tutor LMS
        'posts_per_page' => 5,         // Limit the number of results
        's'              => $search_query, // Search by title
        'post_status'    => 'publish', // Show only published courses
    );

    // Add taxonomy filter only if a category is selected
    if ($category) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'course-category', // Tutor LMS course category taxonomy
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul>';
        while ($query->have_posts()) {
            $query->the_post();
            echo '<li><a href="' . esc_url(get_permalink()) . '">' . esc_html(get_the_title()) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'No courses found.';
    }

    wp_reset_postdata();
    die();
}

add_action('wp_ajax_course_search_ajax', 'course_search_ajax');
add_action('wp_ajax_nopriv_course_search_ajax', 'course_search_ajax');


 

// Favourite icon for course Ajax Action
function handle_custom_toggle_wishlist() {
    // Make sure the user is logged in
    if (!is_user_logged_in()) {
        wp_send_json_error(array('message' => 'You must be logged in to add to wishlist.'));
        return;
    }

    // Get the course ID and action
    $course_id = isset($_POST['course_id']) ? intval($_POST['course_id']) : 0;
    $action = isset($_POST['wishlist_action']) ? sanitize_text_field($_POST['wishlist_action']) : '';

    // If no valid course ID or action, return error
    if (!$course_id || !in_array($action, ['add', 'remove'])) {
        wp_send_json_error(array('message' => 'Invalid data.'));
        return;
    }

    // User ID
    $user_id = get_current_user_id();

    // Get the user's wishlist (stored in user meta)
    $wishlist = get_user_meta($user_id, '_user_wishlist', true);
    if (!$wishlist) {
        $wishlist = array();
    }

    // Toggle the wishlist
    if ($action === 'add') {
        if (!in_array($course_id, $wishlist)) {
            $wishlist[] = $course_id; // Add to wishlist
            update_user_meta($user_id, '_user_wishlist', $wishlist);
            wp_send_json_success(); // Success response
        } else {
            wp_send_json_error(array('message' => 'Course already in wishlist.'));
        }
    } else if ($action === 'remove') {
        if (($key = array_search($course_id, $wishlist)) !== false) {
            unset($wishlist[$key]); // Remove from wishlist
            update_user_meta($user_id, '_user_wishlist', $wishlist);
            wp_send_json_success(); // Success response
        } else {
            wp_send_json_error(array('message' => 'Course not in wishlist.'));
        }
    }
}
add_action('wp_ajax_custom_toggle_wishlist', 'handle_custom_toggle_wishlist');


// Output Code
if (!function_exists('tp_elements_output_code')) {
    function tp_elements_output_code($code) {
        return $code;
    }
}