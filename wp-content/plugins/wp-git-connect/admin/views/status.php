<?php
/**
 * Status View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$status = \WPGitConnect\Git_Repository::get_status();
?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Git Status & Push', 'wp-git-connect' ); ?></h1>
	</div>

	<?php if ( ! $status['status'] ) : ?>
		<div class="notice notice-error">
			<p><?php echo esc_html( $status['message'] ); ?></p>
		</div>
	<?php else : ?>
		<div class="wpgc-card" style="margin-bottom: 20px; background: #f9f9f9;">
			<h2><?php esc_html_e( 'Database Sync', 'wp-git-connect' ); ?></h2>
			<p><?php esc_html_e( 'Use these tools to synchronize your WordPress database with the repository.', 'wp-git-connect' ); ?></p>
			<p>
				<button type="button" id="wpgc-btn-db-export" class="button button-secondary">
					<?php esc_html_e( 'Export Database to Git (database.sql)', 'wp-git-connect' ); ?>
					<span class="spinner wpgc-loader"></span>
				</button>
				
				<button type="button" id="wpgc-btn-db-import" class="button button-primary" style="margin-left: 10px; background: #dc3232; border-color: #dc3232;">
					<?php esc_html_e( 'Import Database from Git', 'wp-git-connect' ); ?>
					<span class="spinner wpgc-loader"></span>
				</button>
			</p>
			<p class="description"><?php esc_html_e( 'Note: Importing will overwrite your current database. Exporting will overwrite the database.sql file in your repository so you can commit it.', 'wp-git-connect' ); ?></p>
		</div>

		<form id="wpgc-form-commit">
			<div class="wpgc-status-grid">
				
				<div class="wpgc-card">
					<h2><?php esc_html_e( 'Changes to Push', 'wp-git-connect' ); ?></h2>
					
					<?php 
					$changes = $status['data']['local_changes'];
					$has_changes = false;
					?>

					<?php if ( ! empty( $changes['modified'] ) ) : $has_changes = true; ?>
						<h3><?php esc_html_e( 'Modified', 'wp-git-connect' ); ?></h3>
						<ul class="wpgc-file-list">
							<?php foreach ( $changes['modified'] as $file ) : ?>
								<li>
									<input type="checkbox" class="wpgc-file-checkbox" value="<?php echo esc_attr( $file ); ?>" id="file-<?php echo esc_attr( md5( $file ) ); ?>" checked>
									<label for="file-<?php echo esc_attr( md5( $file ) ); ?>"><?php echo esc_html( $file ); ?></label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( ! empty( $changes['added'] ) ) : $has_changes = true; ?>
						<h3><?php esc_html_e( 'Added', 'wp-git-connect' ); ?></h3>
						<ul class="wpgc-file-list">
							<?php foreach ( $changes['added'] as $file ) : ?>
								<li>
									<input type="checkbox" class="wpgc-file-checkbox" value="<?php echo esc_attr( $file ); ?>" id="file-<?php echo esc_attr( md5( $file ) ); ?>" checked>
									<label for="file-<?php echo esc_attr( md5( $file ) ); ?>"><?php echo esc_html( $file ); ?></label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( ! empty( $changes['deleted'] ) ) : $has_changes = true; ?>
						<h3><?php esc_html_e( 'Deleted', 'wp-git-connect' ); ?></h3>
						<ul class="wpgc-file-list">
							<?php foreach ( $changes['deleted'] as $file ) : ?>
								<li>
									<input type="checkbox" class="wpgc-file-checkbox" value="<?php echo esc_attr( $file ); ?>" id="file-<?php echo esc_attr( md5( $file ) ); ?>" checked>
									<label for="file-<?php echo esc_attr( md5( $file ) ); ?>"><?php echo esc_html( $file ); ?></label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( ! empty( $changes['untracked'] ) ) : $has_changes = true; ?>
						<h3><?php esc_html_e( 'Untracked', 'wp-git-connect' ); ?></h3>
						<ul class="wpgc-file-list">
							<?php foreach ( $changes['untracked'] as $file ) : ?>
								<li>
									<input type="checkbox" class="wpgc-file-checkbox" value="<?php echo esc_attr( $file ); ?>" id="file-<?php echo esc_attr( md5( $file ) ); ?>">
									<label for="file-<?php echo esc_attr( md5( $file ) ); ?>"><?php echo esc_html( $file ); ?></label>
								</li>
							<?php endforeach; ?>
						</ul>
					<?php endif; ?>

					<?php if ( ! $has_changes ) : ?>
						<p><?php esc_html_e( 'Working tree clean. Nothing to commit.', 'wp-git-connect' ); ?></p>
					<?php endif; ?>

				</div>

				<div class="wpgc-card">
					<h2><?php esc_html_e( 'Commit', 'wp-git-connect' ); ?></h2>
					<p>
						<label for="wpgc-commit-message"><?php esc_html_e( 'Commit Message', 'wp-git-connect' ); ?></label><br>
						<textarea id="wpgc-commit-message" rows="4" style="width: 100%; margin-top: 10px;" placeholder="Update plugin functionality..."></textarea>
					</p>
					<p>
						<button type="submit" id="wpgc-btn-commit" class="button button-primary button-large" <?php echo ! $has_changes ? 'disabled' : ''; ?>>
							<?php esc_html_e( 'Commit & Push', 'wp-git-connect' ); ?>
							<span class="spinner wpgc-loader"></span>
						</button>
					</p>
				</div>

			</div>
		</form>
	<?php endif; ?>
</div>
