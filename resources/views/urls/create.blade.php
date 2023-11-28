@extends('layouts.app')

@section('content')
    Create your url here !
    <br>
    <br>
    <form action="{{ route('urls.create') }}" method="POST">
        @csrf
        <label>Input Your Url</label>
        <br>
        @error('url')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <input name="url" type="text">
        <br>
        <button type="submit">Submit </button>
    </form>
@endsection
