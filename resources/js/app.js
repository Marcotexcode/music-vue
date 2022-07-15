require('./bootstrap');


import Vue from 'vue'
import VueRouter from 'vue-router'
import { routes } from './routes';
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueRouter)


//Registra i percorsi
// Creo un instanza dell' ogetto VueRouter
export const router = new VueRouter({
    base: '/',
    mode: 'history',
    routes
});


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
