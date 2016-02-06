<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (is_single() && !is_attachment()) : ?>
<section class="entry-meta blog-post-meta">
    <?php $icon = get_post_format_icon(get_post_format()); if (!empty($icon)) : ?>
        <i class="fa fa-<?php echo $icon; ?> fa-fw"></i>&nbsp;<span class="entry-meta-item format-link"><a href="<?php
            echo get_post_format_link(get_post_format()); ?>"><?php _e(get_post_format(), 'basicbootstrap');
        ?></a></span>
    <?php endif; ?>
    <?php $cats = get_the_category(); if (!empty($cats) && !is_attachment()) : ?>
        <i class="fa fa-folder fa-fw"></i>&nbsp;<span class="entry-meta-item cat-links" itemprop="isPartOf"><?php the_category(', '); ?></span>
    <?php endif; ?>
    <?php if (has_tag()) : ?>
        <i class="fa fa-tags fa-fw"></i>&nbsp;<span class="entry-meta-item tag-links" itemprop="about"><?php the_tags('', ' ', ''); ?></span>
    <?php endif; ?>
    <?php if (comments_open()) : ?>
        <i class="fa fa-comments fa-fw"></i>&nbsp;<span class="entry-meta-item comments-link"><?php
            comments_popup_link( __('0 Comments', 'basicbootstrap'), __('1 Comment', 'basicbootstrap'), __('% Comments', 'basicbootstrap') );
        ?></span>
    <?php endif; ?>
    <?php $permalink = site_url('?p=' . get_the_ID()); ?>
    <i class="fa fa-code fa-fw"></i>&nbsp;<span class="entry-meta-item entry-permalink" itemprop="url"><a href="<?php
        echo $permalink;
    ?>" title="<?php
        printf(esc_attr__('Permalink of this content: %s', 'basicbootstrap'), esc_attr($permalink));
    ?>"><?php
        _e('Permanent link', 'basicbootstrap');
    ?></a></span>
    <?php edit_post_link(__('Edit', 'basicbootstrap'), '<i class="fa fa-pencil-square fa-fw"></i>&nbsp;'); ?>
</section>
<?php endif; ?>
