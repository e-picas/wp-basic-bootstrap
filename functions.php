<?php
/**
 * Global theme's functions: setup and general hooks on actions and filters
 *
 * Any hook to be plugged at each run MUST be written here for clarity. Exceptionally,
 * a library may plug its hooks in its own file if needed.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * This file embeds the three dependencies any time:
 *
 * -    `includes/basicbootstrap/config/defaults.php` : the global theme's config and core functions
 * -    `includes/templates-enhancer.php` : a library of "missing" Wordpress functions to use
 *      in templates
 * -    `includes/templates-library.php` : the library of theme's features
 *
 * No function is defined here, to see the setup content, have a look at `\WP_Basic_Bootstrap_Setup`.
 *
 * This plugin uses prefix `WP_Basic_Bootsrtap_` for its PHP classes BUT the simpler prefix
 * `basicbootstrap_` for its PHP functions.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (!defined('ABSPATH')) {
    header('HTTP/1.1 403 Forbidden');
    exit('No script kiddies please!');
}

/**
 * Current plugin version
 */
define('BASICBOOTSTRAP_VERSION', '2.0.0@dev');

/**
 * Bootstrap version
 * @see https://getbootstrap.com/
 */
define('BASICBOOTSTRAP_BOOTSTRAP_VERSION', '4.6.1');

/**
 * FontAwesome version
 * @see https://fontawesome.com/
 */
define('BASICBOOTSTRAP_FONTAWESOME_VERSION', '5.15.4');

/**
 * PopperJS version
 * @see https://popper.js.org/
 */
define('BASICBOOTSTRAP_POPPER_VERSION', '1.16.1');

/**
 * Use the CDN loading of assets or not
 *
 * To use local assets, define this constant before loading the
 * theme and set it to "false"
 */
if (!defined('BASICBOOTSTRAP_USE_CDN'))
    define('BASICBOOTSTRAP_USE_CDN', true);

/**
 * Current local plugin root path
 */
