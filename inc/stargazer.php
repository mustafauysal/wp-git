<?php

// outputs the love it link
function wp_git_star_it_btn( ) {

	global $user_ID, $post;
	$ip_address = $_SERVER['HTTP_CLIENT_IP'] ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['HTTP_X_FORWARDE‌​D_FOR'] ? sanitize_text_field( $_SERVER['HTTP_X_FORWARDE‌​D_FOR'] ) : sanitize_text_field( $_SERVER['REMOTE_ADDR'] );

	$star_count = wp_git_get_starred_count( get_the_ID() );
	$is_starred = wp_git_has_starred_post( get_the_ID() );
	$output = '';
	$output .= '<div class="col-xs-4 col-md-2">';
	$output .= '<div class="post-action-star pull-right '. ($is_starred === true ? 'unstar':'').'" data-post-id="' . esc_attr( get_the_ID() ) . '" data-user-id="' . esc_attr( $user_ID ) . '" data-ip-address="' . esc_attr( $ip_address ) . '">';

			if ( $is_starred ) {
				$output .= '<div class="btn post-action-star-left-button  pull-left">';
					$output .= '<span class="glyphicon glyphicon-star"></span> <span id="span_status">' . __( 'Unstar', 'wp-git' ) . '</span>';
				$output .= '</div>';
			} else {
				$output .= '<div class="btn post-action-star-left-button pull-left">';
					$output .= '<span class="glyphicon glyphicon-star"></span> <span id="span_status">' . __( 'Star', 'wp-git' ) . '</span>';
				$output .= '</div>';
			}

			$output .= '<div class="post-action-star-right-count pull-left">' . $star_count . '</div>';


	$output .= '</div>';



	$output .= '</div>';

	return $output;
}


function wp_git_has_starred_post( $post_id ) {

	if ( is_user_logged_in() ) {
		$meta_value = get_current_user_id();
	} else {
		$meta_value = $_SERVER['HTTP_CLIENT_IP'] ? $_SERVER['HTTP_CLIENT_IP'] : $_SERVER['HTTP_X_FORWARDE‌​D_FOR'] ? sanitize_text_field( $_SERVER['HTTP_X_FORWARDE‌​D_FOR'] ) : sanitize_text_field( $_SERVER['REMOTE_ADDR'] );
	}

	$stargazers = get_post_meta( $post_id, 'wp_git_stargazer', true );

	if ( ! $stargazers ) {
		return false;
	}

	if ( is_string( $stargazers ) ) {
		$stargazers = unserialize( $stargazers );
	}

	if ( in_array( $meta_value, array_keys( $stargazers ) ) ) {
		return true;
	}

	return false;

}

function wp_git_get_starred_count( $post_id ) {
	$stargazers_count = get_post_meta( $post_id, 'wp_git_starred_count', true );

	if ( empty( $stargazers_count ) ) {
		return 0;
	}

	return absint( $stargazers_count );
}

function wp_git_stargaze_front_end_js() {
	wp_enqueue_script( 'wp-git-stargaze', get_template_directory_uri() . '/assets/js/stargaze.js', array( 'jquery' ) );
	wp_localize_script( 'wp-git-stargaze', 'wp_git_stargaze_vars',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce('star_it_nonce'),
			'is_logged' => is_user_logged_in(),
		)
	);
}
add_action('wp_enqueue_scripts', 'wp_git_stargaze_front_end_js');

function wp_git_mark_post_as_starred( $post_id, $user_id_or_ip_address ) {

	$post_id = absint( $post_id );
	$user_id_or_ip_address = sanitize_text_field( $user_id_or_ip_address );

	$star_count = get_post_meta( $post_id, 'wp_git_starred_count', true );
	$stargazers = get_post_meta( $post_id, 'wp_git_stargazer', true );

	if ( ! empty( $stargazers ) ) {
		if ( ! in_array( $user_id_or_ip_address, array_keys( $stargazers ) ) ) {
			$stargazers[ $user_id_or_ip_address ] = current_time('timestamp');
			$star_count = $star_count + 1;
		} else {
			// remove star
			$star_count = $star_count - 1;
			unset( $stargazers[ $user_id_or_ip_address ] );
		}
	} else {
		$stargazers[ $user_id_or_ip_address ] = current_time('timestamp');
		$star_count = 1;
	}


	if ( update_post_meta( $post_id, 'wp_git_stargazer', $stargazers ) ) {
		update_post_meta( $post_id, 'wp_git_starred_count', $star_count );

		return true;
	}

	return false;
}


function wp_git_star_it() {

	if ( isset( $_POST['item_id'] ) && wp_verify_nonce($_POST['star_it_nonce'], 'star_it_nonce') ) {

		$value = $_POST['is_logged'] ? $_POST['user_id'] : $_POST['ip_address'];

		if ( wp_git_mark_post_as_starred( $_POST['item_id'], $value ) ) {
			echo json_encode( array( 'status' => 'ok', 'count' => get_post_meta( $_POST['item_id'], 'wp_git_starred_count', true ) ) );
		} else {
			echo json_encode( array( 'status' => 'fail', 'count' => get_post_meta( $_POST['item_id'], 'wp_git_starred_count', true ) ) );
		}
	}
	die();
}

add_action( 'wp_ajax_star_it', 'wp_git_star_it' );
add_action( 'wp_ajax_nopriv_star_it', 'wp_git_star_it' );