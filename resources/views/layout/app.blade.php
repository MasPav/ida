@include('layout.head')

<body>
    <div class="d-flex flex-column min-vh-100">
        @include('layout.navbar')
        <main class="flex-fill my-5">
            @yield('content')
        </main>
        @include('layout.footer')
    </div>
</body>
@include('layout.foot')
