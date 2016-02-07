<?php
/**
 * This file defines the default customizer configuration of the theme
 *
 * WARNING - Translation files are not yet loaded here so the translation process
 * must be done on data loading.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$available_fonts = basicbootstrap_get_config('available_fonts');

/**
 * The customizer configuration table
 *
 * ## Map
 *
 * -    theme styling: colors, fonts, background image, header image, navbar
 * -    theme layout: pages layout, show/hide
 * -    theme templating: content options
 *
 */
global $basicbootstrap_customizer_config;
$basicbootstrap_customizer_config = array(

    // enhance the default title_tagline
    'title_tagline' => array(
        'object' => 'settings',

        // update site identity in real time
        array(
            'id' => 'blogname',
            'transport' => 'postMessage',
        ),
        array(
            'id' => 'blogdescription',
            'transport' => 'postMessage',
        ),

        // copyright text
        array(
            'id' => 'copyright_text',
            'label' => __('Copyright text', 'basicbootstrap'),
            'sanitize_callback' => 'sanitize_simple_html_field',
            'priority' => 52,
        ),

    ), // end title_tagline settings

    // fonts settings
    'basicbootstrap_fonts' => array(
        'object' => 'section',
        'title' => __( 'Fonts', 'basicbootstrap' ),
        'settings' => array(

            array(
                'id' => 'body_fontfamily',
                'label' => __('Body Text Font', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => $available_fonts,
                'sanitize_callback' => 'sanitize_font_selection',
            ),
            array(
                'id' => 'headings_fontfamily',
                'label' => __('Headings Font', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => $available_fonts,
                'sanitize_callback' => 'sanitize_font_selection',
            ),
            array(
                'id' => 'menu_fontfamily',
                'label' => __('Menu Font', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => $available_fonts,
                'sanitize_callback' => 'sanitize_font_selection',
            ),

        ), // end basicbootstrap_fonts section settings
    ), // end basicbootstrap_fonts section

    // add custom color settings
    'colors' => array(
        'object' => 'settings',

        array(
            'id' => 'header_textcolor',
            'transport' => 'postMessage',
            'section' => 'colors',
        ),
        array(
            'id' => 'body_textcolor',
            'label' => __('Text Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'link_textcolor',
            'label' => __('Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'hover_textcolor',
            'label' => __('Hover Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'headings_textcolor',
            'label' => __('Headings Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'primary_menucolor',
            'label' => __('Primary Menu Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'primary_linkcolor',
            'label' => __('Primary Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'primary_hovercolor',
            'label' => __('Primary Hover Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'primary_activecolor',
            'label' => __('Primary Active Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'primary_activebackground',
            'label' => __('Primary Active Background Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'dropdown_menucolor',
            'label' => __('Dropdown Menu Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'dropdown_linkcolor',
            'label' => __('Dropdown Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'dropdown_hovercolor',
            'label' => __('Dropdown Hover Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'dropdown_hoverbackground',
            'label' => __('Dropdown Hover Background Color', 'basicbootstrap'),
            'transport' => 'refresh',
            'control_type' => 'color',
        ),
        array(
            'id' => 'dropdown_activecolor',
            'label' => __('Dropdown Active Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'dropdown_activebackground',
            'label' => __('Dropdown Active Background Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'footer_textcolor',
            'label' => __('Footer Text Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'footer_linkcolor',
            'label' => __('Footer Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'footer_hovercolor',
            'label' => __('Footer Hover Link Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),
        array(
            'id' => 'footer_backgroundcolor',
            'label' => __('Footer Background Color', 'basicbootstrap'),
            'control_type' => 'color',
        ),

    ), // end color_settings settings

    // the pages layout section
    'basicbootstrap_layout_page' => array(
        'object' => 'section',
        'title' => __('Pages Layout', 'basicbootstrap'),
        'description' => __('You can set here the default layouts used for blog pages (any post page) and others (any page that is not a post: home, pages, search ...).', 'basicbootstrap'),
        'priority' => 1,
        'settings' => array(

            array(
                'id' => 'blog_pages_layout',
                'label' => __('Blog Pages Default Template', 'basicbootstrap'),
                'description' => __('Select here the default template for BLOG PAGES.', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    'full_width' => __('Full Width', 'basicbootstrap'),
                    'full_width_offset' => __('Full Width With Offset', 'basicbootstrap'),
                    'left_sidebar' => __('Left Sidebar', 'basicbootstrap'),
                    'right_sidebar' => __('Right Sidebar', 'basicbootstrap'),
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'not_blog_pages_layout',
                'label' => __('Other Pages Default Template', 'basicbootstrap'),
                'description' => __('Select here the default template for NON-BLOG PAGES.', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    'full_width' => __('Full Width', 'basicbootstrap'),
                    'full_width_offset' => __('Full Width With Offset', 'basicbootstrap'),
                    'left_sidebar' => __('Left Sidebar', 'basicbootstrap'),
                    'right_sidebar' => __('Right Sidebar', 'basicbootstrap'),
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'posts_lists_layout',
                'label' => __('Posts Lists Template', 'basicbootstrap'),
                'description' => __('Select here the number of columns used for posts lists.', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    '1_col' => __('One Column', 'basicbootstrap'),
                    '2_cols' => __('Two Columns', 'basicbootstrap'),
                    '3_cols' => __('Three Columns', 'basicbootstrap'),
                ),
                'transport' => 'refresh',
            ),

        ), // end basicbootstrap_layout_page settings
    ), // end basicbootstrap_layout_page section

    // the navbar layout section
    'basicbootstrap_layout_navbar' => array(
        'object' => 'section',
        'title' => __('Navbar Layout', 'basicbootstrap'),
        'description' => __('You can set here the default layouts your website main navigation bar.', 'basicbootstrap'),
        'priority' => 2,
        'settings' => array(

            array(
                'id' => 'navbar_type',
                'label' => __('Navbar Position', 'basicbootstrap'),
                'description' => __('You can define here the type of your navbar (for more info, see <a href="http://getbootstrap.com/components/#navbar">getbootstrap.com</a>).', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    'default' => __('Default Classic Navbar', 'basicbootstrap'),
                    'fixed_top' => __('Fixed to Top Navbar', 'basicbootstrap'),
                    'fixed_bottom' => __('Fixed to Bottom Navbar', 'basicbootstrap'),
                    'static_top' => __('Static Top Navbar', 'basicbootstrap'),
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'navbar_style',
                'label' => __('Navbar Styling', 'basicbootstrap'),
                'description' => __('You can define here the style of your navbar (for more info, see <a href="http://getbootstrap.com/components/#navbar">getbootstrap.com</a>).', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    'default' => __('Default Classic Navbar', 'basicbootstrap'),
                    'inverse' => __('Inverted Navbar', 'basicbootstrap'),
                    'custom' => __('Custom Navbar (navbar-custom class)', 'basicbootstrap'),
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'show_navbar_brand',
                'label' => __('Show Navbar Brand', 'basicbootstrap'),
                'description' => __('This will display the site name as first information of the navigation bar.', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

        ), // end basicbootstrap_layout_navbar settings
    ), // end basicbootstrap_layout_navbar section

    // the body styling section
    'basicbootstrap_templating_body' => array(
        'object' => 'section',
        'title' => __('Content Templating', 'basicbootstrap'),
        'description' => __('You can here define the look of your pages main contents.', 'basicbootstrap'),
        'settings' => array(

            array(
                'id' => 'visible_breadcrumb',
                'label' => __('Visible Breadcrumb (hidden otherwise)', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

            array(
                'id' => 'show_post_excerpt',
                'label' => __('Use Post Excerpts as Intro', 'basicbootstrap'),
                'description' => __('This will show the excerpt as the introduction of a post on the post page if it is defined.', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

            array(
                'id' => 'excerpt_max_length',
                'label' => __('Excerpt Length', 'basicbootstrap'),
                'description' => __('This will set the number of words extracted from a post content to generate its excerpt in posts list.', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    '55' => '55',
                    '75' => '75',
                    '100' => '100',
                    '120' => '120',
                    '140' => '140',
                    '160' => '160',
                    '180' => '180',
                    '200' => '200',
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'read_more',
                'label' => __('Read More Text', 'basicbootstrap'),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'show_read_more_buttons',
                'label' => __('Show Read More Buttons', 'basicbootstrap'),
                'description' => __('Add a "read more" button to posts excerpts in lists.', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

            array(
                'id' => 'sticky_posts_to_show',
                'label' => __('Sticky Posts To Show', 'basicbootstrap'),
                'description' => __('This will set the number of sticky posts shown as featured (0 will disable this feature).', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    '0' => '0',
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'sticky_posts_excerpt_max_length',
                'label' => __('Sticky Excerpt Length', 'basicbootstrap'),
                'description' => __('This will set the number of words extracted from a sticky post content to generate its excerpt on the sticky post view.', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    '55' => '55',
                    '75' => '75',
                    '100' => '100',
                    '120' => '120',
                    '140' => '140',
                    '160' => '160',
                    '180' => '180',
                    '200' => '200',
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'numerical_pagination_limit',
                'label' => __('Pagination Limit', 'basicbootstrap'),
                'description' => __('This will set the number of pages to show before AND after current one in numerical pagination.', 'basicbootstrap'),
                'control_type' => 'select',
                'choices' => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                    '5' => '5',
                    '6' => '6',
                    '7' => '7',
                    '8' => '8',
                    '9' => '9',
                    '10' => '10',
                ),
                'transport' => 'refresh',
            ),

            array(
                'id' => 'show_sharing_links_page',
                'label' => __('Show Sharing Links on Pages', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_sharing_links_post',
                'label' => __('Show Sharing Links on Posts', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_sharing_links_attachment',
                'label' => __('Show Sharing Links on Attachments', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

        ), // end basicbootstrap_templating_body settings
    ), // end basicbootstrap_templating_body section

    'basicbootstrap_templating_header_footer' => array(
        'object' => 'section',
        'title' => __('Header & Footer Templating', 'basicbootstrap'),
        'description' => __('You can here show or hide some of the blocks of the default header and footer templating construction.', 'basicbootstrap'),
        'settings' => array(

            array(
                'id' => 'display_header_text',
                'transport' => 'refresh',
            ),

            // hide logo in header
            array(
                'id' => 'display_header_logo',
                'label' => __('Display Header Logo', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

            array(
                'id' => 'display_footer_copyright',
                'label' => __('Display Footer Copyright', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

            array(
                'id' => 'display_header_searchbox',
                'label' => __('Display Header Searchbox', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

        ), // end basicbootstrap_templating_header_footer settings
    ), // end basicbootstrap_templating_header_footer section

    'basicbootstrap_templating_meta_data' => array(
        'object' => 'section',
        'title' => __('Contents Meta-Data', 'basicbootstrap'),
        'description' => __('You can here show or hide some of your website contents meta-data.', 'basicbootstrap'),
        'settings' => array(

            array(
                'id' => 'show_author_meta',
                'label' => __('Show Author', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_pubdate_meta',
                'label' => __('Show Publication Date', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_moddate_meta',
                'label' => __('Show Last Update Date', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_post_format_meta',
                'label' => __('Show Post Format', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_post_cats',
                'label' => __('Show Post Categories', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_post_tags',
                'label' => __('Show Post Tags', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_comments_link',
                'label' => __('Show Comments Link', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_permalink',
                'label' => __('Show Permalink', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_edit_links',
                'label' => __('Show Edit Links', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_edit_comment_links',
                'label' => __('Show Edit Comment Links', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_attachment_mime_type',
                'label' => __('Show Attachments MIME Types', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_attachment_sizes',
                'label' => __('Show Attachment Sizes', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_attachment_link',
                'label' => __('Show Attachment Link', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),
            array(
                'id' => 'show_author_posts_number',
                'label' => __('Show Author Posts Number', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

        ), // end basicbootstrap_templating_meta_data settings
    ), // end basicbootstrap_templating_meta_data section

    // the styling panel
    'basicbootstrap_styling' => array(
        'object' => 'panel',
        'title' => __('Theme Styling', 'basicbootstrap'),
        'description' => __('You can here define some style options of your theme.', 'basicbootstrap'),
        'priority' => 121,
        'sections' => array(
            // fonts settings
            array(
                'id' => 'basicbootstrap_fonts',
            ),
            // move the colors in this panel
            array(
                'id' => 'colors'
            ),
            // move the header_image in this panel
            array(
                'id' => 'header_image'
            ),
            // move the background_image in this panel
            array(
                'id' => 'background_image'
            ),

        ), // end basicbootstrap_styling sections
    ), // end basicbootstrap_styling panel

    'basicbootstrap_templating' => array(
        'object' => 'panel',
        'title' => __('Theme Templating', 'basicbootstrap'),
        'description' => __('You can here show or hide some of the blocks of the default templating construction. You can also define the look of the navigation bar.', 'basicbootstrap'),
        'priority' => 122,
        'sections' => array(

            array(
                'id' => 'basicbootstrap_templating_header_footer',
            ),
            array(
                'id' => 'basicbootstrap_templating_body',
            ),
            array(
                'id' => 'basicbootstrap_templating_meta_data',
            ),

        ), // end basicbootstrap_templating sections
    ), // end basicbootstrap_templating panel

    'basicbootstrap_layout' => array(
        'object' => 'panel',
        'title' => __('Theme Layout', 'basicbootstrap'),
        'description' => __('You can set here various settings to customize your website global rendering.', 'basicbootstrap'),
        'priority' => 123,
        'sections' => array(

            // basicbootstrap_layout_page section
            array(
                'id' => 'basicbootstrap_layout_page',
            ),

            array(
                'id' => 'basicbootstrap_layout_navbar',
            ),

        ), // end basicbootstrap_layout sections
    ), // end basicbootstrap_layout panel

    'social_links' => array(
        'object' => 'section',
        'priority' => 90,
        'title' => __('Social Links', 'basicbootstrap'),
        'description' => __('Settings for the social icons navbar menu. If you want to hide an icon then leave it blank.', 'basicbootstrap'),
        'settings' => array(

            array(
                'id' => 'display_social_icons',
                'label' => __('Display Automatic Social Icons', 'basicbootstrap'),
                'description' => __('Disable this to use a custom user menu instead.', 'basicbootstrap'),
                'control_type' => 'checkbox',
                'transport' => 'refresh',
            ),

            'facebook_url' => array(
                'label' => __('Facebook URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'twitter_url' => array(
                'label' => __('Twitter URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'google_plus_url' => array(
                'label' => __('Google+ URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'linkedin_url' => array(
                'label' => __('LinkedIn URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'skype_url' => array(
                'label' => __('Skype URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'pinterest_url' => array(
                'label' => __('Pinterest URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'youtube_url' => array(
                'label' => __('YouTube URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'vimedo_url' => array(
                'label' => __('Vimeo URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'dribbble_url' => array(
                'label' => __('Dribbble URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'flickr_url' => array(
                'label' => __('Flickr URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'tumblr_url' => array(
                'label' => __('Tumblr URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'github_url' => array(
                'label' => __('Github URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'instagram_url' => array(
                'label' => __('Instagram URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'stack_overflow_url' => array(
                'label' => __('Stack Overflow URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'stack_exchange_url' => array(
                'label' => __('Stack Exchange URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'diaspora_url' => array(
                'label' => __('Diaspora URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
            ),

            'rss_url' => array(
                'label' => __('RSS URL', 'basicbootstrap'),
                'sanitize_callback' => 'esc_url_raw',
                'description' => __('By default it should be <code>/feed/</code>', 'basicbootstrap'),
                'default' => '/feed/'
            ),

        ), // end social_links settings
    ), // end social_links section


    'custom_css_section' => array(
        'object' => 'section',
        'title' => __('Custom Code', 'basicbootstrap'),
        'description' => __('Use this section to enter your custom CSS code. It will be included in the head section of the site.', 'basicbootstrap'),
        'priority' => 200,
        'settings' => array(

            array(
                'id' => 'custom_css',
                'sanitize_callback'    => 'wp_filter_nohtml_kses',
                'label' => __('Custom CSS', 'basicbootstrap'),
                'control_type' => 'textarea',
                'transport' => 'refresh',
            ),

        ), // end custom_css settings
    ), // end custom_css section

);
