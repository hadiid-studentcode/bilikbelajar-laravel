<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materi | Guru</title>


    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>

    <h1>Manajemen Materi</h1>

    @foreach ($kelas as $k)
        <h1><a href="{{ route('guru.materi.kelas', $k->value) }}">Kelas {{ $k->value }}</a></h1>
    @endforeach

   

</body>

</html>
