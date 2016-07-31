<?php

class WP_Github_Profile_Data_Provider implements WP_Github_Data_Provider_Interface{
	private $post;
	private $author;

	function __construct( WP_User $author ) {
		$this->author = $author;
	}

	public function profile_url(){
		return get_author_posts_url($this->author->data->ID);
	}

	public function avatar_url(){
		global $wp_query;
		return wp_github_get_gravatar_url( $this->author->data->user_email, '220' );
	}

	public function profile_name(){
		return $this->author->data->display_name;
	}

	public function profile_username(){
		return $this->author->data->user_nicename;
	}


	public function profile_bio(){
		return get_the_author_meta( 'wp_github_bio', $this->author->data->ID );
	}


	public function profile_company(){
		return get_the_author_meta( 'wp_github_company', $this->author->data->ID );
	}

	public function profile_location(){
		return get_the_author_meta( 'wp_github_location', $this->author->data->ID );
	}

	public function profile_email(){
		return $this->author->data->user_email;
	}

	public function profile_website_url(){
		return $this->author->data->user_url;
	}


	public function profile_date(){
		return date_i18n( get_option( 'date_format' ), strtotime( $this->author->data->user_registered ) );
	}


	public function post_count(){
		global $wpdb;
		$post_types   = "'" . implode( "','", apply_filters( 'wp_github_post_types', array( 'post', 'page', 'revision' ) ) ) . "'";
		return $wpdb->get_var( $wpdb->prepare( "select count(ID) from $wpdb->posts where post_author=%s and post_status=%s and post_type in($post_types)", $this->author->ID,'publish' ) );
	}


	public function comment_count(){
		global $wpdb;
		return $wpdb->get_var( $wpdb->prepare( "SELECT COUNT(*) AS total FROM $wpdb->comments WHERE comment_approved = 1 AND user_id = %s", $this->author->ID ) );
	}

	public function star_count(){
		global $wpdb;
		return $wpdb->get_var( $wpdb->prepare( "SELECT SUM(meta_value) AS total FROM $wpdb->postmeta WHERE meta_key ='wp_github_starred_count' and post_id in (select id from wp_posts where post_author=%s and post_status='publish')", $this->author->ID ) );
	}

	public function popular_posts() {
		$args = array(
			'post_type'   => 'any',
			'author' => $this->author->data->ID,
			'numberposts' => apply_filters('wp_github_popular_posts_count',5),
			'meta_key'    => 'wp_github_starred_count',
			'meta_query'  => array(
				'key'     => 'wp_github_starred_count',
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
		$args = array(
			'posts_per_page' => apply_filters( 'wp_github_latest_posts_count', 5 ),
			'author' => $this->author->data->ID,
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
		$post_types   = "'" . implode( "','", apply_filters( 'wp_github_post_types', array( 'post', 'page', 'revision' ) ) ) . "'";

		$data  = array();
		$start = 0;
		$step  = apply_filters( 'wp_github_contribution_cal_query_limit', 5000 );
		while ( $posts = $wpdb->get_results( $wpdb->prepare( "select * from $wpdb->posts where post_author=%s and post_date >= %s and post_type in($post_types) limit $start,$step",$this->author->data->ID, $date ) ) ) {
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
		$posts_per_page = apply_filters( 'wp_github_posts_per_page', get_option( 'posts_per_page' ) );
		return new WP_Query( 'post_type=post&posts_per_page='.$posts_per_page.'&author='.$this->author->data->ID );
	}

}