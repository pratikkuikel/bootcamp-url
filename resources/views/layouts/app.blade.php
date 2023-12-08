<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    @guest
        <nav>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('auth.register') }}">Register</a></li>
        </nav>
    @endguest
    @auth
    <li><a href="{{ route('profile') }}">Profile</a></li>
        <nav>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout , {{ auth()->user()->name }}</button>
            </form>
        </nav>
    @endauth
    <br>
    @yield('content')

</body>

</html>
