<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( '_WP_Editors' ) ) {
	require ABSPATH . WPINC . '/class-wp-editor.php';
}

function metatrader_mce_plugin_translation() {
	$strings    = array(
		'versions.4'                   => esc_attr__( 'MetaTrader 4', 'metatrader' ),
		'versions.5'                   => esc_attr__( 'MetaTrader 5', 'metatrader' ),
		'startupModes.create_demo'     => esc_attr__( 'Automatically create a demo account', 'metatrader' ),
		'startupModes.open_demo'       => esc_attr__( 'Open the Create demo account dialog', 'metatrader' ),
		'startupModes.login'           => esc_attr__( 'Show login dialog', 'metatrader' ),
		'colorSchemes.black_on_white'  => esc_attr__( 'Black on white', 'metatrader' ),
		'colorSchemes.yellow_on_black' => esc_attr__( 'Yellow on black', 'metatrader' ),
		'colorSchemes.green_on_black'  => esc_attr__( 'Green on black', 'metatrader' ),
		'button.title'                 => esc_attr__( 'Insert MetaTrader Web Terminal', 'metatrader' ),
		'modal.title'                  => esc_attr__( 'Metatrader Web Terminal Settings', 'metatrader' ),
		'labels.version'               => esc_attr__( 'Version', 'metatrader' ),
		'headings.connection'          => esc_attr__( 'Connection', 'metatrader' ),
		'labels.restrictServers'       => esc_attr__( 'Restrict trade servers', 'metatrader' ),
		'labels.servers'               => esc_attr__( 'Trade server list (comma separated)', 'metatrader' ),
		'labels.login'                 => esc_attr__( 'Default login', 'metatrader' ),
		'labels.server'                => esc_attr__( 'Default trade server', 'metatrader' ),
		'headings.opening'             => esc_attr__( 'Opening demo accounts', 'metatrader' ),
		'labels.demoAllServers'        => esc_attr__( 'Allow opening demo accounts on any servers', 'metatrader' ),
		'labels.demoShowPhone'         => esc_attr__( 'Allow the field Phone in the dialog of opening a demo account', 'metatrader' ),
		'labels.utmCampaign'           => esc_attr__( 'UTM campaign', 'metatrader' ),
		'labels.utmSource'             => esc_attr__( 'UTM source', 'metatrader' ),
		'headings.interface'           => esc_attr__( 'Interface', 'metatrader' ),
		'labels.width'                 => esc_attr__( 'Width', 'metatrader' ),
		'labels.height'                => esc_attr__( 'Height', 'metatrader' ),
		'labels.startupMode'           => esc_attr__( 'What to do at the start for new visitors?', 'metatrader' ),
		'labels.lang'                  => esc_attr__( 'Language', 'metatrader' ),
		'labels.colorScheme'           => esc_attr__( 'Chart color scheme', 'metatrader' ),
	);
	$locale     = _WP_Editors::$mce_locale;
	$translated = 'tinyMCE.addI18n("' . $locale . '.metatrader", ' . wp_json_encode( $strings ) . ");\n";

	return $translated;
}

$strings = metatrader_mce_plugin_translation();
