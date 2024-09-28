@extends('front.layouts.front')
 
@section('member')
    <!--not a member-->
    <div class="accounts">
        <a href="{{ route('getLogin') }}" class="signin">sign in</a>
        <a href="{{ route('getRegister') }}" class="create">Sign up</a>
    </div>

    <!--I'm a member -->
    {{-- <a href="#" class="donate">
                    <img src="{{ asset('front/imgs/transfusion.svg')}}" height=10 width="50" >
                    <p>Request Donation</p>
                </a> --}}
@endsection
@section('content')
    <div class="card-body">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Sign in</li>
                    </ol>
                </nav>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h3>Occur Error!!</h3>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
            @if (session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            <div class="card-body">
                <form method="POST" action="{{ route('client-login') }}">
                    @csrf

                    <div class="form-group mb-1">
                        <img src={{ asset('front/imgs/logo-ltr.png') }}>
                    </div>

                    <div class="form-group"> 
                        <input type="text" value="{{ old('phone') }}" @class(['form-control', 'is-invalid' => $errors->has('phone')]) name="phone" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp" placeholder="Telephone number">
                    </div>
                    <div class="form-group">
                        <input type="password" @class(['form-control', 'is-invalid' => $errors->has('password')]) name="password" class="form-control" id="exampleInputPassword1"
                            placeholder=" Password">
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-success btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>


                </form>

                <p class="mb-0">
                    <a href="register.html" class="text-center">Register a new membership</a>
                </p>
                <p class="mb-0">
                    <a href="{{route('client-getForget-password')}}" class="text-center">Reset a new password</a>
                </p>

            </div>
        </div>
    </div>
@endsection
