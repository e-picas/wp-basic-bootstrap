<?php
/**
 * Template for displaying 404 pages (Not Found)
 *
 * 404 template files are called in this order:
 *
 *      1.  404.php
 *      2.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#404-not-found
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template = get_template_type();
$page_type = get_page_type();

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__, ['page_type'=>$page_type, 'template_type'=>$template]);
}

get_header_hierarchical('404'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <article id="post-0" class="post not-found jumbotron">
        <header class="header">
            <h1 class="entry-title"><?php _e('Not Found', 'basicbootstrap'); ?></h1>
        </header>
        <section class="entry-content">
            <h2 class="text-center"><?php esc_html_e('This is somewhat embarrassing, isn&rsquo;t it?', 'basicbootstrap'); ?></h2>
            <p class="text-center">
                <?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'basicbootstrap'); ?>
            </p>
        </section>
        <?php get_search_form_hierarchical(); ?>
    </article>

</div>

<?php get_sidebar_hierarchical('404'); ?>
<?php get_footer_hierarchical('404'); ?>
