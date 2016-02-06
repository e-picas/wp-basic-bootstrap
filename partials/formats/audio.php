<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (!empty($audio_self_hosted)) : ?>
<div class="featured-media">
    <?php foreach ($audio_self_hosted as $audio):
        if ($audio['title'] != '') : ?>
            <h4><?php echo $audio['title'] ?></h4>
        <?php endif; ?>
        <?php echo do_shortcode( '[audio src="'. $audio['url'] .'"][/audio]' ); ?>
        <meta itemprop="contentUrl" content="<?php echo esc_url($audio['url']); ?>">
    <?php endforeach ?>
</div>
<?php endif; ?>
