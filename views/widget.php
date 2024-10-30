<?php
if ( ! class_exists( 'Meta_Trader_Widget_View' ) ) {
	class Meta_Trader_Widget_View {
		public static $id = 1;

		public function __construct( $options ) {
			self::$id ++;

			$this->widget_id = 'webterminal-' . self::$id;
			$this->config = array_intersect_key(
				$options,
				array_flip(
					array(
						'version',
						'servers',
						'login',
						'server',
						'demo_all_servers',
						'demo_show_phone',
						'utm_campaign',
						'utm_source',
						'startup_mode',
						'lang',
						'color_scheme',
					)
				)
			);
			
			foreach ( $this->config as $key => $val ) {
				unset( $this->config[$key] );

				if ( ! empty( $val ) ) {
					$cc_key = lcfirst(implode('', array_map('ucfirst', explode('_', $key))));
					$this->config[$cc_key] = $val;
				}
			}

			$this->style = array_intersect_key(
				$options,
				array_flip(
					array(
						'width',
						'height',
					)
				)
			);

			return true;
		}

		public function output() {
			$options = wp_json_encode( $this->config );
			$style     = '';

			foreach ( $this->style as $key => $value ) {
				$style .= $key . ':' . $value . '; ';
			}

			$html = file_get_contents( plugin_dir_path( __FILE__ ) . 'widget.html' );
			$html = str_replace( '$options', $options, $html );
			$html = str_replace( '$id', $this->widget_id, $html );
			$html = str_replace( '$style', $style, $html );

			return $html;
		}
	}
}
