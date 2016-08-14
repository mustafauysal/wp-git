<?php

class WP_Git_Home_Data_Provider implements WP_Git_Data_Provider_Interface{

	function __construct(){ }

	public function profile_url(){
		return home_url('/');
	}

	public function avatar_url(){
		global $wp_query;
		$custom_logo_id = get_theme_mod( 'custom_logo' );

		$image = wp_get_attachment_image_src( $custom_logo_id, 'full', false );
		list( $src, $width, $height ) = $image;

		// custom logo
		if ( ! empty( $src ) ) {
			return $src;
		}

		return wp_git_get_gravatar_url( get_bloginfo( 'admin_email' ), '220' );
	}

	public function profile_name(){
		return get_theme_mod( 'wp_git_homepage_profile_name' );
	}

	public function profile_username(){
		return get_theme_mod( 'wp_git_homepage_username' );
	}


	public function profile_bio(){
		return get_theme_mod( 'wp_git_homepage_bio' );
	}


	public function profile_company(){
		return get_theme_mod( 'wp_git_homepage_company' );
	}

	public function profile_location(){
		return get_theme_mod( 'wp_git_homepage_location' );
	}

	public function profile_email(){
		return get_theme_mod( 'wp_git_homepage_email' );
	}

	public function profile_website_url(){
		return get_theme_mod( 'wp_git_homepage_url' );
	}


	public function profile_date(){
		return date_i18n( get_option( 'date_format' ), strtotime( get_theme_mod('wp_git_homepage_date') ) );
	}


	public function post_count(){
		global $wpdb;
		$post_types = "'" . implode( "','", apply_filters( 'wp_git_count_post_type', array( 'post' ) ) ) . "'";
		return $wpdb->get_var( $wpdb->prepare( "select count(ID) from $wpdb->posts where post_status=%s and post_type in($post_types)",'publish') );
	}


	public function comment_count(){
		global $wpdb;
		return $wpdb->get_var( "SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1" );
	}

	public function star_count(){
		global $wpdb;
		return $wpdb->get_var( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key ='wp_git_starred_count' " );
	}


	public function popular_posts() {
		$args = array(
			'post_type'   => 'any',
			'numberposts' => apply_filters('wp_git_popular_posts_count',5),
			'meta_key'    => 'wp_git_starred_count',
			'meta_query'  => array(
				'key'     => 'wp_git_starred_count',
				'value'   => '0',
				'compare' => '>',
			),
			'orderby'     => 'meta_value',
			'order'       => 'DESC',
		);

		$most_starred = get_posts( $args );

		if ( $most_starred ) {
			return $most_starred;
		}

		return false;

	}

	public function  latest_posts( ) {
		$args =  array(
			'posts_per_page' => apply_filters( 'wp_git_latest_posts_count', 5 ),
		);

		$latest_posts = get_posts( $args );

		if ( $latest_posts ) {
			return $latest_posts;
		}

		return false;
	}

	public function contribution_data() {
		global $wpdb;
		$current_year = date( 'Y', current_time( 'timestamp' ) );
		$date         = $current_year . '-01-01';
		$post_types   = "'" . implode( "','", apply_filters( 'wp_git_post_types', array( 'post', 'page', 'revision' ) ) ) . "'";


		$data  = array();
		$start = 0;
		$step  = apply_filters( 'wp_git_contribution_cal_query_limit', 5000 );
		while ( $posts = $wpdb->get_results( $wpdb->prepare( "select * from $wpdb->posts where post_date >= %s and post_type in($post_types) limit $start,$step", $date ) ) ) {
			foreach ( $posts as $post ) {
				$key = strtotime( date( 'Y-m-d', strtotime( $post->post_date ) ) );
				$data[ $key ] += 1;
			}
			$start += $step;
			$step += $step;
		}


		return $data;
	}

	public function posts_page(){
		$posts_per_page = apply_filters( 'wp_git_posts_per_page', get_option( 'posts_per_page' ) );
		return new WP_Query( 'post_type=post&posts_per_page='.$posts_per_page );
	}

	public function latest_feed(){
		$latest_feed_time = apply_filters( 'wp_git_latest_feed_time', current_time( 'timestamp' ) - strtotime( "-1 month" ) );
		$latest_comments = get_comments(
			array(
				'status' => 'approve',
				'date_query' => array(
					'after' => $latest_feed_time,
				)
			)
		);

		$latest_posts = get_posts(array(
			'date_query' => array(
				'after' => $latest_feed_time,
			)
		));

		$activities = array();


		foreach ( $latest_comments as $comment ) {
			$item = array(
				'icon' => 'glyphicon-comment',
				'time_ago' => sprintf( _x( '%s ago', '%s = human-readable time difference', 'wp-git' ), human_time_diff( strtotime( $comment->comment_date ), current_time( 'timestamp' ) ) ),
			);

			if ( $comment->user_id > 0 ) {
				$user_profile_url = get_author_posts_url($comment->user_id);
				$item['avatar'] = '<a href="'.$user_profile_url.'"><img src="'.wp_git_get_author_gravatar_url(array('author_id' => $comment->user_id)).'" height="30" width="30"></a>';
				$item['description'] = '<a href="'.$user_profile_url.'">'.get_the_author_meta( 'display_name', $comment->user_id ).'</a> left a comment at a post: <a href="'.get_the_permalink($comment->comment_post_ID).'">'.$comment->comment_content.'</a>';
			}else{
				$item['avatar'] = '<a href="#"><img src="'.wp_git_get_gravatar_url($comment->comment_author_email,30).'" height="30" width="30"></a>';
				$item['description'] = '<a href="#">'.$comment->comment_author.'</a> left a comment at a post: <a href="'.get_the_permalink($comment->comment_post_ID).'">'.$comment->comment_content.'</a>';
			}

			$activities[ strtotime( $comment->comment_date ) ][] = $item;
		}


		foreach ( $latest_posts as $post_item ) {
			$user_profile_url = get_author_posts_url($post_item->post_author);
			$item = array(
				'icon' => 'glyphicon-pencil',
				'time_ago' => sprintf( _x( '%s ago', '%s = human-readable time difference', 'wp-git' ), human_time_diff( strtotime( $post_item->post_date ), current_time( 'timestamp' ) ) ),
				'avatar' => '<a href="'.$user_profile_url.'"><img src="'.wp_git_get_author_gravatar_url(array('author_id' => $post_item->post_author)).'" height="30" width="30"></a>',
				'description' => '<a href="'.$user_profile_url.'">'. get_the_author_meta( 'display_name', $post_item->post_author ).'</a> wrote a blog post: <a href="'.get_the_permalink($post_item->ID).'">'.get_the_title($post_item->ID).'</a>'
			);

			$activities[ strtotime( $post_item->post_date ) ][] = $item;
		}

		$timeline = array();

		krsort( $activities );
		foreach ( $activities as $timestamp => $items ) {
			foreach ( $items as $item ) {
				$timeline[] = $item;
			}
		}

		return $timeline;
	}
}