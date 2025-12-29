/**
 * Main JavaScript Entry Point
 * Blaze Theme - Frontend Scripts
 */

import '../css/main.css';

// Import Svelte Components
import Header from '../svelte/components/frontend/Header.svelte';
import MobileMenu from '../svelte/components/frontend/MobileMenu.svelte';
import SearchModal from '../svelte/components/frontend/SearchModal.svelte';
import Newsletter from '../svelte/components/frontend/Newsletter.svelte';
import PostGrid from '../svelte/components/blog/PostGrid.svelte';

/**
 * Initialize application when DOM is ready
 */
document.addEventListener('DOMContentLoaded', () => {
  initializeSvelteComponents();
  initializeSmoothScroll();
  initializeLazyLoading();
  initializeBackToTop();
  initializeCommentForm();
  initializeExternalLinks();
});

/**
 * Initialize all Svelte components
 */
function initializeSvelteComponents() {
  // Header Component
  const headerMount = document.getElementById('header-mount');
  if (headerMount) {
    new Header({
      target: headerMount,
      props: {
        siteName: headerMount.dataset.siteName || 'Blaze Theme',
        siteTagline: headerMount.dataset.siteTagline || ''
      }
    });
  }

  // Mobile Menu Component
  const mobileMenuMount = document.getElementById('mobile-menu-mount');
  if (mobileMenuMount) {
    new MobileMenu({
      target: mobileMenuMount,
      props: {
        menuItems: JSON.parse(mobileMenuMount.dataset.menuItems || '[]')
      }
    });
  }

  // Search Modal Component
  const searchModalMount = document.getElementById('search-modal-mount');
  if (searchModalMount) {
    new SearchModal({
      target: searchModalMount,
      props: {
        searchUrl: searchModalMount.dataset.searchUrl || '/search'
      }
    });
  }

  // Newsletter Component
  const newsletterMounts = document.querySelectorAll('.newsletter-mount');
  newsletterMounts.forEach(mount => {
    new Newsletter({
      target: mount,
      props: {
        apiUrl: mount.dataset.apiUrl || '/wp-json/blaze/v1/newsletter'
      }
    });
  });

  // Post Grid Component
  const postGridMount = document.getElementById('post-grid-mount');
  if (postGridMount) {
    new PostGrid({
      target: postGridMount,
      props: {
        posts: JSON.parse(postGridMount.dataset.posts || '[]'),
        category: postGridMount.dataset.category || 'all'
      }
    });
  }
}

/**
 * Smooth scroll for anchor links
 */
function initializeSmoothScroll() {
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const href = this.getAttribute('href');
      
      // Skip if href is just "#"
      if (href === '#' || href === '#!') {
        e.preventDefault();
        return;
      }

      const target = document.querySelector(href);
      if (target) {
        e.preventDefault();
        const offsetTop = target.getBoundingClientRect().top + window.pageYOffset - 80;
        
        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });

        // Update URL without jumping
        history.pushState(null, null, href);
      }
    });
  });
}

/**
 * Lazy loading for images
 */
function initializeLazyLoading() {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        const src = img.getAttribute('data-src');
        
        if (src) {
          img.src = src;
          img.removeAttribute('data-src');
          img.classList.add('loaded');
        }
        
        observer.unobserve(img);
      }
    });
  }, {
    rootMargin: '50px 0px',
    threshold: 0.01
  });

  document.querySelectorAll('img[data-src]').forEach(img => {
    imageObserver.observe(img);
  });
}

/**
 * Back to top button
 */
