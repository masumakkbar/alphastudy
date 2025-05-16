<?php
global $tp_theme_option;
?>
<div class="single-content-full">
    <?php if(!empty($tp_theme_option['blog-author-meta']) && $tp_theme_option['blog-author-meta'] == 'show') : ?>

    <div class="user-info">
        <!-- single info -->
        <div class="single-info">
            <span><?php echo esc_html__('By', 'eduan');?>  <?php if(!empty($tp_theme_option['blog-author-post'])){
                if ($tp_theme_option['blog-author-post'] == 'show'): ?>                                                                                         

                    <?php
                    
                    if( !empty($first_name) && !empty($last_name)){
                    echo esc_html($first_name).' '. esc_html($last_name);
                    }else{
                    echo get_the_author();
                }  ?>                                      
                
                <?php endif; }
                else{ ?>                                        
                
                <?php 
                
                if( !empty($first_name) && !empty($last_name)){
                    echo esc_html($first_name).' '. esc_html($last_name);
                }else{
                    echo get_the_author();
                } ?>
            
                <?php }; ?></span> 
                <?php if(!empty($tp_theme_option['blog-date'])) :?>
                    <span> - <?php echo get_the_date();?></span>
                <?php endif; ?>
        </div>
        <!-- single infoe end -->

        <!-- single info -->
        <div class="single-info">
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
            <span>
                <?php 
                $the_content = $post->post_content;
                $words = str_word_count(strip_tags($the_content));
                $minute = floor($words / 200); // Assuming 200 words per minute
                $second = floor($words % 200 / (200 / 60)); // Seconds for the remainder
                $estimate = $minute . ' Min' . ($minute === 1 ? '' : 's'); // Exclude seconds for simplicity
                echo esc_html($estimate . ' ' . __('Read', 'eduan'));
                ?>
            </span>
        </div>
        <!-- single infoe end -->

        <!-- single info -->
        <div class="single-info">
            <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect y="4.17773" width="1.85714" height="8.35714" fill="#1E1E1E" />
                <rect x="11.1426" y="6.96387" width="1.85714" height="5.57143" fill="#1E1E1E" />
                <rect x="5.57227" y="0.463867" width="1.85714" height="12.0714" fill="#1E1E1E" />
            </svg>
            <span><?php echo tp_get_post_view(); ?></span> 
        </div>
        <!-- single infoe end -->

    </div>

    <?php endif; ?>
    <h2 class="tp-single-title mb-30"><?php the_title(); ?></h2>
    <div class="bs-desc">
        <?php
            the_content();

            wp_link_pages( array(
              'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'eduan' ),
              'after'       => '</div>',
              'link_before' => '<span class="page-number">',
              'link_after'  => '</span>',
            ) );
        ?>
    </div>
     <?php 
        if(has_tag()){ ?>
            <div class="bs-info single-page-info tags">
                <?php
                    //tag add
                    $seperator = ''; // blank instead of comma
                    $after = '';
                    echo esc_html__( 'Tags: ', 'eduan' );
                    the_tags( '', $seperator, $after );
                ?>             
            </div> 
       <?php } ?> 
</div>
