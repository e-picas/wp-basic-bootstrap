<?php
/**
 * Replacement for the recent comments widget
 *
 * This version adds a 'show date' option.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */

class WP_Basic_Bootstrap_Widget_Archives extends WP_Widget_Archives
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
        if (! isset($args['widget_id'])) {
            $args['widget_id'] = $this->id;
        }

        $show_count  = ! empty( $instance['count'] ) ? '1' : '0';
        $is_dropdown = ! empty( $instance['dropdown'] ) ? '1' : '0';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Archives' ) : $instance['title'], $instance, $this->id_base );

        $args['title']          = $title;
        $args['show_count']     = $show_count;
        $args['is_dropdown']    = $is_dropdown;

        if ($is_dropdown) {

            /**
             * Filter the arguments for the Archives widget drop-down.
             *
             * @since 2.8.0
             *
             * @see wp_get_archives()
             *
             * @param array $args An array of Archives widget drop-down arguments.
             */
            $dropdown_args = apply_filters( 'widget_archives_dropdown_args', array(
                'type'            => 'monthly',
                'format'          => 'option',
                'show_post_count' => $show_count
            ) );

            switch ( $dropdown_args['type'] ) {
                case 'yearly':
                    $label = __( 'Select Year' );
                    break;
                case 'monthly':
                    $label = __( 'Select Month' );
                    break;
                case 'daily':
                    $label = __( 'Select Day' );
                    break;
                case 'weekly':
                    $label = __( 'Select Week' );
                    break;
                default:
                    $label = __( 'Select Post' );
                    break;
            }

            $args['dropdown_id']    = "{$this->id_base}-dropdown-{$this->number}";
            $args['dropdown_args']  = $dropdown_args;
            $args['label']          = $label;
        } else {

            /**
             * Filter the arguments for the Archives widget.
             *
             * @since WP 2.8.0
             * @see wp_get_archives()
             * @param array $args An array of Archives option arguments.
             */
            $archives_args = apply_filters( 'widget_archives_args', array(
                'type'            => 'monthly',
                'show_post_count' => $show_count
            ) );
            $args['archives_args']  = $archives_args;
        }

        get_template_part_hierarchical_fetch('partials/widgets/archives', '', $args);
    }
}
