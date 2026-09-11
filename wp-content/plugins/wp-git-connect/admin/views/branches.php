<?php
/**
 * Branches View.
 *
 * @package WPGitConnect
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$branches = array();
$current_branch = '';
if ( \WPGitConnect\Git_Repository::is_repository() ) {
	$result = \WPGitConnect\Git_Command::execute( 'branch', array( '--list' ) );
	if ( $result['status'] && ! empty( $result['output'] ) ) {
		$lines = array_filter( explode( "\n", $result['output'] ) );
		foreach ( $lines as $line ) {
			$is_current = strpos( $line, '*' ) === 0;
			$branch_name = trim( substr( $line, 1 ) );
			if ( $is_current ) {
				$current_branch = $branch_name;
			}
			$branches[] = array(
				'name'       => $branch_name,
				'is_current' => $is_current,
			);
		}
	}
}

?>

<div class="wrap wpgc-wrap">
	<div class="wpgc-header">
		<h1><?php esc_html_e( 'Branches', 'wp-git-connect' ); ?></h1>
	</div>

	<div class="wpgc-card">
		<?php if ( empty( $branches ) ) : ?>
			<p><?php esc_html_e( 'No branches found or not a valid repository.', 'wp-git-connect' ); ?></p>
		<?php else : ?>
			<table class="wp-list-table widefat fixed striped">
				<thead>
					<tr>
						<th><?php esc_html_e( 'Branch Name', 'wp-git-connect' ); ?></th>
						<th style="width: 150px;"><?php esc_html_e( 'Status', 'wp-git-connect' ); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $branches as $branch ) : ?>
						<tr>
							<td>
								<strong><?php echo esc_html( $branch['name'] ); ?></strong>
							</td>
							<td>
								<?php if ( $branch['is_current'] ) : ?>
									<span class="wpgc-badge connected"><?php esc_html_e( 'Current Branch', 'wp-git-connect' ); ?></span>
								<?php endif; ?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php endif; ?>
	</div>
</div>
