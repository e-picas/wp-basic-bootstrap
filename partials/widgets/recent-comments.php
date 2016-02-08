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
    isset($show_date) &&
    isset($comments) &&
    is_array($comments)
) :
?>

    <?php echo $before_widget; ?>
    <?php if ( $title ) echo $before_title . $title . $after_title; ?>
    <ul class="feature-comments-list" id="recentcomments">

    <?php foreach ($comments as $comment) : ?>
        <li class="recentcomments">
        <?php
            /* translators: comments widget: 1: comment author, 2: post link */
            printf(
                _x('%1$s on %2$s', 'widgets'),
                '<span class="comment-author-link">' . get_comment_author_link($comment) . '</span>',
                '<a href="' . esc_url(get_comment_link($comment)) . '">' . get_the_title($comment->comment_post_ID) . '</a>'
            );
        ?>
        <?php if ($show_date) : ?>
            <br /><span class="entry-meta comment-date"><?php echo get_comment_date('', $comment); ?></span>
        <?php endif; ?>
        </li>
    <?php endforeach; ?>

    </ul>
    <?php echo $after_widget; ?>

<?php endif; ?>
