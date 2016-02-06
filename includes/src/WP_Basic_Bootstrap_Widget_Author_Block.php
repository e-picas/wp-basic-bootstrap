<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */


class WP_Basic_Bootstrap_Widget_Author_Block
    extends WP_Widget
{

    /**
     * Sets up a new Author Block widget instance.
     */
    public function __construct()
    {
        $widget_ops = array(
            'classname' => 'widget_author_block',
            'description' => __('Author block widget with name and description.', 'basicbootstrap')
        );
        parent::__construct('author-block', __('Author Block', 'basicbootstrap'), $widget_ops);
        $this->alt_option_name = 'widget_author_block';
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {
        if (empty($instance['author_id'])) {
            echo '';
            return;
        }

        if ($instance['author_id'] == 'current') {
            $args['is_current'] = true;
            if (is_singular()) {
                $id = get_the_author_meta('ID');
                if (!empty($id) && is_int($id)) {
                    $instance['author_id'] = $id;
                }
            } else {
                unset($instance['author_id']);
            }
        }

        if (isset($instance['author_id'])) {
            $author = get_userdata($instance['author_id']);
            if (!empty($author)) {

                $html_filtered = has_filter('widget_title', 'esc_html');
                if ($html_filtered){
                    remove_filter('widget_title', 'esc_html');
                }
                if (!empty($instance['title'])) {
                    $title = apply_filters(
                        'widget_title',
                        sprintf(
                            __('<a href="%1$s">%2$s</a>', 'basicbootstrap'),
                            get_author_posts_url($instance['author_id']),
                            $instance['title']
                        ),
                        $instance,
                        $this->id_base
                    );
                } else {
                    $title = apply_filters(
                        'widget_title',
                        sprintf(
                            /* translators: about <author name/link> */
                            __('About <a href="%1$s">%2$s</a>', 'basicbootstrap'),
                            get_author_posts_url($instance['author_id']),
                            !empty($instance['title']) ? $instance['title'] : $author->display_name
                        ),
                        $instance,
                        $this->id_base
                    );
                }
                if ($html_filtered) {
                    add_filter('widget_title', 'esc_html');
                }

                $args['title']  = $title;
                $args['author'] = $author;
                get_template_part_with_arguments('partials/widgets/author-block', '', $args);
            }
        }
    }

    /**
     * Outputs the options form on admin
     *
     * @param array $instance The widget options
     */
    public function form($instance)
    {
        $title      = !empty($instance['title'])      ? $instance['title'] : '';
        $author_id  = !empty($instance['author_id'])  ? $instance['author_id'] : null;
        $__         = '__';
        $esc_attr   = 'esc_attr';
        $selected   = 'selected';
        $authors_list = get_users(array(
            'orderby'           => 'ID',
        ));

        echo <<<CTT
<p>
    <label for="{$this->get_field_id('title')}">{$__('Title:')}</label>
    <input class="widefat" id="{$this->get_field_id('title')}" name="{$this->get_field_name('title')}" type="text" value="{$esc_attr($title)}">
</p>
<p>
    <select class="widefat" id="{$this->get_field_id('author_id')}" name="{$this->get_field_name('author_id')}" style="width:100%;">
        <option value="current">{$__('Current user')}</option>
CTT;
        foreach ($authors_list as $author) {
            echo <<<CTT
        <option {$selected($author_id, $author->ID)} value="{$author->ID}">{$author->display_name}</option>
CTT;
        }
        echo <<<CTT
    </select>
</p>
CTT;
    }

    /**
     * Processing widget options on save
     *
     * @param array $new_instance The new options
     * @param array $old_instance The previous options
     */
    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title']      = (!empty($new_instance['title']))      ? strip_tags($new_instance['title']) : '';
        $instance['author_id']  = (!empty($new_instance['author_id']))    ? $new_instance['author_id'] : null;
        return $instance;
    }
}
