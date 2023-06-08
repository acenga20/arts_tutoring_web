/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
      "./assets/**/*.{js,ts,jsx,tsx}",
      "./templates/**/*.{html,twig}",
      "./node_modules/flowbite/**/*.js"
  ],
  theme: {
    extend: {
        fontFamily:{

        },
        colors:{
            'mint': '#9EEA8A',
            'lightGray': '#F2F6F2',
            'grayModal': '#E9E9E9'
        },
        maxWidth: {
            'mid': '85rem',
            '8xl': '105rem',
        },
        borderRadius: {
          '4xl': '2rem',
        },
        height:{
            '100': '27rem',
        },
    },
  },
  plugins: [
      require('flowbite/plugin')
  ],
}

