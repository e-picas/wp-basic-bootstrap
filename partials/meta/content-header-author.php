
<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<div class="entry-meta blog-post-meta">

<?php
$_url = get_the_author_meta('user_url');
$_name = get_the_author_meta('user_firstname').' '.get_the_author_meta('user_lastname');
if ($_url) : ?>
    <i class="fa fa-link fa-fw"></i>&nbsp;<span class="entry-meta-item author-link"><a href="<?php
        echo $_url;
    ?>" itemprop="url" title="<?php
        echo esc_attr(
            sprintf(
                __('See oneline %s', 'basicbootstrap'),
                $_url
            )
        );
    ?>"><?php echo (!empty(trim($_name)) ? $_name : $_url); ?></a></span>
<?php endif; ?>

<?php if (get_basicbootstrap_mod('show_author_posts_number')) : ?>
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
<?php endif; ?>

</div>
