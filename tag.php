<?php
/**
 * Template for displaying Tag Archive pages
 *
 * To display a tag archive index page, WordPress uses the following path:
 *
 *      1.  tag-{slug}.php – If the tag's slug is sometag, WordPress will look for tag-sometag.php.
 *      2.  tag-{id}.php – If the tag's ID is 6, WordPress will look for tag-6.php.
 *      3.  tag.php
 *      4.  archive.php
 *      5.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#tag
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

get_header('tag'); ?>

<section id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <header class="header">
        <h1 class="entry-title">
            <?php the_archive_title(); ?>
        </h1>
        <section class="entry-meta blog-post-meta">
            <?php edit_link_if_so('tag'); ?>
        </section>
        <?php the_archive_description('<div class="tag-description lead">', '</div>'); ?>
    </header>
    <hr />
    <?php get_template_part('partials/loop', 'tag'); ?>

</section>

<?php get_sidebar('tag'); ?>
<?php get_footer('tag'); ?>
