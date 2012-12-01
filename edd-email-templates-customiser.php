<?php
/*
Plugin Name: EDD Email Templates Customiser
Plugin URI: http://github.com/sunnyratilal/EDD-Email-Templates-Customiser
Description: Customise the default email template in Easy Digital Downloads
Author: Sunny Ratilal
Author URI: http://twitter.com/sunnyratilal
Version: 1.0
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

/* PHP Hack to Get Plugin Headers in the .POT File */
	$edd_etc_plugin_header_translate = array(
		__( 'EDD Email Templates Customiser', 'edd_etc' ),
    	__( 'Customise the default email template in Easy Digital Downloads', 'edd_etc' ),
    	__( 'Sunny Ratilal', 'edd_etc' ),
    	__( 'http://github.com/sunnyratilal/EDD-Email-Templates-Customiser', 'edd_etc' ),
    );


global $edd_options;

/**
 * Constants
 */
if( !defined( 'EDD_ETC_VERSION' ) ) {
	define( 'EDD_ETC_VERSION', '1.0' );
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
 * Localization.
 *
 * @since 1.0
 */

function edd_etc_textdomain(){
	load_plugin_textdomain( 'edd_etc', false, dirname( plugin_basename( EDD_ETC_PLUGIN_FILE ) ) . '/languages/' );
}
add_action( 'init', 'edd_etc_textdomain' );