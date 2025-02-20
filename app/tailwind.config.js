/** @type {import('tailwindcss').Config} */
export default {
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
        'background': 'rgba(var(--background), <alpha-value>)',
        'input': 'rgba(var(--input), <alpha-value>)',
        'input-border': 'rgba(var(--input-border), <alpha-value>)',
        'primary': 'rgba(var(--primary), <alpha-value>)',
        'secondary': 'rgba(var(--secondary), <alpha-value>)',
        'validation': 'rgba(var(--validation), <alpha-value>)',
        'info': 'rgba(var(--info), <alpha-value>)',
        'error': 'rgba(var(--error), <alpha-value>)',
        'default': 'rgba(var(--text-color), 1)',
        'reverse': 'rgba(var(--text-reverse), 1)',
      },
      textColor: {
        'default': 'rgba(var(--text-color), 1)',
        'reverse': 'rgba(var(--text-reverse), 1)',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}

