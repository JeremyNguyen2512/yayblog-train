<?php
/**
 * Plugin Name:     Train Yay Blog
 * Plugin URI:      https://yaycommerce.com/
 * Description:     Starter plugin. Training basic WordPress plugin development.
 * Author:          Yay Commerce
 * Author URI:      https://yaycommerce.com/
 * Text Domain:     yayblog
 * Domain Path:     /languages
 * Version:         1.0.0.3
 *
 * @package Yayblog
 */

if (!defined('ABSPATH')) {
    die('We\'re sorry, but you can not directly access this file.');
}



define( 'YAY_BLOG_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'YAY_BLOG_PLUGIN_URL', plugin_dir_url( __FILE__ ) );


/**
 * Add plugin style && script
 */
add_action('admin_enqueue_scripts', 'yayblog_admin_enqueue_scripts');

function yayblog_admin_enqueue_scripts(){
    wp_enqueue_style( 'yayblog-style', YAY_BLOG_PLUGIN_URL . 'assets/post.css' );
}

if ( ! wp_installing() ) {
    add_action(
        'plugins_loaded',
        function () {
            include YAY_BLOG_PLUGIN_PATH . 'includes/admin/settings.php';
            include YAY_BLOG_PLUGIN_PATH . 'includes/admin/edit-star.php';
            include YAY_BLOG_PLUGIN_PATH . 'includes/frontend/view-counter.php';
            include YAY_BLOG_PLUGIN_PATH . 'includes/frontend/post.php';
        }
    );
}

function yayblog_title_template_style(){ ?>
    <link rel="stylesheet" href="<?php echo YAY_BLOG_PLUGIN_URL.'assets/title-template.css'; ?>">
<?php }
add_action('wp_head','yayblog_title_template_style');
