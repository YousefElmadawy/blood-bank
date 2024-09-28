@extends('front.layouts.front')
    @section('body')

        <body class="who-are-us">
    @endsection

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
    <div class="about-us">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Who are us</li>
                    </ol>
                </nav>
            </div> 
            <div class="details">
                <div class="logo">
                    <img src="{{asset('front/imgs/logo-ltr.png')}}">
                </div>
            

                <div class="text">
                    <p>
                      {{$setting->about}}
                    </p>
                    <p>
                        {{$setting->about}}
                     </p>
                    <p>
                        {{$setting->about}}
                     </p>
                </div>
            </div>
        </div>
    </div>
    @endsection
