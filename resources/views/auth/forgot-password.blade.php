@extends('layouts.app')

@section('content')
    @if (Session::has('message'))
        <span style="color: green;">{{ Session::get('message') }}</span>
    @endif
    @if (Session::has('email'))
        <span style="color: red;">{{ Session::get('email') }}</span>
    @endif
    @error('email')
        <span style="color: red;">{{ $message }}</span>
    @enderror
    Please verify your email by clicking the verification link sent in the email.
    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email">
        <br>
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">
            Send Password Reset Link
        </button>
    </form>
@endsection
