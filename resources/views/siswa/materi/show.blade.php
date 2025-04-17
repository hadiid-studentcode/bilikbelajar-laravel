<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Materi show</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    {{ $materi->nama }} <br>
    {{ $materi->kelas }}

    <h1>Materi</h1>

    <p>{{ $materi->deskripsi }}</p>

    <h1>file pdf</h1>
  

    <div class="container">
        <embed src="{{ asset('storage/' . $materi->file) }}" type="application/pdf" width="100%" height="900px">

    </div>

    <video src="{{ asset('storage/' . $materi->video) }}" controls width="640" height="360"></video>

</body>

</html>
