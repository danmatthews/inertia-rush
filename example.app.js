import './bootstrap';
import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import axios from 'axios';

createInertiaApp({
  resolve: name => {
    const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
    return pages[`./Pages/${name}.vue`]
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => {
        console.log(props);
        window.Rush = new class {
            constructor(RushConfig) {
                if (RushConfig == null || RushConfig == undefined) {
                    return {};
                }
                for (let i in RushConfig) {
                    this[RushConfig[i].method_name] = function(data) {
                        return axios[RushConfig[i].http_verb.toLowerCase()](RushConfig[i].relative_url, data);
                    };
                }
            }
        }(props?.initialPage?.props?.RushConfig);
        console.log(App);
        return h(App, props);
     }})
      .use(plugin)
      .mount(el)
  },
})
