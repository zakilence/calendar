import Vue from 'vue';
import Vuex from "vuex"; // vuexライブラリーをimport
import Vuetify from 'vuetify';// vuetifyをimport
import Home from "./components/pages/HomeComponent";
import store from "./store/index"; // vuexストアを読み込む

require('./bootstrap');

Vue.component('HomeComponent', require('./components/pages/HomeComponent.vue').default);
Vue.use(Vuex);  // Vuexを使用する事を宣言
Vue.use(Vuetify); //Vuetifyの使用を宣言

new Vue({
    el: '#app',
    vuetify: new Vuetify(),
    store: store,
    components: {
        Home
    }
});