@if ((Session::has('user_name')))
    {!! redirect()->to('/dashboard') !!}
@else
@extends('app.layout')

@section('content')
<div class="container">
    <div class="row vh-100 ">
        <div class="col-12 align-self-center">
            <div class="auth-page">
                <div class="card auth-card shadow-lg">
                    <div class="card-body p-0">
                        <div class="text-center" style="color:red;width:100%"> </div>
                        <div class="col-lg-12">
                            <div class="row" style="box-shadow: 0.5px 0.1rem 0.5rem rgba(252, 212, 212, 0.5);">
                                <div class="col-lg-12 pt-3 text-center p-3"> <em> Welcome to Proplogix Lien Search </em>
                                </div>
                                <div class="col-lg-12 mt-4 pt-5 p-3">
                                    <div class="card">
                                        <div class="card-body p-0 auth-header-box">
                                            <div class="text-center p-3">
                                                <p class="text-muted mt-2 pt-2 mb-0"> Sign in to continue </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="auth-logo-box p-2 pt-2 pb-2">
                                        <a href="login.php" class="logo logo-admin"><img src="{{asset('assets/images/logo.png')}}"
                                                width="85%" height="auto" alt="logo" style="border-radius:5px;"
                                                class="auth-logo"></a>
                                    </div>
                                    @if (Session::has("failed"))
                                    <p class="text-center" style="color:red">{{Session::get('failed')}}</p>
                                    @endif
                                    <form class="form-horizontal auth-form" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="username"><strong>Username</strong></label>
                                            <div class="input-group mb-1">
                                                <span class="auth-form-icon mt-2 pr-1">
                                                    <i class="dripicons-user"></i>
                                                </span>
                                                <input type="text" class="form-control" name="userName" id="userName"
                                                    placeholder="Enter username" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="userpassword"><strong>Password</strong></label>
                                            <div class="input-group mb-1">
                                                <span class="auth-form-icon mt-2 pr-1">
                                                    <i class="dripicons-lock"></i>
                                                </span>
                                                <input type="password" class="form-control" name="password"
                                                    id="password" placeholder="Enter password" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-0 row">
                                            <div class="col-12 mt-2">
                                                <button
                                                    style="background-color: #41B680 !important;border-color: #41B680 !important;"
                                                    class="btn btn-gradient-success btn-round btn-block waves-effect waves-light"
                                                    type="submit">Log In <i
                                                        class="fas fa-sign-in-alt ml-1"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif
