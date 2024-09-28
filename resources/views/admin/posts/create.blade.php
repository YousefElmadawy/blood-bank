@extends('admin.layouts.dashboard')
@section('title')
    Posts
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add New Post</h1>
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
        
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" >
            @csrf

            <div class="card-body"><!-- start of the div -->

                <div class="form-group">
                    <label for="">Post Name</label>
                    <input type="text" value="{{ old('name') }}" @class(['form-control', 'is-invalid' => $errors->has('name')]) name="title"
                        placeholder="Enter Post">
                    @error('name')
                        <div class="text text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="">Post Category</label>
                    <select class="form-control form-select" name="category_id">
                        <option value="">Primary Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="form-group">
                    <label for="">Post Content</label>
                    <textarea class="form-control" name="content"> {{ old('content') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Post Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
              

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div><!-- end of the div -->
        </form>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
