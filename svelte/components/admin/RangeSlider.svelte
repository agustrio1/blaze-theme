<script>
  /**
   * Range Slider Component
   * Svelte 5 - FIX state_referenced_locally
   */
  
  let { 
    settingId, 
    defaultValue = 50,
    min = 0,
    max = 100,
    step = 1,
    unit = '',
    label = 'Value'
  } = $props();

  // FIX: Pake function untuk initial value
  let currentValue = $state((() => defaultValue)());
  let isDragging = $state(false);

  function updateValue(newValue) {
    currentValue = newValue;
    
    if (window.wp && window.wp.customize) {
      window.wp.customize(settingId, (setting) => {
        setting.set(newValue);
      });
    }
  }

  function handleInput(e) {
    updateValue(Number(e.target.value));
  }

  function handleMouseDown() {
    isDragging = true;
  }

  function handleMouseUp() {
    isDragging = false;
  }

  function resetToDefault() {
    updateValue(defaultValue);
  }

  let percentage = $derived(((currentValue - min) / (max - min)) * 100);
  
  let sliderClass = $derived(
    isDragging 
      ? 'w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full appearance-none cursor-pointer scale-105 transition-all'
      : 'w-full h-2 bg-gray-200 dark:bg-gray-700 rounded-full appearance-none cursor-pointer transition-all'
  );
</script>

<svelte:window onmouseup={handleMouseUp} />

<div class="range-slider-wrapper">
  
  <div class="flex items-center justify-between mb-3">
    <label for={settingId} class="text-sm font-semibold text-gray-700 dark:text-gray-300">
      {label}
    </label>
    <span class="text-sm font-bold text-primary px-3 py-1 bg-gray-100 dark:bg-gray-800 rounded-full">
      {currentValue}{unit}
    </span>
  </div>

  <div class="relative">
    <input 
      type="range" 
      id={settingId}
      bind:value={currentValue}
      {min}
      {max}
      {step}
      oninput={handleInput}
      onmousedown={handleMouseDown}
      class={sliderClass}
      style="background: linear-gradient(to right, var(--color-primary) 0%, var(--color-primary) {percentage}%, #e5e7eb {percentage}%, #e5e7eb 100%);"
    />
    
    {#if isDragging}
      <div 
        class="absolute -top-10 bg-primary text-white px-3 py-1 rounded-lg text-sm font-semibold shadow-lg"
        style="left: {percentage}%; transform: translateX(-50%);"
      >
        {currentValue}{unit}
      </div>
    {/if}
  </div>

  <div class="flex items-center justify-between mt-2 text-xs text-gray-500 dark:text-gray-400">
    <span>{min}{unit}</span>
    <button 
      type="button"
      onclick={resetToDefault}
      class="text-primary hover:text-primary-dark font-semibold transition-colors"
    >
      Reset
    </button>
    <span>{max}{unit}</span>
  </div>

</div>

<style>
  input[type="range"]::-webkit-slider-thumb {
    appearance: none;
    width: 20px;
    height: 20px;
    background: var(--color-primary);
    border: 3px solid white;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease;
  }

  input[type="range"]::-webkit-slider-thumb:hover {
    transform: scale(1.2);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }

  input[type="range"]::-moz-range-thumb {
    width: 20px;
    height: 20px;
    background: var(--color-primary);
    border: 3px solid white;
    border-radius: 50%;
    cursor: pointer;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease;
  }

  input[type="range"]::-moz-range-thumb:hover {
    transform: scale(1.2);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  }
</style>