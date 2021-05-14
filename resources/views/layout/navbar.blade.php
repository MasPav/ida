<nav class="navbar navbar-expand-lg shadow fixed-top navbar-light font-weight-bold bg-white">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{asset('images/paper_img/WhatsApp Image 2021-04-12 at 9.09.58 PM (1).jpeg')}}"
                class="img-fluid shadow-sm rounded" alt="" style="height: 2.3em;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarToggler"
            aria-controls="mainNavbarToggler" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNavbarToggler">
            <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                <li class="nav-item {{request()->routeIs('home') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('home')}}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item {{request()->routeIs('products') || \Request::is('products/*') ? 'active' : ''}}">
                    <a class="nav-link" href="{{route('products')}}">Products</a>
                </li>
                <li class="nav-item {{request()->routeIs('about') ? 'active' : ''}}">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item {{request()->routeIs('contact') ? 'active' : ''}}">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                @if(Auth::check())
                <li class="nav-item @if (\Request::is('admin') || \Request::is('admin/*'))
                active
                @endif ">
                    <a class="nav-link" href="{{route('admin.dashboard')}}">Admin</a>
                </li>
                @endif
            </ul>
            <!-- <form class="form-inline">
                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form> -->
        </div>
        <div class="d-none d-lg-block">
            @if(request()->routeIs('admin.*') )
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end mt-2" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="{{route('admin.profile')}}">Your Profile</a></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
                </ul>
            </div>
            @endif
        </div>
    </div>
</nav>
