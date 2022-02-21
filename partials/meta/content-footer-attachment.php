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
<?php if (is_single() && is_attachment()) : ?>
<div class="entry-meta blog-post-meta">

    <?php if (wp_attachment_is_image($post->ID)) :
        $att_image = wp_get_attachment_image_src($post->ID, 'large'); ?>

        <?php if (get_basicbootstrap_mod('show_attachment_mime_type')) : ?>
        <i class="fas fa-image fa-fw"></i>&nbsp;<span class="entry-meta-item image-mime-links"><?php
            echo get_post_mime_type($post->ID);
        ?></span>
        <?php endif; ?>

        <?php if (get_basicbootstrap_mod('show_attachment_sizes')) : ?>
        <i class="fa fa-camera fa-fw"></i>&nbsp;<span class="entry-meta-item image-meta-links"><?php
            $sizes = wp_get_attachment_image_src(get_the_ID(), 'full');
            echo '<span itemprop="width">'.$sizes[1] . '</span> x <span itemprop="height">' . $sizes[2] . '</span> px.';
        ?></span>
        <?php else: ?>
        <?php
        $sizes = wp_get_attachment_image_src(get_the_ID(), 'full');
        echo '<span style="display: none;" itemprop="width">'.$sizes[1] . '</span> <span style="display: none;" itemprop="height">' . $sizes[2] . '</span>';
        ?>
        <?php endif; ?>

        <?php if (get_basicbootstrap_mod('show_attachment_link')) : ?>
        <i class="fas fa-cloud-download-alt fa-fw"></i>&nbsp;<span class="entry-meta-item image-file-links"><?php
            echo '<a href="' . $sizes[0] . '">' . __('Original file', 'basicbootstrap') . '</a>';
        ?></span>
        <?php endif; ?>

    <?php else:
        $att_file = wp_get_attachment_metadata($post->ID); ?>

        <?php if (get_basicbootstrap_mod('show_attachment_mime_type')) : ?>
        <i class="fas fa-file fa-fw"></i>&nbsp;<span class="entry-meta-item media-mime-links"><?php
            echo get_post_mime_type($post->ID);
        ?></span>
        <?php endif; ?>

        <?php if (get_basicbootstrap_mod('show_attachment_sizes')) : ?>
        <i class="fa fa-wrench fa-fw"></i>&nbsp;<span class="entry-meta-item media-size-links"><?php
            echo filesize(get_attached_file($post->ID)).' o';
        ?></span>
        <?php endif; ?>

        <?php if (get_basicbootstrap_mod('show_attachment_link')) : ?>
        <i class="fas fa-cloud-download-alt fa-fw"></i>&nbsp;<span class="entry-meta-item media-file-links"><?php
            echo '<a href="' . wp_get_attachment_url($post->ID) . '">' . __('Original file', 'basicbootstrap') . '</a>';
        ?></span>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (get_basicbootstrap_mod('show_edit_links')) : ?>
    <span class="d-print-none">
        <?php edit_post_link(__('Edit', 'basicbootstrap'), '<i class="fas fa-pen-square fa-fw"></i>&nbsp;'); ?>
    </span>
    <?php endif; ?>

</div>
<?php endif; ?>
