@include('layout.head')
<div class="d-flex flex-column vh-100">
    @include('layout.navbar')
    <main class="flex-fill" style="margin-top: 70px;">
        @yield('content')
    </main>
    @include('layout.footer')
</div>
@include('layout.foot')
