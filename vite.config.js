import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel(
            {
                input: [
                    'resources/css/app.css', 'resources/js/app.{js,jsx,ts,tsx}'
                ],
                refresh: true
            }
        ),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: undefined,
                entryFileNames: 'assets/[name].[hash].js',
                chunkFileNames: 'assets/[name].[hash].js',
                assetFileNames: 'assets/[name].[hash].[ext]',
                dir: 'public/build',
                format: 'es',
                sourcemap: true,
                manifest: true, // Genera el archivo manifest.json
            }
        }
    },
    css: {
        postcss: {
            plugins: [require('tailwindcss'), require('autoprefixer'),]
        }
    },
    resolve: {
        alias: {
            '@': '/resources'
        },
    },
});
