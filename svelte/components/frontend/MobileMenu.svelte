<script>
  let { menuItems = [] } = $props();

  let isOpen = $state(false);
  let activeSubmenu = $state(null);

  function toggleMenu() {
    isOpen = !isOpen;
    document.body.style.overflow = isOpen ? 'hidden' : '';
  }

  function toggleSubmenu(index) {
    activeSubmenu = activeSubmenu === index ? null : index;
  }

  function closeMenu() {
    isOpen = false;
    activeSubmenu = null;
    document.body.style.overflow = '';
  }

  $effect(() => {
    return () => {
      document.body.style.overflow = '';
    };
  });

  let hamburgerLine1 = $derived(
    isOpen ? 'w-full h-0.5 bg-gray-700 transition-all duration-300 rotate-45 translate-y-2' : 'w-full h-0.5 bg-gray-700 transition-all duration-300'
  );

  let hamburgerLine2 = $derived(
    isOpen ? 'w-full h-0.5 bg-gray-700 transition-all duration-300 opacity-0' : 'w-full h-0.5 bg-gray-700 transition-all duration-300'
  );

  let hamburgerLine3 = $derived(
    isOpen ? 'w-full h-0.5 bg-gray-700 transition-all duration-300 -rotate-45 -translate-y-2' : 'w-full h-0.5 bg-gray-700 transition-all duration-300'
  );

  let panelClass = $derived(
    isOpen ? 'fixed top-0 right-0 w-[85%] max-w-md h-screen bg-white z-[1000] flex flex-col shadow-2xl transition-transform duration-300 translate-x-0' : 'fixed top-0 right-0 w-[85%] max-w-md h-screen bg-white z-[1000] flex flex-col shadow-2xl transition-transform duration-300 translate-x-full'
  );
</script>

<button
  type="button"
  onclick={toggleMenu}
  class="flex items-center justify-center w-11 h-11 z-[1001]"
  aria-label="Toggle mobile menu"
>
  <span class="flex flex-col gap-1.5 w-6">
    <span class={hamburgerLine1}></span>
    <span class={hamburgerLine2}></span>
    <span class={hamburgerLine3}></span>
  </span>
</button>

{#if isOpen}
  <button
    type="button"
    class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-[999] animate-fade-in"
    onclick={closeMenu}
    aria-label="Close menu"
  ></button>
  
  <div class={panelClass}>
    
    <div class="flex justify-between items-center p-6 border-b border-gray-200">
      <h2 class="text-xl font-bold text-gray-900">Menu</h2>
      <button
        type="button"
        onclick={closeMenu}
        class="flex items-center justify-center w-10 h-10 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 hover:text-primary transition-all"
        aria-label="Close menu"
      >
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>

    <nav class="flex-1 overflow-y-auto py-4">
      <ul class="space-y-0">
        {#each menuItems as item, index}
          <li class="border-b border-gray-100 last:border-0">
            
            {#if item.children && item.children.length > 0}
              {@const submenuBtnClass = activeSubmenu === index 
                ? 'flex justify-between items-center w-full px-6 py-4 font-medium hover:bg-gray-50 hover:pl-8 transition-all text-left bg-gray-50 text-primary'
                : 'flex justify-between items-center w-full px-6 py-4 text-gray-700 font-medium hover:bg-gray-50 hover:text-primary hover:pl-8 transition-all text-left'}
              
              {@const chevronClass = activeSubmenu === index
                ? 'w-5 h-5 transition-transform duration-300 rotate-180'
                : 'w-5 h-5 transition-transform duration-300'}

              <button
                type="button"
                onclick={() => toggleSubmenu(index)}
                class={submenuBtnClass}
              >
                <span>{item.title}</span>
                <svg class={chevronClass} fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
              </button>

              {#if activeSubmenu === index}
                <ul class="bg-gray-50 animate-slide-down">
                  {#each item.children as child}
                    <li>
                      <a 
                        href={child.url} 
                        onclick={closeMenu}
                        class="block px-6 py-3 pl-12 text-sm text-gray-600 hover:text-primary hover:pl-14 transition-all"
                      >
                        {child.title}
                      </a>
                    </li>
                  {/each}
                </ul>
              {/if}
            {:else}
              <a 
                href={item.url} 
                onclick={closeMenu}
                class="block px-6 py-4 text-gray-700 font-medium hover:bg-gray-50 hover:text-primary hover:pl-8 transition-all"
              >
                {item.title}
              </a>
            {/if}
            
          </li>
        {/each}
      </ul>
    </nav>

    <div class="p-6 border-t border-gray-200">
      <div class="flex gap-3 justify-center">
        <a 
          href="https://facebook.com" 
          class="flex items-center justify-center w-10 h-10 bg-gray-100 text-gray-700 rounded-lg hover:bg-primary hover:text-white hover:-translate-y-1 transition-all"
          aria-label="Facebook"
        >
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
          </svg>
        </a>
        <a 
          href="https://twitter.com" 
          class="flex items-center justify-center w-10 h-10 bg-gray-100 text-gray-700 rounded-lg hover:bg-primary hover:text-white hover:-translate-y-1 transition-all"
          aria-label="Twitter"
        >
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
          </svg>
        </a>
        <a 
          href="https://instagram.com" 
          class="flex items-center justify-center w-10 h-10 bg-gray-100 text-gray-700 rounded-lg hover:bg-primary hover:text-white hover:-translate-y-1 transition-all"
          aria-label="Instagram"
        >
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073z"/>
          </svg>
        </a>
      </div>
    </div>

  </div>
{/if}