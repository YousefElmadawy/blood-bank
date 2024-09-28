@extends('front.layouts.front')
@section('body')

    <body class="donation-requests">
    @endsection
    @section('memberFeatures')
        <li class="nav-item ">

            <a class="nav-link " href="{{ route('client-home') }}">Home </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client-posts') }}">Articles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('client-donations') }}">Donation Requests</a>
        </li>
    @endsection
    @section('member')
        <!--not a member-->
        {{-- <div class="accounts">
                    <a href="{{route('frontLogin')}}" class="signin">sign in</a>
                    <a href="{{route('frontRegister')}}" class="create">Sign up</a>
                </div> 
                 --}}
        <!--I'm a member -->
        <a href="{{ route('client-get-donation') }}" class="donate">
            <img src="{{ asset('front/imgs/transfusion.svg') }}" height=10 width="50">
            <p>Request Donation</p>
        </a>
    @endsection


    @section('content')
        <!--requests-->
        <div class="requests">
            <div class="head-text">
                <h2>Donation requests</h2>
            </div>
            <div class="content">

                <form class="row filter" action="{{ URL::current() }}" method="get">
                    <div class="col-md-5 blood">
                        <div class="form-group">
                            <div class="inside-select">

                                <select class="form-control" id="exampleFormControlSelect1" name="blood_type_id">
                                    <option selected disabled>Choose blood type</option>
                                    @foreach ($bloodTypes as $bloodType)
                                        <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                                    @endforeach

                                </select>

                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 city">
                        <div class="form-group">
                            <div class="inside-select">
                                <select class="form-control" id="exampleFormControlSelect1" name="city_id">
                                    <option selected disabled >Choose city</option>
                                    @foreach ($cites as $city)
                                        <option value="{{ $city->id }}" >{{ $city->name }}</option>
                                    @endforeach
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
                                <h2>{{ $donation->bloodType->name }}</h2>
                            </div>
                            <ul>
                                <li><span>Patoent name:</span>{{ $donation->patient_name }} </li>
                                <li><span>Hospital:</span>{{ $donation->hospital_name }} </li>
                                <li><span>City:</span>{{ $donation->city->name }} </li>
                            </ul>
                            <a href="{{ route('client-donation', $donation->id) }}">Details</a>
                        </div>
                    @endforeach
                </div>
                <div class="pages">
                    {{ $donations->withQueryString()->links() }}
                    {{-- <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link active" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                </div>
            </div>
        </div>
        </div>
        </div>
    @endsection
