/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

wp.customize('gc_outline_width', value => {
	value.bind(to => {
		document.documentElement.style.setProperty(
			'--gc-outline-width',
			`${to}px`
		);
	});
});

wp.customize('gc_shadow_depth', value => {
	value.bind(to => {
		document.documentElement.style.setProperty(
			'--gc-shadow-depth',
			`${to}rem`
		);
	});
});
