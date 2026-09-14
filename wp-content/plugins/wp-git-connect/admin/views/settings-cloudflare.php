<?php
/**
 * Cloudflare Settings View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$cf_settings = get_option( 'wp_git_connect_cloudflare', array() );
$account_id = isset( $cf_settings['account_id'] ) ? $cf_settings['account_id'] : '';
$api_token = isset( $cf_settings['api_token'] ) ? $cf_settings['api_token'] : '';
$project_name = isset( $cf_settings['project_name'] ) ? $cf_settings['project_name'] : '';

?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Cloudflare Setup', 'wp-git-connect' ); ?></h1>
	</div>

	<?php settings_errors( 'wp_git_connect_messages' ); ?>

	<div class="wpgc-card">
		<p><?php esc_html_e( 'Configure Cloudflare integration to deploy your WordPress static files to Cloudflare Pages or Workers.', 'wp-git-connect' ); ?></p>
		
		<form method="post" action="">
			<?php wp_nonce_field( 'wp_git_connect_cloudflare_action', 'wp_git_connect_nonce' ); ?>
			
			<table class="form-table" role="presentation">
				<tbody>
					<tr>
						<th scope="row"><label for="cf_account_id"><?php esc_html_e( 'Cloudflare Account ID', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="cf_account_id" type="text" id="cf_account_id" value="<?php echo esc_attr( $account_id ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'You can find this in your Cloudflare dashboard URL.', 'wp-git-connect' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="cf_api_token"><?php esc_html_e( 'Cloudflare API Token', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="cf_api_token" type="password" id="cf_api_token" value="<?php echo ! empty( $api_token ) ? '********' : ''; ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'Leave blank to keep existing token. Requires Cloudflare Pages/Workers permissions.', 'wp-git-connect' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label for="cf_project_name"><?php esc_html_e( 'Project Name', 'wp-git-connect' ); ?></label></th>
						<td>
							<input name="cf_project_name" type="text" id="cf_project_name" value="<?php echo esc_attr( $project_name ); ?>" class="regular-text">
							<p class="description"><?php esc_html_e( 'The name of your Cloudflare Pages or Worker project.', 'wp-git-connect' ); ?></p>
						</td>
					</tr>
				</tbody>
			</table>
			<p class="submit">
				<input type="submit" name="wp_git_connect_save_cloudflare" id="submit" class="button button-primary" value="<?php esc_attr_e( 'Save Cloudflare Settings', 'wp-git-connect' ); ?>">
			</p>
		</form>
	</div>

	<?php if ( ! empty( $account_id ) && ! empty( $api_token ) && ! empty( $project_name ) ) : ?>
	<div class="wpgc-card">
		<h2><?php esc_html_e( 'Cloudflare Actions', 'wp-git-connect' ); ?></h2>
		<p><?php esc_html_e( 'Generate configuration and deploy directly from here.', 'wp-git-connect' ); ?></p>
		
		<form method="post" action="<?php echo esc_url( rest_url( \WPGitConnect\Git_Rest_Api::NAMESPACE . '/cloudflare/generate-config' ) ); ?>" id="wpgc-cloudflare-generate">
			<button type="submit" class="button button-secondary"><?php esc_html_e( 'Generate wrangler.jsonc', 'wp-git-connect' ); ?></button>
		</form>
		<br>
		<form method="post" action="<?php echo esc_url( rest_url( \WPGitConnect\Git_Rest_Api::NAMESPACE . '/cloudflare/deploy' ) ); ?>" id="wpgc-cloudflare-deploy">
			<button type="submit" class="button button-primary"><?php esc_html_e( 'Deploy to Cloudflare', 'wp-git-connect' ); ?></button>
			<span class="spinner"></span>
		</form>
		<div id="wpgc-cloudflare-response" style="margin-top:15px;"></div>
	</div>
	
	<script>
	jQuery(document).ready(function($) {
		$('#wpgc-cloudflare-generate').on('submit', function(e) {
			e.preventDefault();
			var $btn = $(this).find('button');
			$btn.prop('disabled', true).text('Generating...');
			
			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-WP-Nonce', wpGitConnect.nonce);
				},
				success: function(response) {
					$('#wpgc-cloudflare-response').html('<div class="notice notice-success inline"><p>' + response.message + '</p></div>');
					$btn.prop('disabled', false).text('<?php esc_js( esc_html__( 'Generate wrangler.jsonc', 'wp-git-connect' ) ); ?>');
				},
				error: function(xhr) {
					var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error generating config.';
					$('#wpgc-cloudflare-response').html('<div class="notice notice-error inline"><p>' + msg + '</p></div>');
					$btn.prop('disabled', false).text('<?php esc_js( esc_html__( 'Generate wrangler.jsonc', 'wp-git-connect' ) ); ?>');
				}
			});
		});

		$('#wpgc-cloudflare-deploy').on('submit', function(e) {
			e.preventDefault();
			var $btn = $(this).find('button');
			var $spinner = $(this).find('.spinner');
			
			$btn.prop('disabled', true);
			$spinner.addClass('is-active');
			$('#wpgc-cloudflare-response').html('<div class="notice notice-info inline"><p>Deploying... This may take a minute.</p></div>');
			
			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				beforeSend: function(xhr) {
					xhr.setRequestHeader('X-WP-Nonce', wpGitConnect.nonce);
				},
				success: function(response) {
					$('#wpgc-cloudflare-response').html('<div class="notice notice-success inline"><p>' + response.message + '</p><pre>' + (response.output || '') + '</pre></div>');
					$btn.prop('disabled', false);
					$spinner.removeClass('is-active');
				},
				error: function(xhr) {
					var msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'Error during deployment.';
					var output = xhr.responseJSON && xhr.responseJSON.output ? '<pre>' + xhr.responseJSON.output + '</pre>' : '';
					$('#wpgc-cloudflare-response').html('<div class="notice notice-error inline"><p>' + msg + '</p>' + output + '</div>');
					$btn.prop('disabled', false);
					$spinner.removeClass('is-active');
				}
			});
		});
	});
	</script>
	<?php endif; ?>
</div>
