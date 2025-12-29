<script>
  let { 
    siteTitle, 
    siteUrl, 
    hasLogo = false, 
    logoUrl = '', 
    menuItems = [] 
  } = $props();

  let isScrolled = $state(false);
  let isDarkMode = $state(false);

  $effect(() => {
    function handleScroll() {
      isScrolled = window.scrollY > 50;
    }
    window.addEventListener('scroll', handleScroll);
    return () => window.removeEventListener('scroll', handleScroll);
  });

  $effect(() => {
    const theme = localStorage.getItem('theme');
    isDarkMode = theme === 'dark';
    if (isDarkMode) {
      document.documentElement.classList.add('dark');
    }
  });

  function toggleDarkMode() {
    isDarkMode = !isDarkMode;
    if (isDarkMode) {
      document.documentElement.classList.add('dark');
      localStorage.setItem('theme', 'dark');
    } else {
      document.documentElement.classList.remove('dark');
      localStorage.setItem('theme', 'light');
    }
  }

  function toggleSearch() {
    window.dispatchEvent(new CustomEvent('toggle-search'));
  }

  function toggleMobileMenu() {
    window.dispatchEvent(new CustomEvent('toggle-mobile-menu'));
  }

  let headerClass = $derived(
    isScrolled 
      ? 'sticky top-0 w-full bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 backdrop-blur-md shadow-sm transition-all duration-300 z-50'
      : 'sticky top-0 w-full bg-white dark:bg-gray-900 border-b border-transparent transition-all duration-300 z-50'
  );
</script>

<header class={headerClass}>
  <div class="container">
    <div class="flex items-center justify-between h-20">
      
      <div class="flex-shrink-0">
        {#if hasLogo && logoUrl}
          <a href={siteUrl} class="block">
            <img src={logoUrl} alt={siteTitle} class="h-10 w-auto" />
          </a>
        {:else}
          <a href={siteUrl} class="flex items-center gap-3 group">
            <div class="w-10 h-10 bg-primary rounded-lg flex items-center justify-center">
              <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
              </svg>
            </div>
            <span class="text-2xl font-bold text-gray-900 dark:text-white group-hover:text-primary transition-colors">
              {siteTitle}
            </span>
          </a>
        {/if}
      </div>

      <nav class="hidden lg:flex items-center gap-8 flex-1 justify-center">
        {#each menuItems as item}
          <a href={item.url} class="nav-link" target={item.target || '_self'}>
            {item.title}
          </a>
        {/each}
      </nav>

      <div class="flex items-center gap-4">
        
        <button 
          class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
          onclick={toggleSearch}
          aria-label="Toggle search"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
          </svg>
        </button>

        <button 
          class="p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
          onclick={toggleDarkMode}
          aria-label="Toggle dark mode"
        >
          {#if isDarkMode}
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
            </svg>
          {:else}
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
            </svg>
          {/if}
        </button>

        <button 
          class="lg:hidden p-2 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
          onclick={toggleMobileMenu}
          aria-label="Toggle mobile menu"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>