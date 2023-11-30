@extends('layouts.app')

@section('content')
    <a href="{{ route('urls.create') }}">
        <h1>Create a new url</h1>
    </a>
    @if (Session::has('success'))
        <span style="color: green;">{{ Session::get('success') }}</span>
        <br>
    @endif
    List all your urls here
    <br>
    <div>
        <table>
            <tr>
                <th>Id</th>
                <th>Original Url</th>
                <th>Short Url</th>
                <th>Actions</th>
            </tr>
            @foreach ($urls as $url)
                <tr>
                    <td>{{ $url->id }}</td>
                    <td>{{ $url->original_url }}</td>
                    <td>{{ $url->short_url }}</td>
                    <td><a href="{{ route('urls.edit', ['id' => $url->id]) }}">Edit</td>
                    <td><a href="{{ route('urls.view', ['id' => $url->id]) }}">View</td>
                    <td>
                        <form action="{{ route('urls.destroy', $url->id) }}" method="POST">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    {{-- @dd(Session::all()) --}}
@endsection
