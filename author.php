<?php
/**
 * Template for displaying Author Archive pages
 *
 * Rendering author archive index pages is fairly explanatory:
 *
 *      1.  author-{nicename}.php – If the author's nice name is matt, WordPress will look for author-matt.php.
 *      2.  author-{id}.php – If the author's ID were 6, WordPress will look for author-6.php.
 *      3.  author.php
 *      4.  archive.php
 *      5.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#author-display
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

get_header_hierarchical('author'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <header class="header">
        <div class="author-avatar float-left">
            <?php echo get_avatar(get_the_author_meta('email'), '160', '', esc_attr(get_the_author()), array(
                'class' => 'thumbnail'
            ));  ?>
        </div>
        <h1 class="entry-title author">
            <?php printf(
                __('About %s', 'basicbootstrap'),
                '<span class="vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta("ID"))) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . '</a></span>'
            ); ?>
        </h1>
        <?php if ('' != get_the_author_meta('user_description')) : ?>
        <div class="author-description">
            <?php echo apply_filters('archive_meta', get_the_author_meta('user_description')); ?>
        </div>
        <?php endif; ?>
        <?php get_template_part_hierarchical('partials/meta/content-header'); ?>
    </header>
    <div class="clearfix"></div>
    <hr />
    <h2>
        <?php echo sprintf(
            __('Posts by %s', 'basicbootstrap'),
            get_the_author()
        ); ?>
    </h2>
    <?php get_template_part_hierarchical('partials/loop'); ?>

</div>

<?php get_sidebar_hierarchical('author'); ?>
<?php get_footer_hierarchical('author'); ?>
