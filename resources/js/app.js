// resources/js/app.js
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import 'bootstrap/dist/css/bootstrap.css'

createInertiaApp({
    title: title => title ? `${title} - Vue App` : 'Vue App',
    resolve: name => resolvePageComponent(`./components/${name}.vue`, import.meta.glob('./components/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
