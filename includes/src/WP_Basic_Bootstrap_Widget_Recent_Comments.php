<?php
/**
 * Replacement for the recent comments widget
 *
 * This version adds a 'show date' option.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

class WP_Basic_Bootstrap_Widget_Recent_Comments extends WP_Widget_Recent_Comments
{

    /**
     * Outputs the content for the current Recent Comments widget instance.
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Comments widget instance.
     */
    public function widget($args, $instance)
    {
        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        $output = '';

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Comments' );

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
        if ( ! $number )
            $number = 5;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        /**
         * Filter the arguments for the Recent Comments widget.
         *
         * @since 3.4.0
         *
         * @see WP_Comment_Query::query() for information on accepted arguments.
         *
         * @param array $comment_args An array of arguments used to retrieve the recent comments.
         */
        $comments = get_comments( apply_filters( 'widget_comments_args', array(
            'number'      => $number,
            'status'      => 'approve',
            'post_status' => 'publish'
        ) ) );

        if (is_array($comments) && $comments) {
            // Prime cache for associated posts. (Prime post term cache if we need it for permalinks.)
            $post_ids = array_unique( wp_list_pluck( $comments, 'comment_post_ID' ) );
            _prime_post_caches( $post_ids, strpos( get_option( 'permalink_structure' ), '%category%' ), false );

            $args['title']      = $title;
            $args['comments']   = $comments;
            $args['show_date']  = true;//$show_date;

            get_template_part_with_arguments('partials/widgets/recent-comments', '', $args);

            wp_reset_postdata();
        }
    }

    /**
     * Handles updating settings for the current Recent Comments widget instance.
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field( $new_instance['title'] );
        $instance['number'] = absint( $new_instance['number'] );
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Comments widget.
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        $title = isset( $instance['title'] ) ? $instance['title'] : '';
        $number = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        ?>
        <p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of comments to show:' ); ?></label>
            <input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo $number; ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display comment date?', 'basicbootstrap' ); ?></label></p>
        <?php
    }
}
