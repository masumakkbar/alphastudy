<?php
/**
* Plugin Name: TP Framework
* Plugin URI: https://themephi.net/wp/WPmaster
* Description: Custom Framework plugin for page metabox
* Version: 1.0.0
* Author: Themephi
* Author URI: https://softivuslab.com/
*/

// don't load directly
if ( ! defined( 'ABSPATH' ) ) {
    die( 'You should not be here' );
}

/**
* Function when plugin is activated
*
* @param void
*
*/
//Including file that manages all template

//All Post type include here

$dir = plugin_dir_path( __FILE__ );
//For Common
require_once $dir .'/metaboxes/page-header.php';
require_once $dir .'/metaboxes/custom-metabox.php';
require_once $dir .'/metaboxes/cmb2/init.php';

/**
 * Implement widgets
 */
require_once $dir . '/widgets/post_recent_widget.php';
require_once $dir . '/widgets/contact.php';
require_once $dir . '/widgets/social-icon.php';
require_once $dir . '/widgets/product-categories.php';
require_once $dir . '/widgets/tp-posts-categories.php';
require_once $dir . '/widgets/tp-posts-tags.php';
require_once $dir . '/widgets/search_widget.php';
require_once $dir . '/widgets/bookinfo.php';

