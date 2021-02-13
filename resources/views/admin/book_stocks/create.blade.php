@extends('admin.layouts.master')
@section('content')
    <div id="app" class="app-content content" >
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
{{--                            <h2 class="content-header-title float-left mb-0"></h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Store</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Books Stock</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <!-- // Basic multiple Column Form section start -->
                <section id="">
                    <div class="row match-height ">
                        <div class="col-12" style="margin: auto">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Create Stock</h4>
                                    @if(auth()->user()->role->name == "super_admin")
                                        <select @change="school()" class="form-control" v-model="school_id">
                                            <option disabled value="">Select School</option>
                                            <option v-for=" school in schools" :value="school.id">@{{school.full_name}}</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- <form class="form" > -->
                                            @csrf
                                            <div class="form-body">
                                                <div class="row" v-for="(item, index) in rowData">
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select @change="fetchSub(index)" class="form-control" v-model="item.class_id">
                                                                <option disabled value="">Select Class</option>
                                                                <option v-for=" cclass in classes" :value="cclass.id">@{{cclass.create_class}}</option>
                                                            </select>
                                                            <label for="name">Class</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select @change="fetchBook(index)" class="form-control" v-model="item.subject_id">
                                                                <option disabled value="">Select subjects</option>
                                                                <option v-for=" subject in subject[index]" :value="subject.id">@{{subject.name}}</option>
                                                            </select>
                                                            <label for="color">Subject</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select @change="fetchBookDetails(index)" class="form-control" v-model="item.book_id">
                                                                <option disabled value="">Select book</option>
                                                                <option v-for=" book in books[index]" :value="book.id">@{{book.name}}</option>
                                                            </select>
                                                            <label for="color">Book</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1 col-12">
                                                        <div class="form-label-group">
                                                            <input disabled v-model="item.publisher_id" type="text" class="form-control">
                                                            <label for="size">Publisher</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Quantity" v-model="item.quantity">
                                                            <label for="quantity">Quantity</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <span class="btn btn-text btn-danger" @click="removeItem(index)">X</span>
                                                    </div>

                                                </div>

                                                <span class="btn btn-primary " @click="addItem()">add</span>
                                                <div class="col-12 pt-2">
                                                    <button @click="submitData()" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Floating Label Form section end -->

            </div>
        </div>
    </div>
    <script>
        var CLASSES = {!! $classes !!}
        var SCHOOLS = {!! $schools!!}

</script>
@endsection
@push('scripts')

<!-- <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.css"> -->
{{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
<script>
    // import Swal from 'sweetalert2';
    // import Swal from 'sweetalert/dist/sweetalert.min.js'
    // Vue.use(window.Sweetalert);
    // const Swal = require('sweetalert');
    var app = new Vue({
        el: '#app',
        data: {
            classes: CLASSES,
            schools: SCHOOLS,
            school_id: '',
            subject: [],
            books: [],

            sb:[{}],
            rowData:[
            {
                book_id: '',
                class_id: '',
                publisher_id: '',
                subject_id: '',
                quantity: '',
            }] //the declared array
        },
        methods:{
                addItem(){
                    var my_object = {
                        book_id: '',
                        class_id: '',
                        publisher_id: '',
                        subject_id: '',
                        quantity: '',
                    };
                    var my_sp = {};
                        this.rowData.push(my_object);
                        this.sb.push(my_sp);
                },
                removeItem(index){
                        this.rowData.splice(index, 1);
                        this.sb.splice(index, 1);
                },
            fetchSub(bid){
                let that = this;
                app.rowData[bid].subject_id = '';
                app.rowData[bid].book_id = '';
                app.rowData[bid].publisher_id = '';
                axios.post('/fetch_sub', {
                    class_id: that.rowData[bid].class_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    let index = bid;
                      that.$set(that.subject, [index],response.data.subject);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                },
                fetchBook(bid){
                let that = this;
                app.rowData[bid].book_id = '';
                app.rowData[bid].publisher_id = '';
                axios.post('/fetch_book', {
                    subject_id: that.rowData[bid].subject_id,
                    class_id: that.rowData[bid].class_id,
                })
                    .then(function (response) {
                        console.log(response);
                        let index = bid;

                        that.$set(that.books, [index],response.data.books);
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                },
                fetchBookDetails(bid){
                    let that = this;
                    axios.post('/fetch_book_details', {
                        book_id: that.rowData[bid].book_id,
                    })
                        .then(function (response) {
                            console.log(response);
                            let index = bid;
                            // that.$set(that.rowData.subject_id, [index],response.data.subject_id);
                            that.$set(that.rowData, [index],response.data);
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
            school(){
                let that = this;
                axios.post('/fetch_school_bookstock', {
                    school_id: that.school_id,
                })
                    .then(function (response) {
                        console.log(response);
                        that.classes = response.data;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
                submitData(){
                    let that = this;
                    axios.post('/book_stocks', {
                    books: that.rowData,
                        school_id: that.school_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    window.location ="/book_stocks";
                    // swal("Good job!", "You clicked the button!", "success");
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                }
        }
    })
</script>

    <script src="{{asset('admin_assets/vendors/js/vendors.min.js') }}"></script>
@endpush
