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

    // theme image CSS class
    'image_class'               => 'img-fluid',

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
        'aside'                 => 'dot-circle',
        'audio'                 => 'headphones',
        'chat'                  => 'comment-dots',
        'gallery'               => 'th-large',
        'image'                 => 'camera-retro',
        'link'                  => 'link',
        'quote'                 => 'quote-right',
        'status'                => 'map-marker',
        'video'                 => 'video',
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
            'uri'       => get_asset_uri('assets/dist/bootstrap-fontawesome.bundle.min.css'),
            'uri-npm'   => get_asset_uri('node_modules/bootstrap/dist/css/bootstrap.min.css'),
            'uri-cdn'   => 'https://cdn.jsdelivr.net/npm/bootstrap@'.BASICBOOTSTRAP_BOOTSTRAP_VERSION.'/dist/css/bootstrap.min.css',
            'version'   => BASICBOOTSTRAP_BOOTSTRAP_VERSION
        ),

        'fontawesome' => array(
            'uri'       => false,
            'uri-npm'   => get_asset_uri('node_modules/fontawesome-free/css/all.min.css'),
            'uri-cdn'   => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/'.BASICBOOTSTRAP_FONTAWESOME_VERSION.'/css/all.min.css',
            'version'   => BASICBOOTSTRAP_FONTAWESOME_VERSION
        ),

        'wp-basic-bootstrap' => array(
            'uri'       => get_asset_uri('assets/css/wp-basic-bootstrap.css'),
            'version'   => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('bootstrap','fontawesome')
        ),

        'wp-basic-bootstrap-style' => array(
            'uri'       => get_asset_uri('style.css'),
            'version'   => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('wp-basic-bootstrap')
        ),

        'wp-basic-bootstrap-style-print' => array(
            'uri'       => get_asset_uri('style_print.css'),
            'version'   => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('wp-basic-bootstrap-style'),
            'media'     => 'print'
        ),

    ),

    'js' => array(

        'jquery-core' => array(
            'uri'       => false,
            'uri-npm'   => get_asset_uri('node_modules/jquery/dist/jquery.min.js'),
            'uri-cdn'   => 'https://cdn.jsdelivr.net/npm/jquery@'.BASICBOOTSTRAP_JQUERY_VERSION.'/dist/jquery.min.js',
            'version'   => BASICBOOTSTRAP_JQUERY_VERSION,
            'replace_original' => true
        ),

        'jquery' => array(
            'uri'       => false,
            'dependencies'  => array('jquery-core'),
            'version'   => BASICBOOTSTRAP_JQUERY_VERSION,
            'replace_original' => true
        ),

        'bootstrap' => array(
            'uri' => get_asset_uri('assets/dist/jquery-popper-bootstrap.bundle.min.js'),
            'uri-npm' => get_asset_uri('node_modules/bootstrap/dist/js/bootstrap.bundle.min.js'),
            'uri-cdn' => 'https://cdn.jsdelivr.net/npm/bootstrap@'.BASICBOOTSTRAP_BOOTSTRAP_VERSION.'/dist/js/bootstrap.bundle.min.js',
            'version' => BASICBOOTSTRAP_BOOTSTRAP_VERSION,
            'dependencies'  => array('jquery')
        ),

        'wp-basic-bootstrap' => array(
            'uri' => get_asset_uri('assets/js/wp-basic-bootstrap.js'),
            'version' => BASICBOOTSTRAP_VERSION,
            'dependencies'  => array('bootstrap')
        ),

    ),

);
