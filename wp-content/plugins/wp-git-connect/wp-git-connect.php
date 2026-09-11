<?php
/**
 * Plugin Name: WP Git Connect
 * Plugin URI: https://example.com/
 * Description: Connect WordPress to Git. Pull, push, and sync databases from the dashboard.
 * Version: 1.0.0
 * Author: WP Gyani
 * License: GPL-2.0+
 * Text Domain: wp-git-connect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'WP_GIT_CONNECT_VERSION', '1.0.0' );
define( 'WP_GIT_CONNECT_FILE', __FILE__ );
define( 'WP_GIT_CONNECT_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_GIT_CONNECT_URL', plugin_dir_url( __FILE__ ) );

require_once WP_GIT_CONNECT_PATH . 'includes/class-plugin.php';

function wp_git_connect_init() {
	if ( class_exists( 'WPGitConnect\Plugin' ) ) {
		$plugin = \WPGitConnect\Plugin::get_instance();
		$plugin->init();
	}
}
add_action( 'plugins_loaded', 'wp_git_connect_init' );

register_activation_hook( __FILE__, array( 'WPGitConnect\Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'WPGitConnect\Plugin', 'deactivate' ) );
