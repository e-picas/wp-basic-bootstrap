<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p>
        <?php _e('Pingback:', 'basicbootstrap'); ?>
        <?php comment_author_link(); ?>
    </p>
    <div class="comment-meta">
        <?php
        printf('<i class="fa fa-hashtag fa-fw"></i>&nbsp;<a href="%1$s" title="%2$s">%3$s</a>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            __('Permalink', 'basicbootstrap'),
            $comment->comment_ID
        );
        ?>
        <?php edit_comment_link(__('Edit', 'basicbootstrap'), '<i class="fa fa-pencil-square fa-fw"></i>&nbsp;'); ?>
    </div>
