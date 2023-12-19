<?php
/**
 * This class is an overwrite of the `WP_Fatal_Error_Handler` internal wordpress class
 * to use a template file in the theme for 500 errors.
 *
 * To let it work correctly, you **MUST** copy this file to `wp-content/fatal-error-handler.php`
 *
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 2.0
 */

class BasicBootstrap_Fatal_Error_Handler extends WP_Fatal_Error_Handler
{
    protected function display_error_template($error, $handled)
    {
        try {
            send_error(500, false, true);
        } catch (\Throwable $e) {
            // Otherwise, display the default error template.
            parent::display_error_template($error, $handled);
        }
    }
}

return new BasicBootstrap_Fatal_Error_Handler();
