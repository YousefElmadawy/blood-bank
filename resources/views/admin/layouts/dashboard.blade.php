@include('admin.layouts.header')

<!-- Site wrapper -->

  <!-- /.navbar -->
  @include('admin.layouts.navbar')
  <!-- Main Sidebar Container -->
  @include('admin.layouts.sidebar')
  <!-- Content Wrapper. Contains page content -->
  @yield('content')
  <!-- /.content-wrapper -->
@include('admin.layouts.footer')