<?php
/**
 * Template for displaying 401 pages (Unauthorized)
 *
 * This is a new template created for the theme.
 * It is used and displayed by the `includes/error-pages.php` library.
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

    <?php get_the_breadcrumb(); ?>

    <article id="post-0" class="post not-found">
        <header class="header">
            <h1 class="entry-title"><?php _e('Unauthorized Access', 'basicbootstrap'); ?></h1>
        </header>
        <section class="entry-content">
            <h2 class="center"><?php _e('This is somewhat embarrassing, isn&rsquo;t it?', 'basicbootstrap'); ?></h2>
            <p class="center">
                <?php _e('It seems you don&rsquo;t have the permissions to access what you&rsquo;re looking for. Perhaps searching can help.', 'basicbootstrap'); ?>
            </p>
        </section>
        <?php get_search_form(); ?>
    </article>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
