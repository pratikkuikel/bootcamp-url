@extends('layouts.app')

@section('content')
    <a href="{{ route('urls.create') }}">
        <h1>Create a new url</h1>
    </a>
    List all your urls here
    <br>
    <div>
        <table>
            <tr>
                <th>Id</th>
                <th>Original Url</th>
                <th>Short Url</th>
            </tr>
            @foreach ($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td>{{ $url->original_url }}</td>
                    <td>{{ $url->short_url }}</td>
                    <td><a href="{{ route('urls.edit', ['id' => $url->id]) }}">Edit</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
