<?php

add_action( 'cmb2_admin_init', 'wpbs__register_portfolio_metabox' );
/**
 * Hook in and add a metabox that only appears on most pages, 'page' to begin with, but feel free to add to any!
 */
if( !function_exists( "wpbs__register_portfolio_metabox" ) ) {  
    function wpbs__register_portfolio_metabox() {
      $prefix = 'portfolio_';

      /**
       * Metabox to be displayed on a single page ID
       */
      $tones_portfolio = new_cmb2_box( array(
        'id'           => $prefix . 'metabox',
        'title'        => __( 'Page Settings', 'cmb2' ),
        'object_types' => array( 'portfolio', ), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
        //'show_on'      => array( 'id' => array( 2, ) ), // Specific post IDs to display this metabox
        ) );

      $tones_portfolio->add_field( array(
        'name' => __( 'Logo for Title', 'cmb2' ),
        'desc' => __( 'add an image for the title', 'cmb2' ),
        'id'   => $prefix . 'title_image',
        'type' => 'file',
        // Optional:
        'options' => array(
            'url' => false, // Hide the text input for the url
            'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
            )
        ));

      $tones_portfolio->add_field( array(
        'name'    => 'Brand Overlay Color',
        'id'      => $prefix . 'colorpicker',
        'type'    => 'colorpicker',
        'default' => '#232323',
      ) );

      $group_field_id = $tones_portfolio->add_field( array(
        'id'          => 'gallery',
        'type'        => 'group',
        'description' => __( 'Image Gallery', 'cmb2' ),
            // 'repeatable'  => false, // use false if you want non-repeatable group
        'options'     => array(
                'group_title'   => __( 'Image {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
                'add_button'    => __( 'Add Another Image', 'cmb2' ),
                'remove_button' => __( 'Remove Image', 'cmb2' ),
                'sortable'      => true, // beta
                // 'closed'     => true, // true to have the groups closed by default
                ),
        ) );

        // Id's for group's fields only need to be unique for the group. Prefix is not needed.
      $tones_portfolio->add_group_field( $group_field_id, array(
        'name' => __( 'Thumbnail Image', 'cmb2' ),
        'id'   => $prefix . 'image',
        'type' => 'file',
            // Optional:
        'options' => array(
                'url' => false, // Hide the text input for the url
                'add_upload_file_text' => 'Add Image' // Change upload button text. Default: "Add or Upload File"
                )
            // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
        ) );

  }
}