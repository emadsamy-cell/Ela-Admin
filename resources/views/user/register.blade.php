@extends('user.master')
@section('title' , 'Register page')
@section('form')
    <form action="{{ route('handleregister') }}" method ="post">
        @csrf
        <div class="form-group">
            <label>User Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" name="name" value="{{ old('name') }}">
            @error('name')
            <small class="form-text text-muted alert alert-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Email address</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
            @error('email')
            <small class="form-text text-muted alert alert-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}">
            @error('password')
            <small class="form-text text-muted alert alert-danger">{{ $message }}</small>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Register</button>
        <div class="register-link m-t-15 text-center">
            <p>Already have account ? <a href="{{ route('login') }}"> Sign in</a></p>
        </div>
    </form>

@endsection
