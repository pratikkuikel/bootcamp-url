@extends('layouts.app')

@section('content')
    Welcome to Bootcamp-Url Application
    @auth
    <a href="{{ route('urls') }}">
        <h1>URLS</h1>
    </a>
    @endauth
@endsection
