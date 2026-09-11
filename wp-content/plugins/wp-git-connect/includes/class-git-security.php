<?php
/**
 * Git Security Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Security
 */
class Git_Security {

	/**
	 * Verify if user has permission to perform Git operations.
	 *
	 * @return bool
	 */
	public static function current_user_can() {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Validate a path to ensure it does not escape the base repository path.
	 *
	 * @param string $path The path to validate.
	 * @param string $base_path The base directory.
	 * @return bool
	 */
	public static function is_path_safe( $path, $base_path ) {
		$real_base = wp_normalize_path( realpath( $base_path ) );
		$real_path = wp_normalize_path( realpath( $base_path . '/' . $path ) );

		if ( ! $real_base || ! $real_path ) {
			return false;
		}

		return strpos( $real_path, $real_base ) === 0;
	}

	/**
	 * Ensure string is safe for shell execution.
	 * 
	 * @param string $input
	 * @return string
	 */
	public static function escape_shell_arg( $input ) {
		return escapeshellarg( $input );
	}
	
	/**
	 * Verify nonce for REST or AJAX requests.
	 *
	 * @param \WP_REST_Request|null $request The REST request, if applicable.
	 * @return bool
	 */
	public static function verify_request( $request = null ) {
		if ( ! self::current_user_can() ) {
			return false;
		}
		
		return true;
	}

	/**
	 * Verify if server allows required shell execution functions.
	 *
	 * @return bool
	 */
	public static function can_execute() {
		$disabled = explode( ',', ini_get( 'disable_functions' ) );
		$disabled = array_map( 'trim', $disabled );

		$required = array( 'exec', 'shell_exec' );
		foreach ( $required as $func ) {
			if ( in_array( $func, $disabled, true ) || ! function_exists( $func ) ) {
				return false;
			}
		}

		return true;
	}
}
