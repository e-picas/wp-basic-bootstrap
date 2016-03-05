<!-- start social links -->
<ul id="menu-socials" class="nav navbar-nav navbar-right">
    <?php
    $fb_url = get_basicbootstrap_mod('facebook_url');
    if (!empty($fb_url)) {
        echo '<li>' .
            '<a href="' . esc_url($fb_url) . '" title="' .
            esc_attr__('Facebook', 'basicbootstrap') .
            '"><i class="fa fa-facebook"></i></a></li>';
    }
    $twbs_url = get_basicbootstrap_mod('twitter_url');
    if (!empty($twbs_url)) {
        echo '<li><a href="' . esc_url($twbs_url) . '" title="' .
            esc_attr__('Twitter', 'basicbootstrap') .
            '"><i class="fa fa-twitter"></i></a></li>';
    }
    $google_url = get_basicbootstrap_mod('google_plus_url');
    if (!empty($google_url)) {
        echo '<li><a href="' . esc_url($google_url) . '" title="' .
            esc_attr__('Google +', 'basicbootstrap') .
            '"><i class="fa fa-google-plus"></i></a></li>';
    }
    $lin_url = get_basicbootstrap_mod('linkedin_url');
    if (!empty($lin_url)) {
        echo '<li><a href="' . esc_url($lin_url) . '" title="' .
            esc_attr__('LinkedIn', 'basicbootstrap') .
            '"><i class="fa fa-linkedin"></i></a></li>';
    }
    $skype_url = get_basicbootstrap_mod('skype_url');
    if (!empty($skype_url)) {
        echo '<li><a href="' . esc_url($skype_url) . '" title="' .
            esc_attr__('Skype', 'basicbootstrap') .
            '"><i class="fa fa-skype"></i></a></li>';
    }
    $pin_url = get_basicbootstrap_mod('pinterest_url');
    if (!empty($pin_url)) {
        echo '<li><a href="' . esc_url($pin_url) . '" title="' .
            esc_attr__('Pinterest', 'basicbootstrap') .
            '"><i class="fa fa-pinterest"></i></a></li>';
    }
    $tube_url = get_basicbootstrap_mod('youtube_url');
    if (!empty($tube_url)) {
        echo '<li><a href="' . esc_url($tube_url) . '" title="' .
            esc_attr__('YouTube', 'basicbootstrap') .
            '"><i class="fa fa-youtube"></i></a></li>';
    }
    $vimeao_url = get_basicbootstrap_mod('vimeo_url');
    if (!empty($vimeao_url)) {
        echo '<li><a href="' . esc_url($vimeao_url) . '" title="' .
            esc_attr__('Vimeo', 'basicbootstrap') .
            '"><i class="fa fa-vimeo-square"></i></a></li>';
    }
    $dribble_url = get_basicbootstrap_mod('dribbble_url');
    if (!empty($dribble_url)) {
        echo '<li><a href="' . esc_url($dribble_url) . '" title="' .
            esc_attr__('Dribble', 'basicbootstrap') .
            '"><i class="fa fa-dribbble"></i></a></li>';
    }
    $flickr_url = get_basicbootstrap_mod('flickr_url');
    if (!empty($flickr_url)) {
        echo '<li><a href="' . esc_url($flickr_url) . '" title="' .
            esc_attr__('Flickr', 'basicbootstrap') .
            '"><i class="fa fa-flickr"></i></a></li>';
    }
    $tumblr_url = get_basicbootstrap_mod('tumblr_url');
    if (!empty($tumblr_url)) {
        echo '<li><a href="' . esc_url($tumblr_url) . '" title="' .
            esc_attr__('Tumblr', 'basicbootstrap') .
            '"><i class="fa fa-tumblr"></i></a></li>';
    }
    $ghub_url = get_basicbootstrap_mod('github_url');
    if (!empty($ghub_url)) {
        echo '<li><a href="' . esc_url($ghub_url) . '" title="' .
            esc_attr__('Github', 'basicbootstrap') .
            '"><i class="fa fa-github"></i></a></li>';
    }
    $instagram_url = get_basicbootstrap_mod('instagram_url');
    if (!empty($instagram_url)) {
        echo '<li><a href="' . esc_url($instagram_url) . '" title="' .
            esc_attr__('Instagram', 'basicbootstrap') .
            '"><i class="fa fa-instagram"></i></a></li>';
    }
    $overflow_url = get_basicbootstrap_mod('stack_overflow_url');
    if (!empty($overflow_url)) {
        echo '<li><a href="' . esc_url($overflow_url) . '" title="' .
            esc_attr__('Stack Overflow', 'basicbootstrap') .
            '"><i class="fa fa-stack-overflow"></i></a></li>';
    }
    $exchange_url = get_basicbootstrap_mod('stack_exchange_url');
    if (!empty($exchange_url)) {
        echo '<li><a href="' . esc_url($exchange_url) . '" title="' .
            esc_attr__('Stack Exchange', 'basicbootstrap') .
            '"><i class="fa fa-stack-exchange"></i></a></li>';
    }
    $diaspora_url = get_basicbootstrap_mod('diaspora_url');
    if (!empty($diaspora_url)) {
        echo '<li><a href="' . esc_url($diaspora_url) . '" title="' .
            esc_attr__('diaspora*', 'basicbootstrap') .
            '"><i class="fa fa-asterisk"></i></a></li>';
    }
    $rss_url = get_basicbootstrap_mod('rss_url');
    if (!empty($rss_url)) {
        echo '<li><a href="'. esc_url($rss_url) . '" title="' .
            esc_attr__('RSS feed', 'basicbootstrap') .
            '"><i class="fa fa-rss"></i></a></li>';
    }

    ?>
</ul>
