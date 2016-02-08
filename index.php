<?php
/**
 * Main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being `style.css`).
 * It is used to display a page when nothing more specific matches a query.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * ## Home Page display
 *
 * By default, WordPress sets your site's home page to display your latest blog posts.
 * This page is called the blog posts index. You can also set your blog posts to display
 * on a separate static page. The template file home.php is used to render the blog posts
 * index, whether it is being used as the front page or on separate static page.
 * If `home.php` does not exist, WordPress will use `index.php`.
 *
 *      1.  home.php
 *      2.  index.php
 *
 * ## Front page template file
 *
 * The `front-page.php` template file is used to render your site's front page,
 * whether the front page displays the blog posts index or a static page.
 * The front page template takes precedence over the blog posts index (`home.php`) template.
 * If the `front-page.php` file does not exist, WordPress will either use the `home.php` or
 * `page.php` files depending on the setup in "Settings > Reading".
 * If neither of those files exist, it will use the `index.php` file.
 *
 *      1.  front-page.php : Used for both "your latest posts" or "a static page" as set
 *          in the front page displays section of "Settings > Reading".
 *      2.  home.php : If WordPress cannot find front-page.php and "your latest posts" is set
 *          in the front page displays section, it will look for home.php. Additionally,
 *          WordPress will look for this file when the posts page is set in the front page displays section.
 *      3.  page.php : When "front page" is set in the front page displays section.
 *      4.  index.php : When "your latest posts" is set in the front page displays section but home.php
 *          does not exist or when front page is set but page.php does not exist.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template = get_template_type();
$page_type = get_page_type();

/*/
error_log('from file : '.__FILE__);
error_log('page type : '.$page_type);
error_log('applied template : '.$template);
//*/

get_header(); ?>

<section id="content" role="main">

    <?php if (! is_front_page()) : ?>
        <?php get_the_breadcrumb(); ?>
    <?php endif; ?>
    <?php get_template_part('partials/loop'); ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
