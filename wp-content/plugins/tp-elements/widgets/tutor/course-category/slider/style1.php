<div class="swiper-slide ">
    <div class="course-category-item">
        <?php if(  $settings['course_image'] == 'yes' ) : ?>
        <div class="course-category-image">
            <a href="<?php echo esc_url( $category_link ); ?>"><img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_attr( $category->name );?>"></a>
        </div>
        <?php endif; ?> 
        <div class="course-category-content">
            <h4 class="title"><a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html($category->name);?></a></h4>
            <?php if(($settings['content_show_hide'] == 'yes') ){ ?>
            <p class="txt"><?php echo wp_trim_words( $category_description, $limit, '...' ); ?></p>
            <?php } ?>

            <?php if($settings['button_show_hide'] == 'yes') { ?>
            <div class="btn-part mt-15">
                <a class="readon-arrow" href="<?php echo esc_url( $category_link ); ?>">
                    <?php echo esc_html($settings['btn_text']);?> <i class="fa <?php echo esc_html( $settings['btn_icon'] );?>"></i>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>								
</div>