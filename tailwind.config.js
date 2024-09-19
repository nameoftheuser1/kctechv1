/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
        keyframes: {
            'slide-up': {
              '0%': { transform: 'translateY(100%)', opacity: 0 },
              '100%': { transform: 'translateY(0)', opacity: 1 },
            }
          },
          animation: {
            'slide-up': 'slide-up 1s ease-in-out',
          }
    },
  },
  plugins: [],
}

