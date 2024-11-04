// resources/js/app.js
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import 'bootstrap/dist/css/bootstrap.css'

createInertiaApp({
    title: title => title ? `${title} - Vue App` : 'Vue App',
    //resolve: name => {
    //    const pages = import.meta.glob('./components/**/*.vue')
    //    console.log(pages)
    //    console.log(`./components/${name}.vue`)
    //    return resolvePageComponent(`./components/${name}.vue`,pages)
    //},
    resolve: name => resolvePageComponent(`./components/${name}.vue`, import.meta.glob('./components/**/*.vue')),
    setup({ el, App, props, plugin }) {
        console.log("Props recibidas: ", props);
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
