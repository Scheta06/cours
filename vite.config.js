import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/main.css',
                'resources/css/auth.css',
                'resources/css/profile.css',
                'resources/css/index.css',
                'resources/css/partials.css',
                'resources/css/catalog.css',
                'resources/css/cart.css',
                'resources/css/admin.css',
                'resources/css/createItemCategory.css',
                'resources/css/createItem.css',
                'resources/css/manageItem.css',
                'resources/css/notification.css',
                'resources/js/app.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
