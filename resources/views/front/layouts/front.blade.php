@include('front.layouts.header')


        <!--upper-bar-->
@include('front.layouts.upnav')    
        
        
        <!--nav-->
@include('front.layouts.navbar')     
      
       @yield('content')
        
@include('front.layouts.footer')