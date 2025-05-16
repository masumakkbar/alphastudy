jQuery(document).ready(function ($) {
    // Trigger search when input or category changes
    $('#course-search-input, #course-category-select').on('input change', function () {
        var searchQuery = $('#course-search-input').val().trim(); // Get search query
        var category = $('#course-category-select').val(); // Get selected category

        // Perform AJAX if input is not empty or category is selected
        if (searchQuery.length > 2 || category !== "") {
            $.ajax({
                url: tp_course_data.ajaxurl,
                method: 'GET',
                data: {
                    action: 'course_search_ajax', // Custom action for our AJAX
                    search_query: searchQuery, // Pass the search query
                    category: category, // Pass the selected category
                    nonce: tp_course_data.nonce, // Security nonce
                },
                success: function (response) {
                    if (response) {
                        $('#course-search-results').html(response).removeClass('d-none');
                    } else {
                        $('#course-search-results').html('<p>No courses found.</p>').removeClass('d-none');
                    }
                },
                error: function () {
                    $('#course-search-results').html('<p>Error fetching results. Please try again.</p>').removeClass('d-none');
                },
            });
        } else {
            $('#course-search-results').addClass('d-none'); // Hide results if no valid input or category
        }
    });

    // Close the search results if clicked outside
    $(document).click(function (event) {
        if (!$(event.target).closest('#course-search-results, #course-search-input, #course-category-select').length) {
            $('#course-search-results').addClass('d-none');
        }
    });


    // Favourite icon for course start 
    jQuery(document).on('click', '.tutor-wishlist-btn', function () {
        var button = jQuery(this);
        var courseId = button.data('course-id');
        var action = button.data('wishlist-action'); // 'add' or 'remove'
    
        // AJAX request to custom action for wishlist toggle
        jQuery.ajax({
            url: tp_course_data.ajaxurl, // Custom AJAX URL, ensure tp_course_data.ajaxurl is localized properly
            type: 'POST',
            data: {
                action: 'custom_toggle_wishlist', // Custom action name
                course_id: courseId,
                wishlist_action: action // Pass the current action ('add' or 'remove')
            },
            success: function (response) {
                if (response.success) {
                    // Toggle the icon and action dynamically
                    if (action === 'add') {
                        button.html('<span style="color: red;">&#10084;</span>'); // Filled heart (favorite)
                        button.data('wishlist-action', 'remove');
                    } else {
                        button.html('<span style="color: gray;">&#9825;</span>'); // Outlined heart (not favorite)
                        button.data('wishlist-action', 'add');
                    }
                } else {
                    alert('Failed to update the wishlist. Please try again.');
                }
            },
            error: function () {
                alert('You must be logged in to add to wishlist.');
            }
        });
    });
    // Favourite icon for course end 


});
