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
                                    <li class="breadcrumb-item"><a href="#">Book</a>
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
                                    <h4 class="card-title">Create Book</h4>
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
                                                            <select @change="fetchClass(index)" class="form-control" v-model="item.standard_id">
                                                                <option disabled value="">Select standard</option>
                                                                <option v-for=" standard in standards" :value="standard.id">@{{standard.name}}</option>
                                                            </select>
                                                            <label for="name">Standard</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.class_id">
                                                                <option disabled value=""> Class</option>
                                                                <option v-for="c in ss[index]" :value="c.id">@{{c.create_class}}</option>
                                                            </select>
                                                            <label for="color">Class</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.subject_id">
                                                                <option disabled value="">Subject</option>
                                                                <option v-for=" subject in subjects" :value="subject.id">@{{subject.name}}</option>
                                                            </select>
                                                            <label for="size">Subject</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Book Name" v-model="item.name">
                                                            <label for="book">Book Name</label>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.publisher_id">
                                                                <option disabled value=""> publisher</option>
                                                                <option v-for=" publisher in publishers" :value="publisher.id">@{{publisher.name}}</option>
                                                            </select>
                                                            <label for="gender">Publisher</label>
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
        var STANDARDS = {!! $standards !!}
        var PUBLISHERS = {!! $publishers !!}
        var SUBJECTS = {!! $subjects !!}
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
            standards: STANDARDS,
            publishers: PUBLISHERS,
            subjects: SUBJECTS,
            schools: SCHOOLS,
            school_id: '',
            ss:[{}],
            rowData:[
            {
                standard_id: '',
                class_id: '',
                publisher_id: '',
                subject_id: '',
                name: '',
            }] //the declared array
        },
        methods:{
                addItem(){
                    var my_object = {
                        standard_id: '',
                        class_id: '',
                        publisher_id: '',
                        subject_id: '',
                        name: '',
                    };
                    var my_sp = {};
                        this.rowData.push(my_object);
                        this.ss.push(my_sp);
                },
                removeItem(index){
                        this.rowData.splice(index, 1);
                        this.ss.splice(index, 1);
                },
                fetchClass(sid){
                let that = this;
                axios.post('/fetch_class', {
                    standard_id: that.rowData[sid].standard_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    let index = sid;
                    that.$set(that.ss, [index], response.data);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                },
            school(){
                let that = this;
                axios.post('/fetch_school_books', {
                    school_id: that.school_id,
                })
                    .then(function (response) {
                        console.log(response);
                        that.standards = response.data.standards;
                        that.subjects = response.data.subjects;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
                submitData(){
                    let that = this;
                    axios.post('/books', {
                    books: that.rowData,
                        school_id: that.school_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    window.location ="/books";
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
