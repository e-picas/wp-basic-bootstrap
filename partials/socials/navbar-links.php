<!-- start social links -->
<ul id="menu-socials" class="nav navbar-nav navbar-right">
    <?php
    if (!empty(get_basicbootstrap_mod('facebook_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('facebook_url')) . '" title="' .
            esc_attr__('Facebook', 'basicbootstrap') .
            '"><i class="fa fa-facebook"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('twitter_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('twitter_url')) . '" title="' .
            esc_attr__('Twitter', 'basicbootstrap') .
            '"><i class="fa fa-twitter"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('google_plus_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('google_plus_url')) . '" title="' .
            esc_attr__('Google +', 'basicbootstrap') .
            '"><i class="fa fa-google-plus"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('linkedin_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('linkedin_url')) . '" title="' .
            esc_attr__('LinkedIn', 'basicbootstrap') .
            '"><i class="fa fa-linkedin"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('skype_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('skype_url')) . '" title="' .
            esc_attr__('Skype', 'basicbootstrap') .
            '"><i class="fa fa-skype"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('pinterest_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('pinterest_url')) . '" title="' .
            esc_attr__('Pinterest', 'basicbootstrap') .
            '"><i class="fa fa-pinterest"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('youtube_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('youtube_url')) . '" title="' .
            esc_attr__('YouTube', 'basicbootstrap') .
            '"><i class="fa fa-youtube"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('vimeo_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('vimeo_url')) . '" title="' .
            esc_attr__('Vimeo', 'basicbootstrap') .
            '"><i class="fa fa-vimeo-square"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('dribbble_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('dribbble_url')) . '" title="' .
            esc_attr__('Dribble', 'basicbootstrap') .
            '"><i class="fa fa-dribbble"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('flickr_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('flickr_url')) . '" title="' .
            esc_attr__('Flickr', 'basicbootstrap') .
            '"><i class="fa fa-flickr"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('tumblr_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('tumblr_url')) . '" title="' .
            esc_attr__('Tumblr', 'basicbootstrap') .
            '"><i class="fa fa-tumblr"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('github_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('github_url')) . '" title="' .
            esc_attr__('Github', 'basicbootstrap') .
            '"><i class="fa fa-github"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('instagram_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('instagram_url')) . '" title="' .
            esc_attr__('Instagram', 'basicbootstrap') .
            '"><i class="fa fa-instagram"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('stack_overflow_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('stack_overflow_url')) . '" title="' .
            esc_attr__('Stack Overflow', 'basicbootstrap') .
            '"><i class="fa fa-stack-overflow"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('stack_exchange_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('stack_exchange_url')) . '" title="' .
            esc_attr__('Stack Exchange', 'basicbootstrap') .
            '"><i class="fa fa-stack-exchange"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('diaspora_url'))) {
        echo '<li><a href="' . esc_url(get_basicbootstrap_mod('diaspora_url')) . '" title="' .
            esc_attr__('diaspora*', 'basicbootstrap') .
            '"><i class="fa fa-asterisk"></i></a></li>';
    }
    if (!empty(get_basicbootstrap_mod('rss_url'))) {
        echo '<li><a href="'. esc_url(get_basicbootstrap_mod('rss_url')) . '" title="' .
            esc_attr__('RSS feed', 'basicbootstrap') .
            '"><i class="fa fa-rss"></i></a></li>';
    }

    ?>
</ul>
