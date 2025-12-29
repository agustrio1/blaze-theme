# 🔥 Blaze Theme

> Modern, blazing-fast WordPress theme built with Tailwind CSS v4 and Svelte components.

[![WordPress Version](https://img.shields.io/badge/WordPress-6.7+-blue.svg)](https://wordpress.org/)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-v4-38bdf8.svg)](https://tailwindcss.com/)
[![Svelte](https://img.shields.io/badge/Svelte-5.0+-ff3e00.svg)](https://svelte.dev/)
[![License](https://img.shields.io/badge/License-GPL%20v2-red.svg)](https://www.gnu.org/licenses/gpl-2.0.html)

---

## 📖 Table of Contents

- [Overview](#overview)
- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Development](#development)
- [Theme Structure](#theme-structure)
- [Customization](#customization)
- [Components](#components)
- [Template System](#template-system)
- [Performance](#performance)
- [Browser Support](#browser-support)
- [Contributing](#contributing)
- [License](#license)
- [Credits](#credits)

---

## 🎯 Overview

**Blaze Theme** adalah tema WordPress modern yang menggabungkan kekuatan **Tailwind CSS v4** untuk styling yang fleksibel dan **Svelte** untuk komponen interaktif yang reaktif. Tema ini dirancang untuk memberikan performa maksimal dengan developer experience yang luar biasa.

### Why Blaze?

- ⚡ **Blazing Fast** - Optimized build dengan Vite dan code splitting
- 🎨 **Modern Design** - Clean, minimalist, dan fully customizable
- 📱 **Fully Responsive** - Mobile-first approach
- ♿ **Accessible** - WCAG 2.1 compliant
- 🔧 **Developer Friendly** - Clean code, well documented
- 🎭 **Component-Based** - Reusable Svelte components
- 🎨 **Utility-First CSS** - Tailwind CSS v4 power
- 🛠️ **Easy Customization** - WordPress Customizer integration

---

## ✨ Features

### Core Features
- ✅ WordPress 6.7+ compatible
- ✅ Full Site Editing (FSE) ready
- ✅ Gutenberg block support
- ✅ WooCommerce compatible
- ✅ SEO optimized
- ✅ Translation ready (WPML & Polylang)
- ✅ RTL (Right-to-Left) support
- ✅ Child theme ready

### Design Features
- 🎨 Dark mode support
- 🎨 Multiple blog layouts (Grid, Masonry, List)
- 🎨 Custom color schemes
- 🎨 Typography options
- 🎨 Flexible header & footer
- 🎨 Mega menu support

### Components
- 🧩 Interactive header with search
- 🧩 Mobile-friendly navigation
- 🧩 Newsletter subscription
- 🧩 Post cards with hover effects
- 🧩 Modal dialogs
- 🧩 Loading states
- 🧩 Customizer controls (Color picker, Range slider)

### Performance
- ⚡ Lazy loading images
- ⚡ Optimized asset loading
- ⚡ Minimal JavaScript footprint
- ⚡ Critical CSS inlining
- ⚡ Browser caching support
- ⚡ CDN ready

---

## 📋 Requirements

- **WordPress**: 6.0 or higher
- **PHP**: 7.4 or higher (8.0+ recommended)
- **Node.js**: 18.0 or higher
- **NPM**: 9.0 or higher

### Optional
- **WooCommerce**: 8.0+ (for e-commerce features)
- **Composer**: 2.0+ (for dependency management)

---

## 🚀 Installation

### Quick Install (Production)

1. **Download the theme**
   ```bash
   # Clone or download from repository
   git clone https://github.com/yourusername/blaze-theme.git
   ```

2. **Upload to WordPress**
   - Go to `wp-content/themes/`
   - Upload the `blaze-theme` folder
   - Or use WordPress admin: **Appearance → Themes → Add New → Upload Theme**

3. **Activate the theme**
   - Go to **Appearance → Themes**
   - Click **Activate** on Blaze Theme

4. **Install dependencies and build**
   ```bash
   cd wp-content/themes/blaze-theme
   npm install
   npm run build
   ```

### Developer Install

1. **Clone the repository**
   ```bash
   cd wp-content/themes/
   git clone https://github.com/yourusername/blaze-theme.git
   cd blaze-theme
   ```

2. **Install dependencies**
   ```bash
   npm install
   ```

3. **Start development server**
   ```bash
   npm run dev
   ```

4. **Activate theme** in WordPress admin

---

## 🛠️ Development

### Available Scripts

```bash
# Development mode with hot reload
npm run dev

# Build for production
npm run build

# Watch mode (auto rebuild on changes)
npm run watch

# Clean build directory
npm run clean

# Lint JavaScript/Svelte
npm run lint

# Format code with Prettier
npm run format

# Type checking (if using TypeScript)
npm run type-check
```

### Development Workflow

1. **Start dev server**
   ```bash
   npm run dev
   ```

2. **Make your changes** in `svelte/` or `assets/` directories

3. **View changes** - Vite will hot reload your changes automatically

4. **Build for production** when ready
   ```bash
   npm run build
   ```

### Environment Setup

Create `.env` file (optional):
```env
# Development
VITE_DEV_SERVER_PORT=5173
VITE_DEV_SERVER_HOST=localhost

# WordPress
WP_HOME=http://localhost/wordpress
WP_SITEURL=http://localhost/wordpress
```

---

## 📁 Theme Structure

```
blaze-theme/
├── assets/              # Source files
│   ├── css/            # Tailwind CSS entry
│   ├── js/             # JavaScript files
│   └── images/         # Images and icons
│
├── dist/               # Build output (generated)
│   ├── css/           # Compiled CSS
│   └── js/            # Compiled JavaScript
│
├── inc/                # PHP includes
│   ├── customizer.php      # Theme customizer
│   ├── theme-setup.php     # Theme setup
│   ├── enqueue.php         # Asset loading
│   ├── template-tags.php   # Helper functions
│   └── admin/              # Admin functionality
│
├── svelte/             # Svelte components
│   ├── components/    # UI components
│   ├── stores/        # State management
│   └── main.js        # Entry point
│
├── template-parts/     # Reusable template parts
│   ├── header/        # Header components
│   ├── footer/        # Footer components
│   ├── content/       # Content layouts
│   ├── post/          # Post components
│   ├── page/          # Page components
│   └── blocks/        # Content blocks
│
├── templates/          # Page templates
│   ├── full-width.php
│   ├── landing-page.php
│   └── blog-grid.php
│
├── languages/          # Translations
│
├── functions.php       # Main functions file
├── style.css          # Theme info (required)
├── index.php          # Main template
├── header.php         # Global header
├── footer.php         # Global footer
└── sidebar.php        # Sidebar template
```

---

## 🎨 Customization

### WordPress Customizer

Access via **Appearance → Customize**

#### Available Options:

**Site Identity**
- Site logo
- Site title & tagline
- Site icon (favicon)

**Colors**
- Primary color
- Secondary color
- Text colors
- Background colors
- Link colors

**Typography**
- Font family
- Font sizes
- Line heights
- Letter spacing

**Layout**
- Container width
- Sidebar position
- Blog layout (grid, list, masonry)
- Posts per page

**Header**
- Header style
- Menu position
- Search toggle
- Social icons

**Footer**
- Footer layout
- Widget areas
- Copyright text
- Social links

### Customizer API (PHP)

```php
// Add custom setting
$wp_customize->add_setting('blaze_custom_setting', [
    'default' => 'value',
    'sanitize_callback' => 'sanitize_text_field',
]);

// Add control
$wp_customize->add_control('blaze_custom_setting', [
    'label' => __('Custom Setting', 'blaze'),
    'section' => 'blaze_section',
    'type' => 'text',
]);
```

### CSS Custom Properties

Theme uses CSS variables for easy customization:

```css
:root {
    --color-primary: #DC2626;
    --color-secondary: #3B82F6;
    --font-family: system-ui, -apple-system, sans-serif;
    --font-size-base: 16px;
    --border-radius: 8px;
    --container-width: 1200px;
}
```

Override in **Additional CSS** (Customizer) or child theme.

---

## 🧩 Components

### Svelte Components

#### Admin Components

**ColorPicker.svelte**
```svelte
<ColorPicker 
    settingId="primary_color"
    defaultColor="#DC2626"
/>
```

**RangeSlider.svelte**
```svelte
<RangeSlider 
    settingId="font_size"
    min={12}
    max={24}
    step={1}
    defaultValue={16}
    unit="px"
/>
```

#### Frontend Components

**Header.svelte**
```svelte
<Header 
    siteName="Blaze Theme"
    siteTagline="Fast & Modern"
/>
```

**MobileMenu.svelte**
```svelte
<MobileMenu 
    {menuItems}
/>
```

**SearchModal.svelte**
```svelte
<SearchModal 
    searchUrl="/search"
/>
```

**Newsletter.svelte**
```svelte
<Newsletter 
    apiUrl="/wp-json/blaze/v1/newsletter"
/>
```

#### Blog Components

**PostCard.svelte**
```svelte
<PostCard 
    {post}
/>
```

**PostGrid.svelte**
```svelte
<PostGrid 
    {posts}
    category="all"
/>
```

**PostMeta.svelte**
```svelte
<PostMeta 
    {author}
    {date}
    {category}
    readingTime="5 min"
/>
```

#### Shared Components

**Button.svelte**
```svelte
<Button 
    variant="primary"
    size="md"
    href="/link"
>
    Click Me
</Button>
```

**Modal.svelte**
```svelte
<Modal 
    title="Modal Title"
    size="md"
>
    <p>Modal content</p>
</Modal>
```

**Loader.svelte**
```svelte
<Loader 
    type="spinner"
    size="md"
    color="primary"
/>
```

### Using Components in PHP

```php
<!-- Mount point for Svelte component -->
<div id="mobile-menu-mount" 
     data-menu-items='<?php echo json_encode($menu_items); ?>'>
</div>

<?php
// Component will auto-initialize via main.js
```

---

## 📄 Template System

### Page Templates

Select template in WordPress editor:

- **Full Width** - No sidebar, full content width
- **Landing Page** - Hero + sections layout
- **Blog Grid** - Posts in grid layout
- **Blog Masonry** - Pinterest-style layout
- **No Sidebar** - Content without sidebar
- **Blank Canvas** - Completely blank page

### Template Parts

Reusable template components:

```php
// Load header branding
get_template_part('template-parts/header/site-branding');

// Load post content by type
get_template_part('template-parts/content/content', get_post_type());

// Load post metadata
get_template_part('template-parts/post/post-meta');

// Load custom block
get_template_part('template-parts/blocks/hero');
```

### Custom Template Example

```php
<?php
/**
 * Template Name: Custom Layout
 */

get_header();
?>

<main class="container mx-auto px-4 py-8">
    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content/content', 'page');
    endwhile;
    ?>
</main>

<?php
get_footer();
```

---

## ⚡ Performance

### Optimization Features

- **Code Splitting** - Only load what's needed
- **Tree Shaking** - Remove unused code
- **Image Lazy Loading** - Native lazy loading
- **Critical CSS** - Inline critical styles
- **Asset Minification** - Minified CSS/JS in production
- **Caching** - Browser cache headers
- **Preloading** - Preload critical assets

### Performance Tips

1. **Use WebP images** for better compression
2. **Enable caching plugin** (WP Super Cache, W3 Total Cache)
3. **Use CDN** for static assets
4. **Lazy load images** (built-in support)
5. **Minimize plugins** - Only use what you need
6. **Database optimization** - Clean up regularly

### Lighthouse Scores

Target scores:
- **Performance**: 90+
- **Accessibility**: 95+
- **Best Practices**: 95+
- **SEO**: 100

---

## 🌐 Browser Support

| Browser | Supported Versions |
|---------|-------------------|
| Chrome | Last 2 versions |
| Firefox | Last 2 versions |
| Safari | Last 2 versions |
| Edge | Last 2 versions |
| Opera | Last 2 versions |
| iOS Safari | Last 2 versions |
| Android Chrome | Last 2 versions |

**Note**: Internet Explorer is not supported.

---

## 🤝 Contributing

We welcome contributions! Here's how you can help:

### Reporting Bugs

1. Check if issue already exists
2. Create detailed bug report with:
   - WordPress version
   - PHP version
   - Theme version
   - Steps to reproduce
   - Expected vs actual behavior
   - Screenshots (if applicable)

### Suggesting Features

1. Open an issue with `[Feature Request]` tag
2. Describe the feature and use case
3. Provide mockups/examples if possible

### Pull Requests

1. Fork the repository
2. Create feature branch: `git checkout -b feature/amazing-feature`
3. Commit changes: `git commit -m 'Add amazing feature'`
4. Push to branch: `git push origin feature/amazing-feature`
5. Open a Pull Request

### Development Guidelines

- Follow WordPress Coding Standards
- Use meaningful commit messages
- Add comments for complex logic
- Test thoroughly before submitting
- Update documentation if needed

---

## 📜 License

Blaze Theme is licensed under the **GNU General Public License v2 or later**.

```
This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License along
with this program; if not, write to the Free Software Foundation, Inc.,
51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
```

Full license text: [GPL-2.0](https://www.gnu.org/licenses/gpl-2.0.html)

### Third-Party Licenses

- **Tailwind CSS** - MIT License
- **Svelte** - MIT License
- **Vite** - MIT License
- **Lucide Icons** - ISC License

---

## 🙏 Credits

### Created By

**Your Name / Team Name**
- Website: [https://yourwebsite.com](https://yourwebsite.com)
- GitHub: [@yourusername](https://github.com/yourusername)
- Email: your.email@example.com

### Built With

- [WordPress](https://wordpress.org/) - CMS
- [Tailwind CSS v4](https://tailwindcss.com/) - CSS Framework
- [Svelte](https://svelte.dev/) - JavaScript Framework
- [Vite](https://vitejs.dev/) - Build Tool
- [Lucide Icons](https://lucide.dev/) - Icon Library

### Special Thanks

- WordPress community
- Tailwind Labs team
- Svelte core team
- All contributors

---

## 📞 Support

### Documentation

- [Theme Documentation](https://yourwebsite.com/docs)
- [Video Tutorials](https://yourwebsite.com/tutorials)
- [FAQs](https://yourwebsite.com/faq)

### Get Help

- **Issues**: [GitHub Issues](https://github.com/yourusername/blaze-theme/issues)
- **Forum**: [WordPress Support](https://wordpress.org/support/theme/blaze)
- **Email**: support@yourwebsite.com

### Professional Support

Need custom development or premium support?
- Contact: pro@yourwebsite.com
- Website: [https://yourwebsite.com/support](https://yourwebsite.com/support)

---

## 🎉 Changelog

### Version 1.0.0 (2025-12-29)
- 🎉 Initial release
- ✨ Tailwind CSS v4 integration
- ✨ Svelte component system
- ✨ WordPress Customizer integration
- ✨ Responsive design
- ✨ Dark mode support
- ✨ WooCommerce compatibility
- ✨ Multiple blog layouts
- ✨ SEO optimized
- ✨ Translation ready

---

## 🗺️ Roadmap

### Version 1.1.0 (Q1 2026)
- [ ] Advanced typography options
- [ ] More blog layouts
- [ ] Header builder
- [ ] Footer builder
- [ ] Animation effects

### Version 1.2.0 (Q2 2026)
- [ ] Page builder integration
- [ ] More Gutenberg blocks
- [ ] Advanced WooCommerce features
- [ ] Membership integration
- [ ] Advanced search

### Version 2.0.0 (Q3 2026)
- [ ] Full Site Editing (FSE)
- [ ] Block patterns library
- [ ] Theme variations
- [ ] AI-powered features
- [ ] Performance improvements

---

## 📱 Follow Us

Stay updated with latest releases and news:

- **Twitter**: [@blazetheme](https://twitter.com/blazetheme)
- **Facebook**: [Blaze Theme](https://facebook.com/blazetheme)
- **Instagram**: [@blaze.theme](https://instagram.com/blaze.theme)
- **YouTube**: [Blaze Theme Channel](https://youtube.com/blazetheme)

---

<div align="center">

**Made with ❤️ and ☕ by [Your Name]**

If you find this theme helpful, please consider:
- ⭐ Starring the repository
- 🐦 Sharing on social media
- 💖 [Buying me a coffee](https://buymeacoffee.com/yourusername)

</div>

---

**🔥 Blaze Theme** - *Fast. Modern. Beautiful.*