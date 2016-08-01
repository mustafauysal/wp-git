<?php


interface WP_Github_Data_Provider_Interface
{
	public function profile_url();
	public function avatar_url();
	public function profile_name();
	public function profile_username();
	public function profile_bio();
	public function profile_company();
	public function profile_location();
	public function profile_email();
	public function profile_website_url();
	public function profile_date();
	public function post_count();
	public function comment_count();
	public function star_count();
	public function popular_posts();
	public function latest_posts();
	public function contribution_data();
	public function posts_page();
	public function latest_feed();
}