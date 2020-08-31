/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import App from './App.vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import auth from './auth'
import VueAuth from '@websanova/vue-auth'
import router from './routes'
import Vuex from 'vuex'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const LOGIN = "LOGIN";
const LOGIN_SUCCESS = "LOGIN_SUCCESS";
const LOGOUT = "LOGOUT";

const store = new Vuex.Store({
    state: {
        isLoggedIn: !!localStorage.getItem('auth_stay_signed_in')
    },
    mutations: {
        [LOGIN] (state) {
            state.pending = true;
        },
        [LOGIN_SUCCESS] (state) {
            state.isLoggedIn = true;
            state.pending = false;
        },
        [LOGOUT](state) {
            state.isLoggedIn = false;
        }
    }
});

// Set Vue globally
window.Vue = Vue
// Set Vue router
Vue.router = router
Vue.use(VueRouter)
// Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`

axios.interceptors.response.use(function (response) {
    // Do something before request is sent
    const newtoken = response.headers.authorization;
    if (newtoken) {
        localStorage.setItem('auth_token', newtoken)
    }
    return response
}, function (error) {
    switch (error.response.status) {
        case 400:
        case 401:
            localStorage.removeItem('auth_token');
            localStorage.removeItem('auth_token_default');
            localStorage.removeItem('auth_stay_signed_in');
            break

        default:
            console.log(error.response)
    }
    return Promise.reject(error)
})

Vue.use(VueAuth, auth)

const app = new Vue({
    el: '#app',
    router: router,
    render: h => h(App),
    store: store
});
