<?php
/*
Plugin Name: MetaTrader Web Terminal
Plugin URI: https://wordpress.org/plugins/metatrader
Description: MetaTrader Web Terminal plugin for WordPress websites
Version: 1.1
Author: MQL5 Ltd.
Author URI: https://www.mql5.com
License: GPLv2 (or later)
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: metatrader
Domain Path: /languages
*/

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	die( 'You are not allowed to call this page directly.' ); }

require_once plugin_dir_path( __FILE__ ) . 'inc/class.metatrader.php';

register_activation_hook( __FILE__, array( 'Meta_Trader_Include', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Meta_Trader_Include', 'deactivate' ) );

$metatrader                  = new Meta_Trader_Include();
$metatrader->plugin_url      = plugin_dir_path( __FILE__ );
$metatrader->plugin_dir_url  = plugin_dir_url( __FILE__ );
$metatrader->plugin_dir_path = plugin_dir_path( __FILE__ );
$metatrader->plugin_dir      = basename( dirname( __FILE__ ) );
$metatrader->plugin_info     = get_file_data(
	__FILE__,
	array(
		'version' => 'Version',
	),
	false
);
$metatrader->run_metatrader();
