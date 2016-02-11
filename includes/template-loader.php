<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/*/
comments_template();
get_footer();
get_header();
get_sidebar();
get_search_form();
//*/

/**
 * Get a file path relative to `STYLESHEETPATH` or `TEMPLATEPATH`
 *
 * @param string $path
 * @return string
 */
function get_theme_relative_path($path)
{
    return str_replace(array(STYLESHEETPATH, TEMPLATEPATH), '', $path);
}

function get_asset_uri($name)
{
    $path = locate_template($name);
    if ($path) {
        if (strpos($path, STYLESHEETPATH)!==false) {
            return get_stylesheet_directory_uri() . '/' . get_theme_relative_path($path);
        }
        if (strpos($path, TEMPLATEPATH)!==false) {
            return get_template_directory_uri() . '/' . get_theme_relative_path($path);
        }
    }
    return null;
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
function get_template_part_fetch($slug, $name = null, $args = array())
{
    /**
     * Fires before the specified template part file is loaded.
     *
     * The dynamic portion of the hook name, `$slug`, refers to the slug name
     * for the generic template part.
     *
     * @since WP 3.0.0
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialized template.
     */
    do_action("get_template_part_{$slug}", $slug, $name);

    $templates = array();
    $name = (string) $name;
    if ('' !== $name) {
        $templates[] = "{$slug}-{$name}.php";
    }

    $templates[] = "{$slug}.php";

    $tpl = locate_template($templates);

    if ($tpl) {
        if (!empty($args)) {
            extract($args);
        }
        require $tpl;
    }
}

/**
 * Load a template part into a template following the WP template's hierarchy
 *
 * @see get_template_part()
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param bool $include Must the template be included (default) or returned?
 * @return string|void
 */
function get_template_part_hierarchical($slug, $name = null, $include = true)
{
    /**
     * Fires before the specified template part file is loaded.
     *
     * The dynamic portion of the hook name, `$slug`, refers to the slug name
     * for the generic template part.
     *
     * @since WP 3.0.0
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialized template.
     */
    do_action("get_template_part_{$slug}", $slug, $name);

    if     ( is_404()            && $template = get_404_template_part($slug, $name)            ) :
    elseif ( is_search()         && $template = get_search_template_part($slug, $name)         ) :
    elseif ( is_front_page()     && $template = get_front_page_template_part($slug, $name)     ) :
    elseif ( is_home()           && $template = get_home_template_part($slug, $name)           ) :
    elseif ( is_post_type_archive() && $template = get_post_type_archive_template_part($slug, $name) ) :
    elseif ( is_tax()            && $template = get_taxonomy_template_part($slug, $name)       ) :
    elseif ( is_attachment()     && $template = get_attachment_template_part($slug, $name)     ) :
    elseif ( is_single()         && $template = get_single_template_part($slug, $name)         ) :
    elseif ( is_page()           && $template = get_page_template_part($slug, $name)           ) :
    elseif ( is_singular()       && $template = get_singular_template_part($slug, $name)       ) :
    elseif ( is_category()       && $template = get_category_template_part($slug, $name)       ) :
    elseif ( is_tag()            && $template = get_tag_template_part($slug, $name)            ) :
    elseif ( is_author()         && $template = get_author_template_part($slug, $name)         ) :
    elseif ( is_date()           && $template = get_date_template_part($slug, $name)           ) :
    elseif ( is_archive()        && $template = get_archive_template_part($slug, $name)        ) :
    elseif ( is_comments_popup() && $template = get_comments_popup_template_part($slug, $name) ) :
    elseif ( is_paged()          && $template = get_paged_template_part($slug, $name)          ) :
    else :
        $template = get_index_template_part($slug, $name);
    endif;
    if ($include) {
        if ($template) {
            include $template;
        }
        return;
    }
    return $template;
}

/**
 * Load a template part into a template following the WP template's hierarchy with arguments
 *
 * @see get_template_part_hierarchical()
 *
 * @param string $slug The slug name for the generic template.
 * @param string $name The name of the specialised template.
 * @param array $args An array of arguments to fetch in the template
 */
function get_template_part_hierarchical_fetch($slug, $name = null, $args = array())
{
    $tpl = get_template_part_hierarchical($slug, $name, false);
    if ($tpl) {
        if (!empty($args)) {
            extract($args);
        }
        require $tpl;
    }
}

/**
 * Find the path of a template following the WP hierarchy
 *
 * @param $slug
 * @param null $name
 * @param bool $extension_only
 * @return mixed|string|void
 */
function template_part_hierarchical($slug, $name = null, $extension_only = false)
{
    $template = get_template_part_hierarchical($slug, $name, false);
    if ($extension_only) {
        $template = str_replace(
            array("{$slug}-", '.php'),
            '',
            trim(get_theme_relative_path($template), '/')
        );
        if ($template == $slug) {
            $template = '';
        }
    }
    return $template;
}

/**
 * Special process of singular page templating header
 *
 * @uses template_part_hierarchical()
 * @uses get_header()
 * @param $name
 */
function get_header_hierarchical($name = null)
{
    $template = template_part_hierarchical('header', $name, true);
    get_header($template);
}

/**
 * Special process of singular page templating footer
 *
 * @uses template_part_hierarchical()
 * @uses get_footer()
 * @param $name
 */
function get_footer_hierarchical($name = null)
{
    $template = template_part_hierarchical('footer', $name, true);
    get_footer($template);
}

/**
 * Special process of singular page templating sidebar
 *
 * @uses template_part_hierarchical()
 * @uses get_sidebar()
 * @param $name
 */
function get_sidebar_hierarchical($name = null)
{
    $template = template_part_hierarchical('sidebar', $name, true);
    get_sidebar($template);
}

/**
 * Display search form.
 *
 * Will first attempt to locate the searchform.php file in either the child or
 * the parent, then load it. If it doesn't exist, then the default search form
 * will be displayed. The default search form is HTML, which will be displayed.
 * There is a filter applied to the search form HTML in order to edit or replace
 * it. The filter is 'get_search_form'.
 *
 * This function is primarily used by themes which want to hardcode the search
 * form into the sidebar and also by the search widget in WordPress.
 *
 * There is also an action that is called whenever the function is run called,
 * 'pre_get_search_form'. This can be useful for outputting JavaScript that the
 * search relies on or various formatting that applies to the beginning of the
 * search. To give a few examples of what it can be used for.
 *
 * @since WP 2.7.0
 *
 * @param bool $echo Default to echo and not return the form.
 * @return string|void String when $echo is false.
 */
function get_search_form_hierarchical($echo = true)
{
    /**
     * Fires before the search form is retrieved, at the start of get_search_form_hierarchical().
     *
     * @since WP 2.7.0 as 'get_search_form' action.
     * @since WP 3.6.0
     *
     * @link https://core.trac.wordpress.org/ticket/19321
     */
    do_action( 'pre_get_search_form' );

    $format = current_theme_supports( 'html5', 'search-form' ) ? 'html5' : 'xhtml';

    /**
     * Filter the HTML format of the search form.
     *
     * @since WP 3.6.0
     *
     * @param string $format The type of markup to use in the search form.
     *                       Accepts 'html5', 'xhtml'.
     */
    $format = apply_filters( 'search_form_format', $format );

    $search_form_template = template_part_hierarchical('searchform');
    if ( '' != $search_form_template ) {
        ob_start();
        require( $search_form_template );
        $form = ob_get_clean();
    } else {
        if ( 'html5' == $format ) {
            $form = '<form role="search" method="get" class="search-form" action="' . esc_url( home_url( '/' ) ) . '">
				<label>
					<span class="screen-reader-text">' . _x( 'Search for:', 'label' ) . '</span>
					<input type="search" class="search-field" placeholder="' . esc_attr_x( 'Search &hellip;', 'placeholder' ) . '" value="' . get_search_query() . '" name="s" title="' . esc_attr_x( 'Search for:', 'label' ) . '" />
				</label>
				<input type="submit" class="search-submit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
			</form>';
        } else {
            $form = '<form role="search" method="get" id="searchform" class="searchform" action="' . esc_url( home_url( '/' ) ) . '">
				<div>
					<label class="screen-reader-text" for="s">' . _x( 'Search for:', 'label' ) . '</label>
					<input type="text" value="' . get_search_query() . '" name="s" id="s" />
					<input type="submit" id="searchsubmit" value="'. esc_attr_x( 'Search', 'submit button' ) .'" />
				</div>
			</form>';
        }
    }

    /**
     * Filter the HTML output of the search form.
     *
     * @since WP 2.7.0
     *
     * @param string $form The search form HTML output.
     */
    $result = apply_filters( 'get_search_form', $form );

    if ( null === $result )
        $result = $form;

    if ( $echo )
        echo $result;
    else
        return $result;
}

/**
 * Load the comment template specified in $file.
 *
 * Will not display the comments template if not on single post or page, or if
 * the post does not have comments.
 *
 * Uses the WordPress database object to query for the comments. The comments
 * are passed through the 'comments_array' filter hook with the list of comments
 * and the post ID respectively.
 *
 * The $file path is passed through a filter hook called, 'comments_template'
 * which includes the TEMPLATEPATH and $file combined. Tries the $filtered path
 * first and if it fails it will require the default comment template from the
 * default theme. If either does not exist, then the WordPress process will be
 * halted. It is advised for that reason, that the default theme is not deleted.
 *
 * @uses $withcomments Will not try to get the comments if the post has none.
 *
 * @since 1.5.0
 *
 * @global WP_Query   $wp_query
 * @global WP_Post    $post
 * @global wpdb       $wpdb
 * @global int        $id
 * @global WP_Comment $comment
 * @global string     $user_login
 * @global int        $user_ID
 * @global string     $user_identity
 * @global bool       $overridden_cpage
 *
 * @param string $file              Optional. The file to load. Default '/comments.php'.
 * @param bool   $separate_comments Optional. Whether to separate the comments by comment type.
 *                                  Default false.
 */
function comments_template_hierarchical( $file = '/comments.php', $separate_comments = false )
{
    if ($file == '/comments.php') {
        $template = template_part_hierarchical('comments', '', true);
    } else {
        $template = $file;
    }
    comments_template(!empty($template) ? $template : '/comments.php', $separate_comments);
}

/**
 * Retrieve path to a template part
 *
 * Used to quickly retrieve the path of a sub-template without including the file
 * extension. It will also check the parent theme, if the file exists, with
 * the use of {@link locate_template()}.
 *
 * @param string $type      Filename without extension.
 * @param array  $templates An optional list of template candidates
 * @return string Full path to template file.
 */
function get_query_template_part($type, $templates = array())
{
    $type = preg_replace('|[^a-z0-9-/]+|', '', $type);

    if (empty($templates)) {
        $templates = array("{$type}.php");
    }

    $template = locate_template($templates);

    /**
     * Filter the path of the queried template by type.
     *
     * The dynamic portion of the hook name, `$type`, refers to the filename -- minus the file
     * extension and any non-alphanumeric characters delimiting words -- of the file to load.
     * This hook also applies to various types of files loaded as part of the Template Hierarchy.
     *
     * Possible values for `$type` include: 'index', '404', 'archive', 'author', 'category', 'tag', 'taxonomy', 'date',
     * 'home', 'front_page', 'page', 'paged', 'search', 'single', 'singular', and 'attachment'.
     *
     * @param string $template Path to the template. See locate_template().
     */
    return apply_filters("{$type}_template_part", $template);
}

/**
 * Build the stack of templates to search for a "simple" page type
 *
 * Example: for `get_global_template_part('slug', 'name', 'search')`, result will be:
 *
 *      array(
 *          slug-name-search.php
 *          slug-name.php
 *          slug-search.php
 *          slug.php
 *      )
 *
 * @see get_query_template_part()
 * @param string $slug
 * @param null|string $name
 * @param string $page_name
 * @param bool $return_items
 * @return array|string
 */
function get_global_template_part($slug, $name = null, $page_name = 'index', $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_global_template_part("{$slug}-{$name}", null, $page_name, true);
    }
    $templates[] = "{$slug}-{$page_name}.php";
    $templates[] = "{$slug}.php";
    if ($return_items) {
        return $templates;
    }
    return get_query_template_part($page_name, $templates);
}

