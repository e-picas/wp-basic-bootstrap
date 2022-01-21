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
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope itemtype="http://schema.org/Article">
    <header class="header">
        <h1 class="blog-post-title" itemprop="name">
            <?php the_title(); ?>
        </h1>
        <?php get_template_part_hierarchical('partials/meta/content-header', 'attachment'); ?>
    </header>
    <footer>
        <?php get_template_part_hierarchical('partials/meta/content-footer', 'attachment'); ?>
    </footer>

    <div class="d-none d-print-block print-separator"></div>
    <div class="blog-post-content" itemprop="articleBody">
        <div class="entry-attachment">
            <?php if (wp_attachment_is_image($post->ID)) : $att_image = wp_get_attachment_image_src($post->ID, 'large'); ?>
                <div class="attachment mx-auto">
                    <a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php $post->post_excerpt; ?>" rel="attachment">
                        <img
                            src="<?php echo $att_image[0]; ?>"
                            width="<?php echo $att_image[1]; ?>"
                            height="<?php echo $att_image[2]; ?>"
                            class="img-fluid attachment-medium"
                            alt="<?php $post->post_excerpt; ?>" />
                    </a>
                    <div class="entry-caption"><?php if (! empty($post->post_excerpt)) the_excerpt(); ?></div>
                </div>
            <?php else : ?>
                <a href="<?php echo wp_get_attachment_url($post->ID); ?>" title="<?php echo esc_attr(get_the_title($post->ID), 1); ?>" rel="attachment">
                    <?php echo basename($post->guid); ?>
                    <span class="entry-legend"><?php if (! empty($post->post_excerpt)) the_excerpt(); ?></span>
                </a>
            <?php endif; ?>
        </div>
        <div class="entry-description">
            <?php the_content(); ?>
        </div>

    </div>

    <div class="d-print-none">
        <?php if (get_basicbootstrap_mod('show_sharing_links_attachment')) : ?>
            <?php get_template_part_hierarchical('partials/social-share', 'attachment'); ?>
        <?php endif; ?>
    </div>

</article>
