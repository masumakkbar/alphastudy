<div class="col-xxl-<?php echo esc_attr( $settings['blog_col_xxl'] );?> col-xl-<?php echo esc_attr( $settings['blog_col_xl'] );?> col-lg-<?php echo esc_attr( $settings['blog_col_lg'] );?> col-md-<?php echo esc_attr( $settings['blog_col_md'] );?> col-sm-<?php echo esc_attr( $settings['blog_col_sm'] );?> col-<?php echo esc_attr( $settings['blog_col_xs'] );?> grid-item ">
    <div class="blog-category-item">
        <?php if(  $settings['blog_image'] == 'yes' ) : ?>
        <div class="blog-category-image">
            <a href="<?php echo esc_url( $category_link ); ?>"><img src="<?php echo esc_url($image_url);?>" alt="<?php echo esc_attr( $category->name );?>"></a>
        </div>
        <?php endif; ?> 
        <div class="blog-category-content">
            <h4 class="title"><a href="<?php echo esc_url( $category_link ); ?>"><?php echo esc_html($category->name);?></a></h4>
            <?php if(($settings['blog_content_show_hide'] == 'yes') ){ ?>
            <p class="txt"><?php echo wp_trim_words( $category_description, $limit, '...' ); ?></p>
            <?php } ?>

            <?php if($settings['blog_readmore_show_hide'] == 'yes') { ?>
            <div class="btn-part mt-15">
                <a class="readon-arrow" href="<?php echo esc_url( $category_link ); ?>">
                    <?php echo esc_html($settings['blog_btn_text']);?> <i class="fa <?php echo esc_html( $settings['blog_btn_icon'] );?>"></i>
                </a>
            </div>
            <?php } ?>

        </div>
    </div>								
</div>