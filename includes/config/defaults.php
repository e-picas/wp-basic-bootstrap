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
        'primary_linkcolor'     => '#cdddeb',
        'primary_hovercolor'    => '#fff',
        'primary_activecolor'   => '#fff',
        'primary_activebackground' => '#428bca',
        'dropdown_menucolor'    => '#fff',
        'dropdown_linkcolor'    => '#333',
        'dropdown_hovercolor'   => '#333',
        'dropdown_hoverbackground' => '#f5f5f5',
        'dropdown_activecolor'  => '#fff',
        'dropdown_activebackground' => '#080808',
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
    'custom_header'         => array(
        'width'                  => 980,
        'height'                 => 170,
        'flex-height'            => true,
        'flex-width'             => true,
        'default-text-color'     => '333',
    ),

    // custom background settings
    'custom_background'      => array(
        'default-color'          => 'fff',
    ),

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

);
