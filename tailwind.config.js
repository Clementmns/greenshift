/** @type {import('tailwindcss').Config} */
module.exports = {
   content: ["./app/Views/**/**/*.php", "./public/**/*.php"],
   theme: {
      extend: {},
      textColor: theme => theme('colors'),
      textColor: {
         'primary': '#62B565',
      }
   },
   plugins: [],
};
