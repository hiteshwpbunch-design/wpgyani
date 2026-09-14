<?php
/**
 * Main Plugin Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Plugin
 */
class Plugin {

	/**
	 * Instance of this class.
	 *
	 * @var Plugin
	 */
	private static $instance = null;

	/**
	 * Get the singleton instance.
	 *
	 * @return Plugin
	 */
	public static function get_instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Constructor.
	 */
	private function __construct() {
		$this->includes();
	}

	/**
	 * Include required files.
	 */
	private function includes() {
		// Security and Utils
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-security.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-logger.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-auth.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-command.php';
		
		// Core Git Ops
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-repository.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-backup.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-manager.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-database.php';
		
		// APIs and Background
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-rest-api.php';
		require_once WP_GIT_CONNECT_PATH . 'includes/class-git-cron.php';

		// Admin UI
		if ( is_admin() ) {
			require_once WP_GIT_CONNECT_PATH . 'admin/class-admin.php';
		}
	}

	/**
	 * Initialize the plugin.
	 */
	public function init() {
		// Initialize the REST API
		$rest_api = new Git_Rest_Api();
		$rest_api->init();

		// Initialize cron jobs
		$cron = new Git_Cron();
		$cron->init();

		// Initialize Admin Interface
		if ( is_admin() ) {
			$admin = new \WPGitConnect\Admin\Admin();
			$admin->init();
		}
	}

	/**
	 * Activation hook.
	 */
	public static function activate() {
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		
		global $wpdb;
		$table_name = $wpdb->prefix . 'git_connect_logs';
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE $table_name (
			id bigint(20) NOT NULL AUTO_INCREMENT,
			user_id bigint(20) NOT NULL,
			action varchar(50) NOT NULL,
			branch varchar(100) DEFAULT '' NOT NULL,
			commit_hash varchar(40) DEFAULT '' NOT NULL,
			status varchar(20) NOT NULL,
			message text NOT NULL,
			created_at datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
			PRIMARY KEY  (id)
		) $charset_collate;";

		dbDelta( $sql );

		// Set default options if they don't exist
		if ( false === get_option( 'wp_git_connect_settings' ) ) {
			update_option( 'wp_git_connect_settings', array(
				'repo_path' => ABSPATH,
				'default_branch' => 'main',
			) );
		}
	}

	/**
	 * Deactivation hook.
	 */
	public static function deactivate() {
		wp_clear_scheduled_hook( 'wp_git_connect_cron_hook' );
	}
}
