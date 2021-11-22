</div> <!-- end .content -->

<?php if (get_post_meta(get_the_ID(), 'homepage_portfolio', true) == 'on') { ?>
<?php echo do_shortcode('[portfolio]'); ?>
<?php } ?>
<?php if (get_post_meta(get_the_ID(), 'homepage_below_full_width', true)) { ?>
<?php echo get_post_meta(get_the_ID(), 'homepage_below_full_width', true); ?>
<?php } ?>
<div class="container-fluid footer-wrapper">
	<div class="container">
			<footer role="contentinfo">
			
				<div id="inner-footer" class="clearfix">
		          <div id="widget-footer" class="clearfix row">
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer1') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer2') ) : ?>
		            <?php endif; ?>
		            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer3') ) : ?>
		            <?php endif; ?>
		          </div>
					
					<nav class="clearfix">
						<?php wpbs_footer_links(); // Adjust using Menus in Wordpress Admin ?>
						<?php echo do_shortcode('[social]'); ?>
					</nav>
			
					<p class="attribution">&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | Hosted by <a href="http://www.dreamhost.com/r.cgi?550674" title="Dreamhost">Dreamhost</a></p>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
	</div> <!-- end .container -->
</div> <!-- end .container-fluid -->	
				
		<!--[if lt IE 7 ]>
  			<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  			<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
		<![endif]-->
		
		<?php wp_footer(); // js scripts are inserted using this function ?>

	</body>

</html>