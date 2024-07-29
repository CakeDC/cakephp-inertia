import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import 'bootstrap/dist/css/bootstrap.css'

createInertiaApp({
    title: title => title ? `${title} - Vue App` : 'Vue App',
    resolve: name => import(`./Components/${name}`),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mount(el);
    },
});
