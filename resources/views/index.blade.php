@extends('auth.layouts')
@section('content')

<div class="container-fluid py-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6 ps-4">
            <h1 class="h3 mb-0 ms-3">Daftar Buku</h1>
        </div>
        <div class="col-md-6 text-end pe-4">
            <a href="{{ route('create') }}" class="btn btn-primary me-3">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>
    </div>
    <div class="card shadow mx-3">
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Judul Buku</th>
                            <th scope="col">Penulis</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Tanggal Terbit</th>
                            <th scope="col">Cover</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_buku as $buku)
                        <tr>
                            <td class="align-middle px-3">{{ $buku->id }}</td>
                            <td class="align-middle px-3">{{ $buku->judul }}</td>
                            <td class="align-middle px-3">{{ $buku->penulis }}</td>
                            <td class="align-middle px-3">{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                            <td class="align-middle px-3">{{ (new DateTime($buku->tgl_terbit))->format('d/m/Y') }}</td>
                            <td>
                                @if ($buku->filepath)
                                <div class="relative h-10 w-10">
                                    <img
                                        class="h-full w-full rounded-full object-cover object-center"
                                        src="{{ asset($buku->filepath) }}"
                                        alt="Cover"
                                    />
                                </div>
                                @else
                                    No Cover
                                @endif
                            </td>
                            <td class="text-center px-3">
                                <div class="btn-group gap-2" role="group">
                                <form action="{{ route('buku.edit', $buku->id) }}" method="GET">
                                    <button type="submit" class="btn btn-primary w-100">Edit</button>
                                </form>
                                    <form action="{{ route('buku.destroy', $buku->id) }}" 
                                        method="POST" 
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-sm btn-danger ms-2" 
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                    <form action="/upload" method="POST" enctype="multipart/form-data">
                                        <input type="file" name="thumbnail">
                                        <button type="submit">Upload</button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
