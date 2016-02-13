<?php
/**
 * @package WP_Basic_Bootstrap
 * @since WP_Basic_Bootstrap 1.0
 */
?>
<form action="<?php echo esc_url(site_url('wp-login.php?action=postpass', 'login_post')); ?>" class="post-password-form form-inline" method="post">
    <div class="form-group">
        <p id="passwordHelpBlock" class="help-block"><?php _e('This content is password protected. To view it please enter your password below:'); ?></p>
        <label for="<?php echo $label; ?>"><?php _e('Password:'); ?></label>
        <input class="form-control" name="post_password" id="<?php echo $label; ?>" type="password" size="20" aria-describedby="passwordHelpBlock" />
    </div>
    <button type="submit" class="btn btn-default" name="Submit"><?php _e('Submit'); ?></button>
</form>
