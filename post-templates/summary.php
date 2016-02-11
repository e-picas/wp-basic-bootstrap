<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post-summary'); ?> itemscope itemtype="http://schema.org/Article">

    <?php get_template_part_hierarchical('partials/post-thumbnail', get_post_format()); ?>

    <div class="post-inner-wrap clearfix">

        <header class="blog-post-header">
            <?php get_template_part_hierarchical('partials/meta/summary-header', get_post_format()); ?>
            <h2 class="blog-post-title" itemprop="name">
                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
                <?php if (is_sticky()): ?>
                <small class="featured">
                    <?php esc_html_e('Featured', 'basicbootstrap') ?>
                </small>
                <?php endif; ?>
            </h2>
        </header>

        <?php if (get_post_type() != 'page') : ?>
            <footer class="blog-post-footer">
                <?php get_template_part_hierarchical('partials/meta/summary-footer', get_post_format()); ?>
            </footer>
        <?php endif; ?>

        <section class="blog-post-excerpt" itemprop="description">
            <?php the_excerpt(); ?>
        </section>

    </div>

</article>




