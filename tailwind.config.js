const defaultColors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		'./resources/**/*.blade.php',
	],

	darkMode: 'class',

	theme: {
		extend: {
			colors: {
				primary: defaultColors.pink,
				success: defaultColors.green,
				warning: defaultColors.yellow,
				danger: defaultColors.red,
			},
		},
	},

	plugins: [
		require('@tailwindcss/typography'),
		require('@tailwindcss/forms'),
	],
};
