<script>
  /**
   * Post Card Component - Svelte 5 + Tailwind CSS v4
   */
  
  let { post } = $props();

  let isHovered = $state(false);

  // Format date
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
      year: 'numeric', 
      month: 'short', 
      day: 'numeric' 
    });
  }

  // Calculate reading time
  function calculateReadingTime(content) {
    const wordsPerMinute = 200;
    const wordCount = content.split(/\s+/).length;
    const minutes = Math.ceil(wordCount / wordsPerMinute);
    return `${minutes} min read`;
  }
</script>

<article 
  class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden cursor-pointer"
  onmouseenter={() => isHovered = true}
  onmouseleave={() => isHovered = false}
  role="article"
  tabindex="0"
>
  
  <!-- Featured Image -->
  {#if post.featured_image}
    <a href={post.url} class="block relative overflow-hidden aspect-video bg-gray-200">
      <img 
        src={post.featured_image} 
        alt={post.title}
        class="w-full h-full object-cover transition-transform duration-500"
        class:scale-110={isHovered}
      />
      
      <!-- Category Badge -->
      {#if post.category}
        <span class="absolute top-4 right-4 px-3 py-1 bg-primary text-white text-xs font-bold rounded-full shadow-lg">
          {post.category}
        </span>
      {/if}

      <!-- Featured Badge -->
      {#if post.featured}
        <span class="absolute top-4 left-4 px-3 py-1 bg-yellow-500 text-white text-xs font-bold rounded-full shadow-lg flex items-center gap-1">
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
          </svg>
          Featured
        </span>
      {/if}
    </a>
  {/if}

  <!-- Post Content -->
  <div class="p-6">
    
    <!-- Post Meta -->
    <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
      <time datetime={post.date} class="flex items-center gap-1">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
        </svg>
        {formatDate(post.date)}
      </time>
      
      {#if post.content}
        <span class="flex items-center gap-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          {calculateReadingTime(post.content)}
        </span>
      {/if}

      {#if post.comments_count}
        <span class="flex items-center gap-1">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
          {post.comments_count}
        </span>
      {/if}
    </div>

    <!-- Post Title -->
    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-primary transition-colors">
      <a href={post.url} class="hover:underline">
        {post.title}
      </a>
    </h3>

    <!-- Post Excerpt -->
    {#if post.excerpt}
      <p class="text-gray-600 text-sm mb-4 line-clamp-3">
        {post.excerpt}
      </p>
    {/if}

    <!-- Post Footer -->
    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
      
      <!-- Author -->
      {#if post.author}
        <div class="flex items-center gap-2">
          {#if post.author.avatar}
            <img 
              src={post.author.avatar} 
              alt={post.author.name}
              class="w-8 h-8 rounded-full object-cover"
            />
          {/if}
          <span class="text-sm font-medium text-gray-700">
            {post.author.name}
          </span>
        </div>
      {/if}

      <!-- Read More Link -->
      <a 
        href={post.url}
        class="inline-flex items-center gap-1 text-primary font-medium text-sm hover:text-primary-dark transition-colors group/link"
      >
        <span>Read More</span>
        <svg 
          class="w-4 h-4 transition-transform group-hover/link:translate-x-1"
          class:translate-x-1={isHovered}
          fill="none" 
          stroke="currentColor" 
          viewBox="0 0 24 24"
        >
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
        </svg>
      </a>
    </div>

    <!-- Tags -->
    {#if post.tags && post.tags.length > 0}
      <div class="flex flex-wrap gap-2 mt-4 pt-4 border-t border-gray-100">
        {#each post.tags.slice(0, 3) as tag}
          <a 
            href={tag.url}
            class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-md hover:bg-primary hover:text-white transition-colors"
          >
            #{tag.name}
          </a>
        {/each}
      </div>
    {/if}

  </div>

</article>