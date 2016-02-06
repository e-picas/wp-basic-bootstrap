<?php

$base_class     = get_basicbootstrap_mod('navbar_style');
$navbar_type    = get_basicbootstrap_mod('navbar_type');

?>
<nav class="blog-navigation navbar navbar-<?php echo $base_class; ?><?php
    if ($navbar_type == 'static_top')       echo ' navbar-static-top';
    elseif ($navbar_type == 'fixed_top')    echo ' navbar-fixed-top';
    elseif ($navbar_type == 'fixed_bottom') echo ' navbar-fixed-bottom';
?>" id="navigation" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only"><?php _e('Toggle navigation', 'basicbootstrap'); ?></span>
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
        <?php if (get_theme_mod('show_navbar_brand', true)) : ?>
            <a class="navbar-brand" href="<?php echo esc_url( home_url('/') ); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php

            wp_nav_menu(array(
                'menu'              => 'primary',
                'theme_location'    => 'main-menu',
                'depth'             => 0,
                'container'         => null,
                'menu_class'        => 'nav navbar-nav',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker()
            ));

            if (get_basicbootstrap_mod('display_social_icons')) {
                get_template_part('partials/socials/navbar-links');

            } else {
                wp_nav_menu(array(
                    'menu'              => 'social',
                    'theme_location'    => 'social-menu',
                    'depth'             => 1,
                    'container'         => null,
                    'menu_class'        => 'nav navbar-nav navbar-right',
                    'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                    'walker'            => new WP_Bootstrap_Navwalker()
                ));
            }

            ?>
        </div><!--/.nav-collapse -->
    </div>
</nav>
