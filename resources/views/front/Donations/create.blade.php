@extends('front.layouts.front')
@section('body')

    <body class="create">
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
        <div class="requests">
            <div class="head-text">
                <h2>Add Donation Reqest</h2>
            </div>
            <div class="content">
                <div class="card-body">
                    <div class="container">
                        <div class="card-body">
                            <form method="POST" action="{{ route('client-add-donation') }}">
                                @csrf
                                {{-- @dd($governorates) --}}
                                {{-- @dd($governorates->cities)  --}}
                                <div class="form-group">
                                    <input type="text" value="{{ old('name') }}" @class(['form-control', 'is-invalid' => $errors->has('patient_name')])
                                        name="patient_name" placeholder="Enter Name">
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" value="{{ old('patient_age') }}" @class(['form-control', 'is-invalid' => $errors->has('patient_age')]) name="patient_age"
                                    placeholder="Enter Age">
                                </div>

                                <div class="form-group">
                                    <input type="text" value="{{ old('patient_phone') }}" @class([
                                        'form-control',
                                        'is-invalid' => $errors->has('patient_phone'),
                                    ])
                                        name="patient_phone" placeholder="Enter phone number">
                                </div>
                             
                                <div class="form-group">
                                    <input class="form-control" placeholder="Birth date" name="date_of_birth	"
                                        type="text" onfocus="(this.type='date')" id="date">
                                </div>
                                <div class="form-group">
                                    <select @class([
                                        'form-control',
                                        'is-invalid' => $errors->has('blood_type_id'),
                                    ]) name="blood_type_id"
                                        data-placeholder="Select a BloodType">
                                        <option value="">Select Blood Type</option>
                                        @foreach (App\models\BloodType::all() as $bloodType)
                                            <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <select @class(['form-control', 'is-invalid' => $errors->has('city_id')]) name="city_id"
                                        data-placeholder="Select a BloodType">
                                        <option value="">Select City</option>
                                        @foreach (App\models\City::all() as $city)
                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">

                                    <input type="text" value="{{ old('hospital_name') }}" @class([
                                        'form-control',
                                        'is-invalid' => $errors->has('hospital_name'),
                                    ])
                                        name="hospital_name" placeholder="Enter Hospital Name">
                                </div>
                                <div class="form-group">

                                    <input type="text" value="{{ old('hospital_adress') }}" @class([
                                        'form-control',
                                        'is-invalid' => $errors->has('hospital_adress'),
                                    ])
                                        name="hospital_adress" placeholder="Enter Hospital Address">
                                </div>

                                <div class="form-group">
                                    <input type="text" value="{{ old('Longitude') }}" id="Longitude"
                                        @class(['form-control', 'is-invalid' => $errors->has('longitude')]) name="longitude" placeholder="Enter Longitude ">
                                </div>
                                <div class="form-group">
                                    <input type="text" value="{{ old('latitude') }}" @class(['form-control', 'is-invalid' => $errors->has('latitude')])
                                        id="latitude" name="latitude" placeholder="Enter Latitude ">
                                </div>

                                <div class="form-group">
                                    <input type="text" value="{{ old('bags_num') }}" @class(['form-control', 'is-invalid' => $errors->has('bags_num')])
                                        name="bags_num" placeholder="Enter Bags Number">
                                </div>
                                <div class="form-group">
                                    <textarea value="{{ old('details') }}" @class(['form-control', 'is-invalid' => $errors->has('details')]) name="details" placeholder="Enter Details "></textarea>
                                </div>


                                <div class="form-group">
                                    <input class="form-control btn btn-success" type="submit" value="Creat Donation">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
