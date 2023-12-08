@extends('layouts.app')

@section('content')
    @if (Session::has('success'))
        <div style="color: green;">
            {{ Session::get('success') }}
        </div>
    @endif
    <form action="{{ route('profile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Update your Profile</label>
        <br>
        <br>
        @error('name')
            <span style="color: red;">{{ $message }}</span>
            <br>
        @enderror
        <label>Name</label>
        <input name="name" value="{{ auth()->user()->name }}" type="text">
        <br>
        <br>
        <button type="submit">Submit </button>
    </form>
@endsection
