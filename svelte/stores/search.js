import { writable, derived } from 'svelte/store';

function createSearchStore() {
  const { subscribe, set, update } = writable({
    isOpen: false,
    query: '',
    results: [],
    isLoading: false,
    recentSearches: []
  });

  return {
    subscribe,

    toggleSearch: () => {
      update(state => ({ ...state, isOpen: !state.isOpen }));
    },

    openSearch: () => {
      update(state => ({ ...state, isOpen: true }));
    },

    closeSearch: () => {
      update(state => ({ ...state, isOpen: false, query: '' }));
    },

    setQuery: (query) => {
      update(state => ({ ...state, query }));
    },

    setResults: (results) => {
      update(state => ({ ...state, results }));
    },

    setLoading: (isLoading) => {
      update(state => ({ ...state, isLoading }));
    },

    addRecentSearch: (query) => {
      update(state => {
        const recentSearches = [query, ...state.recentSearches.filter(q => q !== query)].slice(0, 5);
        localStorage.setItem('blaze_recent_searches', JSON.stringify(recentSearches));
        return { ...state, recentSearches };
      });
    },

    loadRecentSearches: () => {
      const saved = localStorage.getItem('blaze_recent_searches');
      if (saved) {
        try {
          const recentSearches = JSON.parse(saved);
          update(state => ({ ...state, recentSearches }));
        } catch (e) {
          console.error('Failed to load recent searches', e);
        }
      }
    },

    clearRecentSearches: () => {
      localStorage.removeItem('blaze_recent_searches');
      update(state => ({ ...state, recentSearches: [] }));
    }
  };
}

export const searchStore = createSearchStore();

export const hasResults = derived(
  searchStore,
  $search => $search.results.length > 0
);

if (typeof window !== 'undefined') {
  searchStore.loadRecentSearches();
}