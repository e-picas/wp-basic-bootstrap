<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope itemtype="http://schema.org/Article">
    <header>
        <h1 class="blog-post-title" itemprop="name">
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
    <div class="visible-print print-separator"></div>
    <div class="blog-post-content" itemprop="articleBody">

        <?php if (has_post_thumbnail()) : ?>
            <div class="center-block">
                <?php the_post_thumbnail('post-thumbnail', array(
                    'class'=>'img-responsive size-post-thumbnail'
                )); ?>
            </div>
        <?php endif; ?>

        <?php
        get_template_part_hierarchical_fetch('partials/formats/link', '', array(
            'post'  => get_post(),
            'link'  => get_post_meta(get_the_ID(), 'post-format-link-url', true),
            'title' => get_post_meta(get_the_ID(), 'post-format-link-title', true),
        ));
        ?>

        <?php the_content(); ?>
        <div class="blog-post-links"><?php get_the_link_pages(); ?></div>
    </div>

    <div class="hidden-print">
        <?php if (
            (is_page() && get_basicbootstrap_mod('show_sharing_links_page')) ||
            (!is_page() && get_basicbootstrap_mod('show_sharing_links_post'))
        ) : ?>
            <?php get_template_part_hierarchical('partials/social-share', get_post_format()); ?>
        <?php endif; ?>
    </div>

</article>
