import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/globalsAdmin.css",
                "resources/css/buttons.css",
                "resources/css/pagination.css",
                "resources/css/animations.css",
                "resources/css/index.css",
                "resources/css/table.css",
                "resources/css/search.css",
                "resources/css/recent__uploads.css",
                "resources/css/cards.css",
                "resources/js/app.js",
                "resources/css/sidebar__admin.css",
                "resources/js/sidebar__admin.js",
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: '192.168.1.5' // IP local de tu PC
        }
    }
});
