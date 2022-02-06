<?php
/**
 * Special handling of 401 & 403 error pages
 *
 * This file adds two new templates to Wordpress (you may create them on the same model as the `404.php` file):
 *
 * -    `401.php` to handle unauthorized errors
 * -    `403.php` to handle forbidden access errors
 * -    `500.php` to handle PHP errors
 *
 * It also embeds some shortcuts functions to redirect a request to an error page or
 * test if we already are on an error page easily:
 *
 * -    `send_error(status)` to display an error page (with correct headers)
 * -    `is_504()`, `is_500()`, `is_404()`, `is_403()` and `is_401()` to test if we currently are on an error page
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Load an error page and display it (optional)
 *
 * @param int $status The error status
 * @param bool $redirect Redirect browser to the page?
 * @param bool $display Display the page?
 * @since WP_Basic_Bootstrap 2.0
 */
function send_error(int $status = 404, $redirect = true, $display = false)
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    $wp_query->set_404();

    switch($status) {
        case 401:
            $wp_query->is_404 = false;
            $wp_query->is_401 = true;
            $message = 'Unauthorized';
            $template = get_401_template();
            break;
        case 403:
            $wp_query->is_404 = false;
            $wp_query->is_403 = true;
            $message = 'Access Forbidden';
            $template = get_403_template();
            break;
        case 404:
        default:
            $template = get_404_template();
            $message = 'Not Found';
            break;
        case 500:
            $wp_query->is_404 = false;
            $wp_query->is_500 = true;
            $message = 'Internal Server Error';
            $template = get_500_template();
            $stamp = uniqid(time(), true);
            break;
        case 504:
            $wp_query->is_404 = false;
            $wp_query->is_504 = true;
            $message = 'Gateway Time-out';
            $template = get_504_template();
            break;
    }

    $uri_status = basicbootstrap_get_status();
    if ($redirect && $uri_status != $status) {
        wp_redirect(site_url('?error='.$status));
    } elseif ($display) {
        status_header($status);
        nocache_headers();
        if (!empty($template)) {
            include $template;
        } else {
            echo "<p>{$message}</p>";
        }
        exit();
    }
}

/**
 * This will generate a uniq ID based on current timestamp
 * and store it in the error logs with the last recovered error
 *
 * @TODO Un-duplicate the error logging (the original internal PHP logging is still present)
 * @param null|array $last_error The error to treat, last one by default
 * @return null|string The uniq ID stored with the last error in the error log file
 * @since WP_Basic_Bootstrap 2.0
 */
function get_error_uniq_id($last_error = null)
{
    $error_uniq_id = null;
    if (is_null($last_error)) {
        $last_error = error_get_last();
    }
    if (!empty($last_error)) {
        $error_uniq_id = uniqid(time(), true);
        error_log(
            '[ERROR UNIQ ID] '.$error_uniq_id.' '.
            '[MAYBE DUPLICATE IN LOGS] '.
            (isset($last_error['message']) ? $last_error['message'] : '(not recovered)')
        );
    }
    return $error_uniq_id;
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
    $error_templates = basicbootstrap_get_config('error_templates');
    return get_query_template(isset($error_templates['403']) ? $error_templates['403'] : 'error');
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
    $error_templates = basicbootstrap_get_config('error_templates');
    return get_query_template(isset($error_templates['401']) ? $error_templates['401'] : 'error');
}

/**
 * Test if current page is the 500 error page
 *
 * @return bool|mixed
 * @since WP_Basic_Bootstrap 1.0
 */
function is_500()
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    return (bool) isset($wp_query->is_500) ? $wp_query->is_500 : false;
}

/**
 * Retrieve path of 500 template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. '500_template'.
 *
 * @see get_query_template()
 * @return string Full path to 500 template file.
 */
function get_500_template()
{
    $error_templates = basicbootstrap_get_config('error_templates');
    return get_query_template(isset($error_templates['500']) ? $error_templates['500'] : 'error');
}

/**
 * Test if current page is the 504 error page
 *
 * @return bool|mixed
 * @since WP_Basic_Bootstrap 1.0
 */
function is_504()
{
    /* @var $wp_query \WP_Query */
    global $wp_query;
    return (bool) isset($wp_query->is_504) ? $wp_query->is_504 : false;
}

/**
 * Retrieve path of 504 template in current or parent template.
 *
 * The template path is filterable via the dynamic {@see '$type_template'} hook,
 * e.g. '504_template'.
 *
 * @see get_query_template()
 * @return string Full path to 504 template file.
 */
function get_504_template()
{
    $error_templates = basicbootstrap_get_config('error_templates');
    return get_query_template(isset($error_templates['504']) ? $error_templates['504'] : 'error');
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
    if (is_403()) {
        $status = 403;
    } elseif (is_401()) {
        $status = 401;
    } elseif (is_500()) {
        $status = 500;
    } elseif (is_504()) {
        $status = 504;
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
    if (in_array($status, [401,403,404,500,504])) {
        send_error($status, false, true);
    } elseif (is_403()) {
        send_error(403, false, true);
    } elseif (is_401()) {
        send_error(401, false, true);
    } elseif (is_500()) {
        send_error(500, false, true);
    } elseif (is_504()) {
        send_error(504, false, true);
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
    } elseif (is_500()) {
        return sprintf(__('Internal Server Error', 'basicbootstrap') . ' %s %s', $sep, get_bloginfo('name'));
    } elseif (is_504()) {
        return sprintf(__('Gateway Time-out', 'basicbootstrap') . ' %s %s', $sep, get_bloginfo('name'));
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
    } elseif (is_500()) {
        $classes[] = "error500";
    } elseif (is_504()) {
        $classes[] = "error504";
    }
    return $classes;
}

/**
 * Set a 'noindex, nofollow' header for robots for all error pages
 *
 * To use this feature, write:
 *
 *      add_filter('wp_robots', 'basicbootstrap_error_pages_robots');
 *
 * @param array $robots
 * @return array
 * @since WP_Basic_Bootstrap 2.0
 */
function basicbootstrap_error_pages_robots($robots = [])
{
    if (is_404() || is_403() || is_401() || is_500() || is_504()) {
        $robots = [
            'noindex'   => 1,
            'nofollow'  => 1,
        ];
    }
    return $robots;
}
