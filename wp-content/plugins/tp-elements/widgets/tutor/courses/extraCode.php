<div class="course-all-data-fetching-here">
    <!-- 1. Course Title -->
    <h2><?php echo $course_title; ?></h2>

    <!-- 2. Course Description -->
    <p><?php echo wp_kses( $course_duration,array() ); ?></p>

    <!-- 3. Max Student Number -->
    <p><strong>Max Students:</strong> <?php echo $max_students ? $max_students : 'Unlimited'; ?></p>

    <!-- 4. Difficulty Level -->
    <p><strong>Difficulty Level:</strong> <?php echo ucfirst($difficulty_level); ?></p>

    <!-- 5. Public Course -->
    <p><strong>Public Course:</strong> <?php echo $is_public_course ? 'Yes' : 'No'; ?></p>

    <!-- 6. Visibility -->
    <p><strong>Visibility:</strong> <?php echo ucfirst($visibility); ?></p>

    <!-- 7. Featured Image -->
    <?php if ($featured_image): ?>
        <img src="<?php echo $featured_image; ?>" alt="<?php echo $course_title; ?>">
    <?php endif; ?>

    <!-- 8. Intro Video URL -->
    <?php if (!empty($intro_video)): ?>
    <p><strong>Intro Video:</strong> <a href="<?php echo esc_url($intro_video); ?>" target="_blank">Watch Video</a></p>
    <?php else: ?>
        <p><strong>Intro Video:</strong> Not Available</p>
    <?php endif; ?>

    <!-- 9. Pricing -->
    <p><strong>Price:</strong> <?php echo $pricing ? $pricing : 'Free'; ?></p>

    <!-- 10. Course Category -->
    <p><strong>Categories:</strong> 
        <?php 
        if ($categories) {
            foreach ($categories as $category) {
                echo $category->name . ' ';
            }
        }
        ?>
    </p>

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

    <!-- 12. Author / Course Teacher -->
    <p><strong>Author:</strong> <?php echo $author_avatar; ?> <?php echo $author_name; ?> </p>

    <!-- 14. Course Material -->
    <p><strong>Materials Included:</strong> <?php echo $materials; ?></p>

    <!-- 15. Lesson Count -->
    <p><strong>Lessons:</strong> <?php echo $lesson_count; ?></p>

    <!-- 16. Quiz -->
    <p><strong>Quizzes:</strong> <?php echo $quiz_count; ?></p>

    <!-- 17. Course Details Link  -->
    <p><strong>Course Details:</strong> <a href="<?php echo esc_url($course_details_link); ?>" target="_blank">View Details</a></p>

    <!-- 18. Course Rating  -->
    <p><strong>Rating:</strong> <?php echo $course_reviews_count ? $course_reviews_count : '0'; ?> reviews</p>
    
    <!-- 19. Course Favourite  -->
    <p><strong>Favourite:</strong> 

    <div class="course-wishlist">
        <a href="javascript:void(0);" 
        class="tutor-wishlist-btn" 
        data-course-id="<?php echo esc_attr($course_id); ?>" 
        data-wishlist-action="<?php echo $is_favorited ? 'remove' : 'add'; ?>">
            <?php if ($is_favorited): ?>
                <span style="color: red;">&#10084; <!-- Filled Heart Icon --></span>
            <?php else: ?>
                <span style="color: gray;">&#9825; <!-- Outlined Heart Icon --></span>
            <?php endif; ?>
        </a>
    </div>

</p>


</div>