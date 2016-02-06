<?php
/*
 * Template Name: Full-width Page Template, No Sidebar
 */

$template = get_template_type();
$page_type = get_page_type();

get_header(); ?>

<section id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <?php get_template_part('partials/loop', 'page'); ?>

</section>

<?php get_footer(); ?>
