<script>
  let { product } = $props();

  let isHovered = $state(false);
</script>

<div 
  class="card group cursor-pointer"
  role="button"
  tabindex="0"
  onmouseenter={() => isHovered = true}
  onmouseleave={() => isHovered = false}
  onkeypress={(e) => e.key === 'Enter' && console.log('Card clicked')}
>
  
  <div class="relative overflow-hidden h-48 bg-gray-200">
    {#if product.featured}
      <div class="absolute top-3 right-3 z-10 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
        Featured
      </div>
    {/if}
    <div 
      class="w-full h-full bg-gray-300 transition-transform duration-500"
      class:scale-110={isHovered}
    ></div>
  </div>

  <div class="p-6">
    <div class="flex items-start justify-between mb-3">
      <h3 class="text-xl font-bold text-gray-900 group-hover:text-red-600 transition-colors">
        {product.title}
      </h3>
      <span class="text-2xl font-bold text-red-600">{product.price}</span>
    </div>
    
    <p class="text-gray-600 mb-4 text-sm">
      {product.description}
    </p>

    <div class="flex items-center justify-between">
      <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full capitalize">
        {product.category}
      </span>
      
      <button class="text-red-600 hover:text-red-700 font-medium text-sm flex items-center">
        View Details
        <span 
          class="ml-1 transition-transform"
          class:translate-x-1={isHovered}
        >
          →
        </span>
      </button>
    </div>
  </div>
  
</div>