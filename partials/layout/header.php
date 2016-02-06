<?php

$page_type = get_page_type();
$header_image = get_header_image();

?><header class="blog-header" id="header" role="banner"<?php
if ( get_header_image() ) :
    echo ' style="' .
        'background-image: url(\'' . esc_url( $header_image ) . '\');' .
        'background-size: cover;' .
        'background-repeat: no-repeat;' .
        'background-position: top left;' .
        'margin-bottom: 30px;' .
        'width: 100%;' .
        'height: 100%;' .
        'min-height: ' . HEADER_IMAGE_HEIGHT . 'px;' .
        'position: relative;"';
endif; ?>>
    <div class="container clearfix"<?php
    if ( get_header_image() ) :
        echo ' style="' .
            'height: auto;' .
            'min-height: ' . HEADER_IMAGE_HEIGHT . 'px;' .
            'position: relative;"';
    endif; ?>>
        <div class="pull-left">
            <!-- start logo/sitename -->
            <hgroup>
            <?php if (is_front_page() || (get_option('show_on_front') != 'page' && is_home()) || display_header_text()) : ?>
                <?php $header_text_color = get_header_textcolor(); ?>
                <h1 class="header-entry" style="color: #<?php echo $header_text_color ?>;">
                    <?php if (has_site_icon() && display_header_logo()) : ?>
                        <a class="header-entry blog-logo" href="<?php echo esc_url(home_url()); ?>" style="color: #<?php echo $header_text_color ?>;">
                            <img src="<?php echo esc_url(get_site_icon_url(get_basicbootstrap_mod('site_icon_size'))); ?>" alt="<?php bloginfo('name'); ?>" />
                        </a>
                    <?php else : ?>
                        <a class="header-entry blog-title" href="<?php echo esc_url(home_url()); ?>" style="color: #<?php echo $header_text_color ?>;">
                            <?php bloginfo('name'); ?>
                        </a>
                    <?php endif; ?>
                    <small class="header-entry blog-description" style="color: #<?php echo $header_text_color ?>;"><?php bloginfo('description'); ?></small>
                </h1>
            <?php else : ?>
                <h1 class="hidden"><?php bloginfo('name'); ?></h1>
                <p class="hidden"><?php bloginfo('description'); ?></p>
            <?php endif; ?>
            </hgroup>
            <!-- end logo/sitename -->
        </div>
        <?php if (display_header_searchbox()) : ?>
            <div class="pull-right blog-searchbox">
                <?php get_search_form(); ?>
            </div>
        <?php endif; ?>
    </div>
</header>
