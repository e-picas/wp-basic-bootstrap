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

    static $theme_supports = array(
        'post-thumbnails',
        'post-formats',
        'custom-header',
        'custom-background',
        'menus',
        'automatic-feed-links',
        'editor-style',
        'widgets',
        'html5',
        'title-tag'
    );

    /**
     * Register required plugins
     *
     * @uses \TGM_Plugin_Activation
     */
    public static function init()
    {
        // load custom libraries
        basicbootstrap_load_class('WP_Template_Hierarchy_Everywhere');
        basicbootstrap_load_library('template-enhancer');
        basicbootstrap_load_library('template-library');

        // load plugin internal config
        basicbootstrap_load_config('defaults');
        /**
         * Hook to update the theme default config on the fly
         *
         * Use global $basicbootstrap_config
         * @since 2.0.0
         */
        do_action('wp_basic_bootstrap_config');

        // required plugins
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

        // WP content width feature
        global $content_width;
        if (!isset($content_width)) {
            $content_width = $basicbootstrap_config['content_width'];
        }

        // add theme supports from configuration
        foreach (self::$theme_supports as $theme_mod) {
            $opt = basicbootstrap_get_config($theme_mod);
            if (!empty($opt)) {
                if ($opt===true) {
                    add_theme_support($theme_mod);
                } else {
                    add_theme_support($theme_mod, $opt);
                }
            }
        }

        // custom image sizes
        $images_opts = basicbootstrap_get_config('image_sizes');
        foreach ($images_opts as $type => $data) {
            if ($type == 'post_thumbnails') {
                set_post_thumbnail_size($data['width'], $data['height'], $data['crop']);
            } else {
                add_image_size($type, $data['width'], $data['height'], $data['crop']);
            }
        }

        // custom images CSS class
        $image_class = basicbootstrap_get_config('image_class');
        if (!empty($images_class)) {
            add_filter('get_image_tag_class', function ($class) use ($image_class) {
                return $class.' '.$image_class;
            });
            add_filter('the_content', 'basicbootstrap_add_image_responsive_class');
        }

        // register menus
        $menus = basicbootstrap_get_config('nav_menus');
        foreach ($menus as $i => $name) {
            $menus[$i] = __($name, 'basicbootstrap');
        }
        register_nav_menus($menus);

        // load vendors
        basicbootstrap_load_class('WP_Bootstrap_Navwalker');

        // the functions for debugging ...
        if (BASICBOOTSTRAP_TPLDBG) {
            basicbootstrap_load_library('dev-lib');
        }

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
     * Register the scripts and styles for front-end.
     *
     * @uses wp_register_style()
     * @uses wp_register_script()
     */
    public static function registerScriptsFrontend()
    {
        // load css
        $css_cfg = basicbootstrap_get_config('css');
        foreach ($css_cfg as $name=>$item) {
            if (strtolower(BASICBOOTSTRAP_ASSETS_LOADER) == 'cdn' && isset($item['uri-cdn']))
                $uri = $item['uri-cdn'];
            elseif (strtolower(BASICBOOTSTRAP_ASSETS_LOADER) == 'npm' && isset($item['uri-npm']))
                $uri = $item['uri-npm'];
            else
                $uri = $item['uri'];

            if (isset($item['replace_original']) && $item['replace_original'] == true)
                wp_deregister_script($name);

            wp_register_style(
                $name,
                $uri,
                isset($item['dependencies'])    ? $item['dependencies'] : array(),
                isset($item['version'])         ? $item['version'] : false,
                isset($item['media'])           ? $item['media'] : 'all'
            );

        }

        // load js
        $js_cfg = basicbootstrap_get_config('js');
        foreach ($js_cfg as $name=>$item) {
            if (strtolower(BASICBOOTSTRAP_ASSETS_LOADER) == 'cdn' && isset($item['uri-cdn']))
                $uri = $item['uri-cdn'];
            elseif (strtolower(BASICBOOTSTRAP_ASSETS_LOADER) == 'npm' && isset($item['uri-npm']))
                $uri = $item['uri-npm'];
            else
                $uri = $item['uri'];

            if (isset($item['replace_original']) && $item['replace_original'] == true)
                wp_deregister_script($name);

            wp_register_script(
                $name,
                $uri,
                isset($item['dependencies'])    ? $item['dependencies'] : array(),
                isset($item['version'])         ? $item['version'] : false,
                isset($item['in_footer'])       ? $item['in_footer'] : true
            );
        }
    }

    /**
     * Enqueue scripts and styles for front-end.
     *
     * @uses wp_register_style()
     * @uses wp_register_script()
     * @uses wp_enqueue_style()
     * @uses wp_enqueue_script()
     */
    public static function enqueueScriptsFrontend()
    {
        self::registerScriptsFrontend();

        // load css
        $css_cfg = basicbootstrap_get_config('css');
        foreach ($css_cfg as $name=>$item) {
            wp_enqueue_style($name);
        }

        // load js
        $js_cfg = basicbootstrap_get_config('js');
        foreach ($js_cfg as $name=>$item) {
            wp_enqueue_script($name);
        }

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

        // replace the archives widget
        unregister_widget('WP_Widget_Archives');
        basicbootstrap_load_class('WP_Basic_Bootstrap_Widget_Archives');
        register_widget('WP_Basic_Bootstrap_Widget_Archives');

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

        /**
         * Filter the theme's config items
         *
         * @since WP_Basic_Bootstrap 1.0
         *
         * @param mixed $value The item value to return
         * @param null|string $name The requested entry if so
         * @return mixed Must return the config item value
         */
        $value = apply_filters('basicbootstrap_config_items', $basicbootstrap_meta_boxes, 'meta-boxes');

        return array_merge($meta_boxes, $value);
    }
}
