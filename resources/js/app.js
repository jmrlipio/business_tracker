/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Chart from 'chart.js';
import moment from 'moment';

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('sales', require('./components/sales/Sales.vue').default);
Vue.component('create_sales', require('./components/sales/CreateSales.vue').default);
Vue.component('list_sales', require('./components/sales/ListSales.vue').default);

Vue.component('list_business', require('./components/business/ListBusiness.vue').default);
Vue.component('create_expense', require('./components/expense/CreateExpense.vue').default);
Vue.component('list_expense', require('./components/expense/ListExpense.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
