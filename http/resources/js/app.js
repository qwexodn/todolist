

import './bootstrap';
import Vuetify from 'vuetify';
import Vue from 'vue';
import 'vuetify/dist/vuetify.min.css';
import FontAwesome from '@fortawesome/fontawesome-free'

import Router from './routes/route';

import App from './views/App';
import colors from 'vuetify/lib/util/colors';

Vue.use(Vuetify, {
    theme:{
        error:colors.red.accent3
    }
});

Vue.component('font-awesome-icon', FontAwesome);

Vue.config.productionTip = false;

const app = new Vue({
    el: '#app',
    router:Router,
    render:h => h(App)
});
