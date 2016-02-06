WP Basic Bootstrap - A 101 Wordpress theme ready for modern web
===============================================================

Description
-----------

WP Basic Bootstrap is a full "101" [Wordpress](http://wordpress.org/) theme built with 
the [Bootstrap framework](http://getbootstrap.com/) and the [Font Awesome images font](http://fontawesome.io/), 
which implements all features of Wordpress version 4 and is ready to build a responsive 
and accessible blog or to be modified to build your own theme.

The theme is built using the Wordpress best practices: it supports all theme features such
as post formats, header and background customization and sticky posts, uses internal 
`filters` and `actions` to plug its rendering options, is ready for translations and its code follows the 
[Wordpress](http://codex.wordpress.org/WordPress_Coding_Standards) and [PSR](http://www.php-fig.org/) 
coding standards.

Many options are available in the admin panel's customizer, such as layout selection, 
template options, colors and fonts.

The theme can ba used out of the box but can also be a **robust and well-coded** basis
to build your own theme (see the license section of this file to learn about commercial
usage).


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

The *WP Basic Bootstrap* theme is distributed under a **dual-license**:

-   under the terms of the **GNU GPL for non-commercial usage**
-   under the terms of a **commercial license for commercial usage**.

Please contact the author for more information about the commercial license.

WP Basic Bootstrap bundles the following third-party resources:

1.  Bootstrap (<http://getbootstrap.com/>), licensed under [MIT](https://github.com/twbs/bootstrap/blob/master/LICENSE)

2.  Font Awesome (<http://fontawesome.io/>), licensed under both [MIT](https://github.com/dimsemenov/Magnific-Popup/blob/master/LICENSE)
    for the CSS and [SIL OFL 1.1](http://fontawesome.io/license) for the Font

3.  Social Buttons for Bootstrap (<http://github.com/lipis/bootstrap-social>), licensed 
    under [MIT](https://github.com/lipis/bootstrap-social/blob/gh-pages/LICENSE)


Templates construction
----------------------

NOTE - A documentation is coming ...

### Global layout

As largely discussed in the [Wordpress Theme Handbook](http://developer.wordpress.org/themes/basics/), the whole theme
is built to let any page uses its *header*, *sidebar* and *footer* do their job:


    ---------------------
    | header.php        |               wp_head()
    ---------------------               body_class()
    | any           |  sidebar.php      dynamic_sidebar(main)
    | content       |   |
    |               |   |               get_template_part(content, get_post_format())
    |               |   |
    |               |   |
    |               |   |
    ---------------------
    | footer.php        |               wp_footer()
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
