@extends('layout.admin')
@section('admin-content')
<div class="row gy-2">
    <div class="col-12 col-lg-4">
        <a href="{{ route('admin.products') }}">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-box-open fa-3x"></i>
                        </div>
                        <div class="col-7">
                            <span class="text-muted">Products</span>
                            <h5>{{ $productsCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-lg-4">
        <a href="{{ route('admin.categories') }}">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-list-alt fa-3x"></i>
                        </div>
                        <div class="col-7">
                            <span class="text-muted">Categories</span>
                            <h5>{{ $categoriesCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-12 col-lg-4">
        <a href="{{ route('admin.users') }}">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="col-7">
                            <span class="text-muted">Users</span>
                            <h5>{{ $usersCount }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>
@endsection
