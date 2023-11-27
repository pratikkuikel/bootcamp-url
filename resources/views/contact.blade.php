@extends('layouts.app')

@section('content')
    This is contact page
    {{-- <div style="color: red;">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        @endif
    </div> --}}

    <div style="color: green;">
        @if (Session::has('success'))
            {{ Session::get('success') }}
        @endif
    </div>
    <br>
    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <label>Name</label>
        @error('name')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
        <input type="text" name="name" value="{{ old('name') }}">
        <br>
        <label>Email</label>
        @error('email')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
        <input type="text" name="email" value="{{ old('email') }}">
        <br>
        <label>Message</label>
        @error('message')
            <div style="color: red;"> {{ $message }} </div>
        @enderror
        <textarea type="text" name="message">{{ old('message') }}</textarea>
        <br>
        <button type="submit">Submit</button>
    </form>
    @dd(Session::all())
@endsection
