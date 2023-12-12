/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                primary:{ 
                    DEFAULT: '#070A52',
                    100: '#3f5277',
                    300: '#1D2951',
                    500: '#000044',
                    700: '#001c3d',
                    900: '#051040',
                },
                secondary: {
                    100: '#F15A59',
                    500: '#ED2B2A',
                    900: '#D21312',
                }
            }

        },
    },
    plugins: [],
}

