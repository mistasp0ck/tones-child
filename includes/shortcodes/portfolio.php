<?php


function tones_portfolio($atts){
global $wp_query;

	extract(shortcode_atts(array(
		'bg' => 'false',
		'columns' => 'offset',	
		'posts_per_page' => 5,
		'list_only' => false,
		'button_vis' => false,
		'button_url' => '',
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'post_type' => 'any',
		'title' => '',
		'categories' => '',			

	), $atts));

$args = array(
	'posts_per_page' => $posts_per_page,
	'post_type' => array('portfolio'),
	'order' => 'ASC',
	'orderby' => $orderby
	);

if ($categories != '') {
	$args['portfolio-category'] = $categories;

}
$prefix = 'portfolio';
ob_start();

// the query
$the_query = new WP_Query( $args ); 
error_log(print_r($args,true));

?>

<?php if ( $the_query->have_posts() ) : ?>

<div class="container-fluid force-full-width-wrapper portfolio-home" id="work">
<?php if ($bg == 'true') { ?>	
	<div class="force-full-width grey-bg"></div>
<? } else { ?>

<?php } ?>	
<?php if ($title != '') { ?>
	<h2 class="heading-med heading-blue"><?php echo $title ?></h2>
<?php } ?>
	<?php 
	$i = 0;

	if ($columns = 'offset') {
		$columns = 2;
		$colnum = 12 / $columns;
		$colnum = 7;
	} else {
		$colnum = 12 / $columns;
	}
	?>
	<!-- the loop -->
	<div class="portfolio-feed">
		<div class="no-gutter-grid-sizer"></div>
		<div class="no-gutter-gutter-sizer"></div>
	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>	
		<?php if(!($i % $columns) && $i > 0) {?>
	<!-- </div> --> <!--end .row .portfolio-feed -->
	<!-- <div class="row section portfolio-feed"> -->
		<?php } ?>
		<?php 
		if ($i == 4) {
			$colnum = 5;
		} ?>

		<?php if ( has_post_thumbnail() ) { ?>
		<?php $post_thumbnail_id = get_post_thumbnail_id(); ?>
		<?php $featured_img = wp_get_attachment_image( $post_thumbnail_id, 'ts-porfolio-feed','',
		array('class' => 'img-fluid' )); ?>
		<?php } ?>

		<!-- <div class="portfolio-entry col col-sm-<?php //echo $colnum; ?>" style="background-image: url('<?php //echo $featured_src[0]; ?>');"> -->

		<div class="portfolio-entry portfolio-entry-<?php echo $i; ?> col col-sm-<?php echo $colnum; ?>">
			<div class="portfolio-entry-inner">
					<?php echo $featured_img; ?>
					<?php if (get_post_meta(get_the_ID(), 'portfolio_colorpicker', true)) { ?>
					<div class="overlay" data-bg="<?php echo get_post_meta(get_the_ID(), 'portfolio_colorpicker', true); ?>">
					<?php } else { ?>	
					<div class="overlay">
					<?php } ?>
						<div class="content-wrapper">
							<div class="content-wrapper-inner">
								<h3><?php the_title(); ?></h3>
								<?php if (get_post_meta(get_the_ID(), $prefix.'position', true)) { ?>
								<h4><?php echo get_post_meta(get_the_ID(), $prefix.'position', true); ?></h4>
								<?php } ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="overlay-link"> </a>
							</div>
						</div>	
					</div>	
			</div>		
		</div>			
		<?php 
		if ($colnum == 7) {
			$colnum = 5;
		} else {
			$colnum = 7;		
		}
		 ?>
		<?php $i++; ?>
	<?php endwhile; ?>
	</div> <!--end .row .portfolio-feed -->

	<?php wp_reset_postdata(); ?>
	<?php if ($button_vis == 'true' && $button_url != '') { ?>
		<div class="row" style="margin-bottom: 54px;">
			<div class="col-sm-12" style="text-align:center">
				<a href="<?php echo $button_url; ?>" class="btn btn-primary btn-lg btn-blue-inv" style="margin-top: 20px;">View More</a>
			</div>
		</div>
	<?php } ?>	
	
</div>
<?php else : ?>
	<p><?php _e( 'Sorry, no entries found.' ); ?></p>
<?php endif; ?>	

<?php
	return ob_get_clean();
}
add_shortcode('portfolio', 'tones_portfolio');