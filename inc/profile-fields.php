<?php
add_action( 'show_user_profile', 'wp_github_extra_profile_info' );
add_action( 'edit_user_profile', 'wp_github_extra_profile_info' );

function wp_github_extra_profile_info( $user ) {
	?>
	<h3><?php _e( 'Github Profile Info', 'wp-github' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="wp_github_bio"><?php _e( 'Bio', 'wp-github' ); ?></label></th>
			<td><input type="text" name="wp_github_bio" value="<?php echo esc_attr( get_the_author_meta( 'wp_github_bio', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="wp_github_company"><?php _e( 'Company', 'wp-github' ); ?></label></th>
			<td><input type="text" name="wp_github_company" value="<?php echo esc_attr( get_the_author_meta( 'wp_github_company', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="wp_github_location"><?php _e( 'Location', 'wp-github' ); ?></label></th>
			<td><input type="text" name="wp_github_location" value="<?php echo esc_attr( get_the_author_meta( 'wp_github_location', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="wp_github_location"><?php _e( 'Email', 'wp-github' ); ?></label></th>
			<td><input type="checkbox" name="wp_github_show_email" value="true" <?php checked( "true", esc_attr( get_the_author_meta( 'wp_github_show_email', $user->ID ) ) ) ?> />
				<?php _e('Show email address on profile page','wp-github');?>
			</td>
		</tr>

	</table>
	<?php
}

add_action( 'personal_options_update', 'wp_github_save_profile_info' );
add_action( 'edit_user_profile_update', 'wp_github_save_profile_info' );

function wp_github_save_profile_info( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'wp_github_bio', $_POST['wp_github_bio'] );
	update_user_meta( $user_id, 'wp_github_company', $_POST['wp_github_company'] );
	update_user_meta( $user_id, 'wp_github_location', $_POST['wp_github_location'] );
	update_user_meta( $user_id, 'wp_github_show_email', $_POST['wp_github_show_email'] );
}