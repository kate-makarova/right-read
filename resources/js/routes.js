import AllTexts from './components/AllTexts.vue';
import Static from "./components/Static";
import Text from "./components/Text";
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import VueRouter from 'vue-router';

const routes = [
    {
        name: 'home',
        path: '/',
        component: AllTexts,
        meta: {
            auth: true
        }
    },
    {
        name: 'about',
        path: '/about',
        component: Static,
        meta: {
            auth: false
        }
    },
    {
        name: 'view',
        path: '/view/:id',
        component: Text,
        meta: {
            auth: true
        }
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: false
        }
    },{
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: false
        }
    }
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router
