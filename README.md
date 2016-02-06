WP Basic Bootstrap - A 101 Wordpress theme ready for modern web
===============================================================

Description
-----------

WP Basic Bootstrap is a full "101" Wordpress theme built with the Bootstrap framework and the Font Awesome images font, 
ready to build a responsive and accessible blog or to be modified to build your own theme.

The theme is built using the Wordpress best practices: it supports all theme features, 
uses internal `filters` and `actions` to plug its rendering options and its code follows the Wordpress 
and PSR coding standards.

Many options are available in the admin panel's customizer, such as layout selection, 
template options, colors and fonts.


Installation
------------

1. In your admin panel, go to Appearance -> Themes and click the 'Add New' button.
2. Type in Twenty Fifteen in the search form and press the 'Enter' key on your keyboard.
3. Click on the 'Activate' button to use your new theme right away.
4. Go to <> for a guide on how to customize this theme.
5. Navigate to Appearance > Customize in your admin panel and customize to taste.


Copyright & License
-------------------

WP Basic Bootstrap, Copyright 2016 Pierre Cassat & contributors

WP Basic Bootstrap is distributed under a dual-license:

-   under the terms of the GNU GPL for non-commercial usage
-   under the terms of a commercial license for commercial usage

Please contact the author for more information about the commercial license.

WP Basic Bootstrap bundles the following third-party resources:

1.  Bootstrap <http://getbootstrap.com/>
    Licensed under MIT <https://github.com/twbs/bootstrap/blob/master/LICENSE>

2.  Font Awesome <http://fontawesome.io/>
    Licensed under MIT <https://github.com/dimsemenov/Magnific-Popup/blob/master/LICENSE>
    <http://fontawesome.io/license> (Font: SIL OFL 1.1, CSS: MIT License)


Templates construction
----------------------

### Global layout

As largely discussed in the [Wordpress Theme Handbook](http://developer.wordpress.org/themes/basics/), the whole theme
is built to let any page uses its *header*, *sidebar* and *footer* do their job:

    ---------------------
    | header.php        |
    ---------------------
    | any           |  sidebar.php
    | content       |   |
    |               |   |
    |               |   |
    ---------------------
    | footer.php        |
    ---------------------

The global layout follows the HTML5, ARIA and RDFa best practices:

    body
    => role=document

    div#wrapper

        // with a fixed or static navbar
        // navbar goes here (outside the .container)

        div.container

            nav#navigation.navbar
            => .blog-navigation / role=navigation

            header#header
            => .blog-header / role=banner
    
            div.row

                // with a sidebar
                div.col-sm-9
                    => content goes here

                aside#sidebar.col-sm-3
                => .blog-sidebar(-right/-left) / role=complementary

                // full width
                div.col-sm-12
                    => content goes here

        footer#footer
        => .blog-footer / role=contentinfo

If you need to create a new template, your content should only contain the followings:

    section#content with role=main

Please note that the main content is always written first in the generated HTML (even if it is displayed right).

Some settings can let you customize the global layout and choose between the following *page templates*:

-   **full width**: no sidebar at all
-   **right sidebar**: content on the left and sidebar on the right (this is the "classic" usage)
-   **left sidebar**: sidebar first, on the left, and content on the right 

### Microdata

To be compliant with SEO, we try to implement the following [RDFa schemas](http://schema.org/):

-   [Article](http://schema.org/Article) for each single post or list of posts
-   [ListItem](http://schema.org/ListItem) for the breadcrumbs

Learn more (in French): <https://openclassrooms.com/courses/creer-un-blog-accessible-avec-html5>.


Third-party libraries
---------------------

The **WP Basic Bootstrap** theme uses the following third parties:

-   [**jQuery**](http://jquery.com/), which is embedded in Wordpress
-   [**Bootstrap**](http://getbootstrap.org/) to build full responsive HTML5 contents
-   [**Font Awesome**](http://fortawesome.github.io/Font-Awesome/) for all icons
