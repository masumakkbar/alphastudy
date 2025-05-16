<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function tp_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'tp_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function tp_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'tp_pingback_header' );
/**  kses_allowed_html */
function tp_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'eduan': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'tp_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function tp_theme_fonts_url() {
    $font_url = '';
    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'eduan' ) ) {
        $font_url = 'https://fonts.googleapis.com/css2?' . urlencode('family=Roboto:wght@100;200;300;400;500;600;700;800;900&family=Sansita+Swashed:wght@300;400;500;600;700;800;900&display=swap');
    }
    return $font_url;
}

function tp_studio_scripts() { 
    wp_enqueue_style( 'eduan-fonts', tp_theme_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'tp_studio_scripts' );

// Favicon Icon
function tp_site_icon() {
    // Check if the site has a site icon set
    if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {
        global $tp_theme_option;

        // Check if a custom favicon is set
        if ( ! empty( $tp_theme_option['tp_favicon']['url'] ) ) { ?>
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url( $tp_theme_option['tp_favicon']['url'] ); ?>"> 
        <?php 
        }
    }
}
add_filter( 'wp_head', 'tp_site_icon' );



//excerpt for specific section
function tp_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'Read More', 'eduan' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'tp_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'tp_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  $post_id = $post->ID;
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  } 
  else { 
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';    
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }    
    else {     
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );      
      if ( $readmore ) {
        $output .= apply_filters( 'tp_wpex_readmore_link', $readmore_link );
      }
    }
  }
  // Apply filters and echo
  return apply_filters( 'tp_wpex_get_excerpt', $output );
}


// Total Visitor Counts 
function tp_get_post_view() {

  $count = get_post_meta( get_the_ID(), 'post_views_count', true );

  return "$count views";

}

function tp_set_post_view() {

  $key = 'post_views_count';

  $post_id = get_the_ID();

  $count = (int) get_post_meta( $post_id, $key, true );

  $count++;

  update_post_meta( $post_id, $key, $count );

}

function tp_posts_column_views( $columns ) {

  $columns['post_views'] = 'Views';

  return $columns;

}

function tp_posts_custom_column_views( $column ) {

  if ( $column === 'post_views') {

      echo tp_get_post_view();

  }

}

add_filter( 'manage_posts_columns', 'tp_posts_column_views' );

add_action( 'manage_posts_custom_column', 'tp_posts_custom_column_views' );



//Demo content file include here
function tp_import_files() {
  return array(
    array(
      'import_file_name'           => 'Eduan Demo',
      'categories'                 => array( 'Eduan Education' ),
      'import_file_url'            => 'https://eduan.themephi.net/source/demo-data/eduan-content.xml', 
             
      'import_redux'               => array(
        array(
          'file_url'               => 'https://eduan.themephi.net/source/demo-data/eduan-options.json',
          'option_name'            => 'tp_theme_option',
        ),
      ),

      'import_preview_image_url'   => 'https://eduan.themephi.net/wp-content/uploads/2025/04/screenshot.png',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'eduan' ),
      'preview_url'                => 'https://eduan.themephi.net',     
      
    ),

  );
}

add_filter( 'pt-ocdi/import_files', 'tp_import_files' );

function tp_after_import_setup($selected_import) {
  // Assign menus to their locations.
	$main_menu     = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
  $menu_single     = get_term_by( 'name', 'Onepage Menu', 'nav_menu' );
	set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id, 
      'menu-2' => $menu_single->term_id,      
    )
  );

  if ( 'Eduan Demo' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Eduan Education');
  }


  $blog_page_id  = get_page_by_title( 'News & Media' );
  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID ); 

  //Import Revolution Slider
  if ( class_exists( 'RevSlider' ) ) {
    $slider_array = array(

      get_template_directory()."/inc/demo-data/sliders/slider-2.zip",                       

    );
    $slider = new RevSlider();
    foreach($slider_array as $filepath){
      $slider->importSliderFromPost(true,true,$filepath);  
    }
  }
  
}
add_action( 'pt-ocdi/after_import', 'tp_after_import_setup' );

add_filter( 'use_widgets_block_editor', '__return_false' );


update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');
