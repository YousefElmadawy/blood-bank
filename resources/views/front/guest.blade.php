@extends('front.layouts.front')
@section('memberFeatures')
    <li class="nav-item active">

        <a class="nav-link" href="{{ route('guest') }}">home </a>
    </li>
@endsection
@section('member')
    <!--not a member-->
    @guest('client-web')
        <div class="accounts">
            <a href="{{ route('getLogin') }}" class="signin">sign in</a>

        </div>

        <div class="accounts">
            <a href="{{ route('get_Register') }}" class="create">Sign up</a>

        </div>
    @endguest
 

    <!--I'm a member -->
    {{-- <a href="#" class="donate">
                    <img src="{{ asset('front/imgs/transfusion.svg')}}" height=10 width="50" >
                    <p>Request Donation</p>
                </a> --}}
@endsection
@section('content')
    <!--intro-->
    <div class="intro">
        <div id="slider" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#slider" data-slide-to="0" class="active"></li>
                <li data-target="#slider" data-slide-to="1"></li>
                <li data-target="#slider" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item carousel-1 active">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>Blood bank moving forward to better health</h3>
                            <p>
                                There is a proven fact from a long time ago that the readable content of a page will not
                                distract the reader from focusing on the.
                            </p>
                            <a href="#">more</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-2">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>Blood bank moving forward to better health</h3>
                            <p>
                                There is a proven fact from a long time ago that the readable content of a page will not
                                distract the reader from focusing on the.
                            </p>
                            <a href="#">more</a>
                        </div>
                    </div>
                </div>
                <div class="carousel-item carousel-3">
                    <div class="container info">
                        <div class="col-lg-5">
                            <h3>Blood bank moving forward to better health</h3>
                            <p>
                                There is a proven fact from a long time ago that the readable content of a page will not
                                distract the reader from focusing on the.
                            </p>
                            <a href="#">more</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--about-->
    <div class="about">
        <div class="container">
            <div class="col-lg-6 text-center">
                <p>
                    <span>Blood Bank</span> There is a proven fact from a long time ago that the readable content of a page
                    will not distract the reader from focusing on the external appearance of the text or the form of the
                    paragraphs placed on the page he reads.
                </p>
            </div>
        </div>
    </div>

    <!--articles-->
    <div class="articles">
        <div class="container title">
            <div class="head-text">
                <h2>Articles</h2>
            </div>
        </div>
        <div class="view">
            <div class="container">
                <div class="row">
                    <!-- Set up your HTML -->
                    <div class="owl-carousel articles-carousel">
                        @foreach ($posts as $post)
                            <div class="card">
                                <div class="photo">
                                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="...">
                                    <a href="{{ route('getLogin') }}" class="click">more</a>
                                </div>
                                <a href="{{ route('getLogin') }}" class="favourite">
                                    <i class="far fa-heart"></i>
                                </a>

                                <div class="card-body">
                                    <h5 class="card-title">{{ $post->title }}</h5>
                                    <p class="card-text">
                                        {{ $post->content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--requests-->
    <div class="requests">
        <div class="container">
            <div class="head-text">
                <h2>Donation requests</h2>
            </div>
        </div>
        <div class="content">
            <div class="container">
                <form class="row filter">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>Choose blood type</option>
                                    <option>A+</option>
                                    <option>B+</option>
                                    <option>AB+</option>
                                    <option>O-</option>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option selected disabled>Choose city</option>
                                    <option>Mansoura</option>
                                    <option>Cairo</option>
                                    <option>Alexandria</option>
                                    <option>Sohag</option>
                                </select>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1 search">
                        <button type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <div class="patients">
                    @foreach ($donations as $donation)
                        <div class="details">
                            <div class="blood-type">
                                <h2 dir="ltr">O-</h2>
                            </div>
                            <ul>
                                <li><span>Patient name:</span> {{ $donation->patient_name }}</li>
                                <li><span>Hospital:</span> {{ $donation->hospital_name }}</li>
                                <li><span>City:</span> {{ $donation->city->name }}</li>
                            </ul>
                            <a href="inside-request-ltr.html">Details</a>
                        </div>
                    @endforeach
                </div>
                <div class="more">
                    <a href="donation-requests-ltr.html">More</a>
                </div>
            </div>
        </div>
    </div>

    <!--contact-->
    <div class="contact">
        <div class="container">
            <div class="col-md-7">
                <div class="title">
                    <h3>Contact us</h3>
                </div>
                <p class="text">You can contact us to inquire about information and you will be answered</p>
                <div class="row whatsapp">
                    <a href="#">
                        <img src="{{ asset('front/imgs/whats.png') }}">
                        <p dir="ltr">+002 1215454551</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--app-->
    <div class="app">
        <div class="container">
            <div class="row">
                <div class="info col-md-6">
                    <h3>Blood bank app</h3>
                    <p>
                        This text is an example of text that can be replaced in the same space. This text was generated
                        from.
                    </p>
                    <div class="download">
                        <h4>Available on</h4>
                        <div class="row stores">
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{ asset('front/imgs/google.png') }}">
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="#">
                                    <img src="{{ asset('front/imgs/ios.png') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="screens col-md-6">
                    <img src="{{ asset('front/imgs/App.png') }}">
                </div>
            </div>
        </div>
    </div>
@endsection
