<?php

$copyright_text = get_basicbootstrap_mod('copyright_text');

?>
<div class="container">

    <?php get_sidebar_hierarchical('footer'); ?>

    <hr class="d-none d-xs-block" />

    <div class="d-none d-xs-block">
        <?php
        wp_nav_menu(array(
            'theme_location'=> 'footer-menu',
            'fallback_cb'   => '',
            'container_class' => 'd-none d-xs-block',
            'menu_id'       => 'footer-nav-xs',
            'menu_class'    => 'footer-nav nav nav-pills nav-stacked',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker()
        ));
        ?>
        <hr />
        <?php if ($copyright_text !== '' && get_basicbootstrap_mod('display_footer_copyright')) : ?>
            <p class="text-muted copyright"><?php echo $copyright_text; ?></p>
        <?php endif; ?>
    </div>
    <div class="clearfix d-xs-none">
        <div class="float-left">
            <?php
            wp_nav_menu(array(
                'theme_location'=> 'footer-menu',
                'fallback_cb'   => '',
                'container_class' => 'd-xs-none',
                'menu_id'       => 'footer-nav',
                'menu_class'    => 'footer-nav nav nav-pills',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker()
            ));
            ?>
        </div>
        <div class="float-right">
            <?php if ($copyright_text !== '' && get_basicbootstrap_mod('display_footer_copyright')) : ?>
                <p class="text-muted copyright"><?php echo $copyright_text; ?></p>
            <?php endif; ?>
        </div>
    </div><!-- /.clearfix -->

</div><!-- /.container -->
