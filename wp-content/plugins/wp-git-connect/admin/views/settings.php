<?php
/**
 * Settings View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$settings = get_option( 'wp_git_connect_settings', array() );
$repo_path = isset( $settings['repo_path'] ) ? $settings['repo_path'] : ABSPATH;
$remote_url = isset( $settings['remote_url'] ) ? $settings['remote_url'] : '';
$default_branch = isset( $settings['default_branch'] ) ? $settings['default_branch'] : 'main';
$auth_method = isset( $settings['auth_method'] ) ? $settings['auth_method'] : 'none';
$username = isset( $settings['username'] ) ? $settings['username'] : '';
$pat_token = isset( $settings['pat_token'] ) ? $settings['pat_token'] : '';
$backup_before_pull = isset( $settings['backup_before_pull'] ) ? $settings['backup_before_pull'] : 'no';
$cron_auto_fetch = isset( $settings['cron_auto_fetch'] ) ? $settings['cron_auto_fetch'] : 'no';

?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Git Connect Settings', 'wp-git-connect' ); ?></h1>
	</div>

	<?php settings_errors( 'wp_git_connect_messages' ); ?>

	<div class="wpgc-card">
		<form method="post" action="">
			<?php wp_nonce_field( 'wp_git_connect_settings_action', 'wp_git_connect_nonce' ); ?>
			
			<table class="form-table" role="presentation">
				<tbody>
					<!-- General Settings -->
					<tr>
						<th scope="row"><label for="repo_path"><?php esc_html_e( 'Repository Path', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="repo_path" type="text" id="repo_path" value="<?php echo esc_attr( $repo_path ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Absolute path to the local Git repository (default is WordPress root).', 'wp-git-connect' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="remote_url"><?php esc_html_e( 'Remote Repository URL', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="remote_url" type="text" id="remote_url" value="<?php echo esc_attr( $remote_url ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'e.g., https://github.com/company/project.git', 'wp-git-connect' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="default_branch"><?php esc_html_e( 'Default Branch', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="default_branch" type="text" id="default_branch" value="<?php echo esc_attr( $default_branch ); ?>" class="regular-text">
						</td>
					</tr>

					<!-- Authentication -->
					<tr>
						<th scope="row"><label for="auth_method"><?php esc_html_e( 'Authentication Method', 'wp-git-connect' ); ?></label></th>
						<td>
							<select name="auth_method" id="auth_method">
								<option value="none" <?php selected( $auth_method, 'none' ); ?>><?php esc_html_e( 'None / Public Repo', 'wp-git-connect' ); ?></option>
								<option value="pat" <?php selected( $auth_method, 'pat' ); ?>><?php esc_html_e( 'HTTPS Personal Access Token', 'wp-git-connect' ); ?></option>
								<option value="ssh" <?php selected( $auth_method, 'ssh' ); ?>><?php esc_html_e( 'SSH Key (Advanced)', 'wp-git-connect' ); ?></option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="username"><?php esc_html_e( 'Username', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="username" type="text" id="username" value="<?php echo esc_attr( $username ); ?>" class="regular-text">
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="pat_token"><?php esc_html_e( 'Personal Access Token', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="pat_token" type="password" id="pat_token" value="<?php echo ! empty( $pat_token ) ? '********' : ''; ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Leave blank to keep existing token. Token is saved securely.', 'wp-git-connect' ); ?></p>
						</td>
					</tr>

					<!-- Safety & Sync -->
					<tr>
						<th scope="row"><?php esc_html_e( 'Backup Before Pull', 'wp-git-connect' ); ?></th>
						<td>
							<label for="backup_before_pull">
								<input name="backup_before_pull" type="checkbox" id="backup_before_pull" value="1" <?php checked( $backup_before_pull, 'yes' ); ?>>
								<?php esc_html_e( 'Create a zip backup of modified files before executing Git Pull', 'wp-git-connect' ); ?>
							</label>
						</td>
					</tr>

					<tr>
						<th scope="row"><?php esc_html_e( 'Background Sync', 'wp-git-connect' ); ?></th>
						<td>
							<label for="cron_auto_fetch">
								<input name="cron_auto_fetch" type="checkbox" id="cron_auto_fetch" value="1" <?php checked( $cron_auto_fetch, 'yes' ); ?>>
								<?php esc_html_e( 'Automatically fetch from remote in background', 'wp-git-connect' ); ?>
							</label>
						</td>
					</tr>

					<!-- Advanced Database Settings -->
					<tr>
						<th scope="row"><label for="mysqldump_path"><?php esc_html_e( 'mysqldump Path (Optional)', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="mysqldump_path" type="text" id="mysqldump_path" value="<?php echo esc_attr( isset( $settings['mysqldump_path'] ) ? $settings['mysqldump_path'] : '' ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Leave blank to auto-detect. Useful for XAMPP (e.g., C:\xampp\mysql\bin\mysqldump.exe)', 'wp-git-connect' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="mysql_path"><?php esc_html_e( 'mysql CLI Path (Optional)', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="mysql_path" type="text" id="mysql_path" value="<?php echo esc_attr( isset( $settings['mysql_path'] ) ? $settings['mysql_path'] : '' ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Leave blank to auto-detect. Useful for XAMPP (e.g., C:\xampp\mysql\bin\mysql.exe)', 'wp-git-connect' ); ?></p>
						</td>
					</tr>

				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="wp_git_connect_save_settings" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Settings', 'wp-git-connect' ); ?>">
			</p>
		</form>
	</div>
</div>
