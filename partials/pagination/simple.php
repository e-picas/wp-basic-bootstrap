<?php
/**
 * This template is used for single posts page's pagination
 *
 * It is calculated and loaded by the `\WP_Basic_Bootstrap_Pagination` class.
 *
 * It receives the following data:
 *
 *      $previous   // the previous post as a \WP_post object
 *      $next       // the next post as a \WP_post object
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (!empty($previous) || !empty($next)) : ?>
<hr />
<nav id="nav-below" class="navigation d-print-none clearfix my-3">
    <ul class="pager">

    <?php if (!empty($previous)) : ?>
        <li class="previous nav-previous">
            <a rel="prev" href="<?php echo get_permalink($previous); ?>" title="<?php
                printf(__('Older post: %s', 'basicbootstrap'), esc_attr($previous->post_title));
            ?>">
                <i class="fa fa-angle-double-left fa-fw"></i>
                <?php echo $previous->post_title; ?>
            </a>
        </li>
    <?php endif; ?>

    <?php if (!empty($next)) : ?>
        <li class="next nav-next">
            <a rel="next" href="<?php echo get_permalink($next); ?>" title="<?php
                printf(__('Newer post: %s', 'basicbootstrap'), esc_attr($next->post_title));
            ?>">
                <?php echo $next->post_title; ?>
                <i class="fa fa-angle-double-right fa-fw"></i>
            </a>
        </li>
    <?php endif; ?>

    </ul>
</nav>
<?php endif; ?>
