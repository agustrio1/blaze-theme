blaze-theme/
├── assets/
│   ├── css/
│   │   └── main.css                 # Tailwind v4 entry point
│   ├── js/
│   │   ├── main.js                  # Main JS entry
│   │   └── admin.js                 # Customizer admin scripts
│   └── images/
│       ├── logo.svg
│       ├── placeholder.jpg
│       └── icons/
│
├── dist/                            # Build output (generated)
│   ├── css/
│   │   └── main.css
│   └── js/
│       ├── bundle.js
│       └── admin.js
│
├── inc/
│   ├── customizer.php               # Theme customizer settings
│   ├── theme-setup.php              # Theme support & features
│   ├── enqueue.php                  # Scripts & styles enqueue
│   ├── template-tags.php            # Custom template functions
│   ├── post-types.php               # Custom post types
│   ├── widgets.php                  # Widget areas
│   └── admin/
│       └── customizer-preview.php   # Live preview handler
│
├── svelte/
│   ├── components/
│   │   ├── admin/
│   │   │   ├── ColorPicker.svelte   # Customizer color picker
│   │   │   └── RangeSlider.svelte   # Customizer slider
│   │   ├── frontend/
│   │   │   ├── Header.svelte        # Dynamic header
│   │   │   ├── MobileMenu.svelte    # Mobile navigation
│   │   │   ├── SearchModal.svelte   # Search overlay
│   │   │   └── Newsletter.svelte    # Newsletter form
│   │   ├── blog/
│   │   │   ├── PostCard.svelte      # Blog post card
│   │   │   ├── PostGrid.svelte      # Posts grid layout
│   │   │   └── PostMeta.svelte      # Post metadata
│   │   └── shared/
│   │       ├── Button.svelte        # Reusable button
│   │       ├── Modal.svelte         # Modal component
│   │       └── Loader.svelte        # Loading spinner
│   ├── stores/
│   │   ├── theme.js                 # Theme state management
│   │   ├── menu.js                  # Menu state
│   │   └── search.js                # Search state
│   └── main.js                      # Svelte entry point
│
├── template-parts/
│   ├── header/
│   │   ├── site-branding.php        # Logo & site title
│   │   ├── navigation.php           # Main navigation menu
│   │   └── mobile-menu.php          # Mobile menu toggle
│   │
│   ├── footer/
│   │   ├── widgets.php              # Footer widget areas
│   │   ├── social-menu.php          # Social media links
│   │   └── copyright.php            # Copyright text
│   │
│   ├── content/
│   │   ├── content.php              # Default post content
│   │   ├── content-single.php       # Single post content
│   │   ├── content-page.php         # Page content
│   │   ├── content-none.php         # No content found
│   │   └── content-search.php       # Search results content
│   │
│   ├── post/
│   │   ├── post-meta.php            # Post metadata (date, author)
│   │   ├── post-thumbnail.php       # Featured image
│   │   ├── post-navigation.php      # Next/prev post links
│   │   └── related-posts.php        # Related posts section
│   │
│   ├── page/
│   │   ├── page-header.php          # Page title section
│   │   └── breadcrumbs.php          # Breadcrumb navigation
│   │
│   ├── blocks/
│   │   ├── hero.php                 # Hero section
│   │   ├── features.php             # Features grid
│   │   ├── testimonials.php         # Testimonials slider
│   │   ├── cta.php                  # Call-to-action section
│   │   └── newsletter.php           # Newsletter signup
│   │
│   ├── woocommerce/                 # WooCommerce support (optional)
│   │   ├── product-card.php
│   │   └── cart-dropdown.php
│   │
│   └── widgets/
│       ├── recent-posts.php         # Recent posts widget
│       └── categories.php           # Categories widget
│
├── templates/
│   ├── full-width.php               # Full width page template
│   ├── landing-page.php             # Landing page template
│   ├── blog-grid.php                # Blog grid layout
│   ├── blog-masonry.php             # Blog masonry layout
│   ├── no-sidebar.php               # Page without sidebar
│   ├── blank.php                    # Blank canvas template
│   └── page-builder.php             # Page builder template
│
├── woocommerce/                     # WooCommerce template overrides
│   ├── single-product.php
│   ├── archive-product.php
│   └── cart/
│       └── cart.php
│
├── languages/
│   ├── blaze.pot                    # Translation template
│   └── id_ID.po                     # Indonesian translation
│
├── functions.php                    # Main theme functions
├── style.css                        # Theme header (required)
├── screenshot.png                   # Theme screenshot
│
├── index.php                        # Main template fallback
├── home.php                         # Blog home page
├── front-page.php                   # Static front page
├── single.php                       # Single post template
├── page.php                         # Single page template
├── archive.php                      # Archive template
├── search.php                       # Search results template
├── 404.php                          # 404 error page
│
├── header.php                       # Global header
├── footer.php                       # Global footer
├── sidebar.php                      # Main sidebar
│
├── comments.php                     # Comments template
│
├── tailwind.config.js               # Tailwind v4 config
├── vite.config.js                   # Vite build config
├── package.json                     # NPM dependencies
├── .gitignore
└── README.md                        # Theme documentation


═══════════════════════════════════════════════════════════
📁 DETAIL STRUKTUR & FUNGSI
═══════════════════════════════════════════════════════════

📂 template-parts/ (Reusable PHP components)
├── header/          → Header components
├── footer/          → Footer components  
├── content/         → Post/page content layouts
├── post/            → Post-specific parts
├── page/            → Page-specific parts
├── blocks/          → Reusable content blocks
├── woocommerce/     → E-commerce parts (optional)
└── widgets/         → Custom widget templates

📂 templates/ (Full page templates)
├── full-width.php       → No sidebar, full width
├── landing-page.php     → Marketing landing page
├── blog-grid.php        → Blog with grid layout
├── blog-masonry.php     → Pinterest-style blog
├── no-sidebar.php       → Content without sidebar
├── blank.php            → Completely blank page
└── page-builder.php     → Compatible with page builders

📂 svelte/components/
├── admin/           → Customizer components
├── frontend/        → Public-facing interactive components
├── blog/            → Blog-specific components
└── shared/          → Reusable UI components

═══════════════════════════════════════════════════════════
🎯 CARA PENGGUNAAN
═══════════════════════════════════════════════════════════

1. TEMPLATE PARTS (dalam PHP templates):
   
   get_template_part('template-parts/header/site-branding');
   get_template_part('template-parts/content/content', get_post_type());
   get_template_part('template-parts/post/post-meta');

2. PAGE TEMPLATES (pilih di WordPress admin):
   
   Templates → Dropdown di editor halaman
   User bisa pilih: Full Width, Landing Page, dll

3. SVELTE COMPONENTS (mount di PHP):
   
   <div id="mobile-menu"></div>
   <script>
     new MobileMenu({
       target: document.getElementById('mobile-menu')
     });
   </script>

═══════════════════════════════════════════════════════════
📝 NAMING CONVENTIONS
═══════════════════════════════════════════════════════════

✓ PHP Files:       lowercase-with-hyphens.php
✓ Svelte Files:    PascalCase.svelte
✓ Folders:         lowercase (no hyphens)
✓ JS/CSS:          kebab-case.js / kebab-case.css

═══════════════════════════════════════════════════════════