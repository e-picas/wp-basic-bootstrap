<?php
/**
 * Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">.
 *
 * Learn more: https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#header-php
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template       = get_template_type();
$page_type      = get_page_type();
$navbar_type    = get_basicbootstrap_mod('navbar_type');

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__, ['page_type'=>$page_type, 'template_type'=>$template]);
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">

<a href="#content" class="sr-only sr-only-focusable"><?php _e('Skip to main content', 'basicbootstrap'); ?></a>
<a href="#navigation" class="sr-only sr-only-focusable"><?php _e('Skip to main navigation', 'basicbootstrap'); ?></a>
<?php if (strpos($template, 'full_width')===false) : ?>
<a href="#sidebar" class="sr-only sr-only-focusable"><?php _e('Skip to page sidebar', 'basicbootstrap'); ?></a>
<?php endif; ?>
<a href="#footer" class="sr-only sr-only-focusable"><?php _e('Skip to page footer', 'basicbootstrap'); ?></a>

<?php if (strpos($navbar_type, 'fixed') !== false) : ?>
    <?php get_template_part_hierarchical('partials/layout/navbar'); ?>
<?php endif; ?>

<div id="wrapper" class="hfeed">

<?php if (strpos($navbar_type, 'static') !== false) : ?>
    <?php get_template_part_hierarchical('partials/layout/navbar'); ?>
<?php endif; ?>

<?php if ($template == 'full_width_fluid') : ?>
    <div class="container-fluid">
<?php else : ?>
    <div class="container">
<?php endif; ?>

        <?php get_template_part_hierarchical('partials/layout/header'); ?>
        <?php if ($navbar_type == 'default') : ?>
            <?php get_template_part_hierarchical('partials/layout/navbar'); ?>
        <?php endif; ?>

            <?php if ($template == 'left_sidebar') : ?>
                <?php if (is_rtl()) : ?>
                <div class="col-xs-12 col-sm-9 blog-main-left" itemprop="mainContentOfPage">
                <?php else : ?>
                <div class="col-xs-12 col-sm-9 blog-main-right" itemprop="mainContentOfPage">
                <?php endif; ?>
            <?php elseif ($template == 'right_sidebar') : ?>
                <div class="col-xs-12 col-sm-9 blog-main-left" itemprop="mainContentOfPage">
            <?php elseif ($template == 'full_width_offset') : ?>
                <div class="col-xs-12 col-sm-10 col-md-offset-1 blog-main" itemprop="mainContentOfPage">
            <?php else : ?>
                <div class="col-xs-12 blog-main" itemprop="mainContentOfPage">
            <?php endif; ?>
