/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./app/Http/**/*.php", "./resources/views/**/*.{php,vue,js,ts,jsx,tsx}", "./database/seeders/**/*.php",

    ],
    theme: {
        extend: {}
    },
    plugins: [
        require('@tailwindcss/forms'), require('tailwind-scrollbar')(
            {nocompatible: true}
        ),

    ],
    variants: {
        scrollbar: ['rounded']
    }

}
