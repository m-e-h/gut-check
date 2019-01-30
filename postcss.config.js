module.exports = (ctx) => ({
	plugins: {
		'postcss-editor-styles': 'editor' === ctx.env ? {
			tags: [
				'a',
				'button',
				'input',
				'label',
				'select',
				'textarea',
				'form',
				'div'
			]
		} : false,
	}
});
