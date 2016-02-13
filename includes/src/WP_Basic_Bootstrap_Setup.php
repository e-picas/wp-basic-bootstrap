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
        // load custom libraries
        basicbootstrap_load_class('wp-template-hierarchy-everywhere');
        basicbootstrap_load_library('template-enhancer');
        basicbootstrap_load_library('template-library');

        // required plugins
        basicbootstrap_load_config('defaults');
        basicbootstrap_load_class('TGM_Plugin_Activation');
        add_action('tgmpa_register', array('WP_Basic_Bootstrap_Setup', 'setupRequirements'));
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

        // load vendors
        basicbootstrap_load_class('wp_bootstrap_navwalker');
    }

    /**
     * Set up theme on front-end.
     */
    public static function setupFrontend()
    {
        // exclude password proceted posts from lists if so
        if (false === (bool) get_basicbootstrap_mod('show_protected_posts')) {
            add_action('pre_get_posts', 'exclude_protected_posts_action');
        }
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
        wp_enqueue_style(
            'bootstrap',
            get_asset_uri('assets/css/bootstrap.min.css'),
            array(),
            '3.3.5'
        );
/*
        wp_enqueue_style(
            'bootstrap-theme',
            get_asset_uri('assets/css/bootstrap-theme.min.css'),
            array(),
            '3.3.5'
        );
*/
        wp_enqueue_script(
            'bootstrap',
            get_asset_uri('assets/js/bootstrap.min.js'),
            array('jquery'),
            '3.3.5',
            true
        );
        wp_enqueue_script(
            'html5shiv-js',
            get_asset_uri('assets/js/html5shiv.min.js'),
            array('jquery'),
            '3.7.2'
        );
        wp_enqueue_script(
            'ie-10-viewport-bug-workaround-js',
            get_asset_uri('assets/js/ie10-viewport-bug-workaround.js'),
            array('jquery'),
            '3.3.5',
            true
        );
        wp_enqueue_script(
            'respond-js',
            get_asset_uri('assets/js/respond.js'),
            array('jquery'),
            '1.4.2'
        );

        // required assets for FontAwesome
        wp_enqueue_style(
            'fontawesome',
            get_asset_uri('assets/css/font-awesome.min.css'),
            array(),
            '4.5.0'
        );

        // theme deps
        wp_enqueue_style(
            'basicbootstrap-base-styles',
            get_asset_uri('assets/css/blog.css'),
            array('bootstrap', 'fontawesome'),
            BASICBOOTSTRAP_VERSION
        );

        // direct customization
        wp_enqueue_style(
            'basicbootstrap-style',
            get_stylesheet_uri(),
            array('basicbootstrap-base-styles'),
            BASICBOOTSTRAP_VERSION
        );
        wp_enqueue_style(
            'basicbootstrap-style-print',
            get_asset_uri('style_print.css'),
            array('basicbootstrap-base-styles'),
            BASICBOOTSTRAP_VERSION,
            'print'
        );
        wp_enqueue_script(
            'basicbootstrap-scripts',
            get_asset_uri('scripts.js'),
            array('jquery', 'bootstrap'),
            BASICBOOTSTRAP_VERSION,
            true
        );

        // WordPress internal script to move the comment box to the right place when replying to a user
        if (is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
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
        add_filter('widget_categories_dropdown_args', function ($args) {
            if (!isset($args['class'])) {
                $args['class'] = '';
            }
            $args['class'] .= ' form-control';
            return $args;
        });
        add_filter('widget_archives_dropdown_args', function ($args) {
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
        basicbootstrap_load_config('meta-boxes');
        global $basicbootstrap_meta_boxes;
        return array_merge($meta_boxes, $basicbootstrap_meta_boxes);
    }
}
