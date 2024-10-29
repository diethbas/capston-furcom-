import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import fs from 'fs';
import path from 'path';

export default defineConfig({
    server: {
        https: {
        key: fs.readFileSync(path.resolve(__dirname, 'localhost.key')),
        cert: fs.readFileSync(path.resolve(__dirname, 'localhost.crt')),
        },
        host: 'localhost',
        port: 443, 
    },
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
