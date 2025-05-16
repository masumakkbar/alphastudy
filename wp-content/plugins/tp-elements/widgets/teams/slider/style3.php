<div class="swiper-slide ">

    <div class="team-item">
        <div class="team-inner-wrap">
            <div class="image-wrap" >
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>  
            </div>	
            <div class="team-content">
                <h3 class="team-name"><a  href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                <?php if($short_bio): ?>
                <p class="team-desc"><?php echo esc_html($short_bio);?></p>
                <?php endif;
                if( $fb || $tw || $ins || $ldin ): ?>
                <div class="social-icons">
                    <?php echo wp_kses_post($fb);
                        echo wp_kses_post($tw);
                        echo wp_kses_post($ins);
                        echo wp_kses_post($ldin);
                    ?>
                </div>
                <?php endif; ?> 
            </div>					
        </div>
    </div>

</div>