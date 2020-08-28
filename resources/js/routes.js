import AllTexts from './components/AllTexts.vue';
import Static from "./components/Static";
import Text from "./components/Text";

export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllTexts
    },
    {
        name: 'about',
        path: '/about',
        component: Static
    },
    {
        name: 'view',
        path: '/view/:id',
        component: Text
    }
];
