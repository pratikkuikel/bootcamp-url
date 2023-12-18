@extends('layouts.app')

@section('content')
    @if (Session::has('message'))
        <span style="color: green;">{{ Session::get('message') }}</span>
    @endif
    Please verify your email by clicking the verification link sent in the email.
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded" type="submit">Resend Verification Link</button>
    </form>
@endsection
