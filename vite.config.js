import { defineConfig } from 'vitest/config';

export default defineConfig({
  publicDir: false,
  build: {
    outDir: 'public',
    emptyOutDir: false,
    rollupOptions: {
      input: 'App/js/index.js',
      output: {
        entryFileNames: 'js/bundle.js',
        assetFileNames: (asset) => asset.name?.endsWith('.css')
          ? 'main.css'
          : 'assets/[name]-[hash][extname]',
      },
    },
  },
  test: {
    environment: 'jsdom',
    globals: true,
  },
});
