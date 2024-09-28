@extends('admin.layouts.dashboard')
@section('title')
    Governorates
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Governorates</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Governorates</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                        <div class="col-md-3 ">
                            <a href="{{ route('governorates.create') }}">
                                <button type="submit" class="btn btn-primary btn-block">Add Governorate</button>
                            </a>
                            <hr>
                           
                        </div>
                        <hr>


                        <!-- search form -->
                        {{-- <form action="{{ URL::current() }}" method="get" class="d-flex justify-content-between mb-4">
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 590px;">
                                    <input type="text" name="name" class="form-control float-right mx-2 "
                                        placeholder="Name" value="">


                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default">
                                            Filter <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form> --}}
                        <!-- end search form -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Governorate Name</th>
                    
                                    <th>created at</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
<?php $i=0 ?>
                                @foreach ($governorates as $governorate)
                                <?php $i++?>
                                    <tr>
                                        

                                        <td>{{ $i }}</td>
                                        <td>{{ $governorate->name }} </td>
                                        <td>{{ $governorate->created_at }}</td>

                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-primary">Actions</button>
                                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon"
                                                    data-toggle="dropdown">
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu" role="menu">
                                                    <a class="dropdown-item"
                                                        href="{{ route('governorates.edit', $governorate->id) }}"><i
                                                            class="fas fa-edit"></i>
                                                        Edit</a>
                                                    <form action="{{ route('governorates.destroy', $governorate->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="dropdown-item"><i
                                                                class="fas fa-trash"></i> Delete</a>
                                                    </form>
                                                </div>
                                            </div>

                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    {{-- {{$categories->withQueryString()->links()}} --}}
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
