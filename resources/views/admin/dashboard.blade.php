@extends('layout.admin')
@section('admin.styles')
<style>
    .card:hover {
        transform: scale(1.05);
    }
</style>
@endsection
@section('admin-content')
<div class="row gy-2">
    <div class="col-12 col-lg-4">
        <a href="{{ route('admin.products') }}">
            <div class="card shadow-sm border border-warning border-2" style=" transition: transform .5s;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-box-open fa-3x text-warning"></i>
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
            <div class="card shadow-sm border border-primary border-2" style=" transition: transform .5s;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-list-alt fa-3x text-primary"></i>
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
            <div class="card shadow-sm border border-success border-2" style=" transition: transform .5s;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <i class="fas fa-users fa-3x text-success"></i>
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
