/* ==========================================================================
   TailwindCSS Configuration for Finance Theme
   ========================================================================== */

const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './src/**/*.{js,jsx,css}',
    './templates/**/*.php',
    './includes/**/*.php',
  ],

  // Enable dark mode
  darkMode: 'class',

  // Custom theme configuration
  theme: {
    extend: {
      // Color palette
      colors: {
        primary: {
          50: '#eff6ff',
          100: '#dbeafe',
          200: '#bfdbfe',
          300: '#93c5fd',
          400: '#60a5fa',
          500: '#3b82f6',
          600: '#2563eb',
          700: '#1d4ed8',
          800: '#1e40af',
          900: '#1e3a8a',
        },
        secondary: {
          50: '#f0fdfa',
          100: '#ccfbf1',
          200: '#99f6e4',
          300: '#5eead4',
          400: '#2dd4bf',
          500: '#14b8a6',
          600: '#0d9488',
          700: '#0f766e',
          800: '#115e59',
          900: '#134e4a',
        },
        accent: {
          50: '#f0fdf4',
          100: '#dcfce7',
          200: '#bbf7d0',
          300: '#86efac',
          400: '#4ade80',
          500: '#22c55e',
          600: '#16a34a',
          700: '#15803d',
          800: '#166534',
          900: '#14532d',
        },
        slate: {
          50: '#f8fafc',
          100: '#f1f5f9',
          200: '#e2e8f0',
          300: '#cbd5e1',
          400: '#94a3b8',
          500: '#64748b',
          600: '#475569',
          700: '#334155',
          800: '#1e293b',
          900: '#0f172a',
        },
      },

      // Typography
      fontFamily: {
        sans: ['Inter', ...defaultTheme.fontFamily.sans],
        heading: ['Inter', ...defaultTheme.fontFamily.sans],
        mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
      },

      // Font sizes
      fontSize: {
        xs: ['0.75rem', { lineHeight: '1rem' }],
        sm: ['0.875rem', { lineHeight: '1.25rem' }],
        base: ['1rem', { lineHeight: '1.5rem' }],
        lg: ['1.125rem', { lineHeight: '1.75rem' }],
        xl: ['1.25rem', { lineHeight: '1.75rem' }],
        '2xl': ['1.5rem', { lineHeight: '2rem' }],
        '3xl': ['1.875rem', { lineHeight: '2.25rem' }],
        '4xl': ['2.25rem', { lineHeight: '2.5rem' }],
        '5xl': ['3rem', { lineHeight: '1' }],
        '6xl': ['3.75rem', { lineHeight: '1' }],
      },

      // Spacing
      spacing: {
        18: '4.5rem',
        88: '22rem',
        128: '32rem',
        144: '36rem',
      },

      // Border radius
      borderRadius: {
        '4xl': '2rem',
      },

      // Box shadow
      boxShadow: {
        'soft': '0 2px 15px rgba(0, 0, 0, 0.08)',
        'medium': '0 4px 25px rgba(0, 0, 0, 0.12)',
        'large': '0 8px 40px rgba(0, 0, 0, 0.16)',
      },

      // Animation
      animation: {
        'fade-in': 'fadeIn 0.5s ease-in-out',
        'slide-in': 'slideIn 0.5s ease-in-out',
        'bounce-soft': 'bounceSoft 2s infinite',
      },

      // Keyframes
      keyframes: {
        fadeIn: {
          '0%': { opacity: '0', transform: 'translateY(10px)' },
          '100%': { opacity: '1', transform: 'translateY(0)' },
        },
        slideIn: {
          '0%': { opacity: '0', transform: 'translateX(-10px)' },
          '100%': { opacity: '1', transform: 'translateX(0)' },
        },
        bounceSoft: {
          '0%, 100%': { transform: 'translateY(0)' },
          '50%': { transform: 'translateY(-5px)' },
        },
      },

      // Z-index
      zIndex: {
        60: '60',
        70: '70',
        80: '80',
        90: '90',
        100: '100',
      },

      // Screens (responsive breakpoints)
      screens: {
        'xs': '475px',
        'sm': '640px',
        'md': '768px',
        'lg': '1024px',
        'xl': '1280px',
        '2xl': '1536px',
        '3xl': '1920px',
      },

      // Container
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
          sm: '1.5rem',
          lg: '2rem',
          xl: '2.5rem',
        },
      },

      // Aspect ratio
      aspectRatio: {
        '4/3': '4 / 3',
        '3/2': '3 / 2',
        '16/9': '16 / 9',
        '21/9': '21 / 9',
      },
    },
  },

  // Core plugins
  corePlugins: {
    // Enable container plugin
    container: true,

    // Enable aspect ratio plugin
    aspectRatio: true,

    // Enable typography plugin
    typography: true,
  },

  // Additional plugins
  plugins: [
    // Forms plugin for better form styling
    require('@tailwindcss/forms')({
      strategy: 'class', // Use class-based strategy
    }),

    // Typography plugin for rich text content
    require('@tailwindcss/typography')({
      className: 'prose',
      target: 'modern',
    }),

    // Custom plugin for WordPress-specific utilities
    function({ addUtilities, addComponents, theme }) {
      // WordPress editor utilities
      addUtilities({
        '.wp-block-align-wide': {
          marginLeft: 'calc(50% - 50vw)',
          marginRight: 'calc(50% - 50vw)',
          maxWidth: '100vw',
          width: 'auto',
        },
        '.wp-block-align-full': {
          marginLeft: 'calc(50% - 50vw)',
          marginRight: 'calc(50% - 50vw)',
          maxWidth: '100vw',
          width: 'auto',
        },
        '.wp-block-align-center': {
          marginLeft: 'auto',
          marginRight: 'auto',
          textAlign: 'center',
        },
        '.wp-block-align-left': {
          float: 'left',
          marginRight: '1rem',
          marginBottom: '1rem',
        },
        '.wp-block-align-right': {
          float: 'right',
          marginLeft: '1rem',
          marginBottom: '1rem',
        },
      });

      // WordPress component styles
      addComponents({
        '.wp-block-button': {
          display: 'inline-block',
          marginBottom: '1rem',
        },
        '.wp-block-button .wp-block-button__link': {
          backgroundColor: theme('colors.primary.600'),
          color: 'white',
          padding: '0.75rem 1.5rem',
          borderRadius: theme('borderRadius.lg'),
          fontWeight: '500',
          textDecoration: 'none',
          transition: 'background-color 0.3s ease',
        },
        '.wp-block-button .wp-block-button__link:hover': {
          backgroundColor: theme('colors.primary.700'),
        },
      });
    },
  ],

  // Future compatibility
  future: {
    hoverOnlyWhenSupported: true,
  },
};