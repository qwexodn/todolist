

import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import Router from './routes/route';

import App from './views/App';

Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    router:Router,
    render:h => h(App)
});
