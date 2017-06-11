WP Basic Bootstrap - Developers manual
======================================

This manual is a documentation of how to use the *WP Basic Bootstrap* theme in your development work: how it is built, how
to use its features and how to customize it.

Before reading this document, you should begin by the [User Manual](USER_MANUAL.md), which presents the theme's structure
and a general usage for designers and users.


Scripts & namespaces
--------------------

The PHP "pure" scripts of the theme (anything but a template) are all included in the `includes/` sub-directory. You can
include any file from the root of this directory using the `basicbootstrap_load_library( file_name )` function, where
the `file_name` argument is the name of the file, without extension (the file must exist at the root of the `includes/`
sub-directory). The functions of these libraries are prefixed, when necessary, by a simple `basicbootstrap` string. None
of the functions of the theme are embedded in a `if function_exists()` test so you **can not** overwrite them. To customize
one of the theme's features, use its [**hooks**](#theme-hooks).

The internal classes are stored in the `includes/src/` sub-directory and prefixed with `WP_Basic_Bootstrap`. The embedded 
dependencies are stored in the `includes/vendor/` sub-directory. These classes are stored in files named **exactly** like
the class name. You can include any class file from one of these directories using the 
`basicbootstrap_load_class( class_name )` function.

No auto-loader is defined for theme's classes so you **must** load them manually using the function described above.

All classes, methods and functions are documented.


Third-parties
-------------

The theme embeds the following PHP third-parties:

