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
$error_type = basicbootstrap_get_status();

if (BASICBOOTSTRAP_TPLDBG && function_exists('dbg_log_template_info')) {
    dbg_log_template_info(__FILE__, ['page_type'=>$page_type, 'template_type'=>$template, 'error_type'=>$error_type]);
}

get_header_hierarchical('401'); ?>

<div id="content" role="main">

    <article id="post-0" class="post not-found jumbotron">
        <header class="header">
            <h1 class="entry-title"><?php _e('Unauthorized Access', 'basicbootstrap'); ?></h1>
        </header>
        <section class="entry-content">
            <h2 class="text-center"><?php _e('This is somewhat embarrassing, isn&rsquo;t it?', 'basicbootstrap'); ?></h2>
            <p class="text-center">
                <?php _e('It seems you don&rsquo;t have the permissions to access what you&rsquo;re looking for. Perhaps searching can help.', 'basicbootstrap'); ?>
            </p>
        </section>
        <?php get_search_form_hierarchical(); ?>
    </article>

</div>

<?php get_sidebar_hierarchical('401'); ?>
<?php get_footer_hierarchical('401'); ?>
