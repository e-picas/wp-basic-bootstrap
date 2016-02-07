<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

// the required abstract parent
basicbootstrap_load_class('WP_Basic_Bootstrap_Customizer_Abstract');

/**
 * Class WP_Basic_Bootstrap_Customizer
 *
 * Defines the settings of the theme for the customizer admin panel.
 * Generates related CSS rules for the header.
 *
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @since WP_Basic_Bootstrap 1.0
 */
class WP_Basic_Bootstrap_Customizer extends WP_Basic_Bootstrap_Customizer_Abstract
{

    /**
     * @var array
     * @since WP_Basic_Bootstrap 1.0
     */
    protected $defaults;

    /**
     * This hooks into 'customize_register' (available as of WP 3.4) and allows
     * you to add new sections and controls to the Theme Customize screen.
     *
     * Note: To enable instant preview, we have to actually write a bit of custom
     * javascript. See live_preview() for more.
     *
     * @see add_action('customize_register',$func)
     * @param \WP_Customize_Manager $wp_customizer
     * @link http://ottopress.com/2012/how-to-leverage-the-theme-customizer-in-your-own-themes/
     * @since WP_Basic_Bootstrap 1.0
     */
    public static function register($wp_customizer)
    {
        $_this = self::getInstance($wp_customizer);

        basicbootstrap_load_config('customizer');
        global $basicbootstrap_customizer_config;
        $_this->processData($basicbootstrap_customizer_config, true);

/*/
// HARD DEBUG OF ALL CONTROLS
        var_dump($_this->customizer->controls());
        exit('yo');
//*/
    }

    /**
     * This outputs the javascript needed to automate the live settings preview.
     * Also keep in mind that this function isn't necessary unless your settings
     * are using 'transport'=>'postMessage' instead of the default 'transport'
     * => 'refresh'
     *
     * @see add_action('customize_preview_init',$func)
     * @since WP_Basic_Bootstrap 1.0
     */
    public static function livePreview()
    {
        wp_enqueue_script('basicbootstrap-customizer',
            get_template_directory_uri() . '/assets/js/theme-customizer.js', array('jquery', 'customize-preview'), BASICBOOTSTRAP_VERSION, true);
    }

    /**
     * Get a default value from plugin's config
     *
     * @param $val
     * @param string $default
     * @return string
     * @uses basicbootstrap_get_config()
     * @since WP_Basic_Bootstrap 1.0
     */
    public function getDefault($val, $default = '')
    {
        if (empty($this->defaults)) {
            $this->defaults = basicbootstrap_get_config('defaults');
        }
        return isset($this->defaults[$val]) ? $this->defaults[$val] : $default;
    }

    /**
     * This will output the custom WordPress settings to the live theme's WP head.
     *
     * Used by hook: 'wp_head'
     *
     * @see add_action('wp_head',$func)
     * @since WP_Basic_Bootstrap 1.0
     */
    public static function headerOutput()
    {
        echo <<<EOT
        <!--Customizer CSS-->
        <style type="text/css">
EOT;

        self::generateCss('.blog-title, .blog-description', 'color', 'header_textcolor', '#');
        self::generateCss('body', 'background-color', 'background_color', '#');
        self::generateCss('.blog-nav .active', 'color', 'background_color', '#');
        self::generateCss('body', 'font-family', 'body_fontfamily');
        self::generateCss('body', 'color', 'body_textcolor');
        self::generateCss('a', 'color', 'link_textcolor');
        self::generateCss('a:hover, a:focus', 'color', 'hover_textcolor');
        self::generateCss('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6', 'font-family', 'headings_fontfamily');
        self::generateCss('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6', 'color', 'headings_textcolor');
        self::generateCss('.navbar', 'font-family', 'menu_fontfamily');
        self::generateCss('.navbar-custom', 'background-color', 'primary_menucolor');
        self::generateCss('.navbar-custom .navbar-brand, .navbar-custom .navbar-nav > li > a', 'color', 'primary_linkcolor');
        self::generateCss('.navbar-custom .navbar-nav > li > a:hover, .navbar-custom .navbar-nav > li > a:focus', 'color', 'primary_hovercolor');
        self::generateCss('.navbar-custom .navbar-nav > .active > a, .navbar-custom .navbar-nav > .active > a:hover, .navbar-custom .navbar-nav > .active > a:focus', 'color', 'primary_activecolor');
        self::generateCss('.navbar-custom .navbar-nav > .active > a, .navbar-custom .navbar-nav > .active > a:hover, .navbar-custom .navbar-nav > .active > a:focus, .navbar-custom .navbar-nav > .open > a, .navbar-custom .navbar-nav > .open > a:hover, .navbar-custom .navbar-nav > .open > a:focus', 'background-color', 'primary_activebackground');
        self::generateCss('.dropdown-menu', 'background-color', 'dropdown_menucolor');
        self::generateCss('.dropdown-menu > li > a, .navbar-custom .navbar-nav .open .dropdown-menu > li > a', 'color', 'dropdown_linkcolor');
        self::generateCss('.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar-custom .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-custom .navbar-nav .open .dropdown-menu > li > a:focus', 'color', 'dropdown_hovercolor');
        self::generateCss('.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar-custom .navbar-nav .open .dropdown-menu > li > a:hover, .navbar-custom .navbar-nav .open .dropdown-menu > li > a:focus', 'background-color', 'dropdown_hoverbackground');
        self::generateCss('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-custom .navbar-nav .open .dropdown-menu > .active > a, .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:focus', 'color', 'dropdown_activecolor');
        self::generateCss('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar-custom .navbar-nav .open .dropdown-menu > .active > a, .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:focus', 'background-color', 'dropdown_activebackground');
        self::generateCss('.blog-footer', 'color', 'footer_textcolor');
        self::generateCss('.blog-footer a', 'color', 'footer_linkcolor');
        self::generateCss('.blog-footer a:hover, .blog-footer a:focus', 'color', 'footer_hovercolor');
        self::generateCss('.blog-footer', 'background-color', 'footer_backgroundcolor');

        $navbar_type = get_basicbootstrap_mod('navbar_type');
        if ($navbar_type == 'fixed_top') {
            echo "body { padding-top: 70px; }";
        } elseif ($navbar_type == 'fixed_bottom') {
            echo "body { padding-bottom: 70px; }";
        }

        echo <<<EOT
        </style>
        <!--/Customizer CSS-->
EOT;
    }

    /**
     * This will generate a line of CSS for use in header output. If the setting
     * ($mod_name) has no defined value, the CSS will not be output.
     *
     * @uses get_theme_mod()
     * @param string $selector CSS selector
     * @param string $style The name of the CSS *property* to modify
     * @param string $mod_name The name of the 'theme_mod' option to fetch
     * @param string $prefix Optional. Anything that needs to be output before the CSS property
     * @param string $postfix Optional. Anything that needs to be output after the CSS property
     * @param bool $echo Optional. Whether to print directly to the page (default: true).
     * @return string Returns a single line of CSS with selectors and a property.
     * @since WP_Basic_Bootstrap 1.0
     */
    public static function generateCss( $selector, $style, $mod_name, $prefix='', $postfix='', $echo=true )
    {
        $return = '';
        $mod = get_basicbootstrap_mod($mod_name);
        if ( ! empty( $mod ) ) {
            $return = sprintf('%s { %s:%s; }',
                $selector,
                $style,
                $prefix.$mod.$postfix
            );
            if ( $echo ) {
                echo $return . PHP_EOL;
            }
        }
        return $return;
    }

}
