<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */


/**
 *
 * The `dynamic_sidebar_params` filter is documented in `wp-includes/widgets.php`.
 *
 * @param $sidebar_params
 * @return mixed
 */
function basicbootstrap_dynamic_sidebar_params_filter($sidebar_params)
{

    global $wp_registered_widgets;
    foreach ($wp_registered_widgets as $id=>$widget) {

        // recent posts widget
        if (isset($widget['classname']) && $widget['classname']=='widget_recent_entries') {
            /* @var $widget \WP_Widget_Recent_Posts */
            basicbootstrap_load_class('WP_Basic_Bootstrap_Widget_Recent_Posts');
            $widget['original_callback'] = $widget['callback'];

            foreach ($widget['callback'] as $i=>$callback) {
                if (is_object($callback) && ($callback instanceof WP_Widget_Recent_Posts)) {
                    $widget['callback'][$i] = WP_Basic_Bootstrap_Widget_Recent_Posts::createFromParent($widget['callback'][$i]);
                }
            }

            $wp_registered_widgets[$id] = $widget;
        }
    }

    return $sidebar_params;
}
//add_filter('dynamic_sidebar_params', 'basicbootstrap_dynamic_sidebar_params_filter');


function basicbootstrap_enqueue_comment_reply_script()
{
    if ( get_option('thread_comments') ) { wp_enqueue_script('comment-reply'); }
}
add_action('comment_form_before', 'basicbootstrap_enqueue_comment_reply_script');

/*
function basicbootstrap_title( $title ) {
    if ( $title == '') {
        return '&rarr;';
    } else {
        return $title;
    }
}
add_filter('the_title', 'basicbootstrap_title');

function basicbootstrap_filter_wp_title( $title )
{
    return $title . esc_attr( get_bloginfo('name') );
}
add_filter('wp_title', 'basicbootstrap_filter_wp_title');
*/

function basicbootstrap_custom_pings( $comment )
{
    $GLOBALS['comment'] = $comment;
    echo '<li ' . comment_class() . ' id="li-comment-' . comment_ID() . '">' . comment_author_link() . '</li>';
}

function basicbootstrap_comments_number( $count )
{
    if ( !is_admin() ) {
        global $id;
        $comments_by_type = separate_comments( get_comments('status=approve&post_id=' . $id ) );
        return count( $comments_by_type['comment'] );
    } else {
        return $count;
    }
}
//add_filter('get_comments_number', 'basicbootstrap_comments_number');
