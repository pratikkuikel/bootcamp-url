<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }}</title>
</head>

<body>
    @guest
        <nav>
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('auth.register') }}">Register</a></li>
        </nav>
    @endguest
    <br>
    @yield('content')

</body>

</html>
