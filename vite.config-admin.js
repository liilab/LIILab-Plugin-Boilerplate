import { defineConfig } from 'vite'

// Function to run during development
export default defineConfig({
    build : {
      manifest: false,
      outDir: "dist",
      emptyOutDir: false,
      sourcemap: false,
      rollupOptions: {
        input: {
          admin: `${__dirname}/src/admin/main.tsx`,
        },
        output: {
          chunkFileNames: "js/[name].js",
          entryFileNames: "js/[name].js",
        },

        assetFileNames: ({name}) => {
            if (/\.(gif|jpe?g|png|svg)$/.test(name ?? '')){
                return 'images/[name][extname]';
            }
            
            if (/\.css$/.test(name ?? '')) {
                return 'css/[name][extname]';   
            }
   
            // default value
            // ref: https://rollupjs.org/guide/en/#outputassetfilenames
            return '[name][extname]';
          },
      },
    }
})