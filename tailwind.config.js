import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                monalisa: {
                    50: "#F8FAFC",
                    100: "#EAF1F7",
                    200: "#C9D9E8",
                    300: "#9FB9D3",
                    400: "#6F96BB",
                    500: "#3B82C4",
                    600: "#1F4E79",
                    700: "#163A63",
                    800: "#102C4D",
                    900: "#0B1F38",
                },
                accent: {
                    400: "#F2A33A",
                    500: "#F28C28",
                    600: "#D97706",
                },
                gold: {
                    400: "#E0B85A",
                    500: "#D9A441",
                }
            },
        },
    },
    plugins: [],
};
