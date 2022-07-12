
// Importo i vari componenti vue
import Calendario from '../components/Calendario.vue';
import Band from '../components/Band.vue';
import Home from '../components/Home.vue';
import ModificaBand from '../components/ModificaBand.vue';


// Esporto le rotte dei vari componenti vue
export const routes = [
    {
        name: 'calendario',
		path: '/calendario',
        component: Calendario
    },
    {
        name: 'band',
		path: '/band',
        component: Band
    },
    {
        name: 'home',
		path: '/home',
        component: Home
    },
    {
		name: 'modifica-band',
        path: '/modifica-band/:id',
        component: ModificaBand
    },
];
