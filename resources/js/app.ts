import { createInertiaApp } from '@inertiajs/vue3';
import Layout from './layouts/Layout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout: () => Layout,
    progress: {
        color: '#4B5563',
    },
});
