<?php
/**
 * Template for displaying Taxonomies Archive pages
 *
 * Custom taxonomies use the following template file path:
 *
 *      1.  taxonomy-{taxonomy}-{term}.php – If the taxonomy is sometax, and taxonomy's term is someterm, WordPress will look for taxonomy-sometax-someterm.php. In the case of post formats, the taxonomy is ‘post_format' and the terms are ‘post-format-{format}. i.e. taxonomy-post_format-post-format-link.php for the link post format.
 *      2.  taxonomy-{taxonomy}.php – If the taxonomy were sometax, WordPress would look for taxonomy-sometax.php.
 *      3.  taxonomy.php
 *      4.  archive.php
 *      5.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#custom-taxonomies
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

get_header_hierarchical('taxonomy'); ?>

<section id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <header class="header">
        <h1 class="entry-title">
            <?php the_archive_title(); ?>
        </h1>
<?php // marchpô
/*
        <?php if (get_basicbootstrap_mod('show_edit_links')) : ?>
        <section class="entry-meta blog-post-meta">
            <?php
            edit_term_link(
                __('Edit', 'basicbootstrap'),
                '<i class="fa fa-pencil-square fa-fw"></i>&nbsp;',
                '</span>',
                get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))
            );
            ?>
        </section>
        <?php endif; ?>
*/
?>
        <?php the_archive_description('<div class="taxonomy-description lead">', '</div>'); ?>
    </header>
    <hr />
    <?php get_template_part_hierarchical('partials/loop'); ?>

</section>

<?php get_sidebar_hierarchical('taxonomy'); ?>
<?php get_footer_hierarchical('taxonomy'); ?>
