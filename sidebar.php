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
    error_log('loaded file : '.__FILE__);
    error_log('page type : '.$page_type);
    error_log('applied template : '.$template);
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

