const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
    content: [
        'resources/js/Pages/**/*.vue',
        'resources/js/Shared/**/*.vue',
        'resources/views    /**/*.php'
    ],
    theme: {
        extend: {
            fontFamily: {
                'sans': ['Montserrat', ...defaultTheme.fontFamily.sans],
            },
            colors:{
                logo: '#1d526d'
            }
        }
    },
    plugins: [],
}
