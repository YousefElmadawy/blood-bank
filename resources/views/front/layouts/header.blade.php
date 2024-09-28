<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        
        <!--google fonts css-->
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
        
        <!--font awesome css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link rel="icon" href="{{ asset('front/imgs/Icon.png"') }}">
        
        <!--owl-carousel css-->
        <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('front/assets/css/owl.theme.default.min.css') }}">
 
        <!--style css-->
        <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
        <!--override on style css-->
        <link rel="stylesheet" href="{{ asset('front/assets/css/style-ltr.css') }}">
        
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/fonts/materialdesignicons.css') }}"/>

        <!-- Menu waves for no-customizer fix -->
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/libs/node-waves/node-waves.css') }}" />
    
        <!-- Core CSS -->
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/css/core.css" class="template-customizer-core-css') }}" />
        <link rel="stylesheet" href="{{ asset('front/assets/vendor/css/theme-default.css" class="template-customizer-theme-css') }}" />
        <link rel="stylesheet" href="{{ asset('front/assets/css/demo.css') }}" />
    
        <!-- Vendors CSS -->
        <link rel="stylesheet" href=".{{ asset('front/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    
        <!-- Page CSS -->
    
        <!-- Helpers -->
        {{-- <script src="{{ asset('front/assets/vendor/js/helpers.js') }}"></script> --}}
        <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
        <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
        {{-- <script src="{{ asset('front/assets/js/config.js') }}"></script> --}}
        <title>Blood Bank</title>
    </head>
    @yield('body')
  