/**
 * Retrieve path of index template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'index_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_index_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'index');
}

/**
 * Retrieve path of 404 template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. '404_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_404_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, '404');
}

/**
 * Retrieve path of archive template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'archive_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_archive_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_archive_template_part("{$slug}-{$name}", null, true);
    }

    $post_types = array_filter((array) get_query_var('post_type'));
    $post_type = (count($post_types) == 1) ? reset($post_types) : null;
    if (!empty($post_type)) {
        $templates[] = "{$slug}-archive-{$post_type}.php";
    }
    $templates[] = "{$slug}-archive.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('archive', $templates);
}

/**
 * Retrieve path of post type archive template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'archive_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_post_type_archive_template_part($slug, $name = null)
{
    $post_type = get_query_var('post_type');
    if (is_array($post_type)) {
        $post_type = reset($post_type);
    }

    $obj = get_post_type_object($post_type);
    if (! $obj->has_archive) {
        return '';
    }

    return get_archive_template_part($slug, $name);
}

/**
 * Retrieve path of author template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'author_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_author_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_author_template_part("{$slug}-{$name}", null, true);
    }

    $author = get_queried_object();
    if ($author instanceof WP_User) {
        $templates[] = "{$slug}-author-{$author->user_nicename}.php";
        $templates[] = "{$slug}-author-{$author->ID}.php";
    }
    $templates[] = "{$slug}-author.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('author', $templates);
}

/**
 * Retrieve path of category template in current or parent template.
 *
 * Works by first retrieving the current slug, for example 'category-default.php',
 * and then trying category ID, for example 'category-1.php', and will finally fall
 * back to category.php template, if those files don't exist.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'category_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_category_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_category_template_part("{$slug}-{$name}", null, true);
    }

    $category = get_queried_object();
    if (! empty($category->slug)) {
        $templates[] = "{$slug}-category-{$category->slug}.php";
        $templates[] = "{$slug}-category-{$category->term_id}.php";
    }
    $templates[] = "{$slug}-category.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('category', $templates);
}

/**
 * Retrieve path of tag template in current or parent template.
 *
 * Works by first retrieving the current tag name, for example 'tag-wordpress.php',
 * and then trying tag ID, for example 'tag-1.php', and will finally fall back to
 * tag.php template, if those files don't exist.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'tag_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_tag_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_tag_template_part("{$slug}-{$name}", null, true);
    }

    $tag = get_queried_object();
    if (! empty($tag->slug)) {
        $templates[] = "{$slug}-tag-{$tag->slug}.php";
        $templates[] = "{$slug}-tag-{$tag->term_id}.php";
    }
    $templates[] = "{$slug}-tag.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('tag', $templates);
}

/**
 * Retrieve path of taxonomy template in current or parent template.
 *
 * Retrieves the taxonomy and term, if term is available. The template is
 * prepended with 'taxonomy-' and followed by both the taxonomy string and
 * the taxonomy string followed by a dash and then followed by the term.
 *
 * The taxonomy and term template is checked and used first, if it exists.
 * Second, just the taxonomy template is checked, and then finally, taxonomy.php
 * template is used. If none of the files exist, then it will fall back on to
 * index.php.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'taxonomy_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_taxonomy_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_taxonomy_template_part("{$slug}-{$name}", null, true);
    }

    $term = get_queried_object();
    if (! empty($term->slug)) {
        $taxonomy = $term->taxonomy;
        $templates[] = "{$slug}-taxonomy-{$taxonomy}-{$term->slug}.php";
        $templates[] = "{$slug}-taxonomy-{$taxonomy}.php";
    }
    $templates[] = "{$slug}-taxonomy.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('taxonomy', $templates);
}

/**
 * Retrieve path of date template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'date_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_date_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'date');
}

/**
 * Retrieve path of home template in current or parent template.
 *
 * This is the template used for the page containing the blog posts.
 * Attempts to locate 'home.php' first before falling back to 'index.php'.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'home_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_home_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'home');
}

/**
 * Retrieve path of front-page template in current or parent template.
 *
 * Looks for 'front-page.php'. The template path is filterable via the
 * dynamic {@see '$type_template'} hook, e.g. 'frontpage_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_front_page_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'front-page');
}

/**
 * Retrieve path of page template in current or parent template.
 *
 * Will first look for the specifically assigned page template.
 * Then will search for 'page-{slug}.php', followed by 'page-{id}.php',
 * and finally 'page.php'.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'page_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_page_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_page_template_part("{$slug}-{$name}", null, true);
    }

    $id = get_queried_object_id();
    $pagename = get_query_var('pagename');
    if (! $pagename && $id) {
        // If a static page is set as the front page, $pagename will not be set. Retrieve it from the queried object
        $post = get_queried_object();
        if ($post) {
            $pagename = $post->post_name;
        }
    }
    if ($pagename) {
        $templates[] = "{$slug}-page-{$pagename}.php";
    }
    if ($id) {
        $templates[] = "{$slug}-page-{$id}.php";
    }
    $templates[] = "{$slug}-page.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('page', $templates);
}

/**
 * Retrieve path of paged template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'paged_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_paged_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'paged');
}

/**
 * Retrieve path of search template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'search_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_search_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'search');
}

/**
 * Retrieve path of single template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'single_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_single_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_single_template_part("{$slug}-{$name}", null, true);
    }

    $object = get_queried_object();
    if (! empty($object->post_type)) {
        $format = get_post_format();
        if ($format) {
            $templates[] = "{$slug}-single-{$object->post_type}-{$format}-{$object->post_name}.php";
            $templates[] = "{$slug}-single-{$object->post_type}-{$format}.php";
        }
        $templates[] = "{$slug}-single-{$object->post_type}-{$object->post_name}.php";
        $templates[] = "{$slug}-single-{$object->post_type}.php";
    }
    $templates[] = "{$slug}-single.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('single', $templates);
}

/**
 * Retrieves the path of the singular template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'singular_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_singular_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'singular');
}

/**
 * Retrieve path of attachment template in current or parent template.
 *
 * The attachment path first checks if the first part of the mime type exists.
 * The second check is for the second part of the mime type. The last check is
 * for both types separated by an underscore. If neither are found then the file
 * 'attachment.php' is checked and returned.
 *
 * Some examples for the 'text/plain' mime type are 'text.php', 'plain.php', and
 * finally 'text-plain.php'.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'attachment_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @param bool $return_items
 * @return string
 */
