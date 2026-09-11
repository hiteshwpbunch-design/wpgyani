<?php
/**
 * Git Repository Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Repository
 */
class Git_Repository {

	/**
	 * Check if the path is a valid git repository.
	 */
	public static function is_repository() {
		$result = Git_Command::execute( 'rev-parse', array( '--is-inside-work-tree' ) );
		return $result['status'] && trim( $result['output'] ) === 'true';
	}

	/**
	 * Initialize a new git repository.
	 */
	public static function init_repository() {
		$result = Git_Command::execute( 'init' );
		if ( $result['status'] ) {
			Git_Logger::log( 'INIT', 'Success', 'Repository initialized.' );
			return array( 'status' => true, 'message' => 'Repository initialized successfully.' );
		}
		
		Git_Logger::log( 'INIT', 'Failed', $result['error'] );
		return array( 'status' => false, 'message' => 'Failed to initialize repository: ' . $result['error'] );
	}

	/**
	 * Get repository status.
	 */
	public static function get_status() {
		if ( ! self::is_repository() ) {
			return array( 'status' => false, 'message' => 'Not a git repository.' );
		}

		$branch_result = Git_Command::execute( 'rev-parse', array( '--abbrev-ref', 'HEAD' ) );
		$current_branch = $branch_result['status'] ? trim( $branch_result['output'] ) : 'unknown';

		$last_commit_result = Git_Command::execute( 'log', array( '-1', '--format=%h|%an|%ar|%s' ) );
		$last_commit = array();
		if ( $last_commit_result['status'] && ! empty( $last_commit_result['output'] ) ) {
			$parts = explode( '|', $last_commit_result['output'], 4 );
			if ( count( $parts ) === 4 ) {
				$last_commit = array(
					'hash'   => $parts[0],
					'author' => $parts[1],
					'date'   => $parts[2],
					'message'=> $parts[3],
				);
			}
		}

		// Get local changes
		$status_result = Git_Command::execute( 'status', array( '--porcelain' ) );
		$local_changes = array(
			'modified' => array(),
			'added'    => array(),
			'deleted'  => array(),
			'untracked'=> array(),
		);

		if ( $status_result['status'] && ! empty( $status_result['output'] ) ) {
			$lines = array_filter( explode( "\n", $status_result['output'] ) );
			foreach ( $lines as $line ) {
				$code = substr( $line, 0, 2 );
				$file = trim( substr( $line, 2 ) );
				if ( strpos( $file, '"' ) === 0 ) {
					$file = trim( $file, '"' );
				}

				if ( $code === '??' ) {
					$local_changes['untracked'][] = $file;
				} elseif ( strpos( $code, 'D' ) !== false ) {
					$local_changes['deleted'][] = $file;
				} elseif ( strpos( $code, 'A' ) !== false ) {
					$local_changes['added'][] = $file;
				} else {
					$local_changes['modified'][] = $file;
				}
			}
		}

		// Remote status
		$remote_status = array( 'ahead' => 0, 'behind' => 0 );
		$remote_result = Git_Command::execute( 'rev-list', array( '--left-right', '--count', "HEAD...origin/{$current_branch}" ) );
		if ( $remote_result['status'] ) {
			$counts = explode( "\t", trim( $remote_result['output'] ) );
			if ( count( $counts ) === 2 ) {
				$remote_status['ahead'] = (int) $counts[0];
				$remote_status['behind'] = (int) $counts[1];
			}
		}

		return array(
			'status' => true,
			'data' => array(
				'connected'     => true,
				'current_branch'=> $current_branch,
				'last_commit'   => $last_commit,
				'local_changes' => $local_changes,
				'remote_status' => $remote_status,
			)
		);
	}

	/**
	 * Set remote origin.
	 */
	public static function set_remote( $url ) {
		$check = Git_Command::execute( 'remote', array( 'get-url', 'origin' ) );
		
		if ( $check['status'] ) {
			$result = Git_Command::execute( 'remote', array( 'set-url', 'origin', $url ) );
		} else {
			$result = Git_Command::execute( 'remote', array( 'add', 'origin', $url ) );
		}

		if ( $result['status'] ) {
			Git_Logger::log( 'REMOTE', 'Success', 'Remote origin updated.' );
			return array( 'status' => true, 'message' => 'Remote updated successfully.' );
		}

		Git_Logger::log( 'REMOTE', 'Failed', $result['error'] );
		return array( 'status' => false, 'message' => 'Failed to set remote: ' . $result['error'] );
	}
}
