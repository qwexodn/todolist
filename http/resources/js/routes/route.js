

import VueRouter from 'vue-router';
import Vue from 'vue';

import Home from '../views/Home';

Vue.use(VueRouter);

const Route = new VueRouter({
    mode:'history',
    routes:[
        {
            path:'/',
            name:'home',
            component:Home
        }
    ]
});

export default Route;