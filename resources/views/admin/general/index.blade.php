@extends('admin.layouts.master')
@section('content')
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    @if(is_array(session()->get('success')))
                        <ul>
                            @foreach (session()->get('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ session()->get('success') }}
                    @endif
                </div>
            @endif
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            {{--                            <h2 class="content-header-title float-left mb-0">Pre Admission</h2>--}}
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Fees Structure</a>
                                    </li>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">General Fee</a>
                                    </li>

                                </ol>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="content-body"><!-- Basic Horizontal form layout section start -->

                <div class="row" id="table-striped">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header table-card-header">
                                <h4 class="card-title">General Fee</h4>

                                <a class="btn btn-primary" href="{{url('/general/create')}}">Add General Fee</a>
                            </div>
                            <div class="container">
                                <form class="form" action="{{url('/fetch_class_table')}}" method="get">
                                    @csrf
                                    <div class="row">
                                        @if(auth()->user()->role->name == "super_admin")
                                        <div class="col-md-4">
                                            <select name="school_id" onclick="getClass()" id="school_id" class="form-control">
                                                <option value="">-SELECT School-</option>

                                                @foreach($schools as $school)
                                                    <option value="{{ $school->id }}">{{ $school->full_name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                        @endif
                                        <div class="col-md-4">
                                            <select onchange="classFiler(this.value)" name="class_id" id="class" class="form-control">
                                                <option value="">-SELECT CLASS-</option>
                                                @if(auth()->user()->role->name == "admin")
                                                    @foreach($classes as $class)
                                                        <option value="{{ $class->id }}">{{ $class->create_class }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>

                                    </div>
                                </form>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table zero-configuration">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            @if(auth()->user()->role->name == "super_admin")
                                                <th scope="col">School</th>
                                            @endif
                                            <th scope="col">Fee Name</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Type</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody id="class_filter">
                                        @foreach($general as $key => $generals)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                @if(auth()->user()->role->name == "super_admin")
                                                    <td>{{$generals->schools->full_name}}</td>
                                                @endif
                                                <td>{{$generals->name}}</td>
                                                <td>{{$generals->classes->create_class}}</td>
                                                <td>{{$generals->price}}</td>
                                                @if($generals->type == '1')
                                                    <td>Annually</td>
                                                @else
                                                    <td>Monthly</td>
                                                @endif

                                                @if($generals->is_active == '1')
                                                    <td><button class="btn-info">Active</button></td>
                                                @else
                                                    <td><button class="btn-danger">Inactive</button></td>
                                                @endif
                                                <td><a href="{{route('general.edit', $generals->id)}}" class="btn btn-primary btn-sm">Edit</a></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function getClass() {
            var school_id = $('#school_id').val();
            // alert(csrf);
            $.ajax({
                url : "/get_class/"+school_id,
                type:'get',
                success: function(response) {
                    console.log(response);
                    $("#class").attr('disabled', false);
                    $("#class").empty();
                    $("#class").append('<option value="">-Select Class-</option>');
                    $.each(response,function(key, value)
                    {
                        $("#class").append('<option value=' + key + '>' + value + '</option>');
                    });
                }
            });
        }
        function classFiler() {
            var school_id = $('#school_id').val();
            var class_id = $('#class').val();
            // alert(class_id);
            $.ajax({
                type: "get",
                url: "/fetch_generalfee_class",
                data:{school_id: school_id, class_id: class_id},

                success: function(data){
                    console.log(data);
                    $("#class_filter").empty();
                    $.each(data, function(key, value)
                    {
                        @if(auth()->user()->role->name == "super_admin")
                        $("#class_filter").append('<tr>' +
                            '<td scope="row">' + (key + 1) + '</td>'+
                            '<td>' + value.schools.full_name + '</td>'+
                            '<td>' + value.name + '</td>'+
                            '<td>' + value.classes.create_class + '</td>'+
                            '<td>' + value.price + '</td>'+
                            '<td>'+ (value.type == 1 ? 'Annually': 'Monthlly')  +'</td>'+
                            '<td>'+ (value.is_active == 1 ? '<button class="btn-info">Active</button>' : '<button class="btn-danger">Inactive</button>')  +'</td>'+
                            '<td><a href="general/'+ value.id + '/edit" class="btn btn-primary btn-sm">Edit</a></td>'+
                            '</tr>');
                        @else

                        $("#class_filter").append('<tr>' +
                            '<td scope="row">' + (key + 1) + '</td>'+
                            '<td>' + value.name + '</td>'+
                            '<td>' + value.classes.create_class + '</td>'+
                            '<td>' + value.price + '</td>'+
                            '<td>'+ (value.type == 1 ? 'Annually': 'Monthlly')  +'</td>'+
                            '<td>'+ (value.is_active == 1 ? '<button class="btn-info">Active</button>' : '<button class="btn-danger">Inactive</button>')  +'</td>'+
                            '<td><a href="general/'+ value.id + '/edit" class="btn btn-primary btn-sm">Edit</a></td>'+
                            '</tr>');
                        @endif
                    });
                }
            });
        }
    </script>

@endpush
