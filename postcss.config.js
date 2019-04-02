module.exports = ctx => ({
	plugins: {
		'postcss-import': {},
		'postcss-preset-env': {
			stage: 0,
			features: {
				'color-mod-function': true,
				'all-property': false
			}
		},
		'postcss-editor-styles':
			'editor' === ctx.env
				? {
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
				  }
				: {
						scopeTo: ':not(#\\9)',
						tags: [],
						repeat: 1,
						remove: [],
						replace: [],
						ignore: [':root','html','body'],
						tagSuffix: ''
				  }
	}
});
