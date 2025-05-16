<div class="swiper-slide ">

    <div class="team-item">
        <div class="team-inner-wrap">
            <div class="image-wrap" >
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a> 
                <?php if( $fb || $tw || $ins|| $ldin ): ?>
                <div class="team-social">
                    <div class="main">
                        <i class="tp tp-plus"></i>
                    </div>
                    <div class="team-social-one">
                            <?php echo $fb ;?>
                            <?php echo $tw ;?>
                            <?php echo $ins ;?>
                            <?php echo $ldin; ?>
                    </div>
                </div> 
                <?php endif; ?>
            </div>	
            <div class="team-content">
                <div class="member-desc">
                    <h3 class="team-name"><a  href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <?php if($designation): ?>
                    <span class="team-title"><?php echo esc_html($designation);?></span>
                    <?php endif; ?>
                </div>
            </div>					
        </div>
    </div>

</div>