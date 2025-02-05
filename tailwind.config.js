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
      gridTemplateColumns: {
        'auto-fit-card': 'repeat(auto-fit, minmax(250px, 1fr))',
      },
      maxWidth: {
        'card': '330px',
      },
      colors: {
        'background': '#F5F3F0',
        'primary': '#3380CC',
        'secondary': '#E8DFCA',
        'validation': '#478548',
        'info': '#476085',
        'error': '#BF4040',
        'background-dark': '#000000',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

