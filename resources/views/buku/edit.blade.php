<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no", 
        initial-scale="1.0", maximum-scale="1.0", minimum-scale="1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Edit Buku - Belajar Model PPW2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    @extends('app')

    @section('content')
    <div class="container mt-5">
        <h4 class="mb-4">Edit Buku</h4>

        <form method="POST" action="{{ route('buku.update', $buku->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}" required>
            </div>

            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}" required>
            </div>

            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}" required>
            </div>

            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}" required>
            </div>

            <div class="col-span-full mt-6">
                <label for="thumbnail" class="block text-sm font-medium leading-6 text-gray-900">Thumbnail</label>
                <div class="mt-2">
                    <input type="file" name="thumbnail" id="thumbnail">
                </div>
            </div>

            <div class="col-span-full mt-5">
                <label for="gallery" class="block text-sm font-medium leading-6 text-gray-900">Gallery</label>
                <div class="mt-2" id="fileinput_wrapper">
                    <input type="file" name="gallery[]" id="gallery" class="block w-full mb-5">
                </div>
                <button type="button" class="btn btn-primary" onclick="addFileInput()">Tambah Input data</button>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

    <script type="text/javascript">
        function addFileInput() {
            var div = document.getElementById('fileinput_wrapper');
            div.innerHTML += '<input type="file" name="gallery[]" id="gallery" class="block w-full mb-5" style="margin-bottom:5px;">';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-9ndCyUa0Jn3WL8pnhD9WmH8eKe6i5k90tqPjsqfCI5Ff5f0vuHV8/qb5mQd/gtds" crossorigin="anonymous"></script>
</body>
</html>