@extends('layouts.app')

@section('content')
    <form action="{{ route('file.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Upload your File</label>
        <br>
        <br>
        @error('file')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <input name="file" type="file">
        <br>
        <br>
        <button type="submit">Submit </button>
    </form>

    @if (Session::has('path'))
    <div>
        <img src="{{ Storage::url(Session::get('path')) }}">
    </div>
    @endif
@endsection
