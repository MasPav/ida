@extends('layout.admin')
@section('admin-content')
<div class="row">
    <div class="col-12">
        <div class="text-center">
            <i class="fa fa-user fa-5x text-warning"></i>
        </div>
        <hr>
        <form action="{{ route('admin.updateUser', ['id' => Auth::id()]) }}" method="POST" class="w-50 mx-auto">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="form-floating mb-3">
                <input type="text" name="email" class="form-control" id="userEmail" placeholder="email"
                    value="{{ Auth::user()->email }}" readonly>
                <label for="userEmail">Email</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="userEmail"
                    placeholder="name" value="{{ Auth::user()->name }}" required>
                <label for="userName">Username</label>
                <div class="invalid-feedback">
                    Your name was too short
                </div>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                    id="userPassword" placeholder="password">
                <label for="userPassword">Password</label>
                <small class="@error('password') text-danger @enderror">Your password must be at least 6
                    characters</small>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-success w-25"><i class="fa fa-check"></i></button>
            </div>
        </form>
    </div>
</div>
@endsection
