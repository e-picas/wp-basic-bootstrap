/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

jQuery(document).load(function() {

    // hide all metabox
    jQuery('#linkmetabox, #audiometabox, #videometabox, #quotemetabox, #statusmetabox, #gallerymetabox').css('display', 'none');

    // on click show and hide
    jQuery('input[name=post_format]').on('change', function () {
        format = jQuery('input[name=post_format]:checked').val();
        // link post format
        if (format == 'link') {
            jQuery('#linkmetabox').css('display', 'block');
        } else {
            jQuery('#linkmetabox').css('display', 'none');
        }
        // audio post format
        if (format == 'audio') {
            jQuery('#audiometabox').css('display', 'block');
        } else {
            jQuery('#audiometabox').css('display', 'none');
        }
        // video post format
        if (format == 'video') {
            jQuery('#videometabox').css('display', 'block');
        } else {
            jQuery('#videometabox').css('display', 'none');
        }
        // video post format
        if (format == 'quote') {
            jQuery('#quotemetabox').css('display', 'block');
        } else {
            jQuery('#quotemetabox').css('display', 'none');
        }
        // status post format
        if (format == 'status') {
            jQuery('#statusmetabox').css('display', 'block');
        } else {
            jQuery('#statusmetabox').css('display', 'none');
        }
        // gallery post format
        if (format == 'gallery') {
            jQuery('#gallerymetabox').css('display', 'block');
        } else {
            jQuery('#gallerymetabox').css('display', 'none');
        }

    });
    // Add a trigger to show correct metabox for already published posts
    jQuery('input[name=post_format]').trigger('change');

    // hide and show field depending on chosen option in meta box
    // Audio metabox
    jQuery('input[name=post-format-audio-host-type]').on('change', function () {
        var audio_host_type = jQuery('input[name=post-format-audio-host-type]:checked').val();
        if (audio_host_type == 'embeded') {
            jQuery('#audiometabox').find('.field-sh').css('display', 'none');
            jQuery('#audiometabox').find('.field-embed').css('display', 'block');
        } else {
            jQuery('#audiometabox').find('.field-embed').css('display', 'none');
            jQuery('#audiometabox').find('.field-sh').css('display', 'block');
        }
    });
    jQuery('input[name=post-format-audio-host-type]').trigger('change');

    // Video metabox
    jQuery('input[name=post-format-video-host-type]').on('change', function () {
        var video_host_type = jQuery('input[name=post-format-video-host-type]:checked').val();
        if (video_host_type == 'embeded') {
            jQuery('#videometabox').find('.field-sh').css('display', 'none');
            jQuery('#videometabox').find('.field-embed').css('display', 'block');
        } else {
            jQuery('#videometabox').find('.field-embed').css('display', 'none');
            jQuery('#videometabox').find('.field-sh').css('display', 'block');
        }
    });
    jQuery('input[name=post-format-video-host-type]').trigger('change');

}(jQuery));
