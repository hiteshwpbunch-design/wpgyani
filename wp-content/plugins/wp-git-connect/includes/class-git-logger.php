<?php
/**
 * Git Logger Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Logger
 */
class Git_Logger {

	/**
	 * Log an action.
	 */
	public static function log( $action, $status, $message = '', $branch = '', $commit_hash = '' ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'git_connect_logs';

		// Do not log if table does not exist
		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			return false;
		}

		$user_id = get_current_user_id();

		$message = self::sanitize_message( $message );

		$result = $wpdb->insert(
			$table_name,
			array(
				'user_id'     => $user_id,
				'action'      => sanitize_text_field( $action ),
				'branch'      => sanitize_text_field( $branch ),
				'commit_hash' => sanitize_text_field( $commit_hash ),
				'status'      => sanitize_text_field( $status ),
				'message'     => wp_kses_post( $message ),
			),
			array( '%d', '%s', '%s', '%s', '%s', '%s' )
		);

		return $result;
	}

	/**
	 * Retrieve logs.
	 */
	public static function get_logs( $limit = 50, $offset = 0 ) {
		global $wpdb;
		$table_name = $wpdb->prefix . 'git_connect_logs';

		if ( $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
			return array();
		}

		$sql = $wpdb->prepare( "SELECT * FROM {$table_name} ORDER BY created_at DESC LIMIT %d OFFSET %d", $limit, $offset );
		return $wpdb->get_results( $sql, ARRAY_A );
	}

	/**
	 * Sanitize log message.
	 */
	private static function sanitize_message( $message ) {
		$settings = get_option( 'wp_git_connect_settings', array() );
		if ( ! empty( $settings['pat_token'] ) ) {
			$message = str_replace( $settings['pat_token'], '***TOKEN***', $message );
		}
		// Redact standard URL credentials
		$message = preg_replace( '/(https?:\/\/)([^:@]+):([^:@]+)(@.*)/', '$1$2:***$4', $message );

		return $message;
	}
}
