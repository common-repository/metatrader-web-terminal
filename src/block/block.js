/**
 * BLOCK: metatrader-block
 *
 * Registering a basic block with Gutenberg.
 * Simple block, renders and saves the same content without any interactivity.
 */

//  Import CSS.
import _ from "lodash"
import "./editor.scss"
import Icon from "svg-react-loader!./icon.svg"
import PreviewImage from "svg-react-loader!./preview.svg"
import Inspector from "./inspector.js"

const { __ } = wp.i18n
const { registerBlockType } = wp.blocks
const { RawHTML, Fragment } = wp.element
const { Placeholder } = wp.components

/**
 * Register: aa Gutenberg Block.
 *
 * Registers a new block provided a unique name and an object defining its
 * behavior. Once registere, the block is made editor as an option to any
 * editor interface where blocks are implemented.
 *
 * @link https://wordpress.org/gutenberg/handbook/block-api/
 * @param  {string}   name     Block name.
 * @param  {Object}   settings Block settings.
 * @return {?WPBlock}          The block, if it has been successfully
 *                             registered; otherwise `undefined`.
 */
registerBlockType("metatrader/webterminal-block", {
	title: __("MetaTrader Web Terminal", "metatrader"), // Block title.
	description: __(
		"Displays the web terminal to connect to the platforms MetaTrader 4 and MetaTrader 5",
		"metatrader"
	),
	icon: <Icon />,
	category: "widgets",
	keywords: [__("metatrader", "metatrader"), __("webterminal", "metatrader")],
	supports: {
		customClassName: false,
		className: false,
		html: false
	},
	attributes: {
		id: {
			type: "string",
			default: "webterminal"
		},
		version: {
			type: "string",
			default: "5"
		},
		restrictServers: {
			type: "boolean",
			default: false
		},
		servers: {
			type: "string",
			default: ""
		},
		login: {
			type: "string",
			default: ""
		},
		server: {
			type: "string",
			default: "MetaQuotes-Demo"
		},
		demoAllServers: {
			type: "boolean",
			default: true
		},
		demoShowPhone: {
			type: "boolean",
			default: false
		},
		utmCampaign: {
			type: "string",
			default: ""
		},
		utmSource: {
			type: "string",
			default: ""
		},
		width: {
			type: "string",
			default: "100%"
		},
		height: {
			type: "string",
			default: "500px"
		},
		startupMode: {
			type: "string",
			default: "create_demo"
		},
		lang: {
			type: "string",
			default: ""
		},
		colorScheme: {
			type: "string",
			default: "black_on_white"
		}
	},

	edit: function (props) {
		return (
			<Fragment>
				<Inspector {...props} />
				<Placeholder
					label={__('MetaTrader Web Terminal', 'metatrader')}
					icon={
						<span style={{ marginRight: 6 }}>
							<PreviewImage />
						</span>
					} />
			</Fragment>
		)
	},

	save: function (props) {
		return <RawHTML>{buildHTML({ ...props.attributes })}</RawHTML>
	}
})

function buildHTML(allOptions) {
	let output = ""
	let {
		id,
		version,
		login,
		server,
		demoAllServers,
		demoShowPhone,
		utmCampaign,
		utmSource,
		startupMode,
		lang,
		colorScheme,
		width,
		height
	} = allOptions


	let options = {
		mobile: false,
		version: _.toInteger(version),
		login,
		server,
		demoAllServers,
		demoShowPhone,
		utmCampaign,
		utmSource,
		startupMode,
		lang,
		colorScheme
	}

	options = _.pickBy(options, _.identity);

	if (allOptions.restrictServers) {
		let servers = allOptions.servers || ""

		options = {
			...options,
			servers: _.compact(servers.split(","))
		}
	}

	const optionsStr = JSON.stringify(options)
	const style = `width:${width};height:${height};`

	output += `
		<div id="${id}" style="${style}"></div>
		<script type="text/javascript">new MetaTraderWebTerminal("${id}", ${optionsStr})</script>
	`

	return output
}
