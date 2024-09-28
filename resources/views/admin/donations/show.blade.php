@extends('admin.layouts.dashboard')
@section('title')
    Donations
@endsection
@section('content')
  
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Donation Detail</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Donation Detail</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
  
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Patient Data</h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
              
                <div class="row">
                  <div class="col-12">
                    <h4>{{$donationRequest->patient_name}}</h4>
                      <div class="post">
                      
                        <p>
                        {{$donationRequest->details}}
                        </p>
  
                        <p>
                          
                        </p>
                      </div>
  
                      <div class="post clearfix">
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-cart-plus"></i></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Bags num</span>
                                        <span class="info-box-number">   {{$donationRequest->bags_num}}  </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Blood Type</span>
                                        <span class="info-box-number">  {{$donationRequest->bloodType->name}} </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
        
                            <div class="col-md-3 col-md-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gradient-gray"><i class="fas fa-mail-bulk"></i></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Phone</span>
                                        <span class="info-box-number">{{$donationRequest->patient_phone}}  </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
        
                        </div>
                        
  
                      <div class="post clearfix">
                        <div class="row">
                            <div class="col-md-3 col-md-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-info"><i class="fas fa-clinic-medical"></i></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Hospital Name</span>
                                        <span class="info-box-number">   {{$donationRequest->hospital_name}} </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-md-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fas fa-map-marker"></i> </span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Hospital Address</span>
                                        <span class="info-box-number"> {{$donationRequest->hospital_adress}} </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
        
                            {{-- <div class="col-md-3 col-md-6 col-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-gradient-gray"><i class="fas fa-mail-bulk"></i></span>
        
                                    <div class="info-box-content">
                                        <span class="info-box-text">Phone</span>
                                        <span class="info-box-number">{{$donationRequest->patient_phone}}  </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div> --}}
        
                        </div>
                        
                        
                        
                      
  
                       
                  
                </div>
              </div>
             
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>

@endsection