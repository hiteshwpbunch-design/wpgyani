<?php
/**
 * Logs View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$logs = \WPGitConnect\Git_Logger::get_logs();

?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Activity Logs', 'wp-git-connect' ); ?></h1>
	</div>

	<div class="wpgc-card">
		<?php if ( empty( $logs ) ) : ?>
			<p><?php esc_html_e( 'No activity logs found.', 'wp-git-connect' ); ?></p>
		<?php else : ?>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Date', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'User', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'Action', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'Status', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'Message', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'Branch', 'wp-git-connect' ); ?></th>
						<th><?php esc_html_e( 'Commit', 'wp-git-connect' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $logs as $log ) : 
						$user_info = get_userdata( $log['user_id'] );
						$username = $user_info ? $user_info->user_login : 'System/Unknown';
						?>
						<tr>
							<td><?php echo esc_html( wp_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), strtotime( $log['created_at'] ) ) ); ?></td>
							<td><?php echo esc_html( $username ); ?></td>
							<td><strong><?php echo esc_html( $log['action'] ); ?></strong></td>
							<td>
								<?php if ( strtolower( $log['status'] ) === 'success' ) : ?>
									<span class="wpgc-badge connected"><?php echo esc_html( $log['status'] ); ?></span>
								<?php else : ?>
									<span class="wpgc-badge disconnected"><?php echo esc_html( $log['status'] ); ?></span>
								<?php endif; ?>
							</td>
							<td><?php echo nl2br( esc_html( $log['message'] ) ); ?></td>
							<td><?php echo esc_html( $log['branch'] ); ?></td>
							<td><code><?php echo esc_html( $log['commit_hash'] ); ?></code></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
