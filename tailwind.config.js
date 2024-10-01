const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')
const svgToDataUri = require('mini-svg-data-uri')

const customColor = {
    "dark-header"      : "#242526",
    "dark-body"        : "#18191A",
    "primary"          : "var(--color-primary)",
    "dark-primary"     : "var(--color-dark-primary)",
    "darken-primary"   : "var(--color-darken-primary)",
    "light-primary"    : "var(--color-light-primary)",
    "lighten-primary"  : "var(--color-lighten-primary)",
    "secondary"        : "var(--color-secondary)",
    "dark-secondary"   : "var(--color-dark-secondary)",
    "darken-secondary" : "var(--color-darken-secondary)",
    "light-secondary"  : "var(--color-light-secondary)",
    "lighten-secondary": "var(--color-lighten-secondary)",
    "success"          : "var(--color-success)",
    "dark-success"     : "var(--color-dark-success)",
    "light-success"    : "var(--color-light-success)",
    "danger"           : "var(--color-danger)",
    "dark-danger"      : "var(--color-dark-danger)",
    "light-danger"     : "var(--color-light-danger)",
    "info"             : "var(--color-info)",
    "dark-info"        : "var(--color-dark-info)",
    "light-info"       : "var(--color-light-info)",
    "warning"          : "var(--color-warning)",
    "dark-warning"     : "var(--color-dark-warning)",
    "light-warning"    : "var(--color-light-warning)",
}

module.exports = {
  darkMode: 'class',
  content: [
    './node_modules/**/*.vue',
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  whitelistPatterns: [],
  safelist: [],
  theme: {
    textColor: {
        "label"        : "var(--color-text-label)",
        "success-label": "var(--color-success-label)",
        "danger-label" : "var(--color-danger-label)",
        "info-label"   : "var(--color-info-label)",
        "warning-label": "var(--color-warning-label)",
        ...customColor,
        ...colors
    },
    ringColor: {
        ...customColor,
        ...colors
    },
    backgroundColor: {
        ...customColor,
        ...colors
    },
    borderColor: {
        ...customColor,
        ...colors
    },
    fontFamily: {
        display: "var(--font-display)",
        body: "var(--font-body)"
    },
    fontWeights: {
        normal: "var(--font-weight-normal)",
        display: "var(--font-weight-display)",
        btn: "var(--font-weight-btn)"
    },
    borderRadius: {
        none: "0",
        btn: "var(--rounded-btn)",
        ...defaultTheme.borderRadius
    },
    extend: {
        maxWidth: {
            '1/4': '25%',
            '1/3': '33.33%',
            '2/5': '40%',
            '1/2': '50%',
            '3/5': '60%',
            '2/3': '66.67%',
            '3/4': '75%',
            '4/5': '80%',
        },
        fontFamily: {
            sans: ['Inter var', ...defaultTheme.fontFamily.sans],
        },
        backgroundColor: ['even','odd'],
        backgroundImage: (theme) => ({
          'site-background': `url("/images/site-background.svg")`,
          'grid-background': `url("/images/grid.svg")`,
          'multiselect-caret': `url("${svgToDataUri(
            `<svg viewBox="0 0 320 512" fill="${theme('colors.gray.400')}" xmlns="http://www.w3.org/2000/svg"><path d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path></svg>`,
          )}")`,
          'multiselect-spinner': `url("${svgToDataUri(
            `<svg viewBox="0 0 512 512" fill="${theme('colors.green.500')}" xmlns="http://www.w3.org/2000/svg"><path d="M456.433 371.72l-27.79-16.045c-7.192-4.152-10.052-13.136-6.487-20.636 25.82-54.328 23.566-118.602-6.768-171.03-30.265-52.529-84.802-86.621-144.76-91.424C262.35 71.922 256 64.953 256 56.649V24.56c0-9.31 7.916-16.609 17.204-15.96 81.795 5.717 156.412 51.902 197.611 123.408 41.301 71.385 43.99 159.096 8.042 232.792-4.082 8.369-14.361 11.575-22.424 6.92z"></path></svg>`,
          )}")`,
          'multiselect-remove': `url("${svgToDataUri(
            `<svg viewBox="0 0 320 512" fill="${theme('colors.white')}" xmlns="http://www.w3.org/2000/svg"><path d="M207.6 256l107.72-107.72c6.23-6.23 6.23-16.34 0-22.58l-25.03-25.03c-6.23-6.23-16.34-6.23-22.58 0L160 208.4 52.28 100.68c-6.23-6.23-16.34-6.23-22.58 0L4.68 125.7c-6.23 6.23-6.23 16.34 0 22.58L112.4 256 4.68 363.72c-6.23 6.23-6.23 16.34 0 22.58l25.03 25.03c6.23 6.23 16.34 6.23 22.58 0L160 303.6l107.72 107.72c6.23 6.23 16.34 6.23 22.58 0l25.03-25.03c6.23-6.23 6.23-16.34 0-22.58L207.6 256z"></path></svg>`,
          )}")`,
        }),
        blur: {
          xs: '2px',
        }
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require('./resources/plugins/js/scrollbar.js')
  ],
}
