<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (BASICBOOTSTRAP_TPLDBG) {
    dbg_log_template_info(__FILE__);
}
?>
<div class="entry-meta blog-post-meta">
    <?php

    printf(
        /* translators: by <author> on <date> */
        __('by %1$s on %2$s', 'basicbootstrap'),
        '<cite class="entry-meta-item author vcard" itemprop="author">' . get_the_author_posts_link() . '</cite>',
        '<time datetime="' . get_the_time('c') . '" class="entry-meta-item post-date entry-date updated" itemprop="datePublished">' .
        get_the_time(get_option('date_format')) . '</time>'
    );

    $post = get_post();
    if (substr($post->post_modified_gmt, 0, 10) != substr($post->post_date_gmt, 0, 10)) :
        printf(
            /* translators: <pubdate>, last updated at <date> */
            __(', last updated at %1$s', 'basicbootstrap'),
            '<time datetime="' . get_the_modified_date('c') . '" class="entry-meta-item post-date entry-date updated" itemprop="dateModified">' .
            get_the_modified_date(get_option('date_format')) . '</time>'
        );
    endif;

    ?>
</div>
