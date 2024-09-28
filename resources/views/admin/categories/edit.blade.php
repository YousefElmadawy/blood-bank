@extends('admin.layouts.dashboard')
@section('title')
Category
@endsection


@section('content')
 
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Category</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active"> Edit Category</li>
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
        <form method="POST" action="{{ route('categories.update', $category->id) }}">
            @csrf
            @method('PATCH')

            <div class="card-body"><!-- start of the div -->

                <div class="form-group">
                    <label for="">Category Name</label>
                    <input type="text" class="form-control" value="{{ old('name', $category->name) }}" name="name"
                        placeholder="Enter governorate">
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Upadate</button>
                </div>
            </div><!-- end of the div -->
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
