<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Siswa</title>

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <h1>Dashboard Siswa</h1>
    <h1>Capaian Pembelajaran</h1>

    <p>{{ $capaianPembelajaran->dekripsi }}</p>

    <h1>Tujuan Pembelajaran</h1>

    <p> {{ $tujuanPembelajaran->dekripsi }}
    </p>

    


    {{ session('siswa') }}

    @foreach ($materi as $m)
        <h4>{{ $m->nama }}</h4>
        <h5>{{ $m->kelas }}</h5>
        <a href="{{ route('siswa.materi.show', $m->id) }}">Lihat Materi</a>
    @endforeach


</body>

</html>