-   [TGM_Plugin_Activation](http://tgmpluginactivation.com/)
-   [wp_bootstrap_navwalker](http://github.com/twittem/wp-bootstrap-navwalker)
-   [wp-template-hierarchy-everywhere](http://github.com/e-picas/wp-template-hierarchy-everywhere)


Theme options, defaults & configuration
---------------------------------------

The various configurations of the theme are embedded in the `includes/config/` sub-directory. You can load one of them using
the `basicbootstrap_load_config( file_name )` function. You can access one of the `defaults` configuration entry (which is
an array most of the time) with the `basicbootstrap_get_config( item_name )` function.

All options used by the theme at runtime and updatable by the user via the admin's customizer are stored as [`theme_mod`](https://codex.wordpress.org/Theme_Modification_API).
They are all stored with their default values in the `basicbootstrap_get_config( defaults )` array item. To retrieve their
actual values, eventually modified by the customizer, use the `get_basicbootstrap_mod( name )` function.


Theme hooks & filters
---------------------

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

    /**
     * Filter the theme_mod values
     *
     * @since WP_Basic_Bootstrap 1.0
     *
     * @param mixed $mod The theme_mod value
     * @param string $name The theme_mod name
     * @return mixed Must return the theme_mod value
     */
    $mod = apply_filters('basicbootstrap_theme_mod', $mod, $name);

    /**
     * Filter the customizer's CSS rules output for frontend
     *
     * @since WP_Basic_Bootstrap 1.0
     *
     * @param string $output The generated CSS output
     * @return string Must return the CSS output
     */
    $output = apply_filters('basicbootstrap_customizer_header_output', $output);

    /**
     * Filter the posts lists layout
     *
     * @since WP_Basic_Bootstrap 1.0
     *
     * @param mixed $layout The given layout
     * @return mixed Must return the layout to use
     */
    $layout = apply_filters('posts_list_layout', $layout);


Introducing the new pages
-------------------------

The theme embeds two new pages to handle HTML error for 401 (*Unauthorized Access*) and 403 (*Forbidden Access*) statuses.

These pages are displayed using the `401.php` and `403.php` templates, just like Wordpress natively use the `404.php` file
to handle *not found* errors. You can customize these two new templates just like you would for the 404.

Some helper functions are defined in the `includes/error-pages.php` file and available in Wordpress at each run.
It basically embeds the following methods:

-   `is_401()` and `is_403()` to test if we are currently displaying one of these pages,
-   `set_error_XXX( $redirect = true , $display = false )` to redirect or display one of the 401, 403 or 404 page
    instead of current page, with related status headers.


Internal Wordpress templating system improvements: "wp template hierarchy everywhere"
-------------------------------------------------------------------------------------

The theme embeds the [wp-template-hierarchy-everywhere](http://github.com/e-picas/wp-template-hierarchy-everywhere) 
external library to improve the internal core Wordpress functions used to build the templates. This library is 
in the `includes/vendor/wp-template-hierarchy-everywhere.php` file ; you should have a look in that file for your 
version of the theme for an updated information.

The library basically embeds two new features:

-   the ability to test if we are currently displaying a *blog* page (anything about posts) or not (any other page like
    a "page" post type, the search page, the 404 etc);
-   an update of the templating fallback system to let you customize the PHP files used to build parts of the whole page
    in a complete logic, including custom post types, post formats and any known page type for Wordpress.

### Using template hierarchy for template parts

The `get_template_part_hierarchical()` is built on the same model as the internal `get_template_part()`:

    get_template_part_hierarchical( string $slug, string $name = null )

Basically, it will try to include first the requested template part file filtered using the basic template hierarchy
of Wordpress, which means something like:

    <slug>-<name>-<page type>-<current object info>.php
    <slug>-<name>-<page type>.php
    <slug>-<name>.php
    <slug>-<page type>.php
    <slug>.php

For example, if you want to include the generic `partials/navbar` file from a "product" post type single page, 
it will search this template in the following order:

-   partials/navbar-single-product-<product slug>.php
-   partials/navbar-single-product-<product ID>.php
-   partials/navbar-single-product.php
-   partials/navbar-single.php
-   partials/navbar-product.php
-   partials/navbar.php

The rules are the same if you specify a "name" argument in your initial call, let's say "footer":

-   first, the "navbar-footer" template is searched:
    -   partials/navbar-footer-single-product-<product slug>.php
    -   partials/navbar-footer-single-product-<product ID>.php
    -   partials/navbar-footer-single-product.php
    -   partials/navbar-footer-single.php
    -   partials/navbar-footer-product.php
    -   partials/navbar-footer.php
-   then it fallbacks to the generic "navbar" template:
    -   partials/navbar-single-product-<product slug>.php
    -   partials/navbar-single-product-<product ID>.php
    -   partials/navbar-single-product.php
    -   partials/navbar-single.php
    -   partials/navbar-product.php
    -   partials/navbar.php

### Include sub-templates with arguments

The first added function is the ability to pass arguments to the template inclusion system of Wordpress: the
[`get_template_part()`](https://developer.wordpress.org/reference/functions/get_template_part/) function. This
is done by defining the new `get_template_part_fetch()` function, with the following signature:

    get_template_part_fetch($slug, $name = null, $args = array())

It uses the core function, first extracting the arguments in the environment to let them available in the included
template.

Example:

    # my-template-1.php
    
    <?php get_template_part_fetch('my-template-part-2', '', array('my_var'=>'my value')); ?>

    
    # my-template-2.php
    
    <?php echo $my_var; ?> // this will output: 'my value'


### Blog vs. non-blog page

One of the new concept introduced by the theme is to separate the pages between two groups:

-   the **blog pages**, which are any page concerning posts which are not a page: a single post, the posts lists,
    a category, a tag or an archive page,
-   the **not-blog pages**, which are basically all other pages that do not concern posts: the search page, an error page,
    an author and the "page" post type.

### Singular pages fallbacks

The theme introduces an enhanced version of the [`get_template_part()`](https://developer.wordpress.org/reference/functions/get_template_part/)
internal Wordpress method used to find a specific template PHP file with a fallback to a generic one if the first does
not exist. The theme extends such concept for the [*singluar* pages](https://codex.wordpress.org/Function_Reference/is_singular)
building a new fallback system which follows native Wordpress [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/).

The new function to use is `get_template_part_singular()`, with the following signature:

    get_template_part_singular($slug, $name = null, $callback = null, $fct_name = null)

Some aliases are proposed for facility, to replace the native `get_header_hierarchical()`, `get_sidebar_hierarchical()` and `get_footer_hierarchical()`:

-   `get_header_singular()`
-   `get_sidebar_singular()`
-   `get_footer_singular()`

A basic example of a `singular.php` template (or any single post template) could be:

    <?php get_header_singular(); ?>
    
    <section id="content" role="main">

        <?php get_template_part_singular('partials/loop'); ?>
    
    </section>
    
    <?php get_sidebar_singular(); ?>
    <?php get_footer_singular(); ?>

This system allows you to customize any of your partial templates by adding its name the slug of the post type, the post
format etc.

Example: let's say your loop includes a template named `content.php` with the following call:

        <?php get_template_part_singular('content'); ?>

If the page displayed is a single custom post type named "product", the function will use any `content-product.php` if it
exists, with fallback to the `content-post.php` file if it exists, with a last fallback to the `content.php` file.

