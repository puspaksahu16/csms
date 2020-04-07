/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require( 'jquery' );
require('jquery-ui-dist/jquery-ui');
require('datatables.net');
window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });

$(document).ready(function(){
    $('#pre_exam').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_pre_exam",
        columns: [
            { name: 'exam_name' },
            { name: 'full_mark' },
            { name: 'classes.create_class', orderable: false },
            { name: 'current_year' },
            { name: 'action', orderable: false, searchable: false }
        ],
    });
});

