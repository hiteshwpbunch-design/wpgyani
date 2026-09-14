<?php
namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Git_Manager {
	public static function fetch() {
		$remote_url = Git_Auth::get_authenticated_remote_url();
		if ( ! $remote_url ) { return array( 'status' => false, 'message' => 'Remote URL not configured.' ); }
		Git_Repository::set_remote( $remote_url );
		$result = Git_Command::execute( 'fetch', array( 'origin' ) );
		if ( $result['status'] ) {
			Git_Logger::log( 'FETCH', 'Success', 'Fetched from origin.' );
			return array( 'status' => true, 'message' => 'Fetched successfully.' );
		}
		Git_Logger::log( 'FETCH', 'Failed', $result['error'] );
		return array( 'status' => false, 'message' => 'Fetch failed: ' . $result['error'] );
	}
	public static function pull( $branch = 'main' ) {
		$settings = get_option( 'wp_git_connect_settings', array() );
		if ( isset( $settings['backup_before_pull'] ) && $settings['backup_before_pull'] === 'yes' ) {
			Git_Backup::backup_modified_files();
		}
		$remote_url = Git_Auth::get_authenticated_remote_url();
		if ( ! $remote_url ) { return array( 'status' => false, 'message' => 'Remote URL not configured.' ); }
		Git_Repository::set_remote( $remote_url );
		$result = Git_Command::execute( 'pull', array( 'origin', $branch ) );
		if ( $result['status'] ) {
			Git_Logger::log( 'PULL', 'Success', "Pulled from origin/{$branch}.", $branch );
			return array( 'status' => true, 'message' => 'Pull successful.', 'output' => $result['output'] );
		}
		if ( strpos( $result['error'], 'conflict' ) !== false || strpos( $result['output'], 'conflict' ) !== false ) {
			Git_Logger::log( 'PULL', 'Failed', "Merge conflict on pull origin/{$branch}.", $branch );
			return array( 'status' => false, 'message' => 'Merge Conflict Detected. Please resolve manually or abort.', 'error' => $result['output'] . "\n" . $result['error'] );
		}
		Git_Logger::log( 'PULL', 'Failed', $result['error'], $branch );
		return array( 'status' => false, 'message' => 'Pull failed: ' . $result['error'] );
	}
	public static function commit_and_push( $files, $message, $branch = 'main' ) {
		if ( empty( $files ) || empty( $message ) ) {
			return array( 'status' => false, 'message' => 'Files and message are required.' );
		}
		foreach ( $files as $file ) {
			$add_result = Git_Command::execute( 'add', array( ':/' . ltrim( $file, '/' ) ) );
			if ( ! $add_result['status'] ) {
				return array( 'status' => false, 'message' => "Failed to add file {$file}: " . $add_result['error'] );
			}
		}
		$commit_result = Git_Command::execute( 'commit', array( '-m', $message ) );
		if ( ! $commit_result['status'] ) {
			Git_Logger::log( 'COMMIT', 'Failed', $commit_result['error'], $branch );
			return array( 'status' => false, 'message' => 'Commit failed: ' . $commit_result['error'] );
		}
		$hash = '';
		if ( preg_match( '/\[(.*?) ([a-f0-9]+)\]/', $commit_result['output'], $matches ) ) {
			$hash = $matches[2];
		}
		Git_Logger::log( 'COMMIT', 'Success', "Commit created: {$message}", $branch, $hash );
		$remote_url = Git_Auth::get_authenticated_remote_url();
		if ( ! $remote_url ) {
			return array( 'status' => true, 'message' => 'Commit successful, but Push failed: Remote URL not configured.' );
		}
		Git_Repository::set_remote( $remote_url );
		
		// ALWAYS push the current active branch to the remote
		$push_result = Git_Command::execute( 'push', array( 'origin', 'HEAD' ) );
		if ( $push_result['status'] ) {
			Git_Logger::log( 'PUSH', 'Success', "Pushed HEAD to origin.", 'HEAD', $hash );
			return array( 'status' => true, 'message' => 'Commit and Push successful.' );
		}
		Git_Logger::log( 'PUSH', 'Failed', $push_result['error'], 'HEAD', $hash );
		return array( 'status' => false, 'message' => 'Commit successful, but Push failed: ' . $push_result['error'] );
	}
	public static function get_diff( $file ) {
		$result = Git_Command::execute( 'diff', array( ':/' . ltrim( $file, '/' ) ) );
		if ( $result['status'] ) {
			return array( 'status' => true, 'diff' => $result['output'] );
		}
		return array( 'status' => false, 'message' => 'Failed to get diff: ' . $result['error'] );
	}
}