function initializeBackToTop() {
  const backToTop = document.createElement('button');
  backToTop.innerHTML = '↑';
  backToTop.className = 'back-to-top fixed bottom-8 right-8 w-12 h-12 bg-primary text-white rounded-full shadow-lg opacity-0 pointer-events-none transition-all duration-300 hover:bg-primary-dark z-50';
  backToTop.setAttribute('aria-label', 'Back to top');
  document.body.appendChild(backToTop);

  // Show/hide on scroll
  window.addEventListener('scroll', () => {
    if (window.pageYOffset > 300) {
      backToTop.classList.remove('opacity-0', 'pointer-events-none');
    } else {
      backToTop.classList.add('opacity-0', 'pointer-events-none');
    }
  });

  // Scroll to top on click
  backToTop.addEventListener('click', () => {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
}

/**
 * Enhanced comment form
 */
function initializeCommentForm() {
  const commentForm = document.getElementById('commentform');
  if (!commentForm) return;

  // Add loading state
  commentForm.addEventListener('submit', function() {
    const submitBtn = this.querySelector('input[type="submit"]');
    if (submitBtn) {
      submitBtn.value = 'Sending...';
      submitBtn.disabled = true;
    }
  });

  // Character counter for comment textarea
  const commentTextarea = commentForm.querySelector('#comment');
  if (commentTextarea) {
    const maxLength = 1000;
    const counter = document.createElement('div');
    counter.className = 'text-sm text-gray-500 mt-2';
    commentTextarea.parentNode.appendChild(counter);

    const updateCounter = () => {
      const remaining = maxLength - commentTextarea.value.length;
      counter.textContent = `${remaining} characters remaining`;
      
      if (remaining < 100) {
        counter.classList.add('text-warning');
      } else {
        counter.classList.remove('text-warning');
      }
    };

    commentTextarea.addEventListener('input', updateCounter);
    updateCounter();
  }
}

/**
 * Add target="_blank" and rel="noopener" to external links
 */
function initializeExternalLinks() {
  const domain = window.location.hostname;
  const links = document.querySelectorAll('a[href^="http"]');
  
  links.forEach(link => {
    const linkDomain = new URL(link.href).hostname;
    
    if (linkDomain !== domain) {
      link.setAttribute('target', '_blank');
      link.setAttribute('rel', 'noopener noreferrer');
      
      // Add external link icon
      if (!link.querySelector('.external-icon')) {
        const icon = document.createElement('span');
        icon.className = 'external-icon inline-block ml-1';
        icon.innerHTML = '↗';
        link.appendChild(icon);
      }
    }
  });
}

/**
 * Header scroll effect
 */
window.addEventListener('scroll', () => {
  const header = document.querySelector('header');
  if (!header) return;

  if (window.pageYOffset > 100) {
    header.classList.add('scrolled', 'shadow-md');
  } else {
    header.classList.remove('scrolled', 'shadow-md');
  }
});

/**
 * Mobile menu toggle (fallback if Svelte not loaded)
 */
const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
const mobileMenu = document.querySelector('.mobile-menu');

if (mobileMenuToggle && mobileMenu) {
  mobileMenuToggle.addEventListener('click', () => {
    mobileMenu.classList.toggle('active');
    document.body.classList.toggle('menu-open');
  });

  // Close on overlay click
  const overlay = mobileMenu.querySelector('.overlay');
  if (overlay) {
    overlay.addEventListener('click', () => {
      mobileMenu.classList.remove('active');
      document.body.classList.remove('menu-open');
    });
  }
}

/**
 * Copy code blocks
 */
document.querySelectorAll('pre code').forEach(block => {
  const wrapper = block.parentElement;
  const button = document.createElement('button');
  button.className = 'copy-code-btn absolute top-2 right-2 px-3 py-1 bg-gray-700 text-white text-xs rounded hover:bg-gray-600 transition-colors';
  button.textContent = 'Copy';
  
  wrapper.style.position = 'relative';
  wrapper.appendChild(button);

  button.addEventListener('click', () => {
    const code = block.textContent;
    navigator.clipboard.writeText(code).then(() => {
      button.textContent = 'Copied!';
      button.classList.add('bg-green-600');
      
      setTimeout(() => {
        button.textContent = 'Copy';
        button.classList.remove('bg-green-600');
      }, 2000);
    });
  });
});

/**
 * Reading progress bar
 */
const article = document.querySelector('article');
if (article) {
  const progressBar = document.createElement('div');
  progressBar.className = 'reading-progress fixed top-0 left-0 w-0 h-1 bg-primary z-50 transition-all duration-150';
  document.body.appendChild(progressBar);

  window.addEventListener('scroll', () => {
    const articleHeight = article.offsetHeight;
    const articleTop = article.offsetTop;
    const windowHeight = window.innerHeight;
    const scrollTop = window.pageYOffset;
    
    const scrolled = scrollTop - articleTop + windowHeight;
    const progress = Math.min(Math.max((scrolled / articleHeight) * 100, 0), 100);
    
    progressBar.style.width = `${progress}%`;
  });
}

/**
 * Table of contents generator
 */
const tocContainer = document.getElementById('table-of-contents');
if (tocContainer && article) {
  const headings = article.querySelectorAll('h2, h3');
  
  if (headings.length > 2) {
    const toc = document.createElement('ul');
    toc.className = 'space-y-2';
    
    headings.forEach((heading, index) => {
      const id = heading.id || `heading-${index}`;
      heading.id = id;
      
      const li = document.createElement('li');
      li.className = heading.tagName === 'H3' ? 'ml-4' : '';
      
      const link = document.createElement('a');
      link.href = `#${id}`;
      link.textContent = heading.textContent;
      link.className = 'text-gray-600 hover:text-primary transition-colors';
      
      li.appendChild(link);
      toc.appendChild(li);
    });
    
    tocContainer.appendChild(toc);
  }
}

console.log('🔥 Blaze Theme loaded successfully!');