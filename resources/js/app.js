import AlpineJS from 'alpinejs';
import 'feather-icons/dist/feather.js';
import Swal from 'sweetalert2';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import viewsRents from '@/js/views/Rents/index.js';
// import components from '@/js/components/index.js';
import axios from 'axios';

window.AlpineJS = AlpineJS;
window.Swal = Swal;

AlpineJS.start();

// Obtén el token CSRF del meta-tag en tu aplicación Laravel
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Configura el token CSRF como encabezado por defecto en Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

const vueAppBundler = createApp({
    mounted() {
        // console.log('The app is working')
    },
    components: {
        'indexRents': viewsRents.indexRents,
    },
});

vueAppBundler.mount('#vueApp');
