=== WordPress Basic Bootstrap ===
Contributors: picas
Donate link: http://blog.picas.fr/about/
Requires at least: 4.0.0
Tested up to: 4.7.0
Stable tag: trunk
License: GPLv3 / proprietary

**WP Basic Bootstrap** is a full "101" [Wordpress](http://wordpress.org/) theme
built with the [*Bootstrap* framework](http://getbootstrap.com/) and the
[*Font Awesome* images font](http://fontawesome.io/), which implements all features
of Wordpress version 4+ and is ready to build a responsive and accessible blog or
to be modified to build your own theme.

== Description ==

Please read the original repository [README](https://github.com/e-picas/wp-basic-bootstrap) for more information.

NOTE - We use *Markdown* files for our documentations. These files are named with an `.md` extension but you can consider
them as plain text and open them in you favorite text editor (or with `vim`).

== Frequently asked questions ==

= Can I disable styles customization? =

Yes. Just write the following line in your theme/plugin:

    remove_action('wp_head', array('WP_Basic_Bootstrap_Customizer', 'headerOutput'));
