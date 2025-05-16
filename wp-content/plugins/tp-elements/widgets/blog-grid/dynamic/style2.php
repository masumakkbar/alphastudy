<div class="grid-item col-xxl-<?php echo esc_attr( $settings['blog_col_xxl'] );?> col-xl-<?php echo esc_attr( $settings['blog_col_xl'] );?> col-lg-<?php echo esc_attr( $settings['blog_col_lg'] );?> col-md-<?php echo esc_attr( $settings['blog_col_md'] );?> col-sm-<?php echo esc_attr( $settings['blog_col_sm'] );?> col-<?php echo esc_attr( $settings['blog_col_xs'] );?> <?php echo esc_attr($termsString);?>">
    <div class="blog-item themephi-blog-grid1">
        <?php if($settings['blog_image'] == 'yes') :?>
        <div class="image-part">
            <a href="<?php the_permalink();?>">
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
            </a>
            <?php if(($settings['blog_cat_show_hide'] == 'yes') && ($settings['blog_category_position'] == 'image_area') ){ ?>
                <span class="meta_category">
                    <?php if(($settings['meta_cat_switch'] == 'yes') ){ ?>
                    <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['meta_category_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    </span>
                    <?php } ?>
                    <?php echo esc_html($category[0]->cat_name);?>
                </span>
            <?php } ?>
            <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>							
            <div class="blog-badge"> 
                <div class="date-2">
                    <span class="date"><?php echo get_the_date('d'); ?></span>
                    <span class="month"><?php echo get_the_date('M'); ?></span>
                </div>
                <div class="year">								
                    <?php echo get_the_date('Y'); ?>
                </div>
            </div>							
            <?php } ?>
        </div>
        <?php endif; ?>
        <div class="blog-content">  
            <div class="blog-content-top">
                <?php if( ($settings['blog_meta_show_hide'] == 'yes') && ($settings['blog_meta_position'] == 'before_title') ){ ?>
                <ul class="blog-meta">
                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                        <li>
                            <span class="meta_author">
                                <?php if(($settings['meta_avatar_switch'] == 'yes') ){ ?>
                                    <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_avatar_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                <?php } ?>
                                <?php echo esc_html__( 'By', 'tp-elements' ); ?> <?php echo esc_html($post_admin);?>
                            </span>
                        </li>
                    <?php } ?>

                    <?php if(($settings['blog_cat_show_hide'] == 'yes') && ($settings['blog_category_position'] == 'content_area') ){ ?>
                        <li>
                            <span class="meta_category meta-item">
                                <?php if(($settings['meta_cat_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_category_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html($category[0]->cat_name);?>
                            </span>
                        </li>
                    <?php } ?>

                    <?php if(($settings['reading_time_show_hide'] == 'yes') ){
                            
                        $the_content = get_the_content();
                        $words = str_word_count(strip_tags($the_content));
                        $minute = floor($words / 200); // Assuming 200 words per minute
                        $second = floor($words % 200 / (200 / 60)); // Seconds for the remainder
                        $estimate = $minute . ' Min' . ($minute === 1 ? '' : 's'); // Exclude seconds for simplicity
                        $reading_time = $estimate . ' ' . __('Read', 'tp-elements')
                        ?>
                        <li>
                            <span class="meta_readingtime meta-item">
                                <?php if(($settings['meta_reading_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_reading_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html($reading_time);?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                        <li>
                            <span class="meta_comments meta-item">
                                <?php if(($settings['meta_comment_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_comment_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['visitors_show_hide'] == 'yes') ){ ?>
                        <li>
                            <span class="meta_visitors meta-item">
                                <?php if(($settings['meta_visitor_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_visitor_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo tp_get_post_view(); ?>
                            </span> 
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>

                <h5 class="title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h5>

                <?php if( ($settings['blog_meta_show_hide'] == 'yes') && ($settings['blog_meta_position'] == 'after_title') ){ ?>
                <ul class="blog-meta">
                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                        <li>
                            <span class="meta_author">
                                <?php if(($settings['meta_avatar_switch'] == 'yes') ){ ?>
                                    <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_avatar_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                <?php } ?>
                                <?php echo esc_html__( 'By', 'tp-elements' ); ?> <?php echo esc_html($post_admin);?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['blog_cat_show_hide'] == 'yes') && ($settings['blog_category_position'] == 'content_area') ){ ?>
                        <li>
                            <span class="meta_category meta-item">
                                <?php if(($settings['meta_cat_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_category_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html($category[0]->cat_name);?>
                            </span>
                        </li>
                    <?php } ?>

                    <?php if(($settings['reading_time_show_hide'] == 'yes') ){
                            
                        $the_content = get_the_content();
                        $words = str_word_count(strip_tags($the_content));
                        $minute = floor($words / 200); // Assuming 200 words per minute
                        $second = floor($words % 200 / (200 / 60)); // Seconds for the remainder
                        $estimate = $minute . ' Min' . ($minute === 1 ? '' : 's'); // Exclude seconds for simplicity
                        $reading_time = $estimate . ' ' . __('Read', 'tp-elements')
                        ?>
                        <li>
                            <span class="meta_readingtime meta-item">
                                <?php if(($settings['meta_reading_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_reading_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html($reading_time);?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                        <li>
                            <span class="meta_comments meta-item">
                                <?php if(($settings['meta_comment_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_comment_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['visitors_show_hide'] == 'yes') ){ ?>
                        <li>
                            <span class="meta_visitors meta-item">
                                <?php if(($settings['meta_visitor_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_visitor_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo tp_get_post_view(); ?>
                            </span> 
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>

                <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                    <p class="txt"><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                <?php } ?>

                <?php if( ($settings['blog_meta_show_hide'] == 'yes') && ($settings['blog_meta_position'] == 'after_content') ){ ?>
                <ul class="blog-meta">
                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ){ ?>
                        <li>
                            <span class="meta_author">
                                <?php if(($settings['meta_avatar_switch'] == 'yes') ){ ?>
                                    <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_avatar_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                    </span>
                                <?php } ?>
                                <?php echo esc_html__( 'By', 'tp-elements' ); ?> <?php echo esc_html($post_admin);?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['blog_cat_show_hide'] == 'yes') && ($settings['blog_category_position'] == 'content_area') ){ ?>
                        <li>
                            <span class="meta_category meta-item">
                                <?php if(($settings['meta_cat_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_category_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html($category[0]->cat_name);?>
                            </span>
                        </li>
                    <?php } ?>

                    <?php if(($settings['reading_time_show_hide'] == 'yes') ){
                            
                        $the_content = get_the_content();
                        $words = str_word_count(strip_tags($the_content));
                        $minute = floor($words / 200); // Assuming 200 words per minute
                        $second = floor($words % 200 / (200 / 60)); // Seconds for the remainder
                        $estimate = $minute . ' Min' . ($minute === 1 ? '' : 's'); // Exclude seconds for simplicity
                        $reading_time = $estimate . ' ' . __('Read', 'tp-elements')
                        ?>
                        <li>
                            <span class="meta_readingtime meta-item">
                                <?php if(($settings['meta_reading_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_reading_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html($reading_time);?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                        <li>
                            <span class="meta_comments meta-item">
                                <?php if(($settings['meta_comment_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_comment_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?>
                            </span>
                        </li>
                    <?php } ?>
                    <?php if(($settings['visitors_show_hide'] == 'yes') ){ ?>
                        <li>
                            <span class="meta_visitors meta-item">
                                <?php if(($settings['meta_visitor_switch'] == 'yes') ){ ?>
                                <span class="icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $settings['meta_visitor_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
                                <?php } ?>
                                <?php echo tp_get_post_view(); ?>
                            </span> 
                        </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </div> 
            <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                <div class="btn-part">
                    <a class="readon-arrow" href="<?php the_permalink(); ?>">
                        <?php echo esc_html($settings['blog_btn_text']);?>
                        <?php if(($settings['blog_btn_switch'] == 'yes') ){ ?>
                            <span class="icon">
                            <?php \Elementor\Icons_Manager::render_icon( $settings['blog_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </span>
                        <?php } ?>
                    </a>
                </div>
            <?php } ?>
        </div>
    </div>
</div>