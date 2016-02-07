<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/* @var $post \WP_Post */
global $post;
?>
<section class="entry-meta blog-post-meta">

<?php if (get_basicbootstrap_mod('show_author_meta')) : ?>
    <i class="fa fa-user fa-fw"></i>&nbsp;<cite class="entry-meta-item author vcard"
<?php else: ?>
    <cite class="entry-meta-item author vcard hidden"
<?php endif; ?>
        itemprop="author"><?php
        the_author_posts_link();
    ?></cite>

<?php if (get_basicbootstrap_mod('show_pubdate_meta')) : ?>
    <i class="fa fa-calendar fa-fw"></i>&nbsp;<time class="entry-meta-item post-date entry-date"
<?php else: ?>
    <time class="entry-meta-item post-date entry-date hidden"
<?php endif; ?>
        title="<?php
        esc_attr_e('Publication date', 'basicbootstrap');
    ?>" datetime="<?php
        the_time('c');
    ?>" pubdate="pubdate" itemprop="datePublished"><?php
        the_time( get_option('date_format') );
    ?></time>

    <?php
    $post = get_post();
    if (substr($post->post_modified_gmt, 0, 10) != substr($post->post_date_gmt, 0, 10)) : ?>
<?php if (get_basicbootstrap_mod('show_moddate_meta')) : ?>
        <i class="fa fa-calendar-check-o fa-fw"></i>&nbsp;<time class="entry-meta-item post-date entry-date updated"
<?php else: ?>
        <time class="entry-meta-item post-date entry-date updated hidden"
<?php endif; ?>
        title="<?php
            esc_attr_e('Last modification date', 'basicbootstrap');
        ?>"datetime="<?php
            the_modified_date('c');
        ?>" pubdate="pubdate" itemprop="dateModified"><?php
            the_modified_date( get_option('date_format') );
        ?></time>
    <?php endif; ?>

</section>
