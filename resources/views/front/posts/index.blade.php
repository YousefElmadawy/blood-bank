@extends('front.layouts.front')
 
@section('memberFeatures')
    <li class="nav-item">

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
                                    <a href="{{ route('client-post', $post->id) }}" class="click">more</a>
                                </div>
                                
                                <a  onclick="toggleFavorite(this)" class="favourite">
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
@endsection
