<?php
/**
 * Replacement for the recent posts widget
 *
 * This version adds a 'show thumbnail' option.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

/**
 * Class WP_Basic_Bootstrap_Widget_Recent_Posts
 */
class WP_Basic_Bootstrap_Widget_Recent_Posts extends WP_Widget_Recent_Posts
{
    /**
     * Outputs the content for the current Recent Posts widget instance.
     *
     * @param array $args     Display arguments including 'before_title', 'after_title',
     *                        'before_widget', and 'after_widget'.
     * @param array $instance Settings for the current Recent Posts widget instance.
     */
    public function widget($args, $instance)
    {
        if (!isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Recent Posts');

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $number = (!empty($instance['number'])) ? absint($instance['number']) : 5;
        if (!$number) {
            $number = 5;
        }
        $show_date = isset($instance['show_date']) ? $instance['show_date'] : false;
        $show_thumb = isset($instance['show_thumb']) ? $instance['show_thumb'] : true;

        /**
         * Filter the arguments for the Recent Posts widget.
         *
         * @since 3.4.0
         *
         * @see WP_Query::get_posts()
         *
         * @param array $args An array of arguments used to retrieve the recent posts.
         */
        $r = new WP_Query(apply_filters('widget_posts_args', array(
            'posts_per_page'      => $number,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => true
        )));

        if ($r->have_posts()) {
            $args['title']      = $title;
            $args['loop']       = $r;
            $args['show_date']  = $show_date;
            $args['show_thumb'] = $show_thumb;

            get_template_part_hierarchical_fetch('partials/widgets/recent-posts', '', $args);

            wp_reset_postdata();
        }
    }


    /**
     * Handles updating the settings for the current Recent Posts widget instance.
     *
     * @param array $new_instance New settings for this instance as input by the user via
     *                            WP_Widget::form().
     * @param array $old_instance Old settings for this instance.
     * @return array Updated settings to save.
     */
    public function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset($new_instance['show_date']) ? (bool) $new_instance['show_date'] : false;
        $instance['show_thumb'] = isset($new_instance['show_thumb']) ? (bool) $new_instance['show_thumb'] : false;
        return $instance;
    }

    /**
     * Outputs the settings form for the Recent Posts widget.
     *
     * @param array $instance Current settings.
     */
    public function form($instance)
    {
        $show_thumb = isset($instance['show_thumb']) ? (bool) $instance['show_thumb'] : true;
        parent::form($instance); ?>
        <p><input class="checkbox" type="checkbox"<?php checked($show_thumb); ?> id="<?php echo $this->get_field_id('show_thumb'); ?>" name="<?php echo $this->get_field_name('show_thumb'); ?>" />
            <label for="<?php echo $this->get_field_id('show_thumb'); ?>"><?php _e('Display post thumbnail?', 'basicbootstrap'); ?></label></p>
        <?php
    }
}
