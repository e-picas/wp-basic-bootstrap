<?php
/**
 * These are debugging functions
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * DEBUG FCT to get the base template currently used
 *
 * usage:
 *
 *      error_log('included base template: '.var_export(dbg_get_current_template(),1));
 *
 * @link http://wordpress.stackexchange.com/a/10565/74939
 */
function dbg_var_template_include($t)
{
    global $current_theme_template;
    $current_theme_template = str_replace(ABSPATH, '', $t);
    return $t;
}
function dbg_get_current_template()
{
    global $current_theme_template;
    return isset($current_theme_template) ? $current_theme_template : null;
}
add_filter('template_include', 'dbg_var_template_include', 1000);

