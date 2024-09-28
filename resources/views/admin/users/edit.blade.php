@extends('admin.layouts.dashboard')
@section('title')
    Users
@endsection


@section('content')


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Edit Role</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Main content -->
        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div class="card-body"><!-- start of the div -->

                <div class="form-group">
                    <label for="">User Name</label>
                    <input type="text" name="name" value="{{ $user->name }}" @class(['form-control', 'is-invalid' => $errors->has('name')]) 
                        placeholder="Enter User">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">User Email</label>
                    <input type="email" name="email" readonly
                        value="{{ $user->email }}" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name" placeholder="Enter email">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>


                <div class="form-group">
                    <label for="">User Password</label>
                    <input type="password"   name="password" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="name"
                        placeholder="Enter password">

                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">User Role</label>
                    <select class="select2" multiple="multiple" data-placeholder="Select a Role" style="width: 100%;"
                        name="roles[]">

                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div><!-- end of the div -->
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
