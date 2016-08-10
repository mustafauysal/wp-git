<?php
add_action( 'show_user_profile', 'wp_git_extra_profile_info' );
add_action( 'edit_user_profile', 'wp_git_extra_profile_info' );

function wp_git_extra_profile_info( $user ) {
	?>
	<h3><?php _e( 'Github Profile Info', 'wp-git' ); ?></h3>

	<table class="form-table">
		<tr>
			<th><label for="wp_git_bio"><?php _e( 'Bio', 'wp-git' ); ?></label></th>
			<td><input type="text" name="wp_git_bio" value="<?php echo esc_attr( get_the_author_meta( 'wp_git_bio', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="wp_git_company"><?php _e( 'Company', 'wp-git' ); ?></label></th>
			<td><input type="text" name="wp_git_company" value="<?php echo esc_attr( get_the_author_meta( 'wp_git_company', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="wp_git_location"><?php _e( 'Location', 'wp-git' ); ?></label></th>
			<td><input type="text" name="wp_git_location" value="<?php echo esc_attr( get_the_author_meta( 'wp_git_location', $user->ID ) ); ?>" class="regular-text" /></td>
		</tr>

		<tr>
			<th><label for="wp_git_location"><?php _e( 'Email', 'wp-git' ); ?></label></th>
			<td><input type="checkbox" name="wp_git_show_email" value="true" <?php checked( "true", esc_attr( get_the_author_meta( 'wp_git_show_email', $user->ID ) ) ) ?> />
				<?php _e('Show email address on profile page','wp-git');?>
			</td>
		</tr>

	</table>
	<?php
}

add_action( 'personal_options_update', 'wp_git_save_profile_info' );
add_action( 'edit_user_profile_update', 'wp_git_save_profile_info' );

function wp_git_save_profile_info( $user_id ) {

	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	update_user_meta( $user_id, 'wp_git_bio', $_POST['wp_git_bio'] );
	update_user_meta( $user_id, 'wp_git_company', $_POST['wp_git_company'] );
	update_user_meta( $user_id, 'wp_git_location', $_POST['wp_git_location'] );
	update_user_meta( $user_id, 'wp_git_show_email', $_POST['wp_git_show_email'] );
}