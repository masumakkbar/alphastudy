jQuery(document).ready(function ($) {
    function wp_media_upload(buttonClass, hiddenField, imageWrapper) {
        var mediaUploader;

        $(buttonClass).click(function (e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media.frames.file_frame = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image',
                },
                multiple: false
            });
            mediaUploader.on('select', function () {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $(hiddenField).val(attachment.id);
                $(imageWrapper).html('<img src="' + attachment.url + '" style="max-width:100%;"/>');
            });
            mediaUploader.open();
        });
    }

    wp_media_upload('.category-image-upload', '#category-image-id', '#category-image-wrapper');

    $('.category-image-remove').click(function (e) {
        e.preventDefault();
        $('#category-image-id').val('');
        $('#category-image-wrapper').html('');
    });
});
