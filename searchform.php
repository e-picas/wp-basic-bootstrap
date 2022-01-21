<?php
/**
 * The template for displaying the Search Form
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
 <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url(home_url('/')); ?>">
	<div class="form-group">
        <div class="input-group">
            <label class="sr-only" for="s"><?php _x('Search for:', 'label', 'basicbootstrap'); ?></label>
            <div class="right-inner-addon">
                <i class="sr-only fa fa-search"></i>
                <input type="search" class="form-control" value="<?php
                    echo get_search_query();
                ?>" placeholder="<?php
                    esc_attr_e('Search', 'basicbootstrap');
                ?>" title="<?php
                    esc_attr_e('Type your search and press enter', 'basicbootstrap');
                ?>" name="s" id="s" />
            </div>
          <span class="input-group-append">
            <input class="input-group-text btn btn-secondary" type="submit" id="searchsubmit" value="<?php
                echo esc_attr_x('Search', 'submit button', 'basicbootstrap');
            ?>" title="<?php
                esc_attr_e('Make your search', 'basicbootstrap');
            ?>" />
          </span>
        </div>
    </div>
</form>
