<?php
function social_shortcode($atts){ 
ob_start();
  ?>
<ul class="social">
  <?php if (tones_get_option('wpbs_twitter') != '') { ?>
    <li class="twitter"><a href="<?php echo tones_get_option('wpbs_twitter'); ?>" target="_blank" rel="noreferrer"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
  <?php } ?>
  <?php if (tones_get_option('wpbs_facebook') != '') { ?>
    <li class="facebook"><a href="<?php echo tones_get_option('wpbs_facebook'); ?>" target="_blank" rel="noreferrer"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
  <?php } ?>
  <?php if (tones_get_option('wpbs_linkedin') != '') { ?>
    <li class="linkedin"><a href="<?php echo tones_get_option('wpbs_linkedin'); ?>" target="_blank" rel="noreferrer"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
  <?php } ?>
  <?php if (tones_get_option('wpbs_instagram') != '') { ?>
    <li class="google"><a href="<?php echo tones_get_option('wpbs_instagram'); ?>" target="_blank" rel="noreferrer"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
  <?php } ?>

  <?php if (tones_get_option('wpbs_youtube') != '') { ?>
    <li class="youtube"><a href="<?php echo tones_get_option('wpbs_youtube'); ?>" target="_blank" rel="noreferrer"><i class="fa fa-youtube-play" aria-hidden="true"></i></a></li>
  <?php } ?>  

  <?php if (tones_get_option('wpbs_github') != '') { ?>
    <li class="github"><a href="<?php echo tones_get_option('wpbs_github'); ?>" target="_blank" rel="noreferrer"><i class="fa fa-github" aria-hidden="true"></i></a></li>
  <?php } ?>             
</ul>

<?php
  return ob_get_clean();
}
add_shortcode('social', 'social_shortcode');