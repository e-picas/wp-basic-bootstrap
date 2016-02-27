<?php
/**
 * Template for displaying all single posts
 *
 * The single post template file is used to render a single post. WordPress uses the following path:
 *
 *      1.  single-{post-type}-{slug}.php – (Since 4.4) First, WordPress looks for a template for the specific post.
 *          For example, if post type is product and the post slug is dmc-12, WordPress would look for single-product-dmc-12.php.
 *      2.  single-{post-type}.php – If the post type is product, WordPress would look for single-product.php.
 *      3.  single.php – WordPress then falls back to single.php.
 *      4.  singular.php – Then it falls back to singular.php.
 *      5.  index.php – Finally, as mentioned above, WordPress ultimately falls back to index.php.
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template = get_template_type();
$page_type = get_page_type();
$singular_type = get_singular_type();

/*/
error_log('from file : '.__FILE__);
error_log('page type : '.$page_type);
error_log('singular type : '.$singular_type);
error_log('applied template : '.$template);
//*/

get_header_hierarchical('single'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <?php
    get_template_part_hierarchical('partials/loop');
    //get_template_part_singular('partials/loop');
    ?>

</div>

<?php get_sidebar_hierarchical('single'); ?>
<?php get_footer_hierarchical('single'); ?>
