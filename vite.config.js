const path = require('path')
import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue'
import viteCompression from 'vite-plugin-compression'
import { resolve } from 'path'

export default defineConfig(({ command, mode }) => {

    return {
        server: {},
        plugins: [
            laravel({
                input: [
                    'resources/js/app.js',
                    'resources/js/site.js',
                ],
                refresh: true
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false,
                    },
                },
            }),
            viteCompression({
              filter: /\.(js|css|scss)$/i
            })
        ],
        css: {
            postCss: {
                plugins: {
                    tailwindcss: {},
                    autoprefixer: {},
                },
            },
        },
        resolve:{
          alias:{
            'vue': "vue/dist/vue.esm-bundler.js",
            '@': path.resolve(__dirname, './resources'),
            '@sass': path.resolve(__dirname, './resources/sass'),
            '@var': path.resolve(__dirname, './resources/var'),
            '@plugins': path.resolve(__dirname, './resources/plugins'),
            '@js': path.resolve(__dirname, './resources/js'),
            '@repositories': path.resolve(__dirname, './resources/js/repositories'),
            '@core': path.resolve(__dirname, './resources/js/core'),
            '@routes': path.resolve(__dirname, './resources/js/routes'),
            '@stores': path.resolve(__dirname, './resources/js/stores'),
            '@services': path.resolve(__dirname, './resources/js/services'),
            '@views': path.resolve(__dirname, './resources/js/views'),
          },
        },
    }
})
