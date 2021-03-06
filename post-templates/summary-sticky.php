<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (BASICBOOTSTRAP_TPLDBG) {
    error_log('loaded file : '.__FILE__);
}

/* @var $post \WP_Post */
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-summary sticky-summary'); ?> itemscope itemtype="http://schema.org/Article">

    <?php if (has_post_thumbnail()): ?>
    <div class="featured-media sticky-media center-block clearfix">
        <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
            <?php the_post_thumbnail('post-thumbnail', array(
                'class'=>'img-responsive size-post-thumbnail'
            )); ?>
        </a>
    </div>
    <?php endif; ?>

    <div class="post-inner-wrap clearfix">

        <header class="blog-post-header">
            <?php get_template_part_hierarchical('partials/meta/summary-header', get_post_format()); ?>
            <h2 class="blog-post-title" itemprop="name">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h2>
        </header>

        <div class="visible-print print-separator"></div>
        <div class="blog-post-excerpt" itemprop="description">
            <?php the_excerpt(); ?>
        </div>

        <?php if (get_post_type() != 'page') : ?>
        <div class="visible-print print-separator"></div>
        <footer class="blog-post-footer">
            <?php get_template_part_hierarchical('partials/meta/summary-footer', get_post_format()); ?>
        </footer>
        <?php endif; ?>

    </div>

</article>
<hr class="visible-print" />
