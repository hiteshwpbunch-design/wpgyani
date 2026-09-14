<?php
/**
 * Git REST API Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Rest_Api
 */
class Git_Rest_Api {

	/**
	 * Namespace for REST API.
	 */
	const NAMESPACE = 'wp-git-connect/v1';

	/**
	 * Initialize REST hooks.
	 */
	public function init() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register routes.
	 */
	public function register_routes() {
		register_rest_route( self::NAMESPACE, '/status', array(
			'methods'             => \WP_REST_Server::READABLE,
			'callback'            => array( $this, 'get_status' ),
			'permission_callback' => array( 'WPGitConnect\Git_Security', 'verify_request' ),
		) );

		register_rest_route( self::NAMESPACE, '/pull', array(
			'methods'             => \WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'pull' ),
			'permission_callback' => array( 'WPGitConnect\Git_Security', 'verify_request' ),
		) );

		register_rest_route( self::NAMESPACE, '/push', array(
			'methods'             => \WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'push' ),
			'permission_callback' => array( 'WPGitConnect\Git_Security', 'verify_request' ),
		) );

		register_rest_route( self::NAMESPACE, '/diff', array(
			'methods'             => \WP_REST_Server::READABLE,
			'callback'            => array( $this, 'get_diff' ),
			'permission_callback' => array( 'WPGitConnect\Git_Security', 'verify_request' ),
		) );
		
		register_rest_route( self::NAMESPACE, '/db-export', array(
			'methods'             => \WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'db_export' ),
			'permission_callback' => array( 'WPGitConnect\Git_Security', 'verify_request' ),
		) );

		register_rest_route( self::NAMESPACE, '/db-import', array(
			'methods'             => \WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'db_import' ),
			'permission_callback' => array( 'WPGitConnect\Git_Security', 'verify_request' ),
		) );
	}

	/**
	 * Get repository status.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function get_status( $request ) {
		$status = Git_Repository::get_status();
		if ( $status['status'] ) {
			return rest_ensure_response( $status['data'] );
		}
		return new \WP_Error( 'git_error', $status['message'], array( 'status' => 500 ) );
	}

	/**
	 * Pull from remote.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function pull( $request ) {
		$settings = get_option( 'wp_git_connect_settings', array() );
		$branch = isset( $settings['default_branch'] ) ? $settings['default_branch'] : 'main';
		
		$result = Git_Manager::pull( $branch );
		if ( $result['status'] ) {
			return rest_ensure_response( array( 'success' => true, 'message' => $result['message'] ) );
		}
		return new \WP_Error( 'pull_failed', $result['message'], array( 'status' => 500 ) );
	}

	/**
	 * Push to remote.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function push( $request ) {
		$params = $request->get_json_params();
		$message = isset( $params['message'] ) ? sanitize_text_field( $params['message'] ) : '';
		$files = isset( $params['files'] ) ? (array) $params['files'] : array();

		$safe_files = array_map( 'sanitize_text_field', $files );

		$settings = get_option( 'wp_git_connect_settings', array() );
		$branch = isset( $settings['default_branch'] ) ? $settings['default_branch'] : 'main';

		$result = Git_Manager::commit_and_push( $safe_files, $message, $branch );
		
		if ( $result['status'] ) {
			return rest_ensure_response( array( 'success' => true, 'message' => $result['message'] ) );
		}
		return new \WP_Error( 'push_failed', $result['message'], array( 'status' => 500 ) );
	}

	/**
	 * Get diff of a file.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function get_diff( $request ) {
		$file = sanitize_text_field( $request->get_param( 'file' ) );
		if ( empty( $file ) ) {
			return new \WP_Error( 'invalid_params', 'File path is required.', array( 'status' => 400 ) );
		}

		if ( strpos( $file, '..' ) !== false ) {
			return new \WP_Error( 'invalid_params', 'Invalid file path.', array( 'status' => 400 ) );
		}

		$result = Git_Manager::get_diff( $file );
		if ( $result['status'] ) {
			return rest_ensure_response( array( 'success' => true, 'diff' => $result['diff'] ) );
		}
		return new \WP_Error( 'diff_failed', $result['message'], array( 'status' => 500 ) );
	}

	/**
	 * Export Database.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function db_export( $request ) {
		$result = Git_Database::export();
		if ( $result['status'] ) {
			return rest_ensure_response( array( 'success' => true, 'message' => $result['message'] ) );
		}
		return new \WP_Error( 'db_export_failed', $result['message'], array( 'status' => 500 ) );
	}

	/**
	 * Import Database.
	 *
	 * @param \WP_REST_Request $request
	 * @return \WP_REST_Response
	 */
	public function db_import( $request ) {
		$result = Git_Database::import();
		if ( $result['status'] ) {
			return rest_ensure_response( array( 'success' => true, 'message' => $result['message'] ) );
		}
		return new \WP_Error( 'db_import_failed', $result['message'], array( 'status' => 500 ) );
	}
}
