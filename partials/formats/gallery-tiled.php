<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (isset($gallery_images) && is_array($gallery_images)) : ?>
<div class="featured-media clearfix">
    <div class="gallery-tiled magnific-popup-gallery">
        <ul class="list-inline">
        <?php foreach ($gallery_images as $image): ?>
            <li class="list-inline-item">
                <?php
                $attachment = get_post($image['ID']);
                $image_caption = $attachment->post_excerpt;
                ?>
                <a href="<?php echo $image['url'] ?>" <?php
                    if (!is_null($image_caption)) :
                ?>data-caption="<?php
                    esc_attr_e($image_caption);
                ?>" <?php endif; ?> title="<?php
                    esc_attr_e($image['title']);
                ?>">
                    <?php echo wp_get_attachment_image($image['ID'], 'small_tile'); ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </div>
</div>
<?php endif; ?>

