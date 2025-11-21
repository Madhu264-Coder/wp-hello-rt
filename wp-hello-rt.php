<?php
/**
 * Plugin Name: Hello rtCamp
 * Description: A simple WordPress plugin that shows a greeting message and has a small settings page.
 * Version: 1.1
 * Author: Priyadarshini Madhubala Pradhan
 */

// Shortcode function
function hello_rtcamp_message() {
    $message = get_option('hello_rtcamp_text', "Hello rtCamp! I'm ready to build awesome products 🚀");
    return "<div style='padding:10px; background:#eaf7ff; border-left:4px solid #0277bd;'>".esc_html($message)."</div>";
}
add_shortcode('rtcamp-hello', 'hello_rtcamp_message');

// Add settings page
function hello_rtcamp_menu() {
    add_options_page('Hello rtCamp Settings', 'Hello rtCamp', 'manage_options', 'hello-rtcamp', 'hello_rtcamp_settings_page');
}
add_action('admin_menu', 'hello_rtcamp_menu');

function hello_rtcamp_settings_page() {
    if (!current_user_can('manage_options')) return;
    if (isset($_POST['hello_rtcamp_text'])) {
        update_option('hello_rtcamp_text', sanitize_text_field($_POST['hello_rtcamp_text']));
        echo '<div class="updated"><p>Settings saved.</p></div>';
    }
    $text = get_option('hello_rtcamp_text', "Hello rtCamp! I'm ready to build awesome products 🚀");
    ?>
    <div class="wrap">
        <h1>Hello rtCamp Settings</h1>
        <form method="post">
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="hello_rtcamp_text">Greeting Text</label></th>
                    <td>
                        <input name="hello_rtcamp_text" type="text" id="hello_rtcamp_text" value="<?php echo esc_attr($text); ?>" class="regular-text" />
                        <p class="description">Text displayed by the [rtcamp-hello] shortcode.</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
