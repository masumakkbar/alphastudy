<div class="tp-course-search-area">
    <form action="<?php echo esc_url(home_url('/')); ?>" method="get" id="course-search-form">
        <div class="tp-coupn-search">
            <div class="tp-coupn-search-input-wrapper">
                <input type="text" name="s" placeholder="<?php echo esc_html($settings['placeholder']);?>" class="tp-coupn-search-input" id="course-search-input" value="<?php echo get_search_query(); ?>">
                <button type="submit" class="tp-coupn-search-btn">
                    <?php if(($settings['button_show_hide'] == 'text') ){ ?>
                    <?php echo esc_html($settings['search_button_text']);?>
                    <?php } else { ?>
                        <span class="icon">
                        <?php \Elementor\Icons_Manager::render_icon( $settings['search_button_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                        </span>
                    <?php } ?>
                </button>
            </div>
            <input type="hidden" name="post_type" value="courses"> <!-- Restrict search to Tutor LMS courses -->
        </div>
    </form>
    <!-- Container for displaying live course suggestions -->
    <div id="course-search-results" class="d-none"></div>
</div>

