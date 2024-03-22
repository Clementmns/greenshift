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
            secondary: {
               50: "#FEFCFB",
               100: "#FCFAF7",
               200: "#FBF7F4",
               300: "#F9F2EC",
               400: "#F7EFE8",
               500: "#F5EAE1",
               600: "#DEB99C",
               700: "#C68753",
               800: "#8E5A2F",
               900: "#452C17",
               950: "#22160B",
            },
         },
         boxShadow: {
            classic: "rgba(149, 157, 165, 0.2) 0px 8px 24px",
         },
      },
   },
   plugins: [],
};
