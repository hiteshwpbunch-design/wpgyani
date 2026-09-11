<?php
/**
 * Git Auth Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Auth
 */
class Git_Auth {

	/**
	 * Get the configured remote URL with embedded authentication if required.
	 *
	 * @return string|false
	 */
	public static function get_authenticated_remote_url() {
		$settings = get_option( 'wp_git_connect_settings', array() );
		$remote_url = isset( $settings['remote_url'] ) ? trim( $settings['remote_url'] ) : '';

		if ( empty( $remote_url ) ) {
			return false;
		}

		// If SSH, return as-is
		if ( strpos( $remote_url, 'git@' ) === 0 || strpos( $remote_url, 'ssh://' ) === 0 ) {
			return $remote_url;
		}

		$auth_method = isset( $settings['auth_method'] ) ? $settings['auth_method'] : 'none';

		if ( $auth_method === 'pat' ) {
			$username = isset( $settings['username'] ) ? trim( $settings['username'] ) : '';
			$token = isset( $settings['pat_token'] ) ? trim( $settings['pat_token'] ) : '';

			if ( ! empty( $username ) && ! empty( $token ) ) {
				// Inject credentials into HTTPS URL
				$parsed = parse_url( $remote_url );
				if ( isset( $parsed['host'] ) ) {
					// Use rawurlencode but avoid it for standard github tokens which don't need it.
					// A PAT should be alphanumeric but we encode just in case, removing trailing spaces.
					$auth_url = $parsed['scheme'] . '://' . rawurlencode( $username ) . ':' . rawurlencode( $token ) . '@' . $parsed['host'] . ( isset( $parsed['port'] ) ? ':' . $parsed['port'] : '' ) . $parsed['path'];
					return $auth_url;
				}
			}
		}

		return $remote_url;
	}

	/**
	 * Set up environment variables for git commands (like SSH keys).
	 *
	 * @return array Array of environment variables.
	 */
	public static function get_git_env() {
		$env = array();
		$settings = get_option( 'wp_git_connect_settings', array() );
		$auth_method = isset( $settings['auth_method'] ) ? $settings['auth_method'] : 'none';

		if ( $auth_method === 'ssh' && ! empty( $settings['ssh_key_path'] ) ) {
			$ssh_key_path = $settings['ssh_key_path'];
			$env['GIT_SSH_COMMAND'] = "ssh -i " . escapeshellarg( $ssh_key_path ) . " -o StrictHostKeyChecking=no";
		}

		return $env;
	}
}
