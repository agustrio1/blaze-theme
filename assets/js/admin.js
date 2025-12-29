/**
 * Admin Scripts for WordPress Customizer
 * Blaze Theme - Customizer Enhancement
 */

import ColorPicker from '../../svelte/components/admin/ColorPicker.svelte';
import RangeSlider from '../../svelte/components/admin/RangeSlider.svelte';

document.addEventListener('DOMContentLoaded', () => {
  initializeColorPickers();
  initializeRangeSliders();
  addHelpTooltips();
  addLivePreviewToggle();
  addCustomizerStyles();
});

/**
 * Initialize enhanced color pickers
 */
function initializeColorPickers() {
  const colorPickerMounts = document.querySelectorAll('.blaze-color-picker');
  
  colorPickerMounts.forEach(mount => {
    const settingId = mount.dataset.setting;
    const defaultColor = mount.dataset.default || '#DC2626';
    
    new ColorPicker({
      target: mount,
      props: {
        settingId,
        defaultColor
      }
    });
  });
}

/**
 * Initialize enhanced range sliders
 */
function initializeRangeSliders() {
  const sliderMounts = document.querySelectorAll('.blaze-range-slider');
  
  sliderMounts.forEach(mount => {
    const settingId = mount.dataset.setting;
    const min = parseInt(mount.dataset.min) || 0;
    const max = parseInt(mount.dataset.max) || 100;
    const step = parseInt(mount.dataset.step) || 1;
    const defaultValue = parseInt(mount.dataset.default) || 50;
    const unit = mount.dataset.unit || '';
    
    new RangeSlider({
      target: mount,
      props: {
        settingId,
        min,
        max,
        step,
        defaultValue,
        unit
      }
    });
  });
}

/**
 * Add help tooltips to customizer controls
 */
function addHelpTooltips() {
  const controls = document.querySelectorAll('.customize-control');
  
  controls.forEach(control => {
    const description = control.querySelector('.description');
    if (!description) return;
    
    // Hide description by default
    description.style.display = 'none';
    
    const tooltip = document.createElement('span');
    tooltip.className = 'dashicons dashicons-editor-help blaze-tooltip-trigger';
    tooltip.style.cssText = `
      cursor: pointer;
      margin-left: 5px;
      color: #2271b1;
      transition: color 0.2s;
    `;
    tooltip.title = 'Click for help';
    
    const label = control.querySelector('.customize-control-title');
    if (label) {
      label.style.display = 'flex';
      label.style.alignItems = 'center';
      label.appendChild(tooltip);
      
      tooltip.addEventListener('click', (e) => {
        e.preventDefault();
        const isVisible = description.style.display === 'block';
        description.style.display = isVisible ? 'none' : 'block';
        tooltip.style.color = isVisible ? '#2271b1' : '#d63638';
      });
      
      tooltip.addEventListener('mouseenter', () => {
        tooltip.style.color = '#135e96';
      });
      
      tooltip.addEventListener('mouseleave', () => {
        const isVisible = description.style.display === 'block';
        tooltip.style.color = isVisible ? '#d63638' : '#2271b1';
      });
    }
  });
}

/**
 * Add live preview toggle for better performance
 */
function addLivePreviewToggle() {
  if (!window.wp || !window.wp.customize) return;
  
  const panel = document.querySelector('#customize-theme-controls');
  if (!panel) return;
  
  const toggle = document.createElement('div');
  toggle.className = 'blaze-live-preview-toggle';
  toggle.innerHTML = `
    <div style="padding: 12px; background: #f0f0f1; margin: 10px; border-radius: 4px;">
      <label style="display: flex; align-items: center; cursor: pointer;">
        <input type="checkbox" id="blaze-live-preview" checked style="margin-right: 8px;">
        <span style="font-weight: 500;">Enable Live Preview</span>
      </label>
      <p style="margin: 8px 0 0 24px; font-size: 12px; color: #646970;">
        Disable for better performance on slower devices
      </p>
    </div>
  `;
  
  panel.prepend(toggle);
  
  const checkbox = document.getElementById('blaze-live-preview');
  
  checkbox.addEventListener('change', (e) => {
    const isEnabled = e.target.checked;
    
    // Store preference
    localStorage.setItem('blaze_live_preview', isEnabled ? '1' : '0');
    
    // Toggle transport method for all Blaze settings
    Object.keys(wp.customize.settings.values).forEach(key => {
      if (key.startsWith('blaze_')) {
        const setting = wp.customize(key);
        if (setting) {
          setting.transport = isEnabled ? 'postMessage' : 'refresh';
        }
      }
    });
    
    // Show notification
    showNotification(
      isEnabled ? 'Live preview enabled' : 'Live preview disabled',
      isEnabled ? 'success' : 'info'
    );
  });
  
  // Load saved preference
  const saved = localStorage.getItem('blaze_live_preview');
  if (saved === '0') {
    checkbox.checked = false;
    checkbox.dispatchEvent(new Event('change'));
  }
}

