import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    server: {
        host: true,        // penting agar bisa diakses dari luar
        strictPort: true,  // agar port tetap stabil
        hmr: {
            host: 'localhost', // bisa juga diganti IP lokal kamu
        },
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
