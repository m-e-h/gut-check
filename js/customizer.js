/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

const siteTitle = document.querySelector(".site-title");
const siteDesc = document.querySelector(".site-description");

// https://googlechrome.github.io/samples/css-custom-properties/
// Auxiliary method. Sets the value of a custom property at the document level.
const setVariable = function(propertyName, value) {
	document.documentElement.style.setProperty(propertyName, value);
};

// Site title.
wp.customize("blogname", value => {
	value.bind(to => {
		siteTitle.textContent = to;
	});
});

// Site description.
wp.customize("blogdescription", value => {
	value.bind(to => {
		siteDesc.textContent = to;
	});
});

// Header text color.
wp.customize("header_textcolor", value => {
	value.bind(to => {
		setVariable("--header-text-color", to);

		let headerText = [siteTitle, siteDesc];

		headerText.forEach(text => {
			if ("blank" === to) {
				text.style.clip = "rect(0 0 0 0)";
				text.style.position = "absolute";
			} else {
				text.style.color = to;
				text.style.clip = "auto";
				text.style.position = "relative";
			}
		});
	});
});

wp.customize("gc_outline_width", value => {
	value.bind(to => {
		setVariable("--gc-outline-width", `${to}px`);
	});
});

wp.customize("gc_shadow_depth", value => {
	value.bind(to => {
		setVariable("--gc-shadow-depth", `${to}rem`);
	});
});
