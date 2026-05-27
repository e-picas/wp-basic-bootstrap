/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
(function($){

    // Update the header text color in real time...
    wp.customize('header_textcolor', function(value) {
        value.bind(function(to) {
            if ('blank' === to) {
                $('.header-entry').css({
                    'clip': 'rect(1px, 1px, 1px, 1px)',
                    'position': 'absolute'
                });
            } else {
                $('.header-entry').css({
                    'clip': 'auto',
                    'position': 'static',
                    'color': to
                });
            }
        });
    });

    // Update the site title in real time...
    wp.customize('blogname', function(value) {
        value.bind(function(newval) {
            $('.blog-title, .navbar-brand').html(newval);
        });
    });

    // Update the site description in real time...
    wp.customize('blogdescription', function(value) {
        value.bind(function(newval) {
            $('.blog-description').html(newval);
        });
    });

    // Update the copyright text in real time...
    wp.customize('copyright_text', function(value) {
        value.bind(function(newval) {
            $('p.copyright').html(newval);
        });
    });


    //Update the body font family in real time...
    wp.customize( 'body_fontfamily', function(value) {
        value.bind(function(newval) {
            console.debug(newval);
            $('body').css('font-family', newval );
        } );
    } );

    //Update the headings font family in real time...
    wp.customize( 'headings_fontfamily', function(value) {
        value.bind(function(newval) {
            $('h1, .h1, h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6').css('font-family', newval );
        } );
    } );

    //Update the menu font family in real time...
    wp.customize( 'menu_fontfamily', function(value) {
        value.bind(function(newval) {
            $('.navbar').css('font-family', newval );
        } );
    } );

    //Update header text display in real time...
    wp.customize( 'header_textcolor', function(value) {
        value.bind(function(newval) {
            if ( newval !== 'blank' ) {
                $( '.blog-title' ).css({
                    'visibility': 'visible',
                    'margin-top': '30px',
                    'font-size': '60px'
                });
                $( '.blog-description' ).css({
                    'visibility': 'visible',
                    'margin-bottom': '20px',
                    'font-size': '20px'
                });
                $( '.blog-title, .blog-description' ).css('color', newval );
            } else {
                $( '.blog-title' ).css({
                    'visibility': 'hidden',
                    'margin-top': '0',
                    'font-size': '0'
                });
                $( '.blog-description' ).css({
                    'visibility': 'hidden',
                    'margin-bottom': '0',
                    'font-size': '0'
                });
                $( '.blog-title, .blog-description' ).css('color', newval );
            }
        } );
    } );

    //Update site background color in real time...
    wp.customize( 'background_color', function(value) {
        value.bind(function(newval) {
            $('body').css('background-color', newval );
        } );
    } );

    //Update active menu caret color in real time...
    wp.customize( 'background_color', function(value) {
        value.bind(function(newval) {
            $('.blog-nav .active').css('color', newval );
        } );
    } );

    //Update site link color in real time...
    wp.customize( 'link_textcolor', function(value) {
        value.bind(function(newval) {
            $('a:not(.navbar .navbar-brand, .navbar .navbar-nav > li > a, .dropdown-menu > li > a, .navbar .navbar-nav .open .dropdown-menu > li > a, .blog-footer a)').css('color', newval );
        } );
    } );

    //Update site hover link color in real time...
    wp.customize( 'hover_textcolor', function(value) {
        value.bind(function(newval) {
            $('a:hover:not(.navbar .navbar-nav > li > a:hover, .dropdown-menu > li > a:hover, .navbar .navbar-nav .open .dropdown-menu > li > a:hover, .blog-footer a:hover)').css('color', newval );
            $('a:focus:not(.navbar .navbar-nav > li > a:focus, .dropdown-menu > li > a:focus, .navbar .navbar-nav .open .dropdown-menu > li > a:focus, .blog-footer a:focus)').css('color', newval );
        } );
    } );

    //Update site text color in real time...
    wp.customize( 'body_textcolor', function(value) {
        value.bind(function(newval) {
            $('body').css('color', newval );
        } );
    } );

    //Update site headings color in real time...
    wp.customize( 'headings_textcolor', function(value) {
        value.bind(function(newval) {
            $('h1:not(.blog-title)').css('color', newval);
            $('h2, .h2, h3, .h3, h4, .h4, h5, .h5, h6, .h6').css('color', newval );
        } );
    } );

    //Update primary menu color in real time...
    wp.customize( 'primary_menucolor', function(value) {
        value.bind(function(newval) {
            $('.navbar').css('background-color', newval );
        } );
    } );

    //Update primary link color in real time...
    wp.customize( 'primary_linkcolor', function(value) {
        value.bind(function(newval) {
            $('.navbar .navbar-brand, .navbar .navbar-nav > li > a').css('color', newval );
        } );
    } );

    //Update primary hover link color in real time...
    wp.customize( 'primary_hovercolor', function(value) {
        value.bind(function(newval) {
            $('.navbar .navbar-nav > li > a:hover, .navbar .navbar-nav > li > a:focus').css('color', newval );
        } );
    } );

    //Update primary active link color in real time...
    wp.customize( 'primary_activecolor', function(value) {
        value.bind(function(newval) {
            $('.navbar .navbar-nav > .active > a, .navbar .navbar-nav > .active > a:hover, .navbar .navbar-nav > .active > a:focus').css('color', newval );
        } );
    } );

    //Update primary active background color in real time...
    wp.customize( 'primary_activebackground', function(value) {
        value.bind(function(newval) {
            $('.navbar .navbar-nav > .active > a, .navbar .navbar-nav > .active > a:hover, .navbar .navbar-nav > .active > a:focus, .navbar .navbar-nav > .open > a, .navbar .navbar-nav > .open > a:hover, .navbar .navbar-nav > .open > a:focus').css('background-color', newval );
        } );
    } );

    //Update dropdown menu color in real time...
    wp.customize( 'dropdown_menucolor', function(value) {
        value.bind(function(newval) {
            $('.dropdown-menu').css('background-color', newval );
        } );
    } );

    //Update dropdown link color in real time...
    wp.customize( 'dropdown_linkcolor', function(value) {
        value.bind(function(newval) {
            $('.dropdown-menu > li > a, .navbar .navbar-nav .open .dropdown-menu > li > a').css('color', newval );
        } );
    } );

    //Update dropdown hover color in real time...
    wp.customize( 'dropdown_hovercolor', function(value) {
        value.bind(function(newval) {
            $('.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar .navbar-nav .open .dropdown-menu > li > a:hover, .navbar .navbar-nav .open .dropdown-menu > li > a:focus').css('color', newval );
        } );
    } );

    //Update dropdown hover color in real time...
    wp.customize( 'dropdown_hoverbackground', function(value) {
        value.bind(function(newval) {
            $('.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus, .navbar .navbar-nav .open .dropdown-menu > li > a:hover, .navbar .navbar-nav .open .dropdown-menu > li > a:focus').css('background-color', newval );
        } );
    } );

    //Update dropdown active link color in real time...
    wp.customize( 'dropdown_activecolor', function(value) {
        value.bind(function(newval) {
            $('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar .navbar-nav .open .dropdown-menu > .active > a, .navbar .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar .navbar-nav .open .dropdown-menu > .active > a:focus').css('color', newval );
        } );
    } );

    //Update dropdown active background color in real time...
    wp.customize( 'dropdown_activebackground', function(value) {
        value.bind(function(newval) {
            $('.dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus, .navbar .navbar-nav .open .dropdown-menu > .active > a, .navbar .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar .navbar-nav .open .dropdown-menu > .active > a:focus').css('background-color', newval );
        } );
    } );

    //Update footer text color in real time...
    wp.customize( 'footer_textcolor', function(value) {
        value.bind(function(newval) {
            $('.blog-footer').css('color', newval );
        } );
    } );

    //Update footer link color in real time...
    wp.customize( 'footer_linkcolor', function(value) {
        value.bind(function(newval) {
            $('.blog-footer a').css('color', newval );
        } );
    } );

    //Update footer hover link color in real time...
    wp.customize( 'footer_hovercolor', function(value) {
        value.bind(function(newval) {
            $('.blog-footer a:hover, .blog-footer a:focus').css('color', newval );
        } );
    } );

    //Update footer background color in real time...
    wp.customize( 'footer_backgroundcolor', function(value) {
        value.bind(function(newval) {
            $('.blog-footer').css('background-color', newval );
        } );
    } );

})(jQuery);
