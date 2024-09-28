@extends('admin.layouts.dashboard')
@section('title')
    Contact Us
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Contacts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Contacts</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-solid">
                <div class="card-body pb-0">
                    <div class="row">
                        @foreach ($contacts as $contact)
                            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch flex-column">
                                <div class="card bg-light d-flex flex-fill">
                                    <div class="card-header text-muted border-bottom-0">
                                      {{ $contact->subject }}
                                    </div>

                                    <div class="card-body pt-0">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="lead"><b>{{ $contact->name }}</b></h2>

                                                <p class="text-muted text-sm"><b>About: </b>{{ $contact->message }}</p>
                                                

                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small">
                                                      <span class="fa-li">
                                                        <i class="fas fa-user"></i>
                                                      </span>
                                                      <b>Email:</b> :
                                                        {{ $contact->email }}
                                                      </li>
                                                        

                                                    <li class="small"><span class="fa-li"><i
                                                                class="fas fa-phone"></i></span> <b>Phone: </b>+
                                                        {{ $contact->phone }}

                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                {{$contacts->withQueryString()->links()}}
                <!-- /.card-footer -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
