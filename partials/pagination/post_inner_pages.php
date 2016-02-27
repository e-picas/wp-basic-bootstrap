<?php
/**
 * This template is used for inner posts' pagination (pagination in post's content)
 *
 * It is calculated and loaded by the `\WP_Basic_Bootstrap_Pagination` class.
 *
 * It receives the following data:
 *
 *      $paged          // current page
 *      $max_page       // total number of pages
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (!empty($paged) && !empty($max_page)) : ?>
<?php
$previous_i = $paged-1;
$next_i     = $paged+1;
?>
<nav id="nav-below" class="pagenav clearfix text-center">
    <ul class="pagination pagination-sm">

        <?php if ($previous_i > 0) : ?>
        <li>
            <?php echo _wp_link_page($previous_i); ?>
        <?php else: ?>
        <li class="disabled">
            <a href="#" aria-label="Previous">
        <?php endif; ?>
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>

        <?php for ($i = 1; $i < ($max_page + 1); $i = $i + 1) : ?>
            <?php if ($i == $paged) : ?>
                <li class="active"><span class="number current"><?php echo $i; ?> <span class="sr-only">(current)</span></span></li>
            <?php else : ?>
                <li><?php echo _wp_link_page($i); ?><?php echo $i; ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if ($next_i < ($max_page + 1)) : ?>
        <li>
            <?php echo _wp_link_page($next_i); ?>
        <?php else: ?>
        <li class="disabled">
            <a href="#" aria-label="Next">
        <?php endif; ?>
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>

    </ul>
</nav>
<?php endif; ?>

