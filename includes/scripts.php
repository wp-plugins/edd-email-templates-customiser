<?php
/**
 * Scripts
 *
 * Registers and enqueues all the scripts required by the add-on.
 *
 * @package     EDD Email Templates Customsier
 * @subpackage  Scripts
 * @copyright   Copyright (c) 2013, Sunny Ratilal
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 **/


/**
 * Load Admin Scripts
 *
 * Enqueues the required admin scripts.
 *
 * @access      private
 * @since       1.0
 * @return      void
*/

function edd_etc_load_admin_scripts( $hook ) {
	global $post, $pagenow, $edd_settings_page, $edd_options;

	$edd_pages = array( $edd_settings_page );

	if ( ! in_array( $hook, $edd_pages ) && ! is_object( $post ) )
		return;

	if ( $hook == $edd_settings_page ) {
		wp_register_script( 'edd_etc_colorpicker_js', EDD_ETC_PLUGIN_URL . 'includes/colorpicker/js/colorpicker.js', array( 'jquery' ), EDD_ETC_VERSION, false );
		wp_register_script( 'edd_etc_admin_js', EDD_ETC_PLUGIN_URL . 'includes/js/admin.js', array( 'jquery', 'edd_etc_colorpicker_js' ), EDD_ETC_VERSION, false );
		wp_register_style( 'edd_etc_colorpicker_style', EDD_ETC_PLUGIN_URL . 'includes/colorpicker/css/colorpicker.css', array(  ) , EDD_ETC_VERSION, false );

		wp_enqueue_script( 'edd_etc_colorpicker_js' );
		wp_enqueue_script( 'edd_etc_admin_js' );
		wp_enqueue_style( 'edd_etc_colorpicker_style' );
	}
}
add_action( 'admin_enqueue_scripts', 'edd_etc_load_admin_scripts', 100 );