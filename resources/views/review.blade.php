@extends('auth.layouts')
@section('content')

<div class="container mt-5">
    <h4 class="mb-4">Review Buku</h4>
    <form method="POST" action="{{ route('reviews.store') }}">
        @csrf
        <div class="mb-3">
            <label for="buku_id" class="form-label">Pilih Buku</label>
            <select class="form-control" id="buku_id" name="buku_id" required>
                    <option value="{{ $buku->id }}">{{ $buku->judul }}</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Review</label>
            <textarea class="form-control" id="review" name="review" rows="5" required></textarea>
        </div>
        <div class="mb-3">
            <label for="review_date" class="form-label">Tanggal Review</label>
            <input type="text" class="form-control" id="review_date" name="review_date" value="{{ now()->format('d/m/Y') }}" readonly>
        </div>
        <div class="mb-3">
            <label for="tags" class="form-label">Tags :</label>
            <div id="tags" class="btn-group" role="group" aria-label="Tags">
                <?php
                $tags = ['philosophical', 'horror', 'thriller', 'manga', 'romance', 'slice of life', 'educational', 'novel'];
                foreach ($tags as $tag): ?>
                    <input type="checkbox" class="btn-check" id="{{ $tag }}" name="tags[]" value="{{ $tag }}" autocomplete="off">
                    <label class="btn btn-outline-primary" for="{{ $tag }}">{{ ucfirst($tag) }}</label>
                <?php endforeach; ?>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit Review</button>
        <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>

@endsection