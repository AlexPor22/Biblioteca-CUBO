// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
  server: {
    host: '127.0.0.1',   // o 'localhost'
    port: 5173,
    hmr: { host: '127.0.0.1' } // sin IP de tu LAN
  },
  plugins: [
    laravel({
      input: [
        "resources/css/globalsAdmin.css",
        "resources/css/buttons.css",
        "resources/css/status.css",
        "resources/css/animations.css",
        "resources/css/index.css",
        "resources/css/table.css",
        "resources/css/search.css",
        "resources/css/recent__uploads.css",
        "resources/css/cards.css",
        "resources/css/sidebar__admin.css",
        "resources/js/sidebar__admin.js",
        // si usas más JS, agrégalo aquí
      ],
      refresh: true,
    }),
    tailwindcss(),
  ],
});
