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
							'div',
							'span'
						],
						tagSuffix: ':not([class*="block-editor-"]):not([class*="editor-block-"]):not([class^="components-"]):not([class^="editor-"]):not([class^="block-"]):not([aria-owns]):not([id^="mceu_"])'
				  }
				: {
						scopeTo: ':not(#gc-clear)',
						tags: [],
						repeat: 1,
						remove: [],
						replace: [],
						ignore: [':root','html','body','#wpadminbar','#wpbody','.clear'],
						tagSuffix: ''
				  }
	}
});
