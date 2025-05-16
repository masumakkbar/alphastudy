<!--  #############################################################################################################################################################
start new From Here Masum 
########################################################################################################################################################## -->

<!-- displaying course price  -->

<?php if ( null != $price ) : ?>
    <div class="tp-course-price">
            <?php echo tutor_kses_html( $price ); ?>
    </div>
<?php else : ?>
    <div class="tp-course-price-free">
        <?php echo esc_html_x( 'Free', 'course price', 'tutor-lms-elementor-addons' ); ?>
    </div>
<?php endif; ?>

<!-- displaying Course Progression  -->
<?php
$course_progress = tutor_utils()->get_course_completed_percent( get_the_ID(), 0, true );
$is_editor       = \Elementor\Plugin::instance()->editor->is_edit_mode();

if ( is_array( $course_progress ) && count( $course_progress ) ) : ?>
	<div class="tp-course-progress tutor-course-progress">

		<div class=" tutor-d-flex tutor-align-center tutor-justify-between">
			<span class="tp-course-progress-steps">
				<?php echo esc_html( $is_editor ? 5 : $course_progress['completed_count'] ); ?>/<?php echo esc_html( $is_editor ? 10 : $course_progress['total_count'] ); ?>
			</span>
			<span class="tp-course-progress-percent"> 
				<?php echo esc_html( $is_editor ? '50%' : $course_progress['completed_percent'] . '%' ); ?>
				<?php esc_html_e( 'Complete', 'tutor-lms-elementor-addons' ); ?>
			</span>
		</div>

		<div class="tutor-progress-bar tp-course-progress-bar tutor-mt-12" style="--tutor-progress-value:<?php echo esc_attr( $is_editor ? '50' : $course_progress['completed_percent'] ); ?>%;">
			<span class="tutor-progress-value" area-hidden="true"></span>
		</div>
	</div>
<?php endif; ?>


<!-- displaying course image  -->
<a href="<?php echo esc_url( get_the_permalink() ); ?>"><img src="<?php echo esc_url($image_url); ?>" alt="<?php the_title(); ?>"></a>

<!-- displaying course bookmark / wishlist  -->
<div class="tp-course-bookmark">
    <?php
        echo '<span class="'. esc_attr( $action_class ) .' save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary" data-course-id="'. esc_attr( $course_id ) .'" role="button">
            <i class="' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line') . '"></i>
        </span>';
    ?>
</div>



<!-- displaying course difficulty level  -->
<?php if ( get_tutor_course_level() ) : ?>
	<span class="tp-course-level">
        <?php echo get_tutor_course_level(); ?>
    </span>
<?php endif; ?>


<!-- displaying rating  -->
<div class="tp-course-ratings-stars">
    <?php
        $course_rating = tutor_utils()->get_course_rating();
        tutor_utils()->star_rating_generator_course($course_rating->rating_avg);
    ?>
</div>

<?php if ($course_rating->rating_avg > 0) : ?>
    <span class="tp-course-ratings-average"><?php echo apply_filters('tutor_course_rating_average', $course_rating->rating_avg); ?></span>
    <span class="tp-course-ratings-count">(<?php echo $course_rating->rating_count > 0 ? $course_rating->rating_count : 0; ?>)</span>
<?php endif; ?>

<!-- Displaying Course Title  -->
<h4 class="tp-course-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php the_title(); ?></a></h4>


<!-- displaying course Duration   -->
<?php if( !empty( $course_duration ) ) : ?>
    <div class="tp-course-meta">
        <i class="tp tp-clock-regular"></i>
        <span class=""><?php echo tutor_utils()->clean_html_content( $course_duration ); ?></span>
    </div>
<?php endif; ?>

<!-- displaying course students Number   -->
<?php if( !empty( $course_students ) ) : ?>
    <div class="tp-course-meta">
        <i class="tp tp-user-1"></i>
        <span class=""><?php echo esc_html( $course_students ); ?></span>
    </div>
<?php endif; ?>

<!-- displaying course category    -->
<?php 
if ($categories) {
    foreach ($categories as $category) {
        $cat_link = get_term_link($category->term_id);
        echo '<a class="tp-course-category" href=" '. $cat_link .' " > '. $category->name .' </a>';
    }
}
?>

<!-- author displaying with link  -->
 <div class="tp-author-meta d-inline-flex">
    <a href="<?php echo $profile_url; ?>"><?php echo tutor_utils()->get_tutor_avatar( $post->post_author ); ?></a> - By <a class="" href="<?php echo $profile_url; ?>"> <?php esc_html_e( get_the_author() ); ?></a>
 </div>


 <!-- just add elementor button enable or disable switch for this course button add to cart / countinue learning  -->
<div class="tp-course-button">
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














<div class="course-all-data-fetching-here">

    <!-- 2. Course Description -->
    <p><?php echo $course_description; ?></p>

    <!-- 3. Max Student Number -->
    <p><strong>Max Students:</strong> <?php echo $max_students ? $max_students : 'Unlimited'; ?></p>

    <!-- 5. Public Course -->
    <p><strong>Public Course:</strong> <?php echo $is_public_course ? 'Yes' : 'No'; ?></p>

    <!-- 6. Visibility -->
    <p><strong>Visibility:</strong> <?php echo ucfirst($visibility); ?></p>

    <!-- 11. Course Tags -->
    <p><strong>Tags:</strong> 
        <?php 
        if ($tags) {
            foreach ($tags as $tag) {
                echo $tag->name . ' ';
            }
        }
        ?>
    </p>

    <!-- 14. Course Material -->
    <p><strong>Materials Included:</strong> <?php echo $materials; ?></p>

    <!-- 15. Lesson Count -->
    <p><strong>Lessons:</strong> <?php echo $lesson_count; ?></p>

    <!-- 16. Quiz -->
    <p><strong>Quizzes:</strong> <?php echo $quiz_count; ?></p>

    <!-- 17. Course Details Link  -->
    <p><strong>Course Details:</strong> <a href="<?php echo esc_url( get_the_permalink() ); ?>" target="_blank">View Details</a></p>

</p>


</div>