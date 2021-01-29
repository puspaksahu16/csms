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
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session()->get('error') }}
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
                                    <li class="breadcrumb-item"><a href="#">Installment</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Installment List</a>
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
                                <h4 class="card-title">Installment</h4>
                            </div>
                            <div class="card-content">
                                <div class="table-responsive">
                                    <table class="table table-striped mb-0 zero-configuration" id="">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Installment Fee</th>
                                            <th scope="col">Fine</th>
                                            <th scope="col">Pre Due</th>
                                            <th scope="col">Payable Amount</th>
                                            <th scope="col">Paid</th>
                                            <th scope="col">Payment Type</th>
                                            <th scope="col">Paid Date</th>
                                            <th scope="col">Due Date</th>
                                            <th scope="col">Status</th>
                                            @if(auth()->user()->role->name !== "parent")
                                                <th scope="col">Action</th>
                                            @endif
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($installments as $key  => $i)
                                            <tr>
                                                <th scope="row">{{$key+1}}</th>
                                                <td>{{$i->students->first_name." ".$i->students->last_name}}</td>
                                                <td>{{$i->installment_fee - $i->fine - $i->due}}</td>
                                                <td>{{$i->fine}}</td>
                                                <td>{{$i->due}}</td>
                                                <td>{{$i->installment_fee}}</td>
                                                <td>{{$i->paid}}</td>
                                                <td>{{!empty($i->payment) ? ($i->payment->type == 1 ? "Cash" : "Online") : "--"}}</td>
                                                <td>
                                                    @if($i->payment == null)
                                                        --
                                                    @else
                                                        {{date('j M, Y' , strtotime($i->payment->created_at))}}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($i->due_date == null)
                                                        --
                                                    @else
                                                        {{date('j M, Y' , strtotime($i->due_date))}}
                                                    @endif

                                                </td>
                                                <td>{{$i->status}}</td>
                                                @if(auth()->user()->role->name !== "parent")
                                                    <td>
                                                        @if($i->status == "Pending")
                                                            <a href="{{url('/pay/'.$i->id)}}" class="btn btn-sm btn-primary">Pay</a>

                                                            {{--Trigger the modal with a button--}}
                                                            <button type="button" {{ $i->status == "Paid" ? 'disable':'' }} class="btn btn-sm btn-warning" data-toggle="modal" data-target="#myModal{{ $i->id }}">Fine</button>

                                                            {{--Modal--}}
                                                            <div class="modal fade" id="myModal{{ $i->id }}" role="dialog">
                                                                <div class="modal-dialog">

                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Add Fine</h4>
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ url('/admission_fee_fine/'.$i->id) }}" method="POST">
                                                                                @csrf
                                                                                <input class="form-control" name="fine" placeholder="Fine">
                                                                                <br>
                                                                                <button type="submit" class="btn btn-success">Submit</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        @elseif($i->status == "Paid")

                                                            {{--Trigger the modal with a button--}}
                                                            @if(!$loop->last)
                                                                <div class="btn-group">
                                                                    <button title="Next Due date" type="button" class="btn btn-sm btn-outline-warning" data-toggle="modal" data-target="#myModal{{ $i->id }}"><i class="fa fa-calendar"></i></button>
                                                                    <a target="_blank" href="{{url('/receive',$i->payment_id)}}" title="Receipt" class="btn btn-sm btn-outline-primary"><i class="fa fa-list-ul"></i></a>
                                                                </div>
                                                            @endif

                                                            {{--Modal--}}
                                                            <div class="modal fade" id="myModal{{ $i->id }}" role="dialog">
                                                                <div class="modal-dialog">

                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Next Due Date</h4>
                                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <form action="{{ url('/admission_due_date/'.$i->id) }}" method="POST">
                                                                                @csrf
                                                                                <input class="form-control" name="due_date" placeholder="Due Date"type="date" >
                                                                                <br>
                                                                                <button type="submit" class="btn btn-success">Submit</button>
                                                                            </form>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>



                                                        @endif


                                                        {{--<a href="{{url('/admission_fee_fine/'.$i->id)}}" class="btn btn-sm btn-warning">Fine</a>--}}
                                                    </td>
                                                @endif

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
