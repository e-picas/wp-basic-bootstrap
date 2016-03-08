<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (!empty($link)) : ?>
<div class="well well-sm lead text-center entry-featured feature-link">
    <?php _e('See online: ', 'basicbootstrap'); ?>
    <a href="<?php echo $link; ?>"><?php echo !empty($title) ? $title : $link; ?></a>
</div>
<?php endif; ?>
