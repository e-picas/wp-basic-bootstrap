<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (!isset($gallery_images) || !is_array($gallery_images)) {
    return;
}
?>
<div class="featured-media clearfix text-center">
    <div id="carousel-slider" class="carousel slide flexslider gallery-slides" data-ride="carousel">
        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <?php $i=0; foreach ($gallery_images as $image): ?>
                <div class="item<?php
                if ($i==0) echo ' active';
                ?>">
                <?php echo wp_get_attachment_image($image['ID'], 'post-thumbnail', 0, array( 'class' => 'gray')) ?>
                <?php
                $attachment = get_post($image['ID']);
                $image_caption = $attachment->post_excerpt;
                if (!empty($image_caption)) :?>
                    <div class="carousel-caption">
                        <?php echo $image_caption; ?>
                    </div>
                <?php endif; ?>
                </div>
            <?php $i++; endforeach; ?>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-slider" role="button" data-slide="prev">
            <i class="glyphicon glyphicon-chevron-left fa fa-chevron-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-slider" role="button" data-slide="next">
            <i class="glyphicon glyphicon-chevron-right fa fa-chevron-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
        </a>

    </div>
</div>
