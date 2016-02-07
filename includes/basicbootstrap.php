<?php
/**
 * This file defines few "core" theme functions to get a configuration value or
 * load a theme's class or dependency.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Get a well-formatted path
 *
 * @param $parts
 * @return string
 */
function basicbootstrap_get_path($parts)
{
    return implode(DIRECTORY_SEPARATOR, array_map(
        function ($p) { return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $p); },
        is_array($parts) ? $parts : array($parts)
    ));
}

/**
 * Get a config table (whole or sub-item)
 *
 * @since WP_Basic_Bootstrap 1.0
 * @param null|string $item The name of a config entry to retrieve
 * @return null|mixed
 */
function basicbootstrap_get_config($item = null)
{
    global $basicbootstrap_config;

    $value = (!is_null($item) ? (
        isset($basicbootstrap_config[$item]) ? $basicbootstrap_config[$item] : null
    ) : $basicbootstrap_config);

    /**
     * Filter the theme's config items
     *
     * @since WP_Basic_Bootstrap 1.0
     *
     * @param mixed $value The item value to return
     * @param null|string $name The requested entry if so
     * @return mixed Must return the config item value
     */
    $value = apply_filters('basicbootstrap_config_items', $value, $item);

    return $value;
}

/**
 * Load a theme's config file
 *
 * @param string $name The name of the config file
 * @throws \ErrorException If requested library can not be found
 */
function basicbootstrap_load_config($name)
{
    if (is_string($name)) {
        if (file_exists($src = basicbootstrap_get_path(array(
            BASICBOOTSTRAP_BASEPATH, 'includes', 'config', $name.'.php'
        )))) {
            require_once $src;
        } else {
            throw new ErrorException(
                sprintf('Configuration file "%s" not found!', $name)
            );
        }
    }
}

/**
 * Load a theme's simple script (not a class)
 *
 * @param string $name The name of the library
 * @throws \ErrorException If requested library can not be found
 */
function basicbootstrap_load_library($name)
{
    if (is_string($name)) {
        if (file_exists($src = basicbootstrap_get_path(array(
            BASICBOOTSTRAP_BASEPATH, 'includes', $name.'.php'
        )))) {
            require_once $src;
        } else {
            throw new ErrorException(
                sprintf('Library "%s" not found!', $name)
            );
        }
    }
}

/**
 * Load a theme's class
 *
 * @param string $name The name of the class
 * @throws \ErrorException If requested class can not be found
 */
function basicbootstrap_load_class($name)
{
    if (is_string($name) && !class_exists($name)) {
        $filename = $name . '.php';
        if (file_exists($src = basicbootstrap_get_path(array(
            BASICBOOTSTRAP_BASEPATH, 'includes', 'src', $filename
        )))) {
            require $src;
        } elseif (file_exists($vendor = basicbootstrap_get_path(array(
            BASICBOOTSTRAP_BASEPATH, 'includes', 'vendor', $filename
        )))) {
            require $vendor;
        } else {
            throw new ErrorException(
                sprintf('Class "%s" not found!', $name)
            );
        }
    }
}
