<?php
/**
 * Email Template
 *
 * Registers the new email template
 *
 * @package     EDD Email Templates Customiser
 * @subpackage  Email Template
 * @copyright   Copyright (c) 2013, Sunny Ratilal
 * @since		1.0
 **/

/**
 * Register Email Template
 *
 * Registers the email template but appending to the email templates array
 *
 * @access      private
 * @since       1.0
 *
 * @param       array $email_templates EDD email templates
 * @return      array $email_templates A merged array with EDD email templates and the customised email template
 */
function edd_etc_register_templates( $edd_templates ) {
	$edd_etc_email_templates = array(
		'customised' => __( 'Customised Template', 'edd_etc' ),
	);

	return array_merge( $edd_templates, $edd_etc_email_templates );
}
add_filter( 'edd_email_templates', 'edd_etc_register_templates' );

/**
 * Register Colorpickers as Settings
 *
 * Registers the colorpickers as settings by merging with the EDD settings
 *
 * @access      private
 * @since       1.0
 *
 * @param       array $settings EDD Settings
 * @return      array $settings A merged array with the plugin settings and the EDD settings to be displayed on the Email settings page
 */
function edd_etc_register_colorpickers( $settings ) {
	global $edd_options;

	if ( isset( $edd_options['email_template'] ) && $edd_options['email_template'] == 'customised' ) {
		$edd_etc_settings = array(
			array(
				'id'         => 'edd_etc_email_body_background_color',
				'name'       => __( 'Email Body Background Color', 'edd_etc' ),
				'desc'       => __( 'The background color for the email body wrapper.', 'edd_etc' ),
				'type'       => 'colorpicker',
				'std'        => 'ffffff'
			),
			array(
				'id'         => 'edd_etc_email_border_color',
				'name'       => __( 'Email Body Border Color', 'edd_etc' ),
				'desc'       => __( 'The border color for the email body wrapper.', 'edd_etc' ),
				'type'       => 'colorpicker',
				'std'        => '505050'
			),
			array(
				'id'         => 'edd_etc_heading_text',
				'name'       => __( 'Heading Text Color', 'edd_etc' ),
				'desc'       => __( 'The color of the headings (e.g. h1, h2, h3, etc.).', 'edd_etc' ),
				'type'       => 'colorpicker',
				'std'        => '2f3f57'
			),
			array(
				'id'         => 'edd_etc_body_text',
				'name'       => __( 'Body Text Color', 'edd_etc' ),
				'desc'       => __( 'The color of the body text.', 'edd_etc' ),
				'type'       => 'colorpicker',
				'std'        => '333333'
			),
			array(
				'id'         => 'edd_etc_link_color',
				'name'       => __( 'Links Color', 'edd_etc' ),
				'desc'       => __( 'The color of any links in the email body.', 'edd_etc' ),
				'type'       => 'colorpicker',
				'std'        => '4183c4'
			),
			array(
				'id'         => 'edd_etc_heading_font_weight',
				'name'       => __( 'Headings Font Weight', 'edd_etc' ),
				'desc'       => __( 'The font weight for all of the headings. Default is normal.', 'edd_etc' ),
				'type'       => 'select',
				'options'    => array(
					'normal' => __( 'Normal', 'edd_etc' ),
					'bold'   => __( 'Bold', 'edd_etc' )
				),
				'std' => 'normal'
			)
		);
	} else {
		$edd_etc_settings = array();
	}

	return array_merge( $settings, $edd_etc_settings );
}
add_filter( 'edd_settings_emails', 'edd_etc_register_colorpickers' );

/**
 * Color Picker Callback
 *
 * Callback function for the colorpicker setting type
 *
 * @access      public
 * @since       1.0
 *
 * @param       array $args All the values from the settings array
 */
function edd_colorpicker_callback( $args ) {
	global $edd_options;

	if( isset( $edd_options[ $args['id'] ] ) ) { $value = $edd_options[$args['id']]; } else { $value = isset($args['std']) ? $args['std'] : ''; }
	$html = '<input type"text" id="edd_settings_' . $args['section'] . '[' . $args['id'] . ']" name="edd_settings_' . $args['section'] . '[' . $args['id'] . ']" maxlength="6" size="6" value="'. esc_attr( $value ) .'" class="edd_etc_colorpicker" />';
	$html .= '<label for="edd_settings_' . $args['section'] . '[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';  

	echo $html;
}

