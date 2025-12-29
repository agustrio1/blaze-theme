<script>
  let {
    type = 'spinner',
    size = 'md',
    color = 'primary',
    text = '',
    fullscreen = false
  } = $props();

  let sizeClasses = $derived({
    sm: 'w-4 h-4',
    md: 'w-8 h-8',
    lg: 'w-12 h-12',
    xl: 'w-16 h-16'
  }[size]);

  let colorClasses = $derived({
    primary: 'border-primary',
    white: 'border-white',
    gray: 'border-gray-600'
  }[color]);

  let textSizeClasses = $derived({
    sm: 'text-sm',
    md: 'text-base',
    lg: 'text-lg',
    xl: 'text-xl'
  }[size]);

  // FIX: Computed class untuk container (gak pake class: dengan slash)
  let containerClass = $derived(
    fullscreen
      ? 'flex flex-col items-center justify-center gap-4 fixed inset-0 z-50 bg-white bg-opacity-90 backdrop-blur-sm'
      : 'flex flex-col items-center justify-center gap-4'
  );
</script>

<div class={containerClass}>
  
  {#if type === 'spinner'}
    <div 
      class="{sizeClasses} border-4 {colorClasses} border-t-transparent rounded-full animate-spin"
      role="status"
      aria-label="Loading"
    ></div>

  {:else if type === 'dots'}
    <div class="flex items-center gap-2" role="status" aria-label="Loading">
      {#each [0, 150, 300] as delay, i}
        {@const dotSize = size === 'sm' ? 'w-2 h-2' : size === 'md' ? 'w-3 h-3' : 'w-4 h-4'}
        {@const dotColor = color === 'primary' ? 'bg-primary' : color === 'white' ? 'bg-white' : 'bg-gray-600'}
        <span 
          class="block rounded-full animate-bounce {dotSize} {dotColor}"
          style="animation-delay: {delay}ms"
        ></span>
      {/each}
    </div>

  {:else if type === 'pulse'}
    {@const pulseColor = color === 'primary' ? 'bg-primary' : color === 'white' ? 'bg-white' : 'bg-gray-600'}
    <div 
      class="{sizeClasses} rounded-full animate-pulse {pulseColor}"
      role="status"
      aria-label="Loading"
    ></div>

  {:else if type === 'bars'}
    <div class="flex items-end gap-1" role="status" aria-label="Loading">
      {#each [0, 150, 300, 450] as delay, i}
        {@const barWidth = size === 'sm' ? 'w-1' : size === 'md' ? 'w-1.5' : 'w-2'}
        {@const barHeight = size === 'sm' ? 'h-6' : size === 'md' ? 'h-8' : size === 'xl' ? 'h-12' : 'h-10'}
        {@const barColor = color === 'primary' ? 'bg-primary' : color === 'white' ? 'bg-white' : 'bg-gray-600'}
        <span 
          class="block rounded-sm animate-pulse {barWidth} {barHeight} {barColor}"
          style="animation-delay: {delay}ms"
        ></span>
      {/each}
    </div>
  {/if}

  {#if text}
    {@const textColor = color === 'primary' ? 'text-gray-900' : color === 'white' ? 'text-white' : 'text-gray-600'}
    <p class="font-medium {textSizeClasses} {textColor}">
      {text}
    </p>
  {/if}

</div>