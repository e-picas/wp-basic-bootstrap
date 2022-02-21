<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__);
}
?>
<div class="entry-meta blog-post-meta">

    <?php if (get_basicbootstrap_mod('show_comments_link') && comments_open()) : ?>
        <i class="fa fa-comments fa-fw"></i>&nbsp;<span class="entry-meta-item comments-link"><?php
            comments_popup_link(__('0 Comments', 'basicbootstrap'), __('1 Comment', 'basicbootstrap'), __('% Comments', 'basicbootstrap'));
        ?></span>
    <?php endif; ?>

    <?php if (get_basicbootstrap_mod('show_edit_links')) : ?>
    <span class="d-print-none">
        <?php edit_post_link(__('Edit', 'basicbootstrap'), '<i class="fas fa-pen-square fa-fw"></i>&nbsp;'); ?>
    </span>
    <?php endif; ?>

</div>
