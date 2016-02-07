<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

// TEMPLATES CONSTRUCTIONS

/**
 * Special process of singular page templating
 *
 * Fallback stacks:
 *
 * -    for a page: `$type-page.php` -> `$type-single.php` -> `$type.php`
 * -    for an attachment: `$type-attachment.php` -> `$type-single.php` -> `$type.php`
 * -    for a custom post type: `$type-post_type.php` -> `$type-single.php` -> `$type.php`
 * -    for a post type: `$type-post_format.php` -> `$type-post.php` -> `$type-single.php` -> `$type.php`
 *
 * @param string $slug The type of template to search (header, footer, sidebar ...)
 * @param null|string $name The name of the template (eventually received from hooks)
 * @param null|callable $callback The callback function hooked (get_header, get_footer, get_sidebar ...)
 * @param null|callable $fct_name The calling original function initially called by the hook to remove: add_action($callback, $fct_name)
 */
function get_template_part_singular($slug, $name = null, $callback = null, $fct_name = null)
{
    if (is_singular() && (is_null($name) || $name == 'single')) {
        if (is_null($name)) {
            $name = 'single';
        }
        $singular_type = get_singular_type();

        if (locate_template($slug.'-'.$singular_type.'.php', false, false)) {
            if (!empty($callback) && !empty($fct_name)) {
                remove_action($callback, $fct_name);
                call_user_func($callback, $singular_type);
                return;
            } else {
                get_template_part($slug, $singular_type);
                return;
            }

        } elseif (
            is_single() &&
            get_post_type() == 'post' &&
            locate_template($slug.'-post.php', false, false)
        ) {
            if (!empty($callback) && !empty($fct_name)) {
                remove_action($callback, $fct_name);
                call_user_func($callback, 'post');
                return;
            } else {
                get_template_part($slug, 'post');
                return;
            }
        }

    }

    if (!empty($callback) && !empty($fct_name)) {
        remove_action($callback, $fct_name);
        call_user_func($callback, $name);
        return;
    }

    get_template_part($slug, $name);
}

/**
 * Special process of singular page templating header
 *
 * To use this feature, write:
 *
 *     add_action('get_header', 'get_header_singular');
 *
 * The `get_header` action is documented in `wp-includes/general-template.php`.
 *
 * @param $name
 */
function get_header_singular($name = null)
{
    get_template_part_singular('header', $name, 'get_header', __FUNCTION__);
}
add_action('get_header', 'get_header_singular');

/**
 * Special process of singular page templating footer
 *
 * To use this feature, write:
 *
 *     add_action('get_footer', 'get_footer_singular');
 *
 * The `get_footer` action is documented in `wp-includes/general-template.php`.
 *
 * @param $name
 */
function get_footer_singular($name = null)
{
    get_template_part_singular('footer', $name, 'get_footer', __FUNCTION__);
}
add_action('get_footer', 'get_footer_singular');

/**
 * Special process of singular page templating sidebar
 *
 * To use this feature, write:
 *
 *     add_action('get_sidebar', 'get_sidebar_singular');
 *
 * The `get_header` action is documented in `wp-includes/general-template.php`.
 *
 * @param $name
 */
function get_sidebar_singular($name = null)
{
    get_template_part_singular('sidebar', $name, 'get_sidebar', __FUNCTION__);
}
add_action('get_sidebar', 'get_sidebar_singular');

// STICKY POSTS LOOPS

/**
 * Get the Nth first sticky posts IDs (in ID desc order: newest to older)
 *
 * If `$num` is not set, it will fallback to the `sticky_posts_to_show` setting.
 *
 * @link http://stackoverflow.com/a/19814472/3592658
 * @param null|int $num
 * @return array
 */
function get_sticky_ids($num = null)
{
    // get sticky posts from DB
    $sticky = get_option('sticky_posts');
    // check if there are any
    if (!empty($sticky)) {
        // get the default num from mods
        if (is_null($num)) {
            $num = get_basicbootstrap_mod('sticky_posts_to_show');
        }
        // only if num is positive
        if ($num > 0) {
            // sort the newest IDs first
            rsort($sticky);
            // extract requested number
            return array_slice($sticky, 0, $num);
        }
    }
    return array();
}

/**
 * Load in global loop the Nth first sticky posts (in ID desc order: newest to older)
 *
 * If `$num` is not set, it will fallback to the `sticky_posts_to_show` setting.
 *
 * @link http://stackoverflow.com/a/19814472/3592658
 * @param null|int $num
 * @return bool Returns `true` if the query was re-written
 */
