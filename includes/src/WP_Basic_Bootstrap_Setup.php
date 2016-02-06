<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Class WP_Basic_Bootstrap_Setup
 */
class WP_Basic_Bootstrap_Setup
{

    /**
     * Register required plugins
     *
     * @uses \TGM_Plugin_Activation
     */
    public static function init()
    {
        basicbootstrap_load_class('TGM_Plugin_Activation');
        add_action('tgmpa_register', array('WP_Basic_Bootstrap_Setup','setupRequirements'));
    }

    /**
     * Register required plugins
     *
     * @uses \TGM_Plugin_Activation
     */
    public static function setupRequirements()
    {
        tgmpa(basicbootstrap_get_config('required_plugins'));
    }

    /**
     * Set up theme defaults and registers support for various WordPress features.
     *
     * @uses add_theme_support()        To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
     * @uses register_nav_menus()       To add support for navigation menus.
     * @uses add_editor_style()         To style the visual editor.
     * @uses load_theme_textdomain()    For translation/localization support.
     * @uses set_post_thumbnail_size()  To set a custom post thumbnail size.
     */
    public static function setupCommon()
    {
        // translations can be filed in the /languages/ directory
        load_theme_textdomain('basicbootstrap', get_template_directory() . '/languages');

        // blog defaults
        $basicbootstrap_config = basicbootstrap_get_config('defaults');
        global $content_width;
        if (!isset($content_width)) {
            $content_width = $basicbootstrap_config['content_width'];
        }

        // custom headers support
        $custom_header_opts = basicbootstrap_get_config('custom_header');
        add_theme_support('custom-header', $custom_header_opts);

        // custom background support
        $custom_background_opts = basicbootstrap_get_config('custom_background');
        add_theme_support('custom-background', $custom_background_opts);

        // post formats support
        add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

        // HTML5 markup allowed
        add_theme_support('html5', array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'));

        // add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // this theme does not hard-code document title tag to HTML <head>
        add_theme_support('title-tag');

        // this theme uses post thumbnails
        add_theme_support('post-thumbnails');

        // custom image sizes
        $images_opts = basicbootstrap_get_config('image_sizes');
        foreach ($images_opts as $type => $data) {
            if ($type == 'post_thumbnails') {
                set_post_thumbnail_size($data['width'], $data['height'], $data['crop']);
            } else {
                add_image_size($type, $data['width'], $data['height'], $data['crop']);
            }
        }

        // register menus
        $menus = basicbootstrap_get_config('nav_menus');
        foreach ($menus as $i => $name) {
            $menus[$i] = __($name, 'basicbootstrap');
        }
        register_nav_menus($menus);

        // load custom libraries
        basicbootstrap_load_library('templates-enhancer');
        basicbootstrap_load_library('templates-library');
        // the functions to clean up ...
        basicbootstrap_load_library('functions-to-cleanup');

        // load vendors
        basicbootstrap_load_class('wp_bootstrap_navwalker');
    }

    /**
     * Set up theme on front-end.
     */
    public static function setupFrontend()
    {

    }

    /**
     * Set up theme on back-end.
     *
     * @uses add_editor_style()         To style the visual editor.
     */
    public static function setupBackend()
    {
        // styles the visual editor with editor-style.css to match the theme style
        add_editor_style('editor-style.css');

        /**
         * Registering meta boxes
         *
         * All the definitions of meta boxes are listed below with comments.
         * Please read them CAREFULLY.
         *
         * You also should read the changelog to know what has been changed before updating.
         *
         * Learn more: http://metabox.io/docs/registering-meta-boxes/
         */
        add_filter('rwmb_meta_boxes', array(__CLASS__, 'metaBoxesInit'));
    }

    /**
     * Enqueue scripts and styles for front-end.
     *
     * @uses wp_enqueue_style()
     * @uses wp_enqueue_script()
     */
    public static function enqueueScriptsFrontend()
    {
        // required assets for Bootstrap
        wp_enqueue_style('bootstrap',
            get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.5');
        wp_enqueue_script('bootstrap',
            get_template_directory_uri() . '/assets/js/bootstrap.min.js', array('jquery'), '3.3.5', true);
        wp_enqueue_script('html5shiv-js',
            get_template_directory_uri() . '/assets/js/html5shiv.js', array('jquery'), '3.7.2');
        wp_enqueue_script('ie-10-viewport-bug-workaround-js',
            get_template_directory_uri() . '/assets/js/ie10-viewport-bug-workaround.js', array('jquery'), '3.3.5', true);
        wp_enqueue_script('respond-js',
            get_template_directory_uri() . '/assets/js/respond.js', array('jquery'), '1.4.2');

        // required assets for FontAwesome
        wp_enqueue_style('fontawesome',
            get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.5.0');
        wp_enqueue_style('bootstrtap-social',
            get_template_directory_uri() . '/assets/css/bootstrap-social.css', array('bootstrap', 'fontawesome'), BASICBOOTSTRAP_VERSION);

        // theme deps
        wp_enqueue_style('basicbootstrap-base-styles',
            get_template_directory_uri() . '/assets/css/blog.css', array('bootstrap', 'fontawesome','bootstrtap-social'), BASICBOOTSTRAP_VERSION);

        // direct customization
        wp_enqueue_style('basicbootstrap-style',
            get_stylesheet_uri(), array('basicbootstrap-base-styles'), BASICBOOTSTRAP_VERSION);
        wp_enqueue_style('basicbootstrap-style-print',
            get_template_directory_uri() . '/style_print.css', array('basicbootstrap-base-styles'), BASICBOOTSTRAP_VERSION, 'print');
        wp_enqueue_script('basicbootstrap-scripts',
            get_template_directory_uri() . '/scripts.js', array('jquery', 'bootstrap'), BASICBOOTSTRAP_VERSION, true);
    }

    /**
     * Enqueue scripts and styles for back-end.
     *
     * @uses wp_enqueue_script()
     */
    public static function enqueueScriptsBackend()
    {
        wp_enqueue_script('basicbootstrap-admin-script',
            get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), BASICBOOTSTRAP_VERSION, true);
    }

    /**
     * Register widgetized areas, including main sidebar and three widget-ready columns in the footer.
     *
     * @uses register_sidebar()
     */
    public static function widgetsInit()
    {
        // register sidebars
        foreach (basicbootstrap_get_config('sidebars') as $sidebar) {
            foreach (array('name', 'description') as $item) {
                if (isset($sidebar[$item])) {
                    $sidebar[$item] = __($sidebar[$item], 'basicbootstrap');
                }
            }
            register_sidebar($sidebar);
        }

        // replace the recent_posts widget
        unregister_widget('WP_Widget_Recent_Posts');
        basicbootstrap_load_class('WP_Basic_Bootstrap_Widget_Recent_Posts');
        register_widget('WP_Basic_Bootstrap_Widget_Recent_Posts');

        // replace the recent_comments widget
        unregister_widget('WP_Widget_Recent_Comments');
        basicbootstrap_load_class('WP_Basic_Bootstrap_Widget_Recent_Comments');
        register_widget('WP_Basic_Bootstrap_Widget_Recent_Comments');

        // new author block widget
        basicbootstrap_load_class('WP_Basic_Bootstrap_Widget_Author_Block');
        register_widget('WP_Basic_Bootstrap_Widget_Author_Block');

        // adapt dropdowns
        add_filter('widget_categories_dropdown_args', function($args) {
            if (!isset($args['class'])) {
                $args['class'] = '';
            }
            $args['class'] .= ' form-control';
            return $args;
        });
        add_filter('widget_archives_dropdown_args', function($args) {
            if (!isset($args['class'])) {
                $args['class'] = '';
            }
            $args['class'] .= ' form-control';
            return $args;
        });

    }

    /**
     * Register meta boxes
     *
     * Remember to change "your_prefix" to actual prefix in your project
     *
     * @param array $meta_boxes List of meta boxes
     *
     * @return array
     */
    public static function metaBoxesInit($meta_boxes)
    {

        // metabox for link post format
        $meta_boxes[] = array(
            'id' => 'linkmetabox',
            'title' => esc_html__('Link Format Post Options', 'basicbootstrap'),
            'post_types' => array('post', 'page'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(
                // Link text box
                array(
                    'name' => esc_html__('Link URL', 'basicbootstrap'),
                    'id' => 'post-format-link-url',
                    'type' => 'text',

                )
            )
        );

        // metabox for audio post format
        $meta_boxes[] = array(
            'id' => 'audiometabox',
            'title' => esc_html__('Audio Format Post Options', 'basicbootstrap'),
            'post_types' => array('post', 'page'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(

                array(
                    'name' => esc_html__('Audio Host Type', 'basicbootstrap'),
                    'id' => 'post-format-audio-host-type',
                    'type' => 'radio',
                    'options' => array(
                        'embeded' => esc_html__('Embed Code', 'basicbootstrap'),
                        'selfhosted' => esc_html__('Self Hosted', 'basicbootstrap'),
                    ),
                    'std' => 'embeded',
                ),
                array(
                    'name' => esc_html__('Audio Embed Code', 'basicbootstrap'),
                    'id' => 'post-format-audio-embed-code',
                    'type' => 'textarea',
                    'class' => 'field-embed'

                ),
                array(
                    'name' => esc_html__('Upload Audio File', 'basicbootstrap'),
                    'id' => 'post-format-shaudio',
                    'type' => 'file_advanced',
                    'class' => 'field-sh',
                    'desc' => esc_html__('Upload or select your self hosted audio', 'basicbootstrap'),
                    'mime_type' => 'audio', // Leave blank for all file types
                ),


            )
        );

        // metabox for video post format
        $meta_boxes[] = array(
            'id' => 'videometabox',
            'title' => esc_html__('Video Format Post Options', 'basicbootstrap'),
            'post_types' => array('post', 'page'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(

                array(
                    'name' => esc_html__('Video Host Type', 'basicbootstrap'),
                    'id' => 'post-format-video-host-type',
                    'type' => 'radio',
                    'options' => array(
                        'embeded' => esc_html__('Embed Code', 'basicbootstrap'),
                        'selfhosted' => esc_html__('Self Hosted', 'basicbootstrap'),
                    ),
                    'std' => 'embeded',
                ),
                array(
                    'name' => esc_html__('Video Embed Code', 'basicbootstrap'),
                    'id' => 'post-format-video-embed-code',
                    'desc' => esc_html__('Paste the embed code here. If you want to use self hosted, you may leave it blank and choose self hosted option above.', 'basicbootstrap'),
                    'type' => 'textarea',
                    'class' => 'field-embed'
                ),
                array(
                    'name' => esc_html__('Upload Video File', 'basicbootstrap'),
                    'id' => 'post-format-shvideo',
                    'type' => 'file_advanced',
                    'class' => 'field-sh',
                    'desc' => esc_html__('Upload or select your self hosted Video. If you want to use embed code. you may leave it blank and choose embed code option above.', 'basicbootstrap'),
                    'max_file_uploads' => 1,
                    'mime_type' => 'video', // Leave blank for all file types
                )
            )
        );

        // metabox for quote post format
        $meta_boxes[] = array(
            'id' => 'quotemetabox',
            'title' => esc_html__('Quote Format Post Options', 'basicbootstrap'),
            'post_types' => array('post', 'page'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(

                array(
                    'name' => esc_html__('Quote Content', 'basicbootstrap'),
                    'id' => 'post-format-quote-content',
                    'type' => 'textarea',
                ),
                array(
                    'name' => esc_html__('Quote Source Name', 'basicbootstrap'),
                    'id' => 'post-format-quote-source-name',
                    'type' => 'text',
                ),
                array(
                    'name' => esc_html__('Quote Source URL', 'basicbootstrap'),
                    'id' => 'post-format-quote-source-link',
                    'type' => 'text',
                ),
            )
        );

        // metabox for status post format
        $meta_boxes[] = array(
            'id' => 'statusmetabox',
            'title' => esc_html__('Status Format Post Options', 'basicbootstrap'),
            'post_types' => array('post', 'page'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(

                array(
                    'name' => esc_html__('Status Type', 'basicbootstrap'),
                    'id' => 'post-format-status-type',
                    'type' => 'radio',
                    'options' => array(
                        'twitter' => esc_html__('Twitter Status', 'basicbootstrap'),
                        'facebook' => esc_html__('Facebook Status', 'basicbootstrap'),
                    ),
                    'std' => 'twitter',
                ),
                array(
                    'name' => esc_html__('Status link (URL)', 'basicbootstrap'),
                    'id' => 'post-format-status-link',
                    'type' => 'text',
                ),
            )
        );

        // metabox for gallery post format
        $meta_boxes[] = array(
            'id' => 'gallerymetabox',
            'title' => esc_html__('Gallery Format Post Options', 'basicbootstrap'),
            'post_types' => array('post', 'page'),
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(

                array(
                    'name' => esc_html__('Gallery Type', 'basicbootstrap'),
                    'id' => 'post-format-gallery-type',
                    'type' => 'radio',
                    'options' => array(
                        'slider' => esc_html__('Slider Gallery', 'basicbootstrap'),
                        'tiled' => esc_html__('Tiled Gallery', 'basicbootstrap'),
                    ),
                    'std' => 'slider',
                ),
                array(
                    'name' => esc_html__('Upload or Choose Images', 'basicbootstrap'),
                    'id' => 'post-format-gallery-images',
                    'desc' => esc_html__('Choose or upload images for this gallery', 'basicbootstrap'),
                    'type' => 'file_advanced',
                    'mime_type' => 'image'
                ),
            )
        );


        // metabox for attachment posts
        $meta_boxes[] = array(
            'id' => 'attachmentstatemetabox',
            'title' => esc_html__('About attachment single page', 'basicbootstrap'),
            'post_types' => 'attachment',
            'context' => 'normal',
            'priority' => 'high',
            'autosave' => true,
            'fields' => array(
                array(
                    'id' => 'attachment-page-visibility-disabled-cmt',
                    'std' => esc_html__('This setting lets you disable the attachment page on front-end for this media (will generate a 403 error).', 'basicbootstrap'),
                    'type' => 'custom_html',
                ),
                array(
                    'name' => esc_html__('Attachment page visibility', 'basicbootstrap'),
                    'id' => 'attachment-page-visibility',
                    'type' => 'radio',
                    'options' => array(
                        'enabled' => esc_html__('Visible', 'basicbootstrap'),
                        'disabled' => esc_html__('Not visible', 'basicbootstrap'),
                    ),
                    'std' => 'enabled',
                ),
            )
        );

        return $meta_boxes;
    }
}
