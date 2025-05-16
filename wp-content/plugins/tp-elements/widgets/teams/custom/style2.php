<div class="team-item-custom ">
    <div class="team-item">
        <div class="team-inner-wrap">
            <div class="image-wrap">
                <?php if ( $settings['memeber_image']['url'] ) : ?>
                <a href="<?php echo esc_attr( $settings['details_url'] ?  $settings['details_url'] : '' ); ?>">
                    <img src="<?php echo esc_url($settings['memeber_image']['url']);?>"  alt="<?php echo esc_url($settings['memeber_image']['url']);?>" />
                </a>
                <?php endif; ?>
            </div>
            <div class="team-content">
                <div class="team-head">
                    <?php if( !empty( $settings['name'] ) ):?>
                    <h3 class="team-name"><a href="<?php echo esc_attr( $settings['details_url'] ?  $settings['details_url'] : '' ); ?>"><?php echo esc_html($settings['name']);?></a></h3>
                    <?php endif; ?>
                    
                    <?php if( !empty( $settings['designation'] ) ):?>
                    <span class="team-title"><?php echo esc_html( $settings['designation'] );?></span>
                    <?php endif; ?>

                    <?php if( !empty( $settings['bio'] ) ):?>
                    <p class="team-desc"><?php echo esc_html( $settings['bio'] );?></p>
                    <?php endif; ?>
                </div>
                <?php if ( !empty(is_array( $settings['social_icon_list'] )) ) : ?>
                <div class="social-icons">	
                    <?php foreach ( $settings['social_icon_list'] as $index => $item ) :
                        $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';                    
                        $link         = !empty($item['link']['URL']) ? $item['link']['URL'] : '';
                        $iconPick     = !empty($item['social_icon_pick']) ? $item['social_icon_pick']['value'] : '';
                    ?>
                    <a href="<?php echo esc_url($link);?>"  <?php echo wp_kses_post($target);?> class="social-icon">
                        <i class="<?php echo esc_html($iconPick); ?>"></i>
                    </a>			
                    <?php  endforeach; ?>   
                </div>	
                <?php endif; ?>	
            </div>					
        </div>
    </div>
</div>