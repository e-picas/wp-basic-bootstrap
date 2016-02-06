<?php
/**
 * The template for displaying Comments
 *
 * This is a partial template that is pulled into other template files to display comments
 * that users leave on a page or post. Several different pages and posts show comments so
 * it makes sense to have one file that can be pulled in when needed.
 *
 * Learn more: https://developer.wordpress.org/themes/template-files-section/partial-and-miscellaneous-template-files/#comments-php
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() ) {
    return;
}

/*
 * If this file is called directly, fuck
 */
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    return;
}

?>
<?php if ( comments_open() ) : ?>
    <hr />
    <section id="comments" class="comments-area">

        <?php if ( have_comments() ) : ?>
            <meta itemprop="interactionCount" content="<?php echo get_comments_number(); ?> Usercomments">

            <h3 class="comments-title" role="sectionhead">
                <?php
                /* translation: _e('%1$s thoughts on &ldquo;%2$s&rdquo;') */
                printf( _n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'basicbootstrap'),
                    number_format_i18n( get_comments_number() ), get_the_title() );
                ?>
            </h3>

            <?php
            /*
            if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
                <nav id="comment-nav-above">
                    <ul class="pager">
                        <h1 class="sr-only"><?php _e('Comment navigation', 'basicbootstrap'); ?></h1>
                        <li><?php previous_comments_link( __('&larr; Older Comments', 'basicbootstrap') ); ?></li>
                        <li><?php next_comments_link( __('Newer Comments &rarr;', 'basicbootstrap') ); ?></li>
                    </ul>
                </nav><!-- #comment-nav-above -->
            <?php endif; // Check for comment navigation.
            */
            ?>

            <ul class="list-unstyled">
                <?php wp_list_comments(array(
                    'callback' => 'basicbootstrap_comment',
                    'style' => 'ul'
                )); ?>
            </ul><!-- .comment-list -->

            <?php if ( get_comment_pages_count() > 1 && get_option('page_comments') ) : ?>
                <nav id="comment-nav-below">
                    <ul class="pager">
                        <h1 class="sr-only"><?php _e('Comment navigation', 'basicbootstrap'); ?></h1>
                        <li><?php previous_comments_link( __('&larr; Older Comments', 'basicbootstrap') ); ?></li>
                        <li><?php next_comments_link( __('Newer Comments &rarr;', 'basicbootstrap') ); ?></li>
                    </ul>
                </nav><!-- #comment-nav-below -->
            <?php endif; // Check for comment navigation. ?>

            <?php if ( ! comments_open() ) : ?>
                <p class="no-comments"><?php _e('Comments are closed.', 'basicbootstrap'); ?></p>
            <?php endif; ?>

        <?php endif; // have_comments() ?>

        <?php
        $args = array(
            'id_form'           => 'commentform',
            'id_submit'         => 'submit',
            'class_submit'      => 'btn btn-default',
            'title_reply'       => __('Leave a Reply', 'basicbootstrap'),
            'title_reply_to'    => __('Leave a Reply to %s', 'basicbootstrap'),
            'cancel_reply_link' => __('Cancel Reply', 'basicbootstrap'),
            'label_submit'      => __('Post Comment', 'basicbootstrap'),

            'comment_field' =>  '<div class="form-group comment-form-comment">' .
                '<label for="comment" class="control-label">' .
                    _x('Comment', 'noun', 'basicbootstrap') .
                '</label>' .
                '<textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
            '</div>',

            'must_log_in' => '<p class="must-log-in">' .
                sprintf(
                    __('You must be <a href="%s">logged in</a> to post a comment.', 'basicbootstrap'),
                    wp_login_url(apply_filters('the_permalink', get_permalink()))
                ) . '</p>',

            'logged_in_as' => '<p class="logged-in-as">' .
                sprintf(
                    __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'basicbootstrap'),
                    admin_url('profile.php'),
                    $user_identity,
                    wp_logout_url(apply_filters('the_permalink', get_permalink()))
                ) . '</p>',

            'comment_notes_before' => '<p class="comment-notes">' .
                __('Your email address will not be published.', 'basicbootstrap') .
                '</p>',

            'comment_notes_after' => '<p class="form-allowed-tags">' .
                sprintf(
                    __('You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'basicbootstrap'),
                    ' <code>' . allowed_tags() . '</code>'
                ) . '.</p>',

            'fields' => apply_filters('comment_form_default_fields', array(
                'author' =>
                    '<div class="form-group comment-form-name">' .
                        '<label for="author" class="control-label">' .
                            __('Name', 'basicbootstrap') . ( $req ? '&nbsp;<span class="required">*</span>' : '') .
                        '</label> ' .
                        '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="John Doe" />' .
                    '</div>',
                'email' =>
                    '<div class="form-group comment-form-email">' .
                        '<label for="email" class="control-label">' .
                            __('Email', 'basicbootstrap') . ( $req ? '&nbsp;<span class="required">*</span>' : '') .
                        '</label> ' .
                        '<input class="form-control" id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="name@provider.dom" />' .
                    '</div>',
                'url' =>
                    '<div class="form-group comment-form-url">' .
                        '<label for="url" class="control-label">' .
                            __('Website', 'basicbootstrap') .
                        '</label> ' .
                        '<input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="http://domain.ext/page" />' .
                    '</div>',
            )),
        );
        comment_form($args);
        ?>

    </section><!-- #comments -->
<?php endif; ?>
