<?php
/*
 * Plugin Name: Social Network Profile
 * Version: 1.0
 * Plugin URI: https://github.com/VitalDevTeam/social-network-profile/
 * Description: Manage your website's social network profile.
 * Author: Vital
 * Author URI: https://vtldesign.com
 * Text Domain: social-network-profile
 * Requires at least: 4.0
 * Tested up to: 4.7.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Load plugin class files
require_once( 'includes/class-plugin.php' );
require_once( 'includes/class-settings.php' );

// Load plugin libraries
require_once( 'includes/lib/class-admin-api.php' );

// Load public plugin functions
require_once( 'public/functions.php' );

/**
 * Returns the main instance of the plugin to prevent the need to use globals.
 */
function Social_Network_Profile () {
	$instance = SNP_Plugin_Template::instance( __FILE__, '1.0.0' );

	if ( is_null( $instance->settings ) ) {
		$instance->settings = SNP_Settings::instance( $instance );
	}

	return $instance;
}

Social_Network_Profile();