<?php

$copyright_text = get_basicbootstrap_mod('copyright_text');

?>
<div class="container">

    <?php get_sidebar_hierarchical('footer'); ?>

    <?php
    wp_nav_menu(array(
        'theme_location'=> 'footer-menu',
        'fallback_cb'   => '',
        'container'     => '',
        'menu_id'       => 'footer-nav',
        'menu_class'    => 'footer-nav nav nav-pills',
    ));
    ?>

    <?php $copyright_text = get_basicbootstrap_mod('copyright_text'); ?>
    <?php if ($copyright_text !== '' && get_basicbootstrap_mod('display_footer_copyright')) : ?>
        <p class="text-muted copyright"><?php echo $copyright_text; ?></p>
    <?php endif; ?>

</div><!-- /.container -->
