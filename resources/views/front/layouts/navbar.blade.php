<div class="nav-bar">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('front/imgs/logo-ltr.png')}}" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                 
                    <li class="nav-item ">

                        <a class="nav-link" href="{{ route('client-home') }}">Home </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client-posts') }}">Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('client-donations') }}">Donation Requests</a>
                    </li>   

                    <li class="nav-item">
                        {{-- <a class="nav-link" href="{{ route('frontAbout') }}">about us</a> --}}
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about-us') }}">who are us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact-us') }}">contact us</a>
                    </li>
                </ul>
                @yield('member')            

              
               

               
                
            </div>
        </div>
    </nav>
</div>