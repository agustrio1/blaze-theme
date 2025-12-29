<script>
  /**
   * Post Grid Component - Svelte 5 + Tailwind CSS v4
   */
  
  import PostCard from './PostCard.svelte';

  let { posts = [], category = 'all' } = $props();

  let selectedCategory = $state(category);
  let layoutMode = $state('grid'); // grid, list, masonry
  let isLoading = $state(false);

  // Get unique categories
  let categories = $derived.by(() => {
    const cats = new Set(['all']);
    posts.forEach(post => {
      if (post.category) cats.add(post.category);
    });
    return Array.from(cats);
  });

  // Filter posts by category
  let filteredPosts = $derived(
    selectedCategory === 'all' 
      ? posts 
      : posts.filter(post => post.category === selectedCategory)
  );

  function handleCategoryChange(cat) {
    selectedCategory = cat;
  }

  function handleLayoutChange(mode) {
    layoutMode = mode;
  }
</script>

<div class="post-grid-container">
  
  <!-- Toolbar -->
  <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 mb-8 p-4 bg-gray-50 rounded-lg">
    
    <!-- Category Filter -->
    <div class="flex items-center gap-2 flex-wrap">
      <span class="text-sm font-medium text-gray-700">Filter:</span>
      {#each categories as cat}
        <button
          type="button"
          onclick={() => handleCategoryChange(cat)}
          class="px-4 py-2 rounded-lg font-medium text-sm transition-all capitalize"
          class:bg-primary={selectedCategory === cat}
          class:text-white={selectedCategory === cat}
          class:shadow-md={selectedCategory === cat}
          class:bg-white={selectedCategory !== cat}
          class:text-gray-700={selectedCategory !== cat}
          class:hover:bg-gray-100={selectedCategory !== cat}
        >
          {cat}
        </button>
      {/each}
    </div>

    <!-- Layout Toggle -->
    <div class="flex items-center gap-2 bg-white rounded-lg p-1 shadow-sm">
      <button
        type="button"
        onclick={() => handleLayoutChange('grid')}
        class="p-2 rounded-md transition-all"
        class:bg-primary={layoutMode === 'grid'}
        class:text-white={layoutMode === 'grid'}
        class:text-gray-600={layoutMode !== 'grid'}
        class:hover:bg-gray-100={layoutMode !== 'grid'}
        aria-label="Grid view"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
        </svg>
      </button>

      <button
        type="button"
        onclick={() => handleLayoutChange('list')}
        class="p-2 rounded-md transition-all"
        class:bg-primary={layoutMode === 'list'}
        class:text-white={layoutMode === 'list'}
        class:text-gray-600={layoutMode !== 'list'}
        class:hover:bg-gray-100={layoutMode !== 'list'}
        aria-label="List view"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
        </svg>
      </button>

      <button
        type="button"
        onclick={() => handleLayoutChange('masonry')}
        class="p-2 rounded-md transition-all"
        class:bg-primary={layoutMode === 'masonry'}
        class:text-white={layoutMode === 'masonry'}
        class:text-gray-600={layoutMode !== 'masonry'}
        class:hover:bg-gray-100={layoutMode !== 'masonry'}
        aria-label="Masonry view"
      >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM14 5a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1h-4a1 1 0 01-1-1V5zM4 16a1 1 0 011-1h4a1 1 0 011 1v3a1 1 0 01-1 1H5a1 1 0 01-1-1v-3zM14 12a1 1 0 011-1h4a1 1 0 011 1v7a1 1 0 01-1 1h-4a1 1 0 01-1-1v-7z"></path>
        </svg>
      </button>
    </div>
  </div>

  <!-- Posts Count -->
  <div class="mb-6">
    <p class="text-sm text-gray-600">
      Showing <span class="font-semibold text-gray-900">{filteredPosts.length}</span> 
      {filteredPosts.length === 1 ? 'post' : 'posts'}
      {#if selectedCategory !== 'all'}
        in <span class="font-semibold text-primary capitalize">{selectedCategory}</span>
      {/if}
    </p>
  </div>

  <!-- Posts Grid/List -->
  {#if isLoading}
    <!-- Loading State -->
    <div class="flex items-center justify-center py-20">
      <div class="flex flex-col items-center gap-4">
        <div class="w-12 h-12 border-4 border-primary border-t-transparent rounded-full animate-spin"></div>
        <p class="text-gray-600 font-medium">Loading posts...</p>
      </div>
    </div>
  {:else if filteredPosts.length === 0}
    <!-- Empty State -->
    <div class="text-center py-20">
      <svg class="w-20 h-20 mx-auto mb-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
      </svg>
      <h3 class="text-2xl font-bold text-gray-900 mb-2">No posts found</h3>
      <p class="text-gray-600 mb-6">Try selecting a different category</p>
      <button
        type="button"
        onclick={() => selectedCategory = 'all'}
        class="px-6 py-3 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark transition-all"
      >
        Show All Posts
      </button>
    </div>
  {:else}
    <div 
      class="animate-fade-in"
      class:grid={layoutMode === 'grid' || layoutMode === 'masonry'}
      class:grid-cols-1={layoutMode === 'grid' || layoutMode === 'masonry'}
      class:md:grid-cols-2={layoutMode === 'grid' || layoutMode === 'masonry'}
      class:lg:grid-cols-3={layoutMode === 'grid' || layoutMode === 'masonry'}
      class:gap-6={layoutMode === 'grid' || layoutMode === 'masonry'}
      class:space-y-6={layoutMode === 'list'}
    >
      {#each filteredPosts as post (post.id)}
        <div class="animate-slide-up">
          <PostCard {post} />
        </div>
      {/each}
    </div>
  {/if}

  <!-- Load More Button -->
  {#if filteredPosts.length > 0 && !isLoading}
    <div class="text-center mt-12">
      <button
        type="button"
        class="px-8 py-3 bg-white border-2 border-primary text-primary font-semibold rounded-lg hover:bg-primary hover:text-white transition-all shadow-md hover:shadow-lg"
      >
        Load More Posts
      </button>
    </div>
  {/if}

</div>