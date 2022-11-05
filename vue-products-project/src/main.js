
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './assets/main.css'

import { library } from "@fortawesome/fontawesome-svg-core";
import {  faShoppingCart } from "@fortawesome/free-solid-svg-icons";
import { faClose } from "@fortawesome/free-solid-svg-icons";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";


library.add(faShoppingCart);
library.add(faClose);

const pinia = createPinia()
const app = createApp(App)

app.use(pinia)
app.use(router)
app.component("font-awesome-icon", FontAwesomeIcon)
app.mount('#app')
