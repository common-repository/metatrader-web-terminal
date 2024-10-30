( function() {
	function decamelize( str ) {
		const separator = '_';

		return str
			.replace( /([a-z\d])([A-Z])/g, '$1' + separator + '$2' )
			.replace( /([A-Z]+)([A-Z][a-z\d]+)/g, '$1' + separator + '$2' )
			.toLowerCase();
	}

	tinymce.create( 'tinymce.plugins.metatrader', {
		init: function( ed, url ) {
			const options = {
				langs: [
					{ value: 'bg', text: 'Български' },
					{ value: 'ar', text: 'العربية' },
					{ value: 'cs', text: 'Čeština' },
					{ value: 'da', text: 'Dansk' },
					{ value: 'de', text: 'Deutsch' },
					{ value: 'el', text: 'Ελληνικά' },
					{ value: 'en', text: 'English' },
					{ value: 'es', text: 'Español' },
					{ value: 'et', text: 'Eesti' },
					{ value: 'fa', text: 'فارسی' },
					{ value: 'fi', text: 'Suomi' },
					{ value: 'fr', text: 'Français' },
					{ value: 'he', text: 'עִבְרִית' },
					{ value: 'hi', text: 'हिन्दी' },
					{ value: 'hr', text: 'Hrvatski' },
					{ value: 'hu', text: 'Magyar' },
					{ value: 'id', text: 'Bahasa Indonesia' },
					{ value: 'it', text: 'Italiano' },
					{ value: 'ja', text: '日本語' },
					{ value: 'ko', text: '한국어' },
					{ value: 'lt', text: 'Lietuvių kalba' },
					{ value: 'lv', text: 'Latviešu valoda' },
					{ value: 'mn', text: 'Монгол' },
					{ value: 'ms', text: 'Bahasa Melayu' },
					{ value: 'nl', text: 'Nederlands' },
					{ value: 'pl', text: 'Polski' },
					{ value: 'pt', text: 'Português' },
					{ value: 'ro', text: 'Română' },
					{ value: 'ru', text: 'Русский' },
					{ value: 'sk', text: 'Slovenčina' },
					{ value: 'sl', text: 'Slovenščina' },
					{ value: 'sr', text: 'Српски језик' },
					{ value: 'sv', text: 'Svenska' },
					{ value: 'tg', text: 'Тоҷикӣ' },
					{ value: 'th', text: 'ไทย' },
					{ value: 'tr', text: 'Türkçe' },
					{ value: 'uk', text: 'Українська' },
					{ value: 'uz', text: 'O‘zbekcha' },
					{ value: 'vi', text: 'Tiếng Việt' },
					{ value: 'zh', text: '中文' },
					{ value: 'zt', text: '漢語' },
				],
				versions: [
					{ value: '4', text: ed.getLang( 'metatrader.versions.4' ) },
					{ value: '5', text: ed.getLang( 'metatrader.versions.5' ) },
				],
				startupModes: [
					{
						value: 'create_demo',
						text: ed.getLang( 'metatrader.startupModes.create_demo' ),
					},
					{
						value: 'open_demo',
						text: ed.getLang( 'metatrader.startupModes.open_demo' ),
					},
					{
						value: 'login',
						text: ed.getLang( 'metatrader.startupModes.login' ),
					},
				],
				colorSchemes: [
					{
						value: 'black_on_white',
						text: ed.getLang( 'metatrader.colorSchemes.black_on_white' ),
					},
					{
						value: 'yellow_on_black',
						text: ed.getLang( 'metatrader.colorSchemes.yellow_on_black' ),
					},
					{
						value: 'green_on_black',
						text: ed.getLang( 'metatrader.colorSchemes.green_on_black' ),
					},
				],
			};

			const edLang = tinymce.i18n.getCode();
			const lang = options.langs.find( function( item ) {
				return item.value === edLang;
			} ) ?
				edLang :
				'en';

			ed.addButton( 'metatrader.insertShortcode', {
				title: ed.getLang( 'metatrader.button.title' ),
				cmd: 'metatrader.insertShortcode.popup',
				image: url + '/icon.svg',
			} );

			ed.addCommand( 'metatrader.insertShortcode.popup', function() {
				ed.windowManager.open( {
					title: ed.getLang( 'metatrader.modal.title' ),
					body: [
						{
							type: 'listbox',
							name: 'version',
							label: ed.getLang( 'metatrader.labels.version' ),
							value: '5',
							values: options.versions,
						},
						{
							type: 'spacer',
						},
						{
							type: 'label',
							text: ed.getLang( 'metatrader.headings.connection' ),
							style: 'font-weight: bold;',
						},
						{
							type: 'spacer',
						},
						{
							type: 'checkbox',
							name: 'restrictServers',
							text: ed.getLang( 'metatrader.labels.restrictServers' ),
							onchange: function( e ) {
								const checked = e.control.checked();
								const inputCtrl = this.getRoot().find( '#servers' )[ 0 ];

								inputCtrl.disabled( ! checked );
								inputCtrl.$el.parent().find( 'label' ).toggleClass( 'mce-disabled', ! checked );
							},
						},
						{
							type: 'textbox',
							name: 'servers',
							label: ed.getLang( 'metatrader.labels.servers' ),
							disabled: true,
						},
						{
							type: 'textbox',
							name: 'login',
							label: ed.getLang( 'metatrader.labels.login' ),
						},
						{
							type: 'textbox',
							name: 'server',
							label: ed.getLang( 'metatrader.labels.server' ),
							value: 'MetaQuotes-Demo',
						},
						{
							type: 'spacer',
						},
						{
							type: 'label',
							text: ed.getLang( 'metatrader.headings.opening' ),
							style: 'font-weight: bold;',
						},
						{
							type: 'spacer',
						},
						{
							type: 'checkbox',
							name: 'demoAllServers',
							text: ed.getLang( 'metatrader.labels.demoAllServers' ),
							checked: true,
						},
						{
							type: 'checkbox',
							name: 'demoShowPhone',
							text: ed.getLang( 'metatrader.labels.demoShowPhone' ),
						},
						{
							type: 'textbox',
							name: 'utmCampaign',
							label: ed.getLang( 'metatrader.labels.utmCampaign' ),
						},
						{
							type: 'textbox',
							name: 'utmSource',
							label: ed.getLang( 'metatrader.labels.utmSource' ),
						},
						{
							type: 'spacer',
						},
						{
							type: 'label',
							text: ed.getLang( 'metatrader.headings.interface' ),
							style: 'font-weight: bold;',
						},
						{
							type: 'spacer',
						},
						{
							type: 'textbox',
							name: 'width',
							label: ed.getLang( 'metatrader.labels.width' ),
							value: '100%',
						},
						{
							type: 'textbox',
							name: 'height',
							label: ed.getLang( 'metatrader.labels.height' ),
							value: '500px',
						},
						{
							type: 'listbox',
							name: 'startupMode',
							label: ed.getLang( 'metatrader.labels.startupMode' ),
							value: 'create_demo',
							values: options.startupModes,
						},
						{
							type: 'listbox',
							name: 'lang',
							label: ed.getLang( 'metatrader.labels.lang' ),
							value: lang,
							values: options.langs,
						},
						{
							type: 'listbox',
							name: 'colorScheme',
							label: ed.getLang( 'metatrader.labels.colorScheme' ),
							value: 'black_on_white',
							values: options.colorSchemes,
						},
					],
					onsubmit: function( e ) {
						const filter = [ 'restrictServers' ];
						const filtered = {};
						let params = '';

						Object.keys( e.data ).forEach( function( key ) {
							let val = e.data[ key ];

							val = val === true ? '1' : val;

							if ( filter.indexOf( key ) === -1 && !! val ) {
								filtered[ decamelize( key ) ] = val;
							}
						} );

						if ( e.data.restrictServers ) {
							filtered.servers = filtered.servers || '';
						} else {
							delete filtered.servers;
						}

						Object.keys( filtered ).forEach( function( key ) {
							params += ' ' + key + '="' + filtered[ key ] + '"';
						} );

						ed.insertContent( '[metatrader ' + params + ' ]' );
					},
				} );
			} );
		},

		createControl: function() {
			return null;
		},

		getInfo: function() {
			return {
				longname: 'MetaTrader',
				author: 'MQL5 Ltd.',
				authorurl: 'http://mql5.com',
				version: '1.0.0',
			};
		},
	} );

	tinymce.PluginManager.add( 'metatrader', tinymce.plugins.metatrader );
}() );
