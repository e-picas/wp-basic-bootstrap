<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<?php if (!empty($quote_content)) : ?>
<div class="jumbotron entry-featured feature-quote">
    <blockquote>
        <p><i class="fa fa-quote-right fa-fw fa-pull-left fa-2x"></i>&nbsp;<?php echo $quote_content; ?></p>
        <?php if (!empty($quote_source_name)) : ?>
            <?php if (!empty($quote_source_link)) : ?>
                <cite><a href="<?php echo $quote_source_link; ?>"><?php echo $quote_source_name; ?></a></cite>
            <?php else : ?>
                <cite><?php echo $quote_source_name; ?></cite>
            <?php endif; ?>
        <?php endif; ?>
    </blockquote>
</div>
<?php endif; ?>
