<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (have_posts() && ! is_singular()) :

    $list_layout = get_posts_list_layout();
    $count = 0;

    if (is_sticky_view()) :
        $sticky = get_sticky_query();
        if ($sticky) while (have_posts()) :
            the_post();
?>

    <div class="sticky-wrapper">
        <?php get_template_part_hierarchical('post-templates/summary-sticky', get_post_format()); ?>
    </div>
    <hr class="hidden-print" />

        <?php endwhile; ?>
        <?php get_not_sticky_query(); ?>
    <?php endif; ?>

<?php
    while (have_posts()) :
        the_post();
?>

    <?php if ($count==0 || $count%3==0): ?>
        <div class="row">
    <?php endif; ?>

    <?php $count++; ?>

        <div class="col-md-4">
            <?php get_template_part_hierarchical('post-templates/summary', get_post_format()); ?>
        </div>

    <?php if ($count%3==0): ?>
        </div>
    <?php endif; ?>
<?php endwhile; ?>

<?php if ($count%3!=0): ?>

    <?php while ($count%3!=0) : ?>
        <?php $count++; ?>
        <div class="col-md-4"></div>
    <?php endwhile; ?>

    </div>
<?php endif; ?>

<?php endif; ?>
