<?php
/**
 * Home template file
 *
 * This will handle the blog page if it is defined on a post in the "Settings > Reading" admin panel.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template = get_template_type();
$page_type = get_page_type();
$show_on_front = get_option('show_on_front');

if (BASICBOOTSTRAP_TPLDBG) {
    error_log('loaded file : '.__FILE__);
    error_log('page type : '.$page_type);
    error_log('applied template : '.$template);
}

get_header_hierarchical('home'); ?>

<div id="content" role="main">

    <?php if ($show_on_front == 'page') : ?>
        <?php get_the_breadcrumb(); ?>
    <?php endif; ?>
    <?php get_template_part_hierarchical('partials/loop'); ?>

</div>

<?php get_sidebar_hierarchical('home'); ?>
<?php get_footer_hierarchical('home'); ?>
