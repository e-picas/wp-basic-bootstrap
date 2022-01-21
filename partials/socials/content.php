<hr />
<div class="share-links text-center">
    <ul class="list-inline">
        <!-- facebook -->
        <li class="list-inline-item">
            <a title="<?php
                printf(esc_attr__('Share this on %s', 'basicbootstrap'), 'facebook');
            ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" onclick="window.open(this.href, 'facebook-share','width=580,height=296');return false;">
                <i class="fa fa-lg fa-facebook"></i>
            </a>
        </li>
        <!-- twitter -->
        <li class="list-inline-item">
            <a title="<?php
            printf(esc_attr__('Share this on %s', 'basicbootstrap'), 'twitter');
            ?>" href="https://twitter.com/share?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'twitter-share', 'width=550,height=235');return false;">
                <i class="fa fa-lg fa-twitter"></i>
            </a>
        </li>
        <!-- google plus -->
        <li class="list-inline-item">
            <a title="<?php
            printf(esc_attr__('Share this on %s', 'basicbootstrap'), 'google +');
            ?>" href="https://plus.google.com/share?url=<?php the_permalink(); ?>" onclick="window.open(this.href, 'google-plus-share', 'width=490,height=530');return false;">
                <i class="fa fa-lg fa-google-plus"></i>
            </a>
        </li>
        <!-- reddit -->
        <li class="list-inline-item">
            <a title="<?php
            printf(esc_attr__('Share this on %s', 'basicbootstrap'), 'reddit');
            ?>" href="http://reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" onclick="window.open(this.href, 'reddit-share', 'width=490,height=530');return false;">
                <i class="fa fa-lg fa-reddit"></i>
            </a>
        </li>
        <!-- linkedin -->
        <li class="list-inline-item">
            <a title="<?php
            printf(esc_attr__('Share this on %s', 'basicbootstrap'), 'linkedin');
            ?>" href="https://www.linkedin.com/shareArticle?mini=true%26url=<?php the_permalink(); ?>%26source=<?php home_url(); ?>" onclick="window.open(this.href, 'linkedin-share', 'width=490,height=530');return false;">
                <i class="fa fa-lg fa-linkedin"></i>
            </a>
        </li>
        <!-- pinterest -->
        <li class="list-inline-item">
            <a title="<?php
            printf(esc_attr__('Share this on %s', 'basicbootstrap'), 'pinterest');
            ?>" href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());">
                <i class="fa fa-lg fa-pinterest"></i>
            </a>
        </li>
    </ul>
</div>
