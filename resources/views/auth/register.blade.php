{{-- @dd(Session::all()) --}}
@extends('layouts.app')

@section('content')
    <form action="{{ route('auth.register') }}" method="POST">
        @csrf
        <label>Name</label>
        @error('name')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <input type="text" name="name">
        <br>
        <label>Email</label>
        @error('email')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <input type="email" name="email">
        <br>
        <label>Password</label>
        @error('password')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <input type="text" name="password">
        <br>
        <label>Password Confirmation</label>
        <input type="text" name="password_confirmation">
        <br>
        <button type="submit">Register</button>
    </form>
@endsection
