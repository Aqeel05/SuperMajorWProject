import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/dashboard.css',
                'resources/js/app.js',
                'resources/js/calendar.js',
                'node_modules/jquery/dist/jquery.min.js',
            ],
            refresh: true,
        }),
    ],
});
