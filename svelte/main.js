import { writable } from 'svelte/store';

function createThemeStore() {
  const { subscribe, set, update } = writable({
    mode: 'light', // 'light' or 'dark'
    primaryColor: '#DC2626',
    fontFamily: 'system-ui',
    fontSize: 16,
    borderRadius: 8,
    preferences: {}
  });

  return {
    subscribe,

    setMode: (mode) => {
      update(state => {
        const newState = { ...state, mode };
        localStorage.setItem('blaze_theme_mode', mode);
        document.documentElement.classList.toggle('dark', mode === 'dark');
        return newState;
      });
    },

    toggleMode: () => {
      update(state => {
        const newMode = state.mode === 'light' ? 'dark' : 'light';
        localStorage.setItem('blaze_theme_mode', newMode);
        document.documentElement.classList.toggle('dark', newMode === 'dark');
        return { ...state, mode: newMode };
      });
    },

    setPrimaryColor: (color) => {
      update(state => {
        const newState = { ...state, primaryColor: color };
        localStorage.setItem('blaze_theme_primary_color', color);
        document.documentElement.style.setProperty('--color-primary', color);
        return newState;
      });
    },

    setFontFamily: (fontFamily) => {
      update(state => {
        const newState = { ...state, fontFamily };
        localStorage.setItem('blaze_theme_font_family', fontFamily);
        document.documentElement.style.setProperty('--font-family', fontFamily);
        return newState;
      });
    },

    setFontSize: (fontSize) => {
      update(state => {
        const newState = { ...state, fontSize };
        localStorage.setItem('blaze_theme_font_size', fontSize.toString());
        document.documentElement.style.setProperty('--font-size-base', `${fontSize}px`);
        return newState;
      });
    },

    setBorderRadius: (borderRadius) => {
      update(state => {
        const newState = { ...state, borderRadius };
        localStorage.setItem('blaze_theme_border_radius', borderRadius.toString());
        document.documentElement.style.setProperty('--border-radius', `${borderRadius}px`);
        return newState;
      });
    },

    setPreference: (key, value) => {
      update(state => {
        const preferences = { ...state.preferences, [key]: value };
        localStorage.setItem('blaze_theme_preferences', JSON.stringify(preferences));
        return { ...state, preferences };
      });
    },

    loadPreferences: () => {
      // Load theme mode
      const savedMode = localStorage.getItem('blaze_theme_mode');
      if (savedMode) {
        document.documentElement.classList.toggle('dark', savedMode === 'dark');
      }

      // Load primary color
      const savedColor = localStorage.getItem('blaze_theme_primary_color');
      if (savedColor) {
        document.documentElement.style.setProperty('--color-primary', savedColor);
      }

      // Load font family
      const savedFont = localStorage.getItem('blaze_theme_font_family');
      if (savedFont) {
        document.documentElement.style.setProperty('--font-family', savedFont);
      }

      // Load font size
      const savedFontSize = localStorage.getItem('blaze_theme_font_size');
      if (savedFontSize) {
        document.documentElement.style.setProperty('--font-size-base', `${savedFontSize}px`);
      }

      // Load border radius
      const savedBorderRadius = localStorage.getItem('blaze_theme_border_radius');
      if (savedBorderRadius) {
        document.documentElement.style.setProperty('--border-radius', `${savedBorderRadius}px`);
      }

      // Load custom preferences
      const savedPreferences = localStorage.getItem('blaze_theme_preferences');
      let preferences = {};
      if (savedPreferences) {
        try {
          preferences = JSON.parse(savedPreferences);
        } catch (e) {
          console.error('Failed to load theme preferences', e);
        }
      }

      // Update store
      update(state => ({
        mode: savedMode || 'light',
        primaryColor: savedColor || '#DC2626',
        fontFamily: savedFont || 'system-ui',
        fontSize: parseInt(savedFontSize) || 16,
        borderRadius: parseInt(savedBorderRadius) || 8,
        preferences
      }));
    },

    reset: () => {
      localStorage.removeItem('blaze_theme_mode');
      localStorage.removeItem('blaze_theme_primary_color');
      localStorage.removeItem('blaze_theme_font_family');
      localStorage.removeItem('blaze_theme_font_size');
      localStorage.removeItem('blaze_theme_border_radius');
      localStorage.removeItem('blaze_theme_preferences');
      
      document.documentElement.classList.remove('dark');
      document.documentElement.style.removeProperty('--color-primary');
      document.documentElement.style.removeProperty('--font-family');
      document.documentElement.style.removeProperty('--font-size-base');
      document.documentElement.style.removeProperty('--border-radius');

      set({
        mode: 'light',
        primaryColor: '#DC2626',
        fontFamily: 'system-ui',
        fontSize: 16,
        borderRadius: 8,
        preferences: {}
      });
    }
  };
}

export const themeStore = createThemeStore();

// Auto-detect system theme preference on first load
if (typeof window !== 'undefined') {
  const savedMode = localStorage.getItem('blaze_theme_mode');
  
  if (!savedMode) {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    if (prefersDark) {
      themeStore.setMode('dark');
    }
  }

  // Listen for system theme changes
  window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    const savedMode = localStorage.getItem('blaze_theme_mode');
    if (!savedMode) {
      themeStore.setMode(e.matches ? 'dark' : 'light');
    }
  });
}