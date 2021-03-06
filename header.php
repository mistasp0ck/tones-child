<!doctype html> 

<!--[if IEMobile 7 ]> <html <?php language_attributes(); ?>class="no-js iem7"> <![endif]-->
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="no-js ie8"> <![endif]-->
<!--[if (gte IE 9)|(gt IEMobile 7)|!(IEMobile)|!(IE)]><!--><html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
<?php 
$options = wpbs_get_page_options();
?>    
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title( '|', true, 'right' ); ?></title> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

  <!-- wordpress head functions -->
  <?php wp_head(); ?>
  <!-- end of wordpress head -->
  <!-- IE8 fallback moved below head to work properly. Added respond as well. Tested to work. -->
    <!-- media-queries.js (fallback) -->
  <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>     
  <![endif]-->

  <!-- html5.js -->
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->  
  
    <!-- respond.js -->
  <!--[if lt IE 9]>
            <script type='text/javascript' src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
  <![endif]-->  
</head>
<body <?php body_class($options['classes']); ?>>
<?php //do_action('after_body'); ?>
<div id="wrapper" class="no-expand">
  <?php $sidebar = false; ?>
  <?php if ($sidebar == true) { ?>
  	<div class="overlay"></div>
    <?php get_template_part ( 'templates/content', 'nav-sidebar' ) ?>
  <?php } else { ?> 
    <?php get_template_part ( 'templates/content', 'nav' ) ?>
  <?php } ?>
  <div class="container">
  <?php get_template_part ( 'templates/content', 'hero' ) ?>