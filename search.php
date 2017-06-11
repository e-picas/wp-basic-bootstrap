<?php
/**
 * Template for displaying Search Results pages
 *
 * Search results follow the same pattern as other template types:
 *
 *      1.  search.php
 *      2.  index.php
 *
 * Learn more: https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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

get_header_hierarchical('search'); ?>

<div id="content" role="main">

    <?php get_the_breadcrumb(); ?>

    <header class="header">
        <h1 class="entry-title">
            <?php printf(__('Search results for "%s"', 'basicbootstrap'), '<span>' . get_search_query() . '</span>'); ?>
        </h1>
    </header>
    <hr />
    <?php if (have_posts()) : ?>
        <?php get_template_part_hierarchical('partials/loop'); ?>
    <?php else: ?>
        <article id="post-0" class="post no-results not-found">
            <header class="header">
                <h2 class="entry-title"><?php _e('Nothing Found', 'basicbootstrap'); ?></h2>
            </header>
            <section class="entry-content">
                <p><?php _e('Sorry, nothing matched your search. Please try again.', 'basicbootstrap'); ?></p>
                <?php get_search_form_hierarchical(); ?>
            </section>
        </article>
    <?php endif; ?>

</div>

<?php get_sidebar_hierarchical('search'); ?>
<?php get_footer_hierarchical('search'); ?>
