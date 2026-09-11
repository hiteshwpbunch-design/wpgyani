<?php
/**
 * Git Database Sync Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Database
 */
class Git_Database {

	/**
	 * Get the path to the database dump file.
	 *
	 * @return string
	 */
	public static function get_dump_path() {
		$settings = get_option( 'wp_git_connect_settings', array() );
		$repo_path = isset( $settings['repo_path'] ) ? $settings['repo_path'] : ABSPATH;
		return wp_normalize_path( $repo_path . '/database.sql' );
	}

	/**
	 * Export the current database to a .sql file.
	 *
	 * @return array
	 */
	public static function export() {
		if ( ! Git_Security::can_execute() ) {
			return array( 'status' => false, 'message' => 'Shell execution is disabled. Cannot export database.' );
		}

		$dump_path = self::get_dump_path();

		$host = defined( 'DB_HOST' ) ? DB_HOST : 'localhost';
		$user = defined( 'DB_USER' ) ? DB_USER : '';
		$pass = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : '';
		$name = defined( 'DB_NAME' ) ? DB_NAME : '';

		// Separate host and port if needed (e.g. localhost:3306)
		$port = '';
		if ( strpos( $host, ':' ) !== false ) {
			list( $host, $port ) = explode( ':', $host );
		}

		$settings = get_option( 'wp_git_connect_settings', array() );
		$cmd_path = isset( $settings['mysqldump_path'] ) && ! empty( $settings['mysqldump_path'] ) ? $settings['mysqldump_path'] : 'mysqldump';

		$cmd_raw = escapeshellarg( $cmd_path ) . " --host=" . escapeshellarg( $host ) . 
			( ! empty( $port ) ? " --port=" . escapeshellarg( $port ) : "" ) . 
			" --user=" . escapeshellarg( $user ) . 
			( ! empty( $pass ) ? " --password=" . escapeshellarg( $pass ) : "" ) . 
			" " . escapeshellarg( $name );

		$descriptorspec = array(
			0 => array( "pipe", "r" ),
			1 => array( "file", $dump_path, "w" ),
			2 => array( "pipe", "w" )
		);

		$process = proc_open( $cmd_raw, $descriptorspec, $pipes );

		if ( is_resource( $process ) ) {
			$stderr = stream_get_contents( $pipes[2] );
			fclose( $pipes[2] );
			$return_value = proc_close( $process );

			if ( $return_value === 0 ) {
				Git_Logger::log( 'DB_EXPORT', 'Success', 'Database exported to database.sql.' );
				return array( 'status' => true, 'message' => 'Database exported successfully.' );
			} else {
				Git_Logger::log( 'DB_EXPORT', 'Failed', 'mysqldump error: ' . $stderr );
				return array( 'status' => false, 'message' => 'Database export failed. Please ensure mysqldump is in your system PATH. Error: ' . $stderr );
			}
		}

		return array( 'status' => false, 'message' => 'Failed to execute mysqldump process.' );
	}

	/**
	 * Import the database from the .sql file.
	 *
	 * @return array
	 */
	public static function import() {
		if ( ! Git_Security::can_execute() ) {
			return array( 'status' => false, 'message' => 'Shell execution is disabled. Cannot import database.' );
		}

		$dump_path = self::get_dump_path();

		if ( ! file_exists( $dump_path ) ) {
			return array( 'status' => false, 'message' => 'database.sql file not found.' );
		}

		$host = defined( 'DB_HOST' ) ? DB_HOST : 'localhost';
		$user = defined( 'DB_USER' ) ? DB_USER : '';
		$pass = defined( 'DB_PASSWORD' ) ? DB_PASSWORD : '';
		$name = defined( 'DB_NAME' ) ? DB_NAME : '';

		$port = '';
		if ( strpos( $host, ':' ) !== false ) {
			list( $host, $port ) = explode( ':', $host );
		}

		$settings = get_option( 'wp_git_connect_settings', array() );
		$cmd_path = isset( $settings['mysql_path'] ) && ! empty( $settings['mysql_path'] ) ? $settings['mysql_path'] : 'mysql';

		$cmd_raw = escapeshellarg( $cmd_path ) . " --host=" . escapeshellarg( $host ) . 
			( ! empty( $port ) ? " --port=" . escapeshellarg( $port ) : "" ) . 
			" --user=" . escapeshellarg( $user ) . 
			( ! empty( $pass ) ? " --password=" . escapeshellarg( $pass ) : "" ) . 
			" " . escapeshellarg( $name );

		$descriptorspec = array(
			0 => array( "file", $dump_path, "r" ),
			1 => array( "pipe", "w" ),
			2 => array( "pipe", "w" )
		);

		$process = proc_open( $cmd_raw, $descriptorspec, $pipes );

		if ( is_resource( $process ) ) {
			$stdout = stream_get_contents( $pipes[1] );
			fclose( $pipes[1] );
			$stderr = stream_get_contents( $pipes[2] );
			fclose( $pipes[2] );
			$return_value = proc_close( $process );

			if ( $return_value === 0 ) {
				Git_Logger::log( 'DB_IMPORT', 'Success', 'Database imported from database.sql.' );
				return array( 'status' => true, 'message' => 'Database imported successfully.' );
			} else {
				Git_Logger::log( 'DB_IMPORT', 'Failed', 'mysql error: ' . $stderr );
				return array( 'status' => false, 'message' => 'Database import failed. Please ensure mysql CLI is in your system PATH. Error: ' . $stderr );
			}
		}

		return array( 'status' => false, 'message' => 'Failed to execute mysql process.' );
	}
}
