<script>
  import { onMount } from 'svelte';
  import ProductCardItem from './ProductCardItem.svelte';
  
  let products = $state([]);
  let loading = $state(true);
  let filter = $state('all');
  
  const categories = ['all', 'e-commerce', 'tech', 'education', 'health'];
  
  onMount(async () => {
    await new Promise(resolve => setTimeout(resolve, 1000));
    
    products = [
      {
        id: 1,
        title: 'E-Commerce Solution',
        category: 'e-commerce',
        description: 'Complete online store setup',
        price: '$299',
        featured: true
      },
      {
        id: 2,
        title: 'Tech Startup Theme',
        category: 'tech',
        description: 'Modern SaaS landing page',
        price: '$199',
        featured: false
      },
      {
        id: 3,
        title: 'Education Platform',
        category: 'education',
        description: 'LMS integration included',
        price: '$249',
        featured: false
      },
      {
        id: 4,
        title: 'Healthcare Portal',
        category: 'health',
        description: 'Patient management system',
        price: '$349',
        featured: true
      }
    ];
    
    loading = false;
  });
  
  const filteredProducts = $derived(
    filter === 'all' 
      ? products 
      : products.filter(p => p.category === filter)
  );
  
  function setFilter(category) {
    filter = category;
  }
</script>

<section class="py-16 bg-white">
  <div class="container mx-auto px-4">
    
    <div class="text-center mb-12">
      <h2 class="text-4xl font-bold mb-4">Choose Your Solution</h2>
      <p class="text-xl text-gray-600">Perfect for any industry</p>
    </div>

    <div class="flex flex-wrap justify-center gap-3 mb-12">
      {#each categories as category}
        <button
          onclick={() => setFilter(category)}
          class="px-6 py-2 rounded-full font-medium transition-all capitalize"
          class:bg-red-600={filter === category}
          class:text-white={filter === category}
          class:bg-gray-200={filter !== category}
          class:text-gray-700={filter !== category}
          class:hover:bg-red-700={filter === category}
          class:hover:bg-gray-300={filter !== category}
        >
          {category}
        </button>
      {/each}
    </div>

    {#if loading}
      <div class="flex justify-center items-center py-20">
        <div class="animate-spin rounded-full h-16 w-16 border-4 border-red-600 border-t-transparent"></div>
      </div>
    {:else}
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {#each filteredProducts as product (product.id)}
          <ProductCardItem {product} />
        {/each}
      </div>
    {/if}

  </div>
</section>