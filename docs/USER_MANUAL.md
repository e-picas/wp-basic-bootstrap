WP Basic Bootstrap - User manual
================================

This manual is a documentation of how to use the *WP Basic Bootstrap* theme in your work for designers: how it is built, how
to use its features and how to customize it.

For a summary of Wordpress' themes development, read the <docs/WP_THEME_MANUAL.md>.


Theme structure
---------------

Following the [Wordpress' Theme Book rules](https://developer.wordpress.org/themes/basics/organizing-theme-files/), the
theme files structure is:

    languages/ : all languages files based on the global `basicbootstrap.pot` model

    includes/ : all the PHP stuff (libraries, classes), anything but templates

    docs/ : some raw documentation files
    
    assets/ : all CSS, fonts, images and JS files

    page-templates/ : the available page templates

    post-templates/ : the available post templates, included by the loop

    partials/ : the additional templates, separated in sub-directories by groups
    
    functions.php : the PHP stuff loaded first using this theme

    xxx.php : all theme's template files


Assets third-parties
--------------------

This theme uses the following third-parties on front-end (loaded at each run except when noted below):

-   [Bootstrap 3](http://getbootstrap.com/)
-   [Font Awesome 4](http://fontawesome.io/)
-   [HTML5shiv](http://github.com/aFarkas/html5shiv)
-   [Respond](http://github.com/scottjehl/Respond)


Templates construction
----------------------

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
