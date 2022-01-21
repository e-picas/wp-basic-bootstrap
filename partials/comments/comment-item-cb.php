<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
        <?php echo get_avatar($comment, 44); ?>
        <header class="entry-meta comment-meta">
            <div class="comment-author vcard">
                <?php
                printf(' <cite><b class="fn">%1$s</b> %2$s</cite>',
                    get_comment_author_link(),
                    // If current post author is also comment author, make it known visually.
                    ($comment->user_id === $post->post_author) ? '<span>' . __('Post author', 'basicbootstrap') . '</span>' : ''
                );
                ?>
            </div><!-- .comment-meta -->
            <?php
            printf('<i class="fa fa-hashtag fa-fw"></i>&nbsp;<a class="entry-meta-item" href="%1$s" title="%2$s">%3$s</a>',
                esc_url(get_comment_link($comment->comment_ID)),
                __('Permalink', 'basicbootstrap'),
                $comment->comment_ID
            );
            ?>
            <?php
            printf('<i class="fa fa-calendar fa-fw"></i>&nbsp;<time class="entry-meta-item" datetime="%1$s">%2$s</time>',
                get_comment_time('c'),
                /* translators: 1: date, 2: time */
                sprintf(__('%1$s at %2$s', 'basicbootstrap'), get_comment_date(), get_comment_time())
            );
            ?>
            <span class="d-print-none">
            <?php comment_reply_link(array_merge($args, array(
                'reply_text' => __('Reply', 'basicbootstrap'),
                'before' => '<i class="fa fa-reply fa-fw"></i>&nbsp;',
                'after' => '',
                'depth' => $depth,
                'max_depth' => $args['max_depth']
            ))); ?>
            </span>

            <?php if (get_basicbootstrap_mod('show_edit_comment_links')) : ?>
            <span class="d-print-none">
                <?php edit_comment_link(__('Edit', 'basicbootstrap'), '<i class="fa fa-pencil-square fa-fw"></i>&nbsp;'); ?>
            </span>
            <?php endif; ?>

        </header><!-- .comment-meta -->

        <?php if ('0' == $comment->comment_approved) : ?>
            <p class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.', 'basicbootstrap'); ?></p>
        <?php endif; ?>

        <section class="comment-content comment">
            <?php comment_text(); ?>
        </section><!-- .comment-content -->

        <hr />
    </article><!-- #comment-## -->
