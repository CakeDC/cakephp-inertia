import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'

createInertiaApp({
    //title: (title) => `${title} - ${appName}`,
    title: (title) => `titulo`,
    resolve: (name) => require(`./Components/${name}.vue`),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            //.mixin({ methods: { route } })
            .mount(el);
    },
});
