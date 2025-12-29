<script>
  /**
   * Search Modal Component - Svelte 5 + Tailwind CSS v4
   */
  
  let { searchUrl = '/search' } = $props();

  let isOpen = $state(false);
  let searchQuery = $state('');
  let searchResults = $state([]);
  let isLoading = $state(false);

  function openModal() {
    isOpen = true;
    document.body.style.overflow = 'hidden';
    setTimeout(() => document.getElementById('search-input')?.focus(), 100);
  }

  function closeModal() {
    isOpen = false;
    searchQuery = '';
    searchResults = [];
    document.body.style.overflow = '';
  }

  async function handleSearch() {
    if (searchQuery.length < 3) {
      searchResults = [];
      return;
    }

    isLoading = true;

    try {
      const response = await fetch(`/wp-json/wp/v2/search?search=${encodeURIComponent(searchQuery)}&per_page=5`);
      const data = await response.json();
      searchResults = data;
    } catch (error) {
      console.error('Search error:', error);
      searchResults = [];
    } finally {
      isLoading = false;
    }
  }

  function handleKeydown(e) {
    if (e.key === 'Escape') closeModal();
    if (e.key === 'Enter' && searchQuery) {
      window.location.href = `${searchUrl}?s=${encodeURIComponent(searchQuery)}`;
    }
  }

  // Debounce search
  let debounceTimer;
  $effect(() => {
    clearTimeout(debounceTimer);
    if (searchQuery.length >= 3) {
      debounceTimer = setTimeout(handleSearch, 300);
    }
    return () => clearTimeout(debounceTimer);
  });

  // Cleanup on unmount
  $effect(() => {
    return () => {
      document.body.style.overflow = '';
    };
  });

  // Expose open function globally
  if (typeof window !== 'undefined') {
    window.openSearchModal = openModal;
  }
</script>

<!-- Search Trigger Button -->
<button
  type="button"
  onclick={openModal}
  class="flex items-center justify-center w-10 h-10 rounded-lg text-gray-700 hover:bg-gray-100 hover:text-primary transition-all"
  aria-label="Open search"
>
  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
  </svg>
</button>

<!-- Search Modal -->
{#if isOpen}
  <!-- Overlay -->
  <div 
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9998] animate-fade-in"
    onclick={closeModal}
  ></div>

  <!-- Modal Content -->
  <div 
    class="fixed inset-x-0 top-0 z-[9999] animate-slide-down"
    onkeydown={handleKeydown}
  >
    <div class="container mx-auto px-4 py-8 max-w-3xl">
      <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
        
        <!-- Search Header -->
        <div class="flex items-center gap-4 p-6 border-b border-gray-200">
          <svg class="w-6 h-6 text-gray-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
          
          <input
            id="search-input"
            type="text"
            bind:value={searchQuery}
            placeholder="Search posts, pages, and more..."
            class="flex-1 text-lg bg-transparent border-none outline-none text-gray-900 placeholder-gray-400"
          />

          {#if searchQuery}
            <button
              type="button"
              onclick={() => searchQuery = ''}
              class="flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-all"
              aria-label="Clear search"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          {/if}

          <button
            type="button"
            onclick={closeModal}
            class="flex items-center justify-center w-8 h-8 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition-all"
            aria-label="Close search"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        </div>

        <!-- Search Results -->
        <div class="max-h-[60vh] overflow-y-auto">
          
          {#if isLoading}
            <!-- Loading State -->
            <div class="flex items-center justify-center py-12">
              <div class="w-8 h-8 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
            </div>
          {:else if searchQuery.length < 3}
            <!-- Empty State -->
            <div class="text-center py-12 px-6">
              <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              <p class="text-gray-500 text-lg font-medium mb-2">Start typing to search</p>
              <p class="text-gray-400 text-sm">Enter at least 3 characters</p>
            </div>
          {:else if searchResults.length === 0}
            <!-- No Results -->
            <div class="text-center py-12 px-6">
              <svg class="w-16 h-16 mx-auto mb-4 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
              <p class="text-gray-500 text-lg font-medium mb-2">No results found</p>
              <p class="text-gray-400 text-sm">Try different keywords</p>
            </div>
          {:else}
            <!-- Results List -->
            <ul class="divide-y divide-gray-100">
              {#each searchResults as result}
                <li>
                  <a
                    href={result.url}
                    class="block px-6 py-4 hover:bg-gray-50 transition-colors group"
                    onclick={closeModal}
                  >
                    <div class="flex items-start gap-3">
                      <div class="flex-shrink-0 mt-1">
                        {#if result.subtype === 'post'}
                          <svg class="w-5 h-5 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                          </svg>
                        {:else}
                          <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                          </svg>
                        {/if}
                      </div>
                      
                      <div class="flex-1 min-w-0">
                        <h3 class="text-base font-semibold text-gray-900 group-hover:text-primary transition-colors mb-1">
                          {result.title}
                        </h3>
                        <p class="text-sm text-gray-500 capitalize">
                          {result.subtype}
                        </p>
                      </div>

                      <svg class="w-5 h-5 text-gray-400 group-hover:text-primary group-hover:translate-x-1 transition-all flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                      </svg>
                    </div>
                  </a>
                </li>
              {/each}
            </ul>

            <!-- View All Results -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
              <a
                href="{searchUrl}?s={encodeURIComponent(searchQuery)}"
                class="flex items-center justify-center gap-2 w-full py-2 text-primary font-medium hover:text-primary-dark transition-colors"
              >
                View all results
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
              </a>
            </div>
          {/if}

        </div>

        <!-- Search Footer -->
        <div class="px-6 py-3 bg-gray-50 border-t border-gray-200">
          <div class="flex items-center justify-between text-xs text-gray-500">
            <span>Press <kbd class="px-2 py-1 bg-white border border-gray-300 rounded text-gray-700 font-mono">ESC</kbd> to close</span>
            <span>Press <kbd class="px-2 py-1 bg-white border border-gray-300 rounded text-gray-700 font-mono">↵</kbd> to search</span>
          </div>
        </div>

      </div>
    </div>
  </div>
{/if}