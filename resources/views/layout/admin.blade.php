@extends('layout.app')
@section('page-styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
@endsection
@section('content')
<section class="h-100 d-lg-flex">
    @include('admin.sidebar')
    <div class="flex-fill bg-light p-3">
        @yield('admin-content')
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
@yield('admin.scripts')
@endsection
