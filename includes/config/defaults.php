<?php
/**
 * This file defines the default configuration of the theme
 *
 * WARNING - Translation files are not yet loaded here so the translation process
 * must be done on data loading.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * The global configuration table
 */
global $basicbootstrap_config;
$basicbootstrap_config = array(

    // defaults theme mods
    'defaults'              => array(
        'copyright_text'        => '<a href="http://wordpress.org/">Wordpress</a> <a href="http://github.com/e-picas/wp-basic-bootstrap">Basic Bootstrap</a> theme built with love by <a href="https://picas.fr/">@picas</a>.',
        'content_width'         => 850,
        'site_icon_size'        => 96,
        'excerpt_max_length'    => 55,
        'read_more'             => ' &hellip;',
        'body_fontfamily'       => 'arial, helvetica, sans-serif',
        'headings_fontfamily'   => 'arial, helvetica, sans-serif',
        'menu_fontfamily'       => 'verdana, geneva, sans-serif',
        'display_header'        => true,
        'display_header_logo'   => true,
        'display_header_searchbox' => true,
        'display_footer_copyright' => true,
        'body_textcolor'        => '#555',
        'link_textcolor'        => '#428bca',
        'hover_textcolor'       => '#23527c',
        'headings_textcolor'    => '#333',
        'primary_menucolor'     => '#428bca',
        'primary_linkcolor'     => '#ecf0f1',
        'primary_hovercolor'    => '#fff',
        'primary_hoverbackground' => '#15548c',
        'primary_activecolor'   => '#fff',
        'primary_activebackground' => '#15548c',
        'dropdown_menucolor'    => '#428bca',
        'dropdown_linkcolor'    => '#ecf0f1',
        'dropdown_hovercolor'   => '#fff',
        'dropdown_hoverbackground' => '#15548c',
        'dropdown_activecolor'  => '#fff',
        'dropdown_activebackground' => '#15548c',
        'footer_textcolor'      => '#999',
        'footer_linkcolor'      => '#428bca',
        'footer_hovercolor'     => '#23527c',
        'footer_backgroundcolor' => '#f9f9f9',
        'navbar_type'           => 'default',
        'navbar_style'          => 'inverse',
        'show_navbar_brand'     => true,
        'show_post_excerpt'     => true,
        'visible_breadcrumb'    => true,
        'blog_pages_layout'     => 'right_sidebar',
        'not_blog_pages_layout' => 'right_sidebar',
        'posts_lists_layout'    => '2_cols',
        'numerical_pagination_limit' => 5,
        'show_read_more_buttons' => false,
        'sticky_posts_to_show'  => 1,
        'sticky_posts_excerpt_max_length'  => 120,
        'display_social_icons'  => true,
        'rss_url'               => '/feed/',
        'show_author_meta'      => true,
        'show_pubdate_meta'     => true,
        'show_moddate_meta'     => true,
        'show_post_format_meta' => true,
        'show_post_cats'        => true,
        'show_post_tags'        => true,
        'show_comments_link'    => true,
        'show_permalink'        => true,
        'show_edit_links'       => true,
        'show_edit_comment_links' => true,
        'show_attachment_mime_type' => true,
        'show_attachment_sizes' => true,
        'show_attachment_link' => true,
        'show_sharing_links_page' => false,
        'show_sharing_links_post' => true,
        'show_sharing_links_attachment' => true,
        'show_author_posts_number' => true,
        'show_protected_posts'  => false,
    ),

    // custom header settings
    'custom-header'         => array(
        'width'                  => 980,
        'height'                 => 170,
        'flex-height'            => true,
        'flex-width'             => true,
        'default-text-color'     => '333',
    ),

    // custom background settings
    'custom-background'      => array(
        'default-color'          => 'fff',
    ),

    // post formats supported
    'post-formats'          => array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'),

    // HTML5 supported features
    'html5'                 => array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption'),

    // add default posts and comments RSS feed links to head
    'automatic-feed-links'  => true,

    // this theme does not hard-code document title tag to HTML <head>
    'title-tag'             => true,

    // this theme uses post thumbnails
    'post-thumbnails'       => true,

    // theme image sizes
    'image_sizes'           => array(
        'post_thumbnails'       => array(
            'width'                 => 950,
            'height'                => 580,
            'crop'                  => true,
        ),
        'featured_tile'         => array(
            'width'                 => 243,
            'height'                => 243,
            'crop'                  => true,
        ),
        'small_tile'            => array(
            'width'                 => 36,
            'height'                => 36,
            'crop'                  => true,
        ),
    ),

    // navigation menus of the theme
    'nav_menus'             => array(
        'main-menu'             => __('Main Menu', 'basicbootstrap'),
        'social-menu'           => __('Social Links Menu', 'basicbootstrap'),
        'footer-menu'           => __('Footer Menu', 'basicbootstrap'),
    ),

    // sidebars
    'sidebars'              => array(
        // Area 1, located at the top of the sidebar.
        array(
            'name'          => __('Primary Widget Area', 'basicbootstrap'),
            'id'            => 'primary-widget-area',
            'description'   => __('Add widgets here to appear in your sidebar.', 'basicbootstrap'),
            'before_widget' => '<div id="%1$s" class="sidebar-module widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4>',
            'after_title'   => '</h4>',
        ),
        // Area 2, located in the footer. Empty by default.
        array(
            'name'          => __('First Footer Widget Area', 'basicbootstrap'),
            'id'            => 'first-footer-widget-area',
            'description'   => __('An optional widget area for your site footer.', 'basicbootstrap'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ),
        // Area 3, located in the footer. Empty by default.
        array(
            'name'          => __('Second Footer Widget Area', 'basicbootstrap'),
            'id'            => 'second-footer-widget-area',
            'description'   => __('An optional widget area for your site footer.', 'basicbootstrap'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ),
        // Area 4, located in the footer. Empty by default.
        array(
            'name'          => __('Third Footer Widget Area', 'basicbootstrap'),
            'id'            => 'third-footer-widget-area',
            'description'   => __('An optional widget area for your site footer.', 'basicbootstrap'),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ),
    ),

    // icons per post format
    'post_format_icon'      => array(
        'aside'                 => 'dot-circle-o',
        'audio'                 => 'headphones',
        'chat'                  => 'commenting',
        'gallery'               => 'th-large',
        'image'                 => 'camera-retro',
        'link'                  => 'link',
        'quote'                 => 'quote-right',
        'status'                => 'map-marker',
        'video'                 => 'video-camera',
    ),

    // required_plugins for TGM
    'required_plugins'      => array(
        array(
            'name'               => 'Meta Box',
            'slug'               => 'meta-box',
            'required'           => true,
            'force_activation'   => true,
            'force_deactivation' => false,
        ),
        array(
            'name'               => 'Bootstrap 3 Shortcodes',
            'slug'               => 'bootstrap-3-shortcodes',
            'required'           => false,
        ),
        array(
            'name'               => 'Font Awesome Shortcodes',
            'slug'               => 'font-awesome-shortcodes',
            'required'           => false,
        ),
        array(
            'name'               => 'Multiple Favicons',
            'slug'               => 'multicons',
            'required'           => false,
        ),
    ),

    'available_fonts' => array(
        'arial, helvetica, sans-serif'                     => 'Arial',
        'arial black, gadget, sans-serif'                  => 'Arial Black',
        'comic sans ms, cursive, sans-serif'               => 'Comic Sans MS',
        'courier new, courier, monospace'                  => 'Courier New',
        'georgia, serif'                                   => 'Georgia',
        'impact, charcoal, sans-serif'                     => 'Impact',
        'lucida console, monaco, monospace'                => 'Lucida Console',
        'lucida sans unicode, lucida grande, sans-serif'   => 'Lucida Sans Unicode',
        'palatino linotype, book antiqua, palatino, serif' => 'Palatino Linotype',
        'tahoma, geneva, sans-serif'                       => 'Tahoma',
        'times new roman, times, serif'                    => 'Times New Roman',
        'trebuchet ms, helvetica, sans-serif'              => 'Trebuchet MS',
        'verdana, geneva, sans-serif'                      => 'Verdana',
    ),

    'css' => array(
        'bootstrap' => array(
            'uri'           =>
                BASICBOOTSTRAP_USE_CDN == true ?
                    'https://cdn.jsdelivr.net/npm/bootstrap@'.BASICBOOTSTRAP_BOOTSTRAP_VERSION.'/dist/css/bootstrap.min.css'
                    : get_asset_uri('assets/css/bootstrap-custom.css'),
//                    : get_asset_uri('assets/css/bootstrap.min.css'),
            'version'       => BASICBOOTSTRAP_BOOTSTRAP_VERSION
        ),
        'fontawesome' => array(
            'uri'           =>
                BASICBOOTSTRAP_USE_CDN == true ?
                    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/'.BASICBOOTSTRAP_FONTAWESOME_VERSION.'/css/all.min.css'
                    : get_asset_uri('assets/css/fontawesome-all.min.css'),
            'version'       => BASICBOOTSTRAP_FONTAWESOME_VERSION
        ),
        'basicbootstrap-base-styles' => array(
            'uri'           => get_asset_uri('assets/css/blog.css'),
            'version'       => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('bootstrap', 'fontawesome')
        ),
        'basicbootstrap-styles' => array(
            'uri'           => get_stylesheet_uri(),
            'version'       => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('basicbootstrap-base-styles')
        ),
        'basicbootstrap-styles-print' => array(
            'uri'           => get_asset_uri('style_print.css'),
            'version'       => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('basicbootstrap-base-styles'),
            'media'         => 'print'
        ),
    ),

    'js' => array(
        'popper' => array(
            'uri'           =>
                BASICBOOTSTRAP_USE_CDN == true ?
                    'https://cdn.jsdelivr.net/npm/popper.js@'.BASICBOOTSTRAP_POPPER_VERSION.'/dist/umd/popper.min.js'
                    : get_asset_uri('assets/js/popper.min.js'),
            'version'       => BASICBOOTSTRAP_POPPER_VERSION,
        ),
        'bootstrap' => array(
            'uri'           =>
                BASICBOOTSTRAP_USE_CDN == true ?
                    'https://cdn.jsdelivr.net/npm/bootstrap@'.BASICBOOTSTRAP_BOOTSTRAP_VERSION.'/dist/js/bootstrap.min.js'
                    : get_asset_uri('assets/js/bootstrap.min.js'),
            'version'       => BASICBOOTSTRAP_BOOTSTRAP_VERSION,
            'dependencies'  => array('jquery','popper')
        ),
        'respond-js' => array(
            'uri'           => get_asset_uri('assets/js/respond.min.js'),
            'version'       => '1.4.2',
            'in_footer'     => false,
            'dependencies'  => array('jquery'),
        ),
        'basicbootstrap-base-scripts' => array(
            'uri'           => get_asset_uri('assets/js/blog.js'),
            'version'       => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('jquery', 'bootstrap')
        ),
        'basicbootstrap-scripts' => array(
            'uri'           => get_asset_uri('scripts.js'),
            'version'       => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('jquery', 'bootstrap')
        ),
    ),

);
