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
        css: path.resolve(__dirname, 'assets/css/main.css'),
      },
      
      output: {
        entryFileNames: 'js/[name].js',
        chunkFileNames: 'js/[name]-[hash].js',
        assetFileNames: (assetInfo) => {
          if (assetInfo.name.endsWith('.css')) {
            return 'css/main.css';
          }
          
          if (/\.(png|jpe?g|svg|gif|tiff|bmp|ico)$/i.test(assetInfo.name)) {
            return 'images/[name]-[hash][extname]';
          }
          
          if (/\.(woff2?|eot|ttf|otf)$/i.test(assetInfo.name)) {
            return 'fonts/[name]-[hash][extname]';
          }
          
          return 'assets/[name]-[hash][extname]';
        },
      },
    },
    
    minify: 'esbuild',
    sourcemap: false,
  },
  
  resolve: {
    alias: {
      '@': path.resolve(__dirname, 'svelte'),
      '@components': path.resolve(__dirname, 'svelte/components'),
      '@stores': path.resolve(__dirname, 'svelte/stores'),
      '@assets': path.resolve(__dirname, 'assets'),
    },
  },
  
  server: {
    host: 'localhost',
    port: 5173,
    strictPort: true,
    open: false,
  },
});