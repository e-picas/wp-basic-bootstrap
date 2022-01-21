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
$video_host_type    = get_post_meta(get_the_ID(), 'post-format-video-host-type', true);
$video_self_hosted  = rwmb_meta('post-format-shvideo', $args = array('type' => 'file_advanced'), get_the_ID());
$video_embed        = rwmb_meta('post-format-video-embed-code', $args = array('type' => 'textarea'), get_the_ID());
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope itemtype="http://schema.org/VideoObject">

    <?php
    if ($video_host_type == 'embeded') : ?>
        <div class="featured-media" itemprop="contentUrl">
            <?php echo $video_embed; ?>
        </div>
    <?php elseif (!empty($video_self_hosted)) :
        get_template_part_hierarchical_fetch('partials/formats/video', '', array(
            'post' => get_post(),
            'video_self_hosted' => $video_self_hosted
       ));
    endif; ?>

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
    <div class="d-none d-print-block print-separator"></div>
    <div class="blog-post-content" itemprop="description">

        <?php if (has_post_thumbnail()) : ?>
            <div class="mx-auto">
                <?php the_post_thumbnail('post-thumbnail', array(
                    'class'=>'img-fluid size-post-thumbnail'
                )); ?>
            </div>
        <?php endif; ?>

        <?php the_content(); ?>
        <div class="blog-post-links"><?php get_the_link_pages(); ?></div>
    </div>

    <div class="d-print-none">
        <?php if (
            (is_page() && get_basicbootstrap_mod('show_sharing_links_page')) ||
            (!is_page() && get_basicbootstrap_mod('show_sharing_links_post'))
        ) : ?>
            <?php get_template_part_hierarchical('partials/social-share', get_post_format()); ?>
        <?php endif; ?>
    </div>

</article>
