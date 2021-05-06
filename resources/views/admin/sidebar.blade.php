<div class="d-none d-lg-block bg-dark text-danger pt-5" style="width: 250px;">
    <ul class="list-unstyled">
        <a href="{{route('admin')}}">
            <li class="px-4 py-2">
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
        <a href="">
            <li class="px-4 py-2">
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
        <a href="">
            <li class="px-4 py-2 border-start border-white border-3">
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
        <a href="">
            <li class="px-4 py-2">
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
<div class="d-lg-none">
    <div class="border-bottom border-1 p-2">
        <button class="btn btn-danger" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <i class="fas fa-cogs" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample"></i>
        </button>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="list-unstyled">
                <a href="{{route('admin')}}">
                    <li class="px-4 py-2">
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
                <a href="">
                    <li class="px-4 py-2">
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
                <a href="">
                    <li class="px-4 py-2 border-bottom border-danger border-3">
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
                <a href="">
                    <li class="px-4 py-2">
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
