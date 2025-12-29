<script>
  /**
   * Modal Component - Svelte 5 + Tailwind CSS v4
   */
  
  let {
    isOpen = $bindable(false),
    title = '',
    size = 'md', // sm, md, lg, xl, full
    showClose = true,
    closeOnOverlay = true,
    closeOnEscape = true,
    children
  } = $props();

  // Size classes
  let sizeClasses = $derived({
    sm: 'max-w-md',
    md: 'max-w-2xl',
    lg: 'max-w-4xl',
    xl: 'max-w-6xl',
    full: 'max-w-full mx-4'
  }[size]);

  function closeModal() {
    isOpen = false;
    document.body.style.overflow = '';
  }

  function handleOverlayClick() {
    if (closeOnOverlay) {
      closeModal();
    }
  }

  function handleKeydown(e) {
    if (closeOnEscape && e.key === 'Escape') {
      closeModal();
    }
  }

  // Prevent body scroll when modal is open
  $effect(() => {
    if (isOpen) {
      document.body.style.overflow = 'hidden';
    } else {
      document.body.style.overflow = '';
    }

    return () => {
      document.body.style.overflow = '';
    };
  });
</script>

{#if isOpen}
  <div 
    class="fixed inset-0 z-[9999] flex items-center justify-center p-4"
    onkeydown={handleKeydown}
  >
    
    <!-- Overlay -->
    <div 
      class="absolute inset-0 bg-black/60 backdrop-blur-sm animate-fade-in"
      onclick={handleOverlayClick}
    ></div>

    <!-- Modal Content -->
    <div 
      class="relative w-full {sizeClasses} bg-white rounded-2xl shadow-2xl animate-slide-up max-h-[90vh] flex flex-col"
      onclick={(e) => e.stopPropagation()}
    >
      
      <!-- Modal Header -->
      {#if title || showClose}
        <div class="flex items-center justify-between p-6 border-b border-gray-200">
          {#if title}
            <h2 class="text-2xl font-bold text-gray-900">
              {title}
            </h2>
          {:else}
            <div></div>
          {/if}

          {#if showClose}
            <button
              type="button"
              onclick={closeModal}
              class="flex items-center justify-center w-10 h-10 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-lg transition-all"
              aria-label="Close modal"
            >
              <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          {/if}
        </div>
      {/if}

      <!-- Modal Body -->
      <div class="flex-1 overflow-y-auto p-6">
        {@render children?.()}
      </div>

    </div>

  </div>
{/if}