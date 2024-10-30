( function( blocks, element, components ) {
	const { createElement: el } = element;
	const { registerBlockType } = blocks;
	const { SelectControl } = components;

	registerBlockType( 'custom/feeds-block', {
		title: 'DHNow Feeds',
		icon: 'rss',
		category: 'widgets',

		attributes: {
			status: {
				type: 'string',
				default: 'publish'
			}
		},

		edit: function( props ) {
			const { attributes, setAttributes } = props;
			const { status } = attributes;

			return el(
				'div',
				{ className: 'feeds-block-editor components-placeholder is-large' },
				el(
					'div',
					{ className: 'components-placeholder__label' },
					el( 'span', { className: 'dashicons dashicons-rss', style: { marginRight: '4px' } } ),
					'DHNow Feeds'
				),
				el( SelectControl, {
					label: 'Status',
					value: status,
					options: [
						{ label: 'Published', value: 'publish' },
						{ label: 'Alerted', value: 'alert_specimen' },
						{ label: 'Draft', value: 'draft' }
					],
					onChange: ( value ) => setAttributes( { status: value } )
				} )
			);
		},

		save: function() {
			return null; // Server-side render
		}
	} );
} )( window.wp.blocks, window.wp.element, wp.components );
