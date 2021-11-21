<?php
/*
Template Name: Services
*/
?>
<?php get_header(); ?>
<?php 
$hide_title = tones_title_display();

if ($hide_title == 'true') {
	$classes = 'clearfix no-title';
} else {
	$classes = 'clearfix';
}

if(get_query_var('s')!=''){			
		$filter = get_query_var('s');
		$args['s']=$filter;
		$selected=$filter;	
}
$args_all = array(
	'post_type' => 'services',
	'orderby' => array( 'title' => 'ASC' ),
	'posts_per_page' => -1,
);

//fancy search plugin
if ($args['s'] != ''){
	$args = array(
		'post_type' => 'services',
		'orderby' => array( 'title' => 'ASC' ),
		'posts_per_page' => -1,
		's' => $_POST['keyword']
	);
	$args['services-category']=$postcats;
	$the_query = new WP_Query( $args );	

	relevanssi_do_query($the_query);
	// print_r($the_query);		
} else {
	$the_query = new WP_Query( $args );	
}

	$the_query_all = new WP_Query( $args_all );	

	if ($the_query_all->have_posts()) :
    $selected = '';
    $menu = '';
		$first_letter = null;

    $letters = array(
      'A' => false,
      'B' => false,
      'C' => false,
      'D' => false,
      'E' => false,
      'F' => false,
      'G' => false,
      'H' => false,
      'I' => false,
      'J' => false,
      'K' => false,
      'L' => false,
      'M' => false,
      'N' => false,
      'O' => false,
      'P' => false,
      'Q' => false,
      'R' => false,
      'S' => false,
      'T' => false,
      'U' => false,
      'V' => false,
      'W' => false,
      'X' => false,
      'Y' => false,
      'Z' => false);

    while ($the_query_all->have_posts()) : $the_query_all->the_post();
      $flag = 0;
      if( $first_letter != substr( strtolower(get_the_title()), 0, 1 ) ) {
        $first_letter = substr( get_the_title(), 0, 1 );
        $letters[$first_letter] = true;
      }

		$menu = '<div class="services-filter filter-menu">';
			$menu.='<ul class="filter nav nav-pills">';

      $menu .= '<li><a href="'.get_the_permalink().'" '.($selected==$term->slug?'class="active"':'' ).' data-filter="all">All</a></li>'; 
      foreach ($letters as $letter => $found) {

        if ($found == true) {
          $menu .= '<li><a href="?selected='.$letter.'" '.($selected==$letter?'class="active"':'' ).' data-filter="'.$letter.'">'.$letter.'</a></li>';
        } else {
          $menu .= '<li class="disabled"><a href="?selected='.$letter.'" '.($selected==$letter?'class="active"':'' ).' data-filter="'.$letter.'">'.$letter.'</a></li>';
        }      
      }
				// if( $flag ) {
				//   $menu .= '<li><a href="?selected='.$letter.'" '.($selected==$letter?'class="active"':'' ).' data-filter="'.$letter.'">'.$letter.'</a></li>';
    //     }
			endwhile;
			$menu.='</ul>';					
										
		
		$menu .= '</div>';	

	endif;
	?>

			<div id="content" class="clearfix row">
			
				<div id="main" class="col-sm-12 clearfix" role="main">
			
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
						<header>
						<?php if ($hide_title == 'false') { ?>		
							<div class="page-header"><h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1></div>
						<?php } ?>
						</header> <!-- end article header -->
					
						<section class="post_content clearfix" itemprop="articleBody">
							<?php the_content(); ?>				
					<?php
						$args = array(
							'post_type' => 'services',
							'posts_per_page' => -1,
							'orderby' => array ('menu_order'=> 'ASC', 'title' => 'ASC')
							);
						if ($selected != ''){

							$args['services-category'] = $selected;	
						}

					$the_query = new WP_Query( $args ); ?>
        
        <?php echo $menu; ?>

				<?php if ( $the_query->have_posts() ) : ?>
					<?php 
					$columns = 3;
					$i = 0; 

					$colnum = 12 / $columns; ?>

					<div class="section services-feed">
					<!-- the loop -->
						<div class="row services-list">
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>		
							<div class="col col-md-3 col-sm-<?php echo $colnum; ?> clearfix">
								<div class="inner ">
									<?php if ( get_post_meta(get_the_ID(),'services_icon', true) ) { ?>
									<?php $post_thumbnail = get_post_meta(get_the_ID(),'services_icon', true); ?>
									<?php } ?>
									<a href="<?php the_permalink(); ?>"></a>
									<div class="img-wrapper vertical-align-wrap">
										<div class="vertical-align">
											<img src="<?php echo $post_thumbnail; ?>" class="aligncenter img-responsive " />
										</div>
									</div>
									<h4><?php the_title(); ?></h4>
									<hr/>
									<p><?php echo substr(get_the_excerpt(), 0,50); ?></p>
								</div>
							</div>
									
							<?php $i++; ?>

						<?php endwhile; ?>

						 </div> <!--end .row .services-list -->
						<!-- end of the loop -->
						<?php wp_reset_postdata(); ?>
            			<?php if ( get_post_meta(get_the_ID(),'tones_icon', true) ) { ?>
            			<?php $post_thumbnail = get_post_meta(get_the_ID(),'tones_icon', true); ?>
            			<?php //$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' ); 
            			?>
            			<?php } ?>
					</div> <!--end .container .services -->
				</section> <!-- end article section -->
			
			</article> <!-- end article -->
				<?php else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>	
					
					<?php //comments_template('',true); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e("Not Found", "wpbootstrap"); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e("Sorry, but the requested resource was not found on this site.", "wpbootstrap"); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->
<?php get_footer(); ?>