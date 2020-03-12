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
                                    <li class="breadcrumb-item"><a href="#">Fee Structure</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Books</a>
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
                                    <h4 class="card-title">Create Book price</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- <form class="form" > -->
                                            @csrf
                                            <div class="form-body">
                                                <div class="row" v-for="(item, index) in rowData">
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select @change="fetchBook(index)" class="form-control" v-model="item.book_id">
                                                                <option disabled value="">Select Book</option>
                                                                <option v-for=" book in books" :value="book.id">@{{book.name}}</option>
                                                            </select>
                                                            <label for="name">Book</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input disabled v-model="item.class_id" type="text" class="form-control">
                                                            <label for="color">Class</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input disabled v-model="item.subject_id" type="text" class="form-control">
                                                            <label for="gender">Subject</label>
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
                                                            <input type="text" class="form-control" placeholder="Price" v-model="item.price">
                                                            <label for="quantity">Price</label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-1 col-12">
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
        var BOOKS = {!! $books !!}

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
            books:BOOKS,
            
            sb:[{}],
            rowData:[
            {
                book_id: '',
                class_id: '',
                publisher_id: '',
                subject_id: '',
                price: '',
            }] //the declared array
        },
        methods:{
                addItem(){
                    var my_object = {
                        book_id: '',
                        class_id: '',
                        publisher_id: '',
                        subject_id: '',
                        price: '',
                    };
                    var my_sp = {};
                        this.rowData.push(my_object);
                        this.sb.push(my_sp);
                },
                removeItem(index){
                        this.rowData.splice(index, 1);
                        this.sb.splice(index, 1);
                },
            fetchBook(bid){
                let that = this;
                axios.post('/fetch_book_details', {
                    book_id: that.rowData[bid].book_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    let index = bid;
                    that.$set(that.rowData, [index],response.data);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                },
                submitData(){
                    let that = this;
                    axios.post('/update_price', {
                    books: that.rowData,
                  })
                  .then(function (response) {
                    console.log(response);
                    window.location ="/book_price";
                    // swal("Good job!", "You clicked the button!", "success");
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                }
        }
    })
</script>
@endpush
