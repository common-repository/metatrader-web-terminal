<?php

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	 die( 'You are not allowed to call this page directly.' );
}

if ( ! class_exists( 'Meta_Trader_Shortcode' ) ) {

	class Meta_Trader_Shortcode {
		public $plugin_url;

		public function __construct() {
			return true;
		}

		public function run_shortcode( $name, $atts ) {
			$sys_lang         = substr( get_bloginfo( 'language' ), 0, 2 );
			$options          = array();
			$atts = shortcode_atts(
				array(
					'width'            => isset( $atts['width'] ) ? $atts['width'] : '100%',
					'height'           => isset( $atts['height'] ) ? $atts['height'] : '500px',
					'version'          => isset( $atts['version'] ) ? $atts['version'] : '5',
					'demo_all_servers' => isset( $atts['demo_all_servers'] ) ? $atts['demo_all_servers'] : '1',
					'startup_mode'     => isset( $atts['startup_mode'] ) ? $atts['startup_mode'] : 'create_demo',
					'lang'             => isset( $atts['lang'] ) ? $atts['lang'] : substr( get_bloginfo( 'language' ), 0, 2 ),
					'color_scheme'     => isset( $atts['color_scheme'] ) ? $atts['color_scheme'] : 'black_on_white',
					'servers'          => null,
					'login'            => null,
					'trade_server'     => null,
					'server'           => isset( $atts['server'] ) ? $atts['server'] : $atts['trade_server'],
					'demo_show_phone'  => null,
					'utm_campaign'     => null,
					'utm_source'       => null,
				),
				$atts,
				$name
			);

			foreach ( $atts as $key => $val ) {
				if ( ! empty( $val ) ) {
					$options[$key] = $val;
				}
			}

			if ( isset( $atts['servers'] ) ) {
				$options['servers'] = empty( $atts['servers'] ) ? array() : explode( ',', $atts['servers'] );
			}

			include $this->plugin_url . 'views/widget.php';

			$script = new Meta_Trader_Widget_View( $options );

			return $script->output();
		}
	}
}
