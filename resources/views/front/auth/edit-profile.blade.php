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
    <div class="card mb-4">
        <h4 class="card-header">Profile Details</h4>
        <!-- Account -->
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">


            </div>
        </div>
        <div class="card-body">
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
            <form method="POST" action="{{ route('client-profile') }}">
@csrf
                <div class="form-group">

                    <label for="firstName"> Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{$client->name}}"
                        placeholder="Name" />
                </div>

                <div class="form-group">

                    <label for="email">E-mail</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{$client->email}}"
                        placeholder="Email" />
                </div>

                <div class="form-group">

                    <label for="phoneNumber">Phone Number</label>
                    <input type="text" id="phoneNumber" name="phone" class="form-control" value="{{$client->phone}}"
                        placeholder="Phone Number" />

                </div>

                <div class="form-group">
                    <select class="form-control" name="blood_type" id="blood_type_id">
                        <option value="{{$client->bloodType->id }}">{{$client->bloodType->name }}</option>
                        @foreach ($bloodTypes as $bloodType)
                            <option value="{{$bloodType->id }}">{{ $bloodType->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">
                    <select class="form-control" name="governorate" id="governorate_id">
                        <option value="{{$client->city->governorate->id }}">{{$client->city->governorate->name }}</option>
                        @foreach ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                        @endforeach

                    </select>
                </div>
                <div class="form-group">

                    <select class="form-control" name="city" id="city_id">
                       <option value="{{$client->city->id }}">{{$client->city->name }}</option>
                    </select>
                </div>

                <div class="form-group">
                    <input class="form-control" placeholder="Birth date" name="date_of_birth" type="text" value="{{$client->date_of_birth}}"
                        onfocus="(this.type='date')" id="date">
                </div>
                <div class="form-group">
                    <input class="form-control" name="last_donation_date" id="last_donation_date" value="{{$client->last_donation_date}}"
                        placeholder="Last date for donation" class="form-control" type="text"
                        onfocus="(this.type='date')" id="date">
                </div>

                <div class="form-group">
                    <input class="form-control" name="password" id="password" type="password" value="{{$client->password}}"
                        placeholder="password" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <input class="form-control" name="password_confirmation" id="password-confirm" type="password" value="{{$client->password}}"
                        placeholder="confirm password" required autocomplete="new-password">
                </div>

                <div class="form-group">

                    <button type="submit" class="btn btn-primary me-2">Save changes</button>

                </div>
            </form>
        </div>
        <!-- /Account -->
    </div>
@endsection
  @push('js')
        <script>
            $(document).ready(function() {
                $('select[name="governorate"]').on('change', function() {
                    var governorate_id = $(this).val();
                    if (governorate_id) {

                        $.ajax({
                            url: "{{ URL::to('/governorates') }}/" + governorate_id,
                            type: "GET",
                            dataType: "json",
                            success: function(data) {
                                $('select[name="city"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="city"]').append('<option value="' +
                                        value + '">' + value + '</option>');
                                });
                            },
                        });

                    } else {
                        console.log('AJAX load did not work');
                    }
                });

            });
        </script>
    @endpush