<div class="swiper-slide tp-slide-item">
    <div class="item--wrap">
        <?php if(!empty($image)):?>
        <div class="item--img">
            <?php if( !empty($settings['selected_icon']) || !empty($settings['selected_image']['url'])){?>
            <div class="testimonial-quote-icon">
                <?php if(!empty($settings['selected_icon'])) : ?>
                    <?php \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                <?php endif; ?>
                <?php if(!empty($settings['selected_image'])) :?>
                    <img src="<?php echo esc_url( $settings['selected_image']['url'] );?>" alt="image"/>
                <?php endif;?>
            </div>	
            <?php }?>
            <img class="item-inner-img" src="<?php echo esc_url($image); ?>" alt="image">
        </div>
        <?php endif;?> 
        <div class="single--item">
            
            <div class="ratting tp-el-star">
                <?php if( $tp_rating == '1' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>1.0</span>
                <?php endif; ?>
                <?php if( $tp_rating == '1.5' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>1.5</span>
                <?php endif; ?>
                <?php if( $tp_rating == '2' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>2.0</span>
                <?php endif; ?>
                <?php if( $tp_rating == '2.5' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>2.5</span>
                <?php endif; ?>
                <?php if( $tp_rating == '3' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>3.0</span>
                <?php endif; ?>
                <?php if( $tp_rating == '3.5' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>3.5</span>
                <?php endif; ?>
                <?php if( $tp_rating == '4' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>4.0</span>
                <?php endif; ?>
                <?php if( $tp_rating == '4.5' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>4.5</span>
                <?php endif; ?>
                <?php if( $tp_rating == '5' ) : ?>
                    <span><i class="tp tp-star-sharp"></i>5.0</span>
                <?php endif; ?>
            </div>
            
            <div class="review-body">
                <div class="desc">
                <?php echo wp_kses_post($description); ?>
                </div>  
            </div>

            <div class="content--box">
                <div class="description">
                    <?php if(!empty($person_name)):?>
                        <h2 class="slider-title"><?php echo wp_kses_post($person_name); ?></h2>
                    <?php endif;?>
                    <?php if(!empty($person_designation)):?>
                        <p class="slider-subtitle"><?php echo wp_kses_post($person_designation); ?></p>
                    <?php endif;?>
                    
                </div>            
            </div>
        </div>
    </div>
</div>