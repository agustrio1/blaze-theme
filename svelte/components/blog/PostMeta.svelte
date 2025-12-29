<script>
  /**
   * Post Meta Component - Svelte 5 + Tailwind CSS v4
   */
  
  let { 
    author = null,
    date = null,
    category = null,
    readingTime = null,
    commentsCount = 0,
    showAvatar = true,
    size = 'normal' // normal, small, large
  } = $props();

  // Format date
  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
      year: 'numeric', 
      month: 'long', 
      day: 'numeric' 
    });
  }

  // Size classes
  let sizeClasses = $derived({
    text: size === 'small' ? 'text-xs' : size === 'large' ? 'text-base' : 'text-sm',
    icon: size === 'small' ? 'w-3.5 h-3.5' : size === 'large' ? 'w-5 h-5' : 'w-4 h-4',
    avatar: size === 'small' ? 'w-6 h-6' : size === 'large' ? 'w-10 h-10' : 'w-8 h-8',
    gap: size === 'small' ? 'gap-3' : size === 'large' ? 'gap-5' : 'gap-4'
  });
</script>

<div class="post-meta flex flex-wrap items-center {sizeClasses.gap} {sizeClasses.text} text-gray-600">
  
  <!-- Author -->
  {#if author}
    <div class="flex items-center gap-2">
      {#if showAvatar && author.avatar}
        <img 
          src={author.avatar} 
          alt={author.name}
          class="{sizeClasses.avatar} rounded-full object-cover ring-2 ring-gray-100"
        />
      {:else}
        <svg class="{sizeClasses.icon}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
        </svg>
      {/if}
      
      <a 
        href={author.url || '#'} 
        class="font-medium hover:text-primary transition-colors"
      >
        {author.name}
      </a>
    </div>
  {/if}

  <!-- Date -->
  {#if date}
    <div class="flex items-center gap-1.5">
      <svg class="{sizeClasses.icon}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
      </svg>
      <time datetime={date}>
        {formatDate(date)}
      </time>
    </div>
  {/if}

  <!-- Category -->
  {#if category}
    <div class="flex items-center gap-1.5">
      <svg class="{sizeClasses.icon}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
      </svg>
      <a 
        href={category.url || '#'}
        class="font-medium hover:text-primary transition-colors capitalize"
      >
        {category.name}
      </a>
    </div>
  {/if}

  <!-- Reading Time -->
  {#if readingTime}
    <div class="flex items-center gap-1.5">
      <svg class="{sizeClasses.icon}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
      </svg>
      <span>{readingTime}</span>
    </div>
  {/if}

  <!-- Comments Count -->
  {#if commentsCount !== null}
    <a 
      href="#comments"
      class="flex items-center gap-1.5 hover:text-primary transition-colors"
    >
      <svg class="{sizeClasses.icon}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
      </svg>
      <span>{commentsCount} {commentsCount === 1 ? 'Comment' : 'Comments'}</span>
    </a>
  {/if}

</div>