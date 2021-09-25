import Vue from 'vue'
import Vuetify from 'vuetify';
import Home from "./components/pages/HomeComponent";

require('./bootstrap');

Vue.component('HomeComponent', require('./components/pages/HomeComponent.vue').default);
Vue.use(Vuetify);

const app = new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    components: {
        Home
    }
});