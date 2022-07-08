

import Calendario from '../components/Calendario.vue';
import Band from '../components/Band.vue';
import Home from '../components/Home.vue';


export const routes = [
    {
		path: '/calendario',
        component: Calendario
    },
    {
		path: '/band',
        component: Band
    },
    {
		path: '/home',
        component: Home
    },
];
