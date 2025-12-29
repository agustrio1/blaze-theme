import { writable } from 'svelte/store';

function createMenuStore() {
  const { subscribe, set, update } = writable({
    isOpen: false,
    activeSubmenu: null,
    isMobileMenuOpen: false
  });

  return {
    subscribe,
    
    toggleMenu: () => {
      update(state => ({ ...state, isOpen: !state.isOpen }));
    },

    openMenu: () => {
      update(state => ({ ...state, isOpen: true }));
    },

    closeMenu: () => {
      update(state => ({ ...state, isOpen: false, activeSubmenu: null }));
    },

    setActiveSubmenu: (submenu) => {
      update(state => ({ ...state, activeSubmenu: submenu }));
    },

    toggleMobileMenu: () => {
      update(state => {
        const newState = !state.isMobileMenuOpen;
        document.body.style.overflow = newState ? 'hidden' : '';
        return { ...state, isMobileMenuOpen: newState };
      });
    },

    closeMobileMenu: () => {
      update(state => {
        document.body.style.overflow = '';
        return { ...state, isMobileMenuOpen: false, activeSubmenu: null };
      });
    }
  };
}

export const menuStore = createMenuStore();