<script>
  /**
   * Reusable Button Component - Svelte 5 + Tailwind CSS v4
   */
  
  let {
    variant = 'primary', // primary, secondary, outline, ghost, danger
    size = 'md', // sm, md, lg
    disabled = false,
    loading = false,
    fullWidth = false,
    href = null,
    type = 'button',
    onclick = null,
    children
  } = $props();

  // Variant classes
  let variantClasses = $derived({
    primary: 'bg-primary text-white hover:bg-primary-dark shadow-md hover:shadow-lg',
    secondary: 'bg-gray-200 text-gray-800 hover:bg-gray-300',
    outline: 'border-2 border-primary text-primary hover:bg-primary hover:text-white',
    ghost: 'text-primary hover:bg-primary/10',
    danger: 'bg-red-600 text-white hover:bg-red-700 shadow-md hover:shadow-lg'
  }[variant]);

  // Size classes
  let sizeClasses = $derived({
    sm: 'px-4 py-2 text-sm',
    md: 'px-6 py-3 text-base',
    lg: 'px-8 py-4 text-lg'
  }[size]);

  // Base classes
  let baseClasses = 'inline-flex items-center justify-center gap-2 font-semibold rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2';

  // Disabled classes
  let disabledClasses = 'opacity-50 cursor-not-allowed pointer-events-none';

  // Full width class
  let widthClass = fullWidth ? 'w-full' : '';

  // Combined classes
  let buttonClasses = $derived(
    `${baseClasses} ${variantClasses} ${sizeClasses} ${widthClass} ${disabled || loading ? disabledClasses : ''}`
  );
</script>

{#if href}
  <a 
    {href}
    class={buttonClasses}
    aria-disabled={disabled || loading}
  >
    {#if loading}
      <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
    {/if}
    {@render children?.()}
  </a>
{:else}
  <button
    {type}
    {disabled}
    {onclick}
    class={buttonClasses}
  >
    {#if loading}
      <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
      </svg>
    {/if}
    {@render children?.()}
  </button>
{/if}