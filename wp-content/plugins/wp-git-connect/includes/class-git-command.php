<?php
/**
 * Git Command Class.
 *
 * @package WPGitConnect
 */

namespace WPGitConnect;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Git_Command
 */
class Git_Command {

	/**
	 * Execute a git command safely.
	 */
	public static function execute( $command, $args = array() ) {
		if ( ! Git_Security::can_execute() ) {
			return array(
				'status' => false,
				'output' => '',
				'error'  => 'Server Git execution is unavailable.',
			);
		}

		$settings = get_option( 'wp_git_connect_settings', array() );
		$repo_path = isset( $settings['repo_path'] ) ? $settings['repo_path'] : ABSPATH;

		if ( ! is_dir( $repo_path ) ) {
			return array(
				'status' => false,
				'output' => '',
				'error'  => 'Repository path is invalid.',
			);
		}

		$git_binary = isset( $settings['git_binary_path'] ) && ! empty( $settings['git_binary_path'] ) ? $settings['git_binary_path'] : 'git';

		$cmd = escapeshellcmd( escapeshellarg( $git_binary ) . ' ' . $command );
		
		foreach ( $args as $arg ) {
			$cmd .= ' ' . escapeshellarg( $arg );
		}

		$env_vars = Git_Auth::get_git_env();

		$descriptorspec = array(
			0 => array( "pipe", "r" ),
			1 => array( "pipe", "w" ),
			2 => array( "pipe", "w" )
		);

		$cwd = $repo_path;
		$env = ! empty( $env_vars ) ? array_merge( $_ENV, $env_vars ) : null;

		$process = proc_open( $cmd, $descriptorspec, $pipes, $cwd, $env );

		if ( is_resource( $process ) ) {
			$stdout = stream_get_contents( $pipes[1] );
			fclose( $pipes[1] );
			$stderr = stream_get_contents( $pipes[2] );
			fclose( $pipes[2] );
			$return_value = proc_close( $process );

			if ( $return_value !== 0 ) {
				return array(
					'status' => false,
					'output' => trim( $stdout ),
					'error'  => trim( $stderr ),
					'code'   => $return_value,
				);
			}

			return array(
				'status' => true,
				'output' => trim( $stdout ),
				'error'  => trim( $stderr ),
				'code'   => $return_value,
			);
		}

		return array(
			'status' => false,
			'output' => '',
			'error'  => 'Failed to start git process.',
		);
	}

	/**
	 * Check if git is installed.
	 */
	public static function is_installed() {
		$result = self::execute( '--version' );
		if ( $result['status'] && strpos( $result['output'], 'git version' ) !== false ) {
			return trim( str_replace( 'git version', '', $result['output'] ) );
		}
		return false;
	}
}