/**
 * Customised Email Template
 *
 * Renders the customised email template
 *
 * @access      private
 * @since       1.0
 */
function edd_etc_customised_email_template() {
	global $edd_options;

	if ( isset( $edd_options['edd_etc_heading_font_weight'] ) ) { $value = $edd_options['edd_etc_heading_font_weight']; } else { $value = 'normal'; }

	echo '<div style="width: 550px; background: #'. esc_attr( $edd_options['edd_etc_email_body_background_color'] ) .'; border: 1px solid #'. esc_attr( $edd_options['edd_etc_email_border_color'] ) .'; margin: 0 auto; padding: 4px; outline: none;">';
		echo '<div style="padding: 1px;"">';
			echo '<div id="edd-email-content" style="padding: 10px;">';
				if( isset( $edd_options['email_logo']) ) {
					echo '<img src="' . $edd_options['email_logo'] . '" style="margin:0;position:relative;z-index:2;"/>';
				} else if( isset( $edd_options['eddpdfi_email_logo'] ) ) {
					echo '<img src="' . $edd_options['eddpdfi_email_logo'] . '" style="margin:0;position:relative;z-index:2;"/>';
				}
				echo '<h1 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 24px; font-weight: '. esc_attr( $value ) .'; font-size: 24px;">' . __('Receipt', 'eddpdfi') .'</h1>';
				echo '{email}';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
add_filter( 'edd_email_template_customised', 'edd_etc_customised_email_template' );

/**
 * Extra Styling
 *
 * Apply extra styling using str_replace for the customised email template
 *
 * @access      private
 * @since       1.0
 *
 * @param       string $email_body The body text of the Purchase Receipt email sent by EDD
 * @return      string $email_body The body text of the Purchase Receipt email sent by EDD with all the styling applied
 */
function edd_etc_customised_email_template_extra_styling( $email_body ) {
	global $edd_options;

	if ( isset( $edd_options['edd_etc_heading_font_weight'] ) ) { $value = $edd_options['edd_etc_heading_font_weight']; } else { $value = 'normal'; }

	$email_body = str_replace( '<h1>', '<h1 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 24px; font-weight: '. esc_attr( $value ) .'; font-size: 24px;">', $email_body );
	$email_body = str_replace( '<h2>', '<h2 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 20px; font-weight: '. esc_attr( $value ) .'; font-size: 20px;">', $email_body );
	$email_body = str_replace( '<h3>', '<h3 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 18px; font-weight: '. esc_attr( $value ) .'; font-size: 18px;">', $email_body );
	$email_body = str_replace( '<h4>', '<h4 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 16px; font-weight: '. esc_attr( $value ) .'; font-size: 16px;">', $email_body );
	$email_body = str_replace( '<h5>', '<h5 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 14px; font-weight: '. esc_attr( $value ) .'; font-size: 15px;">', $email_body );
	$email_body = str_replace( '<h6>', '<h6 style="color: #'. esc_attr( $edd_options['edd_etc_heading_text'] ) .'; line-height: 20px; font-weight: '. esc_attr( $value ) .'; font-size: 15px; text-transform: uppercase;">', $email_body );
	$email_body = str_replace( '<a',   '<a style="color: #'. esc_attr( $edd_options['edd_etc_link_color'] ) .'; text-decoration: none;"', $email_body );
	$email_body = str_replace( '<ul>', '<ul style="margin: 0 0 0 20px; padding: 0;">', $email_body );
	$email_body = str_replace( '<li>', '<li style="color: #'. esc_attr( $edd_options['edd_etc_body_text'] ) .'; list-style: square;">', $email_body );
	$email_body = str_replace( '<p>',  '<p style="color: #'. esc_attr( $edd_options['edd_etc_body_text'] ) .';">', $email_body );

	return $email_body;
}
add_filter( 'edd_purchase_receipt_customised', 'edd_etc_customised_email_template_extra_styling' );