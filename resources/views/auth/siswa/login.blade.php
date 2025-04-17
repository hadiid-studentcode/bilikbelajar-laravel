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
    <h1>Login Siswa</h1>

    <form action="{{ route('siswa.login') }}" method="post">
        @csrf
        <label for="nama">Nama</label>
        <input type="text" name="nama" id="nama"> <br>

        <label for="asalSekolah">Asal Sekolah</label> <br>
        <input type="text" name="asalSekolah" id="asalSekolah"> <br>

        <label for="kelas">Kelas</label> <br>
        <select name="kelas" id="kelas">
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>



        <button type="submit">Login</button>


        {{ session('siswa') }}

<br>
            <a href="{{ route('siswa.logout') }}">Logout</a>


    </form>

</body>

</html>
