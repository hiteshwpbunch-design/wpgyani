<?php
/**
 * Git Cron Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Cron
 */
class Git_Cron {

	/**
	 * Init Cron hooks.
	 */
	public function init() {
		add_action( 'wp_git_connect_cron_hook', array( $this, 'run_background_sync' ) );

		$settings = get_option( 'wp_git_connect_settings', array() );
		$is_enabled = isset( $settings['cron_auto_fetch'] ) ? $settings['cron_auto_fetch'] : 'no';

		if ( $is_enabled === 'yes' && ! wp_next_scheduled( 'wp_git_connect_cron_hook' ) ) {
			wp_schedule_event( time(), 'hourly', 'wp_git_connect_cron_hook' );
		} elseif ( $is_enabled !== 'yes' && wp_next_scheduled( 'wp_git_connect_cron_hook' ) ) {
			wp_clear_scheduled_hook( 'wp_git_connect_cron_hook' );
		}
	}

	/**
	 * Execute background fetch.
	 */
	public function run_background_sync() {
		Git_Manager::fetch();
	}
}
