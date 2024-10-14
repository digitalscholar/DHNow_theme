// latest-posts-sticky-control.js
const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { InspectorControls } = wp.blockEditor;
const { PanelBody, ToggleControl } = wp.components;
const { Fragment } = wp.element;

// Add sticky control to Latest Posts block
const addStickyToggleControl = createHigherOrderComponent((BlockEdit) => {
	return (props) => {
		if (props.name !== 'core/latest-posts') {
			return <BlockEdit {...props} />;
		}

		const { attributes, setAttributes } = props;
		const { includeSticky } = attributes;

		return (
			<Fragment>
				<BlockEdit {...props} />
				<InspectorControls>
					<PanelBody title="Sticky Posts">
						<ToggleControl
							label="Include Sticky Posts"
							checked={!!includeSticky}
							onChange={(value) => setAttributes({ includeSticky: value })}
						/>
					</PanelBody>
				</InspectorControls>
			</Fragment>
		);
	};
}, 'addStickyToggleControl');

// Add new attribute to the block
const addStickyAttribute = (settings, name) => {
	if (name !== 'core/latest-posts') {
		return settings;
	}

	settings.attributes = {
		...settings.attributes,
		includeSticky: {
			type: 'boolean',
			default: true,
		},
	};

	return settings;
};

// Register the filters
addFilter('editor.BlockEdit', 'dhnow/latest-posts-sticky-control', addStickyToggleControl);
addFilter('blocks.registerBlockType', 'dhnow/latest-posts-sticky-attribute', addStickyAttribute);
