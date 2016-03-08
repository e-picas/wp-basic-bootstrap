<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
$audio_host_type    = get_post_meta(get_the_ID(), 'post-format-audio-host-type', true);
$audio_self_hosted  = rwmb_meta('post-format-shaudio', $args = array('type' => 'file_advanced'), get_the_ID());
$audio_embed        = rwmb_meta('post-format-audio-embed-code', $args = array('type' => 'textarea'), get_the_ID());
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('blog-post'); ?> itemscope itemtype="http://schema.org/AudioObject">

    <?php if ($audio_host_type == 'embeded') : ?>
        <div class="featured-media" itemprop="contentUrl">
            <?php echo $audio_embed; ?>
        </div>
    <?php elseif (!empty($audio_self_hosted)) :
        get_template_part_hierarchical_fetch('partials/formats/audio', '', array(
            'post' => get_post(),
            'audio_self_hosted' => $audio_self_hosted
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
    <div class="visible-print print-separator"></div>
    <div class="blog-post-content" itemprop="description">

        <?php if (has_post_thumbnail()) : ?>
            <div class="center-block">
                <?php the_post_thumbnail('post-thumbnail', array(
                    'class'=>'img-responsive size-post-thumbnail'
                )); ?>
            </div>
        <?php endif; ?>

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
