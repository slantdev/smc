const theme = require('./theme.json');
const tailpress = require('@jeffreyvr/tailwindcss-tailpress');
const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './resources/css/*.css',
    './resources/js/*.js',
    './safelist.txt',
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        sm: '2rem',
        lg: '2rem',
      },
    },
    extend: {
      colors: tailpress.colorMapper(
        tailpress.theme('settings.color.palette', theme)
      ),
      fontSize: tailpress.fontSizeMapper(
        tailpress.theme('settings.typography.fontSizes', theme)
      ),
      fontFamily: {
        sans: ['Roboto', ...defaultTheme.fontFamily.sans],
      },
    },
    screens: {
      xs: '480px',
      sm: '600px',
      md: '782px',
      lg: '1024px',
      xl: '1280px',
      '2xl': '1440px',
      '3xl': '1536px',
      '4xl': '1760px',
    },
  },
  corePlugins: {
    aspectRatio: false,
  },
  plugins: [
    tailpress.tailwind,
    require('daisyui'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/forms'),
    require('@tailwindcss/aspect-ratio'),
  ],
  daisyui: {
    styled: true,
    themes: true,
    base: true,
    utils: true,
    logs: true,
    rtl: false,
    prefix: '',
    darkTheme: false,
  },
};
