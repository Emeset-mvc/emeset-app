import { defineConfig } from 'vitest/config';

export default defineConfig({
  publicDir: false,
  build: {
    outDir: 'public',
    emptyOutDir: false,
    rollupOptions: {
      input: 'App/js/index.js', // input: globSync('App/js/*.js'),
      /*
        Canviar a:
        
          input: globSync('App/js/*.js'),

          entryFileNames: 'js/[name].js',
        
        Per compilar arxius js per separat.
        Tots els Js de la carpeta App/js/...
        Es compilaran a /js/NOM_ORIGINAL.js
      */
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
