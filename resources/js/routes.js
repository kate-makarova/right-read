import AllTexts from './components/AllTexts.vue';
import Static from "./components/Static";
import Text from "./components/Text";
import Register from './components/Register.vue';
import Login from './components/Login.vue';
import VueRouter from 'vue-router';
import Index from "./components/Index";

const routes = [
    {
        name: 'home',
        path: '/',
        component: Index,
        meta: {
            auth: undefined
        }
    },
    {
        name: 'texts',
        path: '/texts',
        component: AllTexts,
        meta: {
            auth: undefined
        }
    },
    {
        name: 'about',
        path: '/about',
        component: Static,
        meta: {
            auth: undefined
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

router.beforeEach((to, from, next) => {
    if (!to.meta.auth) {
        next();
    } else if (store.getters["user/isAuthenticated"]) {
        next();
    } else {
        next({
            path: "/login"
        });
    }
});

export default router
