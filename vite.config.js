import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import glob from 'glob-promise';

const jsFiles = await glob('resources/js/**/*.js');
const cssFiles = await glob('resources/css/**/*.css');

export default defineConfig({
    plugins: [
        laravel({
            input: [
                ...cssFiles, 
                ...jsFiles
            ],
            refresh: true,
        }),
    ],
});
