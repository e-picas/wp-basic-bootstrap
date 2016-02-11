<?php
/**
 * Special handling of 401 & 403 error pages
 *
 * This file adds two new templates to Wordpress (you may create them on the same model as the `404.php` file):
 *
 * -    `401.php` to handle unauthorized errors
 * -    `403.php` to handle forbidden access errors
 *
 * It also embeds some shortcuts functions to redirect a request to an error page or
 * test if we already are on an error page easily:
 *
 * -    `set_error_404()`, `set_error_403()` and `set_error_401()` to display an error page (with correct headers)
 * -    `is_404()`, `is_403()` and `is_401()` to test if we currently are on an error page
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Load the 404 Not Found error page and display it (optional)
 *
 * @param bool $redirect Redirect browser to the page?
 * @param bool $display Display the page?
 * @since WP_Basic_Bootstrap 1.0
 */
function set_error_404($redirect = true, $display = false)
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    $wp_query->set_404();
    $status = basicbootstrap_get_status();
    if ($redirect && $status != 404) {
        wp_redirect(site_url('?error=404'));
    } elseif ($display) {
        status_header(404);
        nocache_headers();
        $tpl = get_404_template();
        if (!empty($tpl)) {
            include $tpl;
        } else {
            echo '<p>Page not found!</p>';
        }
        exit();
    }
}

/**
 * Load the 403 Access Forbidden error page and display it (optional)
 *
 * @param bool $redirect Redirect browser to the page?
 * @param bool $display Display the page?
 * @since WP_Basic_Bootstrap 1.0
 */
function set_error_403($redirect = true, $display = false)
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    $wp_query->set_404();
    $wp_query->is_404 = false;
    $wp_query->is_403 = true;
    $status = basicbootstrap_get_status();
    if ($redirect && $status != 403) {
        wp_redirect(site_url('?error=403'));
    } elseif ($display) {
        status_header(403);
        $tpl = get_403_template();
        if (!empty($tpl)) {
            include $tpl;
        } else {
            echo '<p>Access forbidden!</p>';
        }
        exit();
    }
}

/**
 * Test if current page is the 403 error page
 *
 * @return bool|mixed
 * @since WP_Basic_Bootstrap 1.0
 */
function is_403()
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    return (bool) isset($wp_query->is_403) ? $wp_query->is_403 : false;
}

/**
 * Retrieve path of 403 template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. '403_template'.
 *
 * @see get_query_template()
 * @return string Full path to 404 template file.
 */
function get_403_template()
{
    return get_query_template('403');
}

/**
 * Load the 401 Unauthorized error page and display it (optional)
 *
 * @param bool $redirect Redirect browser to the page?
 * @param bool $display Display the page?
 * @since WP_Basic_Bootstrap 1.0
 */
function set_error_401($redirect = true, $display = false)
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    $wp_query->set_404();
    $wp_query->is_404 = false;
    $wp_query->is_401 = true;
    $status = basicbootstrap_get_status();
    if ($redirect && $status != 401) {
        wp_redirect(site_url('?error=401'));
    } elseif ($display) {
        status_header(401);
        $tpl = get_401_template();
        if (!empty($tpl)) {
            include $tpl;
        } else {
            echo '<p>Access forbidden!</p>';
        }
        exit();
    }
}

/**
 * Test if current page is the 401 error page
 *
 * @return bool|mixed
 * @since WP_Basic_Bootstrap 1.0
 */
function is_401()
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    return (bool) isset($wp_query->is_401) ? $wp_query->is_401 : false;
}

/**
 * Retrieve path of 401 template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. '401_template'.
 *
 * @see get_query_template()
 * @return string Full path to 404 template file.
 */
function get_401_template()
{
    return get_query_template('401');
}

/**
 * Extract the status from current request (arguments `status` or `error`)
 *
 * @return int
 * @since WP_Basic_Bootstrap 1.0
 */
function basicbootstrap_get_status()
{
    $status = 200;
    if (isset($_REQUEST['status'])) {
        $status = $_REQUEST['status'];
    }
    if (isset($_REQUEST['error'])) {
        $status = $_REQUEST['error'];
    }
    return $status;
}

/**
 * Define and treat custom error pages based on request status
 *
 * To use this feature, write:
 *
 *      add_action('wp', 'basicbootstrap_error_pages');
 *
 * @since WP_Basic_Bootstrap 1.0
 */
function basicbootstrap_error_pages()
{
    $status = basicbootstrap_get_status();
    if ($status == 404) {
        set_error_404(false, true);
    } elseif ($status == 403) {
        set_error_403(false, true);
    } elseif ($status == 401) {
        set_error_401(false, true);
    }
}

/**
 * Process the title of 401 & 403 error pages
 *
 * To use this feature, write:
 *
 *      add_filter('wp_title', 'basicbootstrap_error_title', 100, 2);
 *
 * The `wp_title` filter is documented in `wp-includes/general-template.php`.
 *
 * @param string $title
 * @param string $sep
 * @return string
 * @since WP_Basic_Bootstrap 1.0
 */
function basicbootstrap_error_title($title = '', $sep = '')
{
    if (is_403()) {
        return sprintf(__('Forbidden Access', 'basicbootstrap') . ' %s %s', $sep, get_bloginfo('name'));
    } elseif (is_401()) {
        return sprintf(__('Unauthorized', 'basicbootstrap') . ' %s %s', $sep, get_bloginfo('name'));
    }
}

/**
 * Process the body classes of 401 & 403 error pages
 *
 * To use this feature, write:
 *
 *      add_filter('body_class', 'basicbootstrap_error_class');
 *
 * The `body_class` filter is documented in `wp-includes/post-template.php`.
 *
 * @param $classes
 * @return array
 * @since WP_Basic_Bootstrap 1.0
 */
function basicbootstrap_error_class($classes)
{
    if (is_403()) {
        $classes[] = "error403";
    } elseif (is_401()) {
        $classes[] = "error401";
    }
    return $classes;
}
