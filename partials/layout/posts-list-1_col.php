<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (have_posts() && ! is_singular()) {

    $list_layout = get_posts_list_type();
    $count = 0;

    while (have_posts()) {
        the_post();
        get_template_part('post-templates/summary', get_post_format());
    }
}
?>
