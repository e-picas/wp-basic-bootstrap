<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (has_post_thumbnail()): ?>
    <?php if (is_sticky() && is_sticky_view()): ?>
        <div class="featured-media sticky-media">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
                <?php the_post_thumbnail('post-thumbnail'); ?>
            </a>
        </div>
    <?php else: ?>
        <div class="featured-media pull-left">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="thumbnail">
                <?php the_post_thumbnail('thumbnail'); ?>
            </a>
        </div>
    <?php endif; ?>
<?php endif; ?>
