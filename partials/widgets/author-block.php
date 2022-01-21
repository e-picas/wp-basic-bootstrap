<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (
    isset($before_widget) &&
    isset($after_widget) &&
    isset($before_title) &&
    isset($after_title) &&
    isset($author) &&
    is_object($author)
) :
    global $authordata;
    $authordata = $author;
    $small_tile = get_basicbootsrap_image_sizes('small_tile');
    $authordesc = get_the_author_excerpt();
?>
<?php echo $before_widget; ?>
<?php if ($title) {
    echo $before_title . $title . $after_title;
} ?>
<div class="about-author clearfix<?php
    if (isset($is_current) && $is_current) echo ' post-author';
?>">

    <?php if (function_exists('get_avatar')) : ?>
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="author-avatar float-left"><?php
            echo get_avatar(get_the_author_meta('email'), $small_tile[0]);
        ?></a>
    <?php endif; ?>

    <div class="details">
        <?php if (! empty($authordesc)) : ?>
            <div class="bio">
                <?php echo $authordesc; ?>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php echo $after_widget; ?>

<?php endif; ?>
