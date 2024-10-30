import _ from 'lodash';
import options from '../options.json';

const { __ } = wp.i18n;
const { Component } = wp.element;
const {
	PanelBody,
	TextControl,
	ToggleControl,
	Disabled,
	SelectControl,
} = wp.components;
const { InspectorControls } = wp.editor;

function translateLabels(items) {
	return items.map(item => ({
		...item,
		label: __(item.label, 'metatrader'),
	}));
}

const langs = options.langs;
const versions = translateLabels(options.versions);
const startupModes = translateLabels(options.startupModes);
const colorSchemes = translateLabels(options.colorSchemes);

const InputGroup = ({ disabled, children }) => {
	if (disabled) {
		return <Disabled>{children}</Disabled>;
	}
	return <div>{children}</div>;
};

export default class Inspector extends Component {
	constructor(props) {
		super(props);
		this.setAttributes = this.setAttributes.bind(this);
	}
	componentDidMount() {
		this.setAttributes({ id: 'webterminal-' + Date.now() });

		if (_.isEmpty(this.props.attributes.lang)) {
			const lang = _.get(document, 'documentElement.lang', '').split('-')[0];

			if (_.find(langs, ['value', lang])) {
				this.setAttributes({ lang });
			}
		}
	}

	render() {
		const { attributes } = this.props;
		const setAttributes = this.setAttributes;

		return (
			<InspectorControls>
				<PanelBody>
					<SelectControl
						label={__('Version', 'metatrader') + ':'}
						value={attributes.version}
						onChange={version => {
							setAttributes({ version });
						}}
						options={versions}
					/>
				</PanelBody>
				<PanelBody title={__('Connection', 'metatrader')}>
					<ToggleControl
						label={__('Restrict trade servers', 'metatrader')}
						checked={attributes.restrictServers}
						onChange={restrictServers => {
							setAttributes({ restrictServers });
						}}
					/>
					<InputGroup disabled={!attributes.restrictServers}>
						<TextControl
							required
							label={
								__('Trade server list (comma separated)', 'metatrader') + ':'
							}
							value={attributes.servers}
							onChange={servers => setAttributes({ servers })}
						/>
					</InputGroup>
					<TextControl
						label={__('Default login', 'metatrader') + ':'}
						value={attributes.login}
						onChange={login => setAttributes({ login })}
					/>
					<TextControl
						label={__('Default trade server', 'metatrader') + ':'}
						value={attributes.server}
						onChange={server => setAttributes({ server })}
					/>
				</PanelBody>
				<PanelBody title={__('Opening demo accounts', 'metatrader')}>
					<ToggleControl
						label={__(
							'Allow opening demo accounts on any servers',
							'metatrader'
						)}
						checked={attributes.demoAllServers}
						onChange={demoAllServers => {
							setAttributes({ demoAllServers });
						}}
					/>

					<ToggleControl
						label={__(
							'Allow the field Phone in the dialog of opening a demo account',
							'metatrader'
						)}
						checked={attributes.demoShowPhone}
						onChange={demoShowPhone => {
							setAttributes({ demoShowPhone });
						}}
					/>

					<TextControl
						label={__('UTM campaign', 'metatrader') + ':'}
						value={attributes.utmCampaign}
						onChange={utmCampaign => setAttributes({ utmCampaign })}
					/>
					<TextControl
						label={__('UTM source', 'metatrader') + ':'}
						value={attributes.utmSource}
						onChange={utmSource => setAttributes({ utmSource })}
					/>
				</PanelBody>
				<PanelBody title={__('Interface', 'metatrader')}>
					<TextControl
						required
						label={__('Width', 'metatrader') + ':'}
						value={attributes.width}
						onChange={width => setAttributes({ width })}
					/>
					<TextControl
						required
						label={__('Height', 'metatrader') + ':'}
						value={attributes.height}
						onChange={height => setAttributes({ height })}
					/>
					<SelectControl
						label={
							__('What to do at the start for new visitors?', 'metatrader') +
							':'
						}
						value={attributes.startupMode}
						onChange={startupMode => {
							setAttributes({ startupMode });
						}}
						options={startupModes}
					/>
					<SelectControl
						label={__('Language', 'metatrader') + ':'}
						value={attributes.lang}
						onChange={lang => {
							setAttributes({ lang });
						}}
						options={langs}
					/>
					<SelectControl
						label={__('Chart color scheme', 'metatrader') + ':'}
						value={attributes.colorScheme}
						onChange={colorScheme => {
							setAttributes({ colorScheme });
						}}
						options={colorSchemes}
					/>
				</PanelBody>
			</InspectorControls>
		);
	}

	setAttributes(attrs) {
		this.props.setAttributes(attrs);
	}
}
