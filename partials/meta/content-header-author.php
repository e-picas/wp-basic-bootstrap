
<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<section class="entry-meta blog-post-meta">
<?php if (get_the_author_meta('user_url')) : ?>
    <i class="fa fa-link fa-fw"></i>&nbsp;<span class="entry-meta-item author-link"><a href="<?php
        echo get_the_author_meta('user_url');
    ?>" itemprop="url" title="<?php
        echo esc_attr(
            sprintf(
                __('See oneline %s', 'basicbootstrap'),
                get_the_author_meta('user_url')
            )
        );
    ?>"><?php echo get_the_author_meta('user_firstname').' '.get_the_author_meta('user_lastname'); ?></a></span>
<?php endif; ?>
    <i class="fa fa-book fa-fw"></i>&nbsp;<span class="entry-meta-item author-link"><?php
        $count = count_user_posts(get_the_author_meta('ID'));
        echo esc_html(
            sprintf(
                _n(
                    __('%s post written'),
                    __('%s posts written'),
                    $count,
                    'basicbootstrap'
                ),
                $count
            )
        );
    ?></span>
</section>
