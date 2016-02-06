<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<section class="blog-post-meta">
    <time datetime="<?php
        the_time('c');
    ?>" class="entry-meta-item post-date entry-date updated" pubdate="pubdate" itemprop="datePublished"><?php
        the_time(get_option('date_format'));
    ?></time>
</section>



