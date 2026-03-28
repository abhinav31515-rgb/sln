import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Jost', ...defaultTheme.fontFamily.sans],
                serif: ['Cormorant Garamond', ...defaultTheme.fontFamily.serif],
            },
            colors: {
                aurum: {
                    gold: '#C8A85D',
                    'gold-light': '#E2D7C1',
                    bg: '#1A1A1A',
                    surface: '#242424',
                    'surface-alt': '#2A2A2A',
                    text: '#F9F8F6',
                    muted: '#8C8C8C',
                    error: '#D45D5D',
                    success: '#6FCF97',
                    border: 'rgba(249,248,246,0.08)',
                }
            }
        },
    },

    plugins: [forms],
};
