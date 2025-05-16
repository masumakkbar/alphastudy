<div class="col-xxl-<?php echo esc_attr( $settings['dynamic_col_xxl'] );?> col-xl-<?php echo esc_attr( $settings['dynamic_col_xl'] );?> col-lg-<?php echo esc_attr( $settings['dynamic_col_lg'] );?> col-md-<?php echo esc_attr( $settings['dynamic_col_md'] );?> col-sm-<?php echo esc_attr( $settings['dynamic_col_sm'] );?> col-<?php echo esc_attr( $settings['dynamic_col_xs'] );?> grid-item ">
    <div class="course-category-item">
        <?php if(  $settings['course_image'] == 'yes' ) : ?>
        <div class="course-category-image">
            <a href="<?php echo esc_url( $category_link ); ?>"><img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_attr( $category->name );?>"></a>
        </div>
        <?php endif; ?> 
        <div class="course-category-content">
            <h4 class="title"><a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html($category->name);?></a></h4>
            <span class="tp-course-number"><?php echo esc_html( $course_count ); ?> <span><?php echo esc_html__(' + Courses', 'tp-elements'); ?></span></span>
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