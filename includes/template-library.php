<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

// THEME MODS

/**
 * Get a theme modification setting with fallback to its default value
 *
 * @uses get_theme_mod()
 * @param $name
 * @return string
 */
function get_basicbootstrap_mod($name)
{
    $defaults = basicbootstrap_get_config('defaults');
    $mod = get_theme_mod(
        $name,
        isset($defaults[$name]) ? $defaults[$name] : false
    );
    if (!empty($mod) && is_string($mod) && $mod == 'blank') {
        $mod = false;
    }
    return $mod;
}

/**
 * Get the template type to apply for current posts list
 *
 * @return false|string
 */
function get_posts_list_layout()
{
    $layout = get_basicbootstrap_mod('posts_lists_layout');

    /**
     * Filter the posts lists layout
     *
     * @since WP_Basic_Bootstrap 1.0
     *
     * @param mixed $layout The given layout
     * @return mixed Must return the layout to use
     */
    $layout = apply_filters('posts_list_layout', $layout);

    return $layout;
}

/**
 * Get the template type to apply for current page in: `full_width`, `full_width_offest`, `right_sidebar`, `left_sidebar`
 *
 * @uses is_active_sidebar()
 * @return false|string
 */
function get_template_type()
{
    global $template_type;
    if (!isset($template_type)) {
        $current = get_page_template_slug();
        if (!empty($current)) {
            $template_type = (
                $current == 'default' ?
                    get_basicbootstrap_mod('not_blog_pages_layout') :
                    str_replace(array('page-templates/', '.php'), '', $current)
            );
        } elseif (! is_blog_page()) {
            $template_type = get_basicbootstrap_mod('not_blog_pages_layout');
        } else {
            $template_type = get_basicbootstrap_mod('blog_pages_layout');
        }
        if (strpos($template_type, 'sidebar') !== false && ! is_active_sidebar('primary-widget-area')) {
            $template_type = 'full_width';
        }
    }
    return $template_type;
}

/**
 * Get a Font Awesome icon for each post format
 *
 * @param $format
 * @return null|string
 */
function get_post_format_icon($format)
{
    $icons = basicbootstrap_get_config('post_format_icon');
    return isset($icons[$format]) ? $icons[$format] : null;
}

/**
 * Retrieve a configuration entry for image sizes
 *
 * Returned array is like:
 *
 *      array(
 *          0 => <width>
 *          width => <width>
 *          1 => <height>
 *          height => <height>
 *      )
 *
 * @param string $type
 * @return array
 */
function get_basicbootsrap_image_sizes($type = 'post_thumbnails')
{
    $config = basicbootstrap_get_config('image_sizes');
    $data = array(
        0=> null,
        1=> null,
        'width'=> null,
        'height'=> null,
    );
    if (is_array($config) && isset($config[$type]) && is_array($config[$type])) {
        if (isset($config[$type]['width'])) {
            $data[0] = $config[$type]['width'];
            $data['width'] = $config[$type]['width'];
        }
        if (isset($config[$type]['width'])) {
            $data[1] = $config[$type]['height'];
            $data['height'] = $config[$type]['height'];
        }
    }
    return $data;
}

// THEME SPECIFIC FCTS

/**
 * Manage global redirections
 *
 * To use this feature, write:
 *
 *      add_action('template_redirect', 'basicbootstrap_template_redirect', 1);
 *
 */
function basicbootstrap_template_redirect()
{
    // disallow attachment page when it is disabled
    if (!is_admin() && is_attachment()) {
        global $post;
        $visibility = get_post_meta($post->ID, 'attachment-page-visibility', true);
        if ($visibility == 'disabled') {
            set_error_403(false, true);
        }
    }
}

/**
 * Define the excerpts length
 *
 * To use this feature, write:
 *
 *      add_filter('excerpt_length', 'basicbootstrap_excerpt_length');
 *
 * The `excerpt_length` filter is documented in `wp-includes/formatting.php`.
 *
 * @return string
 */
function basicbootstrap_excerpt_length()
{
    if (is_sticky() && is_sticky_view()) {
        return get_basicbootstrap_mod('sticky_posts_excerpt_max_length');
    }
    return get_basicbootstrap_mod('excerpt_max_length');
}

