<?php
namespace WPGitConnect\Admin;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Admin {
	public function init() {
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'admin_init', array( $this, 'handle_form_submissions' ) );
	}
	public function register_menu() {
		add_menu_page( __( 'Git Connect', 'wp-git-connect' ), __( 'Git Connect', 'wp-git-connect' ), 'manage_options', 'wp-git-connect', array( $this, 'render_dashboard' ), 'dashicons-git', 100 );
		add_submenu_page( 'wp-git-connect', __( 'Dashboard', 'wp-git-connect' ), __( 'Dashboard', 'wp-git-connect' ), 'manage_options', 'wp-git-connect', array( $this, 'render_dashboard' ) );
		add_submenu_page( 'wp-git-connect', __( 'Status & Sync', 'wp-git-connect' ), __( 'Status', 'wp-git-connect' ), 'manage_options', 'wp-git-connect-status', array( $this, 'render_status' ) );
		add_submenu_page( 'wp-git-connect', __( 'Commits', 'wp-git-connect' ), __( 'Commits', 'wp-git-connect' ), 'manage_options', 'wp-git-connect-commits', array( $this, 'render_commits' ) );
		add_submenu_page( 'wp-git-connect', __( 'Branches', 'wp-git-connect' ), __( 'Branches', 'wp-git-connect' ), 'manage_options', 'wp-git-connect-branches', array( $this, 'render_branches' ) );
		add_submenu_page( 'wp-git-connect', __( 'Activity Logs', 'wp-git-connect' ), __( 'Activity Logs', 'wp-git-connect' ), 'manage_options', 'wp-git-connect-logs', array( $this, 'render_logs' ) );
		add_submenu_page( 'wp-git-connect', __( 'Settings', 'wp-git-connect' ), __( 'Settings', 'wp-git-connect' ), 'manage_options', 'wp-git-connect-settings', array( $this, 'render_settings' ) );
	}
	public function enqueue_scripts( $hook ) {
		if ( strpos( $hook, 'wp-git-connect' ) === false ) { return; }
		wp_enqueue_style( 'wp-git-connect-admin', WP_GIT_CONNECT_URL . 'admin/css/admin.css', array(), WP_GIT_CONNECT_VERSION );
		wp_enqueue_script( 'wp-git-connect-admin', WP_GIT_CONNECT_URL . 'admin/js/admin.js', array( 'jquery', 'wp-api' ), WP_GIT_CONNECT_VERSION, true );
		wp_localize_script( 'wp-git-connect-admin', 'wpGitConnect', array(
			'apiUrl' => rest_url( \WPGitConnect\Git_Rest_Api::NAMESPACE ),
			'nonce'  => wp_create_nonce( 'wp_rest' ),
		) );
	}
	public function handle_form_submissions() {
		if ( isset( $_POST['wp_git_connect_save_settings'] ) && isset( $_POST['wp_git_connect_nonce'] ) ) {
			if ( wp_verify_nonce( $_POST['wp_git_connect_nonce'], 'wp_git_connect_settings_action' ) && current_user_can( 'manage_options' ) ) {
				$settings = get_option( 'wp_git_connect_settings', array() );
				$settings['repo_path'] = wp_normalize_path( sanitize_text_field( wp_unslash( $_POST['repo_path'] ) ) );
				$settings['remote_url'] = sanitize_text_field( wp_unslash( $_POST['remote_url'] ) );
				$settings['default_branch'] = sanitize_text_field( wp_unslash( $_POST['default_branch'] ) );
				$settings['auth_method'] = sanitize_text_field( wp_unslash( $_POST['auth_method'] ) );
				$settings['username'] = sanitize_text_field( wp_unslash( $_POST['username'] ) );
				if ( ! empty( $_POST['pat_token'] ) ) {
					$settings['pat_token'] = sanitize_text_field( wp_unslash( $_POST['pat_token'] ) );
				}
				$settings['backup_before_pull'] = isset( $_POST['backup_before_pull'] ) ? 'yes' : 'no';
				$settings['cron_auto_fetch'] = isset( $_POST['cron_auto_fetch'] ) ? 'yes' : 'no';
				if ( isset( $_POST['mysqldump_path'] ) ) {
					$settings['mysqldump_path'] = sanitize_text_field( wp_unslash( $_POST['mysqldump_path'] ) );
				}
				if ( isset( $_POST['mysql_path'] ) ) {
					$settings['mysql_path'] = sanitize_text_field( wp_unslash( $_POST['mysql_path'] ) );
				}
				update_option( 'wp_git_connect_settings', $settings );
				if ( ! empty( $settings['remote_url'] ) ) {
					\WPGitConnect\Git_Repository::set_remote( $settings['remote_url'] );
				}
				add_settings_error( 'wp_git_connect_messages', 'settings_saved', __( 'Settings Saved', 'wp-git-connect' ), 'updated' );
			}
		}
	}
	public function render_dashboard() { require_once WP_GIT_CONNECT_PATH . 'admin/views/dashboard.php'; }
	public function render_status() { require_once WP_GIT_CONNECT_PATH . 'admin/views/status.php'; }
	public function render_commits() { require_once WP_GIT_CONNECT_PATH . 'admin/views/commits.php'; }
	public function render_branches() { require_once WP_GIT_CONNECT_PATH . 'admin/views/branches.php'; }
	public function render_logs() { require_once WP_GIT_CONNECT_PATH . 'admin/views/logs.php'; }
	public function render_settings() { require_once WP_GIT_CONNECT_PATH . 'admin/views/settings.php'; }
}