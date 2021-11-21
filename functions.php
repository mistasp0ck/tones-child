<?php

/************* Shortcodes ********************/

$social = get_stylesheet_directory() . "/includes/shortcodes/social.php";
if ( is_readable( $social ) ) require_once( $social );

$portfolio = get_stylesheet_directory() . "/includes/shortcodes/portfolio.php";
if ( is_readable( $portfolio ) ) require_once( $portfolio );

/************* Meta Boxes using CMB2 plugin ********************/

$portfolio = get_stylesheet_directory() . "/includes/meta-boxes/portfolio.php";
if ( is_readable( $portfolio ) ) require_once( $portfolio );

$homepage = get_stylesheet_directory() . "/includes/meta-boxes/homepage.php";
if ( is_readable( $homepage ) ) require_once( $homepage );

/************* Theme Options ********************/

$options = get_stylesheet_directory() . "/includes/theme-options/options-cmb.php";
if ( is_readable( $options ) ) require_once( $options );

function wpbs_admin_media() {
	global $post;

	// wp_enqueue_script('admin-scripts', get_stylesheet_directory() . '/library/dist/admin/js/admin-scripts.min.js', array('jquery'), '1.0' );
	// wp_enqueue_style( 'admin-styles', get_stylesheet_directory() . '/library/dist/admin/css/admin-styles.min.css' );

}

// Set content width
if ( ! isset( $content_width ) ) $content_width = '';

// 

// enqueue styles
if( !function_exists("wpbs_base_theme_styles") ) {  
    function wpbs_base_theme_styles() { 

      wp_enqueue_style('lightbox', get_template_directory_uri() . '/bower_components/lity/dist/lity.min.css', '1.6.5'); 

      wp_enqueue_style( 'google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700,800|Roboto+Mono', array(), '1.0', 'all' );

      // This is the compiled css file from SASS - this means you compile the SASS file locally and put it in the appropriate directory if you want to make any changes to the master bootstrap.css.
      // // For child themes
      wp_register_style( 'tones-style', get_stylesheet_directory_uri() . '/library/dist/css/styles.fbc55c40.min.css', array(), '1.0', 'all' );
      wp_enqueue_style( 'tones-style' );

    }
}
add_action( 'wp_enqueue_scripts', 'wpbs_base_theme_styles' );

// enqueue javascript
function wpbs_base_theme_js(){

  if ( !is_admin() ){
    if ( is_singular() AND comments_open() AND ( get_option( 'thread_comments' ) == 1) ) 
      wp_enqueue_script( 'comment-reply' );
  }

  wp_deregister_script( 'grunticon-loader');
  // Uncomment if using grunticon

  wp_enqueue_script('masonry', get_stylesheet_directory_uri() . '/bower_components/imagesloaded/imagesloaded.pkgd.min.js',array('jquery'), '4.0.0');

  wp_enqueue_script('imagesloaded', get_stylesheet_directory_uri() . '/bower_components/masonry/dist/masonry.pkgd.min.js',array('jquery'), '4.0.0');

  wp_enqueue_script('waypoints', get_stylesheet_directory_uri() . '/bower_components/waypoints/lib/jquery.waypoints.js',array('jquery'), '4.0.0');

  wp_enqueue_script('lightbox', get_template_directory_uri() . '/bower_components/lity/dist/lity.min.js', array('jquery'), '1.6.5', true);

  wp_register_script( 'tones-js', 
    get_stylesheet_directory_uri() . '/library/dist/js/scripts.c3c950a8.min.js',
    array('jquery'), 
    '1.2',
    true );

  wp_register_script( 'modernizr', 
    get_template_directory_uri() . '/bower_components/modernizer/modernizr.js', 
    array('jquery'), 
    '1.2' );
  wp_enqueue_script( 'tones-js' );

  $variables_array = array( 'templateUrl' => get_stylesheet_directory_uri(),'wpbs_base_ajax_url' => admin_url( 'admin-ajax.php' ),'wpbs_base_nonce' => wp_create_nonce( 'wpbs_base_nonce' ) );
  //after wp_enqueue_script
  wp_localize_script( 'tones-js', 'vars', $variables_array );

  wp_enqueue_script( 'modernizr' );

}

add_action( 'wp_enqueue_scripts', 'wpbs_base_theme_js' );

add_image_size( 'ts-porfolio-feed', 1200, '', true );

