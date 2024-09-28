@extends('front.layouts.front')
@section('body')

    <body class="create">
    @endsection
     
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
        <!--form-->
        <div class="card-body">
            <div class="container">
                <div class="path">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-ltr.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">create new account</li>
                        </ol>
                    </nav>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('client-register') }}">
                        @csrf
            
                        <div class="form-group">
                            <input class="form-control" name="name" type="text" id="name"
                                aria-describedby="emailHelp" placeholder="Name">
                        </div>

                        <div class="form-group">
                            <input class="form-control" name="email" type="email" id="email"
                                aria-describedby="emailHelp" placeholder="E-mail">
                        </div>
                        <div class="form-group">
                            <input class="form-control" placeholder="Birth date" name="date_of_birth" type="text"
                                onfocus="(this.type='date')" id="date">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="blood_type" id="blood_type_id">
                                <option selected disabled>Blood type</option>
                                @foreach ($bloodTypes as $bloodType)
                                    <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                                @endforeach

                            </select>

                        </div>


                        <div class="form-group">
                            {{-- 
                        @inject('governorate','App\Models\Governorate' )

                        {!! Form::select('governorate_id', $governorate->pluck('name','id')->toArray(), null , 
                                ['class' =>"form-control",
                                  'id'=>"governorate_id",
                                  'placeholder'=> 'Select Governorate'
                               ])
                        !!} --}}

                            <select class="form-control" name="governorate" id="governorate_id">
                                <option selected disabled>Governorate</option>
                                @foreach ($governorates as $governorate)
                                    <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                                @endforeach

                            </select>
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="city" id="city_id">
                                <option selected disabled>City</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="phone" type="tel" class="form-control"
                                id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Telephone number">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="last_donation_date" id="last_donation_date"
                                placeholder="Last date for donation" class="form-control" type="text"
                                onfocus="(this.type='date')" id="date">
                        </div>
                        <div class="form-group">
                            <input class="form-control" name="password" id="password" type="password"
                                placeholder="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <input class="form-control" name="password_confirmation" id="password-confirm" type="password"
                                placeholder="confirm password" required autocomplete="new-password">
                        </div>
                        <div class="form-group">
                            <input class="form-control btn btn-success" type="submit" value="Creat ">
                        </div>
                    </form>
                </div>
            </div>
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
