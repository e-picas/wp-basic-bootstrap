WordPress theming
================

See <https://developer.wordpress.org/themes/basics/>.

## Wordpress defaults

### Default Post Types

-   Post (Post Type: ‘post')
-   Page (Post Type: ‘page')
-   Attachment (Post Type: ‘attachment')
-   Revision (Post Type: ‘revision')
-   Navigation menu (Post Type: ‘nav_menu_item')

### Default posts formats

standard
:   no post format (default)

aside
:   Typically styled without a title. Similar to a Facebook note update.

gallery
:   A gallery of images. Post will likely contain a gallery shortcode and will have image attachments.

link
:   A link to another site. Themes may wish to use the first <a href=""> tag in the post content as the external link 
    for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and 
    the title (post_title) will be the name attached to the anchor for it.

image
:   A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists 
    only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image.

quote
:   A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just 
    the content, with the source/author being the title.

status
:   A short status update, similar to a Twitter status update.

video
:   A single video. The first <video /> tag or object/embed in the post content could be considered the video. 
    Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video 
    as an attachment to the post, if video support is enabled on the blog (like via a plugin).

audio
:   An audio file. Could be used for Podcasting.

chat
:   A chat transcript

### Default taxonomies

categories
:   a hierarchical taxonomy that organizes content in the post Post Type

tags
:   a non-hierarchical taxonomy that organizes content in the post Post Type

post formats
:   a method for creating formats for your posts

### Posts visibility

-   Public & Sticky
-   Public
-   Password protected: the title is shown publicly and a prompt asks for the password
-   Private: only logged in Editor or Administrator can see it


## Conditional tags

Globals:

-   the administration panel: `is_admin()`
-   the main page: `is_home()`
-   the front page: `is_front_page()`
-   a single post page: `is_single()` / `is_single( arg )`
-   a single page: `is_page()` / `is_page( arg )`
-   a single category page: `is_category()` / `is_category( arg )`
-   a single tag page: `is_tag()` / `is_tag( arg )`
-   a single taxonomy page: `is_tax()` / `is_tax( arg )`
-   a single author page: `is_author()` / `is_author( arg )`
-   a single attachment page: `is_attachment()`
-   a date page: `is_date()` / `is_year()` / `is_month()` / `is_day()` / `is_time()`
-   an archive page: `is_archive()`
-   a search results page: `is_search()`
-   the 404 page: `is_404()`
-   a syndication feed: `is_feed()`
-   a trackback: `is_trackback()`
-   a preview of a draft post: `is_preview()`

Aliases:

-   if is_single, is_page and is_attachment: `is_singular()`

About posts:

-   a sticky post: `is_sticky()`
-   test if a post type exists: `post_type_exists()`
-   test if a post type supports hierarchical concept: `is_post_type_hierarchical( $post_type )`
-   test if a post type supports archiving concept: `is_post_type_archive( $post_type )`
-   get a post type: `get_post_type()`
-   test if a post is in a category: `in_category( arg )`
-   test if a post has one or more tags: `has_tag()` / `has_tag( arg )`
-   test if a post has one or more taxonomies: `has_term()` / `has_term( arg )`
-   test if a taxonomy exists: `taxonomy_exists()`
-   test if a post has more than one author: `is_multi_author()`
-   test if today is not the publication date: `is_new_day()`
-   test if a post has an excerpt: `has_excerpt()`

About comments:

-   test if comments popup is opened: `is_comments_popup()`
-   test if a post accepts comments: `comments_open()`
-   test if a post accepts pingbacks: `pings_open()`

Templates specifics:

-   test if we are in a page template: `is_page_template()` / `is_page_template( template_name )`
-   test if menu entry is defined for a location: `has_nav_menu()`
-   test if a sidebar location is activated: `is_active_sidebar()`
-   test if we are inside a loop: `in_the_loop()`
-   test if a plugin is activated: `is_plugin_active()`
-   test if current theme supports a feature: `current_theme_supports()`

Learn more at <https://codex.wordpress.org/Conditional_Tags>.

## Template Files List

### Template partials

header.php
:   for generating the site's header

footer.php
:   for generating the footer

sidebar.php
:   for generating the sidebar

### Template common files

style.css
:   The main stylesheet. This must be included with your Theme, and it must contain the information header for your Theme. 

rtl.css
:   The rtl stylesheet. This will be included automatically if the website's text direction is right-to-left. 
    This can be generated using the RTLer plugin. 

index.php
:   The main template. If your Theme provides its own templates, index.php must be present. 

comments.php
:   The comments template. 

front-page.php
:   The front page template. 
:   Fallbacks:
    -   home.php
    -   index.php

home.php
:   The home page template, which is the front page by default. If you use a static front page this is the template 
    for the page with the latest posts. 
:   Fallbacks:
    -   index.php

single.php
:   The single post template. Used when a single post is queried. For this and all other query templates, 
    index.php is used if the query template is not present.
:   Fallbacks:
    -   single-{post-type}-{slug}.php
    -   single-{post-type}.php
    -   single.php
    -   singular.php
    -   index.php

page.php
:   The page template. Used when an individual Page is queried. 
:   Fallbacks:
    -   custom template file – see get_page_templates()
    -   page-{slug}.php
    -   page-{id}.php
    -   page.php
    -   singular.php
    -   index.php

category.php
:   The category template. Used when a category is queried.
:   Fallbacks:
    -   category-{slug}.php
    -   category-{id}.php
    -   category.php
    -   archive.php
    -   index.php

tag.php
:   The tag template. Used when a tag is queried.
:   Fallbacks:
    -   tag-{slug}.php
    -   tag-{id}.php
    -   tag.php
    -   archive.php
    -   index.php

taxonomy.php
:   The term template. Used when a term in a custom taxonomy is queried.
:   Fallbacks:
    -   taxonomy-{taxonomy}-{term}.php
    -   taxonomy-{taxonomy}.php
    -   taxonomy.php
    -   archive.php
    -   index.php

author.php
:   The author template. Used when an author is queried.
:   Fallbacks:
    -   author-{nicename}.php
    -   author-{id}.php
    -   author.php
    -   archive.php
    -   index.php

date.php
:   The date/time template. Used when a date or time is queried. Year, month, day, hour, minute, second.
:   Falbacks:
    -   date.php
    -   archive.php
    -   index.php

archive.php
:   The archive template. Used when a category, author, or date is queried. Note that this template will be overridden 
    by category.php, author.php, and date.php for their respective query types. 

search.php
:   The search results template. Used when a search is performed.
:   Fallbacks:
    -   index.php

attachment.php
:   Attachment template. Used when viewing a single attachment.
:   Fallbacks:
    -   MIME_type.php – example for text/plain:
        -   text.php
        -   plain.php
        -   text_plain.php
    -   attachment.php
    -   single-attachment.php
    -   single.php
    -   index.php

image.php
:   Image attachment template. Used when viewing a single image attachment.
:   Fallbacks:
    -   attachment.php

404.php
:   The 404 Not Found template. Used when WordPress cannot find a post or page that matches the query.
:   Fallbacks:
    -   index.php


## Theme options

### Theme supports

Each theme can inform Wordpress about its features support, in:

-   `post-formats`: list the type of post formats handled by the theme:

        add_theme_support(
            'post-formats',
            array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat')
        );

-   `post-thumbnails`: informs WP that the theme handles and uses thumbnails, this enables the "Featured Image"
    meta-box on post edit page

-   `custom-header`: inform WP that the theme handles a user defined header image, this also
    enables the header background customizer:

        $defaults = array(
            'default-image'          => '',
            'random-default'         => false,
            'width'                  => '980',
            'height'                 => '170',
            'flex-height'            => true,
            'flex-width'             => true,
            'default-text-color'     => '333',
            'header-text'            => true,
            'uploads'                => true,
            'wp-head-callback'       => '',
            'admin-head-callback'    => '',
            'admin-preview-callback' => '',
        );
        add_theme_support( 'custom-header', $defaults );

-   `custom-background`: inform WP that the theme handles a user defined body background, this also
    enables the body background customizer:

        $defaults = array(
            'default-color'          => '',
            'default-image'          => '',
            'wp-head-callback'       => '_custom_background_cb',
            'admin-head-callback'    => '',
            'admin-preview-callback' => ''
        );
        add_theme_support( 'custom-background', $defaults );

-   `automatic-feed-links`: let WP add feed links in header:

        add_theme_support('automatic-feed-links');

-   `html5`: let WP construct some templates using HTML5 features:

        add_theme_support(
            'html5', 
            array('comment-list', 'comment-form', 'search-form', 'gallery', 'caption')
        );

-   `title-tag`: inform WP that the theme uses the `wp_head()` function to let it (or its plugins)
    build the `title` header tag:

        add_theme_support('title-tag');

### Image sizing

WP defaults are:

-   ‘thumb' / ‘thumbnail' (150px x 150px)
-   ‘medium' (300px x 300px)
-   ‘large' (640px x 640px)
-   ‘post-thumbnail' (defined by theme)
-   'full' (unmodified)

To define the sizes of thumbnails, use:

    set_post_thumbnail_size( $width, $height, $crop );

To define a new size for images, use:

    add_image_size ( string $name, int $width, int $height, bool|array $crop = false );
    // to use it:
    the_post_thumbnail( $name );

### Theme *mods*

The following methods can be used to access *modification settings* ("mod") one by one:

    set_theme_mod( $name, $value );
    get_theme_mod( $name, $default );
    remove_theme_mod( $name );

To access the whole settings array, use:

    get_theme_mods();
    remove_theme_mods();

The settings can be defined, for instance, in the customizer panel 
(see <https://developer.wordpress.org/themes/advanced-topics/customizer-api/>).

### Internationalisation

Basic functions:

    __()
    _e()
    _x()
    _ex()
    _n()
    _nx()
    _n_noop()
    _nx_noop()
    translate_nooped_plural()

Escape functions:

    esc_html__()
    esc_html_e()
    esc_html_x()
    esc_attr__()
    esc_attr_e()
    esc_attr_x()

Date and number functions:

    number_format_i18n()
    date_i18n()

Learn more: 

-   <https://developer.wordpress.org/themes/functionality/internationalization/>
-   <http://www.gsy-design.com/how-to-generate-a-pot-file-using-poedit/>

