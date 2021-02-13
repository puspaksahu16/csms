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
                                    <li class="breadcrumb-item"><a href="#">Stock</a>
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
                                    <h4 class="card-title">Create Stock </h4>
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
                                                            <select @change="fetchProductDetails(index)" class="form-control" v-model="item.product_id">
                                                                <option disabled value="">Select Products</option>
                                                                <option v-for=" product in products" :value="product.id">@{{product.name}}</option>
                                                            </select>
                                                            <label for="name">Product</label>
                                                        </div>
                                                    </div>
                                                    <div v-if="sp[index].colors" class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.color_id">
                                                                <option disabled value=""> color</option>
                                                                <option v-for=" color in sp[index].colors" :value="color.id">@{{color.name}}</option>
                                                            </select>
                                                            <label for="color">Color</label>
                                                        </div>
                                                    </div>
                                                    <div v-if="sp[index].genders" class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.gender_id">
                                                                <option disabled value=""> Gender</option>
                                                                <option v-for=" gender in sp[index].genders" :value="gender.id">@{{gender.name}}</option>
                                                            </select>
                                                            <label for="gender">Gender</label>
                                                        </div>
                                                    </div>
                                                    <div v-if="sp[index].sizes" class="col-md-1 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.size_id">
                                                                <option disabled value=""> size</option>
                                                                <option v-for=" size in sp[index].sizes" :value="size.id">@{{size.name}}</option>
                                                            </select>
                                                            <label for="size">size</label>
                                                        </div>
                                                    </div>
                                                    <div v-if="sp[index].types" class="col-md-1 col-12">
                                                        <div class="form-label-group">
                                                            <select class="form-control" v-model="item.type_id">
                                                                <option disabled value=""> Pages</option>
                                                                <option v-for=" type in sp[index].types" :value="type.id">@{{type.name}}</option>
                                                            </select>
                                                            <label for="type">Pages</label>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-2 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" class="form-control" placeholder="Quantity" v-model="item.quantity">
                                                            <label for="quantity">Quantity</label>
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
        var PRODUCTS = @json($products)
{{--        var PRODUCTS = {!! auth()->user()->role->name == "super_admin" ? $products : $products !!}--}}
        var COLORS = {!! $colors !!}
        var TYPES = {!! $types !!}
        var SIZES = {!! $sizes !!}
        var SCHOOLS = {!! $schools!!}

</script>
@endsection
@push('scripts')

<!-- <link rel="stylesheet" href="sweetalert2/dist/sweetalert2.css"> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    // import Swal from 'sweetalert2';
    // import Swal from 'sweetalert/dist/sweetalert.min.js'
    // Vue.use(window.Sweetalert);
    // const Swal = require('sweetalert');
    var app = new Vue({
        el: '#app',
        data: {
            products:PRODUCTS,
            schools: SCHOOLS,
            school_id: '',
            sp:[{}],
            rowData:[
            {
                product_id: '',
                color_id: '',
                type_id: '',
                size_id: '',
                gender_id: '',
                unit:'',
                price: '',
                quantity: '',
            }] //the declared array
        },
        methods:{
                addItem(){
                    var my_object = {
                        product_id: '',
                        color_id: '',
                        type_id: '',
                        size_id: '',
                        gender_id: '',
                        unit:'',
                        price: '',
                        quantity: '',
                    };
                    var my_sp = {};
                        this.rowData.push(my_object);
                        this.sp.push(my_sp);
                },
                removeItem(index){
                        this.rowData.splice(index, 1);
                        this.sp.splice(index, 1);
                },
                fetchProductDetails(sid){
                let that = this;
                axios.post('/fetchProductDetails', {
                    product_id: that.rowData[sid].product_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    let index = sid;
                    that.$set(that.sp, [index],response.data);
                  })
                  .catch(function (error) {
                    console.log(error);
                  });
                },
                school(){
                    let that = this;
                    this.sp = [{product_id: ''}];
                    this.rowData = [{
                            product_id: '',
                            color_id: '',
                            type_id: '',
                            size_id: '',
                            gender_id: '',
                            unit:'',
                            price: '',
                            quantity: '',
                        }];
                    axios.post('/fetch_school_products', {
                        school_id: that.school_id,
                    })
                        .then(function (response) {
                            console.log(response);
                            that.products = response.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                },
                submitData(){
                    let that = this;
                    axios.post('/stocks', {
                    stock: that.rowData,
                    school_id: that.school_id,
                  })
                  .then(function (response) {
                    console.log(response);
                    window.location ="/stocks";
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
