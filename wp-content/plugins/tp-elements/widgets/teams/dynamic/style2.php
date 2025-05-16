<div class="col-xxl-<?php echo esc_attr( $settings['team_col_xxl'] ); ?> col-xl-<?php echo esc_attr( $settings['team_col_xl'] ); ?> col-lg-<?php echo esc_attr($settings['team_col_lg']);?> col-md-<?php echo esc_attr( $settings['team_col_md'] ); ?> col-sm-<?php echo esc_attr( $settings['team_col_sm'] ); ?> col-<?php echo esc_attr( $settings['team_col_xs'] ); ?> grid-item <?php echo $termsString;?>">
    <div class="team-item">
        <div class="team-inner-wrap">
            <div class="image-wrap" >
                <a href="<?php the_permalink();?>">
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                </a>  
            </div>	
            <div class="team-content">
                <div class="team-head">
                    <h3 class="team-name"><a  href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                    <span class="team-title"><?php echo esc_html( $designation );?></span>
                    <?php if($short_bio): ?>
                    <p class="team-desc"><?php echo esc_html($short_bio);?></p>
                    <?php endif; ?>
                </div>	
                <?php if( $fb || $tw || $ins || $ldin ): ?>
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