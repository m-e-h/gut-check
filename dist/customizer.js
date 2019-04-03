function hexToRgbA(hex) {
	const r = parseInt(hex.slice(1, 3), 16);
	const g = parseInt(hex.slice(3, 5), 16);
	const b = parseInt(hex.slice(5, 7), 16);

	return `rgba(${r}, ${g}, ${b}, 0.5)`;
}

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

wp.customize('gc_shadow_color', value => {
	value.bind(to => {
		document.documentElement.style.setProperty(
			'--gc-shadow-color',
			hexToRgbA(to)
		);
	});
});
