// import './bootstrap';

import Alpine from 'alpinejs'
import App from './views/App.vue'
import Axios from 'axios'
import {createApp} from 'vue'
import router from './routes'
import VueAxios from 'vue-axios'

window.Alpine = Alpine
window.Axios = Axios
window.Axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

Alpine.start()
// Vue.use(VueAxios, Axios)


const app = createApp(App)
app.use(router)
app.mount('#app')
