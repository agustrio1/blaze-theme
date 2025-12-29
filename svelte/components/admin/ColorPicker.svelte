<script>
  /**
   * Enhanced Color Picker Component
   * Svelte 5 - FIX state_referenced_locally
   */
  
  let { settingId, defaultColor = '#DC2626' } = $props();

  // FIX: Pake function untuk initial value
  let currentColor = $state((() => defaultColor)());
  let showPicker = $state(false);
  let opacity = $state(100);

  const presetColors = [
    '#DC2626', '#EA580C', '#D97706', '#65A30D',
    '#059669', '#0891B2', '#2563EB', '#7C3AED',
    '#C026D3', '#E11D48', '#475569', '#18181B'
  ];

  function updateColor(newColor) {
    currentColor = newColor;
    if (window.wp && window.wp.customize) {
      window.wp.customize(settingId, (setting) => {
        setting.set(newColor);
      });
    }
  }

  function handleColorChange(e) {
    updateColor(e.target.value);
  }

  function applyPreset(color) {
    updateColor(color);
  }

  function resetToDefault() {
    updateColor(defaultColor);
    opacity = 100;
  }

  function togglePicker() {
    showPicker = !showPicker;
  }

  function hexToRgba(hex, alpha) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);
    return `rgba(${r}, ${g}, ${b}, ${alpha / 100})`;
  }

  let previewColor = $derived(hexToRgba(currentColor, opacity));
</script>

<div class="relative inline-block w-full">
  
  <button 
    type="button"
    class="w-full h-12 border-2 border-gray-300 rounded-lg cursor-pointer transition-all hover:border-gray-500 flex items-center justify-center font-semibold text-sm"
    style="background-color: {previewColor};"
    onclick={togglePicker}
  >
    <span class="bg-white bg-opacity-90 px-3 py-1 rounded uppercase tracking-wide">
      {currentColor}
    </span>
  </button>

  {#if showPicker}
    <div class="absolute top-16 left-0 bg-white border border-gray-300 rounded-lg p-5 shadow-xl z-50 min-w-80">
      
      <div class="mb-4">
        <label for="{settingId}-color" class="block">
          <span class="block font-semibold mb-2 text-gray-700 text-sm">Select Color:</span>
          <input 
            type="color" 
            id="{settingId}-color"
            value={currentColor}
            oninput={handleColorChange}
            class="w-full h-12 border-2 border-gray-300 rounded-lg cursor-pointer"
          />
        </label>
      </div>

      <div class="mb-4">
        <label for="{settingId}-hex" class="block">
          <span class="block font-semibold mb-2 text-gray-700 text-sm">Hex Value:</span>
          <input 
            type="text" 
            id="{settingId}-hex"
            value={currentColor}
            oninput={handleColorChange}
            pattern="^#[0-9A-Fa-f]{6}$"
            placeholder="#DC2626"
            class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg text-sm font-mono uppercase focus:outline-none focus:border-primary"
          />
        </label>
      </div>

      <div class="mb-4">
        <label for="{settingId}-opacity" class="block">
          <span class="block font-semibold mb-2 text-gray-700 text-sm">Opacity: {opacity}%</span>
          <input 
            type="range" 
            id="{settingId}-opacity"
            bind:value={opacity}
            min="0"
            max="100"
            step="1"
            class="w-full h-2 rounded-full cursor-pointer"
          />
        </label>
      </div>

      <div class="mb-4">
        <span class="block font-semibold mb-2 text-gray-700 text-sm">Preset Colors:</span>
        <div class="grid grid-cols-6 gap-2">
          {#each presetColors as preset}
            <button
              type="button"
              class="w-10 h-10 border-2 rounded-lg cursor-pointer transition-all hover:scale-110 flex items-center justify-center {currentColor === preset ? 'border-black shadow-lg' : 'border-transparent'}"
              style="background-color: {preset};"
              onclick={() => applyPreset(preset)}
            >
              {#if currentColor === preset}
                <span class="text-white font-bold text-lg drop-shadow-md">✓</span>
              {/if}
            </button>
          {/each}
        </div>
      </div>

      <div class="flex gap-2">
        <button 
          type="button"
          class="flex-1 px-4 py-2 bg-gray-100 text-gray-700 rounded-lg font-semibold text-sm hover:bg-gray-200 transition-colors"
          onclick={resetToDefault}
        >
          Reset
        </button>
        <button 
          type="button"
          class="flex-1 px-4 py-2 bg-primary text-white rounded-lg font-semibold text-sm hover:bg-primary-dark transition-colors"
          onclick={togglePicker}
        >
          Close
        </button>
      </div>

    </div>
  {/if}

</div>