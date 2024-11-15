import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

const port = 5173;
const origin = `${process.env.DDEV_PRIMARY_URL}:${port}`;

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            publicDirectory: 'webroot',
            refresh: true,
        }),
        vue(),
    ],
    build: {
        outDir: 'webroot/js'
    },
    server: {
        host: '0.0.0.0',
        port: port,
        strictPort: true,
        origin: origin
    },
});
