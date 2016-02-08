<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<section class="entry-meta blog-post-meta">

    <?php if (get_basicbootstrap_mod('show_author_meta')) : ?>
        <i class="fa fa-user fa-fw"></i>&nbsp;<cite class="entry-meta-item author vcard"
    <?php else: ?>
    <cite class="entry-meta-item author vcard hidden"
    <?php endif; ?>
        itemprop="author"><?php
        the_author_posts_link();
    ?></cite>

    <?php
    $cats = get_the_category();
    if (!empty($cats) && !is_attachment()) : ?>
        <?php if (get_basicbootstrap_mod('show_post_cats')) : ?>
            <i class="fa fa-folder fa-fw"></i>&nbsp;<span class="entry-meta-item cat-links"
        <?php else: ?>
            <span class="entry-meta-item cat-links hidden"
        <?php endif; ?>
        itemprop="isPartOf"><?php the_category(', '); ?></span>
    <?php endif; ?>

    <?php if (has_tag()) : ?>
        <?php if (get_basicbootstrap_mod('show_post_tags')) : ?>
            <i class="fa fa-tags fa-fw"></i>&nbsp;<span class="entry-meta-item tag-links"
        <?php else: ?>
            <span class="entry-meta-item tag-links hidden"
        <?php endif; ?>
        itemprop="about"><?php the_tags('', ' ', ''); ?></span>
    <?php endif; ?>

    <?php if (get_basicbootstrap_mod('show_comments_link') && comments_open()) : ?>
        <i class="fa fa-comments fa-fw"></i>&nbsp;<span class="entry-meta-item comments-link"><?php
            comments_popup_link(__('0 Comments', 'basicbootstrap'), __('1 Comment', 'basicbootstrap'), __('% Comments', 'basicbootstrap'));
            ?></span>
    <?php endif; ?>

</section>
