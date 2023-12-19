<?php
/**
 * These are debugging functions
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

function dbg_log_template_info($file, $args = [])
{
    $str = '[BASICBOOTSTRAP_TPLDBG] loaded file : '.$file;
    foreach ($args as $arg_name => $arg_val) {
        $str .= " | $arg_name : '$arg_val'";
    }
    error_log($str);
}

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

/**
 * Catch any `test_template=...` URL and try to load concerned PHP template file
 */
add_action('wp', function () {
    if (isset($_GET['test_template'])) {
        $tpl = str_replace('.php', '', $_GET['test_template']) . '.php';
        locate_template($tpl, true, false);
        die();
    }
});

/**
 * Special admin page to debug all theme_mods
 */
add_action('admin_menu', 'dbg_theme_mods_menu');
function dbg_theme_mods_menu()
{
    add_theme_page(
        'Theme debug',
        'Theme debug',
        'manage_options',
        'dbg_theme_mods_page.php',
        'dbg_theme_mods_page'
    );
}

function dbg_theme_mods_page()
{
    $params = array_merge($_GET, array('flush_mods' => true));
    $features = array(
        'post-thumbnails',
        'post-formats',
        'custom-header',
        'custom-background',
        'menus',
        'automatic-feed-links',
        'editor-style',
        'widgets',
        'html5',
        'title-tag'
    );
    echo '<h1>Debugging of theme options</h1>';
    if (isset($_GET['flush_mods'])) {
        remove_theme_mods();
        echo '<strong>"theme_mods" are flushed !</strong>';
    }
    echo '<a href="?'
        .http_build_query($params)
        .'" class="button">Flush all "theme_mods"</a>';
    echo '<hr />';
    echo '<h2>Theme supports</h2>';
    echo '<table class="wp-list-table widefat fixed striped">';
    foreach ($features as $feature) {
        $supports = get_theme_support($feature);
        if (!is_bool($supports)) {
            $supports = '<pre>'.var_export($supports, true).'</pre>';
        } else {
            $supports = $supports === true ? 'true' : 'false';
        }
        echo '<tr><td><strong>'
            .$feature . '</strong></td><td>'
            .$supports
            .'</td></tr>';
    }
    echo '</table>';
    echo '<hr />';
    echo '<h2>Registered sidebars</h2>';
    global $wp_registered_sidebars;
    echo '<table class="wp-list-table widefat fixed striped">';
    foreach ($wp_registered_sidebars as $name => $sidebar) {
        echo '<tr><td><strong>'
            .$name . '</strong></td><td><pre>'
            .var_export($sidebar, true)
            .'</pre></td></tr>';
    }
    echo '</table>';
    echo '<hr />';
    echo '<h2>Registered menus</h2>';
    $nav_menus = get_registered_nav_menus();
    echo '<table class="wp-list-table widefat fixed striped">';
    foreach ($nav_menus as $name => $menu) {
        echo '<tr><td><strong>'
            .$name . '</strong></td><td><pre>'
            .var_export($menu, true)
            .'</pre></td></tr>';
    }
    echo '</table>';
    echo '<hr />';
    echo '<h2>Actual "theme_mods"</h2>';
    $theme_mods = get_theme_mods();
    echo '<table class="wp-list-table widefat fixed striped">';
    foreach ($theme_mods as $name => $item) {
        echo '<tr><td><strong>'
            .$name . '</strong></td><td><pre>'
            .var_export($item, true)
            .'</pre></td></tr>';
    }
    echo '</table>';
}