/**
 * Add custom styles to customizer
 */
function addCustomizerStyles() {
  const style = document.createElement('style');
  style.textContent = `
    /* Blaze Customizer Enhancements */
    .blaze-color-picker-wrapper {
      margin-top: 8px;
    }
    
    .blaze-range-slider-wrapper {
      margin-top: 8px;
    }
    
    .customize-control-description {
      margin-top: 8px;
      padding: 8px 12px;
      background: #f0f0f1;
      border-left: 3px solid #2271b1;
      border-radius: 2px;
      font-size: 12px;
      line-height: 1.5;
    }
    
    .blaze-tooltip-trigger {
      font-size: 16px;
    }
    
    /* Color Picker Preview */
    .color-preview-btn {
      transition: all 0.2s ease;
    }
    
    .color-preview-btn:hover {
      transform: scale(1.02);
    }
    
    /* Range Slider */
    .range-slider-wrapper {
      position: relative;
    }
    
    .range-slider-track {
      height: 6px;
      border-radius: 3px;
      background: linear-gradient(to right, #e5e7eb, #2271b1);
    }
    
    /* Animations */
    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-10px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
    
    .blaze-live-preview-toggle {
      animation: slideIn 0.3s ease;
    }
    
    /* Customizer Tabs */
    .customize-section-description-container {
      margin-bottom: 15px;
    }
    
    /* Improved spacing */
    .customize-control {
      margin-bottom: 20px;
    }
    
    /* Focus styles */
    .customize-control input:focus,
    .customize-control select:focus,
    .customize-control textarea:focus {
      outline: 2px solid #2271b1;
      outline-offset: 2px;
    }
  `;
  
  document.head.appendChild(style);
}

/**
 * Show customizer notification
 */
function showNotification(message, type = 'success') {
  if (!window.wp || !window.wp.customize) return;
  
  const notification = document.createElement('div');
  notification.className = `blaze-notification notification-${type}`;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 12px 20px;
    background: ${type === 'success' ? '#00a32a' : '#2271b1'};
    color: white;
    border-radius: 4px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    z-index: 999999;
    animation: slideIn 0.3s ease;
    font-size: 13px;
    font-weight: 500;
  `;
  notification.textContent = message;
  
  document.body.appendChild(notification);
  
  setTimeout(() => {
    notification.style.animation = 'slideOut 0.3s ease';
    setTimeout(() => notification.remove(), 300);
  }, 3000);
  
  const slideOutStyle = document.createElement('style');
  slideOutStyle.textContent = `
    @keyframes slideOut {
      to {
        opacity: 0;
        transform: translateX(20px);
      }
    }
  `;
  document.head.appendChild(slideOutStyle);
}

/**
 * Add keyboard shortcuts
 */
document.addEventListener('keydown', (e) => {
  // Ctrl/Cmd + S to save
  if ((e.ctrlKey || e.metaKey) && e.key === 's') {
    e.preventDefault();
    if (window.wp && window.wp.customize) {
      window.wp.customize.previewer.save();
      showNotification('Changes saved!', 'success');
    }
  }
  
  // Ctrl/Cmd + P to toggle live preview
  if ((e.ctrlKey || e.metaKey) && e.key === 'p') {
    e.preventDefault();
    const checkbox = document.getElementById('blaze-live-preview');
    if (checkbox) {
      checkbox.checked = !checkbox.checked;
      checkbox.dispatchEvent(new Event('change'));
    }
  }
});

// console.log('🔧 Blaze Customizer loaded!');