
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
var vuejs_datepicker = require('vuejs-datepicker');
var select2 = require("select2-vue-component");
var VeeValidate = require('vee-validate');
import axios from 'axios';
import VueResource from 'vue-resource';

Vue.use(VueResource)
Vue.use(VeeValidate);
Vue.use(vuejs_datepicker);
Vue.use(select2);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

const app = new Vue({
    el: '#app'
});
