
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Vue from 'vue';
import VueRouter from 'vue-router';
import Toasted from 'vue-toasted';
import LoginPage from './components/LoginComponent.vue';
import HomePage from './components/HomeComponent.vue';

Vue.use(VueRouter);
Vue.use(Toasted, {
    action : {
        text : 'Close',
        class: 'close-button-link',
        onClick : (e, toastObject) => {
            toastObject.goAway(0);
        }
    },
    duration: 3000
});

const routes = [
    { path: '/', component: HomePage, name: 'front_home_page' },
    { path: '/login', component: LoginPage, name: 'front_login_page' },
];

const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: routes
});

const app = new Vue({
    router,
}).$mount('#application');
