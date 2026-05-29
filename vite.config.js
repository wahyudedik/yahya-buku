import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/article-editor.css',
                'resources/js/app.js',
                'resources/js/article-editor.js',
            ],
            refresh: true,
        }),
    ],
});
