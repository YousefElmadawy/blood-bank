@extends('admin.layouts.dashboard')
@section('title')
    settings
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Setting</h1>
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
        <form method="POST" action="{{ route('settings.store') }}" >
            @csrf

            <div class="card-body"><!-- start of the div -->

                <div class="form-group">
                    <label for="">Notification Setting Text</label>
                    <input type="text" value="{{ old('notification_setting_text') }}" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="notification_setting_text"
                        placeholder="Enter Text">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
              
               
            
                <div class="form-group">
                    <label for=""> Email</label>
                    <input type="text" value="{{ old('email') }}" @class(['form-control', 'is-invalid' => $errors->has('email')]) name="email"
                        placeholder="Enter email">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for=""> Phone</label>
                    <input type="text" value="{{ old('phone') }}" @class(['form-control', 'is-invalid' => $errors->has('phone')]) name="phone"
                        placeholder="Enter phone number">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> About</label>
                    <input type="text" value="{{ old('about') }}" @class(['form-control', 'is-invalid' => $errors->has('about')]) name="about"
                        placeholder="Enter about">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="">Facebook link</label>
                    <input type="text" value="{{ old('fb_link') }}" @class(['form-control', 'is-invalid' => $errors->has('fb_link')]) name="fb_link"
                        placeholder="Enter fb_link">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Twiter link</label>
                    <input type="text" value="{{ old('tw_link') }}" @class(['form-control', 'is-invalid' => $errors->has('tw_link')]) name="tw_link"
                        placeholder="Enter tw_link">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for=""> Instagram link   </label>
                    <input type="text" value="{{ old(' insta_link') }}" @class(['form-control', 'is-invalid' => $errors->has(' insta_link')]) name=" insta_link"
                        placeholder="Enter insta_link">
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
