
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

import LoginPage from './components/LoginComponent.vue';

const routes = [
    { path: '/login', component: LoginPage },
];


const router = new VueRouter({
    mode: 'history',
    base: '/',
    routes: routes
});

const app = new Vue({
    router,
    data: {
        userAccessToken: ''
    }
}).$mount('#application');
