@extends('admin.layouts.master')
@section('content')
    <div class="app-content content">
      <div class="content-overlay"></div>
      <div class="header-navbar-shadow"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h2 class="content-header-title float-left mb-0">General Setting</h2>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('\dashboard')}}">Home</a>
                    </li>
                    <li class="breadcrumb-item"><a href="#">Create City</a>
                    </li>
                    
                  </ol>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <div class="content-body"><!-- Basic Horizontal form layout section start -->




<!-- // Basic multiple Column Form section start -->
<section id="multiple-column-form">
    <div class="row match-height">
    	
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">City Setting</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form">
                            <div class="form-body">
                            	
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="first-name-column" class="form-control" placeholder="Create New City" name="create_class">
                                            <label for="first-name-column">Create City</label>
                                        </div>
                                    </div>
                                    
                                   
                                   
                                    

                                     
                                   
<div class="col-6">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">Submit</button>
                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Reset</button>
                                    </div>  
                                   
                                </div>
                                 
                                
                  
                        
                    </div>
                </form>
                </div>
            </div>
        </div>


         


        

       


    </div>
</section>
<!-- // Basic Floating Label Form section end -->


        </div>
      </div>
    </div>

@endsection
