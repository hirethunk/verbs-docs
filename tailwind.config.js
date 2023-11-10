const typographyPlugin = require('@tailwindcss/typography')

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./app/MarkdownConverter.php",
    "./resources/**/*.js",
    "./docs/**/*.md",
  ],
  darkMode: 'class',
  safelist: [
    { pattern: /torchlight/i }
  ],
  theme: {
    fontSize: {
      '2xs': ['0.75rem', { lineHeight: '1.25rem' }],
      xs: ['0.8125rem', { lineHeight: '1.5rem' }],
      sm: ['0.875rem', { lineHeight: '1.5rem' }],
      base: ['1rem', { lineHeight: '1.75rem' }],
      lg: ['1.125rem', { lineHeight: '1.75rem' }],
      xl: ['1.25rem', { lineHeight: '1.75rem' }],
      '2xl': ['1.5rem', { lineHeight: '2rem' }],
      '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
      '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
      '5xl': ['3rem', { lineHeight: '1' }],
      '6xl': ['3.75rem', { lineHeight: '1' }],
      '7xl': ['4.5rem', { lineHeight: '1' }],
      '8xl': ['6rem', { lineHeight: '1' }],
      '9xl': ['8rem', { lineHeight: '1' }],
    },
    extend: {
      typography: ({ theme }) => ({
        DEFAULT: {
          css: {
            '--tw-prose-links': theme('colors.emerald[500]'),
            ':not(pre) code': {
              backgroundColor: theme('colors.slate[100]'),
              display: 'inline-block',
              paddingTop: theme('padding[0]'),
              paddingRight: theme('padding[1]'),
              paddingBottom: theme('padding[0]'),
              paddingLeft: theme('padding[1]'),
            },
          },
        },
      }),
      boxShadow: {
        glow: '0 0 4px rgb(0 0 0 / 0.1)',
      },
      maxWidth: {
        lg: '33rem',
        '2xl': '40rem',
        '3xl': '50rem',
        '5xl': '66rem',
      },
      opacity: {
        1: '0.01',
        2.5: '0.025',
        7.5: '0.075',
        15: '0.15',
      },
    },
  },
  plugins: [typographyPlugin],
}
