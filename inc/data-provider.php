<?php

require_once 'data-provider-interface.php';
require_once 'providers/home.php';
require_once 'providers/profile.php';
class WP_Github_Data_Provider {

	private $is_author;
	private $author;
	private $provider;
	private $data;


	public static function factory( $is_author ) {
		static $instance = false;
		if ( ! $instance ) {
			$instance = new self( $is_author );
		}

		return $instance;
	}

	function __construct( $is_author = null ) {
		if ( true === $is_author ) {
			$this->is_author = true;
			$this->author    = get_queried_object();
			$this->provider = new WP_Github_Profile_Data_Provider( $this->author );
		}else{
			$this->provider = new WP_Github_Home_Data_Provider();
		}

	}

	public function __get( $method ) {
		if ( method_exists( $this->provider, $method ) && is_callable( array( $this->provider, $method ) ) ) {
			return call_user_func( array( $this->provider, $method ) );
		}
		return false;
	}

}


function wp_github_prepare_data( $is_author ) {
	return WP_Github_Data_Provider::factory( $is_author );
}

function wp_github_data( $provider_method ) {

	$provider = WP_Github_Data_Provider::factory( is_author() );
	return $provider->$provider_method;
}