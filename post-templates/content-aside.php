<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope itemtype="http://schema.org/Article">
    <div class="blog-post-content" itemprop="articleBody">

        <?php if (has_post_thumbnail()) : ?>
            <div class="center-block">
                <?php the_post_thumbnail('post-thumbnail', array(
                    'class'=>'img-responsive size-post-thumbnail'
                )); ?>
            </div>
        <?php endif; ?>

        <div class="panel panel-default">
            <div class="panel-body">
                <?php the_content(); ?>
            </div>
        </div>
        <div class="blog-post-links"><?php get_the_link_pages(); ?></div>
    </div>
    <header>
        <h1 class="blog-post-title hidden" itemprop="name">
            <?php if (! is_single() && ! is_page()) : ?>
            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark">
                <?php endif; ?>
                <?php the_title(); ?>
                <?php if (! is_single() && ! is_page()) : ?>
            </a>
        <?php endif; ?>
        </h1>
        <?php if (! is_page()) : ?>
            <?php get_template_part_hierarchical('partials/meta/content-header', get_post_format()); ?>
        <?php endif; ?>
    </header>
    <footer>
        <?php if (! is_page()) : ?>
            <?php get_template_part_hierarchical('partials/meta/content-footer', get_post_format()); ?>
        <?php endif; ?>
    </footer>

    <div class="hidden-print">
        <?php if (
            (is_page() && get_basicbootstrap_mod('show_sharing_links_page')) ||
            (!is_page() && get_basicbootstrap_mod('show_sharing_links_post'))
        ) : ?>
            <?php get_template_part_hierarchical('partials/social-share', get_post_format()); ?>
        <?php endif; ?>
    </div>

</article>
