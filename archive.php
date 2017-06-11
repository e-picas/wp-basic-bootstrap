<?php
/**
 * Template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 *
 * ## Date
 *
 * Date-based archive index pages are rendered as you would expect:
 *
 *      1.  date.php
 *      2.  archive.php
 *      3.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#date
 *
 * ## Custom Post Types
 *
 * Custom Post Types use the following path to render the appropriate archive index page.
 *
 *      1.  archive-{post_type}.php – If the post type is product, WordPress will look for archive-product.php.
 *      2.  archive.php
 *      3.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-post-types
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template = get_template_type();
$page_type = get_page_type();

if (BASICBOOTSTRAP_TPLDBG) {
    error_log('loaded file : '.__FILE__);
    error_log('page type : '.$page_type);
    error_log('applied template : '.$template);
}

get_header_hierarchical('archive'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <header class="header">
        <h1 class="entry-title">
        <?php the_archive_title(); ?>
        </h1>
        <?php the_archive_description('<div class="archive-description lead">', '</div>'); ?>
    </header>
    <hr />
    <?php get_template_part_hierarchical('partials/loop'); ?>

</div>

<?php get_sidebar_hierarchical('archive'); ?>
<?php get_footer_hierarchical('archive'); ?>
