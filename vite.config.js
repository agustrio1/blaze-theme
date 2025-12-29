import { defineConfig } from 'vite';
import { svelte } from '@sveltejs/vite-plugin-svelte';
import tailwindcss from '@tailwindcss/vite';
import path from 'path';

export default defineConfig({
  plugins: [
    svelte(),
    tailwindcss()
  ],
  build: {
    outDir: 'dist',
    emptyOutDir: true,
    rollupOptions: {
      input: {
        main: path.resolve(__dirname, 'svelte/main.js'),
        admin: path.resolve(__dirname, 'assets/js/admin.js'),
        // customizerPreview: path.resolve(__dirname, 'svelte/customizer-preview.js')
      },
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith('.css')) {
            return 'css/[name][extname]';
          }
          return 'assets/[name]-[hash][extname]';
        }
      }
    },
    minify: 'esbuild',
    sourcemap: false
  },
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'svelte')
    }
  }
});