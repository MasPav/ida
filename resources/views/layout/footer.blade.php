<footer
    class="shadow d-flex align-items-center {{ Request::is('admin') || Request::is('admin/*') ? 'bg-white text-dark' : 'bg-dark text-white' }}">
    <div class="container">
        <p class="text-center">&copy; 2021</p>
    </div>
</footer>
