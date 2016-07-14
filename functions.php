<?php

/**
 * Enqueue scripts and styles.
 */
function wp_github_scripts() {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_style( 'wp-github-style', get_stylesheet_uri() );
	wp_enqueue_style( 'wp-github-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css' );
	wp_enqueue_style( 'wp-github-fontawesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
	wp_enqueue_style( 'wp-github-shared', get_template_directory_uri() . '/assets/css/shared.css' );
	wp_enqueue_style( 'wp-github-index', get_template_directory_uri() . '/assets/css/index.css' );
	wp_enqueue_style( 'wp-github-cal-heatmap', get_template_directory_uri() . '/assets/css/cal-heatmap.css' );

	wp_enqueue_script( 'wp-github-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), false, true );
	wp_enqueue_script( 'wp-github-list', get_template_directory_uri() . '/assets/js/list.min.js', array(), false, true );
	wp_enqueue_script( 'wp-github-d3', get_template_directory_uri() . '/assets/js/d3.v3.min.js', array(), false, true );
	wp_enqueue_script( 'wp-github-cal-heatmap', get_template_directory_uri() . '/assets/js/cal-heatmap.min.js', array(), false, true );
	wp_enqueue_script( 'wp-github-index', get_template_directory_uri() . '/assets/js/index.js', array(), false, true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_single() ) {
		wp_enqueue_script( 'wp-github-post', get_template_directory_uri() . '/assets/js/post.js', array(), false, true );
		wp_enqueue_style( 'wp-github-post', get_template_directory_uri() . '/assets/css/post.css' );

	}


}

add_action( 'wp_enqueue_scripts', 'wp_github_scripts' );


function wp_github_get_gravatar_url( $email, $size ) {
	$hash = md5( strtolower( trim( $email ) ) ) . '?s=' . $size;

	return 'http://gravatar.com/avatar/' . $hash;
}


function wp_github_custom_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	}
	else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`[[^]]*]`', '', $excerpt );

	return $excerpt;
}

add_filter( 'comment_form_default_fields', 'wp_github_unset_comment_fields' );
function wp_github_unset_comment_fields( $fields ) {
	if ( isset( $fields['url'] ) ) {
		unset( $fields['url'] );
	}


	return $fields;
}


function wp_github_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	}
	else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}


function wp_github_get_post_revision_count() {
	global $post, $wpdb;
	if ( is_single() ) {
		$result = $wpdb->get_results( $wpdb->prepare( "select id from $wpdb->posts where post_parent=%d and post_type=%s", get_the_ID(), 'revision' ) );

		return count( $result );
	}

	return 0;
}