<?php
/**
 * Template for displaying all attachment medias
 *
 * Rendering an attachment page (attachment post-type) requires following the follow path:
 *
 *      1.  MIME_type.php – it can be any MIME type (For example: image.php, video.php, application.php).
 *          For text/plain, the following path is used (in order):
 *          -   text.php
 *          -   plain.php
 *          -   text_plain.php
 *      2.  attachment.php
 *      3.  single-attachment.php
 *      4.  single.php
 *      5.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#attachment
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

    <?php get_template_part('partials/loop', 'attachment'); ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