function get_sticky_query($num = null)
{
    // get sticky posts from DB
    $sticky = get_sticky_ids($num);

    // check if there are any
    if (!empty($sticky)) {
        // get the original query and store/restore it
        global $wp_query, $tmp_query;
        if (empty($tmp_query)) {
            $tmp_query = clone $wp_query;
        } else {
            $wp_query = clone $tmp_query;
        }

        // override the query
        $args = array_merge(
            $wp_query->query_vars,
            array(
                'post__in'  => $sticky,
            )
        );

        // process the new query
        query_posts($args);
        rewind_posts();
        return true;
    }
    return false;
}

/**
 * Re-load the global loop WITHOUT the Nth first sticky posts
 *
 * If `$num` is not set, it will fallback to the `sticky_posts_to_show` setting.
 *
 * @link http://stackoverflow.com/a/19814472/3592658
 * @param null|int $num
 * @return bool Returns `true` if the query was re-written
 */
function get_not_sticky_query($num = null)
{
    // get sticky posts from DB
    $sticky = get_sticky_ids($num);

    // check if there are any
    if (!empty($sticky)) {
        // get the original query and store/restore it
        global $wp_query, $tmp_query;
        if (empty($tmp_query)) {
            $tmp_query = clone $wp_query;
        } else {
            $wp_query = clone $tmp_query;
        }

        // override the query
        $args = array_merge(
            $wp_query->query_vars,
            array(
                'post__not_in'          => $sticky,
                'ignore_sticky_posts'   => true
            )
        );

        // process the new query
        query_posts($args);
        rewind_posts();
        return true;
    }
    return false;
}

// CUSTOM VALIDATORS / SANITIZERS

/**
 * Callback to validate a on/off checkbox
 *
 * @param $val
 * @return int
 */
function sanitize_checkbox($val)
{
    return (bool) ($val == 1);
}

/**
 * Sanitize Customizer Font Selections
 */
function sanitize_font_selection($input)
{
    $available_fonts = basicbootstrap_get_config('available_fonts');
    if (array_key_exists($input, $available_fonts)) {
        return $input;
    } else {
        return key($available_fonts);
    }
}

/**
 * Build a sanitizer for a selector
 *
 * @param array $values
 * @param null $default
 * @return \Closure
 */
function sanitize_select_generator(array $values, $default = null)
{
    $f = function($val) use ($values, $default) {
        if (array_key_exists($val, $values)) {
            return $val;
        }
        return (is_null($default) ? key($values) : $default);
    };
    return $f;
}

/**
 * Sanitize a text allowing HTML tags: `a` with `href` and `title`, `br`, `em` and `strong`
 *
 * @param $val
 * @return string
 */
function sanitize_simple_html_field($val)
{
    return wp_kses($val, array(
        'a' => array(
            'href' => array(),
            'title' => array()
        ),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
    ));
}

// MISSING TEMPLATES FCTS

/**
 * Get current page "type" in the way WordPress handles it
 *
 * @return string
 */
function get_page_type()
{
    global $page_type;
    if (!isset($page_type)) {
        $page_type = 'index';
        if (is_front_page() && is_home()) {
            // default wordpress: auto-generated homepage => front-page.php
            $page_type = 'default_home';
        } elseif (is_front_page()) {
            // user defined front page (homepage post) => front-page.php
            $page_type = 'front_page';
        } elseif (is_home()) {
            // user defined blog page (post) => home.php
            $page_type = 'home';
        } elseif (is_search()) {
            $page_type = 'search';
        } elseif (is_401()) {
            $page_type = '401';
        } elseif (is_403()) {
            $page_type = '403';
        } elseif (is_404()) {
            $page_type = '404';
        } elseif (is_single() && is_attachment()) {
            $page_type = 'attachment';
        } elseif (is_page()) {
            $page_type = 'page';
        } elseif (is_single() && is_sticky()) {
            $page_type = 'post_sticky';
        } elseif (is_single()) {
            $page_type = 'post';
        } elseif (is_archive() && is_tag()) {
            $page_type = 'tag';
        } elseif (is_archive() && is_category()) {
            $page_type = 'category';
        } elseif (is_archive() && is_author()) {
            $page_type = 'author';
        } elseif (is_archive() && is_post_type_archive()) {
            $page_type = 'post_type_archive';
        } elseif (is_archive() && is_tax()) {
            $page_type = 'taxonomy';
        } elseif (is_archive() && (is_date() || is_year() || is_month() || is_day() || is_time())) {
            $page_type = 'date';
        } elseif (is_archive()) {
            $page_type = 'archive';
        }
    }
    return $page_type;
}

/**
 * Check if we are in a blog page
 *
 * This will return true for any page unless for: page post type,
 * the front page if it is set on a page, author, search and error pages
 *
 * @return bool
 */
