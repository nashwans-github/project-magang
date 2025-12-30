import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/js/news-slider.js",
                "resources/js/pembimbing-handler.js",
                "resources/js/peserta-handler.js",
                "resources/js/profile-handler.js",
                "resources/js/surat-magang-handler.js",
                "resources/js/verifikasi-handler.js",
            ],
            refresh: true,
        }),
    ],
});
