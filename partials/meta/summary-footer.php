<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__);
}

/* @var $post \WP_Post */
global $post;
?>
<div class="entry-meta blog-post-meta">

    <?php if (get_post_status() == 'private') : ?>
        <i class="fas fa-lock fa-fw"></i>&nbsp;<span class="entry-meta-item post-protected"><?php _e('Private', 'basicbootstrap'); ?></span>
    <?php elseif (post_password_required()) : ?>
        <i class="fas fa-lock fa-fw"></i>&nbsp;<span class="entry-meta-item post-protected"><?php _e('Protected', 'basicbootstrap'); ?></span>
    <?php endif; ?>

    <?php if (get_basicbootstrap_mod('show_author_meta')) : ?>
        <i class="fa fa-user fa-fw"></i>&nbsp;<cite class="entry-meta-item author vcard"
    <?php else: ?>
    <cite class="entry-meta-item author vcard" style="display: none;"
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
            <span class="entry-meta-item cat-links" style="display: none;"
        <?php endif; ?>
        itemprop="isPartOf"><?php the_category(', '); ?></span>
    <?php endif; ?>

    <?php if (has_tag()) : ?>
        <?php if (get_basicbootstrap_mod('show_post_tags')) : ?>
            <i class="fa fa-tags fa-fw"></i>&nbsp;<span class="entry-meta-item tag-links"
        <?php else: ?>
            <span class="entry-meta-item tag-links" style="display: none;"
        <?php endif; ?>
        itemprop="about"><?php the_tags('', ' ', ''); ?></span>
    <?php endif; ?>

    <?php if (get_basicbootstrap_mod('show_comments_link') && comments_open()) : ?>
        <i class="fa fa-comments fa-fw"></i>&nbsp;<span class="entry-meta-item comments-link"><?php
            comments_popup_link(
                __('0 Comments', 'basicbootstrap'),
                __('1 Comment', 'basicbootstrap'),
                __('% Comments', 'basicbootstrap')
            );
            ?></span>
    <?php endif; ?>

</div>
