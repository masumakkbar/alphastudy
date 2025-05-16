<div class="grid-item col-xxl-<?php echo esc_attr( $settings['dynamic_col_xxl'] );?> col-xl-<?php echo esc_attr( $settings['dynamic_col_xl'] );?> col-lg-<?php echo esc_attr( $settings['dynamic_col_lg'] );?> col-md-<?php echo esc_attr( $settings['dynamic_col_md'] );?> col-sm-<?php echo esc_attr( $settings['dynamic_col_sm'] );?> col-<?php echo esc_attr( $settings['dynamic_col_xs'] );?> <?php echo esc_attr($termsString);?>">

    <div class="tp-course-item">
        <?php if($settings['course_image'] == 'yes') :?>
        <div class="tp-course-image <?php echo $settings['image_gray'];?>">
            <a href="<?php echo esc_url( get_the_permalink() ); ?>"><img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"></a>
        </div>   
        <?php endif; ?>  

        <div class="tp-course-content">
            <div class="tp-course-content-top">
                <div class="tp-course-content-head">
                    <?php if(($settings['course_author_show_hide'] == 'yes') ){ ?>
                    <div class="tp-course-author">
                        <a href="<?php echo $profile_url; ?>"><?php echo tutor_utils()->get_tutor_avatar( $post->post_author ); ?></a> <a class="name" href="<?php echo $profile_url; ?>"> <?php esc_html_e( get_the_author() ); ?></a>
                    </div>
                    <?php } ?>
                </div>

                <h4 class="tp-course-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>
            </div>
            <div class="tp-course-content-bottom">
                <div class="tp-course-meta">
                    <?php if(($settings['course_lesson_show_hide'] == 'yes') && !empty($lesson_count ) ){ ?>
                    <div class="tp-meta-lesson tp-common-meta">
                        <?php if(($settings['meta_lesson_switch'] == 'yes') ){ ?>
                            <span class="icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['lesson_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                        <?php } ?>
                        <span class=""><?php echo esc_html( $lesson_count ); ?> <?php esc_html_e( '', 'tutor-lms-elementor-addons' ); ?></span>
                    </div>
                    <?php } ?>

                    <?php if(($settings['course_student_show_hide'] == 'yes') && !empty($course_students ) ){ ?>
                    <div class="tp-meta-student tp-common-meta">
                        <?php if(($settings['meta_student_switch'] == 'yes') ){ ?>
                            <span class="icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['student_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                        <?php } ?>
                        <span class=""><?php echo esc_html( $course_students ); ?><?php esc_html_e( '', 'tutor-lms-elementor-addons' ); ?></span>
                    </div>
                    <?php } ?>

                </div>
                <div class="tp-course-meta">

                    <?php if(($settings['course_price_show_hide'] == 'yes') ){ ?>
                        <?php if ( null != $price ) : ?>
                            <div class="tp-course-price tp-meta-price">
                                <?php echo tutor_kses_html( $price ); ?>
                            </div>
                        <?php else : ?>
                            <div class="tp-course-price-free tp-meta-price">
                                <?php echo esc_html_x( 'Free', 'course price', 'tutor-lms-elementor-addons' ); ?>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="tp-course-hover-content">
            <div class="tp-course-hover-content-top">
                <?php if(($settings['course_author_show_hide'] == 'yes') ){ ?>
                    <div class="tp-course-author">
                        <a href="<?php echo $profile_url; ?>"><?php echo tutor_utils()->get_tutor_avatar( $post->post_author ); ?></a> <a class="name" href="<?php echo $profile_url; ?>"> <?php esc_html_e( get_the_author() ); ?></a>
                    </div>
                <?php } ?>
            </div>

            <h4 class="tp-course-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>

            <?php if(($settings['content_show_hide'] == 'yes') ){ ?>
                <p class="tp-course-text"><?php echo wp_trim_words( $course_description, $limit, '...' ); ?></p>
            <?php } ?>

            <div class="tp-course-hover-content-btn">
                <div class="tp-course-hover-cart-btn">
                    <?php
                        $monitize_by     = tutor_utils()->get_option( 'monetize_by' );
                        $is_purchasable  = tutor_utils()->is_course_purchasable();
                        if ( 'edd' === $monitize_by && $is_purchasable ) {
                            ob_start();
                            tutor_load_template( 'single.course.add-to-cart-edd' );
                            echo apply_filters( 'tutor/course/single/entry-box/purchasable', ob_get_clean(), get_the_ID() );
                        } else {
                            tutor_course_loop_price();
                        }
                    ?>
                </div>
                <?php if(($settings['course_wishlist_show_hide'] == 'yes') ){ ?>
                    <div class="tp-meta-bookmark tp-common-meta">
                        <?php
                            echo '<span class="'. esc_attr( $action_class ) .' save-bookmark-btn" data-course-id="'. esc_attr( $course_id ) .'" role="button">
                                <i class="' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line') . '"></i>
                            </span>';
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>