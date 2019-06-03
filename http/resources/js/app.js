

import './bootstrap';
import Vue from 'vue';
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'

import Router from './routes/route';

import App from './views/App';

Vue.use(Vuetify);

$.extend(true, jQuery.fn.datetimepicker.defaults, {
    icons: {
        time: 'far fa-clock',
        date: 'far fa-calendar',
        up: 'fas fa-arrow-up',
        down: 'fas fa-arrow-down',
        previous: 'fas fa-chevron-left',
        next: 'fas fa-chevron-right',
        today: 'fas fa-calendar-check',
        clear: 'far fa-trash-alt',
        close: 'far fa-times-circle'
    }
});

const app = new Vue({
    el: '#app',
    router:Router,
    render:h => h(App)
});
