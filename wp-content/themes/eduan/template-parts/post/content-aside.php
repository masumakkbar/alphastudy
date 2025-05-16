<?php if(has_post_thumbnail()){
?>
<?php //header style; ?>
<div class="bs-img">
  <?php the_post_thumbnail()?>
</div>
<?php
}?>

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
      ) );
    ?>
</div>
</div>

