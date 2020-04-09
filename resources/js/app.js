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


    $('#new_admission').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_new_admission",
        columns: [
            { name: 'first_name' },
            { name: 'student_unique_id' },
            { name: 'classes.create_class', orderable: false },
            { name: 'action', orderable: false, searchable: false }
        ],
    });

    $('#pre_admission').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_pre_admission",
        columns: [
            { name: 'first_name' },
            { name: 'roll_no' },
            { name: 'classes.create_class', orderable: false },
            { name: 'action', orderable: false, searchable: false }
        ],
    });

    $('#result').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_result",
        columns: [
            { name: 'class_id', orderable: false },
            { name: 'roll_no' },
            { name: 'students.first_name' },
            { name: 'percentage' },
            { name: 'action', orderable: false, searchable: false }
        ],
    });

    $('#product').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_product",
        columns: [
            { name: 'name' },
            { name: 'unit' },
            { name: 'action', orderable: false, searchable: false }
        ],
    });

    $('#stocks').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_stocks",
        columns: [
            { name: 'id' },
            { name: 'id' },
            { name: 'id' },
            { name: 'id' },
            { name: 'id' },
            { name: 'id' },
            { name: 'id' },
            { name: 'id' },

        ],
    });

    $('#books').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_books",
        columns: [
            { name: 'name' },
            { name: 'standard.name' , orderable: false },
            { name: 'classes.create_class' , orderable: false },
            { name: 'publisher.name' , orderable: false },
            { name: 'subject.name' , orderable: false },
            { name: 'action', orderable: false, searchable: false }

        ],
    });

    $('#damages').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_damages",
        columns: [
            { name: 'products.name' , orderable: false },
            { name: 'colors.name' , orderable: false },
            { name: 'types.name' , orderable: false },
            { name: 'sizes.name' , orderable: false },
            { name: 'gender_id'  },
            { name: 'damage'  }


        ],
    });


    $('#book_stock').DataTable({
        serverSide: true,
        processing: true,
        responsive: true,
        ajax: "/lara_book_stock",
        columns: [
            { name: 'book_id' },
            { name: 'stock_in' },
            { name: 'stock_out' },
            { name: 'stock_in' },
            { name: 'stock_in' },
            { name: 'stock_out' },
            { name: 'available_stocks' },

        ],
    });




});

