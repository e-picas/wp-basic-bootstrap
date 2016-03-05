<?php

$copyright_text = get_basicbootstrap_mod('copyright_text');

?>
<div class="container">

    <?php get_sidebar_hierarchical('footer'); ?>

    <hr class="visible-xs" />

    <div class="visible-xs-block">
        <?php
        wp_nav_menu(array(
            'theme_location'=> 'footer-menu',
            'fallback_cb'   => '',
            'container_class' => 'visible-xs-block',
            'menu_id'       => 'footer-nav',
            'menu_class'    => 'footer-nav nav nav-pills nav-stacked',
        ));
        ?>
        <hr class="visible-xs" />
        <?php if ($copyright_text !== '' && get_basicbootstrap_mod('display_footer_copyright')) : ?>
            <p class="text-muted copyright"><?php echo $copyright_text; ?></p>
        <?php endif; ?>
    </div>
    <div class="clearfix hidden-xs">
        <div class="pull-left">
            <?php
            wp_nav_menu(array(
                'theme_location'=> 'footer-menu',
                'fallback_cb'   => '',
                'container_class' => 'hidden-xs',
                'menu_id'       => 'footer-nav',
                'menu_class'    => 'footer-nav nav nav-pills',
            ));
            ?>
        </div>
        <div class="pull-right">
            <?php if ($copyright_text !== '' && get_basicbootstrap_mod('display_footer_copyright')) : ?>
                <p class="text-muted copyright"><?php echo $copyright_text; ?></p>
            <?php endif; ?>
        </div>
    </div><!-- /.clearfix -->

</div><!-- /.container -->
