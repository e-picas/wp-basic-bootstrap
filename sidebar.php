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

/*/
error_log('from file : '.__FILE__);
error_log('page type : '.$page_type);
error_log('applied template : '.$template);
//*/
?>
    </div><!-- /.blog-main -->

<?php if (strpos($template, 'full_width')===false) : ?>
    <?php if ($template == 'left_sidebar') : ?>
    <aside id="sidebar" role="complementary" class="col-sm-3 blog-sidebar-left">
    <?php elseif ($template == 'right_sidebar') : ?>
    <aside id="sidebar" role="complementary" class="col-sm-3 blog-sidebar-right">
    <?php endif; ?>

        <?php dynamic_sidebar('primary-widget-area'); ?>

    </aside><!-- /.blog-sidebar -->
<?php endif; ?>

