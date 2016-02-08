<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (is_singular() && !is_attachment()) {
    get_template_part('partials/socials/content', get_post_format());
} elseif (is_attachment()) {
    get_template_part('partials/socials/content', 'attachment');
}
