
@extends('admin.layouts.registermaster')
@section('content')
<!-- BEGIN: Content-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body"><section class="row flexbox-container">
                <div class="col-xl-8 col-10 d-flex justify-content-center">
                    <div class="card bg-authentication rounded-0 mb-0">
                        <div class="row m-0">
                            <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                                <img src="{{asset('admin_assets/images/pages/register.jpg')}}" alt="branding logo">
                            </div>
                            <div class="col-lg-6 col-12 p-0">
                                <div class="card rounded-0 mb-0 p-2">
                                    <div class="card-header pt-50 pb-1">
                                        <div class="card-title">
                                            <h4 class="mb-0">{{ __('Register') }}
                                            </h4>
                                        </div>
                                    </div>
                                    <p class="px-2">Fill the below form to create a new account.</p>
                                    <div class="card-content">
                                        <div class="card-body pt-0">
                                            <form method="POST" action="{{ route('register') }}">
                                                @csrf
                                                <div class="form-label-group">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                    <label for="inputName">{{ __('Name') }}</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                    <label for="inputEmail">{{ __('E-Mail Address') }}</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                    <label for="inputPassword">{{ __('Password') }}</label>
                                                </div>
                                                <div class="form-label-group">
                                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                    <label for="inputConfPassword">{{ __('Confirm Password') }}</label>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-12">
                                                        <fieldset class="checkbox">
                                                            <div class="vs-checkbox-con vs-checkbox-primary">
                                                                <input type="checkbox" checked>
                                                                <span class="vs-checkbox">
                                                  <span class="vs-checkbox--check">
                                                    <i class="vs-icon feather icon-check"></i>
                                                  </span>
                                                </span>
                                                                <span class=""> I accept the terms & conditions.</span>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                                <a href="{{route('login')}}" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                                                <button type="submit" class="btn btn-primary float-right btn-inline mb-50">{{ __('Register') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>
<!-- END: Content-->
    @endsection
