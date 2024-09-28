<div class="upper-bar">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6">

                {{-- @auth('client-web')
                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="badge badge-warning navbar-badge"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('client-logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endauth --}}

            </div>
            <div class="col-lg-4 col-md-6">
                <div class="social">
                    <div class="icons">
                        <a href="{{ $settings->fa_link ?? " " }}" target="_blank" class="facebook"><i
                                class="fab fa-facebook-f"></i></a>
                        <a href="{{ $settings->insta_link ?? " "}}" target="_blank" class="instagram"><i
                                class="fab fa-instagram"></i></a>
                        <a href="{{ $settings->tw_link ?? " "}}" target="_blank" class="twitter"><i
                                class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>

            <!-- not a member-->
            @guest('client-web')
                <div class="col-lg-4">
                    <div class="info" dir="ltr">
                        <div class="phone">
                            <i class="fas fa-phone-alt"></i>
                            <p>+{{$settings->phone ?? " " }}</p>
                        </div>
                        <div class="e-mail">
                            <i class="far fa-envelope"></i>
                            <p>{{ $settings->email ?? " " }}</p>
                        </div>
                    </div>
                @endguest
                <!--I'm a member
                -->
                @auth('client-web')
                    <div class="member">
                        <p class="welcome">welcome</p>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                <i class="fas fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="index-1.html">
                                    <i class="fas fa-home"></i>
                                    Main
                                </a>
                                <a class="dropdown-item" href="{{ route('getProfile') }}">
                                    <i class="far fa-user"></i>
                                    Profile
                                </a>
                               
                                <a class="dropdown-item" href="{{ route('client-get-favorite') }}">
                                    <i class="far fa-heart"></i>
                                    Favorite
                                </a>
                              
                                <a class="dropdown-item" href="{{ route('contact-us') }}">
                                    <i class="fas fa-phone-alt"></i>
                                    contact-us
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                    
                                        <i class="fas fa-sign-out-alt"></i>
                                   
                                </a>
                                <form id="logout-form" action="{{ route('client-logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                @endauth

            </div>
        </div>
    </div>
</div>
