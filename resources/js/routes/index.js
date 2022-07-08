
// Importo i vari componenti vue
import Calendario from '../components/Calendario.vue';
import Band from '../components/Band.vue';
import Home from '../components/Home.vue';

// Esporto le rotte dei vari componenti vue
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
