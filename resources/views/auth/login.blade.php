@extends('layouts.app')

@section('content')
    <form action="{{ route('login') }}" method="POST">
        @csrf
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
        <a class="bg-blue-500 hover:bg-blue-700" href="{{ route('password.request') }}">Forgot password </a>
        <br>
        <button type="submit">Login</button>
    </form>
@endsection
