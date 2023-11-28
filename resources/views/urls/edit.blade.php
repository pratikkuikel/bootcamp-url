@extends('layouts.app')

@section('content')
    Edit your url here !
    <br>
    <br>
    <form action="{{ route('urls.edit', $url->id) }}" method="POST">
        @csrf
        <label>Input Your Url</label>
        <br>
        @error('url')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <input name="url" value="{{ $url->original_url }}" type="text">
        <br>
        <button type="submit">Submit </button>
    </form>
@endsection
