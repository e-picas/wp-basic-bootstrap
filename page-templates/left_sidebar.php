<?php
/*
Template Name: Sidebar Left, 2 Columns
*/

$template = get_template_type();
$page_type = get_page_type();

get_header_hierarchical('page'); ?>

<section id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <?php get_template_part_hierarchical('partials/loop', 'left_sidebar'); ?>

</section>

<?php get_sidebar_hierarchical('page'); ?>
<?php get_footer_hierarchical('page'); ?>
