<?php

if ( preg_match( '#' . basename( __FILE__ ) . '#', $_SERVER['PHP_SELF'] ) ) {
	die( 'You are not allowed to call this page directly.' );
}
if ( ! defined( 'METATRADER_TRACK_INSTALL_URL' ) ) {
	define( 'METATRADER_TRACK_INSTALL_URL', 'https://content.mql5.com/tr?event=MetaTrader%2BWeb%2BWordPress%2BPlugin%2BActivate&id=kibyjlbfgrgskpfxoibtktkdkjiwohnyow&ref=https%3A%2F%2Ftrade.mql5.com%2F' );
}
if ( ! defined( 'METATRADER_TRACK_UNINSTALL_URL' ) ) {
	define( 'METATRADER_TRACK_UNINSTALL_URL', 'https://content.mql5.com/tr?event=MetaTrader%2BWeb%2BWordPress%2BPlugin%2BDeactivate&id=kibyjlbfgrgskpfxoibtktkdkjiwohnyow&ref=https%3A%2F%2Ftrade.mql5.com%2F' );
}
if ( ! class_exists( 'Meta_Trader_Include' ) ) {
	class Meta_Trader_Include {
		public $plugin_url;
		public $plugin_dir;
		public $plugin_dir_path;
		public $plugin_dir_url;
		public $plugin_info;

		public function __construct() {
			require_once plugin_dir_path( __FILE__ ) . 'class.shortcode.php';
			require_once plugin_dir_path( __FILE__ ) . 'class.widget.php';
		}

		public function metatrader_init() {
			load_plugin_textdomain( 'metatrader', false, $this->plugin_dir . '/languages/' );
		}

		public static function activate() {
			wp_remote_get(
				METATRADER_TRACK_INSTALL_URL,
				array(
					'headers' => array(
						'user-agent' => self::user_agent(),
					),
				)
			);
			return true;
		}

		public static function deactivate() {
			wp_remote_get(
				METATRADER_TRACK_UNINSTALL_URL,
				array(
					'headers' => array(
						'user-agent' => self::user_agent(),
					),
				)
			);
			return true;
		}

		public static function user_agent() {
			return 'WordPress/' . get_bloginfo( 'version' ) . '; ' . get_bloginfo( 'url' );
		}

		public function metatrader_main_script() {
			wp_enqueue_script( 'metatrader-widget', 'https://trade.mql5.com/trade/widget.js', false, null );
		}

		public function metatrader_shortcode( $atts ) {
			$this->shortcode  = new Meta_Trader_Shortcode();
			$this->shortcode->plugin_url = $this->plugin_url;

			return $this->shortcode->run_shortcode( 'metatrader', $atts );
		}

		public function metatrader_widget() {
			$this->widget     = new Meta_Trader_Widget();
			$this->widget->plugin_url = $this->plugin_url;
			register_widget( $this->widget );
		}

		public function metatrader_block_assets() {
			wp_enqueue_style(
				'metatrader-block-style-css',
				plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ),
				array( 'wp-editor' ),
				$this->plugin_info['version']
			);
		}

		public function metatrader_block_editor_assets() {
			wp_enqueue_script(
				'metatrader-block-js',
				plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ),
				array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
				true
			);

			wp_enqueue_style(
				'metatrader-block-editor-css',
				plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ),
				array( 'wp-edit-blocks' ),
				$this->plugin_info['version']
			);

			if ( function_exists( 'wp_set_script_translations' ) ) {
				wp_set_script_translations(
					'metatrader-block-js',
					'metatrader',
					$this->plugin_url . 'languages'
				);
			}
		}

		public function metatrader_head() {
			echo "<meta http-equiv='x-dns-prefetch-control' content='on' />\n";
			echo "<link rel='dns-prefetch' href='https://trade.mql5.com' />\n";
		}

		public function metatrader_enqueue_admin_style() {
			wp_enqueue_style(
				'metatrader-admin-css',
				plugins_url( 'css/wp-admin.css', dirname( __FILE__ ) ),
				false,
				$this->plugin_info['version']
			);
		}

		public function metatrader_register_buttons_editor( $buttons ) {
			array_push( $buttons, 'metatrader.insertShortcode' );
			return $buttons;
		}

		public function metatrader_enqueue_mce_scripts( $plugin_array ) {
			$plugin_array['metatrader'] = $this->plugin_dir_url . 'mce/plugin.js';
			return $plugin_array;
		}

		public function metatrader_load_mce_languages( $locales ) {
			$locales['metatrader'] = $this->plugin_dir_path . 'mce/langs.php';
			return $locales;
		}

		public function metatrader_add_mce_custom_locale() {
			?>
			<script type='text/javascript'>
				tinyMCE.addI18n('<?php echo esc_html( explode( '_', get_user_locale() )[0] ); ?>.metatrader',
					{
						'versions.4'                   : '<?php esc_attr_e( 'MetaTrader 4', 'metatrader' ); ?>',
						'versions.5'                   : '<?php esc_attr_e( 'MetaTrader 5', 'metatrader' ); ?>',
						'startupModes.create_demo'     : '<?php esc_attr_e( 'Automatically create a demo account', 'metatrader' ); ?>',
						'startupModes.open_demo'       : '<?php esc_attr_e( 'Open the Create demo account dialog', 'metatrader' ); ?>',
						'startupModes.login'           : '<?php esc_attr_e( 'Show login dialog', 'metatrader' ); ?>',
						'colorSchemes.black_on_white'  : '<?php esc_attr_e( 'Black on white', 'metatrader' ); ?>',
						'colorSchemes.yellow_on_black' : '<?php esc_attr_e( 'Yellow on black', 'metatrader' ); ?>',
						'colorSchemes.green_on_black'  : '<?php esc_attr_e( 'Green on black', 'metatrader' ); ?>',
						'button.title'                 : '<?php esc_attr_e( 'Insert MetaTrader Web Terminal', 'metatrader' ); ?>',
						'modal.title'                  : '<?php esc_attr_e( 'Metatrader Web Terminal Settings', 'metatrader' ); ?>',
						'labels.version'               : '<?php esc_attr_e( 'Version', 'metatrader' ); ?>',
						'headings.connection'          : '<?php esc_attr_e( 'Connection', 'metatrader' ); ?>',
						'labels.restrictServers'       : '<?php esc_attr_e( 'Restrict trade servers', 'metatrader' ); ?>',
						'labels.servers'               : '<?php esc_attr_e( 'Trade server list (comma separated)', 'metatrader' ); ?>',
						'labels.login'                 : '<?php esc_attr_e( 'Default login', 'metatrader' ); ?>',
						'labels.server'                : '<?php esc_attr_e( 'Default trade server', 'metatrader' ); ?>',
						'headings.opening'             : '<?php esc_attr_e( 'Opening demo accounts', 'metatrader' ); ?>',
						'labels.demoAllServers'        : '<?php esc_attr_e( 'Allow opening demo accounts on any servers', 'metatrader' ); ?>',
						'labels.demoShowPhone'         : '<?php esc_attr_e( 'Allow the field Phone in the dialog of opening a demo account', 'metatrader' ); ?>',
						'labels.utmCampaign'           : '<?php esc_attr_e( 'UTM campaign', 'metatrader' ); ?>',
						'labels.utmSource'             : '<?php esc_attr_e( 'UTM source', 'metatrader' ); ?>',
						'headings.interface'           : '<?php esc_attr_e( 'Interface', 'metatrader' ); ?>',
						'labels.width'                 : '<?php esc_attr_e( 'Width', 'metatrader' ); ?>',
						'labels.height'                : '<?php esc_attr_e( 'Height', 'metatrader' ); ?>',
						'labels.startupMode'           : '<?php esc_attr_e( 'What to do at the start for new visitors?', 'metatrader' ); ?>',
						'labels.lang'                  : '<?php esc_attr_e( 'Language', 'metatrader' ); ?>',
						'labels.colorScheme'           : '<?php esc_attr_e( 'Chart color scheme', 'metatrader' ); ?>',
					});
			</script>
			<?php
		}

		public function run_metatrader() {
			add_action( 'plugins_loaded', array( &$this, 'metatrader_init' ) );
			add_action( 'wp_head', array( &$this, 'metatrader_head' ) );
			add_action( 'widgets_init', array( &$this, 'metatrader_widget' ) );
			add_shortcode( 'metatrader', array( &$this, 'metatrader_shortcode' ) );
			add_action( 'wp_enqueue_scripts', array( &$this, 'metatrader_main_script' ) );
			add_action( 'enqueue_block_assets', array( &$this, 'metatrader_block_assets' ) );
			add_action( 'enqueue_block_editor_assets', array( &$this, 'metatrader_block_editor_assets' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'metatrader_enqueue_admin_style' ) );
			add_filter( 'mce_buttons', array( &$this, 'metatrader_register_buttons_editor' ) );
			add_filter( 'mce_external_plugins', array( &$this, 'metatrader_enqueue_mce_scripts' ) );
			add_filter( 'mce_external_languages', array( &$this, 'metatrader_load_mce_languages' ) );

			if ( version_compare( get_bloginfo( 'version' ), '5.0', '>=' ) ) {
				add_action( 'print_default_editor_scripts', array( &$this, 'metatrader_add_mce_custom_locale' ) );
			}
		}
	}
}
