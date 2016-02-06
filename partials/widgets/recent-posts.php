<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (
    isset($before_widget) &&
    isset($after_widget) &&
    isset($before_title) &&
    isset($after_title) &&
    isset($show_thumb) &&
    isset($show_date) &&
    isset($loop) &&
    $loop->have_posts()
) :
?>

    <?php echo $before_widget; ?>
    <?php if ( $title ) echo $before_title . $title . $after_title; ?>
    <ul class="feature-posts-list">
    <?php while ($loop->have_posts()) : $loop->the_post(); ?>
        <li class="media">

            <?php if ($show_thumb) : ?>
                <div class="media-left media-middle">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('small_tile'); ?>
                    </a>
                </div>
            <?php endif; ?>

            <div class="media-body">
                <a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a>
            <?php if ($show_date) : ?>
                <br /><span class="entry-meta post-date"><?php echo get_the_date(); ?></span>
            <?php endif; ?>
            </div>
        </li>
    <?php endwhile; ?>
    </ul>
    <?php echo $after_widget; ?>

<?php endif; ?>
