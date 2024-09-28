@extends('front.layouts.front')


@section('memberFeatures')
    <li class="nav-item ">

        <a class="nav-link" href="{{ route('client-home') }}">Home </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('client-posts') }}">Articles</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('client-donations') }}">Donation Requests</a>
    </li>
@endsection
@section('member')
    @guest('client-web')
        <div class="accounts">
            <a href="{{ route('getLogin') }}" class="signin">sign in</a>

        </div>

        <div class="accounts">
            <a href="{{ route('getRegister') }}" class="create">Sign up</a>

        </div>
    @endguest
    @auth('client-web')
        <a href="{{ route('client-get-donation') }}" class="donate">
            <img src="{{ asset('front/imgs/transfusion.svg') }}" height=10 width="50">
            <p>Request Donation</p>
        </a>
    @endauth
@endsection
@section('content')
    <div class="login-box">

        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
        <div class="card-body">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Reset Password</li>
                        </ol>
                    </nav>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

                    <form action="{{ route('client-reset-password') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <input type="tel" class="form-control" placeholder="Phone Number" name="phone">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <a href="login.html">Login</a>
                    </p>
                    <p class="mb-0">
                        <a href="register.html" class="text-center">Register a new membership</a>
                    </p>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
@endsection
