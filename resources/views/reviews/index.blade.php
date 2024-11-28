@extends('auth.layouts')
@section('content')

<div class="container mt-5">
    <h4 class="mb-4">Daftar Review</h4>
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
                    <th scope="col">Reviewer</th>
                    <th scope="col">Tanggal Review</th>
                    <th scope="col">Review</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->buku->judul }}</td>
                    <td>{{ $review->reviewer }}</td>
                    <td>{{ $review->review }}</td>
                    <td>
                        @foreach ($review->tags as $tag)
                            <span class="badge bg-primary">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection