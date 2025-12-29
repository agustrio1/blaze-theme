<script>
  import { onMount } from 'svelte';
  
  let visible = $state(false);
  
  onMount(() => {
    setTimeout(() => visible = true, 100);
  });
</script>

<section class="relative bg-gray-900 text-white py-24 md:py-32 overflow-hidden">
  
  <div class="absolute inset-0 opacity-5">
    <div class="absolute top-20 left-10 w-64 h-64 bg-red-600 rounded-full blur-3xl"></div>
    <div class="absolute bottom-20 right-10 w-80 h-80 bg-red-600 rounded-full blur-3xl"></div>
  </div>

  <div class="container mx-auto px-4 relative z-10">
    <div 
      class="text-center max-w-4xl mx-auto transition-all duration-1000"
      class:opacity-0={!visible}
      class:translate-y-8={!visible}
      class:opacity-100={visible}
      class:translate-y-0={visible}
    >
      
      <div class="inline-flex items-center px-4 py-2 bg-red-600/20 backdrop-blur-sm rounded-full text-sm mb-6 border border-red-600/30">
        <span class="w-2 h-2 bg-red-600 rounded-full mr-2 animate-pulse"></span>
        New: Customizable & Lightning Fast
      </div>

      <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight">
        Build Your Dream
        <span class="text-red-600 block mt-2">Website Today</span>
      </h1>

      <p class="text-xl md:text-2xl text-gray-300 mb-10 max-w-2xl mx-auto">
        Modern, fast, and fully customizable WordPress theme
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <button class="btn btn-primary text-lg px-8 py-4 bg-red-600 hover:bg-red-700 transform hover:scale-105 transition-all shadow-lg">
          Start Building
        </button>
        
        <button class="btn border-2 border-white text-white hover:bg-white hover:text-gray-900 text-lg px-8 py-4 transform hover:scale-105 transition-all">
          View Demo
        </button>
      </div>

      <div class="grid grid-cols-3 gap-8 mt-16 max-w-2xl mx-auto">
        <div>
          <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">50+</div>
          <div class="text-sm text-gray-400">Components</div>
        </div>
        <div>
          <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">Fast</div>
          <div class="text-sm text-gray-400">Performance</div>
        </div>
        <div>
          <div class="text-3xl md:text-4xl font-bold text-red-600 mb-2">100%</div>
          <div class="text-sm text-gray-400">Customizable</div>
        </div>
      </div>

    </div>
  </div>
</section>