define('BASICBOOTSTRAP_BASEPATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);

/**
 * DEBUG FLAG : enable this to log all loaded templates of the theme
 *
 * This will make an `error_log(__FILE__)` at the top of any template of this theme
 * to trace final rendering stack.
 */
/*/
define('BASICBOOTSTRAP_TPLDBG', true);
//*/

/*/
// HARD DEBUG OF THEME MODS
header('Content-Type: text/plain');
var_export(get_theme_mods());
//remove_theme_mods(); echo '>> THEME MODS DELETED!';
exit();
//*/

/**
 * Include the global config (required)
 */
require_once BASICBOOTSTRAP_BASEPATH . 'includes/basicbootstrap.php';

/*/
// the functions for debugging ...
basicbootstrap_load_library('dev-lib');
//*/

/**
 * Load the setup class (required)
 */
basicbootstrap_load_class('WP_Basic_Bootstrap_Setup');

/**
 * Initialize the theme
 */
WP_Basic_Bootstrap_Setup::init();

/**
 * Set up theme defaults and registers support for various WordPress features.
 *
 * @uses WP_Basic_Bootstrap_Setup::setupCommon()
 * @uses WP_Basic_Bootstrap_Setup::setupBackend()
 * @uses WP_Basic_Bootstrap_Setup::setupFrontend()
 */
add_action('after_setup_theme', function () {
    WP_Basic_Bootstrap_Setup::setupCommon();
    if (is_admin()) {
        WP_Basic_Bootstrap_Setup::setupBackend();
    } else {
        WP_Basic_Bootstrap_Setup::setupFrontend();
    }
});

/**
 * Enqueue scripts and styles for front-end.
 *
 * @uses WP_Basic_Bootstrap_Setup::enqueueScriptsFrontend()
 */
add_action('wp_enqueue_scripts', array('WP_Basic_Bootstrap_Setup', 'enqueueScriptsFrontend'));

/**
 * Enqueue scripts and styles for back-end.
 *
 * @uses WP_Basic_Bootstrap_Setup::enqueueScriptsBackend()
 */
add_action('admin_enqueue_scripts', array('WP_Basic_Bootstrap_Setup', 'enqueueScriptsBackend'));

/**
 * Register widgetized areas, including main sidebar and three widget-ready columns in the footer.
 *
 * @uses WP_Basic_Bootstrap_Setup::widgetsInit()
 */
add_action('widgets_init', array('WP_Basic_Bootstrap_Setup', 'widgetsInit'));

/**
 * Register theme customizer
 *
 * @uses WP_Basic_Bootstrap_Customizer::register()
 * @uses WP_Basic_Bootstrap_Customizer::livePreview()
 * @uses WP_Basic_Bootstrap_Customizer::headerOutput()
 */
basicbootstrap_load_class('WP_Basic_Bootstrap_Customizer');
add_action('customize_register', array('WP_Basic_Bootstrap_Customizer', 'register'));
add_action('customize_preview_init', array('WP_Basic_Bootstrap_Customizer', 'livePreview'));
add_action('wp_head', array('WP_Basic_Bootstrap_Customizer', 'headerOutput'));

/**
 * New 403 & 401 error pages micro-plugin
 *
 * The `wp_title` filter is documented in `wp-includes/general-template.php`.
 * The `body_class` filter is documented in `wp-includes/post-template.php`.
 *
 * @uses basicbootstrap_error_pages()
 * @uses basicbootstrap_error_title()
 * @uses basicbootstrap_error_class()
 */
basicbootstrap_load_library('error-pages');
add_action('wp', 'basicbootstrap_error_pages');
add_filter('wp_title', 'basicbootstrap_error_title', 100, 2);
add_filter('body_class', 'basicbootstrap_error_class');

/**
 * Manage global redirections
 *
 * @uses basicbootstrap_template_redirect()
 */
add_action('template_redirect', 'basicbootstrap_template_redirect', 1);

/**
 * Define the excerpts length
 *
 * The `excerpt_length` filter is documented in `wp-includes/formatting.php`.
 *
 * @uses basicbootstrap_excerpt_length()
 */
add_filter('excerpt_length', 'basicbootstrap_excerpt_length');

/**
 * Get the post excerpt adding the "read more" tag if enabled and needed
 *
 * The `wp_trim_excerpt` filter is documented in `wp-includes/formatting.php`.
 *
 * @uses basicbootstrap_excerpt()
 */
add_filter('wp_trim_excerpt', 'basicbootstrap_excerpt');

/**
 * Replaces the default "more" links
 *
 * The `excerpt_more` filter is documented in `wp-includes/formatting.php`.
 * The `the_content_more_link` filter is documented in `wp-includes/post-template.php`.
 *
 * @uses basicbootstrap_read_more_link()
 */
add_filter('excerpt_more', 'basicbootstrap_read_more_link');
add_filter('the_content_more_link', 'basicbootstrap_read_more_link');

/**
 * Process shortcodes in excerpt
 *
 * The `the_excerpt` filter is documented in `wp-includes/post-template.php`.
 */
add_filter('the_excerpt', 'do_shortcode');

/**
 * Include the custom user CSS in header if so
 */
add_action('wp_head', 'basicbootstrap_include_custom_css_code');

/**
 * Use a customized password form for protected posts
 */
add_filter('the_password_form', 'basicbootstrap_get_the_password_form');

/**
 * Do not add 'protected: ' behind post title when thay are protected
 */
add_filter('protected_title_format', 'basicbootstrap_get_default_password_post_title', 10, 2);

/**
 * Filter the comments popup link attributes for display.
 */
add_filter('comments_popup_link_attributes', 'basicbootstrap_comments_popup_link_attributes');


/**
 * Helper function for wp_link_pages().
 *
 * @since 3.1.0
 * @access private
 *
 * @global WP_Rewrite $wp_rewrite WordPress rewrite component.
 *
 * @param int $i Page number.
 * @return string Link.
 */
function bbs_wp_link_page_pager_item( $i ) {
    global $wp_rewrite;
    $post       = get_post();
    $query_args = array();

    if ( 1 == $i ) {
        $url = get_permalink();
    } else {
        if ( ! get_option( 'permalink_structure' ) || in_array( $post->post_status, array( 'draft', 'pending' ), true ) ) {
            $url = add_query_arg( 'page', $i, get_permalink() );
        } elseif ( 'page' === get_option( 'show_on_front' ) && get_option( 'page_on_front' ) == $post->ID ) {
            $url = trailingslashit( get_permalink() ) . user_trailingslashit( "$wp_rewrite->pagination_base/" . $i, 'single_paged' );
        } else {
            $url = trailingslashit( get_permalink() ) . user_trailingslashit( $i, 'single_paged' );
        }
    }

    if ( is_preview() ) {

        if ( ( 'draft' !== $post->post_status ) && isset( $_GET['preview_id'], $_GET['preview_nonce'] ) ) {
            $query_args['preview_id']    = wp_unslash( $_GET['preview_id'] );
            $query_args['preview_nonce'] = wp_unslash( $_GET['preview_nonce'] );
        }

        $url = get_preview_post_link( $post, $query_args, $url );
    }

    return '<a href="' . esc_url( $url ) . '" class="page-link post-page-numbers">';
}
