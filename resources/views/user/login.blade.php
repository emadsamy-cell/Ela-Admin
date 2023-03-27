@extends('user.master')
@section('title' , 'login page')
@section('form')
@if($errors->any() || session('msg'))
<div class="alert alert-danger">
    The Email or Password is Incorrect.
@endif
<form action="{{ route('handlelogin') }}" method="post">
    @csrf
    <div class="form-group">
        <label>Email address</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}">
        @error('email')
        <small class="form-text text-muted alert alert-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
        @error('password')
        <small class="form-text text-muted alert alert-danger">{{ $message }}</small>
        @enderror
    </div>
    <button type="submit" class="btn btn-success btn-flat m-b-30 m-t-30">Sign in</button>
    <div class="register-link m-t-15 text-center">
        <p>Don't have account ? <a href="{{ route('register') }}"> Sign Up Here</a></p>
    </div>
</form>
@endsection
