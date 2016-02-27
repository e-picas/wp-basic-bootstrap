<?php
/**
 * Template for displaying all single pages
 *
 * The template file used to render a static page (page post-type).
 * Note that unlike other post-types, page is special to WordPress and uses the following patch:
 *
 *      1.  custom template file – The page template assigned to the page. See get_page_templates().
 *      2.  page-{slug}.php – If the page slug is recent-news, WordPress will look to use page-recent-news.php.
 *      3.  page-{id}.php – If the page ID is 6, WordPress will look to use page-6.php.
 *      4.  page.php
 *      5.  singular.php
 *      6.  index.php
 *
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
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

get_header_hierarchical('page'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <?php get_template_part_hierarchical('partials/loop'); ?>

</div>

<?php get_sidebar_hierarchical('page'); ?>
<?php get_footer_hierarchical('page'); ?>
