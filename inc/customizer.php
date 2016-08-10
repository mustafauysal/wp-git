<?php
/**
 *  Theme Customizer.
 *
 * @package wp-git
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wp_github_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';


//	$wp_customize->add_section( 'wp_github_homepage_settings' , array(
//		'title'      => __( 'Homepage Settings', 'wp-git' ),
//		'priority'   => 30,
//		'capability' => 'edit_theme_options',
//
//	) );
	// Add a footer/copyright information section.




	$wp_customize->add_section( 'wp_github_home', array(
		'priority'       => 10,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Home Profile Section', 'textdomain' ),
		'description'    => '',
	) );

	$wp_customize->add_setting( 'wp_github_homepage_profile_name', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_profile_name', array(
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Display name for homepage', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_username', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_username', array(
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Username for homepage', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_bio', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_bio', array(
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Bio', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_company', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_company', array(
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Company', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_location', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_location', array(
		'type'        => 'text',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Location', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_email', array(
		'default'           => get_bloginfo( 'admin_email' ),
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_email', array(
		'type'        => 'email',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Email', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_url', array(
		'default'           => home_url('/'),
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'esc_attr',
	) );

	$wp_customize->add_control( 'wp_github_homepage_url', array(
		'type'        => 'url',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'URL', 'wp-git' ),
	) );

	$wp_customize->add_setting( 'wp_github_homepage_date', array(
		'default'           => '',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => '',
		'sanitize_callback' => 'wp_github_format_date',
	) );

	$wp_customize->add_control( 'wp_github_homepage_date', array(
		'type'        => 'date',
		'priority'    => 10,
		'section'     => 'wp_github_home',
		'description' => __( 'Start date', 'wp-git' ),
	) );


	$wp_customize->get_setting( 'wp_github_homepage_profile_name' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_username' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_bio' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_company' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_location' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_email' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_url' )->transport = 'postMessage';
	$wp_customize->get_setting( 'wp_github_homepage_date' )->transport = 'postMessage';



}
add_action( 'customize_register', 'wp_github_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function wp_github_customize_preview_js() {
	wp_enqueue_script( 'github_customizer', get_template_directory_uri() . '/assets/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'wp_github_customize_preview_js' );

function wp_github_format_date( $data ) {
	return date_i18n( get_option( 'date_format' ), strtotime( $data ) );
}
