<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (!empty($video_self_hosted)) : ?>
<div class="featured-media">
    <?php foreach ($video_self_hosted as $video): ?>
        <?php echo do_shortcode('[video src="'. $video['url'] .'"][/video]'); ?>
        <meta itemprop="contentUrl" content="<?php echo esc_url($video['url']); ?>">
    <?php endforeach ?>
</div>
<?php endif;?>
