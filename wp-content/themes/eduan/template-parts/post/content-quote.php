<?php if(has_post_thumbnail()){ ?>
  <div class="bs-img">
    <?php the_post_thumbnail()?>
  </div>
<?php } ?>

<div class="single-content-full">
  <h2 class="tp-single-title mb-30"><?php the_title(); ?></h2>
    <div class="bs-desc">
        <?php
            the_content();
            wp_link_pages( array(
              'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'eduan' ),
              'after'       => '</div>',
              'link_before' => '<span class="page-number">',
              'link_after'  => '</span>',
            ));
        ?>
    </div>
    <?php 
        if(has_tag()){ ?>
            <div class="bs-info single-page-info tags">
                <?php
                    //tag add
                    $seperator = ''; // blank instead of comma
                    $after     = '';
                    echo esc_html__( 'Tags: ', 'eduan' );
                    the_tags( '', $seperator, $after );
                ?>             
            </div> 
       <?php }
    ?> 
</div>
