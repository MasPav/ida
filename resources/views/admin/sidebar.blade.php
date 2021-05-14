<div class="d-none d-lg-block bg-dark text-white pt-5" style="width: 250px;">
    <ul class="list-unstyled">
        <a href="{{route('admin.dashboard')}}">
            <li class="px-4 py-2 @if (request()->routeIs('admin.dashboard'))
                border-start border-danger border-2 text-danger
            @endif">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-chalkboard"></i>
                    </div>
                    <div class="col-10">
                        Dashboard
                    </div>
                </div>
            </li>
        </a>
        <a href="{{ route('admin.products') }}">
            <li class="px-4 py-2 @if (request()->routeIs('admin.products'))
                border-start border-danger border-2 text-danger
            @endif">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="col-10">
                        Products
                    </div>
                </div>
            </li>
        </a>
        <a href="{{ route('admin.categories') }}">
            <li class="px-4 py-2 @if (request()->routeIs('admin.categories'))
                border-start border-danger border-2 text-danger
            @endif">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-list-alt"></i>
                    </div>
                    <div class="col-10">
                        Categories
                    </div>
                </div>
            </li>
        </a>
        <a href="{{ route('admin.users') }}">
            <li class="px-4 py-2 @if (request()->routeIs('admin.users'))
                border-start border-danger border-2 text-danger
            @endif">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="col-10">
                        Users
                    </div>
                </div>
            </li>
        </a>
        <hr>
        <a href="{{ route('admin.profile') }}">
            <li class="px-4 py-2 @if (request()->routeIs('admin.profile'))
                border-start border-danger border-2 text-danger
            @endif">
                <div class="row">
                    <div class="col-2">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="col-10">
                        Your Profile
                    </div>
                </div>
            </li>
        </a>
    </ul>
</div>
<div class="d-lg-none">
    <div class="d-flex border-bottom border-1 p-2">
        <button class="btn btn-danger me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            <i class="fas fa-cogs" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
                aria-controls="offcanvasExample"></i>
        </button>
        <div class="dropdown">
            <button class="btn btn-outline-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="fas fa-user"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="{{route('logout')}}">Logout</a></li>
            </ul>
        </div>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <a href="{{route('admin.dashboard')}}">
                    <li class="px-4 py-2 @if (request()->routeIs('admin.dashboard'))
                        border-start border-danger border-2 text-danger
                    @endif">
                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-chalkboard"></i>
                            </div>
                            <div class="col-10">
                                Dashboard
                            </div>
                        </div>
                    </li>
                </a>
                <a href="{{ route('admin.products') }}">
                    <li class="px-4 py-2 @if (request()->routeIs('admin.products'))
                        border-start border-danger border-2 text-danger
                    @endif">
                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <div class="col-10">
                                Products
                            </div>
                        </div>
                    </li>
                </a>
                <a href="{{ route('admin.categories') }}">
                    <li class="px-4 py-2 @if (request()->routeIs('admin.categories'))
                        border-start border-danger border-2 text-danger
                    @endif">
                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-list-alt"></i>
                            </div>
                            <div class="col-10">
                                Categories
                            </div>
                        </div>
                    </li>
                </a>
                <a href="{{ route('admin.users') }}">
                    <li class="px-4 py-2 @if (request()->routeIs('admin.users'))
                        border-start border-danger border-2 text-danger
                    @endif">
                        <div class="row">
                            <div class="col-2">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="col-10">
                                Users
                            </div>
                        </div>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</div>
