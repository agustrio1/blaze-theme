<?php>

/**
 * Customizer Live Preview
 * Handles real-time updates in the WordPress Customizer
 * 
 * @package Blaze_Theme
 */

(function($) {
    'use strict';
    
    const wp = window.wp;
    
    if (!wp || !wp.customize) {
        return;
    }
    
    // ===============================
    // COLOR SETTINGS
    // ===============================
    
    // Primary Color
    wp.customize('blaze_primary_color', function(value) {
        value.bind(function(newColor) {
            updateCSSVariable('--color-primary', newColor);
            
            // Update all elements with primary color
            $('a, .text-primary, .btn-primary').css('color', newColor);
            $('.bg-primary').css('background-color', newColor);
            $('.border-primary').css('border-color', newColor);
        });
    });
    
    // Secondary Color
    wp.customize('blaze_secondary_color', function(value) {
        value.bind(function(newColor) {
            updateCSSVariable('--color-secondary', newColor);
            $('.text-secondary, .bg-secondary').css('color', newColor);
        });
    });
    
    // Text Color
    wp.customize('blaze_text_color', function(value) {
        value.bind(function(newColor) {
            updateCSSVariable('--color-text', newColor);
            $('body').css('color', newColor);
        });
    });
    
    // ===============================
    // TYPOGRAPHY SETTINGS
    // ===============================
    
    // Heading Font
    wp.customize('blaze_heading_font', function(value) {
        value.bind(function(newFont) {
            updateCSSVariable('--font-heading', `'${newFont}', sans-serif`);
            $('h1, h2, h3, h4, h5, h6').css('font-family', `'${newFont}', sans-serif`);
            
            // Load Google Font dynamically
            loadGoogleFont(newFont);
        });
    });
    
    // Body Font
    wp.customize('blaze_body_font', function(value) {
        value.bind(function(newFont) {
            updateCSSVariable('--font-body', `'${newFont}', sans-serif`);
            $('body').css('font-family', `'${newFont}', sans-serif`);
            
            // Load Google Font dynamically
            loadGoogleFont(newFont);
        });
    });
    
    // Font Size
    wp.customize('blaze_font_size', function(value) {
        value.bind(function(newSize) {
            updateCSSVariable('--font-size-base', `${newSize}px`);
            $('body').css('font-size', `${newSize}px`);
        });
    });
    
    // ===============================
    // HEADER SETTINGS
    // ===============================
    
    // Show Search
    wp.customize('blaze_show_search', function(value) {
        value.bind(function(isVisible) {
            $('.header-search').toggle(isVisible);
        });
    });
    
    // ===============================
    // FOOTER SETTINGS
    // ===============================
    
    // Copyright Text
    wp.customize('blaze_copyright_text', function(value) {
        value.bind(function(newText) {
            $('.copyright-text').html(newText);
        });
    });
    
    // Show Social Links
    wp.customize('blaze_show_social', function(value) {
        value.bind(function(isVisible) {
            $('.footer-social').toggle(isVisible);
        });
    });
    
    // ===============================
    // SITE IDENTITY
    // ===============================
    
    // Site Title
    wp.customize('blogname', function(value) {
        value.bind(function(newTitle) {
            $('.site-title, .site-title a').text(newTitle);
            document.title = newTitle;
        });
    });
    
    // Site Tagline
    wp.customize('blogdescription', function(value) {
        value.bind(function(newTagline) {
            $('.site-description').text(newTagline);
        });
    });
    
    // ===============================
    // HELPER FUNCTIONS
    // ===============================
    
    /**
     * Update CSS Variable
     */
    function updateCSSVariable(variable, value) {
        document.documentElement.style.setProperty(variable, value);
    }
    
    /**
     * Load Google Font Dynamically
     */
    function loadGoogleFont(fontName) {
        // Check if font is already loaded
        const existingLink = $(`link[href*="${fontName.replace(' ', '+')}"]`);
        
        if (existingLink.length > 0) {
            return;
        }
        
        // Create new link element
        const fontUrl = `https://fonts.googleapis.com/css2?family=${fontName.replace(' ', '+')}:wght@400;500;600;700;900&display=swap`;
        const link = $('<link>', {
            rel: 'stylesheet',
            href: fontUrl
        });
        
        $('head').append(link);
    }
    
    /**
     * Debounce function for performance
     */
    function debounce(func, wait) {
        let timeout;
        return function executedFunction(...args) {
            const later = () => {
                clearTimeout(timeout);
                func(...args);
            };
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
        };
    }
    
    /**
     * Show preview notification
     */
    function showPreviewNotification(message, type = 'success') {
        const notification = $('<div>', {
            class: `preview-notification preview-notification-${type}`,
            text: message,
            css: {
                position: 'fixed',
                top: '20px',
                right: '20px',
                padding: '12px 20px',
                background: type === 'success' ? '#00a32a' : '#2271b1',
                color: 'white',
                borderRadius: '4px',
                boxShadow: '0 4px 6px rgba(0, 0, 0, 0.1)',
                zIndex: 999999,
                fontSize: '13px',
                fontWeight: 500,
                animation: 'slideIn 0.3s ease'
            }
        });
        
        $('body').append(notification);
        
        setTimeout(() => {
            notification.fadeOut(300, function() {
                $(this).remove();
            });
        }, 2000);
    }
    
    // ===============================
    // LIVE PREVIEW ENHANCEMENTS
    // ===============================
    
    /**
     * Highlight elements on hover in customizer
     */
    $(document).on('mouseenter', '[data-customize-partial-id]', function() {
        $(this).css('outline', '2px dashed #2271b1');
    }).on('mouseleave', '[data-customize-partial-id]', function() {
        $(this).css('outline', 'none');
    });
    
    /**
     * Smooth scroll to changed element
     */
    wp.customize.selectiveRefresh.bind('partial-content-rendered', function(placement) {
        if (placement && placement.container) {
            $('html, body').animate({
                scrollTop: $(placement.container).offset().top - 100
            }, 500);
        }
    });
    
    /**
     * Log customizer changes for debugging
     */
    if (window.console && window.console.log) {
        wp.customize.bind('change', function(setting) {
            console.log('Setting changed:', setting.id, '=', setting.get());
        });
    }
    
    // console.log('🔥 Blaze Customizer Preview loaded!');
    
})(jQuery);