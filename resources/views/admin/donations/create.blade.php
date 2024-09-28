@extends('admin.layouts.dashboard')
@section('title')
    Donations
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Donation</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Starter Page</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        {{-- @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Occur Error!!</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    
                </ul>
            </div>
        @endif --}}
        <form method="POST" action="{{ route('donations.store') }}" >
            @csrf

            <div class="card-body"><!-- start of the div -->

                <div class="form-group">
                    <label for="">Patient Name</label>
                    <input type="text" value="{{ old('name') }}" @class(['form-control', 'is-invalid' => $errors->has('patient_name')]) name="patient_name"
                        placeholder="Enter Name">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Patient Age</label>
                    <input type="text" value="{{ old('patient_age') }}" @class(['form-control', 'is-invalid' => $errors->has('patient_age')]) name="patient_age"
                        placeholder="Enter Age">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Patient Phone</label>
                    <input type="text" value="{{ old('patient_phone') }}" @class(['form-control', 'is-invalid' => $errors->has('patient_phone')]) name="patient_phone"
                        placeholder="Enter phone number">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Blood Type</label>
                    <select @class(['form-control', 'is-invalid' => $errors->has('blood_type_id')]) name="blood_type_id" data-placeholder="Select a BloodType">
                        <option value="">Select Blood Type</option>
                        @foreach (App\models\BloodType::all() as $bloodType)
                            <option value="{{ $bloodType->id }}">{{ $bloodType->name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="">City</label>
                    <select  @class(['form-control', 'is-invalid' => $errors->has('city_id')]) name="city_id" data-placeholder="Select a BloodType">
                        <option value="">Select City</option>
                        @foreach (App\models\City::all() as $city)
                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                    </select>

                </div>

                {{-- <div class="form-group">
                    <label for="">Blood Type</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a BloodType"
                        style="width: 100%;" name="tags[]">

                        @foreach ()
                            <option value="{{}}">{{  }}</option>
                        @endforeach

                    </select>
                     
                   
                </div> --}}
                <div class="form-group">
                    <label for="">Hospital Name</label>
                    <input type="text" value="{{ old('hospital_name') }}" @class(['form-control', 'is-invalid' => $errors->has('hospital_name')]) name="hospital_name"
                        placeholder="Enter Hospital Name">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Hospital Address </label>
                    <input type="text" value="{{ old('hospital_adress') }}" @class(['form-control', 'is-invalid' => $errors->has('hospital_adress')]) name="hospital_adress"
                        placeholder="Enter Hospital Address">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude:</label>
                    <input type="text" value="{{ old('latitude') }}" @class(['form-control', 'is-invalid' => $errors->has('latitude')]) id="latitude" name="latitude"  placeholder="Enter Latitude ">
                       
                  
                </div>
                 
                <div class="form-group">
                    <label for="Longitude">Longitude:</label>
                    <input type="text" value="{{ old('Longitude') }}" id="Longitude" @class(['form-control', 'is-invalid' => $errors->has('longitude')]) name="longitude"  placeholder="Enter Longitude ">
                       
                  
                </div>
         
                <div class="form-group">
                    <label for="">Bags Number</label>
                    <input type="text" value="{{ old('bags_num') }}" @class(['form-control', 'is-invalid' => $errors->has('bags_num')]) name="bags_num"
                        placeholder="Enter Bags Number">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Donation Details</label>
                    <textarea  value="{{ old('details') }}" @class(['form-control', 'is-invalid' => $errors->has('details')]) name="details"
                        placeholder="Enter Details " ></textarea>
        
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
             
               
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- end of the div -->
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
