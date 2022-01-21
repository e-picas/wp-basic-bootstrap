<?php
/**
 * This template is used for posts list page's pagination
 *
 * It is calculated and loaded by the `\WP_Basic_Bootstrap_Pagination` class.
 *
 * It receives the following data:
 *
 *      $paged          // current page
 *      $start_page     // first page to show
 *      $end_page       // last page to show
 *      $max_page       // total number of pages
 *      $pager_size     // limit of each page
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

?>
<?php if (!empty($max_page) && $max_page > 1 && !empty($paged) && !empty($start_page) && !empty($end_page) && !empty($pager_size)) : ?>
<?php
$previous_i = $paged-1;
$next_i     = $paged+1;
$page_link_title = function ($i) {
    return esc_html(
        sprintf(__('See page %s', 'basicbootstrap'), $i)
    );
};
$previous_link_title = esc_html__('See previous page', 'basicbootstrap');
$next_link_title = esc_html__('See next page', 'basicbootstrap');
$fist_link_title = esc_html__('See first page', 'basicbootstrap');
$last_link_title = esc_html__('See last page', 'basicbootstrap');
?>
<nav id="nav-below" class="pagenav d-print-none clearfix">
    <ul class="pagination">

    <?php if ($previous_i > 0) : ?>
        <li class="page-item">
            <a href="<?php echo get_pagenum_link($previous_i, true); ?>" aria-label="Previous" class="page-link" title="<?php echo $previous_link_title; ?>">
    <?php else: ?>
        <li class="page-item disabled">
            <a href="#" aria-label="Previous" class="page-link">
    <?php endif; ?>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

    <?php if ($start_page > 1) : $i = 1; ?>
        <li class="page-item">
            <a href="<?php echo get_pagenum_link($i); ?>" class="page-link number" title="<?php echo $fist_link_title; ?>">
                <?php echo $i; ?>
            </a>
        </li>
    <?php endif; ?>

    <?php for ($i = $start_page; $i  <= $end_page; $i++) : ?>
        <?php if ($i == $paged) : ?>
        <li class="page-item active">
            <a href="#" class="page-link number current" title="<?php echo $fist_link_title; ?>">
                <?php echo $i; ?> <span class="sr-only">(current)</span>
            </a>
        </li>
        <?php else : ?>
        <li>
            <a href="<?php echo get_pagenum_link($i); ?>" class="page-link number" title="<?php echo $page_link_title($i); ?>">
        <?php if (
            ($i == $start_page && ($start_page-1) > 1) ||
            ($i == $end_page && ($end_page+1) < $max_page)
        ) : ?>
            <?php echo '&hellip;'; ?>
        <?php else: ?>
            <?php echo $i; ?>
        <?php endif; ?>
            </a>
        </li>
        <?php endif; ?>
    <?php endfor; ?>

    <?php if ($end_page < $max_page) : $i = $max_page; ?>
        <li class="page-item">
            <a href="<?php echo get_pagenum_link($i); ?>" class="page-link number" title="<?php echo $last_link_title; ?>">
                <?php echo $i; ?>
            </a>
        </li>
    <?php endif; ?>

    <?php if ($next_i < ($max_page + 1)) : ?>
        <li class="page-item">
            <a href="<?php echo get_pagenum_link($next_i, true); ?>" aria-label="Next" class="page-link" title="<?php echo $next_link_title; ?>">
    <?php else: ?>
        <li class="page-item disabled">
            <a href="#" aria-label="Next" class="page-link">
    <?php endif; ?>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
<?php endif; ?>

