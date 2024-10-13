import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

import { OhVueIcon, addIcons } from "oh-vue-icons";
import { FaFacebook, FaLinkedin, FaTwitter, FaYoutube, FaLink, FaSearch, FaMailBulk, FaPhoneAlt, FaDownload } from "oh-vue-icons/icons";

import * as FaIcons from "oh-vue-icons/icons/fa";
// const Fa = Object.values({ ...FaIcons });
// addIcons(...Fa);

addIcons(FaFacebook, FaLinkedin, FaTwitter, FaYoutube, FaLink, FaSearch, FaMailBulk, FaPhoneAlt, FaDownload);

import Multiselect from 'vue-multiselect'

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('v-icon',OhVueIcon)
            .component('multiselect', Multiselect)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
