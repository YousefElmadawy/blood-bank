@extends('admin.layouts.dashboard')
@section('title')
    Governorates
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Governorate</h1>
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
        @if ($errors->any())
            <div class="alert alert-danger">
                <h3>Occur Error!!</h3>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                    
                </ul>
            </div>
        @endif
        <form method="POST" action="{{ route('governorates.store') }}" >
            @csrf

            <div class="card-body"><!-- start of the div -->

                <div class="form-group">
                    <label for="">Governorate Name</label>
                    <input type="text" value="{{ old('name') }}" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name"
                        placeholder="Enter Governorate">
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
