@extends('layouts.app')

@section('content')
    {{-- @if (request()->path() == '/info')
        Hello This is welcome page
    @else
        This is not home page
    @endif --}}
    {{-- @auth
        Hello ! <br> Welcome to our application, {{ $data }}
    @endauth
    @guest
        Please log in to continue
    @endguest --}}

    {{-- @for ($i = 1; $i < 100; $i++)
        Hello
    @endfor --}}

    @foreach ($array as $item)
        {{$loop->index}} -
        {{ $item['name'] }}
        <br>
    @endforeach
@endsection
