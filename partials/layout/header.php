<?php

$page_type = get_page_type();
$header_image = get_header_image();

?><header class="blog-header d-print-none" id="header"<?php
if (get_header_image()) :
    echo ' style="' .
        'background-image: url(\'' . esc_url($header_image) . '\');' .
        'background-size: cover;' .
        'background-repeat: no-repeat;' .
        'background-position: top left;' .
        'margin-bottom: 30px;' .
        'width: 100%;' .
        'height: 100%;' .
        'min-height: ' . HEADER_IMAGE_HEIGHT . 'px;' .
        'position: relative;"';
endif; ?>>
    <div class="clearfix"<?php
    if (get_header_image()) :
        echo ' style="' .
            'height: auto;' .
            'min-height: ' . HEADER_IMAGE_HEIGHT . 'px;' .
            'position: relative;"';
    endif; ?>>
        <div class="float-left">
            <!-- start logo/sitename -->
            <?php if (get_basicbootstrap_mod('display_header')) : ?>
                <?php $header_text_color = get_header_textcolor(); ?>
                <h1 class="header-entry" style="color: #<?php echo $header_text_color ?>;">
                    <?php if (has_site_icon() && get_basicbootstrap_mod('display_header_logo')) : ?>
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
                <h1 style="display: none;"><?php bloginfo('name'); ?></h1>
                <p style="display: none;"><?php bloginfo('description'); ?></p>
            <?php endif; ?>
            <!-- end logo/sitename -->
        </div>
        <?php if (get_basicbootstrap_mod('display_header_searchbox')) : ?>
            <div class="float-right blog-searchbox">
                <?php get_search_form_hierarchical(); ?>
            </div>
        <?php endif; ?>
    </div>
</header>
