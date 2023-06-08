import AlpineJS from 'alpinejs';
import 'feather-icons/dist/feather.js';
import Swal from 'sweetalert2/dist/sweetalert2.js';
import 'sweetalert2/src/sweetalert2.scss';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler.js';
import axios from 'axios';
import { createPinia } from 'pinia';
import views from '@/js/views/index.js';
// import components from '@/js/components/index.js';

window.AlpineJS = AlpineJS;
window.Swal = Swal;

AlpineJS.start();

const pinia = createPinia();
// Obtén el token CSRF del meta-tag en tu aplicación Laravel
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// Configura el token CSRF como encabezado por defecto en Axios
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;

try {
    const vueAppBundler = createApp({
        mounted() {
            // console.log('The app is working')
        },
        components: {
            'indexEquipments': views.indexEquipments,
            'createEquipments': views.createEquipments,
            'editEquipments': views.editEquipments,
            'indexRents': views.indexRents,
        },
    }).use(pinia);
    vueAppBundler.mount('#vueApp');
} catch (error) {
    // Aquí puedes agregar el código para manejar el error de montaje
    console.error('Error al montar la aplicación:', error);
}
