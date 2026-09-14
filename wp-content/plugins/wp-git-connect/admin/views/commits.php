<?php
/**
 * Commits View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$commits = array();
if ( \WPGitConnect\Git_Repository::is_repository() ) {
	$result = \WPGitConnect\Git_Command::execute( 'log', array( '-50', '--format=%h|%an|%ar|%s' ) );
	if ( $result['status'] && ! empty( $result['output'] ) ) {
		$lines = array_filter( explode( "\n", $result['output'] ) );
		foreach ( $lines as $line ) {
			$parts = explode( '|', $line, 4 );
			if ( count( $parts ) === 4 ) {
				$commits[] = array(
					'hash'   => $parts[0],
					'author' => $parts[1],
					'date'   => $parts[2],
					'message'=> $parts[3],
				);
			}
		}
	}
}

?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Commit History', 'wp-git-connect' ); ?></h1>
	</div>

	<div class="wpgc-card">
		<?php if ( empty( $commits ) ) : ?>
			<p><?php esc_html_e( 'No commits found or not a valid repository.', 'wp-git-connect' ); ?></p>
		<?php else : ?>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th style="width: 100px;"><?php esc_html_e( 'Hash', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'Message', 'wp-git-connect' ); ?></th>
						<th style="width: 150px;"><?php esc_html_e( 'Author', 'wp-git-connect' ); ?></th>
						<th style="width: 150px;"><?php esc_html_e( 'Date', 'wp-git-connect' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $commits as $commit ) : ?>
						<tr>
							<td><code><?php echo esc_html( $commit['hash'] ); ?></code></td>
							<td><strong><?php echo esc_html( $commit['message'] ); ?></strong></td>
							<td><?php echo esc_html( $commit['author'] ); ?></td>
							<td><?php echo esc_html( $commit['date'] ); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
