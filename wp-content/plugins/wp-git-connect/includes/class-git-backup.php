<?php
/**
 * Git Backup Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Backup
 */
class Git_Backup {

	/**
	 * Backup modified files before pull.
	 */
	public static function backup_modified_files() {
		$status = Git_Repository::get_status();
		if ( ! $status['status'] ) {
			return array( 'status' => false, 'message' => 'Not a repository.' );
		}

		$changes = $status['data']['local_changes'];
		$files_to_backup = array_merge( $changes['modified'], $changes['deleted'] );

		if ( empty( $files_to_backup ) ) {
			return array( 'status' => true, 'message' => 'No files to backup.' );
		}

		$settings = get_option( 'wp_git_connect_settings', array() );
		$repo_path = isset( $settings['repo_path'] ) ? $settings['repo_path'] : ABSPATH;
		$backup_dir = WP_CONTENT_DIR . '/wp-git-connect-backups';

		if ( ! is_dir( $backup_dir ) ) {
			mkdir( $backup_dir, 0755, true );
		}

		$zip_file = $backup_dir . '/backup-' . date( 'Y-m-d-H-i-s' ) . '.zip';
		
		if ( class_exists( 'ZipArchive' ) ) {
			$zip = new \ZipArchive();
			if ( $zip->open( $zip_file, \ZipArchive::CREATE ) === true ) {
				foreach ( $files_to_backup as $file ) {
					$file_path = $repo_path . '/' . $file;
					if ( file_exists( $file_path ) ) {
						$zip->addFile( $file_path, $file );
					}
				}
				$zip->close();
				Git_Logger::log( 'BACKUP', 'Success', "Created pre-pull backup: " . basename( $zip_file ) );
				return array( 'status' => true, 'message' => 'Backup created.' );
			}
		}

		return array( 'status' => false, 'message' => 'ZipArchive not available or failed.' );
	}
}
