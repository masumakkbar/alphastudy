<div class="swiper-slide ">
    <div class="team-item <?php echo esc_attr( $teacher['teacher_image_hover_effect'] ); ?>">
        <div class="team-inner-wrap">
            <div class="image-wrap" >
                
                <a href="<?php echo esc_url($teacher['teacher_details_url']['url']) ? esc_url($teacher['teacher_details_url']['url']) : ''; ?>">
                    <img src="<?php echo esc_url( $teacher['teacher_image']['url'] ); ?>" alt="<?php echo esc_attr( $teacher['teacher_name'] ); ?>">
                </a>

                <?php if ( !empty( $teacher['social_icon_teachers'] ) ) : ?>
                <div class="social-icons1">	
                    <?php foreach ($teacher['social_icon_teachers'] as $index => $social_icon ) :
                        $target       = !empty($social_icon['social_link']['is_external']) ? 'target=_blank' : '';                    
                        $link         = !empty($social_icon['social_link']['URL']) ? $social_icon['social_link']['URL'] : '';
                        $iconPick     = !empty($social_icon['social_icon']) ? $social_icon['social_icon']['value'] : '';
                    ?>
                    <a href="<?php echo esc_url($link);?>" <?php echo wp_kses_post($target); ?> class="social-icon">
                        <i class="<?php echo esc_html($iconPick); ?>"></i>
                    </a>			
                    <?php  endforeach; ?>   
                </div>	
                <?php endif; ?>	

            </div>	
            <div class="team-content">

                <?php if( !empty( $teacher['teacher_name'] ) ) : ?>
                <h3 class="team-name"><a href="<?php echo esc_url($teacher['teacher_details_url']['url']) ? esc_url($teacher['teacher_details_url']['url']) : ''; ?>"><?php echo esc_html( $teacher['teacher_name'] ); ?></a></h3>
                <?php endif; ?>
                <?php if( !empty( $teacher['teacher_designation'] ) ) : ?>
                <p class="team-designation"><?php echo esc_html( $teacher['teacher_designation'] ); ?></p>
                <?php endif; ?>

                <?php if( !empty( $teacher['techer_phone'] ) ) : ?>
                <p class="team-phone"><?php echo esc_html( $teacher['techer_phone'] ); ?></p>
                <?php endif; ?>

                <?php if( !empty( $teacher['teacher_email'] ) ) : ?>
                <p class="team-email"><?php echo esc_html( $teacher['teacher_email'] ); ?></p>
                <?php endif; ?>

                <?php if( !empty( $teacher['teacher_bio'] ) ) : ?>
                <p class="team-bio"><?php echo esc_html( $teacher['teacher_bio'] ); ?></p>
                <?php endif; ?>

            </div>					
        </div>
    </div>
</div>