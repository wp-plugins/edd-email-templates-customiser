<?php
/*
Plugin Name: EDD Email Templates Customiser
Plugin URI: http://github.com/sunnyratilal/EDD-Email-Templates-Customiser
Description: Customise the default email template in Easy Digital Downloads
Author: Sunny Ratilal
Author URI: http://twitter.com/sunnyratilal
Version: 1.1
Text Domain: edd_etc
Domain Path: languages


EDD Email Templates Customiser is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or 
any later version.

EDD Email Templates Customiser is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with EDD Email Templates Customiser. If not, see <http://www.gnu.org/licenses/>.
*/

global $edd_options;

/**
 * Constants
 */
if( !defined( 'EDD_ETC_VERSION' ) ) {
	define( 'EDD_ETC_VERSION', '1.1' );
}
if( !defined( 'EDD_ETC_PLUGIN_URL' ) ) {
	define( 'EDD_ETC_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}
if( !defined( 'EDD_ETC_PLUGIN_DIR' ) ) {
	define( 'EDD_ETC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
if( !defined( 'EDD_ETC_PLUGIN_FILE' ) ) {
	define( 'EDD_ETC_PLUGIN_FILE', __FILE__ );
}

include_once( EDD_ETC_PLUGIN_DIR . 'includes/scripts.php' );
include_once( EDD_ETC_PLUGIN_DIR . 'includes/email-template.php' );

/**
 * Localization
 *
 * @since 1.0
 *
 * @uses dirname()
 * @uses plugin_basename()
 * @uses apply_filters()
 * @uses get_locale()
 * @uses load_textdomain()
 * @uses load_plugin_textdomain()
 */
function edd_etc_textdomain() {
	// Set filter for plugin's languages directory
	$edd_etc_lang_dir = dirname( plugin_basename( EDD_ETC_PLUGIN_FILE ) ) . '/languages/';
	$edd_etc_lang_dir = apply_filters( 'edd_etc_languages_directory', $edd_etc_lang_dir );

	// Traditional WordPress plugin locale filter
	$locale = apply_filters( 'plugin_locale', get_locale(), 'edd_etc' );
	$mofile = sprintf( '%1$s-%2$s.mo', 'edd_etc', $locale );

	// Setup paths to current locale file
	$mofile_local = $edd_etc_lang_dir . $mofile;
	$mofile_global = WP_LANG_DIR . '/edd/edd_etc/' . $mofile;

	if ( file_exists( $mofile_global ) ) {
		// Look in global /wp-content/languages/edd/edd_etc folder
		load_textdomain( 'edd_etc', $mofile_global );
	} elseif ( file_exists( $mofile_local ) ) {
		// Look in local /wp-content/plugins/edd-email-templates-customiser/languages/ folder
		load_textdomain( 'edd_etc', $mofile_local );
	} else {
		// Load the default language files
		load_plugin_textdomain( 'edd_etc', false, $edd_etc_lang_dir );
	}
}
add_action( 'init', 'edd_etc_textdomain', 1 );