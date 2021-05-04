@include('layout.head')
    <form action="{{route('login')}}" method="post">
        @csrf()
        <input class="form-control" name="email">
        <!-- <input class="form-control" name="password"> -->
        <button class="btn btn-primary" type="submit">Login</button>
    </form>
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@include('layout.foot')
