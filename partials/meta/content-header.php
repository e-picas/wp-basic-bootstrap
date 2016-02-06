<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<section class="entry-meta blog-post-meta">
    <i class="fa fa-user fa-fw"></i>&nbsp;<cite class="entry-meta-item author vcard" itemprop="author"><?php
        the_author_posts_link();
    ?></cite>
    <i class="fa fa-calendar fa-fw"></i>&nbsp;<time title="<?php
        esc_attr_e('Publication date', 'basicbootstrap');
    ?>" datetime="<?php
        the_time('c');
    ?>" class="entry-meta-item post-date entry-date updated" pubdate="pubdate" itemprop="datePublished"><?php
        the_time( get_option('date_format') );
    ?></time>
    <?php
    $post = get_post();
    if (substr($post->post_modified_gmt, 0, 10) != substr($post->post_date_gmt, 0, 10)) : ?>
        <i class="fa fa-calendar-check-o fa-fw"></i>&nbsp;<time title="<?php
            esc_attr_e('Last modification date', 'basicbootstrap');
        ?>"datetime="<?php
            the_modified_date('c');
        ?>" class="entry-meta-item post-date entry-date updated" pubdate="pubdate" itemprop="dateModified"><?php
            the_modified_date( get_option('date_format') );
        ?></time>
    <?php endif; ?>
</section>