function get_attachment_template_part($slug, $name = null, $return_items = false)
{
    $templates = array();
    if (!empty($name)) {
        $templates = get_attachment_template_part("{$slug}-{$name}", null, true);
    }

    $attachment = get_queried_object();
    if ($attachment) {
        if (false !== strpos($attachment->post_mime_type, '/')) {
            list($type, $subtype) = explode('/', $attachment->post_mime_type);
        } else {
            list($type, $subtype) = array($attachment->post_mime_type, '');
        }
        if ( ! empty( $subtype ) ) {
            $templates[] = "{$slug}-{$type}-{$subtype}.php";
            $templates[] = "{$slug}-{$subtype}.php";
        }
        $templates[] = "{$slug}-{$type}.php";
    }
    $templates[] = "{$slug}-attachment.php";
    $templates[] = "{$slug}.php";

    if ($return_items) {
        return $templates;
    }
    return get_query_template_part('attachment', $templates);
}

/**
 * Retrieve path of comment popup template in current or parent template.
 *
 * Checks for comment popup template in current template, if it exists or in the
 * parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. 'commentspopup_template'.
 *
 * @see get_global_template_part()
 * @param string $slug
 * @param null|string $name
 * @return string
 */
function get_comments_popup_template_part($slug, $name = null)
{
    return get_global_template_part($slug, $name, 'comments-popup');
}
