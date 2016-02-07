<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

// single page content
if (is_singular() && have_posts()) :

    while (have_posts()) {
        the_post();
        get_template_part_singular('post-templates/content');
        get_the_pagination();
        if (!is_attachment()) {
            comments_template();
        }
    }

// objects list
elseif (have_posts()) :

    get_template_part('partials/layout/posts-list', get_posts_list_type());
    get_the_pagination();

// no list to show
else :
    _e('Sorry, no posts matched your criteria.', 'basicbootstrap');

endif;
?>