function is_blog_page()
{
    global $blog_page;
    if (!isset($blog_page)) {
        $blog_page = (bool)
            is_home() ||
    //        (is_home() && ! is_front_page()) ||
            is_tag() ||
            is_category() ||
            (is_single() && ! is_page()) ||
            is_tax() ||
            is_archive()
                ;
    }
    return $blog_page;
}

/**
 * Get the type of a singular page in "attachment", "page", <custom_post_type>, <post_format>
 *
 * @return false|string
 */
function get_singular_type()
{
    global $singular_page_type;
    if (!isset($singular_page_type)) {
        if (is_attachment()) {
            $singular_page_type = 'attachment';
        } elseif (is_page()) {
            $singular_page_type = 'page';
        } elseif (is_single() && get_post_type() != 'post') {
            $singular_page_type = get_post_type();
        } elseif (is_single() && get_post_type() == 'post') {
            $singular_page_type = get_post_format();
        } else {
            $singular_page_type = 'single';
        }
    }
    return $singular_page_type;
}

/**
 * Check if current post is sticky and if it should be treated specially
 *
 * This returns `true` if the post is sticky for the following pages:
 *
 * -    home / front page
 * -    category
 */
function is_sticky_view()
{
    global $sticky_view;
    if (!isset($sticky_view)) {
        $sticky_view = (bool) (is_home() ||
            is_front_page() ||
            is_category()
        );
    }
    return $sticky_view;
}

/**
 * Display an edit link if "current_user_can" for current object
 *
 * @param $type
 * @param null $id
 * @param string $text
 * @param string $before
 * @param string $after
 */
function edit_link_if_so($type, $id = null, $text = 'Edit', $before = '<i class="fa fa-pencil-square fa-fw"></i>&nbsp;', $after = '')
{
    if (!get_basicbootstrap_mod('show_edit_links')) {
        return;
    }
    $text = __($text, 'basicbootstrap');
    ob_start();
    if ($type == 'tag') {
        edit_tag_link($text, '', '', $id);
    } elseif ($type == 'category') {
        edit_category_link($text, '', '', $id);
    } else {
        edit_post_link($text);
    }
    $ctt = ob_get_contents();
    ob_end_clean();
    if (!empty($ctt)) {
        echo $before . $ctt . $after;
    }
}

/**
 * Get a link to the admin area's category page if current user is allowed
 * to 'manage_categories'. If the `$id` argument is not set, the current category
 * of an archive page will be fetched, if so.
 *
 * @param string $link
 * @param string $before
 * @param string $after
 * @param null $id
 * @param bool $echo
 * @return null|string|void
 */
function edit_category_link($link = '', $before = '', $after = '', $id = null, $echo = true)
{
    if (current_user_can('manage_categories')) {
        if (is_null($id)) {
            $id = get_cat_id(single_cat_title('',false));
        }
        if ($id) {
            $category = get_term($id, 'category');
            return edit_term_link($link, $before, $after, $category, $echo);
        }
    }
    return null;
}

/**
 * Get the URL to edit a category
 *
 * @param $id
 * @param string $object_type
 * @return null|string
 */
function get_edit_category_link($id, $object_type = '')
{
    return get_edit_term_link($id, 'category', $object_type);
}

/**
 * Get the description of an author trimed like posts excerpts
 *
 * @param int $id
 * @return string
 */
function get_the_author_excerpt($id = 0)
{
    if ($id==0) {
        $id = get_the_author_meta('ID');
    }
    if (!empty($id)) {
        $content = get_the_author_meta('description', $id);
        return wp_trim_words(
            $content,
            get_basicbootstrap_mod('excerpt_max_length'),
            get_basicbootstrap_mod('read_more')
        );
    }
}

/**
 * Display the description of an author trimed like posts excerpts
 *
 * @param int $id
 */
function the_author_excerpt($id = 0)
{
    echo get_the_author_excerpt($id);
}

/**
 * Load a template part into a template with arguments
 *
 * @see get_template_part()
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $args An array of arguments to fetch in the template
 */
function get_template_part_with_arguments($slug, $name = null, $args = array())
{
    /**
     * Fires before the specified template part file is loaded.
     *
     * The dynamic portion of the hook name, `$slug`, refers to the slug name
     * for the generic template part.
     *
     * @since 3.0.0
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialized template.
     */
    do_action("get_template_part_{$slug}", $slug, $name);

    $templates = array();
    $name = (string) $name;
    if ( '' !== $name )
        $templates[] = "{$slug}-{$name}.php";

    $templates[] = "{$slug}.php";

    $tpl = locate_template($templates);

    if ($tpl) {
        if (!empty($args))
            extract($args);
        require $tpl;
    }
}
