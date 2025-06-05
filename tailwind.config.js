/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php", // Archivos Blade en Laravel
    "./resources/js/**/*.{js,ts,jsx,tsx}", // Archivos JS/TS en frontend
    "./app/Http/Controllers/**/*.php", // Opcional: si usas clases en Blade
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
