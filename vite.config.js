import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import {glob} from 'glob';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js',

                // Detectar automáticamente todos los CSS y JS en subdirectorios
                ...glob.sync('resources/css/**/*.css'),
                ...glob.sync('resources/js/**/*.js'),
            ],

            refresh: true,
        }),
    ],
});
