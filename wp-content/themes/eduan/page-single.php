<?php
/**
 * Template Name: Single Page Template
 */

get_header(); 

//checking page layout 
$page_layout = get_post_meta( get_the_ID(), 'layout', true );
$col_side ='';
$col_letf ='';
if($page_layout == '2left'){
    $col_side = '8';
    $col_letf = 'left-sidebar';
}
else if($page_layout == '2right'){
    $col_side = '8';
    $col_letf = 'right-sidebar';
}
else{
    $col_side = '12';
    $col_letf = 'no-sidebar';
}
?>

<div class="row">
    <div class="col-md-<?php echo esc_attr( $col_side). ' ' .esc_attr( $col_letf) ?>">
        <?php	
    while ( have_posts() ) : the_post(); 
        get_template_part( 'template-parts/content', 'page' );
        endwhile; // End of the loop.
        ?>
    </div>
    <?php 
    // get_sidebar('page');
    if ($page_layout == '2left' || $page_layout == '2right') {
        get_sidebar('page');
    }
    ?>
</div>

<?php
get_footer();