function create_posttype() {

      $labels = array(
      'name'               => _x( 'Snippets', 'post type general name', 'cullman' ),
      'singular_name'      => _x( 'Snippet', 'post type singular name', 'cullman' ),
      'menu_name'          => _x( 'Snippets', 'admin menu', 'cullman' ),
      'name_admin_bar'     => _x( 'Snippets', 'add new on admin bar', 'cullman' ),
      'add_new'            => _x( 'Add New', 'Member', 'cullman' ),
      'add_new_item'       => __( 'Add New Snippet', 'cullman' ),
      'new_item'           => __( 'New Snippet', 'cullman' ),
      'edit_item'          => __( 'Edit Snippet', 'cullman' ),
      'view_item'          => __( 'View Snippet', 'cullman' ),
      'all_items'          => __( 'All Snippets', 'cullman' ),
      'search_items'       => __( 'Search Snippets', 'cullman' ),
      'parent_item_colon'  => __( 'Parent Snippets:', 'cullman' ),
      'not_found'          => __( 'No Snippets found.', 'cullman' ),
      'not_found_in_trash' => __( 'No Snippets found in Trash.', 'cullman' )
    );

    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'cullman' ),
      'public'             => false,
      'publicly_queryable' => false,
      'show_ui'            => true,
      'menu_position'       => 5,
      'menu_icon'          => 'dashicons-clipboard', 
      // 'show_in_menu'       => true,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => false,    
      'query_var'          => true,
      'capability_type'    => 'page',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title', 'editor' )
    );

    register_post_type( 'snippet', $args ); 

    $labels = array(
      'name'                => _x( 'Work', 'Post Type General Name', 'text_case_studies' ),
      'singular_name'       => _x( 'Work', 'Post Type Singular Name', 'text_case_studies' ),
      'menu_name'           => __( 'Work', 'text_case_studies' ),
      'name_admin_bar'      => __( 'Work', 'text_case_studies' ),
      'parent_item_colon'   => __( 'Parent Item:', 'text_case_studies' ),
      'all_items'           => __( 'All Items', 'text_case_studies' ),
      'add_new_item'        => __( 'Add New Item', 'text_case_studies' ),
      'add_new'             => __( 'Add New', 'text_case_studies' ),
      'new_item'            => __( 'New Item', 'text_case_studies' ),
      'edit_item'           => __( 'Edit Item', 'text_case_studies' ),
      'update_item'         => __( 'Update Item', 'text_case_studies' ),
      'view_item'           => __( 'View Item', 'text_case_studies' ),
      'search_items'        => __( 'Search Item', 'text_case_studies' ),
      'not_found'           => __( 'Not found', 'text_case_studies' ),
      'not_found_in_trash'  => __( 'Not found in Trash', 'text_case_studies' ),
    );
    $args = array(
      'labels'             => $labels,
      'description'        => __( 'Description.', 'tonesbase' ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'menu_position'       => 5,
      'menu_icon'          => 'dashicons-images-alt2', 
      'show_in_menu'       => true,
      'show_in_admin_bar'   => true,
      'show_in_nav_menus'   => true,    
      'query_var'          => true,
      'rewrite'            => array( 'slug' => 'work' ),
      'capability_type'    => 'page',
      'has_archive'        => false,
      'hierarchical'       => false,
      'menu_position'      => null,
      'supports'           => array( 'title','editor', 'thumbnail', 'page-attributes','categories' )
      
    );
    register_post_type( 'portfolio', $args );

    $labels = array(
      'name'              => _x( 'Work Categories', 'taxonomy general name' ),
      'singular_name'     => _x( 'Work Category', 'taxonomy singular name' ),
      'menu_name'         => __( 'Categories' ),
    );

    register_taxonomy(
      'portfolio-category',
      'commercial',
      array(
        'labels' => $labels,
        'rewrite' => array( 'slug' => 'work-category' ),
        'hierarchical' => true,
      )
    );

    // $labels = array(
    //   'name'               => _x( 'Videos', 'post type general name', 'tonesbase' ),
    //   'singular_name'      => _x( 'Videos', 'post type singular name', 'tonesbase' ),
    //   'menu_name'          => _x( 'Videos', 'admin menu', 'tonesbase' ),
    //   'name_admin_bar'     => _x( 'Videos', 'add new on admin bar', 'tonesbase' ),
    //   'add_new'            => _x( 'Add New', 'Video', 'tonesbase' ),
    //   'add_new_item'       => __( 'Add New Video', 'tonesbase' ),
    //   'new_item'           => __( 'New Video', 'tonesbase' ),
    //   'edit_item'          => __( 'Edit Video', 'tonesbase' ),
    //   'view_item'          => __( 'View Video', 'tonesbase' ),
    //   'all_items'          => __( 'All Videos', 'tonesbase' ),
    //   'search_items'       => __( 'Search Videos', 'tonesbase' ),
    //   'parent_item_colon'  => __( 'Parent Videos:', 'tonesbase' ),
    //   'not_found'          => __( 'No Videos found.', 'tonesbase' ),
    //   'not_found_in_trash' => __( 'No Videos found in Trash.', 'tonesbase' )
    // );

    // $args = array(
    //   'labels'             => $labels,
    //   'description'        => __( 'Description.', 'tonesbase' ),
    //   'public'             => true,
    //   'publicly_queryable' => true,
    //   'show_ui'            => true,
    //   'menu_position'       => 5,
    //   'menu_icon'          => 'dashicons-format-video', 
    //   'show_in_menu'       => true,
    //   'show_in_admin_bar'   => true,
    //   'show_in_nav_menus'   => true,    
    //   'query_var'          => true,
    //   'capability_type'    => 'page',
    //   'has_archive'        => false,
    //   'hierarchical'       => false,
    //   'menu_position'      => null,
    //   'supports'           => array( 'title', 'thumbnail', 'page-attributes', 'excerpt', 'editor' )
    // );

    // register_post_type( 'video', $args );    
}

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter( 'use_widgets_block_editor', '__return_false' );

