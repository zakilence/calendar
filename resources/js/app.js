import Vue from 'vue';
import Vuetify from 'vuetify';// vuetifyをimport
import Home from "./components/pages/HomeComponent";

require('./bootstrap');

Vue.component('HomeComponent', require('./components/pages/HomeComponent.vue').default);
Vue.use(Vuetify); //Vuetifyの使用を宣言

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    components: {
        Home
    }
});