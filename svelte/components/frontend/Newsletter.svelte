<script>
  /**
   * Newsletter Subscription Component - Svelte 5 + Tailwind CSS v4
   */
  
  let { apiUrl = '/wp-json/blaze/v1/newsletter' } = $props();

  let email = $state('');
  let isSubmitting = $state(false);
  let status = $state('idle'); // idle, success, error
  let message = $state('');

  async function handleSubmit(e) {
    e.preventDefault();
    
    if (!email || !isValidEmail(email)) {
      status = 'error';
      message = 'Please enter a valid email address';
      return;
    }

    isSubmitting = true;
    status = 'idle';

    try {
      const response = await fetch(apiUrl, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({ email }),
      });

      const data = await response.json();

      if (response.ok) {
        status = 'success';
        message = data.message || 'Successfully subscribed to newsletter!';
        email = '';
      } else {
        status = 'error';
        message = data.message || 'Subscription failed. Please try again.';
      }
    } catch (error) {
      status = 'error';
      message = 'Network error. Please try again later.';
    } finally {
      isSubmitting = false;
      
      // Clear message after 5 seconds
      setTimeout(() => {
        status = 'idle';
        message = '';
      }, 5000);
    }
  }

  function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
  }

  function resetStatus() {
    status = 'idle';
    message = '';
  }
</script>

<div class="newsletter-widget w-full">
  
  <form onsubmit={handleSubmit} class="space-y-4">
    
    <!-- Input Group -->
    <div class="relative">
      <div class="relative flex items-center">
        <svg class="absolute left-4 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        
        <input
          type="email"
          bind:value={email}
          oninput={resetStatus}
          placeholder="Enter your email"
          required
          disabled={isSubmitting}
          class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all disabled:bg-gray-100 disabled:cursor-not-allowed"
        />
      </div>
    </div>

    <!-- Submit Button -->
    <button
      type="submit"
      disabled={isSubmitting || !email}
      class="w-full py-3 px-6 bg-primary text-white font-semibold rounded-lg hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 transition-all disabled:bg-gray-300 disabled:cursor-not-allowed flex items-center justify-center gap-2"
    >
      {#if isSubmitting}
        <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Subscribing...</span>
      {:else}
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
        </svg>
        <span>Subscribe</span>
      {/if}
    </button>

    <!-- Status Messages -->
    {#if status !== 'idle'}
      <div 
        class="p-4 rounded-lg animate-slide-down"
        class:bg-green-50={status === 'success'}
        class:border-green-200={status === 'success'}
        class:bg-red-50={status === 'error'}
        class:border-red-200={status === 'error'}
        class:border={true}
      >
        <div class="flex items-start gap-3">
          {#if status === 'success'}
            <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          {:else}
            <svg class="w-5 h-5 text-red-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          {/if}
          
          <p 
            class="text-sm font-medium"
            class:text-green-800={status === 'success'}
            class:text-red-800={status === 'error'}
          >
            {message}
          </p>
        </div>
      </div>
    {/if}

    <!-- Privacy Notice -->
    <p class="text-xs text-gray-500 text-center">
      We respect your privacy. Unsubscribe at any time.
    </p>

  </form>

</div>