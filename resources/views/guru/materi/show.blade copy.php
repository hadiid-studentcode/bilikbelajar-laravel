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

    <h1>Manajemen Materi Kelas {{ $kelas }}</h1>

 

    <form action="{{ route('guru.materi.store') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label for="nama">Nama Materi</label>
        <input type="text" name="nama" id="nama"> <br>

        <label for="kelas">kelas</label>
        <select name="kelas" id="kelas">
            <option selected value="{{ $kelas }}">{{ $kelas }}</option>
            
        </select> <br>

        <label for="file">Upload File</label>
        <input type="file" name="file" id="file"> <br>

        <label for="video">Upload Video</label>
        <input type="file" name="video" id="video"> <br>

        <label for="deskripsi">deskripsi</label>
        <textarea name="deskripsi" id="deskripsi" cols="60" rows="10"></textarea> <br>

        <button class="btn btn-primary" type="submit">Simpan</button>


    </form>

    @foreach($materi as $m)
    <h1>{{ $m->nama }}</h1>
    <a href="">Lihat Materi</a>
    <a href="">Kuis</a>
    <a href="">Evaluasi</a>

    @endforeach
</body>

</html>
