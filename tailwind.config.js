import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'contrast': '#1B2024',
                'midnight': '#0E1115',
                'online': '#50AE58',
                'offline': '#DE4949',
                'sky': '#017BFE',
                'warning': '#DFBA48'

                    // ...more shades if needed
            },
                // You can add as many custom colors as you need
        },
    },

    plugins: [forms],
};
