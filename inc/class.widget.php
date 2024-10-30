<?php

class Meta_Trader_Widget extends WP_Widget {
	public $plugin_url;

	public function __construct() {
		parent::__construct(
			'metatrader_widget',
			__( 'MetaTrader Web Terminal', 'metatrader' ),
			array( 'description' => __( 'Displays the web terminal to connect to the platforms MetaTrader 4 and MetaTrader 5', 'metatrader' ) )
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		include $this->plugin_url . 'views/widget.php';
		$options = array();

		$options['width']            = $instance['width'];
		$options['height']           = $instance['height'];
		$options['version']          = (int) $instance['version'];
		$options['login']            = $instance['login'];
		$options['server']           = $instance['server'];
		$options['demo_all_servers'] = $instance['demo_all_servers'] === '1' ? true : false;
		$options['demo_show_phone']  = $instance['demo_show_phone'] === '1' ? true : false;
		$options['utm_campaign']     = $instance['utm_campaign'];
		$options['utm_source']       = $instance['utm_source'];
		$options['startup_mode']     = $instance['startup_mode'];
		$options['lang']             = $instance['lang'];
		$options['color_scheme']     = $instance['color_scheme'];

		foreach ( $options as $key => $val ) {
			if ( empty( $val ) ) {
				unset( $options[ $key ] );
			}
		}

		if ( $instance['restrict_servers'] === '1' ) {
			$options['servers'] = empty( $instance['servers'] ) ? array() : explode( ',', $instance['servers'] );
		}

		$title  = apply_filters( 'widget_title', $instance['title'] );
		
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$script = new Meta_Trader_Widget_View( $options );

		echo $script->output();
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$versions = array(
			4 => esc_html__( 'MetaTrader 4', 'metatrader' ),
			5 => esc_html__( 'MetaTrader 5', 'metatrader' ),
		);

		$startup_modes = array(
			'create_demo' => esc_html__( 'Automatically create a demo account', 'metatrader' ),
			'open_demo'   => esc_html__( 'Open the Create demo account dialog', 'metatrader' ),
			'login'       => esc_html__( 'Show login dialog', 'metatrader' ),
		);

		$color_schemes = array(
			'black_on_white'  => esc_html__( 'Black on white', 'metatrader' ),
			'yellow_on_black' => esc_html__( 'Yellow on black', 'metatrader' ),
			'green_on_black'  => esc_html__( 'Green on black', 'metatrader' ),
		);

		$langs = array(
			'ar' => 'العربية',
			'bg' => 'Български',
			'cs' => 'Čeština',
			'da' => 'Dansk',
			'de' => 'Deutsch',
			'el' => 'Ελληνικά',
			'en' => 'English',
			'es' => 'Español',
			'et' => 'Eesti',
			'fa' => 'فارسی',
			'fi' => 'Suomi',
			'fr' => 'Français',
			'he' => 'עִבְרִית',
			'hi' => 'हिन्दी',
			'hr' => 'Hrvatski',
			'hu' => 'Magyar',
			'id' => 'Bahasa Indonesia',
			'it' => 'Italiano',
			'ja' => '日本語',
			'ko' => '한국어',
			'lt' => 'Lietuvių kalba',
			'lv' => 'Latviešu valoda',
			'mn' => 'Монгол',
			'ms' => 'Bahasa Melayu',
			'nl' => 'Nederlands',
			'pl' => 'Polski',
			'pt' => 'Português',
			'ro' => 'Română',
			'ru' => 'Русский',
			'sk' => 'Slovenčina',
			'sl' => 'Slovenščina',
			'sr' => 'Српски језик',
			'sv' => 'Svenska',
			'tg' => 'Тоҷикӣ',
			'th' => 'ไทย',
			'tr' => 'Türkçe',
			'uk' => 'Українська',
			'uz' => 'O‘zbekcha',
			'vi' => 'Tiếng Việt',
			'zh' => '中文',
			'zt' => '漢語',
		);

		$sys_lang         = substr( get_bloginfo( 'language' ), 0, 2 );
		$title            = isset( $instance['title'] ) ? $instance['title'] : '';
		$width            = isset( $instance['width'] ) ? $instance['width'] : '100%';
		$height           = isset( $instance['height'] ) ? $instance['height'] : '500px';
		$version          = isset( $instance['version'] ) ? $instance['version'] : '5';
		$restrict_servers = isset( $instance['restrict_servers'] ) ? $instance['restrict_servers'] : '0';
		$servers          = isset( $instance['servers'] ) ? $instance['servers'] : '';
		$login            = isset( $instance['login'] ) ? $instance['login'] : '';
		$server           = isset( $instance['server'] ) ? $instance['server'] : 'MetaQuotes-Demo';
		$demo_all_servers = isset( $instance['demo_all_servers'] ) ? $instance['demo_all_servers'] : '1';
		$demo_show_phone  = isset( $instance['demo_show_phone'] ) ? $instance['demo_show_phone'] : '0';
		$utm_campaign     = isset( $instance['utm_campaign'] ) ? $instance['utm_campaign'] : '';
		$utm_source       = isset( $instance['utm_source'] ) ? $instance['utm_source'] : '';
		$startup_mode     = isset( $instance['startup_mode'] ) ? $instance['startup_mode'] : 'create_demo';
		$lang             = isset( $instance['lang'] ) ? $instance['lang'] : ( isset( $langs[ $sys_lang ] ) ? $sys_lang : 'en' );
		$color_scheme     = isset( $instance['color_scheme'] ) ? $instance['color_scheme'] : 'black_on_white';

		include $this->plugin_url . 'views/widget-settings.php';
	}


	public function update( $new_instance, $old_instance ) {
		$instance                     = array();
		$instance['title']            = ( ! empty( $new_instance['title'] ) ) ? wp_strip_all_tags( $new_instance['title'] ) : '';
		$instance['width']            = ( ! empty( $new_instance['width'] ) ) ? wp_strip_all_tags( $new_instance['width'] ) : $old_instance['width'];
		$instance['height']           = ( ! empty( $new_instance['height'] ) ) ? wp_strip_all_tags( $new_instance['height'] ) : $old_instance['height'];
		$instance['version']          = ( ! empty( $new_instance['version'] ) ) ? wp_strip_all_tags( $new_instance['version'] ) : $old_instance['version'];
		$instance['restrict_servers'] = ( ! empty( $new_instance['restrict_servers'] ) ) ? wp_strip_all_tags( $new_instance['restrict_servers'] ) : '0';
		$instance['servers']          = ( isset( $new_instance['servers'] ) ) ? wp_strip_all_tags( $new_instance['servers'] ) : $old_instance['servers'];
		$instance['login']            = ( ! empty( $new_instance['login'] ) ) ? wp_strip_all_tags( $new_instance['login'] ) : '';
		$instance['server']           = ( ! empty( $new_instance['server'] ) ) ? wp_strip_all_tags( $new_instance['server'] ) : '';
		$instance['demo_all_servers'] = ( ! empty( $new_instance['demo_all_servers'] ) ) ? wp_strip_all_tags( $new_instance['demo_all_servers'] ) : '';
		$instance['demo_show_phone']  = ( ! empty( $new_instance['demo_show_phone'] ) ) ? wp_strip_all_tags( $new_instance['demo_show_phone'] ) : '';
		$instance['utm_campaign']     = ( ! empty( $new_instance['utm_campaign'] ) ) ? wp_strip_all_tags( $new_instance['utm_campaign'] ) : '';
		$instance['utm_source']       = ( ! empty( $new_instance['utm_source'] ) ) ? wp_strip_all_tags( $new_instance['utm_source'] ) : '';
		$instance['startup_mode']     = ( ! empty( $new_instance['startup_mode'] ) ) ? wp_strip_all_tags( $new_instance['startup_mode'] ) : $old_instance['startup_mode'];
		$instance['lang']             = ( ! empty( $new_instance['lang'] ) ) ? wp_strip_all_tags( $new_instance['lang'] ) : '';
		$instance['color_scheme']     = ( ! empty( $new_instance['color_scheme'] ) ) ? wp_strip_all_tags( $new_instance['color_scheme'] ) : $old_instance['color_scheme'];

		return $instance;
	}

}
