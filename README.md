WP Basic Bootstrap - A 101 Wordpress theme ready for modern web
===============================================================

Description
-----------

**WP Basic Bootstrap** is a full "101" [Wordpress](http://wordpress.org/) theme 
built with the [*Bootstrap* framework](http://getbootstrap.com/) and the 
[*Font Awesome* images font](http://fontawesome.io/), which implements all features 
of Wordpress version 4+ and is ready to build a responsive and accessible blog or 
to be modified to build your own theme.

The theme is built using the Wordpress best practices:

-   its takes advantage of the customizer panel of the Wordpress' backend to let user
    choose the best rendering with a lot of options concerning styles, templates and
    layouts;
-   it supports all [theme features](https://codex.wordpress.org/Theme_Features) such as 
    *post formats*, *header* and *background* customization, *thumbnails*, *HTML5 markup*,
    *sidebars*, *navigation menus* and *sticky posts*;
-   it implements its templates to follow the [template hierarchy](https://developer.wordpress.org/themes/basics/template-hierarchy/)
    of Wordpress;
-   it uses internal *hooks* to plug its rendering options;
-   it implements its own *hooks* to easily customize its features;
-   it is ready for translations;
-   its code follows the [Wordpress](http://codex.wordpress.org/WordPress_Coding_Standards) 
    and [PSR](http://www.php-fig.org/) coding standards.

The theme can be used out of the box for a personal blog, but can also be a **robust and well-coded** 
basis to build your own themes (see the license section of this file to learn about commercial
usage).

Installation as a theme
-----------------------

1. In your admin panel, go to "Appearance > Themes" and click the "Add New" button.
2. Type in "Basic Bootstrap" in the search form and press the "Enter" key on your keyboard.
3. Click on the "Activate" button to use your new theme right away.
4. Navigate to "Appearance > Customize" in your admin panel and customize to taste.

NOTE - For those who are [Composer](http://getcomposer.org/) users, the package is registered
as `picas/wp-basic-bootstrap`.

Installation with a child theme
-------------------------------

To use this theme as a parent of a child theme, you can begin your child theme with the following `style.css` file:

    /*
    Theme Name:     My Child Theme
    Template:       wp-basic-bootstrap
    */

The parent theme (this original theme) must be installed.

Installation as a basis to build your own theme
-----------------------------------------------

If you want to use this theme as a basis to modify, you may register the original repository URL as a GIT remote.

In the example below, let's say your own theme is hosted at `http://github.com/user/my-theme`:

    mkdir my-theme && cd $_
    git init .
    git remote add origin https://github.com/user/my-theme.git
    git remote add upstream https://github.com/e-picas/wp-basic-bootstrap.git

This way, you will be able to make your commits to your own theme and push them to your own repository:

    touch readme.txt
    git add readme.txt
    git commit -m "this is a fake commit"
    git push --set-upstream origin master

And you will be able to update your basis with its last commits (eventually):

    git fetch upstream
    git merge --no-ff --no-commit upstream/master
    git status
    git commit

Usage
-----

Various documentations are available (as plain text Markdown files) in the <doc/> directory
of this repository.

Copyright & License
-------------------

    WP Basic Bootstrap, Copyright 2016 Pierre Cassat & contributors

The *WP Basic Bootstrap* theme is distributed under a **dual-license**:

-   under the terms of the **GNU GPL for non-commercial usage**
-   under the terms of a **commercial license for commercial usage**.

Please contact the author for more information about the commercial license.

WP Basic Bootstrap bundles the following third-party resources:

1.  Bootstrap (<http://getbootstrap.com/>), licensed under 
    [MIT](https://github.com/twbs/bootstrap/blob/master/LICENSE)

2.  Font Awesome (<http://fontawesome.io/>), licensed under both 
    [MIT](https://github.com/dimsemenov/Magnific-Popup/blob/master/LICENSE) for the CSS and 
    [SIL OFL 1.1](http://fontawesome.io/license) for the Font

3.  TGM Plugin Activation (<http://tgmpluginactivation.com/>), licensed under 
    [GPL](https://github.com/TGMPA/TGM-Plugin-Activation/blob/develop/LICENSE.md)

4.  wp_bootstrap_navwalker (<http://github.com/twittem/wp-bootstrap-navwalker>), licensed under 
    [GPL](https://github.com/twittem/wp-bootstrap-navwalker/blob/master/LICENSE.txt)

5.  WP Template Hierarchy Everywhere (<http://github.com/e-picas/wp-template-hierarchy-everywhere>), licensed under 
    [GPL](http://www.gnu.org/licenses/gpl-3.0.html)

The following external WordPress plugins are required or recommended with this theme:

1.  [Meta Box](http://wordpress.org/plugins/meta-box/) to add some specific fields in the admin panel
    of WordPress for each post formats - *required*

2.  [Bootstrap 3 Shortcodes](http://wordpress.org/plugins/bootstrap-3-shortcodes/) to take advantage
    of all Bootstrap's features in posts contents - *recommended*

3.  [Font Awesome Shortcodes](http://wordpress.org/plugins/font-awesome-shortcodes/) to take advantage
    of the icons font in posts contents - *recommended*

4.  [Multiple Favicons](http://wordpress.org/plugins/multicons/) to handle all devices icons for your
    website - *recommended*

All of these are free plugins and will be handled automatically when enabling the theme in the admin panel.
