<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <h1>Login Guru</h1>

    <form action="{{ route('authenticate') }}" method="post">
        @csrf
        <label for="username">Username</label>
        <input type="text" name="username" id="username"> <br>
        <label for="password">Password</label> <br>
        <input type="password" name="password" id="password"> <br>

        <button type="submit">Login</button>
    </form>

</body>

</html>
