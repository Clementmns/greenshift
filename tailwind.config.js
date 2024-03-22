/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./app/Views/**/**/*.php", "./public/**/*.php"],
  theme: {
    extend: {
      colors: {
        primary: {
          50: "#E1F4E8",
          100: "#C4E9D2",
          200: "#8CD4A8",
          300: "#51BE7A",
          400: "#338954",
          500: "#1E5031",
          600: "#183F27",
          700: "#12301E",
          800: "#0D2115",
          900: "#060F09",
          950: "#030705",
        },
      },
    },
  },
  plugins: [],
};
