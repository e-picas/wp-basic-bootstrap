<?php
/**
 * The Footer widget areas
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

$first  = is_active_sidebar('first-footer-widget-area');
$second = is_active_sidebar('second-footer-widget-area');
$third  = is_active_sidebar('third-footer-widget-area');
?>

<?php if ($first || $second || $third) : ?>
    <div class="container">

        <div class="row">

        <?php if ($first) : ?>
            <?php if ($second) : ?>
            <div class="col-sm-4">
            <?php else: ?>
            <div class="col-sm-8">
            <?php endif; ?>
                <div class="footer-module">
                    <?php dynamic_sidebar('first-footer-widget-area'); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($second) : ?>
            <?php if ($third) : ?>
                <div class="col-sm-4">
            <?php else: ?>
                <div class="col-sm-8">
            <?php endif; ?>
                <div class="footer-module">
                    <?php dynamic_sidebar('second-footer-widget-area'); ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($third) : ?>
            <div class="col-sm-4">
                <div class="footer-module">
                    <?php dynamic_sidebar('third-footer-widget-area'); ?>
                </div>
            </div>
        <?php endif; ?>

        </div><!-- /.row -->

    </div><!-- /.container -->
<?php endif ; ?>
