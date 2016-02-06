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

/*/
error_log('from file : '.__FILE__);
error_log('page type : '.$page_type);
error_log('applied template : '.$template);
//*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?> role="document" itemscope="itemscope" itemtype="http://schema.org/WebPage">

<a href="#content" class="sr-only sr-only-focusable"><?php _e('Skip to main content', 'basicbootstrap'); ?></a>
<a href="#navigation" class="sr-only sr-only-focusable"><?php _e('Skip to main navigation', 'basicbootstrap'); ?></a>
<?php if ($template != 'full_width') : ?>
<a href="#sidebar" class="sr-only sr-only-focusable"><?php _e('Skip to page sidebar', 'basicbootstrap'); ?></a>
<?php endif; ?>
<a href="#footer" class="sr-only sr-only-focusable"><?php _e('Skip to page footer', 'basicbootstrap'); ?></a>

<div id="wrapper" class="hfeed">

<?php if ($navbar_type != 'default') : ?>
    <?php get_template_part('partials/layout/navbar'); ?>
<?php endif; ?>

    <div class="container">

        <?php get_template_part('partials/layout/header'); ?>
        <?php if ($navbar_type == 'default') : ?>
            <?php get_template_part('partials/layout/navbar'); ?>
        <?php endif; ?>

        <div class="row">

            <?php if ($template == 'left_sidebar') : ?>
                <?php if (is_rtl()) : ?>
                <div class="col-sm-9 blog-main-left" itemprop="mainContentOfPage">
                <?php else : ?>
                <div class="col-sm-9 blog-main-right" itemprop="mainContentOfPage">
                <?php endif; ?>
            <?php elseif ($template == 'right_sidebar') : ?>
                <div class="col-sm-9 blog-main-left" itemprop="mainContentOfPage">
            <?php else : ?>
                <div class="col-sm-12 blog-main" itemprop="mainContentOfPage">
            <?php endif; ?>
