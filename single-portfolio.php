<?php 
if (!tones_show_title()) {
	$classes = 'clearfix no-title';
	$hide_title = true;
} else {
	$classes = 'clearfix';
	$hide_title = false;
}
?>	
<?php get_header(); ?>
<?php
if ( function_exists('yoast_breadcrumb')) {
yoast_breadcrumb('<p id="breadcrumbs">','</p>');
}
?>
			<div id="content" class="clearfix row">
			
				<div id="main" class="col col-lg-10 col-md-offset-1 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?> role="article">
						
						<?php if ($hide_title != true) { ?>					
						<header>
							<?php if (get_post_meta(get_the_id(), 'portfolio_title_image', true)) {
								$title = wp_get_attachment_image_src(get_post_meta(get_the_id(), 'portfolio_title_image_id', true),'full-size');?>
								<div class="page-header image-title" style="background-image:url(<?php echo $title[0]; ?>)"><h1><?php the_title(); ?></h1></div>
							<?php } else { ?>
							<div class="page-header"><h1><?php the_title(); ?></h1></div>
							<?php }
							?>
							
						</header> <!-- end article header -->
						<?php } ?>	
					
						<section class="post_content">
							<?php the_content(); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">' . __("Tags","wpbootstrap") . ': ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
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