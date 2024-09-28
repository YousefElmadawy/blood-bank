@extends('front.layouts.front')
    @section('body')

        <body class="contact-us">
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
    <div class="contact-now">
        <div class="container">
            <div class="path">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index-1.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact us</li>
                    </ol>
                </nav>
            </div>
            <div class="row methods">
                <div class="col-md-6">
                    <div class="call">
                        <div class="title">
                            <h4>Contact us</h4>
                        </div>
                        <div class="content">
                            <div class="logo">
                                <img src="{{ asset('front/imgs/logo-ltr.png')}}">
                            </div>
                            <div class="details">
                                <ul>
                                    <li><span>Telephone nomber:</span> 124123412312</li>
                                    <li><span>Fax:</span> 234234234</li>
                                    <li><span>E-mail:</span> name@name.com</li>
                                </ul>
                            </div>
                            <div class="social">
                                <h4>Contact us</h4>
                             
                                <div class="icons" dir="ltr">
                                    <div class="out-icon">
                                        <a href="{{$setting->fb_link}}"><img src=" {{ asset('front/imgs/001-facebook.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$setting->tw_link}}"><img src=" {{ asset('front/imgs/002-twitter.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="#"><img src=" {{ asset('front/imgs/003-youtube.svg') }}"></a>
                                    </div>
                                    <div class="out-icon">
                                        <a href="{{$setting->insta_link}}"><img src=" {{ asset('front/imgs/004-instagram.svg') }}"></a>
                                    </div>
                               
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <div class="title">
                            <h4>Connect with us</h4>
                        </div>
                        <div class="fields">
                            <form method="post" action="{{ route('addContact') }}">
                                @csrf
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Name" name="name">
                                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail" name="email">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Telephone number" name="phone">
                                <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Message title" name="subject">
                                <textarea placeholder="Text message" class="form-control" id="exampleFormControlTextarea1" rows="3" name="message"></textarea>
                                <button type="submit">Send</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @endsection