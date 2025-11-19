import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    server: {
        host: '0.0.0.0', // bind to all interfaces so host can reach container
        port: 5174,
        hmr: {
            host: 'localhost', // the host your browser will access
            protocol: 'ws',    // websocket for HMR
            port: 5174,
        },
    },
    plugins: [
        laravel({
            input: [
                // CSS
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
