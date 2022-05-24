const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        'resources/js/Pages/**/*.vue',
        'resources/js/Shared/**/*.vue'
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
        }
    },
    plugins: [],
}
