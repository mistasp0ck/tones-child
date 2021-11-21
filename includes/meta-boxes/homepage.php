<?php

add_action( 'cmb2_admin_init', 'wpbs__register_homepage_metabox' );
/**
 * Hook in and add a metabox that only appears on most pages, 'page' to begin with, but feel free to add to any!
 */
if( !function_exists( "wpbs__register_homepage_metabox" ) ) {  
    function wpbs__register_homepage_metabox() {
      $prefix = 'homepage_';

      /**
       * Metabox to be displayed on a single page ID
       */
      $tones_homepage = new_cmb2_box( array(
        'id'           => $prefix . 'metabox',
        'title'        => __( 'Page Settings', 'cmb2' ),
        'object_types' => array( 'page', ), // Post type
        'show_on'      => array( 'key' => 'page-template', 'value' => 'page-homepage.php' ),
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
        //'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
        ) );

      $tones_homepage->add_field( array(
        'name' => 'Show Portfolio?',
        'desc' => '',
        'id' => $prefix . 'portfolio',
        'type' => 'checkbox',
      ) );

      $tones_homepage->add_field( array(
        'name'    => 'Section below Full Width',
        // 'desc'    => 'field description (optional)',
        'id' => $prefix . 'below_full_width',
        'type'    => 'wysiwyg',
        'options' => array(),
      ) );

  }
}