<div class="swiper-slide" >
    <div class="container-item-wrapper blog-item-height" <?php if(has_post_thumbnail()): ?> style="background-image: url('<?php the_post_thumbnail_url();?>');" <?php endif;?>>
        <div class="container">

            <div class="blog-item position-relative blog-item-height">
                <div class="blog-content fullwidth-blog-content"> 
                    
                    <div class="blog-content-wrapp <?php if( $settings['enable_space_between_cat_content'] == 'yes' ) : ?> enable_space_between_cat_content <?php endif; ?>">
                        <div class="blog-content-top">
                        <?php if(($settings['blog_cat_show_hide'] == 'yes') && !empty($category ) ){ ?>
                            <span class="meta_category"><?php echo esc_html($category[0]->cat_name);?></span>
                        <?php } ?>
                        </div>
                        <div class="blog-content-bottom">
                            <h3 class="title dd"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
                            <?php if(($settings['blog_meta_show_hide'] == 'yes') ){ ?>
                            <ul class="blog-meta">
                                <?php if(( ($settings['blog_avatar_show_hide'] == 'yes') && !empty($post_admin) ) || ( $settings['blog_date_show_hide'] == 'yes' ) ){ ?>
                                <li>
                                    <?php if(($settings['blog_avatar_show_hide'] == 'yes') ){ ?>
                                    <span class="meta_author"><?php echo esc_html__( 'By', 'tp-elements' ); ?> <?php echo esc_html($post_admin);?> <?php echo esc_html__( '-', 'tp-elements' ); ?></span>
                                    <?php } ?>
                                    <?php if(($settings['blog_date_show_hide'] == 'yes') ){ ?>						
                                        <span class="meta_date"><?php echo esc_html( $full_date ); ?></span>					
                                    <?php } ?>
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
                                    <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_4238_1230)">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.85407 12.9565C4.93327 13.6776 6.20206 14.0625 7.5 14.0625C9.24049 14.0625 10.9097 13.3711 12.1404 12.1404C13.3711 10.9097 14.0625 9.24049 14.0625 7.5C14.0625 6.20206 13.6776 4.93327 12.9565 3.85407C12.2354 2.77488 11.2105 1.93374 10.0114 1.43704C8.81222 0.940343 7.49272 0.810384 6.21972 1.0636C4.94672 1.31682 3.7774 1.94183 2.85961 2.85961C1.94183 3.7774 1.31682 4.94672 1.0636 6.21972C0.810384 7.49272 0.940343 8.81222 1.43704 10.0114C1.93374 11.2105 2.77488 12.2354 3.85407 12.9565ZM4.37492 2.82299C5.29995 2.2049 6.38748 1.875 7.5 1.875C8.99185 1.875 10.4226 2.46764 11.4775 3.52253C12.5324 4.57742 13.125 6.00816 13.125 7.5C13.125 8.61252 12.7951 9.70006 12.177 10.6251C11.5589 11.5501 10.6804 12.2711 9.6526 12.6968C8.62476 13.1226 7.49376 13.234 6.40262 13.0169C5.31148 12.7999 4.3092 12.2641 3.52253 11.4775C2.73586 10.6908 2.20013 9.68853 1.98309 8.59739C1.76604 7.50624 1.87744 6.37524 2.30318 5.34741C2.72892 4.31957 3.44989 3.44107 4.37492 2.82299ZM7.03125 7.69219L9.65156 10.3125L10.3125 9.65156L7.96875 7.30312V3.28125H7.03125V7.69219Z" fill="#1E1E1E" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_4238_1230">
                                                <rect width="15" height="15" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    <span class="meta_readingtime"><?php echo esc_html($reading_time);?></span>
                                </li>
                                <?php } ?>
                                <?php if(($settings['blog_comments_show_hide'] == 'yes') && !empty($comment_ccount ) ){ ?>
                                <li><i class="tp tp-message"></i><span class="meta_comments"><?php echo esc_html( $comment_ccount )  . esc_html__( ' Comments', 'tp-elements' );?></span></li>
                                <?php } ?>
                                <?php if(($settings['visitors_show_hide'] == 'yes') ){ ?>
                                <li>
                                    <span class="meta_visitors">
                                        <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <rect y="4.17773" width="1.85714" height="8.35714" fill="#1E1E1E" />
                                            <rect x="11.1426" y="6.96387" width="1.85714" height="5.57143" fill="#1E1E1E" />
                                            <rect x="5.57227" y="0.463867" width="1.85714" height="12.0714" fill="#1E1E1E" />
                                        </svg>
                                        <span><?php echo tp_get_post_view(); ?></span> 
                                    </span>
                                </li>
                                <?php } ?>
                            </ul>
                            <?php } ?>
                            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
                            <p class="txt mt-15 "><?php echo wp_trim_words( get_the_content(), $limit, '...' ); ?></p>
                            <?php } ?>
                            <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
                            <div class="btn-part mt-15">
                                <a class="readon-arrow" href="<?php the_permalink(); ?>">
                                    <?php echo esc_html($settings['blog_btn_text']);?> <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                                </a>
                            </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>