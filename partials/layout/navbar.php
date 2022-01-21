<?php

$base_class_setting = get_basicbootstrap_mod('navbar_style');
switch($base_class_setting) {
    case 'inverse':
        $base_class = 'navbar-dark bg-dark';
        break;
    default:
    case 'default':
        $base_class = 'navbar-light bg-light';
        break;
}
$navbar_type    = get_basicbootstrap_mod('navbar_type');

?>
<nav class="blog-navigation navbar navbar-expand-sm <?php echo $base_class; ?><?php
    if ($navbar_type == 'static_top')       echo ' navbar-static-top';
    elseif ($navbar_type == 'fixed_top')    echo ' fixed-top navbar-fixed-top';
    elseif ($navbar_type == 'fixed_bottom') echo ' fixed-bottom navbar-fixed-bottom';
?>" id="navigation">
    <div class="container-fluid">
        <?php if (get_theme_mod('show_navbar_brand', true)) : ?>
        <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>
        <button type="button" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only"><?php _e('Toggle navigation', 'basicbootstrap'); ?></span>
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="navbar-collapse collapse">
            <?php

            wp_nav_menu(array(
                'menu'              => 'primary',
                'theme_location'    => 'main-menu',
                'depth'             => 0,
                'container'         => null,
                'menu_class'        => 'navbar-nav mr-auto',
                'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                'walker'            => new WP_Bootstrap_Navwalker()
            ));

            if (get_basicbootstrap_mod('display_social_icons')) {
                get_template_part_hierarchical('partials/socials/navbar-links');

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
