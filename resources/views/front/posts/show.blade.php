@extends('front.layouts.front')
@section('body')

    <body class="article-details">
    @endsection
    @section('memberFeatures')
        <li class="nav-item  ">

            <a class="nav-link" href="{{ route('client-home') }}">Home </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client-posts') }}">Articles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client-donations') }}">Donation requests</a>
        </li>
    @endsection
    @section('content')
        <!--inside-article-->
        <div class="inside-article">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page"><a href="#">Articles</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
                        </ol>
                    </nav>
                </div>
                <div class="article-image">
                    <img src="{{ asset('storage/' . $post->image) }}" width="500" height="500">
                </div>

                <div class="article-title col-12">
                    <div class="h-text col-6">
                        <h4> {{ $post->content }} </h4>
                    </div>

                    <div class="icon col-6">
                        <button type="button"><i class="far fa-heart"></i></button>
                    </div>
                </div>

                <!--text-->
                <div class="text">
                    <h3>
                        {{ $post->content }}
                    </h3>
                    <br>
                    <p>
                        {{ $post->content }}
                    </p>
                    <br>
                </div>


            </div>
        </div>
    @endsection
