<?php
function social_shortcode($atts){ 
ob_start();
  ?>
<ul class="social">
  <?php if (wpbs_get_option('wpbs_twitter') != '') { ?>
    <li class="twitter"><a href="<?php echo wpbs_get_option('wpbs_twitter'); ?>" target="_blank" rel="noreferrer"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
  <?php } ?>
  <?php if (wpbs_get_option('wpbs_facebook') != '') { ?>
    <li class="facebook"><a href="<?php echo wpbs_get_option('wpbs_facebook'); ?>" target="_blank" rel="noreferrer"><i class="fab fa-facebook-square" aria-hidden="true"></i></a></li>
  <?php } ?>
  <?php if (wpbs_get_option('wpbs_linkedin') != '') { ?>
    <li class="linkedin"><a href="<?php echo wpbs_get_option('wpbs_linkedin'); ?>" target="_blank" rel="noreferrer"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
  <?php } ?>
  <?php if (wpbs_get_option('wpbs_instagram') != '') { ?>
    <li class="google"><a href="<?php echo wpbs_get_option('wpbs_instagram'); ?>" target="_blank" rel="noreferrer"><i class="fab fa-instagram" aria-hidden="true"></i></a></li>
  <?php } ?>

  <?php if (wpbs_get_option('wpbs_youtube') != '') { ?>
    <li class="youtube"><a href="<?php echo wpbs_get_option('wpbs_youtube'); ?>" target="_blank" rel="noreferrer"><i class="fab fa-youtube-play" aria-hidden="true"></i></a></li>
  <?php } ?>  

  <?php if (wpbs_get_option('wpbs_github') != '') { ?>
    <li class="github"><a href="<?php echo wpbs_get_option('wpbs_github'); ?>" target="_blank" rel="noreferrer"><i class="fab fa-github" aria-hidden="true"></i></a></li>
  <?php } ?>             
</ul>

<?php
  return ob_get_clean();
}
add_shortcode('social', 'social_shortcode');