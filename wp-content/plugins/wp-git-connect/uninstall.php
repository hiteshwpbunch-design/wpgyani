<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete options.
$options = array(
	'wp_git_connect_settings',
	'wp_git_connect_remote',
	'wp_git_connect_branch'
);

foreach ( $options as $option ) {
	delete_option( $option );
}

// Check if user wants to delete custom database tables (if configured).
// For safety, we do NOT automatically drop tables unless explicitly configured.
$settings = get_option( 'wp_git_connect_settings', array() );
if ( isset( $settings['cleanup_on_uninstall'] ) && $settings['cleanup_on_uninstall'] === 'yes' ) {
	global $wpdb;
	$table_name = $wpdb->prefix . 'git_connect_logs';
	$wpdb->query( "DROP TABLE IF EXISTS {$table_name}" );
}
