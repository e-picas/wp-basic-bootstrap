<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<aside class="blog-post-meta">

    <time class="entry-meta-item post-date entry-date<?php
        if (! get_basicbootstrap_mod('show_pubdate_meta')) echo ' hidden';
    ?>" title="<?php
        esc_attr_e('Publication date', 'basicbootstrap');
    ?>" datetime="<?php
        the_time('c');
    ?>" itemprop="datePublished"><?php
        the_time(get_option('date_format'));
    ?></time>

</aside>



