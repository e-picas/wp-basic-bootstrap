<?php
/**
 * Template for displaying Category Archive pages
 *
 * Rendering category archive index pages uses the following path in WordPress:
 *
 *      1.  category-{slug}.php – If the category's slug is news, WordPress will look for category-news.php.
 *      2.  category-{id}.php – If the category's ID is 6, WordPress will look for category-6.php.
 *      3.  category.php
 *      4.  archive.php
 *      5.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#category
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template = get_template_type();
$page_type = get_page_type();

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__, ['page_type'=>$page_type, 'template_type'=>$template]);
}

get_header_hierarchical('category'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <header class="header">
        <h1 class="entry-title">
            <?php the_archive_title(); ?>
        </h1>
        <?php if (get_basicbootstrap_mod('show_edit_links')) : ?>
        <section class="entry-meta blog-post-meta d-print-none">
            <?php edit_category_link(__('Edit', 'basicbootstrap'), '<i class="fas fa-pen-square fa-fw"></i>&nbsp;', '', get_cat_id(single_cat_title('', false))); ?>
        </section>
        <?php endif; ?>
        <?php the_archive_description('<div class="category-description lead">', '</div>'); ?>
    </header>
    <hr />
    <?php get_template_part_hierarchical('partials/loop'); ?>

</div>

<?php get_sidebar_hierarchical('category'); ?>
<?php get_footer_hierarchical('category'); ?>
