/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
(function($) {

    $('[id|=menu-socials] a').each(function(i, el) {
        $(el).find('.fa').addClass('fa-fw');
        var title = $(el).attr('title');
        if (title !== undefined) {
            $(el).append($('<span />', {
                'class': 'd-sm-none',
                'html': '&nbsp;' + title
            }));
        }
    });

})(jQuery);
