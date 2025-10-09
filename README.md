# Finance Theme

A modern, responsive WordPress block theme built with TailwindCSS and webpack. Perfect for finance, business, and professional websites.

## 🚀 Features

- **Block Editor Support** - Full Gutenberg block editor integration
- **TailwindCSS** - Modern utility-first CSS framework
- **Responsive Design** - Mobile-first approach with perfect responsiveness
- **Webpack Build Process** - Modern development workflow with asset optimization
- **SEO Optimized** - Schema markup, semantic HTML, and performance optimizations
- **Accessibility Ready** - WCAG 2.1 compliant with proper ARIA attributes
- **Custom Color Palette** - Finance-appropriate color scheme
- **Typography System** - Beautiful typography with Inter font
- **Navigation Menus** - Multi-level navigation with mobile menu
- **Widget Areas** - Sidebar and footer widget support
- **Social Media Integration** - Social menu and sharing buttons
- **Performance Optimized** - Fast loading with code splitting and minification

## 📋 Requirements

- WordPress 6.0 or higher
- PHP 7.4 or higher
- Node.js 16.0 or higher
- npm 8.0 or higher

## 🛠️ Installation

### 1. Theme Installation

1. Download or clone the theme files
2. Upload the theme folder to `/wp-content/themes/`
3. Go to **Appearance > Themes** in your WordPress admin
4. Activate the "Finance Theme"

### 2. Dependencies Installation

Navigate to the theme directory and install npm dependencies:

```bash
cd /wp-content/themes/finance-theme
npm install
```

### 3. Build Assets

#### Development Build (with watch mode)
```bash
npm run dev
```

#### Production Build
```bash
npm run build
```

#### Available Scripts
- `npm run dev` - Development build with watch mode
- `npm run build` - Production build
- `npm run clean` - Clean dist directory
- `npm run lint` - Lint CSS and JavaScript
- `npm run format` - Format code with Prettier

## 🎨 Customization

### Theme Colors

The theme uses a custom color palette defined in `tailwind.config.js`:

- **Primary Blue** - `#1e40af` (Professional blue for CTAs and links)
- **Secondary Teal** - `#0d9488` (Trust and stability)
- **Accent Green** - `#16a34a` (Success and growth)
- **Dark Slate** - `#1e293b` (Text and headings)
- **Light Gray** - `#f8fafc` (Backgrounds and sections)

### Typography

- **Primary Font** - Inter (Google Fonts)
- **Fallback** - System font stack for performance
- **Responsive typography** - Fluid scaling across devices

### Layout

- **Container width** - 1200px max-width with responsive padding
- **Sidebar** - Optional sidebar layout for posts and pages
- **Grid system** - CSS Grid and Flexbox for modern layouts

## 📁 File Structure

```
finance-theme/
├── src/
│   ├── main.css          # Main stylesheet with TailwindCSS
│   └── script.js         # Main JavaScript file
├── dist/                 # Built assets (generated)
│   ├── css/
│   │   └── main.css      # Compiled CSS
│   └── js/
│       └── main.js       # Compiled JavaScript
├── 404.php               # 404 error page
├── archive.php           # Archive pages (categories, tags, etc.)
├── footer.php            # Footer template
├── functions.php         # Theme functions and setup
├── header.php            # Header template
├── index.php             # Main blog page
├── page.php              # Static pages
├── single.php            # Single blog posts
├── style.css             # Theme header and basic styles
├── theme.json            # Block theme configuration
├── package.json          # npm dependencies and scripts
├── tailwind.config.js    # TailwindCSS configuration
├── webpack.config.js     # Webpack build configuration
└── README.md             # This file
```

## 🔧 Theme Setup

### Navigation Menus

1. Go to **Appearance > Menus**
2. Create menus for:
   - **Primary Menu** - Main navigation
   - **Footer Menu** - Footer links
   - **Social Menu** - Social media links

### Widget Areas

Available widget areas:
- **Sidebar** - Main sidebar for posts and pages
- **Footer Widgets** - Footer widget area
- **Top Bar** - Optional top bar for additional content
- **Header Actions** - Header search and social links

### Theme Customization

1. Go to **Appearance > Customize**
2. Customize:
   - Site Identity (logo, site title, tagline)
   - Colors (using theme.json color palette)
   - Typography (font sizes and families)
   - Menus and navigation
   - Widgets and sidebars

## 📱 Block Editor Support

The theme fully supports the WordPress block editor with:

- **Custom color palette** - Matching theme colors
- **Font size options** - Responsive typography scale
- **Wide and full-width blocks** - Full-width layouts
- **Block patterns** - Ready-to-use content sections
- **Custom block styles** - Enhanced block appearances

## 🔍 SEO Features

- **Schema markup** - Article and website structured data
- **Open Graph tags** - Social media optimization
- **Meta descriptions** - Custom excerpt handling
- **Breadcrumbs** - Navigation breadcrumbs
- **Performance optimization** - Fast loading times

## ⚡ Performance

- **Asset optimization** - CSS and JS minification
- **Code splitting** - Load only necessary code
- **Image optimization** - Responsive images with lazy loading
- **Caching** - Proper cache headers
- **CDN ready** - Works with CDN configurations

## 🌐 Browser Support

- Chrome 90+
- Firefox 88+
- Safari 14+
- Edge 90+
- Mobile browsers (iOS Safari, Chrome Mobile)

## 🛡️ Security

- **Secure coding practices** - WordPress coding standards
- **Sanitized outputs** - All data properly escaped
- **Version removal** - WordPress version hidden
- **Content security** - XSS protection measures

## 📚 Development

### Development Workflow

1. **Make changes** to files in `/src/`
2. **Run development build** - `npm run dev`
3. **Test in browser** - View changes in real-time
4. **Production build** - `npm run build` before deployment

### Code Quality

- **ESLint** - JavaScript linting
- **Prettier** - Code formatting
- **Stylelint** - CSS linting
- **WordPress Coding Standards** - PHP best practices

### Customization Guidelines

When customizing the theme:

1. **Use child themes** for modifications
2. **Follow WordPress coding standards**
3. **Test across devices and browsers**
4. **Maintain accessibility standards**
5. **Keep performance in mind**

## 🐛 Troubleshooting

### Common Issues

**Build fails**
- Check Node.js version (16+ required)
- Clear npm cache: `npm cache clean --force`
- Delete node_modules and reinstall: `rm -rf node_modules && npm install`

**Styles not loading**
- Run production build: `npm run build`
- Check file permissions
- Verify WordPress is loading the correct stylesheet

**JavaScript errors**
- Check browser console for errors
- Ensure jQuery is loaded (included by default)
- Verify script localization

### Getting Help

1. Check WordPress debug log
2. Review browser console errors
3. Test with default WordPress theme
4. Check PHP error logs

## 📄 License

This theme is licensed under the GPL v2 or later.

```
Finance Theme
Copyright (C) 2024, Alexandre Machado

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
```

## 👨‍💻 Author

**Alexandre Machado**
- Theme Developer
- WordPress enthusiast
- Modern web technologies advocate

## 🔗 Links

- **WordPress.org** - https://wordpress.org/
- **TailwindCSS** - https://tailwindcss.com/
- **Webpack** - https://webpack.js.org/
- **Inter Font** - https://fonts.google.com/specimen/Inter

---

**Finance Theme** - A modern WordPress block theme for finance and business websites. Built with ❤️ using modern web technologies.