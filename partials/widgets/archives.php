<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

if (
    isset($before_widget) &&
    isset($after_widget) &&
    isset($before_title) &&
    isset($after_title) &&
    isset($is_dropdown)
) :
    ?>
    <?php echo $before_widget; ?>
    <?php if ($title) {
        echo $before_title . $title . $after_title;
    } ?>

    <?php if ($is_dropdown && isset($dropdown_id) && isset($label) && isset($dropdown_args)) : ?>
    <label class="screen-reader-text" for="<?php echo esc_attr( $dropdown_id ); ?>"><?php echo $title; ?></label>
    <select class="form-control" id="<?php echo esc_attr( $dropdown_id ); ?>" name="archive-dropdown" onchange='document.location.href=this.options[this.selectedIndex].value;'>
        <option value=""><?php echo esc_attr( $label ); ?></option>
        <?php wp_get_archives( $dropdown_args ); ?>
    </select>

    <?php elseif (isset($archives_args)) : ?>
    <ul>
        <?php wp_get_archives($archives_args); ?>
    </ul>
    <?php endif; ?>

    <?php echo $after_widget; ?>

<?php endif; ?>
