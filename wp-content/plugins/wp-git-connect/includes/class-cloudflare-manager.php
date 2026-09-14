<?php
/**
 * Cloudflare Manager Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Cloudflare_Manager
 */
class Cloudflare_Manager {

	/**
	 * Initialize.
	 */
	public function init() {
		add_action( 'rest_api_init', array( $this, 'register_routes' ) );
	}

	/**
	 * Register REST routes.
	 */
	public function register_routes() {
		register_rest_route( Git_Rest_Api::NAMESPACE, '/cloudflare/generate-config', array(
			'methods'             => \WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'generate_config' ),
			'permission_callback' => array( $this, 'check_permission' ),
		) );

		register_rest_route( Git_Rest_Api::NAMESPACE, '/cloudflare/deploy', array(
			'methods'             => \WP_REST_Server::CREATABLE,
			'callback'            => array( $this, 'deploy' ),
			'permission_callback' => array( $this, 'check_permission' ),
		) );
	}

	/**
	 * Permission callback.
	 */
	public function check_permission() {
		return current_user_can( 'manage_options' );
	}

	/**
	 * Generate wrangler.jsonc
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return \WP_REST_Response
	 */
	public function generate_config( $request ) {
		$cf_settings = get_option( 'wp_git_connect_cloudflare', array() );
		$project_name = isset( $cf_settings['project_name'] ) ? $cf_settings['project_name'] : 'wp-git-connect-deploy';

		$git_settings = get_option( 'wp_git_connect_settings', array() );
		$repo_path = isset( $git_settings['repo_path'] ) ? $git_settings['repo_path'] : ABSPATH;

		$wrangler_file = trailingslashit( $repo_path ) . 'wrangler.jsonc';

		$config = '{
  "name": "' . esc_js( $project_name ) . '",
  "compatibility_date": "' . date( 'Y-m-d' ) . '",
  "assets": {
    "directory": "./"
  }
}';

		if ( file_put_contents( $wrangler_file, $config ) !== false ) {
			return rest_ensure_response( array(
				'success' => true,
				'message' => 'Successfully generated wrangler.jsonc at ' . $wrangler_file,
			) );
		}

		return new \WP_Error( 'write_error', 'Failed to write wrangler.jsonc', array( 'status' => 500 ) );
	}

	/**
	 * Deploy to Cloudflare.
	 *
	 * @param \WP_REST_Request $request Request object.
	 * @return \WP_REST_Response
	 */
	public function deploy( $request ) {
		$cf_settings = get_option( 'wp_git_connect_cloudflare', array() );
		$account_id = isset( $cf_settings['account_id'] ) ? $cf_settings['account_id'] : '';
		$api_token = isset( $cf_settings['api_token'] ) ? $cf_settings['api_token'] : '';

		if ( empty( $account_id ) || empty( $api_token ) ) {
			return new \WP_Error( 'missing_credentials', 'Cloudflare Account ID or API Token is missing.', array( 'status' => 400 ) );
		}

		$git_settings = get_option( 'wp_git_connect_settings', array() );
		$repo_path = isset( $git_settings['repo_path'] ) ? $git_settings['repo_path'] : ABSPATH;

		$cmd = 'npx wrangler versions upload';
		
		// Set environment variables for the command
		putenv( 'CLOUDFLARE_ACCOUNT_ID=' . $account_id );
		putenv( 'CLOUDFLARE_API_TOKEN=' . $api_token );

		$output = array();
		$return_var = 0;
		$current_dir = getcwd();
		chdir( $repo_path );
		
		// Execute command
		exec( $cmd . ' 2>&1', $output, $return_var );
		
		chdir( $current_dir );
		
		// Clear env vars
		putenv( 'CLOUDFLARE_ACCOUNT_ID' );
		putenv( 'CLOUDFLARE_API_TOKEN' );

		if ( $return_var !== 0 ) {
			return new \WP_Error( 'deploy_error', 'Deployment failed.', array( 'status' => 500, 'output' => implode( "\n", $output ) ) );
		}

		return rest_ensure_response( array(
			'success' => true,
			'message' => 'Deployment successful!',
			'output'  => implode( "\n", $output ),
		) );
	}
}
