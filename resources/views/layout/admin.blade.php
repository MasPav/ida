@extends('layout.app')
@section('content')
<section class="h-100 d-lg-flex">
    @include('admin.sidebar')
    <div class="flex-fill bg-light p-3">
        @yield('admin-content')
    </div>
</section>
@endsection
