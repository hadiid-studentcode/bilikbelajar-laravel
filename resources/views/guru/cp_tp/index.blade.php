<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CPTP | Guru</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <h1 class="text-center">Capaian dan Tujuan Pembelajaran</h1>
        <a href="{{ route('guru.dashboard.index') }}">Dashboard</a> <br>




    @if ($capaian && $tujuan)
        <form class="text-center container" action="{{ route('guru.cptp.update', [$capaian->id, $tujuan->id]) }}"
            method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="cp" class="form-label">Capaian Pembelajaran</label>
                <textarea class="form-control" id="cp" name="cp" rows="7">{{ $capaian->dekripsi }}</textarea>
            </div>
            <div class="mb-3">
                <label for="tp" class="form-label">Tujuan Pembelajaran</label>
                <textarea class="form-control" id="tp" name="tp" rows="10">{{ $tujuan->dekripsi }}</textarea>
            </div>

            <button type="submit" class="btn btn-info">Ubah</button>
        </form>

        <form action="{{ route('guru.cptp.destroy', [$capaian->id, $tujuan->id]) }}" method="post" class="container">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger text-center">Delete</button>

        </form>
    @else
        <form class="text-center container" action="{{ route('guru.cptp.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="cp" class="form-label">Capaian Pembelajaran</label>
                <textarea class="form-control" id="cp" name="cp" rows="7">peserta didik memiliki kemampuan untuk responsif terhadap isu-isu global dan berperan aktif dalam memberikan penyelesaian masalah. Kemampuan tersebut antara lain mengamati, mempertanyakan dan memprediksi, merencanakan dan melakukan penelitian, memproses dan menganalisis data dan informasi, mengevaluasi dan merefleksi, serta mengkomunikasikan dalam bentuk projek sederhana atau simulasi visual menggunakan aplikasi teknologi yang tersedia terkait dengan energi alternatif, pemanasan global, pencemaran lingkungan, nano teknologi, bioteknologi, kimia dalam kehidupan sehari-hari, pemanfaatan limbah dan bahan alam, pandemi akibat infeksi virus. Semua upaya tersebut diarahkan pada pencapaian tujuan pembangunan yang berkelanjutan (SDGs). Melalui keterampilan proses juga dibangun sikap ilmiah dan profil pelajar pancasila.</textarea>
            </div>
            <div class="mb-3">
                <label for="tp" class="form-label">Tujuan Pembelajaran</label>
                <textarea class="form-control" id="tp" name="tp" rows="10">Setelah mengikuti pembelajaran, peserta didik diharapkan mampu:
1. Menjelaskan pengertian dan faktor penyebab perubahan lingkungan berdasarkan aspek alami dan aktivitas manusia.
2. Menganalisis jenis-jenis pencemaran lingkungan serta dampaknya terhadap ekosistem.
3. Mengidentifikasi strategi penanganan limbah sesuai jenis dan wujudnya (cair, padat, B3).
4. Mendeskripsikan dinamika komunitas dan perubahan yang terjadi dalam suatu ekosistem.
5. Menjelaskan bentuk adaptasi dan mitigasi terhadap perubahan lingkungan berdasarkan situasi geografis dan sosial.
6. Mempresentasikan solusi kreatif dalam menjaga keseimbangan lingkungan dan pengelolaan limbah.</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    @endif

</body>

</html>
