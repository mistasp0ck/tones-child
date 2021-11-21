<?php 
$options = tones_get_page_options();
?>
<header role="banner">
    
  <div class="navbar navbar-default<?php echo $options['menuclasses']; ?>" data-spy="<?php echo $options['affix']; ?>" data-offset-top="46">
    <div class="container">
    
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>

        <a class="navbar-brand<?php echo $options['logo_class'] ?>" title="<?php echo get_bloginfo('description'); ?>" href="<?php echo home_url(); ?>"<?php echo $options['logo_styles'] ?>><?php bloginfo('name'); ?><?php echo $options['logo_affix']; ?></a>
      </div>

      <div id="nav-container" class="collapse navbar-collapse navbar-responsive-collapse">
        <?php wpbs__main_nav(); // Adjust using Menus in Wordpress Admin ?>

        <?php if( tones_get_option( 'wpbs_menu_search' ) == 'true') { ?>
          <!-- <div class="search-form"> -->
            <form class="<?php echo $options['form_class'] ?>" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
              
              <div class="<?php echo $options['form_group'] ?>">
                <input name="s" id="s" type="search" class="search-query form-control searchbox-input" autocomplete="off" placeholder="<?php _e('Search','wpbootstrap'); ?>">
                <?php echo $options['form_icon'] ?>
                <!-- <input type="submit" class="searchbox-submit" value="Search"> -->
                
              </div>
            </form><!-- <a href="" class="searchbox-icon fa fa-search">Search</a> -->
          <!-- </div> -->
        <?php } ?>
      </div>

    </div> <!-- end .container -->
  </div> <!-- end .navbar -->

</header> <!-- end header -->