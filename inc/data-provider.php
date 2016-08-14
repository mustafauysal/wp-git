<?php

require_once 'data-provider-interface.php';
require_once 'providers/home.php';
require_once 'providers/profile.php';
class WP_Git_Data_Provider {

	private $is_author;
	private $author;
	private $provider;


	public static function factory() {
		static $instance = false;
		if ( ! $instance ) {
			$instance = new self();
		}

		return $instance;
	}

	function __construct() {
		if ( is_author() || is_single() || is_page() ) {
			$this->is_author = true;
			$queried_object = get_queried_object();
			if ( $queried_object instanceof WP_User ) {
				$this->author = get_queried_object();
			}else{
				$this->author = new WP_User($queried_object->post_author);
			}

			$this->provider = new WP_Git_Profile_Data_Provider( $this->author );
		}else{
			$this->provider = new WP_Git_Home_Data_Provider();
		}
	}

	public function __get( $method ) {
		if ( method_exists( $this->provider, $method ) && is_callable( array( $this->provider, $method ) ) ) {
			return call_user_func( array( $this->provider, $method ) );
		}
		return false;
	}

}


function wp_git_prepare_data( $is_author ) {
	return WP_Git_Data_Provider::factory( $is_author );
}

function wp_git_data( $provider_method ) {

	$provider = WP_Git_Data_Provider::factory();
	return $provider->$provider_method;
}