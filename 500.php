<?php
/**
 * Template for displaying 50x error pages
 *
 * This is a new template created for the theme.
 * It is used and displayed by the `includes/error-pages.php` library
 * but **NEEDS** to be plugged in Wordpress by copying the `includes/fatal-error-handler.php`
 * file into your `wp-content/` directory.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 2.0
 */

$template = get_template_type();
$page_type = get_page_type();
$error_type = basicbootstrap_get_status();
$last_error = error_get_last();
if (!empty($last_error)) {
    $error_report_uniq_id = get_error_uniq_id($last_error);
}

if (BASICBOOTSTRAP_TPLDBG && function_exists('dbg_log_template_info')) {
    dbg_log_template_info(__FILE__, ['page_type'=>$page_type, 'template_type'=>$template, 'error_type'=>$error_type]);
}

get_header_hierarchical($error_type); ?>

<div id="content" role="main">

    <article id="post-0" class="post not-found jumbotron">
        <header class="header">
            <h1 class="entry-title"><?php
                switch ($error_type) {
                    case 500:
                    default:
                        _e('Internal Error', 'basicbootstrap');
                        break;
                    case 504:
                        _e('Gateway Time-out', 'basicbootstrap');
                        break;
                }
            ?></h1>
        </header>
        <section class="entry-content">
            <h2 class="text-center"><?php
                esc_html_e('This is somewhat embarrassing, isn&rsquo;t it?', 'basicbootstrap');
            ?></h2>
            <p class="text-center">
                <?php
                switch ($error_type) {
                    case 500:
                    default:
                        esc_html_e('It seems something is broken. Perhaps searching can help.', 'basicbootstrap');
                        break;
                    case 504:
                        esc_html_e('It seems something takes too long while handling your request. Perhaps searching can help.', 'basicbootstrap');
                        break;
                }
                ?>
            </p>
            <?php if (isset($error_report_uniq_id)) : ?>
            <p class="text-center"><code>
                <?php
                printf(esc_html__('Error ID: #%s', 'basicbootstrap'), $error_report_uniq_id);
                ?>
            </code></p>
            <?php endif; ?>
        </section>
        <?php get_search_form_hierarchical(); ?>
    </article>

</div>

<?php get_sidebar_hierarchical($error_type); ?>
<?php get_footer_hierarchical($error_type); ?>
