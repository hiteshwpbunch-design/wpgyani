<?php
/**
 * Dashboard View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$status = \WPGitConnect\Git_Repository::get_status();
$is_repo = \WPGitConnect\Git_Repository::is_repository();
?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Git Connect Dashboard', 'wp-git-connect' ); ?></h1>
	</div>

	<?php if ( ! \WPGitConnect\Git_Command::is_installed() ) : ?>
		<div class="notice notice-error">
			<p><?php esc_html_e( 'Git is not installed on this server. Please install Git or contact your hosting provider.', 'wp-git-connect' ); ?></p>
		</div>
	<?php endif; ?>

	<?php if ( ! $is_repo ) : ?>
		<div class="wpgc-card">
			<h2><?php esc_html_e( 'Repository Not Initialized', 'wp-git-connect' ); ?></h2>
			<p><?php esc_html_e( 'This WordPress installation is not currently a Git repository.', 'wp-git-connect' ); ?></p>
			<!-- Could add an Initialize button here that hits a REST API endpoint -->
		</div>
	<?php else : ?>
		<div class="wpgc-status-grid">
			<div class="wpgc-card">
				<h2><?php esc_html_e( 'Repository Status', 'wp-git-connect' ); ?></h2>
				<p>
					<strong>Status:</strong> 
					<?php if ( $status['status'] ) : ?>
						<span class="wpgc-badge connected">Connected</span>
					<?php else : ?>
						<span class="wpgc-badge disconnected">Disconnected</span>
					<?php endif; ?>
				</p>
				<?php if ( $status['status'] && isset( $status['data'] ) ) : ?>
					<p><strong>Current Branch:</strong> <?php echo esc_html( $status['data']['current_branch'] ); ?></p>
					
					<h3>Local Changes</h3>
					<p>
						<?php echo count( $status['data']['local_changes']['modified'] ); ?> modified<br>
						<?php echo count( $status['data']['local_changes']['added'] ); ?> added<br>
						<?php echo count( $status['data']['local_changes']['deleted'] ); ?> deleted<br>
						<?php echo count( $status['data']['local_changes']['untracked'] ); ?> untracked
					</p>

					<h3>Remote Status</h3>
					<p>
						<?php echo esc_html( $status['data']['remote_status']['ahead'] ); ?> commits ahead<br>
						<?php echo esc_html( $status['data']['remote_status']['behind'] ); ?> commits behind
					</p>
				<?php endif; ?>
			</div>

			<div class="wpgc-card">
				<h2><?php esc_html_e( 'Actions', 'wp-git-connect' ); ?></h2>
				<p>
					<button type="button" id="wpgc-btn-pull" class="button button-primary button-hero">
						<?php esc_html_e( 'PULL FROM GIT', 'wp-git-connect' ); ?>
						<span class="spinner wpgc-loader"></span>
					</button>
				</p>
				<p>
					<a href="<?php echo esc_url( admin_url( 'admin.php?page=wp-git-connect-status' ) ); ?>" class="button button-secondary">
						<?php esc_html_e( 'View Changes & Push', 'wp-git-connect' ); ?>
					</a>
				</p>
			</div>
		</div>

		<?php if ( $status['status'] && ! empty( $status['data']['last_commit'] ) ) : ?>
			<div class="wpgc-card">
				<h2><?php esc_html_e( 'Last Commit', 'wp-git-connect' ); ?></h2>
				<p><strong><?php echo esc_html( $status['data']['last_commit']['hash'] ); ?></strong> - <?php echo esc_html( $status['data']['last_commit']['message'] ); ?></p>
				<p><em>By <?php echo esc_html( $status['data']['last_commit']['author'] ); ?> - <?php echo esc_html( $status['data']['last_commit']['date'] ); ?></em></p>
			</div>
		<?php endif; ?>

	<?php endif; ?>
</div>
