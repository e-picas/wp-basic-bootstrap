<?php
/**
 * The sidebar containing the main widget area
 *
 * If no active widgets are in the sidebar, hide it completely.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$template   = get_template_type();
$page_type  = get_page_type();

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__, ['page_type'=>$page_type, 'template_type'=>$template]);
}
?>
<?php if (strpos($template, 'full_width')===false) : ?>
    </div><!-- /.blog-main -->

    <?php if ($template == 'left_sidebar') : ?>
    <aside id="sidebar" class="col-sm-3 blog-sidebar-left d-print-none">
    <?php elseif ($template == 'right_sidebar') : ?>
    <aside id="sidebar" class="col-sm-3 blog-sidebar-right d-print-none">
    <?php endif; ?>

        <hr class="d-sm-none" />
        <?php dynamic_sidebar('primary-widget-area'); ?>

    </aside><!-- /.blog-sidebar -->
<?php endif; ?>

