/**
 * Admin Scripts for WordPress Customizer
 */

import ColorPicker from './components/admin/ColorPicker.svelte';

document.addEventListener('DOMContentLoaded', () => {
  
  // Enhanced color picker for customizer
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

  // Add help tooltips
  addHelpTooltips();
  
  // Add live preview toggle
  addLivePreviewToggle();
});

/**
 * Add help tooltips to customizer controls
 */
function addHelpTooltips() {
  const controls = document.querySelectorAll('.customize-control');
  
  controls.forEach(control => {
    const description = control.querySelector('.description');
    if (description) {
      const tooltip = document.createElement('span');
      tooltip.className = 'dashicons dashicons-editor-help blaze-tooltip-trigger';
      tooltip.style.cursor = 'pointer';
      tooltip.style.marginLeft = '5px';
      
      const label = control.querySelector('.customize-control-title');
      if (label) {
        label.appendChild(tooltip);
        
        tooltip.addEventListener('click', () => {
          description.style.display = description.style.display === 'none' ? 'block' : 'none';
        });
      }
    }
  });
}

/**
 * Add live preview toggle for better performance
 */
function addLivePreviewToggle() {
  if (!wp.customize) return;
  
  const panel = document.querySelector('#customize-theme-controls');
  if (!panel) return;
  
  const toggle = document.createElement('div');
  toggle.className = 'blaze-live-preview-toggle';
  toggle.innerHTML = `
    <label style="display: flex; align-items: center; padding: 12px; background: #f0f0f1; margin: 10px;">
      <input type="checkbox" id="blaze-live-preview" checked style="margin-right: 8px;">
      <span style="font-weight: 500;">Enable Live Preview</span>
    </label>
  `;
  
  panel.prepend(toggle);
  
  const checkbox = document.getElementById('blaze-live-preview');
  checkbox.addEventListener('change', (e) => {
    const isEnabled = e.target.checked;
    
    // Store preference
    localStorage.setItem('blaze_live_preview', isEnabled ? '1' : '0');
    
    // Toggle transport method for all settings
    Object.keys(wp.customize.settings.values).forEach(key => {
      if (key.startsWith('blaze_')) {
        const setting = wp.customize(key);
        if (setting) {
          setting.transport = isEnabled ? 'postMessage' : 'refresh';
        }
      }
    });
  });
  
  // Load saved preference
  const saved = localStorage.getItem('blaze_live_preview');
  if (saved === '0') {
    checkbox.checked = false;
    checkbox.dispatchEvent(new Event('change'));
  }
}