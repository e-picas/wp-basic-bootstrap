<?php
/**
 * Template for displaying the footer
 *
 * Contains the closing of the id=main div and all content
 * after. Calls sidebar-footer.php for bottom widgets.
 *
 * Learn more: https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#footer-php
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
<?php if (strpos($template, 'full_width')!==false) : ?>
                </div><!-- /.blog-main -->
<?php endif; ?>

            </div><!-- /.row -->
    </div><!-- /.container -->

    <footer id="footer" class="blog-footer d-print-none">
        <?php get_template_part_hierarchical('partials/layout/footer'); ?>
    </footer>

</div><!-- /#wrapper -->

<?php wp_footer(); ?>

<a href="#content" class="sr-only sr-only-focusable"><?php _e('Back to main content', 'basicbootstrap'); ?></a>
<a href="#navigation" class="sr-only sr-only-focusable"><?php _e('Back to main navigation', 'basicbootstrap'); ?></a>
<?php if (strpos($template, 'full_width')===false) : ?>
<a href="#sidebar" class="sr-only sr-only-focusable"><?php _e('Back to page sidebar', 'basicbootstrap'); ?></a>
<?php endif; ?>
<a href="#header" class="sr-only sr-only-focusable"><?php _e('Back to page header', 'basicbootstrap'); ?></a>

</body>
</html>
