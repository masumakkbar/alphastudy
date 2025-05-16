<div  class="single--item">
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
    <div class="content-wrap">
        <div class="content--box">
            <?php if(!empty($customimage)):?>
            <div class="banner-image">
                <img class="banner-img" src="<?php echo esc_url($customimage); ?>" alt="image">
            </div>
            <?php endif;?>
            <div class="description">
                <?php if(!empty($custom_name)):?>
                    <h2 class="slider-title"><?php echo wp_kses_post($custom_name); ?></h2>
                <?php endif;?>
                <?php if(!empty($custom_designation)):?>
                    <p class="slider-subtitle"><?php echo wp_kses_post($custom_designation); ?></p>
                <?php endif;?>
                
            </div>            
        </div>
        
        <div class="ratting tp-el-star">
            <?php if( $custom_rating == '1' ) : ?>
            <i class="tp tp-star-sharp"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '1.5' ) : ?>
            <i class="tp tp-star-sharp"></i>
            <i class="tp tp-star-sharp-half"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '2' ) : ?>
            <i class="tp tp-star-sharp"></i>
            <i class="tp tp-star-sharp"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '2.5' ) : ?>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp-half"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '3' ) : ?>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '3.5' ) : ?>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp-half"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '4' ) : ?>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '4.5' ) : ?>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp-half"></i>
            <?php endif; ?>
            <?php if( $custom_rating == '5' ) : ?>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
                <i class="tp tp-star-sharp"></i>
            <?php endif; ?>
        </div>
        
    </div>
    <div class="review-body">
        <div class="desc">
            <?php echo wp_kses_post($custom_description); ?>
        </div>  
    </div>
    
</div>