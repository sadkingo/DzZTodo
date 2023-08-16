import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import wireuiConfig from './vendor/wireui/wireui/tailwind.config'; // Import the external config

/** @type {import('tailwindcss').Config} */
export default {
    presets: [
        // ... other presets
        wireuiConfig, // Use the imported external config directly
    ],
    content: [
        // ... content paths
        './vendor/wireui/wireui/resources/**/*.blade.php',
        './vendor/wireui/wireui/ts/**/*.ts',
        './vendor/wireui/wireui/src/View/**/*.php',
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    theme: {
        extend: {
            colors: {
                // Light theme colors
                lightBackground: '#FFFFFF',
                lightText: '#333333',
                // Dark theme colors
                darkBackground: '#1A202C',
                darkText: '#E2E8F0',
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [forms],
};
