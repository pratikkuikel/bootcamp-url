{{-- @dd($url->visitors) --}}
@extends('layouts.app')

@section('content')
    <h4>Analytics for the url : {{ $url->original_url }}</h4>
    <h4>short url : {{ $url->short_url }}</h4>
    <h4>Visitor Count : {{ $url->visitor_count }}</h4>
    Url visitors
    <br>
    <div>
        <table>
            <tr>
                <th>Id</th>
                <th>Ip</th>
                <th>User Agent</th>
                <th>Visited At</th>
            </tr>
            @foreach ($url->visitors as $visitor)
                <tr>
                    <td>{{ $visitor->id }}</td>
                    <td>{{ $visitor->ip }}</td>
                    <td>{{ $visitor->user_agent }}</td>
                    <td>{{ $visitor->created_at->diffForHumans() }}</td>
                </tr>
            @endforeach
        </table>
    </div>
    {{-- @dd(Session::all()) --}}
@endsection
