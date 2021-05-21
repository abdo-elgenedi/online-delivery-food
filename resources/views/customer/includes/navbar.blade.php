<div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
    </div>
    <div class="site-mobile-menu-body"></div>
</div>


<header class="site-navbar js-sticky-header site-navbar-target" role="banner" style="position:relative;background-color: whitesmoke">

    <div class="container">
        <div class="row align-items-center">

            <div class="col-md-4">
                <h1 class="mb-0 site-logo"><a style="color:orangered;" href="{{route('welcome')}}" class="h4 mb-0">Online Food</a></h1>
            </div>

            <div class=" col-md-8 d-none d-xl-block">
                <nav class="site-navigation position-relative text-right" role="navigation">

                    <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">

                    @guest()
                        <li><a href="{{route('login')}}" class="nav-link">Login</a></li>
                    @else
                        <li class="has-children">
                            <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                            <ul class="dropdown">
                                <li><a class=nav-link" href="{{route('current.orders')}}">Current Orders</a></li>
                                <li><a class="nav-link" href="{{route('previous.orders')}}">Previous Orders</a></li>
                                <li><a class="nav-link" href="{{route('customer.profile')}}">Profile</a></li>
                                <li >
                                    <a class=nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                    </ul>
                </nav>
            </div>


            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

        </div>
    </div>

</header>