/**
 * Get the post excerpt adding the "read more" tag if enabled and needed
 *
 * To use this feature, write:
 *
 *      add_filter('wp_trim_excerpt', 'basicbootstrap_excerpt');
 *
 * The `wp_trim_excerpt` filter is documented in `wp-includes/formatting.php`.
 *
 * @param $output
 * @return string
 */
function basicbootstrap_excerpt($output)
{
    if (get_basicbootstrap_mod('show_read_more_buttons')) {
        /* @var $post \WP_Post */
        global $post;
        $more = basicbootstrap_read_more_link();
        if (empty($post->post_excerpt) && strpos($output, $more)===false) {
            $output .= $more;
        }
    }
    return $output;
}

/**
 * Replaces the default "more" links
 *
 * To use this feature, write both:
 *
 *      add_filter('excerpt_more', 'basicbootstrap_read_more_link');
 *      add_filter('the_content_more_link', 'basicbootstrap_read_more_link');
 *
 * The `excerpt_more` filter is documented in `wp-includes/formatting.php`.
 * The `the_content_more_link` filter is documented in `wp-includes/post-template.php`.
 *
 * @param $more
 * @return string
 */
function basicbootstrap_read_more_link($more = null)
{
    $output = '';
    if (!empty($more)) {
        $output .= get_basicbootstrap_mod('read_more');
    }
    if (get_basicbootstrap_mod('show_read_more_buttons')) {
        /* @var $post \WP_Post */
        global $post;
        $output .= '<p class="read-more-wrapper"><a class="btn btn-default btn-sm read-more" href="'.
            get_permalink($post->ID) .
            '" title="' .
            esc_attr(sprintf(__('Read the full article: %s', 'basicbootstrap'), the_title('', '', false))) .
            '">' .
            __('read more', 'basicbootstrap') .
            '</a></p>';
    }
    return $output;
}

/**
 * Breadcrumbs
 *
 * @see \WP_Basic_Bootstrap_Breadcrumb
 * @link https://www.thewebtaylor.com/articles/wordpress-creating-breadcrumbs-without-a-plugin
 */
function get_the_breadcrumb()
{
    basicbootstrap_load_class('WP_Basic_Bootstrap_Breadcrumb');

    // all entries are stored like i=>array(title=>..., url=>...)
    $breadcrumb = new WP_Basic_Bootstrap_Breadcrumb();
    $entries = $breadcrumb->render();

    if (count($entries)) {
        $params = array(
            'entries' => $entries,
        );
        get_template_part_hierarchical_fetch('partials/layout/breadcrumb', '', $params);
    }
}

/**
 * Build pages pagination
 */
function get_the_pagination()
{
    basicbootstrap_load_class('WP_Basic_Bootstrap_Pagination');
    $paginator = new WP_Basic_Bootstrap_Pagination();
    $entries = $paginator->render();
    if (count($entries)) {
        get_template_part_hierarchical_fetch('partials/pagination/'.$paginator->type, '', $entries);
    }
}

/**
 * Build post inner pagination
 *
 * @see wp_link_pages()
 */
function get_the_link_pages()
{
    basicbootstrap_load_class('WP_Basic_Bootstrap_Pagination');
    $paginator = new WP_Basic_Bootstrap_Pagination();
    $entries = $paginator->renderPostPages();
    if (count($entries)) {
        get_template_part_hierarchical_fetch('partials/pagination/'.$paginator->type, '', $entries);
    }
}

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own basicbootstrap_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 */
function basicbootstrap_comment($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    switch ($comment->comment_type) :
        case 'pingback' :
        case 'trackback' :
        get_template_part_hierarchical_fetch('partials/comments/pingback-item-cb', '', array(
                'comment' => $comment,
                'args' => $args,
                'depth' => $depth,
            ));
    break;
    default :
        get_template_part_hierarchical_fetch('partials/comments/comment-item-cb', '', array(
                'comment' => $comment,
                'args' => $args,
                'depth' => $depth,
            ));
    break;
    endswitch; // end comment_type check
}

/**
 * Include user input custom CSS
 */
function basicbootstrap_include_custom_css_code()
{
    $css_code = get_theme_mod('custom_css');
    if (!empty($css_code)) {
        echo '<style type="text/css">' . $css_code . '</style>';
    }
}