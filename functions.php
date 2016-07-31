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
	wp_enqueue_script( 'wp-github-list', get_template_directory_uri() . '/assets/js/list.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'wp-github-d3', get_template_directory_uri() . '/assets/js/d3.v3.min.js', array(), false, true );
	wp_enqueue_script( 'wp-github-cal-heatmap', get_template_directory_uri() . '/assets/js/cal-heatmap.min.js', array(), false, true );
	wp_enqueue_script( 'wp-github-index', get_template_directory_uri() . '/assets/js/index.js', array(), false, true );
	wp_localize_script( 'wp-github-index', 'wp_github_vars', array(
			'data' => wp_github_data('contribution_data'),
			'item_name' => array(__('blog post','wp-github'),__('blog posts','wp-github')),
			'cell' => array('filled' => __("{count} blog posts {name} a {date}","wp-github")  )
		)
	);

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

function wp_github_get_author_gravatar_url( $args = array() ) {
	global $post;

	$params = wp_parse_args( $args, array(
		'size'      => '80',
		'author_id' => $post->post_author,
	) );

	$email = get_the_author_meta('user_email', $params['author_id']);
	$hash = md5( strtolower( trim( $email ) ) ) . '?s=' . $params['size'];

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


function wp_github_excerpt( $post_id = null, $limit ) {
	$excerpt = explode( ' ', get_the_excerpt( $post_id ), $limit );
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

function wp_github_word_count() {
	global $post;
	$content    = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );

	return $word_count;
}

function wp_github_post_revisions() {
	if ( is_single() ) {
		global $post;

		$revisions      = wp_get_post_revisions( $post );
		$revision_group = array();
		foreach ( $revisions as $rev_item ) {
			//date based group
			$rev_date = substr( $rev_item->post_date, 0, 10 );

			$revision_group[ $rev_date ][] = $rev_item;
		}
		return $revision_group;
	}
	return false;
}

function wp_github_get_post_hash( $context ) {
	return substr( sha1( $context ), 0, 7 );
}

function wp_github_get_latest_revision( $post_id ) {
	$revisions = wp_get_post_revisions( $post_id );

	if ( is_array( $revisions ) && ! empty( $revisions ) ) {
		return array_shift( array_values( $revisions ) );
	}

	return false;
}

function wp_github_compare_revision($post_id, $revision_id, $to = false ) {
	$revision_id = absint( $revision_id );
	if ( false !== $to ) {
		$to = absint( $to );
	}

	if ( $revision_id == $to ) {
		$to = false;
	}

	$revisions = wp_get_post_revisions( $post_id );
	if(false!==$to){
		$prev_revision = $revisions[$to];
	}


	foreach ( $revisions as $rev_id => $revision ) {

		if ( $rev_id == $revision_id ) {
			$base_revision = $revision;
		}

		if ( $rev_id < $revision_id && empty( $prev_revision ) ) {
			$prev_revision = $revision;
			break;
		}

	}
	$diff = wp_text_diff( $prev_revision->post_content, $base_revision->post_content);
	if ( ! empty( $diff ) ) {
		return $diff;
	}

	return __( "the content unchanged between these revisions. Other part of post data might be changed.", 'wp-github' );
}


function wp_github_register_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu', 'wp-github' ),
			'footer-menu' => __( 'Footer Menu', 'wp-github' ),
		)
	);
}
add_action( 'init', 'wp_github_register_menus' );




add_theme_support( 'custom-logo', array(
	'height'     => 220,
	'width'      => 220,
) );


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

require get_template_directory() . '/inc/stargazer.php';
/**
 * Extra profile fields
 */
require get_template_directory() . '/inc/profile-fields.php';

require get_template_directory() . '/inc/data-provider.php';

