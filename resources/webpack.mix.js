const mix = require('laravel-mix');
const path = require('path');

mix.setPublicPath('./webroot')
    .js('resources/js/app.js', 'webroot/js').vue()
    .webpackConfig({
        output: {
            chunkFilename: 'js/[name].js?id=[chunkhash]'
        },
        resolve: {
            alias: {
                vue$: 'vue/dist/vue.runtime.esm.js',
                '@': path.resolve('resources/js'),
            },
        },
    })
    .version()
    .sourceMaps();
