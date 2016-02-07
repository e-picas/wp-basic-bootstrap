<?php
/**
 * This file defines the default configuration of theme meta-boxes
 *
 * WARNING - Translation files are not yet loaded here so the translation process
 * must be done on data loading.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * The global meta-boxes table
 */
global $basicbootstrap_meta_boxes;
$basicbootstrap_meta_boxes = array();

// metabox for link post format
$basicbootstrap_meta_boxes[] = array(
    'id' => 'linkmetabox',
    'title' => __('Link Format Post Options', 'basicbootstrap'),
    'post_types' => array('post', 'page'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
        // Link text box
        array(
            'name' => __('Link URL', 'basicbootstrap'),
            'id' => 'post-format-link-url',
            'type' => 'text',
        )
    )
);

// metabox for audio post format
$basicbootstrap_meta_boxes[] = array(
    'id' => 'audiometabox',
    'title' => __('Audio Format Post Options', 'basicbootstrap'),
    'post_types' => array('post', 'page'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => __('Audio Host Type', 'basicbootstrap'),
            'id' => 'post-format-audio-host-type',
            'type' => 'radio',
            'options' => array(
                'embeded' => __('Embed Code', 'basicbootstrap'),
                'selfhosted' => __('Self Hosted', 'basicbootstrap'),
            ),
            'std' => 'embeded',
        ),
        array(
            'name' => __('Audio Embed Code', 'basicbootstrap'),
            'id' => 'post-format-audio-embed-code',
            'type' => 'textarea',
            'class' => 'field-embed'

        ),
        array(
            'name' => __('Upload Audio File', 'basicbootstrap'),
            'id' => 'post-format-shaudio',
            'type' => 'file_advanced',
            'class' => 'field-sh',
            'desc' => __('Upload or select your self hosted audio', 'basicbootstrap'),
            'mime_type' => 'audio', // Leave blank for all file types
        ),

    )
);

// metabox for video post format
$basicbootstrap_meta_boxes[] = array(
    'id' => 'videometabox',
    'title' => __('Video Format Post Options', 'basicbootstrap'),
    'post_types' => array('post', 'page'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => __('Video Host Type', 'basicbootstrap'),
            'id' => 'post-format-video-host-type',
            'type' => 'radio',
            'options' => array(
                'embeded' => __('Embed Code', 'basicbootstrap'),
                'selfhosted' => __('Self Hosted', 'basicbootstrap'),
            ),
            'std' => 'embeded',
        ),
        array(
            'name' => __('Video Embed Code', 'basicbootstrap'),
            'id' => 'post-format-video-embed-code',
            'desc' => __('Paste the embed code here. If you want to use self hosted, you may leave it blank and choose self hosted option above.', 'basicbootstrap'),
            'type' => 'textarea',
            'class' => 'field-embed'
        ),
        array(
            'name' => __('Upload Video File', 'basicbootstrap'),
            'id' => 'post-format-shvideo',
            'type' => 'file_advanced',
            'class' => 'field-sh',
            'desc' => __('Upload or select your self hosted Video. If you want to use embed code. you may leave it blank and choose embed code option above.', 'basicbootstrap'),
            'max_file_uploads' => 1,
            'mime_type' => 'video', // Leave blank for all file types
        )
    )
);

// metabox for quote post format
$basicbootstrap_meta_boxes[] = array(
    'id' => 'quotemetabox',
    'title' => __('Quote Format Post Options', 'basicbootstrap'),
    'post_types' => array('post', 'page'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => __('Quote Content', 'basicbootstrap'),
            'id' => 'post-format-quote-content',
            'type' => 'textarea',
        ),
        array(
            'name' => __('Quote Source Name', 'basicbootstrap'),
            'id' => 'post-format-quote-source-name',
            'type' => 'text',
        ),
        array(
            'name' => __('Quote Source URL', 'basicbootstrap'),
            'id' => 'post-format-quote-source-link',
            'type' => 'text',
        ),
    )
);

// metabox for status post format
$basicbootstrap_meta_boxes[] = array(
    'id' => 'statusmetabox',
    'title' => __('Status Format Post Options', 'basicbootstrap'),
    'post_types' => array('post', 'page'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => __('Status Type', 'basicbootstrap'),
            'id' => 'post-format-status-type',
            'type' => 'radio',
            'options' => array(
                'twitter' => __('Twitter Status', 'basicbootstrap'),
                'facebook' => __('Facebook Status', 'basicbootstrap'),
            ),
            'std' => 'twitter',
        ),
        array(
            'name' => __('Status link (URL)', 'basicbootstrap'),
            'id' => 'post-format-status-link',
            'type' => 'text',
        ),
    )
);

// metabox for gallery post format
$basicbootstrap_meta_boxes[] = array(
    'id' => 'gallerymetabox',
    'title' => __('Gallery Format Post Options', 'basicbootstrap'),
    'post_types' => array('post', 'page'),
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(

        array(
            'name' => __('Gallery Type', 'basicbootstrap'),
            'id' => 'post-format-gallery-type',
            'type' => 'radio',
            'options' => array(
                'slider' => __('Slider Gallery', 'basicbootstrap'),
                'tiled' => __('Tiled Gallery', 'basicbootstrap'),
            ),
            'std' => 'slider',
        ),
        array(
            'name' => __('Upload or Choose Images', 'basicbootstrap'),
            'id' => 'post-format-gallery-images',
            'desc' => __('Choose or upload images for this gallery', 'basicbootstrap'),
            'type' => 'file_advanced',
            'mime_type' => 'image'
        ),
    )
);


// metabox for attachment posts
$basicbootstrap_meta_boxes[] = array(
    'id' => 'attachmentstatemetabox',
    'title' => __('About attachment single page', 'basicbootstrap'),
    'post_types' => 'attachment',
    'context' => 'normal',
    'priority' => 'high',
    'autosave' => true,
    'fields' => array(
        array(
            'id' => 'attachment-page-visibility-disabled-cmt',
            'std' => __('This setting lets you disable the attachment page on front-end for this media (will generate a 403 error).', 'basicbootstrap'),
            'type' => 'custom_html',
        ),
        array(
            'name' => __('Attachment page visibility', 'basicbootstrap'),
            'id' => 'attachment-page-visibility',
            'type' => 'radio',
            'options' => array(
                'enabled' => __('Visible', 'basicbootstrap'),
                'disabled' => __('Not visible', 'basicbootstrap'),
            ),
            'std' => 'enabled',
        ),
    )
);
