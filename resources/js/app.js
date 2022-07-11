/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


// Importo vue da node_modules
import Vue from 'vue'
//window.Vue = require('vue').default;

// Importo vueRouter da node_modules 
import VueRouter from 'vue-router'

//Prende il file index.js nella cartella routes che sarebbe il file dove inserisco tutte le rotte dei vari componenti
import { routes } from './routes';

//Vue.use ti impedisce automaticamente di utilizzare lo stesso plug-in più di una volta,
// quindi chiamandolo più volte sullo stesso plug-in verrà installato il plug-in solo una volta.
Vue.use(VueRouter)


//Registra i percorsi
// Creo un instanza dell' ogetto VueRouter
export const router = new VueRouter({
    base: '/',
    mode: 'history',
    routes
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Registrazione componente 
Vue.component('app-component', require('./views/App.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Creo una nuova instanza dell'aplicazione Vue 
 const app = new Vue({
    router
}).$mount('#app')
