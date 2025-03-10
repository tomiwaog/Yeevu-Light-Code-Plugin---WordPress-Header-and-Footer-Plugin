<?php
/*
Plugin Name: Yeevu Light Code
Plugin URI: https://yeevu.com/
Description: A very light plugin that allows Simple addition of codes into WordPress header and footer without bloatware. Privacy and Speed is priority, no data is collected.
Version: 1.0
Author: Tomiwa Ogunbamowo
Author URI: https://yeevu.com/plugins/
Requires at least: 6.7
Requires PHP: 7.
*/

// Create custom plugin settings menu
add_action('admin_menu', 'create_tracking_code_plugin_menu');

function create_tracking_code_plugin_menu() {
    add_menu_page('Tracking Code Settings', 'Light Code', 'administrator', __FILE__, 'tracking_code_settings_page' , plugins_url('/images/icon.png', __FILE__));
    add_action('admin_init', 'register_trackingcode_plugin_settings');
}

function register_trackingcode_plugin_settings() {
    //register our settings
    register_setting('tracking-code-settings-group', 'header_code');
    register_setting('tracking-code-settings-group', 'footer_code');
}

function tracking_code_settings_page() {
?>
<div class="wrap">
<h1>Tracking Code</h1>

<form method="post" action="options.php">
    <?php settings_fields('tracking-code-settings-group'); ?>
    <?php do_settings_sections('tracking-code-settings-group'); ?>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">Header Code</th>
        <td><textarea name="header_code" rows="10" cols="50"><?php echo esc_attr(get_option('header_code')); ?></textarea></td>
        </tr>
        <tr valign="top">
        <th scope="row">Footer Code</th>
        <td><textarea name="footer_code" rows="10" cols="50"><?php echo esc_attr(get_option('footer_code')); ?></textarea></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }

// Add tracking code to the header
function add_tracking_code_header() {
    echo get_option('header_code');
}
add_action('wp_head', 'add_tracking_code_header');

// Add tracking code to the footer
function add_tracking_code_footer() {
    echo get_option('footer_code');
}
add_action('wp_footer', 'add_tracking_code_footer');

?>
