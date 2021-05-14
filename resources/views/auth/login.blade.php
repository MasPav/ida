@include('layout.head')
<section class="d-flex flex-column align-items-center vh-100 justify-content-center">

    <div class="card shadow-sm py-2 p-lg-3 rounded-3">
        @if ($errors->any())
        <div class="alert alert-danger py-2 justify-content-center">
            @foreach ($errors->all() as $error)
            <p class="text-center mb-1">{{$error}}</p>
            @endforeach
        </div>
        @endif
        <a class="text-center mb-2" href="{{route('home')}}"><i class="fas fa-home fa-lg"></i></a>
        <h4 class="text-center">Admin Login</h4>
        <div class="card-body">
            <form action="{{route('login')}}" method="post">
                @csrf()
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" name="email" id="floatingEmail" placeholder="email"
                        required value="{{old('email')}}">
                    <label for="floatingEmail">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" name="password" id="floatingPassword"
                        placeholder="password" required value="{{old('password')}}">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="d-grid mt-3">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-sign-in-alt"></i></button>
                </div>
            </form>
        </div>
    </div>
</section>
@include('layout.foot')
