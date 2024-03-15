/** @type {import('tailwindcss').Config} */
module.exports = {
   content: ["./app/Views/**/**/*.php", "./public/**/*.php"],
   theme: {
      extend: {
         colors: {
            primary: {
               50: "#EEF7EE",
               100: "#E0F0E0",
               200: "#C1E2C2",
               300: "#A1D3A3",
               400: "#82C484",
               500: "#62B565",
               600: "#48984B",
               700: "#367238",
               800: "#244C25",
               900: "#122613",
               950: "#081108",
            },
         },
      },
   },
   plugins: [],
};
