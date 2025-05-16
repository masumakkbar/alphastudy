<?php 

global $tp_theme_option;
if(!empty($tp_theme_option['facebook']) || !empty($tp_theme_option['twitter']) || !empty($tp_theme_option['rss']) || !empty($tp_theme_option['pinterest']) || !empty($tp_theme_option['google']) || !empty($tp_theme_option['instagram']) || !empty($tp_theme_option['vimeo']) || !empty($tp_theme_option['tumblr']) ||  !empty($tp_theme_option['youtube'])){
?>

    <ul class="offcanvas_social">  
        <?php
        if(!empty($tp_theme_option['facebook'])) { ?>
        <li> 
        <a href="<?php echo esc_url($tp_theme_option['facebook'])?>" target="_blank"><span><i class="fa fa-facebook"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($tp_theme_option['twitter'])) { ?>
        <li> 
        <a href="<?php echo esc_url($tp_theme_option['twitter']);?> " target="_blank"><span><i class="fa fa-twitter"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($tp_theme_option['rss'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['rss']);?> " target="_blank"><span><i class="fa fa-rss"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($tp_theme_option['pinterest'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['pinterest']);?> " target="_blank"><span><i class="fa fa-pinterest-p"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($tp_theme_option['linkedin'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['linkedin']);?> " target="_blank"><span><i class="fa fa-linkedin"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($tp_theme_option['google'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['google']);?> " target="_blank"><span><i class="fa fa-google-plus-square"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($tp_theme_option['instagram'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['instagram']);?> " target="_blank"><span><i class="fa fa-instagram"></i></span></a> 
        </li>
        <?php } ?>
        <?php if(!empty($tp_theme_option['vimeo'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['vimeo'])?> " target="_blank"><span><i class="fa fa-vimeo"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($tp_theme_option['tumblr'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['tumblr'])?> " target="_blank"><span><i class="fa fa-tumblr"></i></span></a> 
        </li>
        <?php } ?>
        <?php if (!empty($tp_theme_option['youtube'])) { ?>
        <li> 
        <a href="<?php  echo esc_url($tp_theme_option['youtube'])?> " target="_blank"><span><i class="fa fa-youtube"></i></span></a> 
        </li>
        <?php } ?>     
    </ul>
<?php }

