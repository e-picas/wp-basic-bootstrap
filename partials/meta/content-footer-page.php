<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<section class="entry-meta blog-post-meta">

    <?php if (get_basicbootstrap_mod('show_comments_link') && comments_open()) : ?>
        <i class="fa fa-comments fa-fw"></i>&nbsp;<span class="entry-meta-item comments-link"><?php
            comments_popup_link(__('0 Comments', 'basicbootstrap'), __('1 Comment', 'basicbootstrap'), __('% Comments', 'basicbootstrap'));
        ?></span>
    <?php endif; ?>

    <?php if (get_basicbootstrap_mod('show_edit_links')) : ?>
        <?php edit_post_link(__('Edit', 'basicbootstrap'), '<i class="fa fa-pencil-square fa-fw"></i>&nbsp;'); ?>
    <?php endif; ?>

</section>
